<!DOCTYPE html>
<html>
<head>
    <title>Liste des Caisses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .filter-form h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #3498db;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .table {
            margin-top: 20px;
        }
        .action-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .action-icons a, .action-icons form {
            display: inline-block;
            background: none;
            border: none;
            padding: 0;
        }
        .action-icons i {
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .action-icons .fa-eye {
            color: #17a2b8; 
        }
        .action-icons .fa-edit {
            color: #ffc107; 
        }
        .action-icons .fa-trash-alt {
            color: #dc3545; 
        }
        .action-icons i:hover {
            color: #0056b3;
        }
        .delete-icon:hover {
            color: #d9534f;
        }
        .no-data-message {
            margin-top: 20px;
            color: #6c757d;
            font-size: 1.2rem;
            text-align: center;
        }
    </style>
</head>
<body>
@include('layouts.layout')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Liste des Caisses</h1>
        <a href="{{ route('caisses.create') }}" class="btn btn-primary">Ajouter un Enregistrement</a>
    </div>

    <form id="filter-form" class="filter-form">
        <h2>Filtrer par date:</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Date de début:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">Date de fin:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>

    <div id="factures-list">
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de Facture</th>
                    <th>Status</th>
                    <th>Client</th>
                    <th>Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="factures-tbody">
                @forelse ($factures as $facture)
                    <tr>
                        <td>{{ $facture->id }}</td>
                        <td>{{ $facture->date_facture }}</td>
                        <td>{{ $facture->status }}</td>
                        <td>{{ $facture->client->nom }} {{ $facture->client->prenom }}</td>
                        <td>{{ $facture->paiement }}</td>
                        <td class="action-icons">
                            <a href="{{ route('caisses.show', $facture->id) }}" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('caisses.edit', $facture->id) }}" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('caisses.destroy', $facture->id) }}" method="POST" style="display:inline;" title="Supprimer">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none;">
                                    <i class="fas fa-trash-alt delete-icon"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data-message">Aucune facture trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Retour à l'accueil</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            
            $.ajax({
                url: "{{ route('caisses.index') }}",  // Route du filtre
                type: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(response) {
                    $('#factures-tbody').html('');
                    $.each(response.caisses, function(index, facture) {
                        var row = '<tr>'+
                                    '<td>'+facture.id+'</td>'+
                                    '<td>'+facture.date_facture+'</td>'+
                                    '<td>'+facture.status+'</td>'+
                                    '<td>'+facture.client.nom + ' ' + facture.client.prenom+'</td>'+
                                    '<td>'+facture.paiement+'</td>'+
                                    '<td class="action-icons">'+
                                        '<a href="/caisses/'+facture.id+'/show" title="Voir"><i class="fas fa-eye"></i></a>'+
                                        '<a href="/caisses/'+facture.id+'/edit" title="Modifier"><i class="fas fa-edit"></i></a>'+
                                        '<form action="/caisses/'+facture.id+'/destroy" method="POST" style="display:inline;" title="Supprimer">'+
                                            '@csrf'+
                                            '@method("DELETE")'+
                                            '<button type="submit" style="background:none; border:none;"><i class="fas fa-trash-alt delete-icon"></i></button>'+
                                        '</form>'+
                                    '</td>'+
                                  '</tr>';
                        $('#factures-tbody').append(row);
                    });
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
