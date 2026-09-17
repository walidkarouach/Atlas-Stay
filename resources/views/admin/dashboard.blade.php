@extends('layouts.app')

@section('title', 'Dashboard Admin - Atlas Stay')

@section('content')

<section class="bg-stone-50">

    <div class="mx-auto max-w-7xl px-6 py-12">

        {{-- HEADER --}}
        <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

            <div>

                <p class="text-sm font-semibold uppercase tracking-widest text-stone-500">
                    Administration
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-stone-950 md:text-4xl">
                    Dashboard Admin
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-stone-600">
                    Bienvenue {{ auth()->user()->nom }}.
                    Gérez les utilisateurs, les hôtels, les réservations
                    et les avis de la plateforme.
                </p>

            </div>


            {{-- ADMIN INFO --}}
            <div class="rounded-2xl border border-stone-200 bg-white px-5 py-4 shadow-sm">

                <p class="text-sm font-semibold text-stone-900">
                    {{ auth()->user()->nom }}
                </p>

                <p class="mt-1 text-xs text-stone-500">
                    {{ auth()->user()->email }}
                </p>

                <span class="mt-3 inline-flex rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                    Administrateur
                </span>

            </div>

        </div>


        {{-- STATISTIQUES PRINCIPALES --}}
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


            {{-- UTILISATEURS --}}
            <a
                href="{{ route('admin.users.index') }}"
                class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-stone-500">
                            Utilisateurs
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-stone-950">
                            {{ $totalUsers }}
                        </p>

                    </div>


                    {{-- Users Icon --}}
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372
                                9.337 9.337 0 0 0 4.125-.952
                                4.125 4.125 0 0 0-7.533-2.493
                                M15 19.128v-.003
                                c0-1.113-.285-2.16-.786-3.07
                                M15 19.128v.106A12.318 12.318 0 0 1
                                8.624 21c-2.331 0-4.512-.645-6.374-1.766
                                l-.001-.109a6.375 6.375 0 0 1
                                11.964-3.07
                                M12 6.375a3.375 3.375 0 1 1-6.75 0
                                3.375 3.375 0 0 1 6.75 0
                                Z
                                M18 8.25a2.25 2.25 0 1 1-4.5 0
                                2.25 2.25 0 0 1 4.5 0 Z"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-5 text-xs font-semibold text-stone-500 transition group-hover:text-stone-900">
                    Gérer les utilisateurs →
                </p>

            </a>



            {{-- HOTELS --}}
            <a
                href="{{ route('admin.hotels.index') }}"
                class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-stone-500">
                            Hôtels
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-stone-950">
                            {{ $totalHotels }}
                        </p>

                    </div>


                    {{-- Hotel Icon --}}
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 21h16.5
                                M4.5 21V5.25
                                A1.5 1.5 0 0 1 6 3.75h12
                                A1.5 1.5 0 0 1 19.5 5.25V21
                                M8.25 7.5h1.5
                                M8.25 11.25h1.5
                                M8.25 15h1.5
                                M14.25 7.5h1.5
                                M14.25 11.25h1.5
                                M14.25 15h1.5
                                M9 21v-3.75
                                A1.5 1.5 0 0 1 10.5 15h3
                                A1.5 1.5 0 0 1 15 17.25V21"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-5 text-xs font-semibold text-stone-500 transition group-hover:text-stone-900">
                    Gérer les hôtels →
                </p>

            </a>



            {{-- RESERVATIONS --}}
            <a
                href="{{ route('admin.reservations.index') }}"
                class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-stone-500">
                            Réservations
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-stone-950">
                            {{ $totalReservations }}
                        </p>

                    </div>


                    {{-- Calendar Icon --}}
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.75 3v2.25
                                M17.25 3v2.25
                                M3.75 9h16.5
                                M5.25 4.5h13.5
                                A2.25 2.25 0 0 1 21 6.75v12
                                A2.25 2.25 0 0 1 18.75 21H5.25
                                A2.25 2.25 0 0 1 3 18.75v-12
                                A2.25 2.25 0 0 1 5.25 4.5Z
                                M8.25 12h.008v.008H8.25V12Zm3.75 0h.008v.008H12V12Zm3.75 0h.008v.008H15.75V12Zm-7.5 3.75h.008v.008H8.25v-.008Zm3.75 0h.008v.008H12v-.008Zm3.75 0h.008v.008H15.75v-.008Z"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-5 text-xs font-semibold text-stone-500 transition group-hover:text-stone-900">
                    Gérer les réservations →
                </p>

            </a>



            {{-- AVIS --}}
            <a
                href="{{ route('admin.avis.index') }}"
                class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-stone-500">
                            Avis clients
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-stone-950">
                            {{ \App\Models\Avis::count() }}
                        </p>

                    </div>


                    {{-- Star Icon --}}
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m11.48 3.499
                                a.75.75 0 0 1 1.04 0
                                l2.26 2.318
                                3.12.454
                                a.75.75 0 0 1 .416 1.279
                                l-2.26 2.204
                                .534 3.108
                                a.75.75 0 0 1-1.088.791
                                L12 12.188
                                l-2.792 1.469
                                a.75.75 0 0 1-1.088-.79
                                l.534-3.109-2.26-2.204
                                a.75.75 0 0 1 .416-1.279
                                l3.12-.454 2.26-2.318Z"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-5 text-xs font-semibold text-stone-500 transition group-hover:text-stone-900">
                    Gérer les avis →
                </p>

            </a>

        </div>



        {{-- GESTION DES HOTELS --}}
        <div class="mt-8">

            <div class="mb-5">

                <p class="text-xs font-semibold uppercase tracking-widest text-stone-400">
                    Modération
                </p>

                <h2 class="mt-1 text-xl font-semibold text-stone-950">
                    État des hôtels
                </h2>

            </div>


            <div class="grid gap-5 md:grid-cols-3">


                {{-- EN ATTENTE --}}
                <a
                    href="{{ route('admin.hotels.index') }}"
                    class="group rounded-2xl border border-amber-200 bg-amber-50 p-6 transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-amber-700">
                                En attente
                            </p>

                            <p class="mt-2 text-3xl font-semibold text-amber-900">
                                {{ $hotelsEnAttente }}
                            </p>

                        </div>


                        {{-- Clock Icon --}}
                        <div class="text-amber-700">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-8 w-8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6v6l4 2
                                    M12 21a9 9 0 1 0 0-18
                                    9 9 0 0 0 0 18Z"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-5 text-xs font-semibold text-amber-700">
                        Vérifier les demandes →
                    </p>

                </a>



                {{-- VALIDES --}}
                <a
                    href="{{ route('admin.hotels.index') }}"
                    class="group rounded-2xl border border-green-200 bg-green-50 p-6 transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-green-700">
                                Validés
                            </p>

                            <p class="mt-2 text-3xl font-semibold text-green-900">
                                {{ $hotelsValides }}
                            </p>

                        </div>


                        {{-- Check Icon --}}
                        <div class="text-green-700">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-8 w-8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-5 text-xs font-semibold text-green-700">
                        Voir les hôtels →
                    </p>

                </a>



                {{-- REFUSES --}}
                <a
                    href="{{ route('admin.hotels.index') }}"
                    class="group rounded-2xl border border-red-200 bg-red-50 p-6 transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-red-700">
                                Refusés
                            </p>

                            <p class="mt-2 text-3xl font-semibold text-red-900">
                                {{ $hotelsRefuses }}
                            </p>

                        </div>


                        {{-- X Icon --}}
                        <div class="text-red-700">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-8 w-8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 6l12 12
                                    M18 6 6 18"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-5 text-xs font-semibold text-red-700">
                        Consulter les hôtels →
                    </p>

                </a>

            </div>

        </div>



        {{-- RESERVATIONS --}}
        <div class="mt-8">

            <div class="mb-5">

                <p class="text-xs font-semibold uppercase tracking-widest text-stone-400">
                    Réservations
                </p>

                <h2 class="mt-1 text-xl font-semibold text-stone-950">
                    État des réservations
                </h2>

            </div>


            <div class="grid gap-5 md:grid-cols-3">


                {{-- TOTAL --}}
                <a
                    href="{{ route('admin.reservations.index') }}"
                    class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <p class="text-sm font-medium text-stone-500">
                        Total
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-stone-950">
                        {{ $totalReservations }}
                    </p>

                    <p class="mt-4 text-xs font-semibold text-stone-500 group-hover:text-stone-900">
                        Voir toutes les réservations →
                    </p>

                </a>



                {{-- EN ATTENTE --}}
                <a
                    href="{{ route('admin.reservations.index') }}"
                    class="group rounded-2xl border border-amber-200 bg-amber-50 p-6 transition hover:-translate-y-1 hover:shadow-md"
                >

                    <p class="text-sm font-medium text-amber-700">
                        En attente
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-amber-900">
                        {{ $reservationsEnAttente }}
                    </p>

                    <p class="mt-4 text-xs font-semibold text-amber-700">
                        Gérer les demandes →
                    </p>

                </a>



                {{-- CONFIRMEES --}}
                <a
                    href="{{ route('admin.reservations.index') }}"
                    class="group rounded-2xl border border-green-200 bg-green-50 p-6 transition hover:-translate-y-1 hover:shadow-md"
                >

                    <p class="text-sm font-medium text-green-700">
                        Confirmées
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-green-900">
                        {{ $reservationsConfirmees }}
                    </p>

                    <p class="mt-4 text-xs font-semibold text-green-700">
                        Voir les réservations →
                    </p>

                </a>

            </div>

        </div>



        {{-- QUICK ACTIONS --}}
        <div class="mt-8">

            <div class="mb-5">

                <p class="text-xs font-semibold uppercase tracking-widest text-stone-400">
                    Accès rapide
                </p>

                <h2 class="mt-1 text-xl font-semibold text-stone-950">
                    Gestion de la plateforme
                </h2>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- USERS --}}
                <a
                    href="{{ route('admin.users.index') }}"
                    class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    {{-- Users Icon --}}
                    <div class="text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-8 w-8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372
                                9.337 9.337 0 0 0 4.125-.952
                                4.125 4.125 0 0 0-7.533-2.493
                                M15 19.128v-.003
                                c0-1.113-.285-2.16-.786-3.07
                                M15 19.128v.106A12.318 12.318 0 0 1
                                8.624 21c-2.331 0-4.512-.645-6.374-1.766
                                l-.001-.109a6.375 6.375 0 0 1
                                11.964-3.07
                                M12 6.375a3.375 3.375 0 1 1-6.75 0
                                3.375 3.375 0 0 1 6.75 0
                                Z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-950">
                        Utilisateurs
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Gérer les comptes et les rôles.
                    </p>

                    <p class="mt-4 text-xs font-semibold text-stone-500 group-hover:text-stone-900">
                        Ouvrir →
                    </p>

                </a>



                {{-- HOTELS --}}
                <a
                    href="{{ route('admin.hotels.index') }}"
                    class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    {{-- Hotel Icon --}}
                    <div class="text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-8 w-8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 21h16.5
                                M4.5 21V5.25
                                A1.5 1.5 0 0 1 6 3.75h12
                                A1.5 1.5 0 0 1 19.5 5.25V21
                                M8.25 7.5h1.5
                                M8.25 11.25h1.5
                                M8.25 15h1.5
                                M14.25 7.5h1.5
                                M14.25 11.25h1.5
                                M14.25 15h1.5
                                M9 21v-3.75
                                A1.5 1.5 0 0 1 10.5 15h3
                                A1.5 1.5 0 0 1 15 17.25V21"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-950">
                        Hôtels
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Valider ou refuser les hôtels proposés.
                    </p>

                    <p class="mt-4 text-xs font-semibold text-stone-500 group-hover:text-stone-900">
                        Ouvrir →
                    </p>

                </a>



                {{-- RESERVATIONS --}}
                <a
                    href="{{ route('admin.reservations.index') }}"
                    class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    {{-- Calendar Icon --}}
                    <div class="text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-8 w-8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.75 3v2.25
                                M17.25 3v2.25
                                M3.75 9h16.5
                                M5.25 4.5h13.5
                                A2.25 2.25 0 0 1 21 6.75v12
                                A2.25 2.25 0 0 1 18.75 21H5.25
                                A2.25 2.25 0 0 1 3 18.75v-12
                                A2.25 2.25 0 0 1 5.25 4.5Z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-950">
                        Réservations
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Consulter et gérer les réservations.
                    </p>

                    <p class="mt-4 text-xs font-semibold text-stone-500 group-hover:text-stone-900">
                        Ouvrir →
                    </p>

                </a>



                {{-- AVIS --}}
                <a
                    href="{{ route('admin.avis.index') }}"
                    class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    {{-- Star Icon --}}
                    <div class="text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-8 w-8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m11.48 3.499
                                a.75.75 0 0 1 1.04 0
                                l2.26 2.318
                                3.12.454
                                a.75.75 0 0 1 .416 1.279
                                l-2.26 2.204
                                .534 3.108
                                a.75.75 0 0 1-1.088.791
                                L12 12.188
                                l-2.792 1.469
                                a.75.75 0 0 1-1.088-.79
                                l.534-3.109-2.26-2.204
                                a.75.75 0 0 1 .416-1.279
                                l3.12-.454 2.26-2.318Z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-950">
                        Avis
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Consulter et modérer les avis clients.
                    </p>

                    <p class="mt-4 text-xs font-semibold text-stone-500 group-hover:text-stone-900">
                        Ouvrir →
                    </p>

                </a>

            </div>

        </div>

    </div>

</section>

@endsection