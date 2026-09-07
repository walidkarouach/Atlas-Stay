@extends('layouts.app')

@section('title', 'Dashboard Admin - Atlas Stay')

@section('content')

<div class="min-h-screen bg-stone-50">

    {{-- HEADER --}}
    <section class="border-b border-stone-200 bg-white">

        <div class="mx-auto max-w-7xl px-6 py-10">

            <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">

                <div>

                    <p class="text-sm font-medium uppercase tracking-widest text-stone-500">
                        Espace administration
                    </p>

                    <h1 class="mt-2 text-4xl font-semibold tracking-tight text-stone-950">
                        Dashboard
                    </h1>

                    <p class="mt-3 text-stone-500">
                        Bienvenue, {{ auth()->user()->nom }}.
                        Voici un aperçu de votre plateforme Atlas Stay.
                    </p>

                </div>

                <div class="rounded-2xl border border-stone-200 bg-stone-50 px-5 py-4">

                    <p class="text-xs font-medium uppercase tracking-wider text-stone-500">
                        Administrateur
                    </p>

                    <p class="mt-1 text-sm font-semibold text-stone-900">
                        {{ auth()->user()->email }}
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- STATISTICS --}}
    <section class="mx-auto max-w-7xl px-6 py-10">

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


            {{-- USERS --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        👥
                    </div>

                    <span class="text-xs font-medium uppercase tracking-wider text-stone-400">
                        Utilisateurs
                    </span>

                </div>

                <p class="mt-6 text-3xl font-semibold text-stone-950">
                    {{ $totalUsers }}
                </p>

                <p class="mt-1 text-sm text-stone-500">
                    Utilisateurs inscrits
                </p>

            </div>


            {{-- HOTELS --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        🏨
                    </div>

                    <span class="text-xs font-medium uppercase tracking-wider text-stone-400">
                        Hôtels
                    </span>

                </div>

                <p class="mt-6 text-3xl font-semibold text-stone-950">
                    {{ $totalHotels }}
                </p>

                <p class="mt-1 text-sm text-stone-500">
                    Hôtels sur la plateforme
                </p>

            </div>


            {{-- RESERVATIONS --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        📅
                    </div>

                    <span class="text-xs font-medium uppercase tracking-wider text-stone-400">
                        Réservations
                    </span>

                </div>

                <p class="mt-6 text-3xl font-semibold text-stone-950">
                    {{ $totalReservations }}
                </p>

                <p class="mt-1 text-sm text-stone-500">
                    Réservations effectuées
                </p>

            </div>


            {{-- PENDING --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        ⏳
                    </div>

                    <span class="text-xs font-medium uppercase tracking-wider text-stone-400">
                        En attente
                    </span>

                </div>

                <p class="mt-6 text-3xl font-semibold text-stone-950">
                    {{ $hotelsEnAttente }}
                </p>

                <p class="mt-1 text-sm text-stone-500">
                    Hôtels à valider
                </p>

            </div>

        </div>


        {{-- HOTELS STATUS --}}
        <div class="mt-8 grid gap-5 md:grid-cols-3">


            {{-- VALIDATED --}}
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-emerald-700">
                            Hôtels validés
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-emerald-950">
                            {{ $hotelsValides }}
                        </p>

                    </div>

                    <div class="text-2xl">
                        ✓
                    </div>

                </div>

            </div>


            {{-- PENDING --}}
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-amber-700">
                            Hôtels en attente
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-amber-950">
                            {{ $hotelsEnAttente }}
                        </p>

                    </div>

                    <div class="text-2xl">
                        ⏳
                    </div>

                </div>

            </div>


            {{-- REFUSED --}}
            <div class="rounded-2xl border border-red-200 bg-red-50 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-red-700">
                            Hôtels refusés
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-red-950">
                            {{ $hotelsRefuses }}
                        </p>

                    </div>

                    <div class="text-2xl">
                        ✕
                    </div>

                </div>

            </div>

        </div>


        {{-- RESERVATIONS STATUS --}}
        <div class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium uppercase tracking-wider text-stone-400">
                        Réservations
                    </p>

                    <h2 class="mt-1 text-2xl font-semibold text-stone-950">
                        État des réservations
                    </h2>

                </div>

            </div>


            <div class="mt-6 grid gap-5 md:grid-cols-2">


                {{-- PENDING RESERVATIONS --}}
                <div class="rounded-xl border border-amber-200 bg-amber-50 p-5">

                    <p class="text-sm font-medium text-amber-700">
                        En attente
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-amber-950">
                        {{ $reservationsEnAttente }}
                    </p>

                    <p class="mt-1 text-sm text-amber-700/70">
                        Réservations en attente de traitement
                    </p>

                </div>


                {{-- CONFIRMED RESERVATIONS --}}
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-5">

                    <p class="text-sm font-medium text-emerald-700">
                        Confirmées
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-emerald-950">
                        {{ $reservationsConfirmees }}
                    </p>

                    <p class="mt-1 text-sm text-emerald-700/70">
                        Réservations confirmées
                    </p>

                </div>

            </div>

        </div>


        {{-- QUICK ACTIONS --}}
        <div class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

            <p class="text-sm font-medium uppercase tracking-wider text-stone-400">
                Administration
            </p>

            <h2 class="mt-1 text-2xl font-semibold text-stone-950">
                Gestion de la plateforme
            </h2>

            <div class="mt-6 grid gap-4 md:grid-cols-3">


                {{-- USERS --}}
                <a
                    href="#"
                    class="group rounded-xl border border-stone-200 p-5 transition hover:border-stone-400 hover:bg-stone-50"
                >

                    <div class="flex items-center justify-between">

                        <span class="text-2xl">
                            👥
                        </span>

                        <span class="text-stone-400 transition group-hover:translate-x-1">
                            →
                        </span>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-900">
                        Utilisateurs
                    </h3>

                    <p class="mt-1 text-sm text-stone-500">
                        Gérer les comptes et les rôles.
                    </p>

                </a>


                {{-- HOTELS --}}
                <a
                    href="#"
                    class="group rounded-xl border border-stone-200 p-5 transition hover:border-stone-400 hover:bg-stone-50"
                >

                    <div class="flex items-center justify-between">

                        <span class="text-2xl">
                            🏨
                        </span>

                        <span class="text-stone-400 transition group-hover:translate-x-1">
                            →
                        </span>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-900">
                        Hôtels
                    </h3>

                    <p class="mt-1 text-sm text-stone-500">
                        Valider ou refuser les hôtels.
                    </p>

                </a>


                {{-- RESERVATIONS --}}
                <a
                    href="#"
                    class="group rounded-xl border border-stone-200 p-5 transition hover:border-stone-400 hover:bg-stone-50"
                >

                    <div class="flex items-center justify-between">

                        <span class="text-2xl">
                            📅
                        </span>

                        <span class="text-stone-400 transition group-hover:translate-x-1">
                            →
                        </span>

                    </div>

                    <h3 class="mt-4 font-semibold text-stone-900">
                        Réservations
                    </h3>

                    <p class="mt-1 text-sm text-stone-500">
                        Consulter les réservations.
                    </p>

                </a>

            </div>

        </div>

    </section>

</div>

@endsection