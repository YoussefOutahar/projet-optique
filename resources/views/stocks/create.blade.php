<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Stock</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .back-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: flex;
            align-items: center;
            margin-top: 10px;
            text-decoration-line: none;
        }
        .back-link i {
            margin-right: 5px;
        }
        .back-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }
        .alert-stock-low {
            color: red;
            font-weight: bold;
            display: none;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            display: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h1>Créer un nouveau stock</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <a href="{{ route('stocks.index') }}" class="back-link">
              <i class="fas fa-arrow-left"> Retour à la liste </i>
            </a>
        </div>

        <form id="stockForm" action="{{ route('stocks.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="produit_id">Référence de produit</label>
                        <select class="form-control" id="produit_id" name="produit_id" required>
                            <option value="">Sélectionnez un produit</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" 
                                    data-reference="{{ $produit->reference }}" 
                                    data-marque="{{ $produit->marque }}" 
                                    data-categorie="{{ $produit->categorie ? $produit->categorie->nom : 'Non catégorisé' }}"
                                    data-prix-vente="{{ $produit->prix_vente }}">
                                    {{ $produit->reference }} - {{ $produit->marque }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reference">Référence</label>
                        <input type="text" class="form-control" id="reference" name="reference" readonly>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marque">Marque</label>
                        <input type="text" class="form-control" id="marque" name="marque" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <input type="text" class="form-control" id="categorie" name="categorie" readonly>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stock_minimum">Stock Minimum</label>
                        <input type="number" class="form-control" id="stock_minimum" name="stock_min" value="{{ old('stock_min', $stockMinimum) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stock_maximum">Stock Maximum</label>
                        <input type="number" class="form-control" id="stock_maximum" name="stock_max" value="{{ old('stock_max', $stockMaximum) }}" required>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stock_reel">Stock Réel</label>
                        <input type="number" class="form-control" id="stock_reel" name="stock_reel" required>
                        <div class="alert-stock-low">Attention : Le stock est inférieur du minimum !</div>
                        <div class="error-message" id="error-stock-reel">Erreur : Le stock réel ne peut pas dépasser le stock maximum !</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prix_vente">Prix de Vente</label>
                        <input type="number" class="form-control" id="prix_vente" name="prix_vente" step="0.01" readonly required> 
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('produit_id').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('reference').value = selectedOption.getAttribute('data-reference');
            document.getElementById('marque').value = selectedOption.getAttribute('data-marque');
            document.getElementById('categorie').value = selectedOption.getAttribute('data-categorie');
            document.getElementById('prix_vente').value = selectedOption.getAttribute('data-prix-vente');
        });

        // Validation du stock réel
        document.getElementById('stock_reel').addEventListener('input', function () {
            var stockMinimum = parseFloat(document.getElementById('stock_minimum').value);
            var stockMaximum = parseFloat(document.getElementById('stock_maximum').value);
            var stockReel = parseFloat(this.value);
            var alertBox = document.querySelector('.alert-stock-low');
            var errorMessage = document.getElementById('error-stock-reel');

            if (stockReel <= stockMinimum) {
                alertBox.style.display = 'block';  
            } else {
                alertBox.style.display = 'none';  
            }

            if (stockReel > stockMaximum) {
                errorMessage.style.display = 'block'; 
            } else {
                errorMessage.style.display = 'none'; 
            }
        });
        document.getElementById('stockForm').addEventListener('submit', function (event) {
            var stockMaximum = parseFloat(document.getElementById('stock_maximum').value);
            var stockReel = parseFloat(document.getElementById('stock_reel').value);
            var errorMessage = document.getElementById('error-stock-reel');

            if (stockReel > stockMaximum) {
                event.preventDefault();  
                errorMessage.style.display = 'block'; 
            }
        });
    </script>

</body>
</html>
