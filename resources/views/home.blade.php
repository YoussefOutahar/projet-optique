<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil - DIGIOPTIC</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: bold;
            text-transform: uppercase;
        }

        .navbar-brand {
            font-size: 1.5em;
            letter-spacing: 2px;
        }

        .nav-link:hover {
            color: #f0f4f8 !important;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
        }

        h1 {
            font-size: 2.5em;
            color: #333;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            position: relative;
            z-index: 0;
        }

        .card:before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #3498db, #f2eaf5);
            z-index: -1;
            filter: blur(20px);
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .card:hover:before {
            opacity: 1;
        }
        .card a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            font-size: 1.3em;
            letter-spacing: 1px;
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .card a:hover {
            color: #2980b9;
        }

        .loader {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .loader div {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .card {
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="/">DIGIOPTIC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1 class="text-center my-4">
            Bienvenue 
            @if(Auth::check())
                <strong style="text-transform: uppercase;">{{ Auth::user()->name }}</strong>
            @else
                invité
            @endif
        </h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('fournisseurs.index') }}" class="redirect-link">Fournisseurs</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('produits.index') }}" class="redirect-link">Produits</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('clients.index') }}" class="redirect-link">Clients</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('stocks.index') }}" class="redirect-link">Stocks</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('ventes.index') }}" class="redirect-link">Ventes</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('receptions.index') }}" class="redirect-link">Achats</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('factures.index') }}" class="redirect-link">Factures</a>
                </div>
            </div>
        </div>
    </div>

    <div class="loader" id="loader">
        <div></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.redirect-link').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const url = this.href;
                const loader = document.getElementById('loader');
                loader.style.display = 'flex';

                setTimeout(() => {
                    window.location.href = url;
                }, 200);
            });
        });

        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.style.display = 'none';
        });
    </script>
</body>
</html>
