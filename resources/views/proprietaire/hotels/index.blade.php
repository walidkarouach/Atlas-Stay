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
                <span class="text-lg leading-none">+</span>
                Ajouter un hôtel
            </a>

        </div>


        {{-- Message succès --}}
        @if (session('success'))

            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                        ✓
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


        {{-- Liste des hôtels --}}
        @if ($hotels->count())

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @foreach ($hotels as $hotel)

                    <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                        {{-- Image --}}
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

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-200 text-2xl">
                                            🏔️
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

                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700 shadow-sm">
                                        ✓ Validé
                                    </span>

                                @elseif ($hotel->statut === 'en_attente')

                                    <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700 shadow-sm">
                                        ⏳ En attente
                                    </span>

                                @elseif ($hotel->statut === 'refuse')

                                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 shadow-sm">
                                        ✕ Refusé
                                    </span>

                                @endif

                            </div>


                            {{-- Nombre d'images --}}
                            @if ($hotel->images->count())

                                <div class="absolute bottom-4 right-4">

                                    <span class="inline-flex items-center gap-1 rounded-full bg-black/60 px-3 py-1.5 text-xs font-medium text-white backdrop-blur-sm">
                                        📷 {{ $hotel->images->count() }}
                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- Contenu --}}
                        <div class="p-6">

                            <div class="mb-3">

                                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                                    {{ $hotel->type_hebergement }}
                                </span>

                            </div>


                            <h2 class="text-xl font-bold text-slate-900">
                                {{ $hotel->nom }}
                            </h2>


                            <p class="mt-2 flex items-center gap-2 text-sm text-slate-500">
                                <span>📍</span>
                                {{ $hotel->ville }} · {{ $hotel->adresse }}
                            </p>


                            @if ($hotel->description)

                                <p class="mt-4 line-clamp-2 text-sm leading-6 text-slate-600">
                                    {{ $hotel->description }}
                                </p>

                            @else

                                <p class="mt-4 text-sm italic text-slate-400">
                                    Aucune description renseignée.
                                </p>

                            @endif


                            <div class="mt-6 grid grid-cols-2 gap-3">

                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-xs text-slate-500">
                                        Prix / nuit
                                    </p>

                                    <p class="mt-1 text-base font-bold text-slate-900">
                                        {{ number_format($hotel->prix, 0, ',', ' ') }} DH
                                    </p>

                                </div>


                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-xs text-slate-500">
                                        Capacité
                                    </p>

                                    <p class="mt-1 text-base font-bold text-slate-900">
                                        {{ $hotel->capacite }} personnes
                                    </p>

                                </div>

                            </div>


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
                            <div class="mt-6 flex items-center gap-3 border-t border-slate-100 pt-5">

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
                                    class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                                >
                                    Modifier
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
                                        class="rounded-xl border border-red-200 bg-white px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                    >
                                        Supprimer
                                    </button>

                                </form>

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

            <div class="rounded-3xl border border-slate-200 bg-white px-6 py-20 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-4xl">
                    🏔️
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
                    <span class="text-lg leading-none">+</span>
                    Ajouter mon premier hôtel
                </a>

            </div>

        @endif

    </div>

</div>

@endsection