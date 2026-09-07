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
                Réservations
            </h1>

            <p class="mt-3 max-w-2xl text-slate-600">
                Gérez les réservations effectuées dans vos établissements.
            </p>

        </div>


        {{-- Success --}}
        @if (session('success'))

            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                        ✓
                    </div>

                    <p class="text-sm font-medium text-emerald-800">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Errors --}}
        @if ($errors->any())

            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">
                        !
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-900">
                            Une erreur est survenue
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-800">

                            @foreach ($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Liste --}}
        @if ($reservations->count())

            <div class="space-y-5">

                @foreach ($reservations as $reservation)

                    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                        <div class="p-6 lg:p-7">

                            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                                {{-- Informations réservation --}}
                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-wrap items-center gap-3">

                                        <h2 class="text-xl font-bold text-slate-900">
                                            {{ $reservation->hotel->nom }}
                                        </h2>


                                        @if ($reservation->statut === 'en_attente')

                                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                ⏳ En attente
                                            </span>

                                        @elseif ($reservation->statut === 'confirmee')

                                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                ✓ Confirmée
                                            </span>

                                        @elseif ($reservation->statut === 'refusee')

                                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                ✕ Refusée
                                            </span>

                                        @elseif ($reservation->statut === 'annulee')

                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                                Annulée
                                            </span>

                                        @endif

                                    </div>


                                    <p class="mt-2 text-sm text-slate-500">
                                        📍 {{ $reservation->hotel->ville }}
                                        · {{ $reservation->hotel->adresse }}
                                    </p>


                                    {{-- Client --}}
                                    <div class="mt-5 rounded-2xl bg-slate-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                            Client
                                        </p>

                                        <p class="mt-1 font-semibold text-slate-900">
                                            {{ $reservation->utilisateur->nom }}
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $reservation->utilisateur->email }}
                                        </p>

                                    </div>


                                    {{-- Détails --}}
                                    <div class="mt-5 grid gap-3 sm:grid-cols-4">

                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <p class="text-xs text-slate-400">
                                                Arrivée
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                                {{ $reservation->date_arrivee->format('d/m/Y') }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <p class="text-xs text-slate-400">
                                                Départ
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                                {{ $reservation->date_depart->format('d/m/Y') }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <p class="text-xs text-slate-400">
                                                Personnes
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                                {{ $reservation->nb_personnes }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <p class="text-xs text-slate-400">
                                                Montant
                                            </p>

                                            <p class="mt-1 text-sm font-bold text-slate-900">
                                                {{ number_format($reservation->montant_total, 2, ',', ' ') }} DH
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- Actions --}}
                                <div class="w-full lg:w-56">

                                    @if ($reservation->statut === 'en_attente')

                                        <div class="space-y-3">

                                            {{-- Confirmer --}}
                                            <form
                                                action="{{ route('proprietaire.reservations.confirm', $reservation->id_reservation) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="w-full rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                                                >
                                                    ✓ Confirmer
                                                </button>

                                            </form>


                                            {{-- Refuser --}}
                                            <form
                                                action="{{ route('proprietaire.reservations.reject', $reservation->id_reservation) }}"
                                                method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir refuser cette réservation ?');"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="w-full rounded-xl border border-red-200 bg-white px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                                >
                                                    ✕ Refuser
                                                </button>

                                            </form>

                                        </div>

                                    @elseif ($reservation->statut === 'confirmee')

                                        <form
                                            action="{{ route('proprietaire.reservations.cancel', $reservation->id_reservation) }}"
                                            method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="w-full rounded-xl border border-red-200 bg-white px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                            >
                                                Annuler la réservation
                                            </button>

                                        </form>

                                    @else

                                        <div class="rounded-xl bg-slate-50 px-5 py-4 text-center">

                                            <p class="text-sm font-medium text-slate-400">
                                                Aucune action disponible
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- Pagination --}}
            @if ($reservations->hasPages())

                <div class="mt-10">

                    {{ $reservations->links() }}

                </div>

            @endif

        @else

            {{-- Empty state --}}
            <div class="rounded-3xl border border-slate-200 bg-white px-6 py-20 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-4xl">
                    📅
                </div>

                <h2 class="mt-6 text-2xl font-bold text-slate-900">
                    Aucune réservation
                </h2>

                <p class="mx-auto mt-3 max-w-lg text-slate-500">
                    Vous n’avez encore reçu aucune réservation
                    pour vos établissements.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection