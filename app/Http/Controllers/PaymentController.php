<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Payment;
use Illuminate\Http\Request;
use Kkiapay\Kkiapay;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // 1. DÉCLENCHEMENT : On enregistre l'intention et on affiche le bouton KKiaPay
    public function pay(Contenu $contenu)
    {
        $user = Auth::user();
        $amount = $contenu->prix > 0 ? $contenu->prix : 200;

        // On crée un paiement "En attente" pour garder une trace
        $payment = Payment::create([
            'user_id' => $user->id,
            'contenu_id' => $contenu->id,
            'reference_fedapay' => 'kkiapay_' . $user->id . '_' . $contenu->id . '_' . uniqid(), // Génération d'une référence vraiment unique
            'amount' => $amount,
            'status' => 'pending'
        ]);

        // On retourne une vue spéciale qui va ouvrir le Widget KKiaPay
        return view('payment.kkiapay', compact('contenu', 'user', 'payment', 'amount'));
    }

    // 2. RETOUR (CALLBACK) : On vérifie si ça a marché
    public function callback(Request $request)
    {
        // KKiaPay renvoie l'ID de transaction dans l'URL (?transaction_id=...)
        $transactionId = $request->input('transaction_id');

        if (!$transactionId) {
            return redirect()->route('home')->with('error', 'Aucune transaction détectée.');
        }

        // Vérification sécurisée auprès de KKiaPay
        $kkiapay = new Kkiapay(
            env('KKIAPAY_PUBLIC_KEY'),
            env('KKIAPAY_PRIVATE_KEY'),
            env('KKIAPAY_SECRET'),
            env('KKIAPAY_SANDBOX') // true
        );

        try {
            $transaction = $kkiapay->verifyTransaction($transactionId);

            if ($transaction->status === 'SUCCESS') {
                
                // On met à jour le dernier paiement "pending" de cet utilisateur
                // (Astuce car on ne peut pas passer l'ID facilement dans le callback simple)
                $payment = Payment::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->latest()
                    ->first();

                // FIX: On ne vérifie plus que reference_fedapay === transactionId
                // car Kkiapay renvoie son propre ID de transaction different du nôtre.
                if ($payment) {
                    $payment->update([
                        'status' => 'approved',
                        'reference_fedapay' => $transactionId // On met à jour avec la vraie ref Kkiapay pour traçabilité
                    ]);

                    return redirect()->route('contenus.show', $payment->contenu_id)
                        ->with('success', 'Paiement KKiaPay validé avec succès !');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Erreur de vérification : ' . $e->getMessage());
        }

        return redirect()->route('home')->with('error', 'Le paiement a échoué.');
    }
}