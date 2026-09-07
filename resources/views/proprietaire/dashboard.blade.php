@extends('layouts.app')

@section('title', 'Dashboard Propriétaire - Atlas Stay')

@section('content')

<section class="min-h-[calc(100vh-80px)] bg-stone-50">

    {{-- =========================
        HERO / HEADER
    ========================== --}}
    <div class="border-b border-stone-200 bg-white">

        <div class="mx-auto max-w-7xl px-6 py-12">

            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-stone-400">
                        Espace propriétaire
                    </p>

                    <h1 class="mt-3 text-4xl font-semibold tracking-tight text-stone-950 sm:text-5xl">
                        Bonjour, {{ auth()->user()->nom }}
                    </h1>

                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-500">
                        Gérez vos hébergements, suivez vos réservations
                        et développez votre présence sur Atlas Stay.
                    </p>

                </div>


                {{-- Quick action --}}
                <div>

                    <a
                        href="#"
                        class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-stone-700"
                    >
                        + Ajouter un hôtel
                    </a>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================
        DASHBOARD CONTENT
    ========================== --}}
    <div class="mx-auto max-w-7xl px-6 py-12">


        {{-- =========================
            HOTELS STATISTICS
        ========================== --}}
        <div>

            <div class="mb-6">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-stone-400">
                    Hébergements
                </p>

                <h2 class="mt-2 text-2xl font-semibold tracking-tight text-stone-950">
                    Vue d'ensemble de vos hôtels
                </h2>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- Total hôtels --}}
                <div class="group rounded-3xl border border-stone-200 bg-white p-7 shadow-[0_15px_40px_rgba(0,0,0,0.04)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(0,0,0,0.07)]">

                    <div class="flex items-start justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-stone-100 text-lg">
                            🏨
                        </div>

                        <span class="text-xs font-medium text-stone-400">
                            01
                        </span>

                    </div>

                    <p class="mt-7 text-sm font-medium text-stone-500">
                        Total hôtels
                    </p>

                    <p class="mt-2 text-4xl font-semibold tracking-tight text-stone-950">
                        {{ $totalHotels }}
                    </p>

                </div>


                {{-- En attente --}}
                <div class="group rounded-3xl border border-stone-200 bg-white p-7 shadow-[0_15px_40px_rgba(0,0,0,0.04)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(0,0,0,0.07)]">

                    <div class="flex items-start justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-lg">
                            ⏳
                        </div>

                        <span class="text-xs font-medium text-stone-400">
                            02
                        </span>

                    </div>

                    <p class="mt-7 text-sm font-medium text-stone-500">
                        En attente
                    </p>

                    <p class="mt-2 text-4xl font-semibold tracking-tight text-stone-950">
                        {{ $hotelsEnAttente }}
                    </p>

                    <p class="mt-2 text-xs text-stone-400">
                        En attente de validation
                    </p>

                </div>


                {{-- Validés --}}
                <div class="group rounded-3xl border border-stone-200 bg-white p-7 shadow-[0_15px_40px_rgba(0,0,0,0.04)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(0,0,0,0.07)]">

                    <div class="flex items-start justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-green-50 text-lg">
                            ✓
                        </div>

                        <span class="text-xs font-medium text-stone-400">
                            03
                        </span>

                    </div>

                    <p class="mt-7 text-sm font-medium text-stone-500">
                        Hôtels validés
                    </p>

                    <p class="mt-2 text-4xl font-semibold tracking-tight text-stone-950">
                        {{ $hotelsValides }}
                    </p>

                    <p class="mt-2 text-xs text-stone-400">
                        Visibles sur Atlas Stay
                    </p>

                </div>


                {{-- Refusés --}}
                <div class="group rounded-3xl border border-stone-200 bg-white p-7 shadow-[0_15px_40px_rgba(0,0,0,0.04)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(0,0,0,0.07)]">

                    <div class="flex items-start justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-red-50 text-lg">
                            ×
                        </div>

                        <span class="text-xs font-medium text-stone-400">
                            04
                        </span>

                    </div>

                    <p class="mt-7 text-sm font-medium text-stone-500">
                        Hôtels refusés
                    </p>

                    <p class="mt-2 text-4xl font-semibold tracking-tight text-stone-950">
                        {{ $hotelsRefuses }}
                    </p>

                    <p class="mt-2 text-xs text-stone-400">
                        Nécessitent une attention
                    </p>

                </div>

            </div>

        </div>



        {{-- =========================
            RESERVATIONS
        ========================== --}}
        <div class="mt-14">

            <div class="mb-6">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-stone-400">
                    Réservations
                </p>

                <h2 class="mt-2 text-2xl font-semibold tracking-tight text-stone-950">
                    Activité de vos hébergements
                </h2>

            </div>


            <div class="grid gap-5 lg:grid-cols-3">


                {{-- Total --}}
                <div class="relative overflow-hidden rounded-3xl bg-stone-900 p-8 text-white shadow-[0_20px_50px_rgba(0,0,0,0.12)]">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-lg">
                                📅
                            </div>

                            <span class="text-xs font-medium text-white/40">
                                01
                            </span>

                        </div>

                        <p class="mt-8 text-sm font-medium text-white/60">
                            Total réservations
                        </p>

                        <p class="mt-2 text-5xl font-semibold tracking-tight">
                            {{ $totalReservations }}
                        </p>

                        <p class="mt-3 text-xs leading-5 text-white/50">
                            Toutes les réservations liées à vos hôtels.
                        </p>

                    </div>

                    <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full border border-white/10"></div>

                    <div class="absolute -bottom-24 -right-8 h-56 w-56 rounded-full border border-white/5"></div>

                </div>


                {{-- En attente --}}
                <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-[0_15px_40px_rgba(0,0,0,0.04)]">

                    <div class="flex items-start justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-lg">
                            ⏳
                        </div>

                        <span class="text-xs font-medium text-stone-400">
                            02
                        </span>

                    </div>

                    <p class="mt-8 text-sm font-medium text-stone-500">
                        En attente
                    </p>

                    <p class="mt-2 text-5xl font-semibold tracking-tight text-stone-950">
                        {{ $reservationsEnAttente }}
                    </p>

                    <p class="mt-3 text-xs leading-5 text-stone-400">
                        Réservations nécessitant votre confirmation.
                    </p>

                </div>


                {{-- Confirmées --}}
                <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-[0_15px_40px_rgba(0,0,0,0.04)]">

                    <div class="flex items-start justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-green-50 text-lg">
                            ✓
                        </div>

                        <span class="text-xs font-medium text-stone-400">
                            03
                        </span>

                    </div>

                    <p class="mt-8 text-sm font-medium text-stone-500">
                        Confirmées
                    </p>

                    <p class="mt-2 text-5xl font-semibold tracking-tight text-stone-950">
                        {{ $reservationsConfirmees }}
                    </p>

                    <p class="mt-3 text-xs leading-5 text-stone-400">
                        Réservations confirmées par vos soins.
                    </p>

                </div>

            </div>

        </div>



        {{-- =========================
            QUICK ACTIONS
        ========================== --}}
        <div class="mt-14">

            <div class="mb-6">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-stone-400">
                    Gestion
                </p>

                <h2 class="mt-2 text-2xl font-semibold tracking-tight text-stone-950">
                    Accès rapides
                </h2>

            </div>


            <div class="grid gap-4 md:grid-cols-3">


                {{-- Mes hôtels --}}
                <a
                    href="#"
                    class="group rounded-3xl border border-stone-200 bg-white p-7 transition duration-300 hover:-translate-y-1 hover:border-stone-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.06)]"
                >

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-100 text-lg">
                            🏨
                        </div>

                        <span class="text-xl text-stone-300 transition group-hover:translate-x-1 group-hover:text-stone-900">
                            →
                        </span>

                    </div>

                    <h3 class="mt-6 text-lg font-semibold text-stone-900">
                        Mes hôtels
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Consultez et gérez vos établissements.
                    </p>

                </a>


                {{-- Réservations --}}
                <a
                    href="#"
                    class="group rounded-3xl border border-stone-200 bg-white p-7 transition duration-300 hover:-translate-y-1 hover:border-stone-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.06)]"
                >

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-100 text-lg">
                            📋
                        </div>

                        <span class="text-xl text-stone-300 transition group-hover:translate-x-1 group-hover:text-stone-900">
                            →
                        </span>

                    </div>

                    <h3 class="mt-6 text-lg font-semibold text-stone-900">
                        Réservations
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Consultez et gérez les demandes de vos clients.
                    </p>

                </a>


                {{-- Notifications --}}
                <a
                    href="{{ route('notifications.index') }}"
                    class="group rounded-3xl border border-stone-200 bg-white p-7 transition duration-300 hover:-translate-y-1 hover:border-stone-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.06)]"
                >

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-100 text-lg">
                            🔔
                        </div>

                        <span class="text-xl text-stone-300 transition group-hover:translate-x-1 group-hover:text-stone-900">
                            →
                        </span>

                    </div>

                    <h3 class="mt-6 text-lg font-semibold text-stone-900">
                        Notifications
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Consultez les dernières notifications reçues.
                    </p>

                </a>

            </div>

        </div>



        {{-- Bottom note --}}
        <div class="mt-14 border-t border-stone-200 pt-8">

            <div class="flex flex-col justify-between gap-4 text-xs text-stone-400 sm:flex-row">

                <p>
                    Atlas Stay · Espace propriétaire
                </p>

                <p>
                    Gérez vos hébergements en toute simplicité.
                </p>

            </div>

        </div>

    </div>

</section>

@endsection