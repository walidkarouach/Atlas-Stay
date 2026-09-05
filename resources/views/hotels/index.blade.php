@extends('layouts.app')

@section('title', 'Hôtels - Atlas Stay')

@section('content')

{{-- =========================
    PAGE HEADER
========================== --}}
<section class="bg-stone-50">

    <div class="mx-auto max-w-7xl px-6 py-16">

        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">
            Atlas Stay
        </p>

        <h1 class="mt-3 text-4xl font-bold tracking-tight text-stone-900 sm:text-5xl">
            Découvrez nos hôtels
        </h1>

        <p class="mt-4 max-w-2xl text-base leading-7 text-stone-500">
            Trouvez l'hébergement idéal pour votre prochaine
            escapade dans les montagnes du Maroc.
        </p>

    </div>

</section>


{{-- =========================
    FILTERS
========================== --}}
<section class="border-b border-stone-200 bg-white">

    <div class="mx-auto max-w-7xl px-6 py-6">

        <form
            action="{{ route('hotels.index') }}"
            method="GET"
            class="grid gap-4 md:grid-cols-4"
        >

            {{-- Ville --}}
            <div>

                <label
                    for="ville"
                    class="mb-2 block text-sm font-medium text-stone-700"
                >
                    Destination
                </label>

                <input
                    type="text"
                    id="ville"
                    name="ville"
                    value="{{ request('ville') }}"
                    placeholder="Ex : Ifrane"
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-stone-900"
                >

            </div>


            {{-- Prix maximum --}}
            <div>

                <label
                    for="prix_max"
                    class="mb-2 block text-sm font-medium text-stone-700"
                >
                    Prix maximum
                </label>

                <input
                    type="number"
                    id="prix_max"
                    name="prix_max"
                    value="{{ request('prix_max') }}"
                    placeholder="Ex : 600"
                    min="0"
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-stone-900"
                >

            </div>


            {{-- Type --}}
            <div>

                <label
                    for="type_hebergement"
                    class="mb-2 block text-sm font-medium text-stone-700"
                >
                    Type d'hébergement
                </label>

                <select
                    id="type_hebergement"
                    name="type_hebergement"
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-stone-900"
                >

                    <option value="">
                        Tous les types
                    </option>

                    <option
                        value="Hotel"
                        {{ request('type_hebergement') === 'Hotel' ? 'selected' : '' }}
                    >
                        Hôtel
                    </option>

                    <option
                        value="Auberge"
                        {{ request('type_hebergement') === 'Auberge' ? 'selected' : '' }}
                    >
                        Auberge
                    </option>

                    <option
                        value="Gîte"
                        {{ request('type_hebergement') === 'Gîte' ? 'selected' : '' }}
                    >
                        Gîte
                    </option>

                    <option
                        value="Chalet"
                        {{ request('type_hebergement') === 'Chalet' ? 'selected' : '' }}
                    >
                        Chalet
                    </option>

                </select>

            </div>


            {{-- Button --}}
            <div class="flex items-end gap-3">

                <button
                    type="submit"
                    class="flex-1 rounded-xl bg-stone-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                >
                    Rechercher
                </button>

                <a
                    href="{{ route('hotels.index') }}"
                    class="rounded-xl border border-stone-300 px-5 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>

</section>


{{-- =========================
    HOTELS
========================== --}}
<section class="bg-stone-50 py-16">

    <div class="mx-auto max-w-7xl px-6">

        {{-- Results count --}}
        <div class="mb-8 flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-semibold text-stone-900">
                    Nos hébergements
                </h2>

                <p class="mt-1 text-sm text-stone-500">
                    {{ $hotels->total() }} hôtel(s) disponible(s)
                </p>

            </div>

        </div>


        {{-- Hotels Grid --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($hotels as $hotel)

                {{-- Hotel Card --}}
                <article class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    {{-- Image --}}
                    <div class="relative h-64 overflow-hidden bg-stone-200">

                        @if($hotel->images->count() > 0)

                            <img
                                src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                                alt="{{ $hotel->nom }}"
                                class="h-full w-full object-cover transition duration-500 hover:scale-105"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-sm text-stone-400">
                                Aucune image
                            </div>

                        @endif

                    </div>


                    {{-- Content --}}
                    <div class="p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h3 class="text-xl font-semibold text-stone-900">
                                    {{ $hotel->nom }}
                                </h3>

                                <p class="mt-1 text-sm text-stone-500">
                                    {{ $hotel->ville }}
                                </p>

                            </div>

                            <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-medium text-stone-600">
                                {{ $hotel->type_hebergement }}
                            </span>

                        </div>


                        {{-- Price --}}
                        <div class="mt-5 flex items-end justify-between">

                            <div>

                                <span class="text-2xl font-bold text-stone-900">
                                    {{ number_format($hotel->prix, 0, ',', ' ') }}
                                </span>

                                <span class="text-sm text-stone-500">
                                    DH / nuit
                                </span>

                            </div>


                            <a
                                href="/hotels/{{ $hotel->id_hotel }}"
                                class="rounded-xl bg-stone-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-stone-700"
                            >
                                Voir détails
                            </a>

                        </div>

                    </div>

                </article>

            @empty

                {{-- Empty state --}}
                <div class="col-span-full rounded-2xl border border-dashed border-stone-300 bg-white px-6 py-16 text-center">

                    <h3 class="text-lg font-semibold text-stone-900">
                        Aucun hôtel trouvé
                    </h3>

                    <p class="mt-2 text-sm text-stone-500">
                        Essayez de modifier vos critères de recherche.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($hotels->hasPages())

            <div class="mt-12">
                {{ $hotels->links() }}
            </div>

        @endif

    </div>

</section>

@endsection