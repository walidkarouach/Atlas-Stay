@extends('layouts.app')

@section('title', 'Inscription - Atlas Stay')

@section('content')

<div class="min-h-[calc(100vh-80px)] bg-stone-50">

    <div class="grid min-h-[calc(100vh-80px)] lg:grid-cols-2">

        {{-- LEFT SIDE : IMAGE --}}
        <div class="relative hidden lg:block">

            <img
                src="{{ asset('images/hero.png') }}"
                alt="Atlas Stay - Montagnes du Maroc"
                class="absolute inset-0 h-full w-full object-cover"
            >

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/45"></div>

            {{-- Content --}}
            <div class="relative flex h-full items-end p-12 xl:p-16">

                <div class="max-w-xl text-white">

                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-white/70">
                        Atlas Stay
                    </p>

                    <h2 class="mt-4 text-4xl font-semibold leading-tight xl:text-5xl">
                        Votre prochaine escapade commence ici.
                    </h2>

                    <p class="mt-5 text-base leading-7 text-white/80">
                        Créez votre compte et découvrez les plus beaux hôtels
                        des régions montagneuses du Maroc.
                    </p>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE : REGISTER FORM --}}
        <div class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16">

            <div class="w-full max-w-md">

                {{-- Logo --}}
                <div class="mb-10">

                    <a href="{{ url('/') }}" class="inline-flex">

                        <img
                            src="{{ asset('images/logo-atlas.png') }}"
                            alt="Atlas Stay"
                            class="h-14 w-auto"
                        >

                    </a>

                </div>


                {{-- Header --}}
                <div>

                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-400">
                        Bienvenue
                    </p>

                    <h1 class="mt-3 text-3xl font-semibold tracking-tight text-stone-950 sm:text-4xl">
                        Créer un compte
                    </h1>

                    <p class="mt-3 text-sm leading-6 text-stone-500">
                        Rejoignez Atlas Stay et préparez votre prochaine aventure.
                    </p>

                </div>


                {{-- Validation errors --}}
                @if ($errors->any())

                    <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                        <div class="space-y-1">

                            @foreach ($errors->all() as $error)

                                <p class="text-sm text-red-700">
                                    {{ $error }}
                                </p>

                            @endforeach

                        </div>

                    </div>

                @endif


                {{-- Register form --}}
                <form
                    action="{{ route('register.submit') }}"
                    method="POST"
                    class="mt-8 space-y-5"
                >

                    @csrf


                    {{-- Nom --}}
                    <div>

                        <label
                            for="nom"
                            class="mb-2 block text-sm font-medium text-stone-700"
                        >
                            Nom complet
                        </label>

                        <input
                            id="nom"
                            type="text"
                            name="nom"
                            value="{{ old('nom') }}"
                            required
                            autocomplete="name"
                            placeholder="Votre nom complet"
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-stone-700"
                        >
                            Adresse email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="exemple@email.com"
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-medium text-stone-700"
                        >
                            Mot de passe
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimum 8 caractères"
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-stone-700"
                        >
                            Confirmer le mot de passe
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirmez votre mot de passe"
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-stone-900 px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-stone-700 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:ring-offset-2"
                    >
                        Créer mon compte
                    </button>

                </form>


                {{-- Login link --}}
                <div class="mt-8 text-center">

                    <p class="text-sm text-stone-500">
                        Vous avez déjà un compte ?

                        <a
                            href="{{ route('login') }}"
                            class="font-semibold text-stone-900 transition hover:text-stone-600"
                        >
                            Se connecter
                        </a>
                    </p>

                </div>


                {{-- Back home --}}
                <div class="mt-6 text-center">

                    <a
                        href="{{ url('/') }}"
                        class="text-sm font-medium text-stone-400 transition hover:text-stone-700"
                    >
                        ← Retour à l'accueil
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection