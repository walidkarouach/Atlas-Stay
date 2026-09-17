@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">

            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">
                Espace propriétaire
            </p>

            <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900">
                Dashboard propriétaire
            </h1>

            <p class="mt-3 text-slate-600">
                Gérez vos hôtels et vos réservations depuis votre espace personnel.
            </p>

        </div>


        {{-- Hotels --}}
        <div class="mb-10">

            <div class="mb-5 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-slate-900">
                        Mes hôtels
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Vue globale de vos établissements.
                    </p>

                </div>

                <a
                    href="{{ route('proprietaire.hotels.index') }}"
                    class="text-sm font-semibold text-emerald-600 hover:text-emerald-700"
                >
                    Voir mes hôtels →
                </a>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <p class="text-sm text-slate-500">
                        Total hôtels
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalHotels }}
                    </p>

                </div>


                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">

                    <p class="text-sm text-amber-700">
                        En attente
                    </p>

                    <p class="mt-2 text-3xl font-bold text-amber-900">
                        {{ $hotelsEnAttente }}
                    </p>

                </div>


                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6">

                    <p class="text-sm text-emerald-700">
                        Validés
                    </p>

                    <p class="mt-2 text-3xl font-bold text-emerald-900">
                        {{ $hotelsValides }}
                    </p>

                </div>


                <div class="rounded-2xl border border-red-200 bg-red-50 p-6">

                    <p class="text-sm text-red-700">
                        Refusés
                    </p>

                    <p class="mt-2 text-3xl font-bold text-red-900">
                        {{ $hotelsRefuses }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Reservations --}}
        <div class="mb-10">

            <div class="mb-5 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-slate-900">
                        Réservations
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Suivez les réservations de vos hôtels.
                    </p>

                </div>

                <a
                    href="{{ route('proprietaire.reservations.index') }}"
                    class="text-sm font-semibold text-emerald-600 hover:text-emerald-700"
                >
                    Voir les réservations →
                </a>

            </div>


            <div class="grid gap-5 md:grid-cols-3">

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <p class="text-sm text-slate-500">
                        Total réservations
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalReservations }}
                    </p>

                </div>


                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">

                    <p class="text-sm text-amber-700">
                        En attente
                    </p>

                    <p class="mt-2 text-3xl font-bold text-amber-900">
                        {{ $reservationsEnAttente }}
                    </p>

                </div>


                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6">

                    <p class="text-sm text-emerald-700">
                        Confirmées
                    </p>

                    <p class="mt-2 text-3xl font-bold text-emerald-900">
                        {{ $reservationsConfirmees }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Actions rapides --}}
        <div>

            <h2 class="mb-5 text-2xl font-bold text-slate-900">
                Actions rapides
            </h2>


            <div class="grid gap-4 md:grid-cols-3">

                {{-- Ajouter un hôtel --}}
                <a
                    href="{{ route('proprietaire.hotels.create') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-900 text-white">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 font-bold text-slate-900">
                        Ajouter un hôtel
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Ajoutez un nouvel établissement à Atlas Stay.
                    </p>

                </a>


                {{-- Mes hôtels --}}
                <a
                    href="{{ route('proprietaire.hotels.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">

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
                                d="M3 20l6-8 4 5 3-4 5 7H3z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 9l2-3 2 3"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 font-bold text-slate-900">
                        Mes hôtels
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Consultez et gérez vos établissements.
                    </p>

                </a>


                {{-- Réservations --}}
                <a
                    href="{{ route('proprietaire.reservations.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                                ry="2"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 3v4M8 3v4M3 10h18"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 14h.01M12 14h.01M16 14h.01M8 17h.01M12 17h.01"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 font-bold text-slate-900">
                        Réservations
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Gérez les demandes de réservation.
                    </p>

                </a>

            </div>

        </div>

    </div>

</div>

@endsection