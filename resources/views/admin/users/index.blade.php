@extends('layouts.app')

@section('title', 'Utilisateurs - Admin - Atlas Stay')

@section('content')

<div class="min-h-screen bg-stone-50">

    {{-- HEADER --}}
    <section class="border-b border-stone-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-10">

            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

                <div>
                    <p class="text-sm font-medium uppercase tracking-widest text-stone-500">
                        Administration
                    </p>

                    <h1 class="mt-2 text-4xl font-semibold tracking-tight text-stone-950">
                        Utilisateurs
                    </h1>

                    <p class="mt-3 text-stone-500">
                        Gérez les utilisateurs et leurs rôles sur Atlas Stay.
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
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>

                    Dashboard
                </a>

            </div>

        </div>
    </section>


    {{-- CONTENT --}}
    <section class="mx-auto max-w-7xl px-6 py-10">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800">
                {{ session('success') }}
            </div>
        @endif


        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- USERS TABLE --}}
        <div class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div class="border-b border-stone-200 px-6 py-5">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-xl font-semibold text-stone-950">
                            Liste des utilisateurs
                        </h2>

                        <p class="mt-1 text-sm text-stone-500">
                            {{ $users->total() }} utilisateur(s) enregistré(s)
                        </p>
                    </div>

                    {{-- USERS ICON --}}
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-100 text-stone-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                            />

                            <circle
                                cx="9"
                                cy="7"
                                r="4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                            />
                        </svg>

                    </div>

                </div>
            </div>


            {{-- DESKTOP TABLE --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="w-full text-left">

                    <thead class="border-b border-stone-200 bg-stone-50">
                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Utilisateur
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Email
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Téléphone
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Rôle
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-stone-500">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-stone-200">

                        @forelse ($users as $user)

                            <tr class="transition hover:bg-stone-50">

                                {{-- USER --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-stone-900 text-sm font-semibold text-white">
                                            {{ strtoupper(substr($user->nom, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold text-stone-900">
                                                {{ $user->nom }}
                                            </p>

                                            <p class="text-xs text-stone-400">
                                                ID #{{ $user->id_user }}
                                            </p>
                                        </div>

                                    </div>

                                </td>


                                {{-- EMAIL --}}
                                <td class="px-6 py-5 text-sm text-stone-600">
                                    {{ $user->email }}
                                </td>


                                {{-- TELEPHONE --}}
                                <td class="px-6 py-5 text-sm text-stone-600">
                                    {{ $user->telephone ?? '—' }}
                                </td>


                                {{-- ROLE --}}
                                <td class="px-6 py-5">

                                    @if ($user->role?->nom === 'Admin')

                                        <span class="inline-flex rounded-full bg-stone-900 px-3 py-1 text-xs font-semibold text-white">
                                            Admin
                                        </span>

                                    @elseif ($user->role?->nom === 'Propriétaire')

                                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                            Propriétaire
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                                            Client
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        {{-- MODIFIER ROLE --}}
                                        <a
                                            href="{{ route('admin.users.edit-role', $user->id_user) }}"
                                            class="inline-flex items-center gap-2 rounded-xl border border-stone-300 px-4 py-2 text-xs font-semibold text-stone-700 transition hover:bg-stone-100"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                />
                                            </svg>

                                            Modifier rôle

                                        </a>


                                        {{-- SUPPRIMER --}}
                                        @if ($user->id_user !== auth()->user()->id_user)

                                            <button
                                                type="button"
                                                data-delete-url="{{ route('admin.users.destroy', $user->id_user) }}"
                                                data-user-name="{{ $user->nom }}"
                                                class="open-delete-modal inline-flex items-center gap-2 rounded-xl border border-red-200 px-4 py-2 text-xs font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                                                    />
                                                </svg>

                                                Supprimer

                                            </button>

                                        @else

                                            <span class="rounded-xl border border-stone-200 px-4 py-2 text-xs font-medium text-stone-400">
                                                Votre compte
                                            </span>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-100 text-stone-500">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                            />

                                            <circle
                                                cx="9"
                                                cy="7"
                                                r="4"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 text-lg font-semibold text-stone-900">
                                        Aucun utilisateur
                                    </h3>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Aucun utilisateur n'est actuellement enregistré.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- MOBILE CARDS --}}
            <div class="divide-y divide-stone-200 md:hidden">

                @forelse ($users as $user)

                    <div class="p-5">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-stone-900 text-sm font-semibold text-white">
                                    {{ strtoupper(substr($user->nom, 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-semibold text-stone-900">
                                        {{ $user->nom }}
                                    </p>

                                    <p class="text-xs text-stone-400">
                                        ID #{{ $user->id_user }}
                                    </p>
                                </div>

                            </div>


                            @if ($user->role?->nom === 'Admin')

                                <span class="rounded-full bg-stone-900 px-3 py-1 text-xs font-semibold text-white">
                                    Admin
                                </span>

                            @elseif ($user->role?->nom === 'Propriétaire')

                                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                    Propriétaire
                                </span>

                            @else

                                <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                                    Client
                                </span>

                            @endif

                        </div>


                        <div class="mt-5 space-y-3 text-sm">

                            <div class="flex justify-between gap-4">
                                <span class="text-stone-400">
                                    Email
                                </span>

                                <span class="max-w-[65%] break-all text-right text-stone-700">
                                    {{ $user->email }}
                                </span>
                            </div>


                            <div class="flex justify-between gap-4">
                                <span class="text-stone-400">
                                    Téléphone
                                </span>

                                <span class="text-right text-stone-700">
                                    {{ $user->telephone ?? '—' }}
                                </span>
                            </div>

                        </div>


                        <div class="mt-5 flex gap-2">

                            {{-- MODIFIER ROLE --}}
                            <a
                                href="{{ route('admin.users.edit-role', $user->id_user) }}"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-stone-300 px-4 py-3 text-center text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                    />
                                </svg>

                                Modifier rôle

                            </a>


                            {{-- SUPPRIMER --}}
                            @if ($user->id_user !== auth()->user()->id_user)

                                <button
                                    type="button"
                                    data-delete-url="{{ route('admin.users.destroy', $user->id_user) }}"
                                    data-user-name="{{ $user->nom }}"
                                    class="open-delete-modal inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 px-4 py-3 text-sm font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                                        />
                                    </svg>

                                    Supprimer

                                </button>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-100 text-stone-500">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                />

                                <circle
                                    cx="9"
                                    cy="7"
                                    r="4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-stone-900">
                            Aucun utilisateur
                        </h3>

                        <p class="mt-1 text-sm text-stone-500">
                            Aucun utilisateur n'est actuellement enregistré.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- PAGINATION --}}
        @if ($users->hasPages())
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        @endif

    </section>

</div>


{{-- DELETE MODAL --}}
<div
    id="deleteModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-5 backdrop-blur-sm"
    aria-labelledby="deleteModalTitle"
    role="dialog"
    aria-modal="true"
>

    <div
        id="deleteModalContent"
        class="w-full max-w-md scale-95 rounded-3xl bg-white p-7 opacity-0 shadow-2xl transition-all duration-200"
    >

        {{-- MODAL ICON --}}
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-red-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12.73A2 2 0 004.66 20h14.68a2 2 0 001.73-3.41L13.71 3.86a2 2 0 00-3.42 0z"
                />
            </svg>

        </div>


        {{-- MODAL TEXT --}}
        <div class="mt-5 text-center">

            <h2
                id="deleteModalTitle"
                class="text-2xl font-bold tracking-tight text-stone-950"
            >
                Supprimer cet utilisateur ?
            </h2>

            <p class="mt-3 text-sm leading-6 text-stone-500">
                Vous êtes sur le point de supprimer définitivement
                <span
                    id="deleteUserName"
                    class="font-semibold text-stone-900"
                ></span>.
            </p>

            <p class="mt-2 text-xs text-red-500">
                Cette action est irréversible.
            </p>

        </div>


        {{-- MODAL ACTIONS --}}
        <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row">

            <button
                type="button"
                id="cancelDelete"
                class="flex-1 rounded-xl border border-stone-200 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                Annuler
            </button>


            <form
                id="deleteForm"
                method="POST"
                class="flex-1"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="w-full rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700"
                >
                    Oui, supprimer
                </button>

            </form>

        </div>

    </div>

</div>


{{-- MODAL SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        const deleteForm = document.getElementById('deleteForm');
        const deleteUserName = document.getElementById('deleteUserName');
        const cancelDelete = document.getElementById('cancelDelete');
        const deleteButtons = document.querySelectorAll('.open-delete-modal');

        function openModal(url, userName) {

            deleteForm.action = url;
            deleteUserName.textContent = userName;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

            setTimeout(function () {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }


        function closeModal() {

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(function () {
                modal.classList.add('hidden');
                modal.classList.remove('flex');

                document.body.classList.remove('overflow-hidden');
            }, 200);
        }


        deleteButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const url = this.getAttribute('data-delete-url');
                const userName = this.getAttribute('data-user-name');

                openModal(url, userName);
            });

        });


        cancelDelete.addEventListener('click', closeModal);


        modal.addEventListener('click', function (event) {

            if (event.target === modal) {
                closeModal();
            }

        });


        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }

        });

    });
</script>

@endsection