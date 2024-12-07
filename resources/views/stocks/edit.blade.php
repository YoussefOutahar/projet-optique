<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Stock</title>
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
            <h1>Modifier le stock</h1>
            <a href="{{ route('stocks.index') }}" class="back-link" style="text-align: center; font-weight: bold;"><i class="fa-solid fa-arrow-left"></i> Retour</a>
        </div>
        <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="produit_id" class="form-label">Référence du produit</label>
                    <select class="form-control" id="produit_id" name="produit_id" required>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" {{ $produit->id == $stock->produit_id ? 'selected' : '' }}>
                                {{ $produit->reference }} - {{ $produit->designation }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="categorie_id" class="form-label">Catégorie:</label>
                    <select class="form-control" id="categorie_id" name="categorie_id" required>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $categorie->id == $stock->produit->categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="stock_min" class="form-label">Stock Minimum</label>
                    <input type="number" class="form-control" id="stock_min" name="stock_min" value="{{ $stock->stock_min }}" required>
                </div>
                <div class="col-md-6">
                    <label for="stock_max" class="form-label">Stock Maximum</label>
                    <input type="number" class="form-control" id="stock_max" name="stock_max" value="{{ $stock->stock_max }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="stock_reel" class="form-label">Stock Réel</label>
                    <input type="number" class="form-control" id="stock_reel" name="stock_reel" value="{{ $stock->stock_reel }}" required>
                </div>
                <div class="col-md-6">
                    <label for="prix_vente" class="form-label">Prix de Vente</label>
                    <input type="number" class="form-control" id="prix_vente" name="prix_vente" value="{{ $stock->prix_vente }}" step="0.01" required>
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
