@extends('layouts.app')

@section('title', 'Donations')

@section('content')
<div class="container mx-auto p-4">

    {{-- Page Header --}}
    <h1 class="text-3xl font-bold mb-6 text-yellow-700">💰 Donations - {{ currentChurchName() }}</h1>

    {{-- Quick Actions + Search --}}
    <div class="flex flex-wrap justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <a href="{{ route('donations.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">
            ➕ Add Donation
        </a>

        <form method="GET" action="{{ route('donations.index') }}" class="flex space-x-2">
            <input type="text" name="search" placeholder="Search by donor or amount..."
                   value="{{ request('search') }}"
                   class="px-3 py-2 border rounded w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-yellow-600">
            <button type="submit" class="px-4 py-2 bg-yellow-600 text-black rounded hover:bg-yellow-700">
                Search
            </button>
        </form>
    </div>

    {{-- Donations Table --}}
    @if($donations->isEmpty())
        <p class="text-gray-600 mt-4">No donations recorded yet.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded-lg p-4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-yellow-600 text-black">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Donor</th>
                        <th class="p-2 border">Amount (GHS)</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr class="bg-white even:bg-gray-100 hover:bg-gray-50">
                            <td class="p-2 border">{{ $donation->id }}</td>
                            <td class="p-2 border">{{ $donation->donor_name ?? 'Anonymous' }}</td>
                            <td class="p-2 border">{{ number_format($donation->amount, 2) }}</td>
                            <td class="p-2 border space-x-2 flex flex-wrap">
                                <a href="{{ route('donations.show', $donation->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-400">
                                    View
                                </a>
                                <a href="{{ route('donations.edit', $donation->id) }}" class="px-2 py-1 bg-primary text-white rounded hover:bg-primary-dark">
                                    Edit
                                </a>
                                <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-400"
                                            onclick="return confirm('Delete this donation?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $donations->withQueryString()->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
