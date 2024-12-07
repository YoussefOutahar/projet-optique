<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Fournisseur</title>
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
    <h1>Modifier Fournisseur</h1>
    <a href="{{ route('fournisseurs.index') }}" class="back-link" style="text-align: center; font-weight:bold"><i class="fa-solid fa-arrow-left"></i> Retour</a>
    </div>
    <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <label for="societe" class="form-label">Société:</label>
                <input type="text" name="societe" id="societe" class="form-control" value="{{ $fournisseur->societe }}" required>
            </div>
            <div class="col-md-6">
                <label for="responsable" class="form-label">Responsable:</label>
                <input type="text" name="responsable" id="responsable" class="form-control" value="{{ $fournisseur->responsable }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="adresse" class="form-label">Adresse:</label>
                <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $fournisseur->adresse }}" required>
            </div>
            <div class="col-md-6">
                <label for="ville" class="form-label">Ville:</label>
                <input type="text" name="ville" id="ville" class="form-control" value="{{ $fournisseur->ville }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="telephone" class="form-label">Téléphone:</label>
                <input type="text" name="telephone" id="telephone" class="form-control" value="{{ $fournisseur->telephone }}" required>
            </div>
            <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $fournisseur->mobile }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $fournisseur->email }}">
            </div>
            <div class="col-md-6">
                <label for="ice" class="form-label">ICE:</label>
                <input type="text" name="ice" id="ice" class="form-control" value="{{ $fournisseur->ice }}">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="observation" class="form-label">Observation:</label>
                <textarea name="observation" id="observation" class="form-control" rows="3">{{ $fournisseur->observation }}</textarea>
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
