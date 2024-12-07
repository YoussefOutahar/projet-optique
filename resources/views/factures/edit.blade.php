<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Facture</title>
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
            <h1>Modifier Facture</h1>
            <a href="{{ route('factures.index') }}" class="back-link" style="text-align: center; font-weight: bold;"><i class="fa-solid fa-arrow-left"></i> Retour</a>
        </div>
        <form action="{{ route('factures.update', $facture->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="numero_facture" class="form-label">Numéro de Facture:</label>
                    <input type="text" name="numero_facture" id="numero_facture" class="form-control" value="{{ old('numero_facture', $facture->numero_facture) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="date_facture" class="form-label">Date de Facture:</label>
                    <input type="date" name="date_facture" id="date_facture" class="form-control" value="{{ old('date_facture', $facture->date_facture) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="client_id" class="form-label">Client:</label>
                    <select name="client_id" id="client_id" class="form-control" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $facture->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }} {{ $client->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Avance" {{ old('status', $facture->status) == 'Avance' ? 'selected' : '' }}>Avance</option>
                        <option value="Réglé" {{ old('status', $facture->status) == 'Réglé' ? 'selected' : '' }}>Réglé</option>
                        <option value="Non Réglé" {{ old('status', $facture->status) == 'Non Réglé' ? 'selected' : '' }}>Non Réglé</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="total" class="form-label">Total:</label>
                    <input type="number" name="total" id="total" class="form-control" value="{{ old('total', $facture->total) }}" step="0.01" required>
                </div>
                <div class="col-md-6">
                    <label for="remise" class="form-label">Remise:</label>
                    <input type="number" name="remise" id="remise" class="form-control" value="{{ old('remise', $facture->remise) }}" step="0.01">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="avance" class="form-label">Avance:</label>
                    <input type="number" name="avance" id="avance" class="form-control" value="{{ old('avance', $facture->avance) }}" step="0.01">
                </div>
                <div class="col-md-6">
                    <label for="reste_a_payer" class="form-label">Reste à Payer:</label>
                    <input type="number" name="reste_a_payer" id="reste_a_payer" class="form-control" value="{{ old('reste_a_payer', $facture->reste_a_payer) }}" step="0.01">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="responsable" class="form-label">Responsable:</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" value="{{ old('responsable', $facture->responsable) }}" required>
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
