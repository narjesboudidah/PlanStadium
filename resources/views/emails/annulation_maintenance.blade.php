<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Maintenance refusée</title>
</head>
<body>
    <h1>Maintenance refusée</h1>
    <p>Bonjour,</p>
    <p>Votre maintenance a été refusée. Voici les détails de la maintenance :</p>
    <ul>
        <li><strong>Date de début :</strong> {{ $maintenance->date_debut }}</li>
        <li><strong>Heure de début :</strong> {{ $maintenance->heure_debut }}</li>
        <li><strong>Date de fin :</strong> {{ $maintenance->date_fin }}</li>
        <li><strong>Heure de fin :</strong> {{ $maintenance->heure_fin }}</li>
        <li><strong>État :</strong> {{ $maintenance->etat }}</li>
        <li><strong>Description :</strong> {{ $maintenance->description }}</li>
        <li><strong>Nom stade :</strong> {{ $maintenance->stade_id }}</li>
    </ul>
</body>
</html>
