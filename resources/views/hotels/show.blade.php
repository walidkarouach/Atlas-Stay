@extends('layouts.app')

@section('title', $hotel->nom . ' - Atlas Stay')

@section('content')

{{-- =========================
    HOTEL DETAILS
========================== --}}
<section class="bg-stone-50 py-12">

    <div class="mx-auto max-w-7xl px-6">

        {{-- Breadcrumb --}}
        <div class="mb-8 flex items-center gap-2 text-sm text-stone-500">

            <a
                href="/hotels"
                class="transition hover:text-stone-900"
            >
                Hôtels
            </a>

            <span>→</span>

            <span class="text-stone-900">
                {{ $hotel->nom }}
            </span>

        </div>


        {{-- =========================
            HOTEL HEADER
        ========================== --}}
        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">

            <div>

                {{-- Type --}}
                <span class="inline-flex rounded-full bg-stone-900 px-4 py-1.5 text-xs font-semibold text-white">
                    {{ $hotel->type_hebergement }}
                </span>


                {{-- Name --}}
                <h1 class="mt-4 text-4xl font-bold tracking-tight text-stone-900 sm:text-5xl">
                    {{ $hotel->nom }}
                </h1>


                {{-- Location --}}
                <p class="mt-3 flex items-center gap-2 text-base text-stone-500">

                    <span>📍</span>

                    {{ $hotel->adresse }}, {{ $hotel->ville }}

                </p>

            </div>


            {{-- Price --}}
            <div class="md:text-right">

                <div class="flex items-baseline gap-2 md:justify-end">

                    <span class="text-3xl font-bold text-stone-900">
                        {{ number_format($hotel->prix, 0, ',', ' ') }} DH
                    </span>

                    <span class="text-sm text-stone-500">
                        / nuit
                    </span>

                </div>

                @if($hotel->disponibilite)

                    <p class="mt-2 text-sm font-medium text-green-700">
                        Disponible
                    </p>

                @else

                    <p class="mt-2 text-sm font-medium text-red-600">
                        Indisponible
                    </p>

                @endif

            </div>

        </div>



        {{-- =========================
            IMAGE GALLERY
        ========================== --}}
        <div class="mt-10">

            @if($hotel->images->count() > 0)

                <div class="grid gap-4 md:grid-cols-2">

                    {{-- Main Image --}}
                    <div class="h-[420px] overflow-hidden rounded-3xl">

                        <img
                            src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                            alt="{{ $hotel->nom }}"
                            class="h-full w-full object-cover"
                        >

                    </div>


                    {{-- Secondary Images --}}
                    <div class="grid grid-cols-2 gap-4">

                        @foreach($hotel->images->skip(1)->take(4) as $image)

                            <div class="h-[200px] overflow-hidden rounded-3xl">

                                <img
                                    src="{{ asset('storage/' . $image->image) }}"
                                    alt="{{ $hotel->nom }}"
                                    class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                >

                            </div>

                        @endforeach


                        {{-- Empty placeholders --}}
                        @for($i = $hotel->images->skip(1)->take(4)->count(); $i < 4; $i++)

                            <div class="flex h-[200px] items-center justify-center rounded-3xl bg-stone-200">

                                <span class="text-sm text-stone-400">
                                    Atlas Stay
                                </span>

                            </div>

                        @endfor

                    </div>

                </div>

            @else

                <div class="flex h-[420px] items-center justify-center rounded-3xl bg-stone-200">

                    <p class="text-stone-500">
                        Aucune image disponible
                    </p>

                </div>

            @endif

        </div>



        {{-- =========================
            MAIN CONTENT
        ========================== --}}
        <div class="mt-12 grid gap-10 lg:grid-cols-[1fr_380px]">


            {{-- LEFT --}}
            <div>


                {{-- Description --}}
                <div class="border-b border-stone-200 pb-10">

                    <h2 class="text-2xl font-semibold text-stone-900">
                        À propos de cet hébergement
                    </h2>

                    <p class="mt-5 max-w-3xl text-base leading-8 text-stone-600">
                        {{ $hotel->description }}
                    </p>

                </div>



                {{-- Informations --}}
                <div class="border-b border-stone-200 py-10">

                    <h2 class="text-2xl font-semibold text-stone-900">
                        Informations
                    </h2>


                    <div class="mt-7 grid gap-6 sm:grid-cols-2">


                        {{-- Capacity --}}
                        <div class="rounded-2xl bg-white p-5">

                            <p class="text-sm text-stone-500">
                                Capacité
                            </p>

                            <p class="mt-2 text-lg font-semibold text-stone-900">
                                {{ $hotel->capacite }} personnes
                            </p>

                        </div>


                        {{-- Type --}}
                        <div class="rounded-2xl bg-white p-5">

                            <p class="text-sm text-stone-500">
                                Type
                            </p>

                            <p class="mt-2 text-lg font-semibold text-stone-900">
                                {{ $hotel->type_hebergement }}
                            </p>

                        </div>


                        {{-- City --}}
                        <div class="rounded-2xl bg-white p-5">

                            <p class="text-sm text-stone-500">
                                Ville
                            </p>

                            <p class="mt-2 text-lg font-semibold text-stone-900">
                                {{ $hotel->ville }}
                            </p>

                        </div>


                        {{-- Availability --}}
                        <div class="rounded-2xl bg-white p-5">

                            <p class="text-sm text-stone-500">
                                Disponibilité
                            </p>

                            @if($hotel->disponibilite)

                                <p class="mt-2 text-lg font-semibold text-green-700">
                                    Disponible
                                </p>

                            @else

                                <p class="mt-2 text-lg font-semibold text-red-600">
                                    Indisponible
                                </p>

                            @endif

                        </div>

                    </div>

                </div>



                {{-- Avis --}}
                <div class="pt-10">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-2xl font-semibold text-stone-900">
                                Avis des voyageurs
                            </h2>

                            <p class="mt-1 text-sm text-stone-500">
                                {{ $hotel->avis->count() }} avis
                            </p>

                        </div>

                    </div>


                    @if($hotel->avis->count() > 0)

                        <div class="mt-7 space-y-5">

                            @foreach($hotel->avis as $avis)

                                <div class="rounded-2xl bg-white p-6">

                                    <div class="flex items-start justify-between">

                                        <div>

                                            <p class="font-semibold text-stone-900">
                                                {{ $avis->utilisateur->nom }}
                                            </p>

                                            <p class="mt-1 text-xs text-stone-500">
                                                {{ $avis->date_avis->format('d/m/Y') }}
                                            </p>

                                        </div>


                                        <div class="text-sm font-semibold text-stone-900">

                                            {{ $avis->note }}/5

                                        </div>

                                    </div>


                                    @if($avis->commentaire)

                                        <p class="mt-4 text-sm leading-6 text-stone-600">
                                            {{ $avis->commentaire }}
                                        </p>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="mt-7 rounded-2xl bg-white p-8 text-center">

                            <p class="text-sm text-stone-500">
                                Aucun avis pour le moment.
                            </p>

                        </div>

                    @endif

                </div>

            </div>



            {{-- =========================
                BOOKING CARD
            ========================== --}}
            <aside>

                <div class="sticky top-8 rounded-3xl border border-stone-200 bg-white p-7 shadow-lg">

                    <div class="flex items-baseline justify-between">

                        <div>

                            <span class="text-3xl font-bold text-stone-900">
                                {{ number_format($hotel->prix, 0, ',', ' ') }} DH
                            </span>

                            <span class="text-sm text-stone-500">
                                / nuit
                            </span>

                        </div>

                    </div>


                    {{-- Booking Form --}}
                    @auth

                        @if(auth()->user()->role->nom === 'Client')

                            <form
                                action="{{ route('reservations.store') }}"
                                method="POST"
                                class="mt-6 space-y-4"
                            >

                                @csrf

                                {{-- Hotel ID --}}
                                <input
                                    type="hidden"
                                    name="hotel_id"
                                    value="{{ $hotel->id_hotel }}"
                                >


                                {{-- Arrival --}}
                                <div>

                                    <label
                                        for="date_arrivee"
                                        class="mb-2 block text-sm font-medium text-stone-700"
                                    >
                                        Arrivée
                                    </label>

                                    <input
                                        type="date"
                                        id="date_arrivee"
                                        name="date_arrivee"
                                        min="{{ date('Y-m-d') }}"
                                        value="{{ old('date_arrivee') }}"
                                        required
                                        class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm outline-none transition focus:border-stone-900"
                                    >

                                </div>


                                {{-- Departure --}}
                                <div>

                                    <label
                                        for="date_depart"
                                        class="mb-2 block text-sm font-medium text-stone-700"
                                    >
                                        Départ
                                    </label>

                                    <input
                                        type="date"
                                        id="date_depart"
                                        name="date_depart"
                                        min="{{ date('Y-m-d') }}"
                                        value="{{ old('date_depart') }}"
                                        required
                                        class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm outline-none transition focus:border-stone-900"
                                    >

                                </div>


                                {{-- Guests --}}
                                <div>

                                    <label
                                        for="nb_personnes"
                                        class="mb-2 block text-sm font-medium text-stone-700"
                                    >
                                        Nombre de personnes
                                    </label>

                                    <input
                                        type="number"
                                        id="nb_personnes"
                                        name="nb_personnes"
                                        min="1"
                                        max="{{ $hotel->capacite }}"
                                        value="{{ old('nb_personnes', 2) }}"
                                        required
                                        class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm outline-none transition focus:border-stone-900"
                                    >

                                    <p class="mt-1 text-xs text-stone-400">
                                        Maximum : {{ $hotel->capacite }} personnes
                                    </p>

                                </div>


                                {{-- Error messages --}}
                                @if($errors->any())

                                    <div class="rounded-xl bg-red-50 p-4 text-sm text-red-700">

                                        <ul class="space-y-1">

                                            @foreach($errors->all() as $error)

                                                <li>
                                                    {{ $error }}
                                                </li>

                                            @endforeach

                                        </ul>

                                    </div>

                                @endif


                                {{-- Success message --}}
                                @if(session('success'))

                                    <div class="rounded-xl bg-green-50 p-4 text-sm text-green-700">
                                        {{ session('success') }}
                                    </div>

                                @endif


                                {{-- Submit --}}
                                @if($hotel->disponibilite)

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-stone-900 px-6 py-4 text-sm font-semibold text-white transition hover:bg-stone-700"
                                    >
                                        Réserver maintenant
                                    </button>

                                @else

                                    <button
                                        type="button"
                                        disabled
                                        class="w-full cursor-not-allowed rounded-xl bg-stone-300 px-6 py-4 text-sm font-semibold text-stone-500"
                                    >
                                        Hôtel indisponible
                                    </button>

                                @endif


                            </form>


                        @else

                            {{-- User connecté mais pas Client --}}
                            <div class="mt-6 rounded-xl bg-stone-100 p-5 text-center">

                                <p class="text-sm text-stone-600">
                                    Seuls les clients peuvent effectuer une réservation.
                                </p>

                            </div>

                        @endif


                    @else

                        {{-- User non connecté --}}
                        <div class="mt-6">

                            <p class="text-sm leading-6 text-stone-500">
                                Connectez-vous pour pouvoir réserver cet hébergement.
                            </p>

                            <a
                                href="/login"
                                class="mt-4 block w-full rounded-xl bg-stone-900 px-6 py-4 text-center text-sm font-semibold text-white transition hover:bg-stone-700"
                            >
                                Se connecter
                            </a>

                        </div>

                    @endauth


                    <p class="mt-5 text-center text-xs leading-5 text-stone-400">
                        Aucun paiement en ligne n'est requis.
                        La réservation sera confirmée par le propriétaire.
                    </p>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection