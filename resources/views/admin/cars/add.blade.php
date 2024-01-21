<x-app-layout>
    @section('custom-css')
        <style>
            .ck-editor__editable {
                height: 120px;
            }
        </style>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Cars Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 w-full bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6">
                <x-ahref.primary-button href="{{ route('admin.cars') }}" class="btn btn-sm btn-secondary">
                    Back
                </x-ahref.primary-button>
            </div>
            <div class="container mx-auto">
                <form class="block w-full" method="POST" action="{{ route('admin.store.cars') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input-label for="brand" :value="__('Car Brand')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand"
                                :value="old('brand')" required autofocus autocomplete="brand" />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input-label for="model" :value="__('Car Model')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <x-text-input id="model" class="block mt-1 w-full" type="text" name="model"
                                :value="old('model')" required autofocus autocomplete="model" />
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input-label for="number_plate" :value="__('Number Plate')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <x-text-input id="number_plate" class="block mt-1 w-full" type="text" name="number_plate"
                                :value="old('number_plate')" required autofocus autocomplete="number_plate" />
                            <x-input-error :messages="$errors->get('number_plate')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-input-label for="price_per_day" :value="__('Price Per Day')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <x-text-input id="price_per_day" class="block mt-1 w-full" type="number"
                                name="price_per_day" :value="old('price_per_day')" required autofocus autocomplete="price_per_day"
                                min="0" />
                            <x-input-error :messages="$errors->get('price_per_day')" class="mt-2" />
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-input-label for="car_photo" :value="__('Car Photo')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <input type="file" name="car_photo"
                                class="file-input file-input-md file-input-bordered block mt-1 w-full"
                                :value="old('car_photo')" required autofocus autocomplete="car_photo" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG
                                or JPEG (MAX. 2MB).</p>
                            <x-input-error :messages="$errors->get('car_photo')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-input-label for="description" :value="__('Description')"
                                class="block tracking-wide text-gray-700 text-sm font-bold mb-2" />
                            <textarea id="editor" name="description" required autocomplete="description"
                                class="resize-none textarea-lg block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 
                                dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}
                            </textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-ahref.submit-button class="btn btn-md btn-square btn-success">Add</x-ahref.submit-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('custom-js')
        <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endsection
</x-app-layout>
