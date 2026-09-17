@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">
                    Espace propriétaire
                </p>

                <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900">
                    Mes hôtels
                </h1>

                <p class="mt-3 max-w-2xl text-slate-600">
                    Gérez vos établissements, consultez leur statut et suivez leur disponibilité.
                </p>

            </div>


            <a
                href="{{ route('proprietaire.hotels.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800"
            >

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
                        d="M12 5v14M5 12h14"
                    />
                </svg>

                Ajouter un hôtel

            </a>

        </div>


        {{-- Message succès --}}
        @if (session('success'))

            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">

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


                    <div>

                        <h3 class="font-semibold text-emerald-900">
                            Opération réussie
                        </h3>

                        <p class="mt-1 text-sm text-emerald-800">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- Message erreur --}}
        @if ($errors->any())

            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">

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


        {{-- Liste des hôtels --}}
        @if ($hotels->count())

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @foreach ($hotels as $hotel)

                    <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">


                        {{-- Image principale --}}
                        <div class="relative h-56 overflow-hidden bg-slate-100">

                            @if ($hotel->images->count())

                                <img
                                    src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                                    alt="{{ $hotel->nom }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >

                            @else

                                <div class="flex h-full items-center justify-center">

                                    <div class="text-center">

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-200 text-slate-500">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.6"
                                                stroke="currentColor"
                                                class="h-7 w-7"
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


                                        <p class="mt-3 text-sm font-medium text-slate-500">
                                            Aucune image
                                        </p>

                                    </div>

                                </div>

                            @endif


                            {{-- Statut --}}
                            <div class="absolute left-4 top-4">

                                @if ($hotel->statut === 'valide')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700 shadow-sm">

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

                                        Validé

                                    </span>

                                @elseif ($hotel->statut === 'en_attente')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700 shadow-sm">

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

                                @elseif ($hotel->statut === 'refuse')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 shadow-sm">

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
                                                d="M6 6l12 12M18 6L6 18"
                                            />
                                        </svg>

                                        Refusé

                                    </span>

                                @endif

                            </div>


                            {{-- Nombre d'images --}}
                            @if ($hotel->images->count())

                                <div class="absolute bottom-4 right-4">

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-black/60 px-3 py-1.5 text-xs font-medium text-white backdrop-blur-sm">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.7"
                                            stroke="currentColor"
                                            class="h-4 w-4"
                                        >
                                            <rect
                                                x="3"
                                                y="5"
                                                width="18"
                                                height="14"
                                                rx="2"
                                                ry="2"
                                            />

                                            <circle
                                                cx="8.5"
                                                cy="10"
                                                r="1.5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 16l5-5 4 4 3-3 6 5"
                                            />
                                        </svg>

                                        {{ $hotel->images->count() }}

                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- Contenu --}}
                        <div class="p-6">

                            {{-- Type --}}
                            <div class="mb-3">

                                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                                    {{ $hotel->type_hebergement }}
                                </span>

                            </div>


                            {{-- Nom --}}
                            <h2 class="text-xl font-bold text-slate-900">
                                {{ $hotel->nom }}
                            </h2>


                            {{-- Localisation --}}
                            <p class="mt-2 flex items-center gap-2 text-sm text-slate-500">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="h-4 w-4 shrink-0 text-emerald-600"
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

                                {{ $hotel->ville }} · {{ $hotel->adresse }}

                            </p>


                            {{-- Description --}}
                            @if ($hotel->description)

                                <p class="mt-4 line-clamp-2 text-sm leading-6 text-slate-600">
                                    {{ $hotel->description }}
                                </p>

                            @else

                                <p class="mt-4 text-sm italic text-slate-400">
                                    Aucune description renseignée.
                                </p>

                            @endif


                            {{-- Informations --}}
                            <div class="mt-6 grid grid-cols-2 gap-3">

                                {{-- Prix --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <div class="flex items-center gap-2">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.7"
                                            stroke="currentColor"
                                            class="h-4 w-4 text-slate-500"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 3v18M17 7H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H7"
                                            />
                                        </svg>

                                        <p class="text-xs text-slate-500">
                                            Prix / nuit
                                        </p>

                                    </div>

                                    <p class="mt-1 text-base font-bold text-slate-900">
                                        {{ number_format($hotel->prix, 0, ',', ' ') }} DH
                                    </p>

                                </div>


                                {{-- Capacité --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <div class="flex items-center gap-2">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.7"
                                            stroke="currentColor"
                                            class="h-4 w-4 text-slate-500"
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

                                        <p class="text-xs text-slate-500">
                                            Capacité
                                        </p>

                                    </div>

                                    <p class="mt-1 text-base font-bold text-slate-900">
                                        {{ $hotel->capacite }} personnes
                                    </p>

                                </div>

                            </div>


                            {{-- Disponibilité --}}
                            <div class="mt-4">

                                @if ($hotel->disponibilite)

                                    <span class="inline-flex items-center gap-2 text-sm font-medium text-emerald-600">

                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                        Disponible

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2 text-sm font-medium text-slate-500">

                                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>

                                        Non disponible

                                    </span>

                                @endif

                            </div>


                            {{-- Actions --}}
                            <div class="mt-6 border-t border-slate-100 pt-5">

                                {{-- Ligne principale --}}
                                <div class="flex items-center gap-3">

                                    {{-- Voir --}}
                                    @if ($hotel->statut === 'valide')

                                        <a
                                            href="{{ route('hotels.show', $hotel->id_hotel) }}"
                                            class="flex-1 rounded-xl bg-slate-900 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-800"
                                        >
                                            Voir
                                        </a>

                                    @else

                                        <span
                                            class="flex-1 cursor-not-allowed rounded-xl bg-slate-100 px-4 py-3 text-center text-sm font-semibold text-slate-400"
                                        >
                                            Non publié
                                        </span>

                                    @endif


                                    {{-- Modifier --}}
                                    <a
                                        href="{{ route('proprietaire.hotels.edit', $hotel->id_hotel) }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-700 transition hover:bg-slate-50"
                                        title="Modifier"
                                    >

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
                                                d="M12 20h9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Supprimer --}}
                                    <form
                                        action="{{ route('proprietaire.hotels.destroy', $hotel->id_hotel) }}"
                                        method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel ?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-white px-4 py-3 text-red-600 transition hover:bg-red-50"
                                            title="Supprimer"
                                        >

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
                                                    d="M3 6h18"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5"
                                                />
                                            </svg>

                                        </button>

                                    </form>

                                </div>


                                {{-- Gestion des images --}}
                                <a
                                    href="{{ route('proprietaire.hotels.images', $hotel->id_hotel) }}"
                                    class="mt-3 flex w-full items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="14"
                                            rx="2"
                                            ry="2"
                                        />

                                        <circle
                                            cx="8.5"
                                            cy="10"
                                            r="1.5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 16l5-5 4 4 3-3 6 5"
                                        />
                                    </svg>

                                    Gérer les images

                                    @if ($hotel->images->count())

                                        <span class="rounded-full bg-emerald-200 px-2 py-0.5 text-xs">
                                            {{ $hotel->images->count() }}
                                        </span>

                                    @endif

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- Pagination --}}
            @if ($hotels->hasPages())

                <div class="mt-10">
                    {{ $hotels->links() }}
                </div>

            @endif


        @else

            {{-- Empty state --}}
            <div class="rounded-3xl border border-slate-200 bg-white px-6 py-20 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.6"
                        stroke="currentColor"
                        class="h-10 w-10"
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


                <h2 class="mt-6 text-2xl font-bold text-slate-900">
                    Vous n’avez encore aucun hôtel
                </h2>


                <p class="mx-auto mt-3 max-w-lg text-slate-500">
                    Commencez par ajouter votre premier établissement
                    pour le proposer aux voyageurs sur Atlas Stay.
                </p>


                <a
                    href="{{ route('proprietaire.hotels.create') }}"
                    class="mt-7 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                >

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
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Ajouter mon premier hôtel

                </a>

            </div>

        @endif

    </div>

</div>

@endsection