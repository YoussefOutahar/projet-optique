<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Produit</title>
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
        .input-group-text {
            background-color: #d7e8f9;
            color: rgb(8, 8, 98);
            border: 1px solid #b3b3ba;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .required::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h1>Ajouter un Produit</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <a href="{{ route('produits.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <form id="produitForm" action="{{ route('produits.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reference" class="required">Référence:</label>
                        <input type="text" class="form-control" name="reference" id="reference" required>
                    </div>
                    @if ($errors->has('reference'))
                     <div class="error-message">{{ $errors->first('reference') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marque" class="required">Marque:</label>
                        <input type="text" class="form-control" name="marque" id="marque" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categorie" class="required">Catégorie:</label>
                        <select name="categorie_id" id="categorie" class="form-control" required>
                            <option value="" disabled selected>Choisir la catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('categorie_id'))
                            <div class="error-message">{{ $errors->first('categorie_id') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fournisseur_id" class="required">Fournisseur:</label>
                        <select name="fournisseur_id" id="fournisseur_id" class="form-control">
                            <option value="" disabled selected>Choisir le fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}">{{ $fournisseur->societe }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantite_stock" class="required">Qté en stock:</label>
                        <input type="number" class="form-control" name="quantite_stock" id="quantite_stock" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prix_achat" class="required">Prix d’achat :</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="prix_achat" id="prix_achat" step="0.01" required>
                            <div class="input-group-append">
                                <span class="input-group-text">DH</span>
                            </div>
                        </div>
                        <div id="prixAchatError" class="error-message"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prix_vente" class="required">Prix de vente :</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="prix_vente" id="prix_vente" step="0.01" required>
                            @if ($errors->has('prix_vente'))
                            <div class="error-message">{{ $errors->first('prix_vente') }}</div>
                            @endif
                            <div class="input-group-append">
                                <span class="input-group-text">DH</span>
                            </div>
                        </div>
                        <div id="prixVenteError" class="error-message"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('produitForm').addEventListener('submit', function(event) {
    const prixAchat = parseFloat(document.getElementById('prix_achat').value);
    const prixVente = parseFloat(document.getElementById('prix_vente').value);

    console.log('Prix d\'achat:', prixAchat);
    console.log('Prix de vente:', prixVente);

    let valid = true;

    if (prixVente <= prixAchat) {
        document.getElementById('prixVenteError').textContent = 'Le prix de vente doit être supérieur au prix d\'achat.';
        valid = false;
    } else {
        document.getElementById('prixVenteError').textContent = '';
    }

    if (!valid) {
        event.preventDefault(); 
    }
});

    </script>
</body>
</html>
