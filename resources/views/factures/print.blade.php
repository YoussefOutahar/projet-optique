<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - {{ optional(optional($facture->vente)->client)->nom }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        .container {
            padding: 30px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #007bff;
        }
        .header h2 {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 16px;
            color: #555;
        }
        .client-details p {
            font-size: 16px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }
        td {
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }
        .footer-message {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }
        .total-section td {
            font-size: 16px;
            padding: 10px;
        }
        .btn-primary {
            display: block;
            margin: 20px auto;
            width: 200px;
            font-size: 16px;
            padding: 10px;
        }
        @media print {
            .btn-primary {
                display: none;
            }
        }
        .total-section {
            font-weight: bold;
        }
        .total-section tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .total-section td {
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Facture</h2>
        <p>N° de Facture: {{ $facture->numero_facture }}</p>
    </div>

    <!-- Détails du client -->
    <div class="client-details mb-4">
        
        <p><strong>Client:</strong> {{ optional($facture->vente->client)->nom }} {{ optional($facture->vente->client)->prenom }}</p>
        <p><strong>Adresse:</strong> {{ optional($facture->vente->client)->adresse }}</p>
        <p><strong>Téléphone:</strong> {{ optional($facture->vente->client)->telephone }}</p>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHT = 0;
            @endphp
            @foreach($facture->vente->produits as $produit)
            <tr>
                <td>{{ $produit->nom }} ({{ optional($produit->categorie)->nom }})</td>
                <td>{{ $produit->pivot->quantite }}</td>
                <td>{{ number_format($produit->prix_vente, 2) }} DH</td>
                <td>{{ number_format($produit->prix_vente * $produit->pivot->quantite, 2) }} DH</td>
                @php
                    $totalHT += $produit->prix_vente * $produit->pivot->quantite;
                @endphp
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="total-section mt-4">
        <tr>
            <td colspan="3">Prix Total HT</td>
            <td>{{ number_format($totalHT, 2) }} DH</td>
        </tr>
        <tr>
            <td colspan="3">TVA 20%</td>
            <td>{{ number_format($totalHT * 0.20, 2) }} DH</td>
        </tr>
        <tr>
            <td colspan="3">Prix TTC</td>
            <td>{{ number_format($totalHT * 1.20, 2) }} DH</td>
        </tr>
        <tr>
            <td colspan="3">Remise</td>
            <td>{{ number_format($facture->vente->remise, 2) }} DH</td>
        </tr>
        <tr>
            <td colspan="3">Prix Total à Payer</td>
            <td>{{ number_format($totalHT * 1.20 - $facture->vente->remise, 2) }} DH</td>
        </tr>
    </table>

    <div class="footer-message">
        Merci pour votre visite 😊
    </div>
    
    <button onclick="window.print()" class="btn btn-primary">Imprimer la Facture</button>
</div>

</body>
</html>
