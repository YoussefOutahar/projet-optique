<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Achats</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .search-container {
            position: relative;
            max-width: 400px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        #searchInput {
            padding: 10px 40px 10px 20px; /* Ajouter du padding à droite pour l'icône */
            font-size: 16px;
            border-radius: 50px; /* Arrondir les bords */
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
        .action-icons i:hover {
            color: #0056b3;
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
        .no-data-message {
            text-align: center;
            color: #888;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .action-icons button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }
        .action-icons button:focus {
            outline: none;
        }
        /* Style pour les liens de pagination */
        .pagination .page-item .page-link {
            color: #007bff;
            border-radius: 50px;
            margin: 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }
        .pagination .page-item .page-link i {
            margin-right: 5px;
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
    </style>
</head>
<body>
@include('layouts.layout')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des Achats</h1>
        <a href="{{ route('receptions.create') }}" class="btn btn-primary">Ajouter</a>
    </div>

    <!-- Champ de recherche avec icône -->
    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
        <i class="fas fa-search"></i>
    </div>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>N° Réception</th>
                <th>Date de Réception</th>
                <th>Fournisseur</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Référence</th>
                <th>Responsable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="receptionTableBody">
            @foreach ($receptions as $reception)
                <tr>
                    <td>{{ $reception->id }}</td>
                    <td>{{ $reception->numero_reception }}</td>
                    <td>{{ $reception->date_reception }}</td>
                    <td>{{ $reception->fournisseur->societe }}</td>
                    <td>{{ optional($reception->categorie)->nom }}</td>
                    <td>{{ $reception->quantite }}</td>
                    <td>{{ $reception->reference }}</td>
                    <td>{{ $reception->responsable }}</td>
                    <td class="action-icons">
                        <a href="{{ route('receptions.show', $reception->id) }}" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('receptions.edit', $reception->id) }}" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btnn-danger" data-toggle="modal" data-target="#deleteModal-{{ $reception->id }}" data-toggle="tooltip" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            <div class="modal fade" id="deleteModal-{{ $reception->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">
                                <i class="fas fa-exclamation-triangle text-danger"></i> Confirmation de suppression
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Êtes-vous sûr de vouloir supprimer {{ $reception->reference }} ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('receptions.destroy', $reception->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($receptions->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><i class="fas fa-angle-left"></i> Précédent</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $receptions->previousPageUrl() }}" aria-label="Précédent">
                        <span aria-hidden="true"><i class="fas fa-angle-left"></i> Précédent</span>
                    </a>
                </li>
            @endif

            @foreach ($receptions->getUrlRange(1, $receptions->lastPage()) as $page => $url)
                <li class="page-item {{ $receptions->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            @if ($receptions->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $receptions->nextPageUrl() }}" aria-label="Suivant">
                        <span aria-hidden="true">Suivant <i class="fas fa-angle-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Suivant <i class="fas fa-angle-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
</div>

<a href="{{ route('home') }}" class="btn btn-secondary mt-3">Retour à l'accueil</a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const factureTableBody = document.getElementById('factureTableBody');
        const caissesTableBody = document.getElementById('caissesTableBody');
        
        if (!factureTableBody || !caissesTableBody) {
            console.error('Elements with ID "factureTableBody" or "caissesTableBody" not found.');
            return;
        }

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            filterRows(factureTableBody.getElementsByTagName('tr'), filter);
            filterRows(caissesTableBody.getElementsByTagName('tr'), filter);
        });

        function filterRows(rows, filter) {
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let rowText = '';
                
                for (let j = 0; j < cells.length; j++) {
                    rowText += cells[j].textContent.toLowerCase() + ' ';
                }
                
                if (rowText.includes(filter)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000);
        }
    });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
