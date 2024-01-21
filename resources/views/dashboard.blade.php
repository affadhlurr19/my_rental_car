<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('customer.search.history') }}" class="mb-6">
                <div class="flex">
                    <select id="countries" name = "category"
                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">                        
                        <option value="start_date">Start Date</option>
                        <option value="end_date">End Date</option>
                        <option value="total_price">Total Price</option>
                        <option value="payment_status">Payment Status</option>
                        <option value="tracking_status">Tracking Status</option>
                    </select>
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" name="keyword"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Search Here...">
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <x-table-data>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Car Brand
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Car Model
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Number Plate
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                End Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Payment Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tracking Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $datas)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $datas->brand }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $datas->model }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $datas->number_plate }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $datas->start_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $datas->end_date }}
                                </td>
                                <td class="px-6 py-4">
                                    @currency($datas->total_price)
                                </td>
                                <td class="px-6 py-4">
                                    @if ($datas->payment_status == 'paid')
                                        <div class="badge badge-sm badge-success p-2">
                                            <p class="text-xs text-white">{{ $datas->payment_status }}</p>
                                        </div>
                                    @else
                                        <div class="badge badge-sm badge-error p-2">
                                            <p class="text-xs text-white">{{ $datas->payment_status }}</p>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($datas->tracking_status == 'waiting')
                                        <div class="badge badge-sm badge-neutral p-2">
                                            <p class="text-xs text-white">{{ $datas->tracking_status }}</p>
                                        </div>
                                    @elseif ($datas->tracking_status == 'ongoing')
                                        <div class="badge badge-sm badge-primary p-2">
                                            <p class="text-xs text-white">{{ $datas->tracking_status }}</p>
                                        </div>
                                    @else
                                        <div class="badge badge-sm badge-info p-2">
                                            <p class="text-xs text-white">{{ $datas->tracking_status }}</p>
                                        </div>
                                    @endif
                                </td>
                                {{-- <td class="px-6 py-4">
                                    @if ($datas->status == 'active')
                                        <div class="badge badge-sm badge-success p-2">
                                            <p class="text-xs text-white">Active</p>
                                        </div>
                                    @else
                                        <div class="badge badge-sm badge-error p-2">
                                            <p class="text-xs text-white">Inactive</p>
                                        </div>
                                    @endif
                                </td> --}}
                                <td class="px-4 py-4">
                                    @if ($datas->payment_status == 'unpaid')
                                        @if ($datas->admin_check == false)
                                            <form action="{{ url('/paid-rent/' . $datas->transaction_id) }}"
                                                method="POST">
                                                @csrf
                                                <x-ahref.submit-button data-confirm-delete="true"
                                                    class="btn btn-sm btn-accent">
                                                    Pay Now
                                                </x-ahref.submit-button>
                                            </form>
                                        @else
                                            <div class="text-center">-</div>
                                        @endif
                                    @else
                                        @if ($datas->payment_status == 'paid' && $datas->tracking_status == 'waiting')
                                            <form action="{{ url('/get-car/' . $datas->transaction_id) }}"
                                                method="POST">
                                                @csrf
                                                <x-ahref.submit-button data-confirm-delete="true"
                                                    class="btn btn-sm btn-warning">
                                                    Get Car
                                                </x-ahref.submit-button>
                                            </form>
                                        @elseif ($datas->payment_status == 'paid' && $datas->tracking_status == 'ongoing')
                                            @if ($datas->admin_check == false)
                                                <form action="{{ url('/return-car/' . $datas->transaction_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <x-ahref.submit-button data-confirm-delete="true"
                                                        class="btn btn-sm btn-secondary">
                                                        Return
                                                    </x-ahref.submit-button>
                                                </form>
                                            @else
                                                Validate Returning Car
                                            @endif
                                        @else
                                            <div class="badge badge-sm badge-success p-2">
                                                <p class="text-xs text-white">Done</p>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table-data>
            </div>
        </div>
    </div>
</x-app-layout>
