<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Fournisseur</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }
        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 0;
            list-style-type: none;
        }
        .alert-danger li {
            display: flex;
            align-items: center;
        }
        .alert-danger i {
            margin-right: 10px;
        }
        .back-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: flex;
            align-items: center;
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
        color: #dc3545; /* Rouge typique pour les messages d'erreur */
        font-size: 0.9em; /* Taille de texte légèrement réduite */
        margin-top: 5px; /* Un petit espace au-dessus du message */
        margin-left: 2px; /* Un petit espace à gauche pour l'alignement */
       }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h1>Ajouter un Fournisseur</h1>
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

            <a href="{{ route('fournisseurs.index') }}" class="back-link">
                <i class="fas fa-arrow-left"> Retour a la liste </i> 
            </a>
        </div>

        <form action="{{ route('fournisseurs.store') }}" method="POST" id="fournisseurForm">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="societe" class="required">Société:</label>
                        <input type="text" class="form-control" name="societe" id="societe" value="{{ old('societe') }}" required>
                        @if ($errors->has('societe'))
                            <div class="error-message">{{ $errors->first('societe') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="responsable" class="required">Responsable:</label>
                        <input type="text" class="form-control" name="responsable" id="responsable" value="{{ Auth::user()->name }}" readonly required>
                        @if ($errors->has('responsable'))
                            <div class="error-message">{{ $errors->first('responsable') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="adresse" class="required">Adresse:</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" value="{{ old('adresse') }}" required>
                        @if ($errors->has('adresse'))
                            <div class="error-message">{{ $errors->first('adresse') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <select class="form-control" name="ville" id="ville" required>
                            <option value="" disabled selected>Choisir une ville</option>
                            <option value="Errachidia" {{ old('ville') == 'Errachidia' ? 'selected' : '' }}>Errachidia</option>
                            <option value="Casablanca" {{ old('ville') == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                            <option value="Rabat" {{ old('ville') == 'Rabat' ? 'selected' : '' }}>Rabat</option>
                            <option value="Fès" {{ old('ville') == 'Fès' ? 'selected' : '' }}>Fès</option>
                            <option value="Marrakech" {{ old('ville') == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
                            <option value="Tanger" {{ old('ville') == 'Tanger' ? 'selected' : '' }}>Tanger</option>
                            <option value="Agadir" {{ old('ville') == 'Agadir' ? 'selected' : '' }}>Agadir</option>
                            <option value="Oujda" {{ old('ville') == 'Oujda' ? 'selected' : '' }}>Oujda</option>
                        </select>
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telephone" class="required">Téléphone:</label>
                        <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone') }}" pattern="^((\+212|0)[5-7])\d{8}$" title="Veuillez entrer un numéro de téléphone valide commençant par +212, 05, 06 ou 07." required>
                        @if ($errors->has('telephone'))
                            <div class="error-message">{{ $errors->first('telephone') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" pattern="^((\+212|0)[5-7])\d{8}$" title="Veuillez entrer un numéro de téléphone valide commençant par +212, 05, 06 ou 07." required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Veuillez entrer une adresse email valide." required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ice" class="required">ICE:</label>
                        <input type="text" class="form-control" name="ice" id="ice" pattern="\d{15}" title="Veuillez entrer un ICE valide composé de 15 chiffres." required>
                        @if ($errors->has('ice'))
                            <div class="error-message">{{ $errors->first('ice') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="observation">Observation:</label>
                        <textarea class="form-control" name="observation" id="observation">{{ old('observation') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                $('#fournisseurForm').on('submit', function(e) {
                    e.preventDefault(); // Empêche l'envoi normal du formulaire
    
                    // Nettoyer les messages d'erreur précédents
                    $('.error-message').remove();
    
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function(response) {
                            // Afficher un message de succès
                            alert('Fournisseur créé avec succès.');
                            // Rediriger vers la liste des fournisseurs
                            window.location.href = '{{ route("fournisseurs.index") }}';
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) { // Erreur de validation
                                var errors = xhr.responseJSON.errors;
                                // Parcourir les erreurs et les afficher sous les champs correspondants
                                $.each(errors, function(key, value) {
                                    var input = $('#'+key);
                                    if(input.length) {
                                        input.after('<div class="error-message">'+ value[0] +'</div>');
                                    }
                                });
                            } else {
                                // Gérer d'autres types d'erreurs si nécessaire
                                alert('Une erreur est survenue. Veuillez réessayer plus tard.');
                            }
                        }
                    });
                });
            });
        </script>
    </div>

    <!-- Inclure Bootstrap JS et les dépendances Popper.js et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   
    
</body>
</html>
