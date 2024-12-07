<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Facture</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    .back-link{
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        display:flex;
        align-items: center;
        margin-top: 10px;
        text-decoration-line: none;
    }
    .back-link i{
        margin-right: 5px;
    }
    .back-link:hover {
        color: #0056b3;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
        <h1>Ajouter une Facture</h1>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <a href="{{ route('factures.index') }}" class="back-link">
        <i class="fas fa-arrow-left"> Retour a la liste </i>
        </a>
        </div>
        <form action="{{ route('factures.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_facture">N° Facture:</label>
                        <input type="text" class="form-control" name="numero_facture" id="numero_facture" value="{{ old('numero_facture') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_facture">Date de Facture:</label>
                        <input type="date" class="form-control" name="date_facture" id="date_facture" value="{{ old('date_facture') }}" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="client_id">Client:</label>
                        <select class="form-control" name="client_id" id="client_id" required>
                            <option value="" disabled selected>Choisir le client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom }} {{ $client->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="vente_id">N° Vente:</label>
                        <input type="text" class="form-control" name="vente_id" id="vente_id" readonly>
                    </div>
                </div>
                </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total">Total:</label>
                        <input type="number" class="form-control" name="total" id="total" value="{{ old('total') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="" disabled selected>Choisir le status</option>
                            <option value="Avance" {{ old('status') == 'Avance' ? 'selected' : '' }}>Avance</option>
                            <option value="Réglé" {{ old('status') == 'Réglé' ? 'selected' : '' }}>Réglé</option>
                            <option value="Non Réglé" {{ old('status') == 'Non Réglé' ? 'selected' : '' }}>Non Réglé</option>
                        </select>
                    </div>
                </div> 
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="remise">Remise:</label>
                        <input type="number" class="form-control" name="remise" id="remise" value="{{ old('remise') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="avance">Avance:</label>
                        <input type="number" class="form-control" name="avance" id="avance" value="{{ old('avance') }}">
                    </div>
                </div>
            </div>

                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reste_a_payer">Reste à Payer:</label>
                        <input type="number" class="form-control" name="reste_a_payer" id="reste_a_payer" value="{{ old('reste_a_payer') }}">
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
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    <script>
      document.getElementById('client_id').addEventListener('change', function () {
    var clientId = this.value;

    if (clientId) {
        fetch('/ventes/client/' + clientId)
            .then(response => response.json())
            .then(data => {
                if (data.vente) {
                    document.getElementById('vente_id').value = data.vente.id;
                    document.getElementById('total').value = data.vente.total;
                    
                    document.getElementById('status').value = data.vente.status;
                    document.getElementById('remise').value = data.vente.remise;
                    document.getElementById('avance').value = data.vente.avance;
                    document.getElementById('reste_a_payer').value = data.vente.reste_a_payer;
                } else {
                    
                    document.getElementById('vente_id').value = '';
                    document.getElementById('total').value = '';

                    document.getElementById('status').value = '';
                    document.getElementById('remise').value = '';
                    document.getElementById('avance').value = '';
                    document.getElementById('reste_a_payer').value = '';
                }
            })
            .catch(error => console.error('Erreur:', error));
    } else {
        document.getElementById('vente_id').value = '';
        document.getElementById('total').value = '';

        document.getElementById('status').value = '';
        document.getElementById('remise').value = '';
        document.getElementById('avance').value = '';
        document.getElementById('reste_a_payer').value = '';
    }
});
    </script>
</body>
</html>
