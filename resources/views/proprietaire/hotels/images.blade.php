@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12">

    <div class="mx-auto max-w-6xl px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">
                    Espace propriétaire
                </p>

                <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900">
                    Images de l’hôtel
                </h1>

                <p class="mt-3 text-slate-600">
                    {{ $hotel->nom }}
                </p>

            </div>

            <a
                href="{{ route('proprietaire.hotels.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                ← Retour à mes hôtels
            </a>

        </div>


        {{-- Success --}}
        @if (session('success'))

            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                        ✓
                    </div>

                    <p class="text-sm font-medium text-emerald-800">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Errors --}}
        @if ($errors->any())

            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5">

                <ul class="space-y-1 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Ajouter une image --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="mb-6">

                <h2 class="text-xl font-bold text-slate-900">
                    Ajouter une image
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Ajoutez une photo de votre établissement.
                </p>

            </div>


            <form
                action="{{ route('proprietaire.hotels.images.store', $hotel->id_hotel) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="flex flex-col gap-4 md:flex-row md:items-end">

                    <div class="flex-1">

                        <label
                            for="image"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Image
                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 file:mr-4 file:border-0 file:bg-slate-900 file:px-5 file:py-3 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800"
                        >

                        <p class="mt-2 text-xs text-slate-500">
                            Formats acceptés : JPG, JPEG, PNG, WEBP — maximum 2 MB.
                        </p>

                    </div>


                    <button
                        type="submit"
                        class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                    >
                        Ajouter l’image
                    </button>

                </div>

            </form>

        </div>


        {{-- Galerie --}}
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="mb-8">

                <h2 class="text-xl font-bold text-slate-900">
                    Galerie
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $hotel->images->count() }} image(s) enregistrée(s).
                </p>

            </div>


            @if ($hotel->images->count())

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($hotel->images as $image)

                        <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">

                            <div class="relative h-64 overflow-hidden">

                                <img
                                    src="{{ asset('storage/' . $image->image) }}"
                                    alt="{{ $hotel->nom }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >

                            </div>


                            <div class="flex items-center justify-between p-4">

                                <p class="text-sm font-medium text-slate-600">
                                    Image #{{ $image->id_image }}
                                </p>

                                <form
                                    action="{{ route('proprietaire.images.destroy', $image->id_image) }}"
                                    method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                    >
                                        Supprimer
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white text-3xl shadow-sm">
                        📷
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-slate-900">
                        Aucune image
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Ajoutez la première photo de votre hôtel.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection