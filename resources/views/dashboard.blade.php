<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Church;

class DashboardController extends Controller
{
    /**
     * Show the unified dashboard for Admins, Pastors, and Members.
     */
    public function index()
    {
        $user = Auth::user();
        $churchId = session('current_church_id');

        // 🚫 No church selected → redirect to selection page
        if (!$churchId) {
            return redirect()->route('select-church')
                ->with('error', '🚫 Please select a church first.');
        }

        // 🔎 Ensure the user belongs to this church
        $church = null;

        if ($user->role === 'member') {
            // Members only belong to ONE church (via church_id)
            if ($user->church_id != $churchId) {
                return redirect()->route('select-church')
                    ->with('error', '🚫 Unauthorized church access.');
            }
            $church = $user->church;
        } else {
            // Admin/Pastor/Assistant → check via pivot
            $church = $user->churches()->find($churchId);
            if (!$church) {
                return redirect()->route('select-church')
                    ->with('error', '🚫 You are not assigned to this church.');
            }
        }

        // Example: role-specific dashboard data
        $stats = [];
        if ($user->isAdminOrPastor($church)) {
            $stats = [
                'members_count' => $church->members()->count(),
                'events_count'  => $church->events()->count(),
                'donations_sum' => $church->donations()->sum('amount'),
            ];
        }

        return view('dashboard.index', [
            'user'   => $user,
            'church' => $church,
            'stats'  => $stats,
        ]);
    }
}
=======
{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: false, userMenuOpen: false }" class="min-h-screen bg-gray-50 text-gray-900">

    {{-- Top Header --}}
    <header class="sticky top-0 z-30 bg-white/80 backdrop-blur border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Left: Brand + Mobile Sidebar Toggle --}}
                <div class="flex items-center gap-3">
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl border hover:bg-gray-100 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black sm:hidden"
                        aria-label="Toggle sidebar"
                    >
                        {{-- menu icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                        </svg>
                    </button>

                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-ghana-gradient"></div>
                        <span class="text-lg font-extrabold bg-ghana-gradient bg-clip-text text-transparent tracking-tight">
                            Anidaso CMS
                        </span>
                    </a>
                </div>

                {{-- Center: Context Title --}}
                <div class="hidden sm:block">
                    <h1 class="text-xl font-bold bg-ghana-gradient bg-clip-text text-transparent">
                        @if($church)
                            {{ $church->name }} Dashboard
                        @else
                            Global Dashboard
                        @endif
                    </h1>
                </div>

                {{-- Right: User Menu --}}
                <div class="relative">
                    <button
                        @click="userMenuOpen = !userMenuOpen"
                        class="flex items-center gap-3 rounded-xl border px-3 py-2 bg-white hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                        aria-haspopup="true" :aria-expanded="userMenuOpen"
                    >
                        <div class="w-8 h-8 rounded-full bg-ghana-gradient"></div>
                        <div class="hidden sm:block text-left">
                            <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        x-cloak
                        x-show="userMenuOpen"
                        @click.outside="userMenuOpen = false"
                        x-transition
                        class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border p-2"
                        role="menu"
                    >
                        <a href="{{ route('members.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50" role="menuitem">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 11c1.657 0 3-1.79 3-4s-1.343-4-3-4-3 1.79-3 4 1.343 4 3 4zM8 11c1.657 0 3-1.79 3-4S9.657 3 8 3 5 4.79 5 7s1.343 4 3 4zM8 13c-2.761 0-8 1.387-8 4.148V20h10.09A6.507 6.507 0 018 17c0-.714.111-1.403.317-2.053C7.15 14.322 5.406 13 8 13zm8 0c-3.314 0-6 1.79-6 4v3h12v-3c0-2.21-2.686-4-6-4z"/>
                            </svg>
                            <span>Members</span>
                        </a>
                        <a href="{{ route('events.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50" role="menuitem">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v3H2V6a2 2 0 012-2h1V3a1 1 0 112 0v1zM2 10h20v8a2 2 0 01-2 2H4a2 2 0 01-2-2v-8zm5 3a1 1 0 000 2h2a1 1 0 100-2H7z"/>
                            </svg>
                            <span>Events</span>
                        </a>
                        <a href="{{ route('donations.all') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50" role="menuitem">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 6h18v12H3zM5 8v8h14V8H5zm2 2h3v4H7v-4z"/>
                            </svg>
                            <span>Donations</span>
                        </a>
                        <div class="my-1 border-t"></div>
                        <form method="POST" action="{{ route('logout') }}" class="px-2">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 text-ghRed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 3h-8a2 2 0 00-2 2v4h2V5h8v14h-8v-4h-2v4a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2z"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ghana ribbon under header --}}
        <div class="h-1 w-full bg-ghana-gradient"></div>
    </header>

    {{-- Shell: Sidebar + Main --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 grid grid-cols-1 lg:grid-cols-[260px,1fr] gap-6">

        {{-- Sidebar (desktop) / Drawer (mobile) --}}
        <aside class="lg:sticky lg:top-20">
            {{-- Desktop sidebar --}}
            <nav class="hidden lg:block bg-white rounded-2xl shadow border overflow-hidden">
                <div class="bg-ghana-gradient h-2"></div>

                <ul class="p-3 space-y-1">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l10 9h-3v9H5v-9H2z"/></svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('members.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0v1H5v-1z"/></svg>
                            <span>Members</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h2v2h6V2h2v2h3v18H4V4h3V2zm13 8H6v10h14V10z"/></svg>
                            <span>Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/></svg>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('donations.all') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 6H3v12h18V6zM5 8h14v8H5V8zm3 2h3v4H8v-4z"/></svg>
                            <span>Donations</span>
                        </a>
                    </li>
                </ul>

                <div class="mt-2 p-3 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl border text-ghRed hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 3h-8a2 2 0 00-2 2v4h2V5h8v14h-8v-4h-2v4a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>

            {{-- Mobile drawer --}}
            <div class="lg:hidden fixed inset-0 z-40" x-cloak x-show="sidebarOpen" x-transition.opacity @keydown.escape.window="sidebarOpen = false">
                <div @click="sidebarOpen = false" class="absolute inset-0 bg-black/40"></div>
                <nav x-show="sidebarOpen" x-transition class="absolute left-0 top-0 h-full w-72 bg-white shadow-2xl border-r p-4" aria-label="Sidebar">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-bold">Menu</span>
                        <button @click="sidebarOpen = false" class="w-9 h-9 inline-flex items-center justify-center rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <ul class="space-y-1">
                        <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l10 9h-3v9H5v-9H2z"/></svg><span>Dashboard</span></a></li>
                        <li><a href="{{ route('members.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0v1H5v-1z"/></svg><span>Members</span></a></li>
                        <li><a href="{{ route('events.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h2v2h6V2h2v2h3v18H4V4h3V2zm13 8H6v10h14V10z"/></svg><span>Events</span></a></li>
                        <li><a href="{{ route('services.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/></svg><span>Services</span></a></li>
                        <li><a href="{{ route('donations.all') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 6H3v12h18V6zM5 8h14v8H5V8zm3 2h3v4H8v-4z"/></svg><span>Donations</span></a></li>
                    </ul>

                    <form method="POST" action="{{ route('logout') }}" class="mt-6">
                        @csrf
                        <button class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg border text-ghRed hover:bg-gray-50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 3h-8a2 2 0 00-2 2v4h2V5h8v14h-8v-4h-2v4a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <main>
            {{-- Stats --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow p-5 border-t-4 border-ghGold">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold">Donations</h3>
                        <svg class="w-5 h-5 text-ghGold" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l9 4-9 4-9-4 9-4zm9 7l-9 4-9-4v7l9 4 9-4v-7z"/></svg>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-ghGold">{{ $donationsCount }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-5 border-t-4 border-ghGreen">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold">Members</h3>
                        <svg class="w-5 h-5 text-ghGreen" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0v1H5v-1z"/></svg>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-ghGreen">{{ $membersCount }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-5 border-t-4 border-ghRed">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold">Events</h3>
                        <svg class="w-5 h-5 text-ghRed" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h2v2h6V2h2v2h3v18H4V4h3V2zm13 8H6v10h14V10z"/></svg>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-ghRed">{{ $eventsCount }}</p>
                </div>
            </section>

            {{-- Churches list --}}
            <section class="bg-white rounded-2xl shadow p-6 border-t-4 border-ghGold mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">Your Churches</h2>
                    <a href="{{ route('members.index') }}" class="text-sm text-ghRed hover:text-ghGold">Manage Members</a>
                </div>

                @if(isset($churches) && $churches->count())
                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($churches as $c)
                            <li class="border rounded-xl p-4 hover:shadow transition">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-semibold">{{ $c->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $c->location ?? 'Location not set' }}</p>
                                    </div>
                                    <a href="{{ route('churches.members.index', $c) }}" class="text-xs px-2 py-1 rounded bg-ghana-gradient text-white">
                                        Open
                                    </a>
                                </div>
                                <div class="mt-3 flex gap-3 text-sm">
                                    <a href="{{ route('churches.events.index', $c) }}" class="hover:text-ghGold">Events</a>
                                    <a href="{{ route('churches.members.index', $c) }}" class="hover:text-ghGold">Members</a>
                                    <a href="{{ route('churches.donations.index', $c) }}" class="hover:text-ghGold">Donations</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No churches linked to your account yet.</p>
                @endif
            </section>

            {{-- Recent Donations --}}
            <section class="bg-white rounded-2xl shadow p-6 border-t-4 border-ghGold">
                <h2 class="text-lg font-semibold mb-4">Recent Donations</h2>

                @if($recentDonations->isEmpty())
                    <p class="text-gray-500">No donations yet.</p>
                @else
                    <div class="overflow-x-auto -mx-2 sm:mx-0">
                        <table class="min-w-full border-collapse">
                            <thead>
                                <tr class="bg-ghana-gradient bg-opacity-20 text-ghBlack">
                                    <th class="p-3 border text-left">Donor</th>
                                    <th class="p-3 border text-left">Amount</th>
                                    <th class="p-3 border text-left">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentDonations as $donation)
                                    <tr class="hover:bg-ghana-gradient hover:bg-opacity-10">
                                        <td class="p-3 border">{{ $donation->donor_name ?? 'Anonymous' }}</td>
                                        <td class="p-3 border">₵{{ number_format($donation->amount, 2) }}</td>
                                        <td class="p-3 border">{{ $donation->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            {{-- Quick Links --}}
            <section class="mt-6 bg-gray-50 rounded-2xl shadow border p-6">
                <h2 class="text-md font-semibold mb-2">Quick Links</h2>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <li><a href="{{ route('events.index') }}" class="block px-4 py-3 rounded-xl border hover:bg-white hover:shadow transition">All Events</a></li>
                    <li><a href="{{ route('members.index') }}" class="block px-4 py-3 rounded-xl border hover:bg-white hover:shadow transition">All Members</a></li>
                    <li><a href="{{ route('donations.all') }}" class="block px-4 py-3 rounded-xl border hover:bg-white hover:shadow transition">All Donations</a></li>
                </ul>
            </section>
        </main>
    </div>
</div>
@endsection
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
