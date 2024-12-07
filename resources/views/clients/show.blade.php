<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Client</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            font-size: 14px; /* Réduction de la taille de la police pour un design compact */
            color: #495057;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            position: relative;
            transition: all 0.3s ease;
            margin-left: auto;
            margin-right: auto;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #3c4f76;
        }

        p {
            font-size: 14px;
            line-height: 1.6;
            margin: 8px 0;
            color: #343a40;
        }

        .back-link {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .back-link i {
            margin-right: 5px;
        }

        .btn-warning {
            background-color: #ffbb33;
            border-color: #ffbb33;
            color: #fff;
            font-size: 14px;
            padding: 8px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        /* Style des cartes */
        .section-card {
            margin-top: 20px;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            background-color: #f9fbfd;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .section-card h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #495057;
            display: flex;
            align-items: center;
        }

        .section-card h2 i {
            margin-right: 8px;
            color: #17a2b8;
        }

        .section-details p {
            margin-bottom: 6px;
            font-size: 14px;
        }

        /* Réduire la taille des boutons */
        .btn-info {
            font-size: 14px;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
                padding: 15px;
                max-width: 90%;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }

            .back-link {
                font-size: 12px;
            }

            .section-card h2 {
                font-size: 16px;
            }

            .btn-info {
                padding: 6px 18px;
            }

            .btn-warning {
                padding: 6px 18px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('clients.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Retour à la liste
    </a>
    <h1>Détails Client</h1>

    <!-- Section Informations du client -->
    <div class="section-card">
        <h2><i class="fa-solid fa-user"></i> Informations du client</h2>
        <div class="section-details">
            <p><strong>Nom:</strong> {{ $client->nom }}</p>
            <p><strong>Prénom:</strong> {{ $client->prenom }}</p>
            <p><strong>Téléphone:</strong> {{ $client->telephone }}</p>
            <p><strong>Adresse:</strong> {{ $client->adresse }}</p>
            <p><strong>Genre:</strong> {{ $client->genre }}</p>
            <p><strong>CIN:</strong> {{ $client->cine }}</p>
        </div>
    </div>

    <!-- Section Détails de Visite -->
    <div class="section-card">
        <h2><i class="fa-solid fa-calendar-check"></i> Visites</h2>
        <div class="section-details">
            <p><strong>Première Visite:</strong> {{ $client->premiere_visite ? \Carbon\Carbon::parse($client->premiere_visite)->format('d/m/Y') : 'N/A' }}</p>
            <p><strong>Dernière Visite:</strong> {{ $client->derniere_visite ? \Carbon\Carbon::parse($client->derniere_visite)->format('d/m/Y') : 'N/A' }}</p>
            <p><strong>Nombre Visites:</strong> {{ $client->nombre_visite }}</p>
        </div>
    </div>

    <!-- Section Assurance -->
    <div class="section-card">
        <h2><i class="fa-solid fa-shield-alt"></i> Assurance</h2>
        <div class="section-details">
            <p><strong>Possède une assurance:</strong> {{ $client->typeassurance ? 'Oui' : 'Non' }}</p>
               @if ($client->typeassurance)
              <p><strong>Type d'Assurance:</strong> {{ $client->typeassurance }}</p>
              <p><strong>Bénéficiaire:</strong> {{ $client->beneficiary }}</p>
               @endif
        </div>
    </div>

    <div class="btn-container">
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Modifier</a>
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
