<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Data') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('admin.search.customer') }}" class="mb-6">
                <div class="flex">                    
                    <select id="countries" name = "category"
                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">                        
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="address">Address</option>                        
                        <option value="phone">Phone</option> 
                        <option value="driver_license_num">Driver License Number</option>         
                        <option value="status">Status</option>                        
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
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Driver License Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
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
                                    {{ $datas->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $datas->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $datas->address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $datas->phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $datas->driver_lincense_num }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($datas->status == 'active')
                                        <div class="badge badge-sm badge-success p-2">
                                            <p class="text-xs text-white">Active</p>
                                        </div>
                                    @else
                                        <div class="badge badge-sm badge-error p-2">
                                            <p class="text-xs text-white">Inactive</p>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-4">                                    
                                    <x-ahref.primary-button data-confirm-delete="true"
                                        href="{{ url('/admin/customer-data/delete/' . $datas->id) }}"
                                        class="btn btn-sm btn-accent">
                                        Delete
                                    </x-ahref.primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table-data>                                
            </div>
        </div>
    </div>
</x-app-layout>
