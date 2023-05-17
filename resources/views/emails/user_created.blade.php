<!-- resources/views/emails/user_created.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Création de compte</title>
</head>
<body>
    <h1>Votre compte a été créé avec succès</h1>
    <p>Adresse e-mail : {{ $email }}</p>
    <p>Mot de passe : {{ $password }}</p>
</body>
</html>
