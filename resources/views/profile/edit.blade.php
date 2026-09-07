@extends('layouts.app')

@section('title', 'Modifier mon profil - Atlas Stay')

@section('content')

<section class="min-h-[calc(100vh-80px)] bg-stone-50">

    {{-- Header --}}
    <div class="border-b border-stone-200 bg-white">

        <div class="mx-auto max-w-3xl px-6 py-12">

            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-stone-400">
                Atlas Stay
            </p>

            <h1 class="mt-3 text-4xl font-semibold tracking-tight text-stone-950 sm:text-5xl">
                Modifier mon profil
            </h1>

            <p class="mt-4 max-w-xl text-sm leading-6 text-stone-500">
                Modifiez vos informations personnelles.
            </p>

        </div>

    </div>


    {{-- Form --}}
    <div class="mx-auto max-w-3xl px-6 py-14">

        <div class="rounded-[2rem] border border-stone-200 bg-white shadow-[0_20px_60px_rgba(0,0,0,0.06)]">

            <div class="px-7 py-8 sm:px-10">

                <div class="mb-8">

                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-400">
                        Informations personnelles
                    </p>

                    <h2 class="mt-2 text-2xl font-semibold tracking-tight text-stone-950">
                        Modifier vos informations
                    </h2>

                </div>


                {{-- Errors --}}
                @if ($errors->any())

                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                        @foreach ($errors->all() as $error)

                            <p class="text-sm text-red-700">
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                @endif


                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                    class="space-y-6"
                >

                    @csrf

                    @method('PUT')


                    {{-- Nom --}}
                    <div>

                        <label
                            for="nom"
                            class="mb-2 block text-sm font-semibold text-stone-700"
                        >
                            Nom complet
                        </label>

                        <input
                            id="nom"
                            type="text"
                            name="nom"
                            value="{{ old('nom', $user->nom) }}"
                            required
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-stone-700"
                        >
                            Adresse email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Téléphone --}}
                    <div>

                        <label
                            for="telephone"
                            class="mb-2 block text-sm font-semibold text-stone-700"
                        >
                            Téléphone
                        </label>

                        <input
                            id="telephone"
                            type="text"
                            name="telephone"
                            value="{{ old('telephone', $user->telephone) }}"
                            placeholder="Votre numéro de téléphone"
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col gap-3 border-t border-stone-100 pt-7 sm:flex-row">

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-stone-700"
                        >
                            Enregistrer les modifications
                        </button>

                        <a
                            href="{{ route('profile.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                        >
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection