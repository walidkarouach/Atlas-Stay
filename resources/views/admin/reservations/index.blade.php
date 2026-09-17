@extends('layouts.app')

@section('title', 'Gestion des réservations - Atlas Stay')

@section('content')

<section class="min-h-screen bg-stone-50">

    <div class="mx-auto max-w-7xl px-6 py-12">

        {{-- HEADER --}}
        <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

            <div>

                <div class="mb-3 flex items-center gap-2 text-stone-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                    </svg>

                    <p class="text-sm font-semibold uppercase tracking-widest">
                        Administration
                    </p>
                </div>

                <h1 class="text-3xl font-semibold tracking-tight text-stone-950 md:text-4xl">
                    Gestion des réservations
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-stone-600">
                    Consultez et gérez toutes les réservations effectuées
                    sur la plateforme Atlas Stay.
                </p>

            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10 19l-7-7m0 0 7-7m-7 7h20"/>
                </svg>

                Retour au dashboard
            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))

            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100 text-green-700">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m5 12 4 4L19 6"/>
                    </svg>

                </div>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ERRORS --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v4m0 4h.01M10.3 3.8 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 3.8a2 2 0 0 0-3.4 0Z"/>
                    </svg>

                    <div class="space-y-1">

                        @foreach ($errors->all() as $error)

                            <p class="text-sm font-medium text-red-800">
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif


        {{-- STATISTICS --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- TOTAL --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-stone-500">
                        Total
                    </p>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 7V3m8 4V3m-9 4h10a2 2 0 0 1 2 2v12H5V9a2 2 0 0 1 2-2Zm-2 6h14"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold text-stone-950">
                    {{ \App\Models\Reservation::count() }}
                </p>

                <p class="mt-2 text-xs text-stone-500">
                    Toutes les réservations
                </p>

            </div>


            {{-- EN ATTENTE --}}
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-amber-700">
                        En attente
                    </p>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round" d="M12 7v5l3 2"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold text-amber-900">
                    {{ \App\Models\Reservation::where('statut', 'en_attente')->count() }}
                </p>

                <p class="mt-2 text-xs text-amber-700">
                    Demandes à traiter
                </p>

            </div>


            {{-- CONFIRMEES --}}
            <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-green-700">
                        Confirmées
                    </p>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-green-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m5 12 4 4L19 6"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold text-green-900">
                    {{ \App\Models\Reservation::where('statut', 'confirmee')->count() }}
                </p>

                <p class="mt-2 text-xs text-green-700">
                    Réservations validées
                </p>

            </div>


            {{-- ANNULEES --}}
            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-red-700">
                        Annulées
                    </p>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m7 7 10 10M17 7 7 17"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold text-red-900">
                    {{ \App\Models\Reservation::where('statut', 'annulee')->count() }}
                </p>

                <p class="mt-2 text-xs text-red-700">
                    Réservations annulées
                </p>

            </div>

        </div>


        {{-- DESKTOP TABLE --}}
        <div class="hidden overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm lg:block">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="border-b border-stone-200 bg-stone-50">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Réservation
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Client
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Hôtel
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Séjour
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Montant
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Statut
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-stone-100">

                        @forelse ($reservations as $reservation)

                            <tr class="transition hover:bg-stone-50">

                                {{-- RESERVATION --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-start gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M8 7V3m8 4V3m-9 4h10a2 2 0 0 1 2 2v12H5V9a2 2 0 0 1 2-2Z"/>
                                                <path stroke-linecap="round" d="M8 13h2m4 0h2m-8 4h2m4 0h2"/>
                                            </svg>

                                        </div>

                                        <div>

                                            <p class="font-semibold text-stone-950">
                                                #{{ $reservation->id_reservation }}
                                            </p>

                                            <p class="mt-1 text-xs text-stone-500">
                                                {{ $reservation->nb_personnes }}
                                                {{ $reservation->nb_personnes > 1 ? 'personnes' : 'personne' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- CLIENT --}}
                                <td class="px-6 py-5">

                                    @if ($reservation->utilisateur)

                                        <div class="flex items-start gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-stone-100 text-sm font-semibold text-stone-700">
                                                {{ strtoupper(substr($reservation->utilisateur->nom, 0, 1)) }}
                                            </div>

                                            <div>

                                                <p class="text-sm font-medium text-stone-800">
                                                    {{ $reservation->utilisateur->nom }}
                                                </p>

                                                <p class="mt-1 text-xs text-stone-500">
                                                    {{ $reservation->utilisateur->email }}
                                                </p>

                                            </div>

                                        </div>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Client introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- HOTEL --}}
                                <td class="px-6 py-5">

                                    @if ($reservation->hotel)

                                        <div class="flex items-start gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 21h18M5 21V5l7-3 7 3v16M9 8h1m4 0h1M9 12h1m4 0h1M9 16h1m4 0h1"/>
                                                </svg>

                                            </div>

                                            <div>

                                                <p class="text-sm font-medium text-stone-800">
                                                    {{ $reservation->hotel->nom }}
                                                </p>

                                                <p class="mt-1 text-xs text-stone-500">
                                                    {{ $reservation->hotel->ville }}
                                                </p>

                                            </div>

                                        </div>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Hôtel introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- DATES --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-start gap-2">

                                        <svg class="mt-0.5 h-4 w-4 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                                            <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/>
                                        </svg>

                                        <div>

                                            <p class="text-sm font-medium text-stone-800">
                                                {{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}
                                            </p>

                                            <p class="mt-1 text-xs text-stone-500">
                                                → {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- MONTANT --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-2">

                                        <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 1v22M17 5H9a4 4 0 0 0 0 8h6a4 4 0 0 1 0 8H7"/>
                                        </svg>

                                        <p class="text-sm font-semibold text-stone-900">
                                            {{ number_format($reservation->montant_total, 0, ',', ' ') }} DH
                                        </p>

                                    </div>

                                </td>


                                {{-- STATUT --}}
                                <td class="px-6 py-5">

                                    @if ($reservation->statut === 'en_attente')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">

                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                            En attente

                                        </span>

                                    @elseif ($reservation->statut === 'confirmee')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">

                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                            Confirmée

                                        </span>

                                    @elseif ($reservation->statut === 'refusee')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">

                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                            Refusée

                                        </span>

                                    @elseif ($reservation->statut === 'annulee')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-stone-200 px-3 py-1 text-xs font-semibold text-stone-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span>

                                            Annulée

                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                                            {{ $reservation->statut }}
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-col items-end gap-2">

                                        {{-- CONFIRMER --}}
                                        @if ($reservation->statut === 'en_attente')

                                            <form
                                                action="{{ route('admin.reservations.confirm', $reservation->id_reservation) }}"
                                                method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir confirmer cette réservation ?');"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-lg border border-green-200 px-3 py-2 text-xs font-semibold text-green-700 transition hover:bg-green-50"
                                                >

                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m5 12 4 4L19 6"/>
                                                    </svg>

                                                    Confirmer

                                                </button>

                                            </form>

                                        @endif


                                        {{-- ANNULER --}}
                                        @if (!in_array($reservation->statut, ['annulee', 'refusee']))

                                            <button
                                                    type="button"
                                                    class="open-reservation-cancel-modal inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50"
                                                 data-cancel-url="{{ route('admin.reservations.cancel', $reservation->id_reservation) }}" data-reservation-id="{{ $reservation->id_reservation }}">

                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m7 7 10 10M17 7 7 17"/>
                                                    </svg>

                                                    Annuler

                                                </button>

                                        @endif


                                        @if (
                                            $reservation->statut !== 'en_attente'
                                            && in_array($reservation->statut, ['annulee', 'refusee'])
                                        )

                                            <span class="text-xs text-stone-400">
                                                Aucune action
                                            </span>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-100 text-stone-500">

                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                                            <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/>
                                            <path stroke-linecap="round" d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                                        </svg>

                                    </div>

                                    <p class="mt-4 font-semibold text-stone-900">
                                        Aucune réservation
                                    </p>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Aucune réservation n'est actuellement enregistrée.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- MOBILE CARDS --}}
        <div class="space-y-4 lg:hidden">

            @forelse ($reservations as $reservation)

                <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                    {{-- HEADER --}}
                    <div class="flex items-start justify-between gap-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8 7V3m8 4V3m-9 4h10a2 2 0 0 1 2 2v12H5V9a2 2 0 0 1 2-2Z"/>
                                </svg>

                            </div>

                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Réservation
                                </p>

                                <h2 class="mt-1 font-semibold text-stone-950">
                                    #{{ $reservation->id_reservation }}
                                </h2>

                            </div>

                        </div>


                        {{-- STATUS --}}
                        @if ($reservation->statut === 'en_attente')

                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                En attente
                            </span>

                        @elseif ($reservation->statut === 'confirmee')

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                Confirmée
                            </span>

                        @elseif ($reservation->statut === 'refusee')

                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                Refusée
                            </span>

                        @elseif ($reservation->statut === 'annulee')

                            <span class="rounded-full bg-stone-200 px-3 py-1 text-xs font-semibold text-stone-700">
                                Annulée
                            </span>

                        @endif

                    </div>


                    {{-- DETAILS --}}
                    <div class="mt-6 space-y-5">

                        {{-- CLIENT --}}
                        <div class="flex gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stone-100 text-sm font-semibold text-stone-700">

                                @if ($reservation->utilisateur)
                                    {{ strtoupper(substr($reservation->utilisateur->nom, 0, 1)) }}
                                @else
                                    ?
                                @endif

                            </div>

                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Client
                                </p>

                                @if ($reservation->utilisateur)

                                    <p class="mt-1 text-sm font-medium text-stone-800">
                                        {{ $reservation->utilisateur->nom }}
                                    </p>

                                    <p class="text-xs text-stone-500">
                                        {{ $reservation->utilisateur->email }}
                                    </p>

                                @else

                                    <p class="mt-1 text-sm text-stone-400">
                                        Client introuvable
                                    </p>

                                @endif

                            </div>

                        </div>


                        {{-- HOTEL --}}
                        <div class="flex gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 21h18M5 21V5l7-3 7 3v16M9 8h1m4 0h1M9 12h1m4 0h1M9 16h1m4 0h1"/>
                                </svg>

                            </div>

                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Hôtel
                                </p>

                                @if ($reservation->hotel)

                                    <p class="mt-1 text-sm font-medium text-stone-800">
                                        {{ $reservation->hotel->nom }}
                                    </p>

                                    <p class="text-xs text-stone-500">
                                        {{ $reservation->hotel->ville }}
                                    </p>

                                @else

                                    <p class="mt-1 text-sm text-stone-400">
                                        Hôtel introuvable
                                    </p>

                                @endif

                            </div>

                        </div>


                        {{-- SEJOUR --}}
                        <div class="flex gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                                    <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/>
                                </svg>

                            </div>

                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Séjour
                                </p>

                                <p class="mt-1 text-sm text-stone-800">
                                    {{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}
                                    →
                                    {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}
                                </p>

                            </div>

                        </div>


                        {{-- VOYAGEURS + TOTAL --}}
                        <div class="flex items-center justify-between border-t border-stone-100 pt-4">

                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Voyageurs
                                </p>

                                <p class="mt-1 text-sm font-medium text-stone-800">
                                    {{ $reservation->nb_personnes }}
                                    {{ $reservation->nb_personnes > 1 ? 'personnes' : 'personne' }}
                                </p>

                            </div>


                            <div class="text-right">

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Total
                                </p>

                                <p class="mt-1 text-sm font-semibold text-stone-950">
                                    {{ number_format($reservation->montant_total, 0, ',', ' ') }} DH
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ACTIONS --}}
                    <div class="mt-6 space-y-3">

                        {{-- CONFIRMER --}}
                        @if ($reservation->statut === 'en_attente')

                            <form
                                action="{{ route('admin.reservations.confirm', $reservation->id_reservation) }}"
                                method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir confirmer cette réservation ?');"
                            >

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-green-200 px-4 py-3 text-sm font-semibold text-green-700 transition hover:bg-green-50"
                                >

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m5 12 4 4L19 6"/>
                                    </svg>

                                    Confirmer la réservation

                                </button>

                            </form>

                        @endif


                        {{-- ANNULER --}}
                        @if (!in_array($reservation->statut, ['annulee', 'refusee']))

                            <button
                                    type="button"
                                    class="open-reservation-cancel-modal inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 px-4 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-50"
                                 data-cancel-url="{{ route('admin.reservations.cancel', $reservation->id_reservation) }}" data-reservation-id="{{ $reservation->id_reservation }}">

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m7 7 10 10M17 7 7 17"/>
                                    </svg>

                                    Annuler la réservation

                                </button>

                        @endif

                    </div>

                </div>

            @empty

                <div class="rounded-2xl border border-stone-200 bg-white px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-100 text-stone-500">

                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                            <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/>
                            <path stroke-linecap="round" d="M8 14h.01M12 14h.01M16 14h.01"/>
                        </svg>

                    </div>

                    <p class="mt-4 font-semibold text-stone-900">
                        Aucune réservation
                    </p>

                    <p class="mt-1 text-sm text-stone-500">
                        Aucune réservation n'est actuellement enregistrée.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if ($reservations->hasPages())

            <div class="mt-8">
                {{ $reservations->links() }}
            </div>

        @endif

    </div>

</section>



{{-- MODAL CONFIRMATION ANNULATION RESERVATION --}}
<div id="reservationCancelModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 px-4" role="dialog" aria-modal="true" aria-labelledby="reservationCancelModalTitle">
    <div id="reservationCancelModalContent" class="w-full max-w-md scale-95 rounded-3xl bg-white p-6 opacity-0 shadow-2xl transition duration-200 sm:p-8">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.8 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 3.8a2 2 0 0 0-3.4 0Z"/></svg>
            </div>
            <div class="min-w-0">
                <h2 id="reservationCancelModalTitle" class="text-xl font-semibold text-stone-950">Annuler la réservation ?</h2>
                <p class="mt-2 text-sm leading-6 text-stone-600">Êtes-vous sûr de vouloir annuler la réservation <span id="reservationCancelId" class="font-semibold text-stone-900"></span> ? Cette action est irréversible.</p>
            </div>
        </div>
        <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <button type="button" id="cancelReservationModal" class="inline-flex items-center justify-center rounded-xl border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100">Non, garder</button>
            <form id="reservationCancelForm" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700 sm:w-auto">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m7 7 10 10M17 7 7 17"/></svg>
                    Oui, annuler
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('reservationCancelModal');
        const content = document.getElementById('reservationCancelModalContent');
        const form = document.getElementById('reservationCancelForm');
        const reservationId = document.getElementById('reservationCancelId');
        const cancelButton = document.getElementById('cancelReservationModal');

        function openModal(url, id) {
            form.action = url;
            reservationId.textContent = '#' + id;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            requestAnimationFrame(function () {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeModal() {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(function () { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 200);
        }

        document.querySelectorAll('.open-reservation-cancel-modal').forEach(function (trigger) {
            trigger.addEventListener('click', function () { openModal(trigger.dataset.cancelUrl, trigger.dataset.reservationId); });
        });
        cancelButton.addEventListener('click', closeModal);
        modal.addEventListener('click', function (event) { if (event.target === modal) closeModal(); });
        document.addEventListener('keydown', function (event) { if (event.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });
    });
</script>

@endsection