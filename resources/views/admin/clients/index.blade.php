@extends('layouts.app')

@section('title', 'Clients Management')

@section('content')
<div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900">
                <i class="fas fa-users text-blue-600 mr-3"></i>Clients
            </h1>
            <a href="{{ route('admin.clients.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <i class="fas fa-plus mr-2 -ml-1"></i>
                Add New Client
            </a>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-center">
                <div class="md:col-span-2 lg:col-span-3">
                    <input type="text" placeholder="Search clients by name, email, or ID..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                </div>
        
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-200">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                </div>
    </div>
</div>

        <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Client
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                Contact Info
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                                Appointments
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($clients as $client)
                        <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                        {{ substr($client->first_name, 0, 1) }}{{ substr($client->last_name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $client->first_name }} {{ $client->last_name }}</div>
                                        <div class="text-xs text-gray-500">ID: <span class="font-mono">{{ $client->id }}</span></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                <div class="text-sm text-gray-900">{{ $client->email }}</div>
                                <div class="text-xs text-gray-500">{{ $client->phone_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                @if($client->addresses->count() > 0)
                                    @php $address = $client->addresses->first(); @endphp
                                    <div class="text-sm text-gray-900">{{ $address->street_address }}</div>
                                    <div class="text-xs text-gray-500">{{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</div>
                                @else
                                    <span class="text-xs text-gray-400 italic">No address provided</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                <div class="text-sm text-gray-900">{{ $client->appointments->count() }} appointments</div>
                                <a href="{{ route('admin.clients.history', $client) }}" class="text-xs text-blue-600 hover:text-blue-800 transition-colors duration-200">View history</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end items-center space-x-2">
                                    <a href="{{ route('admin.clients.show', $client) }}" class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="View">
                                        <i class="fas fa-eye w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('admin.clients.edit', $client) }}" class="text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Edit">
                                        <i class="fas fa-edit w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Delete" onclick="return confirm('Are you sure you want to delete this client?')">
                                            <i class="fas fa-trash-alt w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500 italic">
                                No clients found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($clients->hasPages())
                <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection