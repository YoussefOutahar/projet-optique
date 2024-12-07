<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Client</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Inclure Bootstrap CSS -->
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
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
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
            <h1>Ajouter un Client</h1>
            <!-- Affichage des erreurs -->
            @if ($errors->any())
             <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
           </ul>
            </div>
            @endif 
            <!-- Formulaire de création de client -->
            <a href="{{ route('clients.index') }}" class="black-link">
            <i class="fas fa-arrow-left"> Retour a la liste </i></a>
        </div>

        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom" class="required">Nom:</label>
                        <input type="text" class="form-control" name="nom" id="nom" value="{{ old('nom') }}" required oninput="this.value = this.value.toUpperCase();" pattern="[A-Z]+">
                        @if ($errors->has('nom'))
                            <div class="error-message">{{ $errors->first('nom') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prenom" class="required">Prénom:</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" value="{{ old('prenom') }}" required oninput="capitalizeFirstLetter(this)">
                        @if ($errors->has('prenom'))
                            <div class="error-message">{{ $errors->first('prenom') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cine" >CIN:</label>
                        <input type="text" class="form-control" name="cine" id="cine" value="{{ old('cine') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <select name="genre" id="genre" class="form-control">
                            <option value="" disabled selected>Choisir le genre</option>
                            <option value="M" {{ old('genre') == 'M' ? 'selected' : '' }}>Homme</option>
                            <option value="F" {{ old('genre') == 'F' ? 'selected' : '' }}>Femme</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telephone" class="required">Téléphone:</label>
                        <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone') }}" required>
                        @if ($errors->has('telephone'))
                            <div class="error-message">{{ $errors->first('telephone') }}</div>
                        @endif
                    </div>
                </div>                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" value="{{ old('adresse') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="premiere_visite" class="required">Première Visite:</label>
                        <input type="date" class="form-control" name="premiere_visite" id="premiere_visite" value="{{ old('premiere_visite') }}" required>
                        @if ($errors->has('premiere_visite'))
                            <div class="error-message">{{ $errors->first('premiere_visite') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Assurance:</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="has_assurance" value="non" id="assurance_non" {{ old('has_assurance', 'non') == 'non' ? 'checked' : '' }}> Non
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="has_assurance" value="oui" id="assurance_oui" {{ old('has_assurance') == 'oui' ? 'checked' : '' }}> Oui
                            </label>
                        </div>
                        
                        <div id="assurance_details" class="mt-2 {{ old('has_assurance') == 'oui' ? '' : 'hidden' }}">
                            <label for="beneficiary">Bénéficiaire:</label>
                            <select name="beneficiary" id="beneficiary" class="form-control">
                                <option value="lui_meme" {{ old('beneficiary') == 'lui_meme' ? 'selected' : '' }}>Lui-même</option>
                                <option value="conjoint" {{ old('beneficiary') == 'conjoint' ? 'selected' : '' }}>Conjoint</option>
                                <option value="enfant" {{ old('beneficiary') == 'enfant' ? 'selected' : '' }}>Enfant</option>
                            </select>
                        
                            <label for="typeassurance" class="mt-2">Sélectionnez l'assurance:</label>
                            <select name="typeassurance" id="typeassurance" class="form-control">
                                <option value="Assurance A" {{ old('typeassurance') == 'Assurance A' ? 'selected' : '' }}>Assurance A</option>
                                <option value="Assurance B" {{ old('typeassurance') == 'Assurance B' ? 'selected' : '' }}>Assurance B</option>
                                <option value="Assurance C" {{ old('typeassurance') == 'Assurance C' ? 'selected' : '' }}>Assurance C</option>
                            </select>
                        </div>
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

    <!-- Inclure Bootstrap JS et les dépendances Popper.js et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- JavaScript pour les transformations des champs Nom et Prénom -->
    <script>
        // Forcing only uppercase letters for the "Nom" field
        document.getElementById('nom').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Forcing the first letter of "Prénom" to be uppercase, the rest lowercase
        function capitalizeFirstLetter(input) {
            let value = input.value.toLowerCase(); // Convertir tout en minuscules
            input.value = value.charAt(0).toUpperCase() + value.slice(1); // Majuscule première lettre
        }

        // Toggle assurance fields
        document.getElementById('assurance_oui').addEventListener('change', function() {
            document.getElementById('assurance_details').classList.remove('hidden');
        });

        document.getElementById('assurance_non').addEventListener('change', function() {
            document.getElementById('assurance_details').classList.add('hidden');
        });
    </script>
</body>
</html>
