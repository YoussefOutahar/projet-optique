<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur les Yeux - {{ $client->nom }} {{ $client->prenom }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
            max-width: 900px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: #2c3e50;
        }
        label {
            font-weight: 500;
            color: #34495e;
        }
        .form-control {
            border-radius: 10px;
            box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            border-color: #3498db;
        }
        .btn-primary, .btn-info {
            width: 200px;
            padding: 12px;
            font-size: 18px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
            color: #fff;
        }
        .btn-info {
            background-color: #2ecc71;
            border: none;
            color: #fff;
        }
        .btn-primary:hover, .btn-info:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
        }
        .top-back-link {
            margin-bottom: 30px;
        }
        .top-back-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        .top-back-link a:hover {
            text-decoration: underline;
        }
        .top-back-link i {
            margin-right: 10px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: center;
        }
        th {
            background-color: #ecf0f1;
            font-weight: 600;
        }
        td input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
        }
        /* Styles pour aligner les boutons sur une même ligne */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Lien de retour en haut à gauche avec icône -->
        <div class="top-back-link">
            <a href="{{ route('clients.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Retour à la liste des clients
            </a>
        </div>

        <h2>Modifications des détails des yeux par prescription</h2>
        <form action="{{ route('clients.updateEyes', $client->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="vision"><strong>Vision :</strong></label>
                <select name="vision" id="vision" class="form-control">
                    <option value="" disabled selected>Saisir le type de vision</option>
                    <option value="Séparé">Séparé</option>
                    <option value="VL">VL</option>
                    <option value="VP">VP</option>
                </select>
            </div>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Sph</th>
                        <th>Cyl</th>
                        <th>Axe</th>
                        <th>ADD</th>
                        <th>Epi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>OD</td>
                        <td><input type="text" name="od_sphere" value="{{ old('od_sphere', $client->od_sphere) }}" class="form-control"></td>
                        <td><input type="text" name="od_cylinder" value="{{ old('od_cylinder', $client->od_cylinder) }}" class="form-control"></td>
                        <td><input type="text" name="od_axis" value="{{ old('od_axis', $client->od_axis) }}" class="form-control"></td>
                        <td><input type="text" name="od_add" value="{{ old('od_add', $client->od_add) }}" class="form-control"></td>
                        <td><input type="text" name="od_epi" value="{{ old('od_epi', $client->od_epi) }}" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>OG</td>
                        <td><input type="text" name="os_sphere" value="{{ old('os_sphere', $client->os_sphere) }}" class="form-control"></td>
                        <td><input type="text" name="os_cylinder" value="{{ old('os_cylinder', $client->os_cylinder) }}" class="form-control"></td>
                        <td><input type="text" name="os_axis" value="{{ old('os_axis', $client->os_axis) }}" class="form-control"></td>
                        <td><input type="text" name="os_add" value="{{ old('os_add', $client->os_add) }}" class="form-control"></td>
                        <td><input type="text" name="os_epi" value="{{ old('os_epi', $client->os_epi) }}" class="form-control"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Alignement des boutons "Enregistrer" et "Détails" sur une même ligne -->
            <div class="button-group">
                <a href="{{ route('clients.eyeDetails', $client->id) }}" class="btn btn-info">Détails</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
