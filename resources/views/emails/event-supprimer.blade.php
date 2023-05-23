<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Suppression d'événement</title>
</head>
<body>
    <h1>Suppression d'événement</h1>
    <p>Bonjour,</p>
    <p>Votre événement a été supprimé. Voici les détails :</p>
    <ul>
        <li><strong>Date de début :</strong> {{ $event->date_debut }}</li>
        <li><strong>Heure de début :</strong> {{ $event->heure_debut }}</li>
        <li><strong>Date de fin :</strong> {{ $event->date_fin }}</li>
        <li><strong>Heure de fin :</strong> {{ $event->heure_fin }}</li>
        <li><strong>Type d'événement :</strong> {{ $event->type_event }}</li>
        <li><strong>Nom de l'événement :</strong> {{ $event->nom_event }}</li>
        <li><strong>Type de match :</strong> {{ $event->type_match }}</li>
        <li><strong>ID du stade :</strong> {{ $event->stade_id }}</li>
        <li><strong>ID de l'équipe 1 :</strong> {{ $event->equipe1_id }}</li>
        <li><strong>ID de l'équipe 2 :</strong> {{ $event->equipe2_id }}</li>
        <li><strong>ID de l'administrateur fédéral :</strong> {{ $event->admin_fed_id }}</li>
        <li><strong>ID de l'administrateur d'équipe :</strong> {{ $event->admin_equipe_id }}</li>
        <!-- Ajoutez d'autres détails pertinents ici -->
    </ul>
    <p>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>
    <p>Merci.</p>
</body>
</html>