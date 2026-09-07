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

        <div class="mx-auto max-w-7xl px-4 sm:px-6">

            {{-- DESKTOP / MOBILE TOP BAR --}}
            <div class="flex h-20 items-center justify-between">

                {{-- LOGO --}}
                <a
                    href="{{ url('/') }}"
                    class="flex items-center"
                >
                    <img
                        src="{{ asset('images/logo-atlas.png') }}"
                        alt="Atlas Stay"
                        class="h-11 w-auto sm:h-12"
                    >
                </a>


                {{-- DESKTOP NAVIGATION --}}
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


                    @auth

                        {{-- CLIENT --}}
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


                        {{-- PROPRIETAIRE --}}
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


                        {{-- ADMIN --}}
                        @if (auth()->user()->role->nom === 'Admin')

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="text-sm font-medium text-stone-700 transition hover:text-stone-950"
                            >
                                Dashboard
                            </a>

                        @endif

                    @endauth

                </nav>


                {{-- DESKTOP AUTHENTICATION --}}
                <div class="hidden items-center gap-4 md:flex">

                    @auth

                        {{-- PROFILE --}}
                        <a
                            href="{{ route('profile.index') }}"
                            class="group text-right"
                        >

                            <p class="text-sm font-semibold text-stone-900 transition group-hover:text-stone-500">
                                {{ auth()->user()->nom }}
                            </p>

                            <p class="text-xs text-stone-500">
                                {{ auth()->user()->role->nom }}
                            </p>

                        </a>


                        {{-- LOGOUT --}}
                        <form action="{{ route('logout') }}" method="POST">

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


                {{-- MOBILE MENU BUTTON --}}
                <button
                    type="button"
                    id="mobile-menu-button"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-stone-200 bg-white text-stone-800 transition hover:bg-stone-100 md:hidden"
                    aria-label="Ouvrir le menu"
                    aria-expanded="false"
                >

                    {{-- MENU ICON --}}
                    <svg
                        id="mobile-menu-open-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>


                    {{-- CLOSE ICON --}}
                    <svg
                        id="mobile-menu-close-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        class="hidden h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>


            {{-- MOBILE MENU --}}
            <div
                id="mobile-menu"
                class="hidden border-t border-stone-100 pb-5 md:hidden"
            >

                <div class="pt-4">


                    {{-- USER PROFILE CARD --}}
                    @auth

                        <a
                            href="{{ route('profile.index') }}"
                            class="mb-4 flex items-center gap-3 rounded-2xl border border-stone-200 bg-stone-50 p-4 transition hover:bg-stone-100"
                        >

                            {{-- AVATAR --}}
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-stone-900 text-sm font-semibold text-white">
                                {{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
                            </div>


                            {{-- USER INFO --}}
                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-semibold text-stone-900">
                                    {{ auth()->user()->nom }}
                                </p>

                                <p class="mt-0.5 text-xs text-stone-500">
                                    {{ auth()->user()->role->nom }}
                                </p>

                            </div>


                            {{-- ARROW --}}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-stone-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </a>

                    @endauth


                    {{-- NAVIGATION LINKS --}}
                    <div class="space-y-1">


                        {{-- ACCUEIL --}}
                        <a
                            href="{{ url('/') }}"
                            class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100 hover:text-stone-950"
                        >
                            <span>Accueil</span>

                            <span class="text-stone-400">→</span>
                        </a>


                        {{-- HOTELS --}}
                        <a
                            href="{{ route('hotels.index') }}"
                            class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100 hover:text-stone-950"
                        >
                            <span>Hôtels</span>

                            <span class="text-stone-400">→</span>
                        </a>


                        {{-- DESTINATIONS --}}
                        <a
                            href="{{ url('/#destinations') }}"
                            class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100 hover:text-stone-950"
                        >
                            <span>Destinations</span>

                            <span class="text-stone-400">→</span>
                        </a>


                        {{-- A PROPOS --}}
                        <a
                            href="{{ url('/#a-propos') }}"
                            class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100 hover:text-stone-950"
                        >
                            <span>À propos</span>

                            <span class="text-stone-400">→</span>
                        </a>


                        @auth

                            {{-- CLIENT MOBILE --}}
                            @if (auth()->user()->role->nom === 'Client')

                                <div class="my-3 border-t border-stone-100"></div>

                                <a
                                    href="{{ route('reservations.index') }}"
                                    class="flex items-center justify-between rounded-xl bg-stone-50 px-4 py-3 text-sm font-semibold text-stone-800 transition hover:bg-stone-100"
                                >
                                    <span>Mes réservations</span>

                                    <span class="text-stone-400">→</span>
                                </a>

                                <a
                                    href="{{ route('notifications.index') }}"
                                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100 hover:text-stone-950"
                                >
                                    <span>Notifications</span>

                                    <span class="text-stone-400">→</span>
                                </a>

                            @endif


                            {{-- PROPRIETAIRE MOBILE --}}
                            @if (auth()->user()->role->nom === 'Propriétaire')

                                <div class="my-3 border-t border-stone-100"></div>

                                <a
                                    href="{{ route('proprietaire.dashboard') }}"
                                    class="flex items-center justify-between rounded-xl bg-stone-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-stone-800"
                                >
                                    <span>Dashboard</span>

                                    <span class="text-stone-300">→</span>
                                </a>

                                <a
                                    href="{{ route('notifications.index') }}"
                                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100 hover:text-stone-950"
                                >
                                    <span>Notifications</span>

                                    <span class="text-stone-400">→</span>
                                </a>

                            @endif


                            {{-- ADMIN MOBILE --}}
                            @if (auth()->user()->role->nom === 'Admin')

                                <div class="my-3 border-t border-stone-100"></div>

                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    class="flex items-center justify-between rounded-xl bg-stone-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-stone-800"
                                >
                                    <span>Dashboard</span>

                                    <span class="text-stone-300">→</span>
                                </a>

                            @endif

                        @endauth

                    </div>


                    {{-- MOBILE AUTH ACTION --}}
                    <div class="mt-4 border-t border-stone-100 pt-4">

                        @auth

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center justify-center rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                                >
                                    Déconnexion
                                </button>

                            </form>

                        @else

                            <div class="grid grid-cols-2 gap-3">

                                <a
                                    href="{{ route('login') }}"
                                    class="flex items-center justify-center rounded-xl border border-stone-300 px-4 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                                >
                                    Connexion
                                </a>

                                <a
                                    href="{{ route('register') }}"
                                    class="flex items-center justify-center rounded-xl bg-stone-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                                >
                                    Inscription
                                </a>

                            </div>

                        @endauth

                    </div>

                </div>

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

                        <p>Maroc</p>

                        <p>Explorez les montagnes autrement.</p>

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


    {{-- MOBILE MENU SCRIPT --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            const openIcon = document.getElementById('mobile-menu-open-icon');
            const closeIcon = document.getElementById('mobile-menu-close-icon');

            if (!button || !menu) {
                return;
            }

            button.addEventListener('click', function () {

                const isOpen = !menu.classList.contains('hidden');

                menu.classList.toggle('hidden');

                openIcon.classList.toggle('hidden', !isOpen);
                closeIcon.classList.toggle('hidden', isOpen);

                button.setAttribute(
                    'aria-expanded',
                    (!isOpen).toString()
                );

            });


            {{-- Close menu when clicking a link --}}
            menu.querySelectorAll('a').forEach(function (link) {

                link.addEventListener('click', function () {

                    menu.classList.add('hidden');

                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');

                    button.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                });

            });

        });

    </script>

</body>
</html>