@extends('layouts.app')

@section('title', 'Atlas Stay - Hôtels de montagne au Maroc')

@section('content')

{{-- =========================
    HERO SECTION
========================== --}}
<section class="relative min-h-[calc(100vh-112px)] overflow-hidden">

    {{-- Hero Image --}}
    <img
        src="{{ asset('images/hero.png') }}"
        alt="Montagnes du Maroc"
        class="absolute inset-0 h-full w-full object-cover"
    >

    {{-- Dark Overlay --}}
    <div class="absolute inset-0 bg-black/45"></div>


    {{-- Hero Content --}}
    <div class="relative z-10 mx-auto flex min-h-[calc(100vh-112px)] max-w-7xl items-center px-6 py-12">

        <div class="w-full max-w-5xl text-white">


            {{-- =========================
                SMALL LABEL
            ========================== --}}
            <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-4 py-2 backdrop-blur-sm">

                <span class="h-2 w-2 rounded-full bg-white"></span>

                <span class="text-sm font-medium">
                    Séjours au cœur des montagnes du Maroc
                </span>

            </div>


            {{-- =========================
                MAIN TITLE
            ========================== --}}
            <h1 class="max-w-4xl text-5xl font-bold leading-[1.02] tracking-tight sm:text-6xl lg:text-[72px]">

                Échappez-vous.

                <br>

                <span class="text-white/80">
                    Respirez les montagnes.
                </span>

            </h1>


            {{-- =========================
                DESCRIPTION
            ========================== --}}
            <p class="mt-5 max-w-none text-lg leading-7 text-white/85 sm:text-xl whitespace-nowrap">
                Découvrez des hôtels authentiques dans les plus belles régions montagneuses du Maroc.
            </p>


            {{-- =========================
                SEARCH BOX
            ========================== --}}
            <div class="mt-7 rounded-2xl bg-white p-3 shadow-2xl">

                <div class="grid gap-3 md:grid-cols-[1.4fr_1fr_1fr_auto]">


                    {{-- Destination --}}
                    <div class="rounded-xl bg-stone-100 px-5 py-3.5">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Destination
                        </p>

                        <p class="mt-1 text-sm font-medium text-stone-900">
                            Où allez-vous ?
                        </p>

                    </div>


                    {{-- Arrival --}}
                    <div class="rounded-xl bg-stone-100 px-5 py-3.5">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Arrivée
                        </p>

                        <p class="mt-1 text-sm font-medium text-stone-900">
                            Ajouter une date
                        </p>

                    </div>


                    {{-- Guests --}}
                    <div class="rounded-xl bg-stone-100 px-5 py-3.5">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Voyageurs
                        </p>

                        <p class="mt-1 text-sm font-medium text-stone-900">
                            2 voyageurs
                        </p>

                    </div>


                    {{-- Search Button --}}
                    <a
                        href="/hotels"
                        class="flex items-center justify-center rounded-xl bg-stone-900 px-8 py-4 text-sm font-semibold text-white transition hover:bg-stone-700"
                    >
                        Rechercher
                    </a>

                </div>

            </div>


            {{-- =========================
                QUICK LINK
            ========================== --}}
            <div class="mt-4">

                <a
                    href="/hotels"
                    class="inline-flex items-center gap-2 text-sm font-medium text-white/80 transition hover:text-white"
                >

                    Explorer tous les hôtels

                    <span class="text-lg">
                        →
                    </span>

                </a>

            </div>

        </div>

    </div>

</section>



