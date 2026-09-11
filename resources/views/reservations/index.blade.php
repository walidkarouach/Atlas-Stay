@extends('layouts.app')

@section('title', 'Mes réservations - Atlas Stay')

@section('content')

<section class="min-h-screen bg-stone-50">

    {{-- Header --}}
    <div class="border-b border-stone-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12">

            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">
                    Atlas Stay
                </p>

                <h1 class="mt-3 text-4xl font-semibold tracking-tight text-stone-950 sm:text-5xl">
                    Mes réservations
                </h1>

                <p class="mt-4 text-base leading-7 text-stone-500">
                    Retrouvez ici l’ensemble de vos réservations et leur statut.
                </p>
            </div>

        </div>
    </div>


    {{-- Content --}}
    <div class="mx-auto max-w-7xl px-6 py-10">

        {{-- Success message --}}
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Error messages --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif


        @if ($reservations->count())

            <div class="space-y-6">

                @foreach ($reservations as $reservation)

                    <article
                        class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition hover:shadow-md"
                    >

                        <div class="grid lg:grid-cols-[280px_1fr]">

                            {{-- Image --}}
                            <div class="h-64 bg-stone-100 lg:h-full">

                                @if ($reservation->hotel && $reservation->hotel->images->first())

                                    <img
                                        src="{{ asset('storage/' . $reservation->hotel->images->first()->image) }}"
                                        alt="{{ $reservation->hotel->nom }}"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    <div class="flex h-full items-center justify-center text-sm text-stone-400">
                                        Aucune image
                                    </div>

                                @endif

                            </div>


                            {{-- Reservation information --}}
                            <div class="p-6 sm:p-8">

                                {{-- Top --}}
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-stone-400">
                                            Réservation #{{ $reservation->id_reservation }}
                                        </p>

                                        @if ($reservation->hotel)

                                            <h2 class="mt-2 text-2xl font-semibold text-stone-950">
                                                {{ $reservation->hotel->nom }}
                                            </h2>

                                            <p class="mt-1 text-sm text-stone-500">
                                                {{ $reservation->hotel->ville }}

                                                @if ($reservation->hotel->adresse)
                                                    · {{ $reservation->hotel->adresse }}
                                                @endif
                                            </p>

                                        @endif

                                    </div>


                                    {{-- Status --}}
                                    @php
                                        $statusClasses = match ($reservation->statut) {
                                            'confirmee' => 'bg-green-50 text-green-700 border-green-200',
                                            'refusee' => 'bg-red-50 text-red-700 border-red-200',
                                            'annulee' => 'bg-stone-100 text-stone-600 border-stone-200',
                                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                                        };

                                        $statusLabel = match ($reservation->statut) {
                                            'confirmee' => 'Confirmée',
                                            'refusee' => 'Refusée',
                                            'annulee' => 'Annulée',
                                            default => 'En attente',
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex w-fit items-center rounded-full border px-4 py-2 text-xs font-semibold {{ $statusClasses }}"
                                    >
                                        {{ $statusLabel }}
                                    </span>

                                </div>


                                {{-- Details --}}
                                <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-stone-400">
                                            Arrivée
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-stone-900">
                                            {{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-stone-400">
                                            Départ
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-stone-900">
                                            {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-stone-400">
                                            Voyageurs
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-stone-900">
                                            {{ $reservation->nb_personnes }}
                                            {{ $reservation->nb_personnes > 1 ? 'personnes' : 'personne' }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-stone-400">
                                            Montant total
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-stone-900">
                                            {{ number_format($reservation->montant_total, 2, ',', ' ') }}
                                            DH
                                        </p>
                                    </div>

                                </div>


                                {{-- Actions --}}
                                <div class="mt-8 flex flex-col gap-3 border-t border-stone-100 pt-6 sm:flex-row sm:items-center">

                                    @if ($reservation->hotel)

                                        <a
                                            href="{{ route('hotels.show', $reservation->hotel->id_hotel) }}"
                                            class="inline-flex cursor-pointer items-center justify-center rounded-xl border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
                                        >
                                            Voir l'hôtel
                                        </a>

                                    @endif


                                    {{-- Cancel --}}
                                    @if (in_array($reservation->statut, ['en_attente', 'confirmee']))

                                        <form
                                            id="cancel-form-{{ $reservation->id_reservation }}"
                                            action="{{ route('reservations.cancel', $reservation->id_reservation) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="button"
                                                onclick="openCancelModal({{ $reservation->id_reservation }})"
                                                class="inline-flex w-full cursor-pointer items-center justify-center rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-700 sm:w-auto"
                                            >
                                                Annuler
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- Pagination --}}
            <div class="mt-10">
                {{ $reservations->links() }}
            </div>


        @else

            {{-- Empty state --}}
            <div class="rounded-3xl border border-dashed border-stone-300 bg-white px-6 py-20 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-7 w-7 text-stone-500"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 6.75h7.5M8.25 10.5h7.5m-7.5 3.75h4.5M6.75 3.75h10.5A2.25 2.25 0 0 1 19.5 6v12a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 18V6a2.25 2.25 0 0 1 2.25-2.25Z"
                        />
                    </svg>

                </div>


                <h2 class="mt-6 text-2xl font-semibold text-stone-950">
                    Aucune réservation
                </h2>


                <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-stone-500">
                    Vous n'avez encore effectué aucune réservation.
                    Découvrez nos hôtels et trouvez votre prochaine escapade.
                </p>


                <a
                    href="{{ route('hotels.index') }}"
                    class="mt-7 inline-flex cursor-pointer rounded-xl bg-stone-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                >
                    Découvrir les hôtels
                </a>

            </div>

        @endif

    </div>

</section>


{{-- ========================================================= --}}
{{-- MODAL CONFIRMATION ANNULATION --}}
{{-- ========================================================= --}}

<div
    id="cancelModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-stone-950/50 px-4 backdrop-blur-sm"
>

    <div
        id="cancelModalContent"
        class="w-full max-w-md scale-95 rounded-3xl border border-stone-200 bg-white p-6 opacity-0 shadow-2xl transition-all duration-200 sm:p-8"
    >

        {{-- Icon --}}
        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-stone-100">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.7"
                stroke="currentColor"
                class="h-7 w-7 text-stone-700"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m0 3.75h.007v.008H12V16.5Zm9-4.5a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>

        </div>


        {{-- Title --}}
        <h2 class="mt-5 text-2xl font-semibold tracking-tight text-stone-950">
            Annuler la réservation ?
        </h2>


        {{-- Message --}}
        <p class="mt-3 text-sm leading-6 text-stone-500">
            Voulez-vous vraiment annuler cette réservation ?
            Cette action modifiera le statut de votre réservation.
        </p>


        {{-- Buttons --}}
        <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <button
                type="button"
                onclick="closeCancelModal()"
                class="inline-flex cursor-pointer items-center justify-center rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:bg-stone-100"
            >
                Retour
            </button>


            <button
                id="confirmCancelButton"
                type="button"
                onclick="submitCancelForm()"
                class="inline-flex cursor-pointer items-center justify-center rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
            >
                Oui, annuler
            </button>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT MODAL --}}
{{-- ========================================================= --}}

<script>

    let selectedReservationId = null;


    function openCancelModal(reservationId) {

        selectedReservationId = reservationId;

        const modal = document.getElementById('cancelModal');
        const modalContent = document.getElementById('cancelModalContent');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(() => {

            modalContent.classList.remove('scale-95', 'opacity-0');

            modalContent.classList.add(
                'scale-100',
                'opacity-100'
            );

        });
    }


    function closeCancelModal() {

        const modal = document.getElementById('cancelModal');
        const modalContent = document.getElementById('cancelModalContent');

        modalContent.classList.remove(
            'scale-100',
            'opacity-100'
        );

        modalContent.classList.add(
            'scale-95',
            'opacity-0'
        );

        setTimeout(() => {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

            selectedReservationId = null;

        }, 200);
    }


    function submitCancelForm() {

        if (!selectedReservationId) {
            return;
        }

        const form = document.getElementById(
            'cancel-form-' + selectedReservationId
        );

        if (form) {
            form.submit();
        }
    }


    // Fermer en cliquant sur le fond
    document
        .getElementById('cancelModal')
        .addEventListener('click', function (event) {

            if (event.target === this) {
                closeCancelModal();
            }

        });


    // Fermer avec Escape
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            const modal = document.getElementById('cancelModal');

            if (!modal.classList.contains('hidden')) {
                closeCancelModal();
            }

        }

    });

</script>

@endsection