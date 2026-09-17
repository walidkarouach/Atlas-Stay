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


            {{-- Retour --}}
            <a
                href="{{ route('proprietaire.hotels.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 19l-7-7m0 0l7-7m-7 7h20"
                    />
                </svg>

                Retour à mes hôtels

            </a>

        </div>


        {{-- Success --}}
        @if (session('success'))

            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

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

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.6l-8 14A2 2 0 0 0 4 20.6h16a2 2 0 0 0 1.7-3l-8-14a2 2 0 0 0-3.4 0z"
                            />
                        </svg>

                    </div>


                    <ul class="space-y-1 text-sm text-red-700">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        {{-- Ajouter une image --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="mb-6 flex items-start gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                            ry="2"
                        />

                        <circle
                            cx="8.5"
                            cy="10"
                            r="1.5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 16l5-5 4 4 3-3 6 5"
                        />
                    </svg>

                </div>


                <div>

                    <h2 class="text-xl font-bold text-slate-900">
                        Ajouter une image
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ajoutez une photo de votre établissement.
                    </p>

                </div>

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


                    {{-- Bouton ajouter --}}
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        Ajouter l’image

                    </button>

                </div>

            </form>

        </div>


        {{-- Galerie --}}
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="mb-8 flex items-start gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                            ry="2"
                        />

                        <circle
                            cx="8.5"
                            cy="10"
                            r="1.5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 16l5-5 4 4 3-3 6 5"
                        />
                    </svg>

                </div>


                <div>

                    <h2 class="text-xl font-bold text-slate-900">
                        Galerie
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $hotel->images->count() }} image(s) enregistrée(s).
                    </p>

                </div>

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


                            <div class="flex items-center justify-between gap-3 p-4">

                                <p class="text-sm font-medium text-slate-600">
                                    Image #{{ $image->id_image }}
                                </p>


                                {{-- Supprimer --}}
                                <form
                                    action="{{ route('proprietaire.images.destroy', $image->id_image) }}"
                                    method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                        title="Supprimer cette image"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor"
                                            class="h-4 w-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 6h18"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5"
                                            />
                                        </svg>

                                        Supprimer

                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- Empty state --}}
                <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white text-slate-500 shadow-sm">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.6"
                            stroke="currentColor"
                            class="h-8 w-8"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                                ry="2"
                            />

                            <circle
                                cx="8.5"
                                cy="10"
                                r="1.5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 16l5-5 4 4 3-3 6 5"
                            />
                        </svg>

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