{{-- =========================
    DESTINATIONS
========================== --}}
<section class="bg-stone-50 py-24">

    <div class="mx-auto max-w-7xl px-6">


        {{-- Header --}}
        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">

            <div class="max-w-2xl">

                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">
                    Explore le Maroc
                </p>

                <h2 class="mt-3 text-4xl font-bold tracking-tight text-stone-900 sm:text-5xl">

                    Des destinations

                    <br>

                    qui valent le détour.

                </h2>

                <p class="mt-5 max-w-xl text-base leading-7 text-stone-500">

                    Explorez les plus belles destinations montagneuses
                    du Maroc et trouvez l'hébergement idéal pour votre séjour.

                </p>

            </div>


            <a
                href="/hotels"
                class="inline-flex items-center gap-2 text-sm font-semibold text-stone-900 transition hover:gap-3"
            >

                Voir tous les hôtels

                <span class="text-lg">
                    →
                </span>

            </a>

        </div>


        {{-- Destinations Grid --}}
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">


            {{-- Béni Mellal --}}
            <a
                href="/hotels?ville=Beni%20Mellal"
                class="group relative h-[360px] overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('images/destinations/beni-mellal.jpg') }}"
                    alt="Béni Mellal"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7 text-white">

                    <p class="text-sm text-white/70">
                        Atlas Central
                    </p>

                    <h3 class="mt-1 text-2xl font-semibold">
                        Béni Mellal
                    </h3>

                    <p class="mt-2 text-sm text-white/70">
                        Découvrez les montagnes et les paysages naturels.
                    </p>

                </div>

            </a>


            {{-- Azilal --}}
            <a
                href="/hotels?ville=Azilal"
                class="group relative h-[360px] overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('images/destinations/azilal.jpg') }}"
                    alt="Azilal"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7 text-white">

                    <p class="text-sm text-white/70">
                        Haut Atlas
                    </p>

                    <h3 class="mt-1 text-2xl font-semibold">
                        Azilal
                    </h3>

                    <p class="mt-2 text-sm text-white/70">
                        Entre cascades, vallées et montagnes.
                    </p>

                </div>

            </a>


            {{-- Bin El Ouidane --}}
            <a
                href="/hotels?ville=Bin%20El%20Ouidane"
                class="group relative h-[360px] overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('images/destinations/bin-el-ouidane.jpg') }}"
                    alt="Bin El Ouidane"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7 text-white">

                    <p class="text-sm text-white/70">
                        Lac & montagnes
                    </p>

                    <h3 class="mt-1 text-2xl font-semibold">
                        Bin El Ouidane
                    </h3>

                    <p class="mt-2 text-sm text-white/70">
                        Un lac turquoise au cœur du Haut Atlas.
                    </p>

                </div>

            </a>


            {{-- Ifrane --}}
            <a
                href="/hotels?ville=Ifrane"
                class="group relative h-[360px] overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('images/destinations/ifrane.jpg') }}"
                    alt="Ifrane"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7 text-white">

                    <p class="text-sm text-white/70">
                        Moyen Atlas
                    </p>

                    <h3 class="mt-1 text-2xl font-semibold">
                        Ifrane
                    </h3>

                    <p class="mt-2 text-sm text-white/70">
                        Forêts de cèdres et paysages alpins.
                    </p>

                </div>

            </a>


            {{-- Khénifra --}}
            <a
                href="/hotels?ville=Khénifra"
                class="group relative h-[360px] overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('images/destinations/khenifra.jpg') }}"
                    alt="Khénifra"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7 text-white">

                    <p class="text-sm text-white/70">
                        Moyen Atlas
                    </p>

                    <h3 class="mt-1 text-2xl font-semibold">
                        Khénifra
                    </h3>

                    <p class="mt-2 text-sm text-white/70">
                        Nature sauvage, forêts et montagnes.
                    </p>

                </div>

            </a>


            {{-- Chefchaouen --}}
            <a
                href="/hotels?ville=Chefchaouen"
                class="group relative h-[360px] overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('images/destinations/chefchaouen.jpg') }}"
                    alt="Chefchaouen"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7 text-white">

                    <p class="text-sm text-white/70">
                        Rif
                    </p>

                    <h3 class="mt-1 text-2xl font-semibold">
                        Chefchaouen
                    </h3>

                    <p class="mt-2 text-sm text-white/70">
                        La ville bleue entourée par les montagnes du Rif.
                    </p>

                </div>

            </a>

        </div>

    </div>

</section>

@endsection