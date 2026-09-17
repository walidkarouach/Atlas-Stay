@extends('layouts.app')

@section('title', 'Gestion des hôtels - Atlas Stay')

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
                    Gestion des hôtels
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-stone-600">
                    Consultez, validez, refusez ou supprimez les hôtels proposés
                    par les propriétaires.
                </p>

            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 19l-7-7m0 0l7-7m-7 7h20"
                    />
                </svg>

                Retour au dashboard
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-700">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ERROR MESSAGE --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="mb-3 flex items-center gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"
                            />
                        </svg>

                    </div>

                    <p class="font-semibold text-red-800">
                        Une erreur est survenue
                    </p>

                </div>

                <div class="space-y-1">

                    @foreach ($errors->all() as $error)

                        <p class="text-sm font-medium text-red-800">
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- STATISTIQUES --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- TOTAL --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-stone-500">
                        Total
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-4h6v4M9 12h.01M15 12h.01M9 15h.01M15 15h.01"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-2 text-3xl font-semibold text-stone-950">
                    {{ $hotels->total() }}
                </p>

                <p class="mt-2 text-xs text-stone-500">
                    Tous les hôtels enregistrés
                </p>

            </div>


            {{-- EN ATTENTE --}}
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-amber-700">
                        En attente
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
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

                    </div>

                </div>

                <p class="mt-2 text-3xl font-semibold text-amber-900">
                    {{ \App\Models\Hotel::where('statut', 'en_attente')->count() }}
                </p>

                <p class="mt-2 text-xs text-amber-700">
                    Hôtels à vérifier
                </p>

            </div>


            {{-- VALIDES --}}
            <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-green-700">
                        Validés
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-green-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-2 text-3xl font-semibold text-green-900">
                    {{ \App\Models\Hotel::where('statut', 'valide')->count() }}
                </p>

                <p class="mt-2 text-xs text-green-700">
                    Hôtels approuvés
                </p>

            </div>


            {{-- REFUSES --}}
            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-red-700">
                        Refusés
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 9l6 6m0-6l-6 6"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-2 text-3xl font-semibold text-red-900">
                    {{ \App\Models\Hotel::where('statut', 'refuse')->count() }}
                </p>

                <p class="mt-2 text-xs text-red-700">
                    Hôtels refusés
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
                                Hôtel
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Localisation
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Propriétaire
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Prix
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Statut
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-stone-100">

                        @forelse ($hotels as $hotel)

                            <tr class="transition hover:bg-stone-50">

                                {{-- HOTEL --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div class="h-14 w-20 shrink-0 overflow-hidden rounded-xl bg-stone-100">

                                            @if ($hotel->images->first())

                                                <img
                                                    src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                                                    alt="{{ $hotel->nom }}"
                                                    class="h-full w-full object-cover"
                                                >

                                            @else

                                                <div class="flex h-full w-full items-center justify-center text-stone-400">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-7 w-7"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M3 20l7-11 4 6 2-3 5 8H3z"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M8 6h.01M12 4h.01"
                                                        />
                                                    </svg>

                                                </div>

                                            @endif

                                        </div>


                                        <div>

                                            <p class="font-semibold text-stone-950">
                                                {{ $hotel->nom }}
                                            </p>

                                            <p class="mt-1 text-xs text-stone-500">
                                                ID #{{ $hotel->id_hotel }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- LOCALISATION --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-medium text-stone-800">
                                        {{ $hotel->ville }}
                                    </p>

                                    <p class="mt-1 max-w-xs text-xs text-stone-500">
                                        {{ $hotel->adresse }}
                                    </p>

                                </td>


                                {{-- PROPRIETAIRE --}}
                                <td class="px-6 py-5">

                                    @if ($hotel->proprietaire)

                                        <p class="text-sm font-medium text-stone-800">
                                            {{ $hotel->proprietaire->nom }}
                                        </p>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $hotel->proprietaire->email }}
                                        </p>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Propriétaire introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- PRIX --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-semibold text-stone-900">
                                        {{ number_format($hotel->prix, 0, ',', ' ') }} DH
                                    </p>

                                    <p class="text-xs text-stone-500">
                                        / nuit
                                    </p>

                                </td>


                                {{-- STATUT --}}
                                <td class="px-6 py-5">

                                    @if ($hotel->statut === 'en_attente')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">

                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>

                                            En attente

                                        </span>

                                    @elseif ($hotel->statut === 'valide')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">

                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>

                                            Validé

                                        </span>

                                    @elseif ($hotel->statut === 'refuse')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">

                                            <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>

                                            Refusé

                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                                            {{ $hotel->statut }}
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-wrap justify-end gap-2">

                                        @if ($hotel->statut === 'en_attente')

                                            {{-- VALIDER --}}
                                            <form
                                                action="{{ route('admin.hotels.validate', $hotel->id_hotel) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-green-700 px-3 py-2 text-xs font-semibold text-white transition hover:bg-green-800"
                                                >

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 13l4 4L19 7"
                                                        />
                                                    </svg>

                                                    Valider

                                                </button>

                                            </form>


                                            {{-- REFUSER --}}
                                            <form
                                                action="{{ route('admin.hotels.reject', $hotel->id_hotel) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-red-700 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-800"
                                                >

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12"
                                                        />
                                                    </svg>

                                                    Refuser

                                                </button>

                                            </form>

                                        @endif


                                        {{-- SUPPRIMER --}}
                                        <button
                                            type="button"
                                            data-delete-url="{{ route('admin.hotels.destroy', $hotel->id_hotel) }}"
                                            data-hotel-name="{{ $hotel->nom }}"
                                            class="open-hotel-delete-modal inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                        >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 6h18M9 6V4h6v2m-9 0l1 14h10l1-14M10 11v5M14 11v5"
                                                    />
                                                </svg>

                                                Supprimer

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-100 text-stone-400">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 20l7-11 4 6 2-3 5 8H3z"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-4 font-semibold text-stone-900">
                                        Aucun hôtel trouvé
                                    </p>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Aucun hôtel n'est actuellement enregistré.
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

            @forelse ($hotels as $hotel)

                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">

                    {{-- IMAGE --}}
                    <div class="h-48 bg-stone-100">

                        @if ($hotel->images->first())

                            <img
                                src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                                alt="{{ $hotel->nom }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-stone-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-12 w-12"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 20l7-11 4 6 2-3 5 8H3z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 6h.01M12 4h.01"
                                    />
                                </svg>

                            </div>

                        @endif

                    </div>


                    <div class="p-5">

                        {{-- TITLE --}}
                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h2 class="font-semibold text-stone-950">
                                    {{ $hotel->nom }}
                                </h2>

                                <p class="mt-1 text-xs text-stone-500">
                                    ID #{{ $hotel->id_hotel }}
                                </p>

                            </div>


                            {{-- STATUS --}}
                            @if ($hotel->statut === 'en_attente')

                                <span class="inline-flex shrink-0 items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">

                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>

                                    En attente

                                </span>

                            @elseif ($hotel->statut === 'valide')

                                <span class="inline-flex shrink-0 items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">

                                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>

                                    Validé

                                </span>

                            @elseif ($hotel->statut === 'refuse')

                                <span class="inline-flex shrink-0 items-center gap-2 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>

                                    Refusé

                                </span>

                            @endif

                        </div>


                        {{-- DETAILS --}}
                        <div class="mt-5 space-y-4">

                            <div>

                                <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-stone-400">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 21s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="2.5"
                                        />
                                    </svg>

                                    Localisation

                                </div>

                                <p class="mt-1 text-sm text-stone-700">
                                    {{ $hotel->ville }} — {{ $hotel->adresse }}
                                </p>

                            </div>


                            <div>

                                <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-stone-400">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                        />
                                    </svg>

                                    Propriétaire

                                </div>

                                @if ($hotel->proprietaire)

                                    <p class="mt-1 text-sm font-medium text-stone-800">
                                        {{ $hotel->proprietaire->nom }}
                                    </p>

                                    <p class="text-xs text-stone-500">
                                        {{ $hotel->proprietaire->email }}
                                    </p>

                                @else

                                    <p class="mt-1 text-sm text-stone-400">
                                        Propriétaire introuvable
                                    </p>

                                @endif

                            </div>


                            <div>

                                <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-stone-400">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7H14a3.5 3.5 0 010 7H6"
                                        />
                                    </svg>

                                    Tarif

                                </div>

                                <p class="mt-1 text-sm font-semibold text-stone-900">
                                    {{ number_format($hotel->prix, 0, ',', ' ') }} DH / nuit
                                </p>

                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="mt-6 grid gap-2 sm:grid-cols-2">

                            @if ($hotel->statut === 'en_attente')

                                {{-- VALIDER --}}
                                <form
                                    action="{{ route('admin.hotels.validate', $hotel->id_hotel) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-800"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Valider

                                    </button>

                                </form>


                                {{-- REFUSER --}}
                                <form
                                    action="{{ route('admin.hotels.reject', $hotel->id_hotel) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-800"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>

                                        Refuser

                                    </button>

                                </form>

                            @endif


                            {{-- SUPPRIMER --}}
                            <form
                                action="{{ route('admin.hotels.destroy', $hotel->id_hotel) }}"
                                method="POST"
                                class="sm:col-span-2"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel ?');"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-stone-300 px-4 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 6h18M9 6V4h6v2m-9 0l1 14h10l1-14M10 11v5M14 11v5"
                                        />
                                    </svg>

                                    Supprimer l’hôtel

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="rounded-2xl border border-stone-200 bg-white px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-100 text-stone-400">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 20l7-11 4 6 2-3 5 8H3z"
                            />
                        </svg>

                    </div>

                    <p class="mt-4 font-semibold text-stone-900">
                        Aucun hôtel trouvé
                    </p>

                    <p class="mt-1 text-sm text-stone-500">
                        Aucun hôtel n'est actuellement enregistré.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if ($hotels->hasPages())

            <div class="mt-8">
                {{ $hotels->links() }}
            </div>

        @endif

    </div>

