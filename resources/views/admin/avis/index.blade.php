@extends('layouts.app')

@section('title', 'Gestion des avis - Atlas Stay')

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
                    Gestion des avis
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-stone-600">
                    Consultez les avis publiés par les clients et gérez
                    les commentaires présents sur la plateforme.
                </p>

            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex w-fit items-center rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                ← Retour au dashboard
            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))

            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ERRORS --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                @foreach ($errors->all() as $error)

                    <p class="text-sm font-medium text-red-800">
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- STATISTIQUE --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                <p class="text-sm text-stone-500">
                    Total des avis
                </p>

                <p class="mt-2 text-3xl font-semibold text-stone-950">
                    {{ \App\Models\Avis::count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

                <p class="text-sm text-amber-700">
                    Note moyenne
                </p>

                <p class="mt-2 text-3xl font-semibold text-amber-900">

                    @php
                        $averageNote = \App\Models\Avis::avg('note');
                    @endphp

                    {{ $averageNote ? number_format($averageNote, 1, ',', ' ') : '0,0' }}/5

                </p>

            </div>


            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                <p class="text-sm text-stone-500">
                    Avis affichés
                </p>

                <p class="mt-2 text-3xl font-semibold text-stone-950">
                    {{ $avis->total() }}
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
                                Client
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Hôtel
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Note
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Commentaire
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Date
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-stone-100">

                        @forelse ($avis as $avi)

                            <tr class="transition hover:bg-stone-50">

                                {{-- CLIENT --}}
                                <td class="px-6 py-5">

                                    @if ($avi->utilisateur)

                                        <p class="text-sm font-semibold text-stone-900">
                                            {{ $avi->utilisateur->nom }}
                                        </p>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $avi->utilisateur->email }}
                                        </p>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Client introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- HOTEL --}}
                                <td class="px-6 py-5">

                                    @if ($avi->hotel)

                                        <p class="text-sm font-medium text-stone-800">
                                            {{ $avi->hotel->nom }}
                                        </p>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $avi->hotel->ville }}
                                        </p>

                                    @else

                                        <span class="text-sm text-stone-400">
                                            Hôtel introuvable
                                        </span>

                                    @endif

                                </td>


                                {{-- NOTE --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-2">

                                        <span class="text-base tracking-wide text-amber-500">
                                            @for ($i = 1; $i <= 5; $i++)

                                                @if ($i <= $avi->note)
                                                    ★
                                                @else
                                                    ☆
                                                @endif

                                            @endfor
                                        </span>

                                        <span class="text-sm font-semibold text-stone-800">
                                            {{ $avi->note }}/5
                                        </span>

                                    </div>

                                </td>


                                {{-- COMMENTAIRE --}}
                                <td class="max-w-sm px-6 py-5">

                                    <p class="text-sm leading-6 text-stone-700">
                                        {{ $avi->commentaire ?: 'Aucun commentaire.' }}
                                    </p>

                                </td>


                                {{-- DATE --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm text-stone-700">
                                        {{ \Carbon\Carbon::parse($avi->created_at)->format('d/m/Y') }}
                                    </p>

                                    <p class="mt-1 text-xs text-stone-500">
                                        {{ \Carbon\Carbon::parse($avi->created_at)->format('H:i') }}
                                    </p>

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-end">

                                        <form
                                            action="{{ route('admin.avis.destroy', $avi->id_avis) }}"
                                            method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50"
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
                                        ⭐
                                    </div>

                                    <p class="mt-4 font-semibold text-stone-900">
                                        Aucun avis
                                    </p>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Aucun avis n'est actuellement enregistré.
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

            @forelse ($avis as $avi)

                <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">

                    {{-- HEADER --}}
                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-xs uppercase tracking-wide text-stone-400">
                                Client
                            </p>

                            @if ($avi->utilisateur)

                                <h2 class="mt-1 font-semibold text-stone-950">
                                    {{ $avi->utilisateur->nom }}
                                </h2>

                                <p class="mt-1 text-xs text-stone-500">
                                    {{ $avi->utilisateur->email }}
                                </p>

                            @else

                                <h2 class="mt-1 text-sm text-stone-400">
                                    Client introuvable
                                </h2>

                            @endif

                        </div>


                        {{-- NOTE --}}
                        <div class="text-right">

                            <div class="text-base tracking-wide text-amber-500">

                                @for ($i = 1; $i <= 5; $i++)

                                    @if ($i <= $avi->note)
                                        ★
                                    @else
                                        ☆
                                    @endif

                                @endfor

                            </div>

                            <p class="mt-1 text-xs font-semibold text-stone-700">
                                {{ $avi->note }}/5
                            </p>

                        </div>

                    </div>


                    {{-- HOTEL --}}
                    <div class="mt-5">

                        <p class="text-xs uppercase tracking-wide text-stone-400">
                            Hôtel
                        </p>

                        @if ($avi->hotel)

                            <p class="mt-1 text-sm font-medium text-stone-800">
                                {{ $avi->hotel->nom }}
                            </p>

                            <p class="text-xs text-stone-500">
                                {{ $avi->hotel->ville }}
                            </p>

                        @else

                            <p class="mt-1 text-sm text-stone-400">
                                Hôtel introuvable
                            </p>

                        @endif

                    </div>


                    {{-- COMMENTAIRE --}}
                    <div class="mt-5 rounded-xl bg-stone-50 p-4">

                        <p class="text-xs uppercase tracking-wide text-stone-400">
                            Commentaire
                        </p>

                        <p class="mt-2 text-sm leading-6 text-stone-700">
                            {{ $avi->commentaire ?: 'Aucun commentaire.' }}
                        </p>

                    </div>


                    {{-- DATE --}}
                    <div class="mt-4">

                        <p class="text-xs text-stone-500">
                            Publié le
                            {{ \Carbon\Carbon::parse($avi->created_at)->format('d/m/Y à H:i') }}
                        </p>

                    </div>


                    {{-- ACTION --}}
                    <form
                        action="{{ route('admin.avis.destroy', $avi->id_avis) }}"
                        method="POST"
                        class="mt-5"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-red-200 px-4 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-50"
                        >
                            Supprimer l’avis
                        </button>

                    </form>

                </div>

            @empty

                <div class="rounded-2xl border border-stone-200 bg-white px-6 py-16 text-center">

                    <div class="text-4xl">
                        ⭐
                    </div>

                    <p class="mt-4 font-semibold text-stone-900">
                        Aucun avis
                    </p>

                    <p class="mt-1 text-sm text-stone-500">
                        Aucun avis n'est actuellement enregistré.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if ($avis->hasPages())

            <div class="mt-8">
                {{ $avis->links() }}
            </div>

        @endif

    </div>

</section>

@endsection