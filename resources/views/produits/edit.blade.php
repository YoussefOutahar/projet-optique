<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produit</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 700px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333333;
        }
        label {
            font-weight: bold;
            color: #555555;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            padding: 10px;
            font-size: 16px;
            width: auto;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 5px;
            color: #34269d;
            text-decoration: none;
        }
        .back-link i {
            margin-right: 8px;
        }
        .back-link:hover {
            text-decoration: underline;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h1>Modifier Produit</h1>
        <a href="{{ route('produits.index') }}" class="back-link" style="text-align: center; font-weight:bold">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </a>
    </div>
    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <label for="reference" class="form-label">Référence:</label>
                <input type="text" name="reference" id="reference" class="form-control" value="{{ $produit->reference }}" required>
            </div>
            <div class="col-md-6">
                <label for="marque" class="form-label">Marque:</label>
                <input type="text" name="marque" id="marque" class="form-control" value="{{ $produit->marque }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="categorie_id" class="form-label">Catégorie:</label>
                <select name="categorie_id" id="categorie_id" class="form-select" required>
                    <option value="" selected disabled> Choisir la catégorie</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="fournisseur_id" class="form-label">Fournisseur:</label>
                <select name="fournisseur_id" id="fournisseur_id" class="form-select">
                    <option value="" selected disabled>Sélectionner le fournisseur</option>
                    @foreach ($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}" {{ $produit->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->societe }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="quantite_stock" class="form-label">Qté en stock:</label>
                <input type="number" name="quantite_stock" id="quantite_stock" class="form-control" value="{{ $produit->quantite_stock }}" required>
            </div>
            <div class="col-md-6">
                <label for="prix_achat" class="form-label">Prix d’achat:</label>
                <input type="number" name="prix_achat" id="prix_achat" class="form-control" step="0.01" value="{{ $produit->prix_achat }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="prix_vente" class="form-label">Prix de vente:</label>
                <input type="number" name="prix_vente" id="prix_vente" class="form-control" step="0.01" min="0" value="{{ $produit->prix_vente }}" required>
            </div>
        </div>
        
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mt-3">Mettre à Jour</button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
