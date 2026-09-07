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
                    Ajouter un hôtel
                </h1>

                <p class="mt-3 max-w-2xl text-slate-600">
                    Présentez votre établissement aux voyageurs d’Atlas Stay.
                </p>

            </div>

            <a
                href="{{ route('proprietaire.hotels.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                ← Retour à mes hôtels
            </a>

        </div>


        {{-- Errors --}}
        @if ($errors->any())

            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex gap-3">

                    <div class="mt-0.5 text-red-600">
                        !
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-800">
                            Vérifiez les informations saisies
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">

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
            action="{{ route('proprietaire.hotels.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
        >

            @csrf


            {{-- Informations générales --}}
            <div class="border-b border-slate-200 p-8">

                <div class="mb-8">

                    <h2 class="text-xl font-bold text-slate-900">
                        Informations générales
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Donnez les informations principales de votre établissement.
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
                            value="{{ old('nom') }}"
                            placeholder="Ex : Atlas Mountain Lodge"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
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
                            value="{{ old('ville') }}"
                            placeholder="Ex : Azilal"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
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
                            value="{{ old('adresse') }}"
                            placeholder="Ex : Centre-ville, Azilal"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
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
                            placeholder="Décrivez votre hôtel, son environnement, ses services..."
                            class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >{{ old('description') }}</textarea>

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
                        Précisez le type, le prix et la capacité de votre établissement.
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
                                {{ old('type_hebergement') === 'Hotel' ? 'selected' : '' }}
                            >
                                Hôtel
                            </option>

                            <option
                                value="Maison d'hôtes"
                                {{ old('type_hebergement') === "Maison d'hôtes" ? 'selected' : '' }}
                            >
                                Maison d’hôtes
                            </option>

                            <option
                                value="Auberge"
                                {{ old('type_hebergement') === 'Auberge' ? 'selected' : '' }}
                            >
                                Auberge
                            </option>

                            <option
                                value="Gîte"
                                {{ old('type_hebergement') === 'Gîte' ? 'selected' : '' }}
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
                            value="{{ old('prix') }}"
                            min="0"
                            step="0.01"
                            placeholder="Ex : 650"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
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
                            value="{{ old('capacite') }}"
                            min="1"
                            placeholder="Ex : 10"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
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
                                {{ old('disponibilite', '1') == '1' ? 'selected' : '' }}
                            >
                                Disponible
                            </option>

                            <option
                                value="0"
                                {{ old('disponibilite') === '0' ? 'selected' : '' }}
                            >
                                Non disponible
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- Images --}}
            <div class="border-b border-slate-200 p-8">

                <div class="mb-8">

                    <h2 class="text-xl font-bold text-slate-900">
                        Photos de l’hôtel
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ajoutez jusqu’à 10 photos pour présenter votre établissement.
                    </p>

                </div>


                <div>

                    <label
                        for="images"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Images
                    </label>

                    <input
                        type="file"
                        id="images"
                        name="images[]"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        multiple
                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 file:mr-4 file:border-0 file:bg-slate-900 file:px-5 file:py-3 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Formats acceptés : JPG, JPEG, PNG, WEBP.
                        Maximum 2 MB par image.
                    </p>

                </div>

            </div>


            {{-- Validation --}}
            <div class="bg-slate-50 p-8">

                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

                    <div class="flex gap-3">

                        <div class="text-amber-600">
                            !
                        </div>

                        <div>

                            <h3 class="font-semibold text-amber-900">
                                Validation de l’hôtel
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-amber-800">
                                Après l’ajout, votre hôtel sera placé automatiquement
                                en attente de validation. Il sera visible publiquement
                                uniquement après validation par un administrateur.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

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
                        Ajouter l’hôtel
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection