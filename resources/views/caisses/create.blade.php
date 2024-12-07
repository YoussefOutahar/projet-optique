<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Enregistrement Caisse</title>
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
            margin-right: 5px
        }
        .back-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h1>Ajouter un Enregistrement de Caisse</h1>
            <a href="{{ route('caisses.index') }}" class="back-link">
                <i class="fas fa-arrow-left"> Retour a la liste </i>
            </a>
        </div>
        <form action="{{ route('caisses.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facture_id">Facture:</label>
                        <select class="form-control" name="facture_id" id="facture_id" required onchange="updateDateFacture()">
                            <option value="">Sélectionnez une facture</option>
                            @foreach($factures as $facture)
                                <option value="{{ $facture->id }}" data-date="{{ $facture->date_facture }}">{{ $facture->numero_facture }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_facture">Date de Facture:</label>
                        <input type="date" class="form-control" name="date_facture" id="date_facture" readonly required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="" disabled selected>Choisir une status</option>
                            <option value="Avance">Avance</option>
                            <option value="Réglé">Réglé</option>
                            <option value="Non Réglé">Non Réglé</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="client_id">Client:</label>
                        <select class="form-control" name="client_id" id="client_id" required>
                            <option value="" disabled selected>Choisir le client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="paiement">Paiement:</label>
                        <input type="text" class="form-control" name="paiement" id="paiement" required>
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
        function updateDateFacture() {
            var factureSelect = document.getElementById('facture_id');
            var selectedOption = factureSelect.options[factureSelect.selectedIndex];
            var dateFactureInput = document.getElementById('date_facture');
            
            var dateFacture = selectedOption.getAttribute('data-date');
            dateFactureInput.value = dateFacture;
        }
    </script>
</body>
</html>
