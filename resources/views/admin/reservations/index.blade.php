@extends('layouts.app')

@section('title', 'Gestion des réservations - Atlas Stay')

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
                    Gestion des réservations
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-stone-600">
                    Consultez et gérez toutes les réservations effectuées
                    sur la plateforme Atlas Stay.
                </p>

            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex w-fit items-center rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                ← Retour au dashboard
            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))

            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ERRORS --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                @foreach ($errors->all() as $error)

                    <p class="text-sm font-medium text-red-800">
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- STATISTICS --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                <p class="text-sm text-stone-500">
                    Total
                </p>

                <p class="mt-2 text-3xl font-semibold text-stone-950">
                    {{ \App\Models\Reservation::count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

                <p class="text-sm text-amber-700">
                    En attente
                </p>

                <p class="mt-2 text-3xl font-semibold text-amber-900">
                    {{ \App\Models\Reservation::where('statut', 'en_attente')->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

                <p class="text-sm text-green-700">
                    Confirmées
                </p>

                <p class="mt-2 text-3xl font-semibold text-green-900">
                    {{ \App\Models\Reservation::where('statut', 'confirmee')->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <p class="text-sm text-red-700">
                    Annulées
                </p>

                <p class="mt-2 text-3xl font-semibold text-red-900">
                    {{ \App\Models\Reservation::where('statut', 'annulee')->count() }}
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

                                    <p class="font-semibold text-stone-950">
                                        #{{ $reservation->id_reservation }}
                                    </p>

                                    <p class="mt-1 text-xs text-stone-500">
                                        {{ $reservation->nb_personnes }}
                                        {{ $reservation->nb_personnes > 1 ? 'personnes' : 'personne' }}
                                    </p>

                                </td>


                                {{-- CLIENT --}}
                                <td class="px-6 py-5">

                                    @if ($reservation->utilisateur)

                                        <p class="text-sm font-medium text-stone-800">
                                            {{ $reservation->utilisateur->nom }}
                                        </p>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $reservation->utilisateur->email }}
                                        </p>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Client introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- HOTEL --}}
                                <td class="px-6 py-5">

                                    @if ($reservation->hotel)

                                        <p class="text-sm font-medium text-stone-800">
                                            {{ $reservation->hotel->nom }}
                                        </p>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $reservation->hotel->ville }}
                                        </p>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Hôtel introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- DATES --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-medium text-stone-800">
                                        {{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}
                                    </p>

                                    <p class="mt-1 text-xs text-stone-500">
                                        → {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}
                                    </p>

                                </td>


                                {{-- MONTANT --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-semibold text-stone-900">
                                        {{ number_format($reservation->montant_total, 0, ',', ' ') }} DH
                                    </p>

                                </td>


                                {{-- STATUT --}}
                                <td class="px-6 py-5">

                                    @if ($reservation->statut === 'en_attente')

                                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                            En attente
                                        </span>

                                    @elseif ($reservation->statut === 'confirmee')

                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                            Confirmée
                                        </span>

                                    @elseif ($reservation->statut === 'refusee')

                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                            Refusée
                                        </span>

                                    @elseif ($reservation->statut === 'annulee')

                                        <span class="inline-flex rounded-full bg-stone-200 px-3 py-1 text-xs font-semibold text-stone-700">
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

                                    @if (!in_array($reservation->statut, ['annulee', 'refusee']))

                                        <form
                                            action="{{ route('admin.reservations.cancel', $reservation->id_reservation) }}"
                                            method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50"
                                            >
                                                Annuler
                                            </button>

                                        </form>

                                    @else

                                        <span class="text-xs text-stone-400">
                                            Aucune action
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="text-4xl">
                                        📅
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

                        <div>

                            <p class="text-xs uppercase tracking-wide text-stone-400">
                                Réservation
                            </p>

                            <h2 class="mt-1 font-semibold text-stone-950">
                                #{{ $reservation->id_reservation }}
                            </h2>

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
                    <div class="mt-6 space-y-4">

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


                    {{-- ACTION --}}
                    @if (!in_array($reservation->statut, ['annulee', 'refusee']))

                        <form
                            action="{{ route('admin.reservations.cancel', $reservation->id_reservation) }}"
                            method="POST"
                            class="mt-6"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="w-full rounded-xl border border-red-200 px-4 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-50"
                            >
                                Annuler la réservation
                            </button>

                        </form>

                    @endif

                </div>

            @empty

                <div class="rounded-2xl border border-stone-200 bg-white px-6 py-16 text-center">

                    <div class="text-4xl">
                        📅
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

@endsection