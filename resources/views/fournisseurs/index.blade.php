<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Fournisseurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/paginationStyle.css') }}">
    <style>
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
        .search-container {
            position: relative;
            max-width: 400px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
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
            align-items: center;
            gap: 10px; /* Espace entre les icônes */
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
        .action-icons i:hover {
            color: #0056b3;
        }
        .action-icons .fa-eye {
            color: #17a2b8; /* Couleur pour l'icône "Voir" */
        }
        .action-icons .fa-edit {
            color: #ffc107; /* Couleur pour l'icône "Modifier" */
        }
        .action-icons .fa-trash-alt {
            color: red; /* Couleur pour l'icône "Supprimer" */
        }
        .modal-footer .btn {
            padding: 10px 20px;
            font-size: 1.2rem;
            display: inline-block;
            visibility: visible !important; /* Toujours visible */
        }
        /* Style par défaut des boutons */
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Les effets de survol ne doivent pas changer la visibilité */
        .btn-danger:hover, .btn-success:hover {
            opacity: 1 !important; /* Aucune opacité ne doit changer sur le hover */
            color: #fff;
        }
        .btn.focus, .btn:focus {
            outline: 0;
            box-shadow: none;
        }
         .action-icons button {
            display: inline-flex; 
            align-items: center;
            border: none;
            padding: 0;
        }
         .action-icons a{
            display: inline-flex; 
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            padding: 0;
        }
    </style>
</head>
<body>
@include('layouts.layout')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des Fournisseurs</h1>
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">Ajouter</a>
    </div>
    
    <!-- Champ de recherche avec icône -->
    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par société, responsable ou adresse">
        <i class="fas fa-search"></i>
    </div>
    
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Société</th>
                <th>Responsable</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="fournisseurTableBody">
            @foreach ($fournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->id }}</td>
                    <td>{{ $fournisseur->societe }}</td>
                    <td>{{ $fournisseur->responsable }}</td> 
                    <td>{{ $fournisseur->ville }}</td>
                    <td>{{ $fournisseur->telephone }}</td>
                    <td class="action-icons">
                        <a href="{{ route('fournisseurs.show', $fournisseur->id) }}" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Bouton pour ouvrir le modal -->
                        <button type="button" class="btn btnn-danger" data-toggle="modal" data-target="#deleteModal-{{ $fournisseur->id }}" data-toggle="tooltip" data-placement="top" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Modal pour chaque fournisseur -->
                        <div class="modal fade" id="deleteModal-{{ $fournisseur->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                                        <p class="text-center">Êtes-vous sûr de vouloir supprimer {{ $fournisseur->societe }} ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                                        <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>        
                   
    </table>
    
    <!-- Liens de pagination avec icônes -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($fournisseurs->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fas fa-angle-left"></i> Précédent</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $fournisseurs->previousPageUrl() }}" aria-label="Précédent">
                            <span aria-hidden="true"><i class="fas fa-angle-left"></i> Précédent</span>
                        </a>
                    </li>
                @endif

                @foreach ($fournisseurs->getUrlRange(1, $fournisseurs->lastPage()) as $page => $url)
                    <li class="page-item {{ $fournisseurs->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($fournisseurs->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $fournisseurs->nextPageUrl() }}" aria-label="Suivant">
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
    // Initialiser les infobulles Bootstrap
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('fournisseurTableBody');
        
        if (!tableBody) {
            console.error('Element avec ID "fournisseurTableBody" introuvable.');
            return;
        }
    
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = tableBody.getElementsByTagName('tr');
            
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
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
