<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client</title>
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
        .hidden {
            display: none;
        }
        .radio-inline {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h1>Modifier Client</h1>
            <a href="{{ route('clients.index') }}" class="back-link" style="text-align: center; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
        </div>
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom:</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $client->nom }}" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $client->prenom }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="cine" class="form-label">CIN:</label>
                    <input type="text" name="cine" id="cine" class="form-control" value="{{ $client->cine }}" required>
                </div>
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre:</label>
                    <select name="genre" id="genre" class="form-control">
                        <option value="" disabled>Choisir le genre</option>
                        <option value="M" {{ $client->genre == 'M' ? 'selected' : '' }}>Homme</option>
                        <option value="F" {{ $client->genre == 'F' ? 'selected' : '' }}>Femme</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Téléphone:</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" value="{{ $client->telephone }}" required>
                </div>
                <div class="col-md-6">
                    <label for="adresse" class="form-label">Adresse:</label>
                    <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $client->adresse }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="premiere_visite" class="form-label">Première Visite:</label>
                    <input type="date" name="premiere_visite" id="premiere_visite" class="form-control" value="{{ $client->premiere_visite }}">
                </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Assurance:</label>
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="has_assurance" value="non" id="assurance_non" {{ !$client->typeassurance ? 'checked' : '' }}> Non
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="has_assurance" value="oui" id="assurance_oui" {{ $client->typeassurance ? 'checked' : '' }}> Oui
                                </label>
                            </div>
                            <div id="assurance_select" class="mt-2 {{ $client->typeassurance ? '' : 'hidden' }}">
                                <label for="beneficiary">Bénéficiaire:</label>
                                <select name="beneficiary" id="beneficiary" class="form-control">
                                    <option value="conjoint" {{ $client->beneficiary == 'conjoint' ? 'selected' : '' }}>Conjoint</option>
                                    <option value="lui_meme" {{ $client->beneficiary == 'lui_meme' ? 'selected' : '' }}>Lui-même</option>
                                    <option value="enfant" {{ $client->beneficiary == 'enfant' ? 'selected' : '' }}>Enfant</option>
                                </select>
                        
                                <label for="typeassurance" class="mt-2">Sélectionnez l'assurance:</label>
                                <select name="typeassurance" id="typeassurance" class="form-control">
                                    <option value="Assurance A" {{ $client->typeassurance == 'Assurance A' ? 'selected' : '' }}>Assurance A</option>
                                    <option value="Assurance B" {{ $client->typeassurance == 'Assurance B' ? 'selected' : '' }}>Assurance B</option>
                                    <option value="Assurance C" {{ $client->typeassurance == 'Assurance C' ? 'selected' : '' }}>Assurance C</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>

            
            <div class="row">
                <div class="col-md-6">
                    <label for="nombre_visite" class="form-label">Nombre Visite:</label>
                    <input type="number" name="nombre_visite" id="nombre_visite" class="form-control" value="{{ $client->nombre_visite }}">
                </div>
                
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Mettre à Jour</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
         document.getElementById('assurance_oui').addEventListener('change', function() {
        document.getElementById('assurance_select').classList.remove('hidden');
    });

    document.getElementById('assurance_non').addEventListener('change', function() {
        document.getElementById('assurance_select').classList.add('hidden');
    });
        // Show or hide the assurance details on page load based on existing data
        if (document.getElementById('assurance_oui').checked) {
            document.getElementById('assurance_details').classList.remove('hidden');
        } else {
            document.getElementById('assurance_details').classList.add('hidden');
        }
    </script>
</body>
</html>
