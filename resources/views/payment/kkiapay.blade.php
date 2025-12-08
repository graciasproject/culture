<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Sécurisé - Culture Bénin</title>
    <script src="https://cdn.kkiapay.me/k.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 h-screen flex flex-col items-center justify-center text-white">

    <div class="text-center space-y-6">
        <div class="animate-pulse">
            <h1 class="text-3xl font-bold text-yellow-500">Paiement Sécurisé</h1>
            <p class="text-gray-400 mt-2">Vous allez débloquer : {{ $contenu->titre }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-2xl">
            <kkiapay-widget amount="{{ $amount }}" key="{{ env('KKIAPAY_PUBLIC_KEY') }}"
                email="{{ $user->email }}" firstname="{{ $user->prenom }}" lastname="{{ $user->nom }}"
                phone="61000000" callback="{{ route('payment.callback') }}" sandbox="true" theme="#008751">
            </kkiapay-widget>
        </div>

        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-white underline">Annuler et retour</a>
    </div>

</body>

</html>
