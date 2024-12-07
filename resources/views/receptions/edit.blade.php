<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réception</title>
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
            <h1>Modifier Réception</h1>
            <a href="{{ route('receptions.index') }}" class="back-link" style="text-align: center; font-weight: bold;"><i class="fa-solid fa-arrow-left"></i> Retour</a>
        </div>
        <form action="{{ route('receptions.update', $reception->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="date_reception" class="form-label">Date de Réception:</label>
                    <input type="date" name="date_reception" id="date_reception" class="form-control" value="{{ $reception->date_reception }}" required>
                </div>
                <div class="col-md-6">
                    <label for="fournisseur_id" class="form-label">Fournisseur:</label>
                    <select name="fournisseur_id" id="fournisseur_id" class="form-control" required>
                        @foreach ($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {{ $reception->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->societe }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="categorie_id" class="form-label">Catégorie:</label>
                    <select name="categorie_id" id="categorie_id" class="form-control" required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $reception->categorie_id == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="quantite" class="form-label">Quantité:</label>
                    <input type="number" name="quantite" id="quantite" class="form-control" value="{{ $reception->quantite }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="reference" class="form-label">Référence:</label>
                    <input type="text" name="reference" id="reference" class="form-control" value="{{ $reception->reference }}" required>
                </div>
                <div class="col-md-6">
                    <label for="responsable" class="form-label">Responsable:</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" value="{{ $reception->responsable }}" required>
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
