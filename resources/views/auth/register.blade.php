@extends('layouts.app')

@section('title', 'Inscription - Atlas Stay')

@section('content')

<section class="min-h-screen bg-[#F4F3F0] px-4 py-6 sm:px-6 lg:flex lg:items-center lg:justify-center">

    <div class="grid w-full max-w-4xl overflow-hidden rounded-3xl bg-white shadow-xl lg:grid-cols-2">

        {{-- IMAGE SIDE --}}
        <div class="relative hidden min-h-[560px] overflow-hidden lg:block">

            <img
                src="{{ asset('images/hero.png') }}"
                alt="Montagnes du Maroc"
                class="absolute inset-0 h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-black/45"></div>

            <div class="relative z-10 flex h-full items-center px-8 xl:px-10">

                <div class="max-w-xs text-white">

                    <p class="mb-4 text-xs font-semibold uppercase tracking-[0.25em] text-white/80">
                        Atlas Stay
                    </p>

                    <h2 class="text-4xl font-bold leading-tight">
                        Créez votre
                        <br>
                        compte
                    </h2>

                    <p class="mt-4 text-sm leading-6 text-white/90">
                        Rejoignez Atlas Stay et découvrez les plus beaux
                        hôtels des régions montagneuses du Maroc.
                    </p>

                </div>

            </div>

        </div>


        {{-- REGISTER FORM --}}
        <div class="flex items-center justify-center px-6 py-7 sm:px-9 lg:px-10">

            <div class="w-full max-w-sm">

                {{-- LOGO --}}
                <div class="mb-4 text-center">

                    <a href="{{ url('/') }}" class="inline-flex">

                        <img
                            src="{{ asset('images/logo-atlas.png') }}"
                            alt="Atlas Stay"
                            class="h-12 w-auto"
                        >

                    </a>

                </div>


                {{-- TITLE --}}
                <div class="text-center">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-stone-400">
                        Bienvenue
                    </p>

                    <h1 class="mt-1 text-2xl font-bold text-stone-900">
                        Créer un compte
                    </h1>

                    <p class="mt-1 text-xs text-stone-500">
                        Préparez votre prochaine aventure.
                    </p>

                </div>


                {{-- ERRORS --}}
                @if ($errors->any())

                    <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2">

                        @foreach ($errors->all() as $error)

                            <p class="text-xs text-red-700">
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                @endif


                {{-- FORM --}}
                <form
                    action="{{ route('register.submit') }}"
                    method="POST"
                    class="mt-5 space-y-3"
                >

                    @csrf


                    {{-- NAME --}}
                    <div>

                        <label
                            for="nom"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Nom complet
                        </label>

                        <input
                            id="nom"
                            type="text"
                            name="nom"
                            value="{{ old('nom') }}"
                            placeholder="Votre nom complet"
                            required
                            autocomplete="name"
                            class="w-full rounded-xl border border-stone-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                        @error('nom')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Adresse email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="exemple@email.com"
                            required
                            autocomplete="email"
                            class="w-full rounded-xl border border-stone-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                        @error('email')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Mot de passe
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Minimum 8 caractères"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-stone-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                        @error('password')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- CONFIRM PASSWORD --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Confirmer le mot de passe
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirmez votre mot de passe"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-stone-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                        @error('password_confirmation')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- TERMS --}}
                    <div class="flex items-start gap-2 pt-1">

                        <input
                            id="terms"
                            type="checkbox"
                            required
                            class="mt-0.5 h-3.5 w-3.5 rounded border-stone-300 text-stone-900 focus:ring-stone-900"
                        >

                        <label
                            for="terms"
                            class="text-[11px] leading-4 text-stone-500"
                        >
                            J'accepte les conditions générales d'utilisation.
                        </label>

                    </div>


                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-800 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:ring-offset-2"
                    >
                        Créer mon compte
                    </button>

                </form>


                {{-- LOGIN LINK --}}
                <p class="mt-4 text-center text-xs text-stone-500">

                    Vous avez déjà un compte ?

                    <a
                        href="{{ route('login') }}"
                        class="font-semibold text-stone-900 hover:underline"
                    >
                        Se connecter
                    </a>

                </p>


                {{-- HOME LINK --}}
                <div class="mt-2 text-center">

                    <a
                        href="{{ url('/') }}"
                        class="text-xs text-stone-400 transition hover:text-stone-700"
                    >
                        ← Retour à l'accueil
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection