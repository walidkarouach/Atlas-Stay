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

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        👥
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

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        🏨
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

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        📅
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

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        ⭐
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

                        <div class="text-2xl">
                            ⏳
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

                        <div class="text-2xl">
                            ✓
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

                        <div class="text-2xl">
                            ×
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

                    <div class="text-2xl">
                        👥
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

                    <div class="text-2xl">
                        🏨
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

                    <div class="text-2xl">
                        📅
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

                    <div class="text-2xl">
                        ⭐
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