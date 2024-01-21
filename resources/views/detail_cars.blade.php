<x-app-layout>
    <div class="py-12">
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 w-full bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6">
                <x-ahref.primary-button href="{{ route('/') }}" class="btn btn-sm btn-secondary">
                    Back
                </x-ahref.primary-button>
            </div>
            <div class="container mx-auto">
                <form class="block w-full" method="POST" action="{{ route('add.customer.transaction') }}">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <img class="h-auto max-w-full rounded-md" src="{{ asset('image/' . $data->car_photo) }}">
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            {{-- Car  Model --}}
                            <div class="mb-4">
                                <x-input-label for="brand" :value="__('Car Brand')"
                                    class="ablock tracking-wide text-gry-700 text-sm font-black mb-1" />
                                <div class="text-justify text-sm">{!! $data->brand !!}</div>
                            </div>

                            {{-- Car Brand --}}
                            <div class="mb-4">
                                <x-input-label for="model" :value="__('Car Model')"
                                    class="ablock tracking-wide text-gry-700 text-sm font-black mb-1" />
                                <div class="text-justify text-sm">{!! $data->model !!}</div>
                            </div>

                            {{-- Number Plate --}}
                            <div class="mb-4">
                                <x-input-label for="number_plate" :value="__('Number Plate')"
                                    class="ablock tracking-wide text-gry-700 text-sm font-black mb-1" />
                                <div class="text-justify text-sm">{!! $data->number_plate !!}</div>
                            </div>

                            {{-- Description --}}
                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')"
                                    class="ablock tracking-wide text-gry-700 text-sm font-black mb-1" />
                                <div class="text-justify text-sm">{!! $data->description !!}</div>
                            </div>

                            {{-- Price Per Day --}}
                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Price Per Day')"
                                    class="ablock tracking-wide text-gry-700 text-sm font-black mb-1" />
                                <div class="text-justify text-sm">@currency($data->price_per_day)</div>
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-input-label for="description" :value="__('Rental Period')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/2 mr-2">
                                    <input
                                        class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="inline-full-name" type="date" name="start_date">
                                </div>
                                <div class="md:w-1/2">
                                    <input
                                        class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="inline-full-name" type="date" name="end_date">
                                </div>
                            </div>
                        </div>

                        {{-- send data --}}
                        <input type="text" name="cars_id" value="{{ $data->cars_id }}" hidden>
                        <input type="text" name="price_per_day" value="{{ $data->price_per_day }}" hidden>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-ahref.submit-button
                                class="btn btn-md btn-square btn-primary">Rent</x-ahref.submit-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
