@extends('layouts.app')

@section('title', 'Modifier le rôle - Atlas Stay')

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
                        Modifier le rôle
                    </h1>

                    <p class="mt-3 text-stone-500">
                        Modifiez le rôle de l’utilisateur sélectionné.
                    </p>

                </div>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="inline-flex w-fit items-center gap-2 rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                >
                    ←
                    Retour aux utilisateurs
                </a>

            </div>

        </div>

    </section>


    {{-- CONTENT --}}
    <section class="mx-auto max-w-3xl px-6 py-12">

        {{-- ERRORS --}}
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


        {{-- USER CARD --}}
        <div class="rounded-2xl border border-stone-200 bg-white p-8 shadow-sm">

            <div class="flex items-center gap-4 border-b border-stone-200 pb-6">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-stone-900 text-lg font-semibold text-white">
                    {{ strtoupper(substr($user->nom, 0, 1)) }}
                </div>

                <div>

                    <h2 class="text-xl font-semibold text-stone-950">
                        {{ $user->nom }}
                    </h2>

                    <p class="mt-1 text-sm text-stone-500">
                        {{ $user->email }}
                    </p>

                    <p class="mt-1 text-xs text-stone-400">
                        ID #{{ $user->id_user }}
                    </p>

                </div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('admin.users.update-role', $user->id_user) }}"
                method="POST"
                class="mt-8"
            >

                @csrf

                @method('PUT')


                {{-- CURRENT ROLE --}}
                <div class="mb-6 rounded-xl bg-stone-50 p-5">

                    <p class="text-xs font-medium uppercase tracking-wider text-stone-400">
                        Rôle actuel
                    </p>

                    <p class="mt-2 text-base font-semibold text-stone-900">
                        {{ $user->role?->nom ?? 'Aucun rôle' }}
                    </p>

                </div>


                {{-- ROLE --}}
                <div>

                    <label
                        for="role_id"
                        class="block text-sm font-semibold text-stone-900"
                    >
                        Nouveau rôle
                    </label>

                    <p class="mt-1 text-sm text-stone-500">
                        Sélectionnez le rôle que vous souhaitez attribuer à cet utilisateur.
                    </p>


                    <select
                        id="role_id"
                        name="role_id"
                        required
                        class="mt-3 block w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                    >

                        @foreach ($roles as $role)

                            <option
                                value="{{ $role->id_role }}"
                                @selected($user->role_id == $role->id_role)
                            >
                                {{ $role->nom }}
                            </option>

                        @endforeach

                    </select>

                    @error('role_id')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- ACTIONS --}}
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                    >
                        Enregistrer le rôle
                    </button>

                </div>

            </form>

        </div>

    </section>

</div>

@endsection