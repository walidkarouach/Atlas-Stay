@extends('layouts.app')

@section('title', 'Mon profil - Atlas Stay')

@section('content')

<section class="min-h-[calc(100vh-80px)] bg-stone-50">

    {{-- Header --}}
    <div class="border-b border-stone-200 bg-white">

        <div class="mx-auto max-w-3xl px-6 py-12 text-center">

            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-stone-400">
                Atlas Stay
            </p>

            <h1 class="mt-3 text-4xl font-semibold tracking-tight text-stone-950 sm:text-5xl">
                Mon profil
            </h1>

            <p class="mx-auto mt-4 max-w-lg text-sm leading-6 text-stone-500">
                Gérez vos informations personnelles et consultez les détails de votre compte.
            </p>

        </div>

    </div>


    {{-- Main content --}}
    <div class="mx-auto max-w-3xl px-6 py-14">

        {{-- Main profile card --}}
        <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-white shadow-[0_20px_60px_rgba(0,0,0,0.06)]">


            {{-- Profile identity --}}
            <div class="px-7 py-9 text-center sm:px-10">

                <p class="text-xs font-medium uppercase tracking-[0.25em] text-stone-400">
                    Bienvenue sur Atlas Stay
                </p>

                <h2 class="mt-3 text-3xl font-semibold tracking-tight text-stone-950">
                    {{ $user->nom }}
                </h2>

                <p class="mt-2 text-sm text-stone-500">
                    {{ $user->email }}
                </p>

                <div class="mt-5 flex justify-center">

                    <span class="rounded-full border border-stone-200 bg-stone-50 px-5 py-2 text-xs font-semibold text-stone-600">
                        {{ $user->role->nom }}
                    </span>

                </div>

            </div>


            {{-- Decorative divider --}}
            <div class="px-7 sm:px-10">

                <div class="h-px bg-stone-100"></div>

            </div>


            {{-- Account information --}}
            <div class="px-7 py-9 sm:px-10">

                <div class="text-center">

                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-stone-400">
                        Informations personnelles
                    </p>

                    <h3 class="mt-2 text-2xl font-semibold tracking-tight text-stone-950">
                        Informations du compte
                    </h3>

                </div>


                {{-- Information cards --}}
                <div class="mt-8 space-y-4">


                    {{-- Name --}}
                    <div class="group rounded-2xl border border-stone-200 bg-stone-50 px-6 py-5 transition hover:border-stone-300 hover:bg-white">

                        <div class="flex items-center justify-between gap-6">

                            <div>

                                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-stone-400">
                                    Nom complet
                                </p>

                                <p class="mt-2 text-base font-semibold text-stone-900">
                                    {{ $user->nom }}
                                </p>

                            </div>

                            <span class="text-xs text-stone-300">
                                01
                            </span>

                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="group rounded-2xl border border-stone-200 bg-stone-50 px-6 py-5 transition hover:border-stone-300 hover:bg-white">

                        <div class="flex items-center justify-between gap-6">

                            <div class="min-w-0">

                                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-stone-400">
                                    Adresse email
                                </p>

                                <p class="mt-2 break-all text-base font-semibold text-stone-900">
                                    {{ $user->email }}
                                </p>

                            </div>

                            <span class="text-xs text-stone-300">
                                02
                            </span>

                        </div>

                    </div>


                    {{-- Phone --}}
                    <div class="group rounded-2xl border border-stone-200 bg-stone-50 px-6 py-5 transition hover:border-stone-300 hover:bg-white">

                        <div class="flex items-center justify-between gap-6">

                            <div>

                                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-stone-400">
                                    Téléphone
                                </p>

                                <p class="mt-2 text-base font-semibold text-stone-900">

                                    @if ($user->telephone)
                                        {{ $user->telephone }}
                                    @else
                                        Non renseigné
                                    @endif

                                </p>

                            </div>

                            <span class="text-xs text-stone-300">
                                03
                            </span>

                        </div>

                    </div>


                    {{-- Account type --}}
                    <div class="group rounded-2xl border border-stone-200 bg-stone-50 px-6 py-5 transition hover:border-stone-300 hover:bg-white">

                        <div class="flex items-center justify-between gap-6">

                            <div>

                                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-stone-400">
                                    Type de compte
                                </p>

                                <p class="mt-2 text-base font-semibold text-stone-900">
                                    {{ $user->role->nom }}
                                </p>

                            </div>

                            <span class="text-xs text-stone-300">
                                04
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="mt-9 border-t border-stone-100 pt-8">

                    <div class="grid gap-3 sm:grid-cols-2">


                        {{-- Edit profile --}}
                        <a
                            href="#"
                            class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-stone-700"
                        >
                            Modifier mon profil
                        </a>


                        {{-- Reservations --}}
                        @if ($user->role->nom === 'Client')

                            <a
                                href="{{ route('reservations.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                            >
                                Mes réservations
                            </a>

                        @endif


                        {{-- Notifications --}}
                        <a
                            href="{{ route('notifications.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-100 sm:col-span-2"
                        >
                            Notifications
                        </a>

                    </div>

                </div>

            </div>


            {{-- Bottom accent --}}
            <div class="h-1 bg-stone-900"></div>

        </div>

    </div>

</section>

@endsection