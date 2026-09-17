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

                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">

                        {{-- Success icon --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

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

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">

                        {{-- Error icon --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.6l-8 14A2 2 0 0 0 4 20.6h16a2 2 0 0 0 1.7-3l-8-14a2 2 0 0 0-3.4 0z"
                            />
                        </svg>

                    </div>


                    <div>

                        <h3 class="font-semibold text-red-900">
                            Une erreur est survenue
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-800">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
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


                                        {{-- Statut --}}
                                        @if ($reservation->statut === 'en_attente')

                                            <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">

                                                {{-- Clock icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M12 7v5l3 2"
                                                    />
                                                </svg>

                                                En attente

                                            </span>

                                        @elseif ($reservation->statut === 'confirmee')

                                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">

                                                {{-- Check icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>

                                                Confirmée

                                            </span>

                                        @elseif ($reservation->statut === 'refusee')

                                            <span class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                                {{-- X icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 6l12 12M6 18L18 6"
                                                    />
                                                </svg>

                                                Refusée

                                            </span>

                                        @elseif ($reservation->statut === 'annulee')

                                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">

                                                {{-- Ban icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 6l12 12"
                                                    />
                                                </svg>

                                                Annulée

                                            </span>

                                        @endif

                                    </div>


                                    {{-- Localisation --}}
                                    <p class="mt-2 flex items-center gap-2 text-sm text-slate-500">

                                        {{-- Location icon --}}
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor"
                                            class="h-4 w-4 shrink-0"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="9"
                                                r="2.5"
                                            />
                                        </svg>

                                        {{ $reservation->hotel->ville }}
                                        ·
                                        {{ $reservation->hotel->adresse }}

                                    </p>


                                    {{-- Client --}}
                                    <div class="mt-5 rounded-2xl bg-slate-50 p-4">

                                        <div class="flex items-start gap-3">

                                            {{-- User icon --}}
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

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
                                                        d="M15 19a6 6 0 0 0-12 0"
                                                    />

                                                    <circle
                                                        cx="9"
                                                        cy="7"
                                                        r="4"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 11a4 4 0 1 0 0-8"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M18 19a6 6 0 0 0-4-5.65"
                                                    />
                                                </svg>

                                            </div>


                                            <div>

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

                                        </div>

                                    </div>


                                    {{-- Détails --}}
                                    <div class="mt-5 grid gap-3 sm:grid-cols-4">

                                        {{-- Arrivée --}}
                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <div class="flex items-center gap-2">

                                                {{-- Calendar icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.7"
                                                    stroke="currentColor"
                                                    class="h-4 w-4 text-slate-400"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="5"
                                                        width="18"
                                                        height="16"
                                                        rx="2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M16 3v4M8 3v4M3 10h18"
                                                    />
                                                </svg>

                                                <p class="text-xs text-slate-400">
                                                    Arrivée
                                                </p>

                                            </div>

                                            <p class="mt-2 text-sm font-semibold text-slate-900">
                                                {{ $reservation->date_arrivee->format('d/m/Y') }}
                                            </p>

                                        </div>


                                        {{-- Départ --}}
                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <div class="flex items-center gap-2">

                                                {{-- Calendar icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.7"
                                                    stroke="currentColor"
                                                    class="h-4 w-4 text-slate-400"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="5"
                                                        width="18"
                                                        height="16"
                                                        rx="2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M16 3v4M8 3v4M3 10h18"
                                                    />
                                                </svg>

                                                <p class="text-xs text-slate-400">
                                                    Départ
                                                </p>

                                            </div>

                                            <p class="mt-2 text-sm font-semibold text-slate-900">
                                                {{ $reservation->date_depart->format('d/m/Y') }}
                                            </p>

                                        </div>


                                        {{-- Personnes --}}
                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <div class="flex items-center gap-2">

                                                {{-- Users icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.7"
                                                    stroke="currentColor"
                                                    class="h-4 w-4 text-slate-400"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                                                    />

                                                    <circle
                                                        cx="9"
                                                        cy="7"
                                                        r="4"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                                    />
                                                </svg>

                                                <p class="text-xs text-slate-400">
                                                    Personnes
                                                </p>

                                            </div>

                                            <p class="mt-2 text-sm font-semibold text-slate-900">
                                                {{ $reservation->nb_personnes }}
                                            </p>

                                        </div>


                                        {{-- Montant --}}
                                        <div class="rounded-xl border border-slate-100 bg-white p-3">

                                            <div class="flex items-center gap-2">

                                                {{-- Money icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.7"
                                                    stroke="currentColor"
                                                    class="h-4 w-4 text-slate-400"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="6"
                                                        width="18"
                                                        height="12"
                                                        rx="2"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="3"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M7 10h.01M17 14h.01"
                                                    />
                                                </svg>

                                                <p class="text-xs text-slate-400">
                                                    Montant
                                                </p>

                                            </div>

                                            <p class="mt-2 text-sm font-bold text-slate-900">
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
                                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                                                >

                                                    {{-- Check icon --}}
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="2"
                                                        stroke="currentColor"
                                                        class="h-5 w-5"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 13l4 4L19 7"
                                                        />
                                                    </svg>

                                                    Confirmer

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
                                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                                >

                                                    {{-- X icon --}}
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="2"
                                                        stroke="currentColor"
                                                        class="h-5 w-5"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M6 6l12 12M6 18L18 6"
                                                        />
                                                    </svg>

                                                    Refuser

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
                                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                            >

                                                {{-- Cancel icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-5 w-5"
                                                >
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 6l12 12"
                                                    />
                                                </svg>

                                                Annuler la réservation

                                            </button>

                                        </form>


                                    @else

                                        <div class="rounded-xl bg-slate-50 px-5 py-4 text-center">

                                            <div class="mb-2 flex justify-center text-slate-400">

                                                {{-- Lock icon --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.7"
                                                    stroke="currentColor"
                                                    class="h-6 w-6"
                                                >
                                                    <rect
                                                        x="5"
                                                        y="10"
                                                        width="14"
                                                        height="10"
                                                        rx="2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 10V7a4 4 0 0 1 8 0v3"
                                                    />
                                                </svg>

                                            </div>

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

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">

                    {{-- Calendar empty icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.6"
                        stroke="currentColor"
                        class="h-10 w-10"
                    >
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />

                        <path
                            stroke-linecap="round"
                            d="M16 3v4M8 3v4M3 10h18"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 15l2 2 4-4"
                        />
                    </svg>

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