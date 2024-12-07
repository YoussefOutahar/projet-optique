<!-- resources/views/clients/eyes.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Détails des Yeux</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier les Détails des Yeux</h1>
        <form action="{{ route('clients.updateEyes', $client->id) }}" method="POST">
            @csrf

            <h3>Œil Droit (OD)</h3>
            <div class="row">
                <div class="col-md-4">
                    <label for="od_sphere">Sphère (Sph):</label>
                    <input type="text" name="od_sphere" id="od_sphere" class="form-control" value="{{ old('od_sphere', $client->od_sphere) }}">
                </div>
                <div class="col-md-4">
                    <label for="od_cylinder">Cylindre (Cyl):</label>
                    <input type="text" name="od_cylinder" id="od_cylinder" class="form-control" value="{{ old('od_cylinder', $client->od_cylinder) }}">
                </div>
                <div class="col-md-4">
                    <label for="od_axis">Axe:</label>
                    <input type="text" name="od_axis" id="od_axis" class="form-control" value="{{ old('od_axis', $client->od_axis) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="od_add">ADD:</label>
                    <input type="text" name="od_add" id="od_add" class="form-control" value="{{ old('od_add', $client->od_add) }}">
                </div>
                <div class="col-md-4">
                    <label for="od_epi">Épi:</label>
                    <input type="text" name="od_epi" id="od_epi" class="form-control" value="{{ old('od_epi', $client->od_epi) }}">
                </div>
            </div>

            <h3>Œil Gauche (OG)</h3>
            <div class="row">
                <div class="col-md-4">
                    <label for="os_sphere">Sphère (Sph):</label>
                    <input type="text" name="os_sphere" id="os_sphere" class="form-control" value="{{ old('os_sphere', $client->os_sphere) }}">
                </div>
                <div class="col-md-4">
                    <label for="os_cylinder">Cylindre (Cyl):</label>
                    <input type="text" name="os_cylinder" id="os_cylinder" class="form-control" value="{{ old('os_cylinder', $client->os_cylinder) }}">
                </div>
                <div class="col-md-4">
                    <label for="os_axis">Axe:</label>
                    <input type="text" name="os_axis" id="os_axis" class="form-control" value="{{ old('os_axis', $client->os_axis) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="os_add">ADD:</label>
                    <input type="text" name="os_add" id="os_add" class="form-control" value="{{ old('os_add', $client->os_add) }}">
                </div>
                <div class="col-md-4">
                    <label for="os_epi">Épi:</label>
                    <input type="text" name="os_epi" id="os_epi" class="form-control" value="{{ old('os_epi', $client->os_epi) }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Mettre à Jour</button>
        </form>
    </div>
</body>
</html>
