<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Vente</title>
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
            margin-top: 5px;
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
        #status {
            background-color: #e9ecef; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h1>Ajouter une Vente</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('ventes.index') }}" class="back-link">
                <i class="fas fa-arrow-left"> Retour a la liste </i>
            </a>
        </div>
        <form action="{{ route('ventes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_vente" class="required">N° Vente:</label>
                        <?php
                          $latestVente = \App\Models\Vente::latest()->first();
                          $nextId = $latestVente ? ($latestVente->id + 1) : 1;
                          $year = date('Y');
                          $numero_vente = sprintf('Digi-%02d-%d', $nextId, $year);
                        ?>
                        <input type="text" class="form-control" name="numero_vente" id="numero_vente" value="{{ $numero_vente }}" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_facture" class="required">Date de Vente:</label>
                        <input type="date" class="form-control" name="date_facture" id="date_facture" value="{{ old('date_facture') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="client_id" class="required">Client:</label>
                        <select class="form-control" name="client_id" id="client_id" required>
                            <option value="" selected disabled>Choisir un client</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->nom }} {{ $client->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status" class="required">Status:</label>
                        <select class="form-control" name="status" id="status" readonly required>
                            <option value="" disabled selected>status du client</option>
                            <option value="Réglé" {{ old('status') == 'Réglé' ? 'selected' : '' }}>Réglé</option>
                            <option value="Non Réglé" {{ old('status') == 'Non Réglé' ? 'selected' : '' }}>Non Réglé</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total" class="required">Total:</label>
                        <input type="number" class="form-control" name="total" id="total" value="{{ old('total') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="remise" class="required">Remise:</label>
                        <input type="number" class="form-control" name="remise" id="remise" value="{{ old('remise') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="avance" class="required">Avance:</label>
                        <input type="number" class="form-control" name="avance" id="avance" value="{{ old('avance') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reste_a_payer" class="required">Reste à Payer:</label>
                        <input type="number" class="form-control" name="reste_a_payer" id="reste_a_payer" value="{{ old('reste_a_payer') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="responsable" class="required">Responsable:</label>
                        <input type="text" name="responsable" id="responsable" class="form-control" value="{{ $user->name }}" readonly required style="max-width: 49%;">
                    </div>
                </div>                
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary" id="nextStep">Suivant</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function calculateResteAPayer() {
            const total = parseFloat(document.getElementById('total').value) || 0;
            const remise = parseFloat(document.getElementById('remise').value) || 0;
            const avance = parseFloat(document.getElementById('avance').value) || 0;
            const resteAPayer = total - remise - avance;
            document.getElementById('reste_a_payer').value = resteAPayer.toFixed(2);

            const statusField = document.getElementById('status');
            if (resteAPayer <= 0) {
                statusField.value = "Réglé";
            } else {
                statusField.value = "Non Réglé";
            }
        }

        document.getElementById('total').addEventListener('input', calculateResteAPayer);
        document.getElementById('remise').addEventListener('input', calculateResteAPayer);
        document.getElementById('avance').addEventListener('input', calculateResteAPayer);
    </script>
    <script>
        document.getElementById('nextStep').addEventListener('click', function() {
            const form = document.querySelector('form');
            form.action = "{{ route('ventes.save_and_continue') }}"; // Route vers la prochaine étape
            form.submit();
        });
    </script>
    
</body>
</html>
