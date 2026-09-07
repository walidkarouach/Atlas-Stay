@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12">

    <div class="mx-auto max-w-5xl px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">
                    Espace propriétaire
                </p>

                <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900">
                    Modifier mon hôtel
                </h1>

                <p class="mt-3 max-w-2xl text-slate-600">
                    Modifiez les informations de votre établissement.
                </p>

            </div>

            <a
                href="{{ route('proprietaire.hotels.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                ← Retour à mes hôtels
            </a>

        </div>


        {{-- Informations du statut --}}
        <div class="mb-8 rounded-2xl border border-amber-200 bg-amber-50 p-5">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                    !
                </div>

                <div>

                    <h3 class="font-semibold text-amber-900">
                        Statut de l’hôtel
                    </h3>

                    <p class="mt-1 text-sm text-amber-800">
                        Votre hôtel est actuellement :

                        @if ($hotel->statut === 'valide')
                            <strong>validé</strong>.
                        @elseif ($hotel->statut === 'en_attente')
                            <strong>en attente de validation</strong>.
                        @else
                            <strong>refusé</strong>.
                        @endif
                    </p>

                    <p class="mt-1 text-sm text-amber-800">
                        Le statut est géré uniquement par l’administrateur.
                    </p>

                </div>

            </div>

        </div>


        {{-- Errors --}}
        @if ($errors->any())

            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">
                        !
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-900">
                            Vérifiez les informations saisies
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


        {{-- Formulaire --}}
        <form
            action="{{ route('proprietaire.hotels.update', $hotel->id_hotel) }}"
            method="POST"
            class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
        >

            @csrf

            @method('PUT')


            {{-- Informations générales --}}
            <div class="border-b border-slate-200 p-8">

                <div class="mb-8">

                    <h2 class="text-xl font-bold text-slate-900">
                        Informations générales
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Modifiez les informations principales de votre établissement.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    {{-- Nom --}}
                    <div class="md:col-span-2">

                        <label
                            for="nom"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Nom de l’hôtel
                        </label>

                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="{{ old('nom', $hotel->nom) }}"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>


                    {{-- Ville --}}
                    <div>

                        <label
                            for="ville"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Ville
                        </label>

                        <input
                            type="text"
                            id="ville"
                            name="ville"
                            value="{{ old('ville', $hotel->ville) }}"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>


                    {{-- Adresse --}}
                    <div>

                        <label
                            for="adresse"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Adresse
                        </label>

                        <input
                            type="text"
                            id="adresse"
                            name="adresse"
                            value="{{ old('adresse', $hotel->adresse) }}"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>


                    {{-- Description --}}
                    <div class="md:col-span-2">

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >{{ old('description', $hotel->description) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Informations hébergement --}}
            <div class="border-b border-slate-200 p-8">

                <div class="mb-8">

                    <h2 class="text-xl font-bold text-slate-900">
                        Informations sur l’hébergement
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Modifiez le prix, le type et la capacité.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    {{-- Type --}}
                    <div>

                        <label
                            for="type_hebergement"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Type d’hébergement
                        </label>

                        <select
                            id="type_hebergement"
                            name="type_hebergement"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                            <option value="">
                                Sélectionnez un type
                            </option>

                            <option
                                value="Hotel"
                                {{ old('type_hebergement', $hotel->type_hebergement) === 'Hotel' ? 'selected' : '' }}
                            >
                                Hôtel
                            </option>

                            <option
                                value="Maison d'hôtes"
                                {{ old('type_hebergement', $hotel->type_hebergement) === "Maison d'hôtes" ? 'selected' : '' }}
                            >
                                Maison d’hôtes
                            </option>

                            <option
                                value="Auberge"
                                {{ old('type_hebergement', $hotel->type_hebergement) === 'Auberge' ? 'selected' : '' }}
                            >
                                Auberge
                            </option>

                            <option
                                value="Gîte"
                                {{ old('type_hebergement', $hotel->type_hebergement) === 'Gîte' ? 'selected' : '' }}
                            >
                                Gîte
                            </option>

                        </select>

                    </div>


                    {{-- Prix --}}
                    <div>

                        <label
                            for="prix"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Prix par nuit (DH)
                        </label>

                        <input
                            type="number"
                            id="prix"
                            name="prix"
                            value="{{ old('prix', $hotel->prix) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>


                    {{-- Capacité --}}
                    <div>

                        <label
                            for="capacite"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Capacité maximale
                        </label>

                        <input
                            type="number"
                            id="capacite"
                            name="capacite"
                            value="{{ old('capacite', $hotel->capacite) }}"
                            min="1"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>


                    {{-- Disponibilité --}}
                    <div>

                        <label
                            for="disponibilite"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Disponibilité
                        </label>

                        <select
                            id="disponibilite"
                            name="disponibilite"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                            <option
                                value="1"
                                {{ old('disponibilite', $hotel->disponibilite) == '1' ? 'selected' : '' }}
                            >
                                Disponible
                            </option>

                            <option
                                value="0"
                                {{ old('disponibilite', $hotel->disponibilite) == '0' ? 'selected' : '' }}
                            >
                                Non disponible
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="bg-slate-50 p-8">

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('proprietaire.hotels.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800"
                    >
                        Enregistrer les modifications
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection