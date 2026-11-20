<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JewelERP — Complete Jewellery Shop Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f6f3ee] text-slate-800 antialiased">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="no-print w-64 bg-[#14110e] text-slate-200 flex-shrink-0 flex flex-col border-r border-[#2a231c]">
        <div class="px-4 py-4 border-b border-[#2a231c] flex items-center gap-3">
            <img
                src="{{ asset('logo.jpeg') }}"
                alt="RoyalTech Innovation"
                class="w-11 h-11 rounded-lg object-cover shadow-md ring-1 ring-[#d4af37]/40 flex-shrink-0"
            >
            <div class="min-w-0">
                <div class="font-bold text-white tracking-tight truncate" title="{{ $businessName }}">{{ $businessName }}</div>
                <div class="text-[11px] text-[#d4af37] uppercase tracking-wider truncate" title="{{ $businessTagline }}">{{ $businessTagline }}</div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-5 text-sm">
            <div>
                <div class="px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-wider text-[#9a8770]">Overview</div>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>📊</span> Dashboard & Analytics
                </a>
                <a href="{{ route('rates.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('rates.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🪙</span> Metal Rates
                </a>
            </div>

            <div>
                <div class="px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-wider text-[#9a8770]">Billing & Exchange</div>
                <a href="{{ route('pos.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('pos.index') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🧾</span> Jewellery POS
                </a>
                <a href="{{ route('pos.invoices') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('pos.invoices', 'pos.invoice') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>↩️</span> Invoices & Returns
                </a>
                <a href="{{ route('old_gold.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('old_gold.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>⚖️</span> Old Gold Exchange
                </a>
            </div>

            <div>
                <div class="px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-wider text-[#9a8770]">Catalog & Vault</div>
                <a href="{{ route('products.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('products.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>💍</span> Product Master
                </a>
                <a href="{{ route('inventory.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('inventory.index') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>📦</span> Inventory & Stock
                </a>
                <a href="{{ route('inventory.labels') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('inventory.labels') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🏷️</span> Barcode & Tags
                </a>
                <a href="{{ route('stones.hallmark') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('stones.hallmark') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>💎</span> Diamonds & HUID
                </a>
            </div>

            <div>
                <div class="px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-wider text-[#9a8770]">Operations</div>
                <a href="{{ route('crm.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('crm.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>👥</span> CRM, Loyalty & Ads
                </a>
                <a href="{{ route('schemes.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('schemes.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🏦</span> Gold Savings Schemes
                </a>
                <a href="{{ route('workshop.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('workshop.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🛠️</span> Karigar, Custom & Repair
                </a>
                <a href="{{ route('purchases.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('purchases.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🚚</span> Suppliers & Purchases
                </a>
            </div>

            <div>
                <div class="px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-wider text-[#9a8770]">Finance & Admin</div>
                <a href="{{ route('finance.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('finance.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>📒</span> Accounts & Finance
                </a>
                <a href="{{ route('admin.staff') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('admin.staff') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🪪</span> Staff & Attendance
                </a>
                <a href="{{ route('admin.branches') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('admin.branches') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🏢</span> Multi-Branch
                </a>
                <a href="{{ route('admin.security') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('admin.security') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>🔐</span> Approvals & Audit
                </a>
                <a href="{{ route('admin.reports') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('admin.reports') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>📈</span> BI Reports
                </a>
                <a href="{{ route('settings.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-[#d4af37]/15 text-[#f0d78c] font-medium' : 'text-slate-300 hover:bg-[#1f1a15] hover:text-white' }}">
                    <span>⚙️</span> Showroom Settings
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-[#2a231c] text-xs text-[#9a8770]">
            <div class="font-medium text-slate-100">{{ auth()->user()->name }}</div>
            <div class="capitalize text-[#d4af37]/80">{{ auth()->user()->role }} · {{ auth()->user()->branch->code ?? 'HQ' }}</div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Header -->
        <header class="no-print bg-white/95 border-b border-[#e8dfd0] px-6 py-3 flex items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-3 min-w-0">
                <img
                    src="{{ asset('logo.jpeg') }}"
                    alt="RoyalTech Innovation"
                    class="w-8 h-8 rounded-md object-cover ring-1 ring-[#d4af37]/35 flex-shrink-0"
                >
                <h1 class="text-lg font-semibold text-[#1a2332]">@yield('header', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-4 text-xs">
                <div class="hidden md:flex items-center gap-3 bg-[#fff8e8] border border-[#e6d3a0] px-3 py-1.5 rounded-full text-[#7a5c14] font-medium">
                    <span>24K: ₹{{ number_format(\App\Models\MetalRate::latestRate('Gold', '24K'), 0) }}/g</span>
                    <span class="text-[#d4af37]">|</span>
                    <span>22K: ₹{{ number_format(\App\Models\MetalRate::latestRate('Gold', '22K'), 0) }}/g</span>
                    <span class="text-[#d4af37]">|</span>
                    <span>Silver: ₹{{ number_format(\App\Models\MetalRate::latestRate('Silver', '999'), 0) }}/g</span>
                </div>
                <a href="{{ route('pos.index') }}" class="bg-gradient-to-r from-[#d4af37] to-[#b8860b] hover:brightness-105 text-white px-3.5 py-1.5 rounded-lg font-semibold transition shadow-sm">+ New Bill</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-500 hover:text-[#1a2332] font-medium px-2 py-1">Logout</button>
                </form>
            </div>
        </header>

        <!-- Alerts -->
        <div class="px-6 pt-4 no-print">
            @if(session('success'))
                <div class="mb-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-lg text-sm flex justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-3 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-2.5 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Page Body -->
        <main class="flex-1 px-6 pb-4 pt-2">
            @yield('content')
        </main>

        <footer class="no-print mt-auto px-6 py-3 border-t border-[#e8dfd0] bg-white/80">
            <p class="flex items-center justify-center gap-1.5 text-[11px] text-slate-500 whitespace-nowrap">
                <span>Powered by</span>
                <img src="{{ asset('logo.jpeg') }}" alt="RoyalTech Innovation" class="w-4 h-4 rounded object-cover">
                <span class="font-semibold text-[#4f7ec8]">RoyalTech Innovation</span>
            </p>
        </footer>
    </div>
</div>
@stack('scripts')
</body>
</html>

