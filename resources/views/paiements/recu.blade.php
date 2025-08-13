<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de paiement</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { width: 700px; margin: 0 auto; }
        .header, .footer { border-top: 2px solid #000; margin-bottom: 20px; margin-top: 20px; }
        .title { font-size: 2em; font-weight: bold; margin-top: 30px; margin-bottom: 20px; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table th, .info-table td { text-align: left; padding: 4px 8px; }
        .info-table th { width: 180px; }
        .details { margin-top: 20px; margin-bottom: 20px; }
        .details th, .details td { padding: 5px 8px; }
        .details th { text-align: left; }
        .details td { font-weight: bold; }
        .footer-content { display: flex; justify-content: space-between; align-items: center; }
        .signature { margin-left: 500px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"></div>
        <div class="title">Reçu de payments</div>
        <table class="info-table">
            <tr>
                <th>Reçu no :</th>
                <td>{{ $salaire->id }}</td>
            </tr>
            <tr>
                <th>Date :</th>
                <td>{{ $salaire->date_paiement }}</td>
            </tr>
            <tr>
                <th>Matricule :</th>
                <td>{{ $salaire->employer->montant_journalier ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Nom de l'étudiant :</th>
                <td>{{ $salaire->employer->nom }} {{ $salaire->employer->prenom }}</td>
            </tr>
            <tr>
                <th>Montant</th>
                <td>{{ number_format($salaire->montant, 0, ',', ' ') }} Ar</td>
            </tr>
        </table>


        <div class="footer"></div>
        <div class="footer-content">
            <div>
                Heure : {{ now()->format('H:i:s') }}
            </div>
            <div>
                Date d'impression : {{ now()->format('Y-m-d') }}
            </div>
            <div class="signature">
                Signature
            </div>
        </div>
    </div>
</body>
</html>
