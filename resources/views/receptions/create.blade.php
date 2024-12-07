<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Réception</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            <h1>Ajouter une Réception</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('receptions.index') }}" class="back-link">
                <i class="fas fa-arrow-left"> Retour a la liste </i>
            </a>
        </div>
        <form action="{{ route('receptions.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fournisseur_id" class="required">Fournisseur:</label>
                        <select class="form-control" name="fournisseur_id" id="fournisseur_id" required>
                            <option value="" disabled selected>Sélectionnez un fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}">{{ $fournisseur->societe }}</option>
                            @endforeach
                        </select>
                    </div>                    
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_reception" class="required">Date de Réception:</label>
                        <input type="date" class="form-control" name="date_reception" id="date_reception" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categorie" class="required">Catégorie:</label>
                        <select class="form-control" name="categorie_id" id="categorie_id" required>
                            <option value="" disabled selected>Sélectionnez une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reference" class="required">Référence:</label>
                        <input type="text" class="form-control" name="reference" id="reference" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="responsable">Responsable:</label>
                        <input type="text" class="form-control" name="responsable" id="responsable" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantite" class="required">Quantité:</label>
                        <input type="number" class="form-control" name="quantite" id="quantite" required>
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

    <script>
        $(document).ready(function() {
            $('#fournisseur_id').select2({
                tags: true, 
                placeholder: "Sélectionnez ou tapez un fournisseur",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#produit_id').select2({
                placeholder: "Sélectionnez une catégorie de produit",
                allowClear: true
            });
        });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
