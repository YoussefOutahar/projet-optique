<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Ajoutez jQuery et Bootstrap JS (assurez-vous que ces liens sont bien dans votre projet) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        <!-- Script pour la gestion du bouton de suppression dans le modal -->
        <script>
            let deleteFormAction;

            // Définir l'URL de l'action de suppression dans le modal
            function setDeleteAction(actionUrl) {
                deleteFormAction = actionUrl;
            }

            // Lorsque l'utilisateur clique sur le bouton "Supprimer", soumettre le formulaire de suppression
            $('#confirmDeleteBtn').on('click', function() {
                const form = $('<form>', {
                    'method': 'POST',
                    'action': deleteFormAction
                });

                // Ajouter le token CSRF et la méthode DELETE
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                }));

                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_method',
                    'value': 'DELETE'
                }));

                // Ajouter et soumettre le formulaire
                $('body').append(form);
                form.submit();
            });
        </script>
    </body>
</html>
