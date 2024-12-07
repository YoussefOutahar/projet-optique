<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Yeux pour la date {{ $date }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Historique des Yeux pour la date {{ $date }}</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>OD Sph</th>
                    <th>OD Cyl</th>
                    <th>OD Axis</th>
                    <th>OD ADD</th>
                    <th>OD Epi</th>
                    <th>OG Sph</th>
                    <th>OG Cyl</th>
                    <th>OG Axis</th>
                    <th>OG ADD</th>
                    <th>OG Epi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eyeDetails as $detail)
                <tr>
                    <td>{{ $detail->od_sphere }}</td>
                    <td>{{ $detail->od_cylinder }}</td>
                    <td>{{ $detail->od_axis }}</td>
                    <td>{{ $detail->od_add }}</td>
                    <td>{{ $detail->od_epi }}</td>
                    <td>{{ $detail->os_sphere }}</td>
                    <td>{{ $detail->os_cylinder }}</td>
                    <td>{{ $detail->os_axis }}</td>
                    <td>{{ $detail->os_add }}</td>
                    <td>{{ $detail->os_epi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
