@extends('layouts.app')

@section('title', 'Gestion des hôtels - Atlas Stay')

@section('content')

<section class="bg-stone-50">

    <div class="mx-auto max-w-7xl px-6 py-12">

        {{-- HEADER --}}
        <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

            <div>

                <p class="text-sm font-semibold uppercase tracking-widest text-stone-500">
                    Administration
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-stone-950 md:text-4xl">
                    Gestion des hôtels
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-stone-600">
                    Consultez, validez, refusez ou supprimez les hôtels proposés
                    par les propriétaires.
                </p>

            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex w-fit items-center rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                ← Retour au dashboard
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ERROR MESSAGE --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                @foreach ($errors->all() as $error)

                    <p class="text-sm font-medium text-red-800">
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- STATISTIQUES --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                <p class="text-sm text-stone-500">
                    Total
                </p>

                <p class="mt-2 text-3xl font-semibold text-stone-950">
                    {{ $hotels->total() }}
                </p>

            </div>


            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

                <p class="text-sm text-amber-700">
                    En attente
                </p>

                <p class="mt-2 text-3xl font-semibold text-amber-900">
                    {{ \App\Models\Hotel::where('statut', 'en_attente')->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

                <p class="text-sm text-green-700">
                    Validés
                </p>

                <p class="mt-2 text-3xl font-semibold text-green-900">
                    {{ \App\Models\Hotel::where('statut', 'valide')->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <p class="text-sm text-red-700">
                    Refusés
                </p>

                <p class="mt-2 text-3xl font-semibold text-red-900">
                    {{ \App\Models\Hotel::where('statut', 'refuse')->count() }}
                </p>

            </div>

        </div>


        {{-- DESKTOP TABLE --}}
        <div class="hidden overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm lg:block">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="border-b border-stone-200 bg-stone-50">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Hôtel
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Localisation
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Propriétaire
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Prix
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Statut
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-stone-100">

                        @forelse ($hotels as $hotel)

                            <tr class="transition hover:bg-stone-50">

                                {{-- HOTEL --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div class="h-14 w-20 shrink-0 overflow-hidden rounded-xl bg-stone-100">

                                            @if ($hotel->images->first())

                                                <img
                                                    src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                                                    alt="{{ $hotel->nom }}"
                                                    class="h-full w-full object-cover"
                                                >

                                            @else

                                                <div class="flex h-full w-full items-center justify-center text-xl">
                                                    🏔️
                                                </div>

                                            @endif

                                        </div>


                                        <div>

                                            <p class="font-semibold text-stone-950">
                                                {{ $hotel->nom }}
                                            </p>

                                            <p class="mt-1 text-xs text-stone-500">
                                                ID #{{ $hotel->id_hotel }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- LOCALISATION --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-medium text-stone-800">
                                        {{ $hotel->ville }}
                                    </p>

                                    <p class="mt-1 max-w-xs text-xs text-stone-500">
                                        {{ $hotel->adresse }}
                                    </p>

                                </td>


                                {{-- PROPRIETAIRE --}}
                                <td class="px-6 py-5">

                                    @if ($hotel->proprietaire)

                                        <p class="text-sm font-medium text-stone-800">
                                            {{ $hotel->proprietaire->nom }}
                                        </p>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $hotel->proprietaire->email }}
                                        </p>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Propriétaire introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- PRIX --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-semibold text-stone-900">
                                        {{ number_format($hotel->prix, 0, ',', ' ') }} DH
                                    </p>

                                    <p class="text-xs text-stone-500">
                                        / nuit
                                    </p>

                                </td>


                                {{-- STATUT --}}
                                <td class="px-6 py-5">

                                    @if ($hotel->statut === 'en_attente')

                                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                            En attente
                                        </span>

                                    @elseif ($hotel->statut === 'valide')

                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                            Validé
                                        </span>

                                    @elseif ($hotel->statut === 'refuse')

                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                            Refusé
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                                            {{ $hotel->statut }}
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-wrap justify-end gap-2">

                                        @if ($hotel->statut === 'en_attente')

                                            <form
                                                action="{{ route('admin.hotels.validate', $hotel->id_hotel) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg bg-green-700 px-3 py-2 text-xs font-semibold text-white transition hover:bg-green-800"
                                                >
                                                    Valider
                                                </button>

                                            </form>


                                            <form
                                                action="{{ route('admin.hotels.reject', $hotel->id_hotel) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg bg-red-700 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-800"
                                                >
                                                    Refuser
                                                </button>

                                            </form>

                                        @endif


                                        <form
                                            action="{{ route('admin.hotels.destroy', $hotel->id_hotel) }}"
                                            method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel ?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg border border-stone-300 px-3 py-2 text-xs font-semibold text-stone-700 transition hover:bg-stone-100"
                                            >
                                                Supprimer
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="text-4xl">
                                        🏔️
                                    </div>

                                    <p class="mt-4 font-semibold text-stone-900">
                                        Aucun hôtel trouvé
                                    </p>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Aucun hôtel n'est actuellement enregistré.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- MOBILE CARDS --}}
        <div class="space-y-4 lg:hidden">

            @forelse ($hotels as $hotel)

                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">

                    {{-- IMAGE --}}
                    <div class="h-48 bg-stone-100">

                        @if ($hotel->images->first())

                            <img
                                src="{{ asset('storage/' . $hotel->images->first()->image) }}"
                                alt="{{ $hotel->nom }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-4xl">
                                🏔️
                            </div>

                        @endif

                    </div>


                    <div class="p-5">

                        {{-- TITLE --}}
                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h2 class="font-semibold text-stone-950">
                                    {{ $hotel->nom }}
                                </h2>

                                <p class="mt-1 text-xs text-stone-500">
                                    ID #{{ $hotel->id_hotel }}
                                </p>

                            </div>


                            {{-- STATUS --}}
                            @if ($hotel->statut === 'en_attente')

                                <span class="shrink-0 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                    En attente
                                </span>

                            @elseif ($hotel->statut === 'valide')

                                <span class="shrink-0 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                    Validé
                                </span>

                            @elseif ($hotel->statut === 'refuse')

                                <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                    Refusé
                                </span>

                            @endif

                        </div>


                        {{-- DETAILS --}}
                        <div class="mt-5 space-y-3">

                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Localisation
                                </p>

                                <p class="mt-1 text-sm text-stone-700">
                                    {{ $hotel->ville }} — {{ $hotel->adresse }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Propriétaire
                                </p>

                                @if ($hotel->proprietaire)

                                    <p class="mt-1 text-sm font-medium text-stone-800">
                                        {{ $hotel->proprietaire->nom }}
                                    </p>

                                    <p class="text-xs text-stone-500">
                                        {{ $hotel->proprietaire->email }}
                                    </p>

                                @else

                                    <p class="mt-1 text-sm text-stone-400">
                                        Propriétaire introuvable
                                    </p>

                                @endif

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide text-stone-400">
                                    Tarif
                                </p>

                                <p class="mt-1 text-sm font-semibold text-stone-900">
                                    {{ number_format($hotel->prix, 0, ',', ' ') }} DH / nuit
                                </p>

                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="mt-6 grid gap-2 sm:grid-cols-2">

                            @if ($hotel->statut === 'en_attente')

                                <form
                                    action="{{ route('admin.hotels.validate', $hotel->id_hotel) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-green-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-800"
                                    >
                                        Valider
                                    </button>

                                </form>


                                <form
                                    action="{{ route('admin.hotels.reject', $hotel->id_hotel) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-red-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-800"
                                    >
                                        Refuser
                                    </button>

                                </form>

                            @endif


                            <form
                                action="{{ route('admin.hotels.destroy', $hotel->id_hotel) }}"
                                method="POST"
                                class="sm:col-span-2"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel ?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                                >
                                    Supprimer l’hôtel
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="rounded-2xl border border-stone-200 bg-white px-6 py-16 text-center">

                    <div class="text-4xl">
                        🏔️
                    </div>

                    <p class="mt-4 font-semibold text-stone-900">
                        Aucun hôtel trouvé
                    </p>

                    <p class="mt-1 text-sm text-stone-500">
                        Aucun hôtel n'est actuellement enregistré.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if ($hotels->hasPages())

            <div class="mt-8">
                {{ $hotels->links() }}
            </div>

        @endif

    </div>

</section>

@endsection