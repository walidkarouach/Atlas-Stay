<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Atlas Stay')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-stone-900">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-50 border-b border-stone-200 bg-white/95 backdrop-blur">

        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">

            {{-- LOGO --}}
            <a
                href="{{ url('/') }}"
                class="flex items-center"
            >
                <img
                    src="{{ asset('images/logo-atlas.png') }}"
                    alt="Atlas Stay"
                    class="h-12 w-auto"
                >
            </a>


            {{-- NAVIGATION --}}
            <nav class="hidden items-center gap-8 md:flex">

                <a
                    href="{{ url('/') }}"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    Accueil
                </a>

                <a
                    href="{{ route('hotels.index') }}"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    Hôtels
                </a>

                <a
                    href="{{ url('/#destinations') }}"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    Destinations
                </a>

                <a
                    href="{{ url('/#a-propos') }}"
                    class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                >
                    À propos
                </a>


                {{-- AUTHENTICATED USER NAVIGATION --}}
                @auth

                    {{-- CLIENT NAVIGATION --}}
                    @if (auth()->user()->role->nom === 'Client')

                        <a
                            href="{{ route('reservations.index') }}"
                            class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                        >
                            Mes réservations
                        </a>

                        <a
                            href="{{ route('notifications.index') }}"
                            class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                        >
                            Notifications
                        </a>

                    @endif


                    {{-- PROPRIETAIRE NAVIGATION --}}
                    @if (auth()->user()->role->nom === 'Propriétaire')

                        <a
                            href="{{ route('proprietaire.dashboard') }}"
                            class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                        >
                            Dashboard
                        </a>

                        <a
                            href="{{ route('notifications.index') }}"
                            class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                        >
                            Notifications
                        </a>

                    @endif

                @endauth

            </nav>


            {{-- AUTHENTICATION AREA --}}
            <div class="flex items-center gap-4">

                @auth

                    {{-- PROFILE --}}
                    <a
                        href="{{ route('profile.index') }}"
                        class="group hidden text-right sm:block"
                    >

                        <p class="text-sm font-semibold text-stone-900 transition group-hover:text-stone-500">
                            {{ auth()->user()->nom }}
                        </p>

                        <p class="text-xs text-stone-500">
                            {{ auth()->user()->role->nom }}
                        </p>

                    </a>


                    {{-- LOGOUT --}}
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="rounded-xl border border-stone-300 px-4 py-2 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                        >
                            Déconnexion
                        </button>

                    </form>

                @else

                    {{-- LOGIN --}}
                    <a
                        href="{{ route('login') }}"
                        class="text-sm font-semibold text-stone-700 transition hover:text-stone-950"
                    >
                        Connexion
                    </a>


                    {{-- REGISTER --}}
                    <a
                        href="{{ route('register') }}"
                        class="hidden rounded-xl bg-stone-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-stone-700 sm:inline-flex"
                    >
                        Inscription
                    </a>

                @endauth

            </div>

        </div>

    </header>


    {{-- PAGE CONTENT --}}
    <main>

        @yield('content')

    </main>


    {{-- FOOTER --}}
    <footer class="border-t border-stone-200 bg-stone-950 text-white">

        <div class="mx-auto max-w-7xl px-6 py-12">

            <div class="grid gap-10 md:grid-cols-3">


                {{-- BRAND --}}
                <div>

                    <img
                        src="{{ asset('images/logo-atlas.png') }}"
                        alt="Atlas Stay"
                        class="h-12 w-auto brightness-0 invert"
                    >

                    <p class="mt-4 max-w-sm text-sm leading-6 text-stone-400">
                        Découvrez des hôtels authentiques dans les plus belles
                        régions montagneuses du Maroc.
                    </p>

                </div>


                {{-- NAVIGATION --}}
                <div>

                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                        Navigation
                    </h3>

                    <div class="mt-4 space-y-3">

                        <a
                            href="{{ url('/') }}"
                            class="block text-sm text-stone-400 transition hover:text-white"
                        >
                            Accueil
                        </a>

                        <a
                            href="{{ route('hotels.index') }}"
                            class="block text-sm text-stone-400 transition hover:text-white"
                        >
                            Hôtels
                        </a>

                        <a
                            href="{{ url('/#destinations') }}"
                            class="block text-sm text-stone-400 transition hover:text-white"
                        >
                            Destinations
                        </a>

                        <a
                            href="{{ url('/#a-propos') }}"
                            class="block text-sm text-stone-400 transition hover:text-white"
                        >
                            À propos
                        </a>

                    </div>

                </div>


                {{-- CONTACT --}}
                <div>

                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                        Atlas Stay
                    </h3>

                    <div class="mt-4 space-y-3 text-sm text-stone-400">

                        <p>
                            Maroc
                        </p>

                        <p>
                            Explorez les montagnes autrement.
                        </p>

                    </div>

                </div>

            </div>


            {{-- COPYRIGHT --}}
            <div class="mt-10 border-t border-stone-800 pt-6">

                <p class="text-center text-sm text-stone-500">
                    © {{ date('Y') }} Atlas Stay. Tous droits réservés.
                </p>

            </div>

        </div>

    </footer>

</body>
</html>