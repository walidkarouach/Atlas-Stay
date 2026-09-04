<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Atlas Stay')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 text-stone-900 antialiased">

    {{-- =========================
        NAVBAR
    ========================== --}}
    <header class="border-b border-stone-200 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            {{-- Logo --}}
            <a href="/" class="flex items-center">
                <img
                    src="{{ asset('images/logo-atlas.png') }}"
                    alt="Atlas Stay"
                    class="h-12 w-auto"
                >
            </a>

            {{-- Navigation --}}
            <div class="hidden items-center gap-8 md:flex">

                <a
                    href="/"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    Accueil
                </a>

                <a
                    href="/hotels"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    Hôtels
                </a>

                <a
                    href="#"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    Destinations
                </a>

                <a
                    href="#"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    À propos
                </a>

            </div>

            {{-- Authentication --}}
            <div class="flex items-center gap-3">

                <a
                    href="/login"
                    class="hidden text-sm font-medium text-stone-700 transition hover:text-stone-950 sm:block"
                >
                    Connexion
                </a>

                <a
                    href="/register"
                    class="rounded-full bg-stone-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-stone-700"
                >
                    Créer un compte
                </a>

            </div>

        </nav>
    </header>


    {{-- =========================
        MAIN CONTENT
    ========================== --}}
    <main>
        @yield('content')
    </main>


    {{-- =========================
        FOOTER
    ========================== --}}
    <footer class="mt-20 border-t border-stone-200 bg-white">

        <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 md:grid-cols-3">

            {{-- Logo --}}
            <div>

                <a href="/" class="inline-flex items-center">
                    <img
                        src="{{ asset('images/logo-atlas.png') }}"
                        alt="Atlas Stay"
                        class="h-14 w-auto"
                    >
                </a>

                <p class="mt-4 max-w-sm text-sm leading-6 text-stone-500">
                    Découvrez des hébergements uniques
                    au cœur des montagnes du Maroc.
                </p>

            </div>


            {{-- Navigation --}}
            <div>

                <h3 class="text-sm font-semibold uppercase tracking-wider">
                    Navigation
                </h3>

                <div class="mt-4 space-y-2 text-sm text-stone-500">

                    <a
                        href="/"
                        class="block transition hover:text-stone-900"
                    >
                        Accueil
                    </a>

                    <a
                        href="/hotels"
                        class="block transition hover:text-stone-900"
                    >
                        Hôtels
                    </a>

                    <a
                        href="#"
                        class="block transition hover:text-stone-900"
                    >
                        Destinations
                    </a>

                    <a
                        href="#"
                        class="block transition hover:text-stone-900"
                    >
                        À propos
                    </a>

                </div>

            </div>


            {{-- About --}}
            <div>

                <h3 class="text-sm font-semibold uppercase tracking-wider">
                    Atlas Stay
                </h3>

                <p class="mt-4 text-sm leading-6 text-stone-500">
                    Plateforme de réservation d'hôtels
                    de montagne au Maroc.
                </p>

            </div>

        </div>


        {{-- Copyright --}}
        <div class="border-t border-stone-200">

            <div class="mx-auto max-w-7xl px-6 py-5 text-center text-sm text-stone-500">

                © {{ date('Y') }} Atlas Stay.
                Tous droits réservés.

            </div>

        </div>

    </footer>

</body>
</html>