<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>Réinitialisation de votre mot de passe</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
">

    <div style="
        max-width: 600px;
        margin: 40px auto;
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
    ">

        <h1 style="
            color: #198754;
            margin-bottom: 25px;
        ">
            L'instant Thé
        </h1>

        <h2>
            Mot de passe oublié ?
        </h2>

        <p style="
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        ">
            Bonjour,
        </p>

        <p style="
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        ">
            Vous avez demandé la réinitialisation
            de votre mot de passe.
        </p>

        <p style="
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        ">
            Cliquez sur le bouton ci-dessous pour
            choisir un nouveau mot de passe.
        </p>

        <p style="margin: 30px 0;">

            <a
                href="{{ $lien }}"
                style="
                    display: inline-block;
                    padding: 14px 25px;
                    background-color: #198754;
                    color: white;
                    text-decoration: none;
                    border-radius: 6px;
                    font-size: 16px;
                "
            >
                Réinitialiser mon mot de passe
            </a>

        </p>

        <p style="
            color: #777;
            font-size: 14px;
        ">
            Ce lien est valable pendant 60 minutes.
        </p>

        <p style="
            color: #777;
            font-size: 14px;
        ">
            Si vous n'avez pas demandé cette
            réinitialisation, vous pouvez ignorer cet e-mail.
        </p>

        <hr style="
            border: none;
            border-top: 1px solid #ddd;
            margin: 30px 0;
        ">

        <p style="
            color: #999;
            font-size: 13px;
        ">
            L'équipe L'instant Thé
        </p>

    </div>

</body>
</html>

