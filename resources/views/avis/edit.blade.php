@extends('layouts.app')

@section('title', 'Modifier mon avis - Atlas Stay')

@section('content')

<section class="min-h-[calc(100vh-80px)] bg-stone-50">

    {{-- Header --}}
    <div class="border-b border-stone-200 bg-white">

        <div class="mx-auto max-w-3xl px-6 py-12">

            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-stone-400">
                Atlas Stay
            </p>

            <h1 class="mt-3 text-4xl font-semibold tracking-tight text-stone-950 sm:text-5xl">
                Modifier mon avis
            </h1>

            <p class="mt-4 max-w-xl text-sm leading-6 text-stone-500">
                Modifiez votre expérience et votre évaluation de cet hébergement.
            </p>

        </div>

    </div>


    {{-- Form --}}
    <div class="mx-auto max-w-3xl px-6 py-14">

        <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-white shadow-[0_20px_60px_rgba(0,0,0,0.06)]">

            <div class="px-7 py-8 sm:px-10">

                {{-- Hotel --}}
                <div class="border-b border-stone-100 pb-7">

                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-400">
                        Hébergement
                    </p>

                    <h2 class="mt-2 text-2xl font-semibold tracking-tight text-stone-900">
                        {{ $avis->hotel->nom }}
                    </h2>

                    <p class="mt-2 text-sm text-stone-500">
                        {{ $avis->hotel->adresse }}, {{ $avis->hotel->ville }}
                    </p>

                </div>


                {{-- Errors --}}
                @if ($errors->any())

                    <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                        @foreach ($errors->all() as $error)

                            <p class="text-sm text-red-700">
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                @endif


                {{-- Form --}}
                <form
                    action="{{ route('avis.update', $avis->id_avis) }}"
                    method="POST"
                    class="mt-8 space-y-6"
                >

                    @csrf

                    @method('PUT')


                    {{-- Note --}}
                    <div>

                        <label
                            for="note"
                            class="mb-2 block text-sm font-semibold text-stone-700"
                        >
                            Votre note
                        </label>

                        <select
                            id="note"
                            name="note"
                            required
                            class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >

                            <option value="5" {{ old('note', $avis->note) == 5 ? 'selected' : '' }}>
                                ★★★★★ — Excellent
                            </option>

                            <option value="4" {{ old('note', $avis->note) == 4 ? 'selected' : '' }}>
                                ★★★★☆ — Très bien
                            </option>

                            <option value="3" {{ old('note', $avis->note) == 3 ? 'selected' : '' }}>
                                ★★★☆☆ — Bien
                            </option>

                            <option value="2" {{ old('note', $avis->note) == 2 ? 'selected' : '' }}>
                                ★★☆☆☆ — Moyen
                            </option>

                            <option value="1" {{ old('note', $avis->note) == 1 ? 'selected' : '' }}>
                                ★☆☆☆☆ — Décevant
                            </option>

                        </select>

                    </div>


                    {{-- Commentaire --}}
                    <div>

                        <label
                            for="commentaire"
                            class="mb-2 block text-sm font-semibold text-stone-700"
                        >
                            Votre commentaire
                        </label>

                        <textarea
                            id="commentaire"
                            name="commentaire"
                            rows="6"
                            placeholder="Partagez votre expérience..."
                            class="w-full resize-none rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 outline-none transition placeholder:text-stone-400 focus:border-stone-900 focus:ring-2 focus:ring-stone-900/10"
                        >{{ old('commentaire', $avis->commentaire) }}</textarea>

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col gap-3 border-t border-stone-100 pt-7 sm:flex-row">

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-stone-700"
                        >
                            Enregistrer les modifications
                        </button>

                        <a
                            href="{{ route('hotels.show', $avis->hotel_id) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                        >
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

            <div class="h-1 bg-stone-900"></div>

        </div>

    </div>

</section>

@endsection