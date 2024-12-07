<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Fournisseur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
            font-family: Arial, sans-serif;
        }
        .container {
            background: linear-gradient(145deg, #ffffff, #d1d9e6);
            padding: 30px;
            margin-top: 50px;
            border-radius: 12px;
            box-shadow: 5px 5px 15px #b0b8c4, -5px -5px 15px #ffffff;
            max-width: 600px;
            position: relative;
            transition: transform 0.3s;
        }
        .container:hover {
            transform: translateY(-10px);
        }
        h1 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #3c4f76;
            text-shadow: 1px 1px 2px #bec8d4;
        }
        p {
            font-size: 18px;
            line-height: 1.5;
            color: #495057;
            margin: 10px 0;
            text-shadow: 1px 1px 2px #d0d8e4;
        }
        .back-link {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .back-link i {
            margin-right: 5px;
        }
        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
                padding: 20px;
            }
            h1 {
                font-size: 22px;
            }
            p {
                font-size: 16px;
            }
            .back-link {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('fournisseurs.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
    <h1>Détails Fournisseur</h1>
    <p><strong>Société:</strong> {{ $fournisseur->societe }}</p>
    <p><strong>Responsable:</strong> {{ $fournisseur->responsable }}</p>
    <p><strong>Adresse:</strong> {{ $fournisseur->adresse }}</p>
    <p><strong>Ville:</strong> {{ $fournisseur->ville }}</p>
    <p><strong>Téléphone:</strong> {{ $fournisseur->telephone }}</p>
    <p><strong>Mobile:</strong> {{ $fournisseur->mobile }}</p>
    <p><strong>Email:</strong> {{ $fournisseur->email }}</p>
    <p><strong>ICE:</strong> {{ $fournisseur->ice }}</p>
    <p><strong>Observation:</strong> {{ $fournisseur->observation }}</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
