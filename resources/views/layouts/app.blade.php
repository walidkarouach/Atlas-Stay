<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Atlas Stay')
    </title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white text-stone-900">

    {{-- =========================
        NAVBAR
    ========================== --}}
    <header class="sticky top-0 z-50 border-b border-stone-200 bg-white">

        <nav class="mx-auto flex h-[80px] max-w-[1800px] items-center justify-between px-6 lg:px-10">

            {{-- =========================
                LOGO
            ========================== --}}
            <a
                href="{{ url('/') }}"
                class="shrink-0"
            >

                <img
                    src="{{ asset('images/logo-atlas.png') }}"
                    alt="Atlas Stay"
                    class="h-10 w-auto"
                >

            </a>


            {{-- =========================
                DESKTOP NAVIGATION
            ========================== --}}
            <div class="hidden items-center gap-9 lg:flex">

                {{-- ACCUEIL --}}
                <a
                    href="{{ url('/') }}"
                    class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                >
                    Accueil
                </a>


                {{-- HOTELS --}}
                <a
                    href="{{ route('hotels.index') }}"
                    class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                >
                    Hôtels
                </a>


                {{-- DESTINATIONS --}}
                <a
                    href="{{ url('/#destinations') }}"
                    class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                >
                    Destinations
                </a>


                {{-- A PROPOS --}}
                <a
                    href="{{ url('/#a-propos') }}"
                    class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                >
                    À propos
                </a>


                {{-- =========================
                    CLIENT
                ========================== --}}
                @auth

                    @if(auth()->user()->role?->nom === 'Client')

                        <a
                            href="{{ route('reservations.index') }}"
                            class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                        >
                            Mes réservations
                        </a>

                    @endif

                @endauth


                {{-- =========================
                    PROPRIETAIRE
                ========================== --}}
                @auth

                    @if(auth()->user()->role?->nom === 'Propriétaire')

                        <a
                            href="{{ route('proprietaire.dashboard') }}"
                            class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                        >
                            Dashboard
                        </a>

                    @endif

                @endauth


                {{-- =========================
                    ADMIN
                ========================== --}}
                @auth

                    @if(auth()->user()->role?->nom === 'Admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="text-[16px] font-medium text-stone-700 transition hover:text-black"
                        >
                            Dashboard
                        </a>

                    @endif

                @endauth

            </div>


            {{-- =========================
                RIGHT SIDE
            ========================== --}}
            <div class="hidden items-center gap-5 lg:flex">

                @auth

                    @if (
                        auth()->user()->role?->nom === 'Client' ||
                        auth()->user()->role?->nom === 'Propriétaire'
                    )

                    {{-- =========================
                        UNREAD NOTIFICATIONS COUNT
                    ========================== --}}
                    @php

                        $unreadNotificationsCount = auth()
                            ->user()
                            ->notifications()
                            ->where('lu', false)
                            ->count();

                    @endphp


                    {{-- =========================
                        NOTIFICATION BELL
                    ========================== --}}
                    <a
                        href="{{ route('notifications.index') }}"
                        class="relative flex h-10 w-10 items-center justify-center rounded-full border border-stone-200 text-stone-700 transition hover:bg-stone-100 hover:text-black"
                        aria-label="Notifications"
                        title="Notifications"
                    >

                        {{-- BELL ICON --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 1-5.714 0M18.75 10.5c0 3.142.75 4.5 1.5 5.25H3.75c.75-.75 1.5-2.108 1.5-5.25a6.75 6.75 0 1 1 13.5 0Z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.75 17.25a2.25 2.25 0 0 0 4.5 0"
                            />

                        </svg>


                        {{-- =========================
                            UNREAD BADGE
                        ========================== --}}
                        @if($unreadNotificationsCount > 0)

                            <span
                                class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1 text-[10px] font-bold leading-none text-white ring-2 ring-white"
                            >
                                {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}
                            </span>

                        @endif

                    </a>

                    @endif


                    {{-- =========================
                        USER NAME → PROFILE
                    ========================== --}}
                    <a
                        href="{{ route('profile.index') }}"
                        class="text-right leading-tight transition hover:opacity-70"
                    >

                        <div class="text-[15px] font-semibold text-stone-900">
                            {{ auth()->user()->nom }}
                        </div>

                        <div class="mt-1 text-sm text-stone-500">
                            {{ auth()->user()->role?->nom }}
                        </div>

                    </a>


                    {{-- =========================
                        LOGOUT
                    ========================== --}}
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="rounded-2xl border border-stone-300 px-5 py-2.5 text-[15px] font-medium text-stone-700 transition hover:bg-stone-900 hover:text-white"
                        >
                            Déconnexion
                        </button>

                    </form>

                @else

                    {{-- =========================
                        GUEST
                    ========================== --}}

                    <a
                        href="{{ route('login') }}"
                        class="text-[15px] font-medium text-stone-700 transition hover:text-black"
                    >
                        Connexion
                    </a>


                    <a
                        href="{{ route('register') }}"
                        class="rounded-2xl bg-stone-900 px-5 py-2.5 text-[15px] font-medium text-white transition hover:bg-black"
                    >
                        Créer un compte
                    </a>

                @endauth

            </div>


            {{-- =========================
                MOBILE BUTTON
            ========================== --}}
            <button
                id="mobile-menu-button"
                type="button"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-stone-200 text-stone-700 lg:hidden"
                aria-label="Ouvrir le menu"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.7"
                    stroke="currentColor"
                    class="h-5 w-5"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"
                    />

                </svg>

            </button>

        </nav>


        {{-- =========================
            MOBILE MENU
        ========================== --}}
        <div
            id="mobile-menu"
            class="hidden border-t border-stone-200 bg-white lg:hidden"
        >

            <div class="space-y-1 px-6 py-5">

                {{-- ACCUEIL --}}
                <a
                    href="{{ url('/') }}"
                    class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                >
                    Accueil
                </a>


                {{-- HOTELS --}}
                <a
                    href="{{ route('hotels.index') }}"
                    class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                >
                    Hôtels
                </a>


                {{-- DESTINATIONS --}}
                <a
                    href="{{ url('/#destinations') }}"
                    class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                >
                    Destinations
                </a>


                {{-- A PROPOS --}}
                <a
                    href="{{ url('/#a-propos') }}"
                    class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                >
                    À propos
                </a>


                @auth

                    @if (
                        auth()->user()->role?->nom === 'Client' ||
                        auth()->user()->role?->nom === 'Propriétaire'
                    )

                    {{-- =========================
                        MOBILE NOTIFICATIONS
                    ========================== --}}
                    <a
                        href="{{ route('notifications.index') }}"
                        class="flex items-center justify-between rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                    >

                        <span class="flex items-center gap-3">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 1-5.714 0M18.75 10.5c0 3.142.75 4.5 1.5 5.25H3.75c.75-.75 1.5-2.108 1.5-5.25a6.75 6.75 0 1 1 13.5 0Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.75 17.25a2.25 2.25 0 0 0 4.5 0"
                                />

                            </svg>

                            <span>
                                Notifications
                            </span>

                        </span>


                        @if($unreadNotificationsCount > 0)

                            <span
                                class="flex h-6 min-w-6 items-center justify-center rounded-full bg-red-600 px-1.5 text-xs font-bold text-white"
                            >
                                {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}
                            </span>

                        @endif

                    </a>

                    @endif


                    {{-- =========================
                        CLIENT
                    ========================== --}}
                    @if(auth()->user()->role?->nom === 'Client')

                        <a
                            href="{{ route('reservations.index') }}"
                            class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                        >
                            Mes réservations
                        </a>

                    @endif


                    {{-- =========================
                        PROPRIETAIRE
                    ========================== --}}
                    @if(auth()->user()->role?->nom === 'Propriétaire')

                        <a
                            href="{{ route('proprietaire.dashboard') }}"
                            class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                        >
                            Dashboard
                        </a>

                    @endif


                    {{-- =========================
                        ADMIN
                    ========================== --}}
                    @if(auth()->user()->role?->nom === 'Admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                        >
                            Dashboard
                        </a>

                    @endif


                    {{-- =========================
                        MOBILE PROFILE
                    ========================== --}}
                    <a
                        href="{{ route('profile.index') }}"
                        class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                    >
                        {{ auth()->user()->nom }}
                    </a>


                    {{-- =========================
                        MOBILE LOGOUT
                    ========================== --}}
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="mt-2"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-stone-300 px-4 py-3 text-left text-stone-700 hover:bg-stone-100"
                        >
                            Déconnexion
                        </button>

                    </form>

                @else

                    {{-- =========================
                        MOBILE GUEST
                    ========================== --}}

                    <a
                        href="{{ route('login') }}"
                        class="block rounded-xl px-4 py-3 text-stone-700 hover:bg-stone-100"
                    >
                        Connexion
                    </a>


                    <a
                        href="{{ route('register') }}"
                        class="block rounded-xl bg-stone-900 px-4 py-3 text-white"
                    >
                        Créer un compte
                    </a>

                @endauth

            </div>

        </div>

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
    <footer class="border-t border-stone-800 bg-stone-950 text-white">

        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-10">

            <div class="grid gap-10 md:grid-cols-3">

                {{-- Atlas Stay --}}
                <div>

                    <img
                        src="{{ asset('images/logo-atlas.png') }}"
                        alt="Atlas Stay"
                        class="h-10 w-auto brightness-0 invert"
                    >

                    <p class="mt-5 max-w-xs text-sm leading-6 text-stone-400">
                        Découvrez des hôtels authentiques dans les plus belles régions montagneuses du Maroc.
                    </p>

                </div>


                {{-- Navigation --}}
                <div>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-stone-300">
                        Navigation
                    </p>

                    <div class="mt-5 space-y-3">

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


                {{-- Atlas Stay --}}
                <div>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-stone-300">
                        Atlas Stay
                    </p>

                    <div class="mt-5 space-y-3">

                        <p class="text-sm text-stone-400">
                            Maroc
                        </p>

                        <p class="max-w-xs text-sm leading-6 text-stone-400">
                            Explorez les montagnes autrement.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Bottom --}}
            <div class="mt-10 border-t border-stone-800 pt-6">

                <p class="text-center text-xs text-stone-500">
                    © {{ date('Y') }} Atlas Stay. Tous droits réservés.
                </p>

            </div>

        </div>

    </footer>


    {{-- =========================
        MOBILE MENU JS
    ========================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (button && menu) {

                button.addEventListener('click', function () {

                    menu.classList.toggle('hidden');

                });

            }

        });

    </script>

</body>
</html>