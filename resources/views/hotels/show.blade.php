@extends('layouts.app')

@section('title', $hotel->nom . ' - Atlas Stay')

@section('content')

<section class="bg-stone-50 py-12">

    <div class="mx-auto max-w-7xl px-6">

        {{-- Breadcrumb --}}
        <div class="mb-8 flex items-center gap-2 text-sm text-stone-500">

            <a
                href="{{ route('hotels.index') }}"
                class="transition hover:text-stone-900"
            >
                Hôtels
            </a>

            <span>→</span>

            <span class="text-stone-900">
                {{ $hotel->nom }}
            </span>

        </div>


        {{-- HOTEL HEADER --}}
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



        {{-- IMAGE GALLERY --}}
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



        {{-- MAIN CONTENT --}}
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



                {{-- =========================
                    AVIS
                ========================== --}}
                <div class="pt-10">

                    <div class="flex items-end justify-between gap-4">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-400">
                                Expériences
                            </p>

                            <h2 class="mt-2 text-2xl font-semibold text-stone-900">
                                Avis des voyageurs
                            </h2>

                            <p class="mt-1 text-sm text-stone-500">
                                {{ $hotel->avis->count() }}
                                {{ $hotel->avis->count() > 1 ? 'avis' : 'avis' }}
                            </p>

                        </div>

                    </div>


                    {{-- Success --}}
                    @if(session('success'))

                        <div class="mt-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                            <p class="text-sm font-medium text-green-700">
                                {{ session('success') }}
                            </p>

                        </div>

                    @endif


                    {{-- Error --}}
                    @if($errors->has('avis'))

                        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                            <p class="text-sm font-medium text-red-700">
                                {{ $errors->first('avis') }}
                            </p>

                        </div>

                    @endif


                    {{-- ADD AVIS --}}
                    @auth

                        @if(auth()->user()->role->nom === 'Client')

                            @if($canReview)

                                <div class="mt-7 rounded-3xl border border-stone-200 bg-white p-7 shadow-sm">

                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-400">
                                            Votre expérience
                                        </p>

                                        <h3 class="mt-2 text-xl font-semibold text-stone-900">
                                            Partagez votre avis
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-stone-500">
                                            Votre séjour est terminé. Donnez votre avis sur cet hébergement.
                                        </p>

                                    </div>


                                    <form
                                        action="{{ route('avis.store') }}"
                                        method="POST"
                                        class="mt-7 space-y-6"
                                    >

                                        @csrf


                                        <input
                                            type="hidden"
                                            name="hotel_id"
                                            value="{{ $hotel->id_hotel }}"
                                        >


                                        {{-- Note --}}
                                        <div>

                                            <label
                                                for="note"
                                                class="mb-2 block text-sm font-semibold text-stone-700"
                                            >
                                                Votre note
                                            </label>

                                            <select
                                                id="note"
                                                name="note"
                                                required
                                                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                                            >

                                                <option value="">
                                                    Choisissez une note
                                                </option>

                                                <option value="5">
                                                    ★★★★★ — Excellent
                                                </option>

                                                <option value="4">
                                                    ★★★★☆ — Très bien
                                                </option>

                                                <option value="3">
                                                    ★★★☆☆ — Bien
                                                </option>

                                                <option value="2">
                                                    ★★☆☆☆ — Moyen
                                                </option>

                                                <option value="1">
                                                    ★☆☆☆☆ — Décevant
                                                </option>

                                            </select>

                                        </div>


                                        {{-- Commentaire --}}
                                        <div>

                                            <label
                                                for="commentaire"
                                                class="mb-2 block text-sm font-semibold text-stone-700"
                                            >
                                                Votre commentaire
                                            </label>

                                            <textarea
                                                id="commentaire"
                                                name="commentaire"
                                                rows="5"
                                                placeholder="Partagez votre expérience..."
                                                class="w-full resize-none rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                                            >{{ old('commentaire') }}</textarea>

                                        </div>


                                        {{-- Submit --}}
                                        <button
                                            type="submit"
                                            class="w-full rounded-xl bg-stone-900 px-6 py-4 text-sm font-semibold text-white transition hover:bg-stone-700"
                                        >
                                            Publier mon avis
                                        </button>

                                    </form>

                                </div>


                            @elseif($userAvis)

                                {{-- Already reviewed --}}
                                <div class="mt-7 rounded-3xl border border-stone-200 bg-white p-7">

                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-400">
                                        Votre avis
                                    </p>

                                    <div class="mt-3 flex items-center gap-3">

                                        <div class="text-lg tracking-wide text-stone-900">
                                            @for($i = 1; $i <= 5; $i++)

                                                @if($i <= $userAvis->note)
                                                    ★
                                                @else
                                                    ☆
                                                @endif

                                            @endfor
                                        </div>

                                        <span class="text-sm font-semibold text-stone-700">
                                            {{ $userAvis->note }}/5
                                        </span>

                                    </div>

                                    @if($userAvis->commentaire)

                                        <p class="mt-4 text-sm leading-7 text-stone-600">
                                            {{ $userAvis->commentaire }}
                                        </p>

                                    @endif

                                    <div class="mt-6 flex flex-wrap gap-3">

                                        <a
                                            href="{{ route('avis.edit', $userAvis->id_avis) }}"
                                            class="rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                                        >
                                            Modifier mon avis
                                        </a>


                                        <form
                                            action="{{ route('avis.destroy', $userAvis->id_avis) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                onclick="return confirm('Voulez-vous vraiment supprimer votre avis ?')"
                                                class="rounded-xl border border-red-200 bg-white px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                            >
                                                Supprimer
                                            </button>

                                        </form>

                                    </div>

                                </div>


                            @else

                                {{-- Client without completed stay --}}
                                <div class="mt-7 rounded-3xl border border-stone-200 bg-white p-7">

                                    <p class="text-sm leading-6 text-stone-500">
                                        Vous pourrez laisser un avis après avoir terminé un séjour confirmé dans cet hôtel.
                                    </p>

                                </div>

                            @endif

                        @endif

                    @else

                        {{-- Guest --}}
                        <div class="mt-7 rounded-3xl border border-stone-200 bg-white p-7">

                            <p class="text-sm leading-6 text-stone-500">
                                Connectez-vous pour pouvoir laisser un avis.
                            </p>

                            <a
                                href="{{ route('login') }}"
                                class="mt-5 inline-flex rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                            >
                                Se connecter
                            </a>

                        </div>

                    @endauth


                    {{-- Existing reviews --}}
                    @if($hotel->avis->count() > 0)

                        <div class="mt-8 space-y-5">

                            @foreach($hotel->avis as $avis)

                                <div class="rounded-3xl border border-stone-200 bg-white p-6">

                                    <div class="flex items-start justify-between gap-5">

                                        <div>

                                            <p class="font-semibold text-stone-900">
                                                {{ $avis->utilisateur->nom }}
                                            </p>

                                            <p class="mt-1 text-xs text-stone-500">
                                                {{ $avis->date_avis->format('d/m/Y') }}
                                            </p>

                                        </div>


                                        {{-- Stars --}}
                                        <div class="text-right">

                                            <div class="text-sm tracking-wide text-stone-900">

                                                @for($i = 1; $i <= 5; $i++)

                                                    @if($i <= $avis->note)
                                                        ★
                                                    @else
                                                        ☆
                                                    @endif

                                                @endfor

                                            </div>

                                            <p class="mt-1 text-xs font-semibold text-stone-500">
                                                {{ $avis->note }}/5
                                            </p>

                                        </div>

                                    </div>


                                    @if($avis->commentaire)

                                        <p class="mt-5 text-sm leading-7 text-stone-600">
                                            {{ $avis->commentaire }}
                                        </p>

                                    @endif


                                    {{-- Actions for current user's review --}}
                                    @auth

                                        @if(
                                            auth()->user()->role->nom === 'Client' &&
                                            $avis->user_id === auth()->user()->id_user
                                        )

                                            <div class="mt-5 flex gap-3 border-t border-stone-100 pt-5">

                                                <a
                                                    href="{{ route('avis.edit', $avis->id_avis) }}"
                                                    class="text-sm font-semibold text-stone-900 hover:text-stone-500"
                                                >
                                                    Modifier
                                                </a>

                                                <form
                                                    action="{{ route('avis.destroy', $avis->id_avis) }}"
                                                    method="POST"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        onclick="return confirm('Voulez-vous vraiment supprimer cet avis ?')"
                                                        class="text-sm font-semibold text-red-600 hover:text-red-400"
                                                    >
                                                        Supprimer
                                                    </button>

                                                </form>

                                            </div>

                                        @endif

                                    @endauth

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="mt-7 rounded-3xl border border-stone-200 bg-white p-8 text-center">

                            <p class="text-sm text-stone-500">
                                Aucun avis pour le moment.
                            </p>

                        </div>

                    @endif

                </div>

            </div>



            {{-- BOOKING CARD --}}
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
                                href="{{ route('login') }}"
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