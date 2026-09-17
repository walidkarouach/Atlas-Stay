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
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 19l-7-7m0 0l7-7m-7 7h20"
                    />
                </svg>

                Retour au dashboard
            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))

            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100 text-green-700">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ERRORS --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0 text-red-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.1 14a2 2 0 001.73 3h16.16a2 2 0 001.73-3l-8.1-14a2 2 0 00-3.46 0z"
                        />
                    </svg>

                    <div class="space-y-1">

                        @foreach ($errors->all() as $error)

                            <p class="text-sm font-medium text-red-800">
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif


        {{-- STATISTIQUES --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

            {{-- TOTAL --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-stone-500">
                        Total des avis
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 10h8M8 14h5m-9 6l3-3h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v13z"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-4xl font-semibold text-stone-950">
                    {{ \App\Models\Avis::count() }}
                </p>

            </div>


            {{-- NOTE MOYENNE --}}
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-amber-700">
                        Note moyenne
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                            />
                        </svg>

                    </div>

                </div>

                @php
                    $averageNote = \App\Models\Avis::avg('note');
                @endphp

                <p class="mt-4 text-4xl font-semibold text-amber-900">
                    {{ $averageNote ? number_format($averageNote, 1, ',', ' ') : '0,0' }}/5
                </p>

            </div>


            {{-- AVIS AFFICHÉS --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-stone-500">
                        Avis affichés
                    </p>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-4xl font-semibold text-stone-950">
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

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-stone-900 text-sm font-semibold text-white">
                                                {{ strtoupper(substr($avi->utilisateur->nom, 0, 1)) }}
                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-stone-900">
                                                    {{ $avi->utilisateur->nom }}
                                                </p>

                                                <p class="mt-1 text-xs text-stone-500">
                                                    {{ $avi->utilisateur->email }}
                                                </p>

                                            </div>

                                        </div>

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

                                        <div class="flex items-center gap-0.5 text-amber-500">

                                            @for ($i = 1; $i <= 5; $i++)

                                                @if ($i <= $avi->note)

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                                                        />
                                                    </svg>

                                                @else

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 text-stone-300"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                                                        />
                                                    </svg>

                                                @endif

                                            @endfor

                                        </div>

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

                                        <button
                                            type="button"
                                            data-delete-url="{{ route('admin.avis.destroy', $avi->id_avis) }}"
                                            data-avis-name="{{ $avi->commentaire ?: 'cet avis' }}"
                                            class="open-avis-delete-modal inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50"
                                        >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h12"
                                                    />
                                                </svg>

                                                Supprimer

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-50 text-amber-500">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-9 w-9"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                                            />
                                        </svg>

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

                                <div class="mt-2 flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-stone-900 text-xs font-semibold text-white">
                                        {{ strtoupper(substr($avi->utilisateur->nom, 0, 1)) }}
                                    </div>

                                    <div>

                                        <h2 class="font-semibold text-stone-950">
                                            {{ $avi->utilisateur->nom }}
                                        </h2>

                                        <p class="mt-1 text-xs text-stone-500">
                                            {{ $avi->utilisateur->email }}
                                        </p>

                                    </div>

                                </div>

                            @else

                                <h2 class="mt-1 text-sm text-stone-400">
                                    Client introuvable
                                </h2>

                            @endif

                        </div>


                        {{-- NOTE --}}
                        <div class="text-right">

                            <div class="flex items-center gap-0.5 text-amber-500">

                                @for ($i = 1; $i <= 5; $i++)

                                    @if ($i <= $avi->note)

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                                            />
                                        </svg>

                                    @else

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-stone-300"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                                            />
                                        </svg>

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
                    <button
                        type="button"
                        data-delete-url="{{ route('admin.avis.destroy', $avi->id_avis) }}"
                        data-avis-name="{{ $avi->commentaire ?: 'cet avis' }}"
                        class="open-avis-delete-modal mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 px-4 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-50"
                    >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h12"
                                />
                            </svg>

                            Supprimer l’avis

                    </button>

                </div>

            @empty

                <div class="rounded-2xl border border-stone-200 bg-white px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-50 text-amber-500">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-9 w-9"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                            />
                        </svg>

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


{{-- MODAL SUPPRESSION AVIS --}}
<div
    id="avisDeleteModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 backdrop-blur-sm"
>
    <div
        id="avisDeleteModalContent"
        class="w-full max-w-md scale-95 rounded-3xl bg-white p-6 opacity-0 shadow-2xl transition-all duration-200"
    >
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.8 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 3.8a2 2 0 0 0-3.4 0Z"/>
                </svg>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-stone-950">Supprimer cet avis ?</h2>
                <p class="mt-2 text-sm leading-6 text-stone-600">
                    Êtes-vous sûr de vouloir supprimer cet avis ? Cette action est irréversible.
                </p>
                <p id="avisDeleteName" class="mt-2 text-sm font-semibold text-stone-900"></p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button
                type="button"
                id="cancelAvisDelete"
                class="rounded-xl border border-stone-300 px-4 py-2.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                Annuler
            </button>

            <form id="avisDeleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
                >
                    Oui, supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('avisDeleteModal');
        const modalContent = document.getElementById('avisDeleteModalContent');
        const deleteForm = document.getElementById('avisDeleteForm');
        const avisName = document.getElementById('avisDeleteName');
        const cancelButton = document.getElementById('cancelAvisDelete');
        const deleteButtons = document.querySelectorAll('.open-avis-delete-modal');

        function openAvisDeleteModal(url, name) {
            deleteForm.action = url;
            avisName.textContent = name ? '« ' + name + ' »' : '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAvisDeleteModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                openAvisDeleteModal(this.dataset.deleteUrl, this.dataset.avisName);
            });
        });

        cancelButton.addEventListener('click', closeAvisDeleteModal);

        modal.addEventListener('click', function (event) {
            if (event.target === modal) closeAvisDeleteModal();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeAvisDeleteModal();
            }
        });
    });
</script>

@endsection