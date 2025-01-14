<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Liste des Employés</h1>
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Département</th>
                <th>Date de naissance</th>
                <th>Sexe</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employers as $employer)
                <tr>
                    <td>
                        @if ($employer->photos)
                            <img src="{{ public_path('storage/' . $employer->photos) }}" alt="Photo de {{ $employer->nom }}" class="photo">
                        @else
                            <img src="{{ public_path('images/default-photo.png') }}" alt="Aucune photo" class="photo">
                        @endif
                    </td>
                    <td>{{ $employer->nom }}</td>
                    <td>{{ $employer->prenom }}</td>
                    <td>{{ $employer->departement->name }}</td>
                    <td>{{ $employer->date_naissance }}</td>
                    <td>{{ $employer->sexe }}</td>
                    <td>{{ $employer->email }}</td>
                    <td>{{ $employer->contact }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
