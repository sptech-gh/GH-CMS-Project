@extends('layouts.app')

@section('title', 'All Donations')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">All Donations</h1>

    @if($donations->count())
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="px-4 py-2 border-b">#</th>
                        <th class="px-4 py-2 border-b">Church</th>
                        <th class="px-4 py-2 border-b">Member</th>
                        <th class="px-4 py-2 border-b">Amount</th>
                        <th class="px-4 py-2 border-b">Note</th>
                        <th class="px-4 py-2 border-b">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $donation->id }}</td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('donations.index', $donation->church->slug) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $donation->church->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2 border-b">
                                {{ $donation->member?->name ?? 'Anonymous' }}
                            </td>
                            <td class="px-4 py-2 border-b">₵{{ number_format($donation->amount, 2) }}</td>
                            <td class="px-4 py-2 border-b">{{ $donation->note ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $donation->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $donations->links() }}
        </div>
    @else
        <p class="text-gray-600">No donations have been recorded yet.</p>
    @endif
</div>
@endsection
