<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vérification Email - Culture Bénin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #008751, #FCD116, #E8112D);
            padding: 20px;
            text-align: center;
            color: white;
        }

        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }

        .button {
            background: #008751;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Culture Bénin</h1>
            <p>Vérification de votre adresse email</p>
        </div>
        <div class="content">
            <h2>Bonjour {{ $user->prenom }} !</h2>
            <p>Merci de vous être inscrit sur Culture Bénin. Pour finaliser votre inscription, veuillez vérifier votre
                adresse email en cliquant sur le bouton ci-dessous :</p>

            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ $verificationUrl }}" class="button">Vérifier mon email</a>
            </p>

            <p>Si vous n'avez pas créé de compte, vous pouvez ignorer cet email.</p>

            <hr style="margin: 30px 0;">
            <p style="font-size: 12px; color: #666;">
                Culture Bénin - Plateforme de préservation du patrimoine culturel<br>
                Cotonou, Bénin
            </p>
        </div>
    </div>
</body>

</html>
