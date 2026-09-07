@extends('layouts.app')

@section('title', 'Notifications - Atlas Stay')

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
                    Notifications
                </h1>

                <p class="mt-4 text-base leading-7 text-stone-500">
                    Retrouvez ici les notifications liées à vos réservations et à vos hôtels.
                </p>

            </div>

        </div>

    </div>


    {{-- Content --}}
    <div class="mx-auto max-w-4xl px-6 py-10">

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


        {{-- Mark all as read --}}
        @if ($notifications->where('lu', false)->count())

            <div class="mb-6 flex justify-end">

                <form
                    action="{{ route('notifications.read-all') }}"
                    method="POST"
                >

                    @csrf

                    @method('PATCH')

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                    >
                        Tout marquer comme lu
                    </button>

                </form>

            </div>

        @endif


        @if ($notifications->count())

            <div class="space-y-4">

                @foreach ($notifications as $notification)

                    <article
                        class="rounded-2xl border p-5 transition
                        {{
                            $notification->lu
                                ? 'border-stone-200 bg-white'
                                : 'border-amber-200 bg-amber-50'
                        }}"
                    >

                        <div class="flex items-start gap-4">


                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full
                                {{
                                    $notification->lu
                                        ? 'bg-stone-100 text-stone-500'
                                        : 'bg-amber-100 text-amber-700'
                                }}"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 1 0-12 0v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                                    />

                                </svg>

                            </div>


                            {{-- Notification content --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">


                                    {{-- Title + message --}}
                                    <div>

                                        <h2 class="text-base font-semibold text-stone-950">
                                            {{ $notification->titre }}
                                        </h2>

                                        <p class="mt-1 text-sm leading-6 text-stone-600">
                                            {{ $notification->message }}
                                        </p>

                                    </div>


                                    {{-- Status --}}
                                    @if (!$notification->lu)

                                        <span
                                            class="inline-flex w-fit shrink-0 rounded-full border border-amber-200 bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700"
                                        >
                                            Non lue
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex w-fit shrink-0 rounded-full border border-stone-200 bg-stone-100 px-3 py-1 text-xs font-medium text-stone-500"
                                        >
                                            Lue
                                        </span>

                                    @endif

                                </div>


                                {{-- Date + action --}}
                                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">


                                    {{-- Date --}}
                                    <p class="text-xs text-stone-400">
                                        {{ $notification->created_at->format('d/m/Y à H:i') }}
                                    </p>


                                    {{-- Mark as read --}}
                                    @if (!$notification->lu)

                                        <form
                                            action="{{ route('notifications.read', $notification->id_notification) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-xl border border-stone-300 px-4 py-2 text-xs font-semibold text-stone-700 transition hover:bg-stone-100"
                                            >
                                                Marquer comme lue
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </article>

                @endforeach

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
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 1 0-12 0v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0"
                        />

                    </svg>

                </div>


                <h2 class="mt-6 text-2xl font-semibold text-stone-950">
                    Aucune notification
                </h2>


                <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-stone-500">
                    Vous n'avez actuellement aucune notification.
                </p>


                <a
                    href="{{ route('hotels.index') }}"
                    class="mt-7 inline-flex rounded-xl bg-stone-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-stone-700"
                >
                    Découvrir les hôtels
                </a>

            </div>

        @endif

    </div>

</section>

@endsection