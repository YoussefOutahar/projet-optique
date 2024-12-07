<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Catégorie et Référence</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #343a40;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        .form-group label {
            font-weight: bold;
        }

        .add-field, .btn-primary {
            display: inline-block;
            margin: 15px 5px;
        }

        .add-field {
            color: #28a745;
            background-color: transparent;
            border: 2px solid #28a745;
            border-radius: 50px;
            padding: 10px 15px;
            font-weight: bold;
        }

        .add-field:hover {
            background-color: #28a745;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .remove-field {
            color: #dc3545;
            cursor: pointer;
            font-size: 1.2em;
            transition: color 0.3s ease;
        }

        .remove-field:hover {
            color: #c82333;
        }

        .product-group {
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e3e6ea;
            border-radius: 5px;
            background-color: #f7f9fb;
            position: relative;
        }

        .product-group .remove-field {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .product-group:hover {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
                padding: 15px;
            }

            .add-field {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Ajouter Catégorie et Référence</h1>
            <a href="{{ route('ventes.index') }}" class="btn btn-secondary">Retour</a>
        </div>

        <form action="{{ route('ventes.updateCategorieReference', $vente->id) }}" method="POST">
            @csrf
            <div id="products">
                <div class="product-group">
                    <div class="form-group">
                        <label for="produit_id">Produit:</label>
                        <select class="form-control" name="produit_id[]" required>
                            <option value="" disabled selected>Choisir un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->nom }} - Réf: {{ $produit->reference }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categorie_id">Catégorie:</label>
                        <select class="form-control" name="categorie_id[]" required>
                            <option value="" disabled selected>Choisir une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>                    

                    <div class="form-group">
                        <label for="quantite">Quantité:</label>
                        <input type="number" class="form-control" name="quantite[]" required>
                    </div>

                    <i class="fas fa-times remove-field" title="Supprimer ce produit"></i>
                </div>
            </div>

            <button type="button" class="add-field" id="add-product"><i class="fas fa-plus-circle"></i> Ajouter un produit</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addProductButton = document.getElementById('add-product');
            const productsContainer = document.getElementById('products');

            addProductButton.addEventListener('click', function() {
                const newProductGroup = document.createElement('div');
                newProductGroup.classList.add('product-group');
                newProductGroup.innerHTML = `
                    <div class="form-group">
                        <label for="produit_id">Produit:</label>
                        <select class="form-control" name="produit_id[]" required>
                            <option value="" disabled selected>Choisir un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->nom }} - Réf: {{ $produit->reference }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categorie_id">Catégorie:</label>
                        <select class="form-control" name="categorie_id[]" required>
                            <option value="" disabled selected>Choisir une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantite">Quantité:</label>
                        <input type="number" class="form-control" name="quantite[]" required>
                    </div>

                    <!-- Bouton pour supprimer ce groupe de produits -->
                    <i class="fas fa-times remove-field" title="Supprimer ce produit"></i>
                `;
                productsContainer.appendChild(newProductGroup);

                newProductGroup.querySelector('.remove-field').addEventListener('click', function() {
                    newProductGroup.remove();
                });
            });
        });
    </script>
</body>
</html>
