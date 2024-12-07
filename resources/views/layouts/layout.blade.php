<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar">
    <a href="{{ route('home') }}">Accueil</a>
    <a href="{{ route('fournisseurs.index') }}">Fournisseurs</a>
    <a href="{{ route('produits.index') }}">Produits</a>
    <a href="{{ route('clients.index') }}">Clients</a>
    <a href="{{ route('stocks.index') }}">Stocks</a>
    <a href="{{ route('ventes.index') }}">Ventes</a>
    <a href="{{ route('receptions.index') }}">Achats</a>
    <a href="{{ route('factures.index') }}">Factures</a>
</nav>
<style>
    .navbar {
        background: #3498db;
        color: #fff;
        padding: 10px 0 20px; 
        text-align: center;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
        transition: background 0.3s ease;
        justify-content: center; /* Centrer horizontalement les éléments */
        align-items: center; /* Centrer verticalement les éléments */
        gap: 15px; /* Réduire l'espace entre les éléments */
    }
    .navbar a {
        color: #fff;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .navbar a:hover {
        color: #CDCCCC; 
        transform: scale(1.05);
    }
    body {
        padding-top: 80px; 
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = '#2980b9';
            } else {
                navbar.style.background = '#3498db';
            }
        });
    });
</script>