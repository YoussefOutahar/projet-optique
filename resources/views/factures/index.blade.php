<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures et Caisses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            padding: 15px;
            border-bottom: 1px solid #e3e6f0;
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .action-icons {
            display: flex;
            align-items: center;
            gap: 10px; 
        }
        .action-icons form {
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
            color: red; 
        }
        .action-icons .fa-print {
            color: #28a745;
        }
        .pagination .page-item .page-link {
            color: #007bff;
            border-radius: 50px;
            margin: 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }
        .pagination .page-item .page-link:hover {
            background-color: #0056b3;
            color: white;
        }
        .no-data-message {
            margin-top: 20px;
            color: #6c757d;
            font-size: 1.2rem;
            text-align: center;
        }
        .filter-container .form-group label {
            font-weight: bold;
        }
        .search-container {
            position: relative;
            max-width: 400px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        #searchInput {
            padding: 10px 40px 10px 20px; 
            font-size: 16px;
            border-radius: 50px; 
            border: 1px solid #ced4da;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 100%;
        }
        #searchInput:focus {
            border-color: #007bff;
            box-shadow: inset 0 2px 5px rgba(0, 123, 255, 0.3);
            outline: none;
        }
        .search-container .fa-search {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }
    </style>
</head>
<body>
@include('layouts.layout')

<div class="container mt-5">
    <!-- Section Factures -->
    <div class="card">
        <div class="card-header">
            Liste des Factures
            <a href="{{ route('factures.create') }}" class="btn btn-primary float-right">Ajouter une Facture</a>
        </div>
        <div class="card-body">
            <form action="{{ route('factures.index') }}" method="GET" class="filter-container">
                <div class="row">
                    <div class="search-container">
                        <input type="text" id="searchInput" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </form>

            <!-- Table des Factures -->
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° Facture</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="factureTableBody">
                    @forelse ($factures as $facture)
                        <tr>
                            <td>{{ $facture->id }}</td>
                            <td>{{ $facture->numero_facture }}</td>
                            <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('Y-m-d') }}</td>
                            <td>{{ $facture->client->nom }}</td>
                            <td>{{ $facture->total }} DH</td>
                            <td class="action-icons">
                                <a href="{{ route('factures.show', $facture->id) }}" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('factures.edit', $facture->id) }}" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('factures.destroy', $facture->id) }}" method="POST" style="display:inline;" title="Supprimer">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:none;">
                                        <i class="fas fa-trash-alt delete-icon"></i>
                                    </button>
                                </form>
                                <a href="{{ route('factures.print', $facture->id) }}" title="Imprimer">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        
                    @empty
                        <tr>
                            <td colspan="6" class="no-data-message">Aucune facture trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination des factures -->
            <div class="d-flex justify-content-center mt-4">
                {{ $factures->links() }}
            </div>
        </div>
    </div>

    <!-- Section Caisses -->
    <div class="card">
        <div class="card-header">
            Liste des Caisses
        </div>
        <div class="card-body">
            <form action="{{ route('factures.index') }}" method="GET" class="filter-form">
                <h2>Filtrer par date (caisses):</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Date de début:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Date de fin:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </form>
            
            <!-- Tableau des Caisses filtrées -->
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° Facture</th> 
                        <th>Date de Facture</th>
                        <th>Status</th>
                        <th>Client</th>
                        <th>Total</th> 
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($factures as $facture)
                        <tr>
                            <td>{{ $facture->id }}</td>
                            <td>{{ $facture->numero_facture }}</td> <!-- Affichage du numéro de facture -->
                            <td>{{ $facture->date_facture }}</td> <!-- Affichage de la date de la facture -->
                            <td>{{ $facture->status }}</td>
                            <td>{{ $facture->client->nom }} {{ $facture->client->prenom }}</td> <!-- Affichage du client -->
                            <td>{{ $facture->total }} DH</td> <!-- Affichage du total -->
                            <td class="action-icons">
                                <a href="{{ route('factures.show', $facture->id) }}" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('factures.edit', $facture->id) }}" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('factures.destroy', $facture->id) }}" method="POST" style="display:inline;" title="Supprimer">
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
                            <td colspan="7" class="no-data-message">Aucune caisse trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination pour les caisses -->
            <div class="d-flex justify-content-center mt-4">
                {{ $caisses->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
