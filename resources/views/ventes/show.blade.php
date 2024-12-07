<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Vente</title>
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
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            font-size: 16px;
            font-weight: bold;
            padding: 8px 30px;
            border-radius: 20px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            margin-top: 1px;
            display: inline-block;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
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
    <a href="{{ route('ventes.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Retour à la liste
    </a>
    <h1>Détails Vente</h1>
    <p><strong>Numéro de Vente:</strong> {{ $vente->numero_vente }}</p>
    <p><strong>Date de Vente:</strong> {{ $vente->date_facture->format('d/m/Y') }}</p>
    <p><strong>Client:</strong> {{ $vente->client ? $vente->client->nom . ' ' . $vente->client->prenom : 'N/A' }}</p>
    <p><strong>Status:</strong> {{ $vente->status }}</p>
    <p><strong>Total:</strong> {{ $vente->total }} DH</p>
    <p><strong>Remise:</strong> {{ $vente->remise }} DH</p>
    <p><strong>Avance:</strong> {{ $vente->avance }} DH</p>
    <p><strong>Reste à Payer:</strong> {{ $vente->reste_a_payer }} DH</p>
    <p><strong>Responsable:</strong> {{ $vente->responsable }}</p>

    <h2>Produits Vendus</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vente->produits as $produit)
            <tr>
                <td>{{ $produit->nom }} - Réf: {{ $produit->reference }}</td>
                <td>{{ $produit->pivot->categorie_id ? App\Models\Categorie::find($produit->pivot->categorie_id)->nom : 'N/A' }}</td>
                <td>{{ $produit->pivot->quantite }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>    

    <div class="btn-container">
        <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-warning">Modifier</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
