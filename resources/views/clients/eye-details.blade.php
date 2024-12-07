<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Yeux - {{ $client->nom }} {{ $client->prenom }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
            max-width: 1000px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }
        h2 {
            font-weight: 600;
            color: #34495e;
            margin-bottom: 40px;
        }
        h4.date-header {
            font-size: 1.3em;
            font-weight: bold;
            color: #007bff;
            margin-top: 30px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        table:hover {
            transform: scale(1.02);
        }
        th, td {
            padding: 15px;
            border: 1px solid #dddddd;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        td {
            background-color: #ffffff;
        }
        .back-link {
            color: #007bff;
            text-decoration: none;
            margin-bottom: 30px;
            display: inline-block;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .top-back-link i {
            margin-right: 8px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Lien de retour en haut à gauche avec icône -->
        <div class="top-back-link">
            <a href="{{ route('clients.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Retour à la liste des clients
            </a>
        </div>

        <h2>Historique des yeux - {{ $client->nom }} {{ $client->prenom }}</h2>

        <!-- Parcourir chaque groupe de détails des yeux, triés par date -->
        @foreach($eyeDetailsHistory as $date => $eyeDetails)
            <h4 class="date-header">Détails enregistrés le : {{ $date }}</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Sph</th>
                        <th>Cyl</th>
                        <th>Axe</th>
                        <th>ADD</th>
                        <th>Epi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eyeDetails as $eyeDetail)
                        <tr>
                            <td>OD</td>
                            <td>{{ $eyeDetail->od_sphere }}</td>
                            <td>{{ $eyeDetail->od_cylinder }}</td>
                            <td>{{ $eyeDetail->od_axis }}</td>
                            <td>{{ $eyeDetail->od_add }}</td>
                            <td>{{ $eyeDetail->od_epi }}</td>
                        </tr>
                        <tr>
                            <td>OG</td>
                            <td>{{ $eyeDetail->os_sphere }}</td>
                            <td>{{ $eyeDetail->os_cylinder }}</td>
                            <td>{{ $eyeDetail->os_axis }}</td>
                            <td>{{ $eyeDetail->os_add }}</td>
                            <td>{{ $eyeDetail->os_epi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
