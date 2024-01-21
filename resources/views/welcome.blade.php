<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-3 mb-4">
                @foreach ($data as $datas)
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-6">
                        <div class="card w-96 bg-base-100 shadow-xl ">
                            <img class="h-full max-h-52 rounded-t-xl" src="{{ asset('image/' . $datas->car_photo) }}"
                                alt="Shoes" />
                            <div class="card-body">
                                <h2 class="card-title">
                                    <div class="font-bold">{{ $datas->brand }}</div>
                                    <div class="font-thin">{{ $datas->model }}</div>
                                </h2>
                                <div class="uppercase text-sm">{{ $datas->number_plate }}</div>
                                <p class="font-bold">@currency($datas->price_per_day) / Day</p>
                                <div class="card-actions justify-end">
                                    <x-ahref.primary-button href="{{ route('detail.cars', $datas->cars_id) }}" class="btn btn-md btn-primary"> Rent Now
                                    </x-ahref.primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
