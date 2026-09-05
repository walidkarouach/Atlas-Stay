@extends('layouts.app')

@section('title', 'Connexion - Atlas Stay')

@section('content')

<section class="min-h-[calc(100vh-81px)] bg-stone-50">

    <div class="mx-auto grid min-h-[calc(100vh-81px)] max-w-7xl lg:grid-cols-2">

        {{-- =========================
            LEFT - IMAGE
        ========================== --}}
        <div class="relative hidden overflow-hidden lg:block">

            <img
                src="{{ asset('images/hero.jpg') }}"
                alt="Montagnes du Maroc"
                class="absolute inset-0 h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-black/45"></div>

            <div class="absolute bottom-12 left-12 right-12 text-white">

                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-white/70">
                    Atlas Stay
                </p>

                <h2 class="mt-3 max-w-lg text-4xl font-bold leading-tight">
                    Votre prochaine
                    <br>
                    escapade commence ici.
                </h2>

                <p class="mt-4 max-w-md text-sm leading-6 text-white/70">
                    Découvrez des hébergements uniques
                    au cœur des montagnes du Maroc.
                </p>

            </div>

        </div>


        {{-- =========================
            RIGHT - LOGIN
        ========================== --}}
        <div class="flex items-center justify-center px-6 py-16">

            <div class="w-full max-w-md">


                {{-- Logo --}}
                <div class="mb-10 text-center">

                    <a href="/" class="inline-flex">

                        <img
                            src="{{ asset('images/logo-atlas.png') }}"
                            alt="Atlas Stay"
                            class="h-16 w-auto"
                        >

                    </a>

                </div>


                {{-- Title --}}
                <div class="text-center">

                    <h1 class="text-3xl font-bold tracking-tight text-stone-900">
                        Bienvenue sur Atlas Stay
                    </h1>

                    <p class="mt-3 text-sm text-stone-500">
                        Connectez-vous à votre compte pour continuer.
                    </p>

                </div>


                {{-- Success --}}
                @if(session('success'))

                    <div class="mt-6 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>

                @endif


                {{-- Login Form --}}
                <form
                    action="{{ route('login.submit') }}"
                    method="POST"
                    class="mt-8 space-y-5"
                >

                    @csrf


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-stone-700"
                        >
                            Adresse email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="vous@example.com"
                            required
                            autofocus
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3.5 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-1 focus:ring-stone-900"
                        >

                        @error('email')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

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
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3.5 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-1 focus:ring-stone-900"
                        >

                        @error('password')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- General Error --}}
                    @if($errors->has('email') && $errors->first('email') === 'Les identifiants sont incorrects.')

                        <div class="rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
                            Les identifiants sont incorrects.
                        </div>

                    @endif


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-stone-900 px-6 py-4 text-sm font-semibold text-white transition hover:bg-stone-700"
                    >
                        Se connecter
                    </button>

                </form>


                {{-- Register --}}
                <div class="mt-8 text-center">

                    <p class="text-sm text-stone-500">

                        Vous n'avez pas encore de compte ?

                        <a
                            href="/register"
                            class="font-semibold text-stone-900 transition hover:text-stone-600"
                        >
                            Créer un compte
                        </a>

                    </p>

                </div>


                {{-- Back Home --}}
                <div class="mt-6 text-center">

                    <a
                        href="/"
                        class="text-sm text-stone-400 transition hover:text-stone-700"
                    >
                        ← Retour à l'accueil
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection