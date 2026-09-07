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
                    ←
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
        <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">

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

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-stone-100 text-xl">
                        👥
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

                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-stone-900 text-sm font-semibold text-white">
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
                                            class="rounded-xl border border-stone-300 px-4 py-2 text-xs font-semibold text-stone-700 transition hover:bg-stone-100"
                                        >
                                            Modifier rôle
                                        </a>


                                        {{-- SUPPRIMER --}}
                                        @if ($user->id_user !== auth()->user()->id_user)

                                            <form
                                                action="{{ route('admin.users.destroy', $user->id_user) }}"
                                                method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-xl border border-red-200 px-4 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                                >
                                                    Supprimer
                                                </button>

                                            </form>

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

                                <td
                                    colspan="5"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="text-4xl">
                                        👥
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

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-stone-900 text-sm font-semibold text-white">
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


                        <div class="mt-5 space-y-2 text-sm">

                            <div class="flex justify-between gap-4">

                                <span class="text-stone-400">
                                    Email
                                </span>

                                <span class="text-right text-stone-700">
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
                                class="flex-1 rounded-xl border border-stone-300 px-4 py-3 text-center text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                            >
                                Modifier rôle
                            </a>


                            {{-- SUPPRIMER --}}
                            @if ($user->id_user !== auth()->user()->id_user)

                                <form
                                    action="{{ route('admin.users.destroy', $user->id_user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-xl border border-red-200 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                    >
                                        Supprimer
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-16 text-center">

                        <div class="text-4xl">
                            👥
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

@endsection