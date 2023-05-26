<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réservation refusée</title>
</head>
<body>
    <h1>Réservation refusée</h1>
    <p>Bonjour,</p>
    <p>Votre réservation a été refusée. Voici les détails de la réservation :</p>
    <ul>
        <li><strong>Date de début :</strong> {{ $reservation->date_debut }}</li>
        <li><strong>Heure de début :</strong> {{ $reservation->heure_debut }}</li>
        <li><strong>Date de fin :</strong> {{ $reservation->date_fin }}</li>
        <li><strong>Heure de fin :</strong> {{ $reservation->heure_fin }}</li>
        <li><strong>Type de réservation :</strong> {{ $reservation->type_reservation }}</li>
        <li><strong>Nom de l'événement :</strong> {{ $reservation->nom_event }}</li>
        <li><strong>Nom du stade :</strong> {{ $reservation->stade_id }}</li>
    </ul>
</body>
</html>