</section>


{{-- HOTEL DELETE MODAL --}}
<div id="hotelDeleteModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-5 backdrop-blur-sm" role="dialog" aria-modal="true">
    <div id="hotelDeleteModalContent" class="w-full max-w-md scale-95 rounded-3xl bg-white p-8 opacity-0 shadow-2xl transition-all duration-200">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12.73A2 2 0 004.66 20h14.68a2 2 0 001.73-3.41L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
        </div>
        <div class="mt-6 text-center">
            <h2 class="text-2xl font-bold text-stone-950">Supprimer cet hôtel ?</h2>
            <p class="mt-3 text-sm text-stone-500">Vous êtes sur le point de supprimer définitivement :</p>
            <p id="hotelDeleteName" class="mt-2 text-lg font-bold text-stone-900"></p>
            <p class="mt-3 text-xs font-medium text-red-500">Cette action est irréversible.</p>
        </div>
        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row">
            <button type="button" id="cancelHotelDelete" class="flex-1 rounded-xl border border-stone-200 px-5 py-3 text-sm font-semibold text-stone-700 hover:bg-stone-100">Annuler</button>
            <form id="hotelDeleteForm" method="POST" class="flex-1">@csrf @method('DELETE')<button type="submit" class="w-full rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white hover:bg-red-700">Oui, supprimer</button></form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
 const modal=document.getElementById('hotelDeleteModal'), content=document.getElementById('hotelDeleteModalContent'), form=document.getElementById('hotelDeleteForm'), name=document.getElementById('hotelDeleteName');
 document.querySelectorAll('.open-hotel-delete-modal').forEach(btn=>btn.addEventListener('click',()=>{form.action=btn.dataset.deleteUrl;name.textContent=btn.dataset.hotelName;modal.classList.remove('hidden');modal.classList.add('flex');document.body.classList.add('overflow-hidden');setTimeout(()=>{content.classList.remove('scale-95','opacity-0');content.classList.add('scale-100','opacity-100')},10)}));
 const close=()=>{content.classList.remove('scale-100','opacity-100');content.classList.add('scale-95','opacity-0');setTimeout(()=>{modal.classList.add('hidden');modal.classList.remove('flex');document.body.classList.remove('overflow-hidden')},200)};
 document.getElementById('cancelHotelDelete').addEventListener('click',close); modal.addEventListener('click',e=>{if(e.target===modal)close()}); document.addEventListener('keydown',e=>{if(e.key==='Escape'&&!modal.classList.contains('hidden'))close()});
});
</script>

@endsection