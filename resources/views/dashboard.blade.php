@extends('layouts.app')

@section('header', 'Executive Dashboard & Business Analytics')

@section('content')
<div class="space-y-6">
    <!-- Branch Filter -->
    <div class="flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex items-center gap-2">
            <select name="branch_id" onchange="this.form.submit()" class="border border-slate-300 rounded-lg px-3 py-1.5 text-sm bg-white">
                <option value="">All Branches (Consolidated)</option>
                @foreach($branches as $b)
                    <option value="{{ $b->id }}" {{ $branchId == $b->id ? 'selected' : '' }}>{{ $b->name }} ({{ $b->code }})</option>
                @endforeach
            </select>
        </form>
        <div class="flex items-center gap-2 text-xs">
            @if($pendingApprovals > 0)
                <a href="{{ route('admin.security') }}" class="bg-amber-100 text-amber-800 px-3 py-1.5 rounded-full font-medium">
                    ⚠ {{ $pendingApprovals }} Pending Approvals
                </a>
            @endif
            @if($lowConsumables > 0)
                <a href="{{ route('inventory.index') }}" class="bg-rose-100 text-rose-800 px-3 py-1.5 rounded-full font-medium">
                    📦 {{ $lowConsumables }} Low Consumables
                </a>
            @endif
        </div>
    </div>

    <!-- Primary KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-xl border border-[#e6d3a0] bg-gradient-to-br from-white to-[#fff8e8] p-4 shadow-sm">
            <div class="text-xs font-semibold uppercase tracking-wide text-[#9a8770]">Total Sales Today</div>
            <div class="text-2xl font-bold text-[#1a2332] mt-1">₹{{ number_format($todaySales, 0) }}</div>
            <div class="text-xs text-emerald-700 mt-1 font-medium">Est. Profit: ₹{{ number_format($todayProfitEstimate, 0) }}</div>
        </div>
        <div class="rounded-xl border border-[#e6d3a0] bg-gradient-to-br from-[#1a140e] to-[#2a1f14] p-4 shadow-sm">
            <div class="text-xs font-semibold uppercase tracking-wide text-[#d4af37]">Current Stock Valuation</div>
            <div class="text-2xl font-bold text-[#f0d78c] mt-1">₹{{ number_format($stockValuation, 0) }}</div>
            <div class="text-xs text-[#c4b39a] mt-1">{{ $availableItems->count() }} pieces in vault</div>
        </div>
        <div class="rounded-xl border border-[#dce7f5] bg-gradient-to-br from-white to-[#eef4fb] p-4 shadow-sm">
            <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Metal Inventory Weight</div>
            <div class="text-xl font-bold text-[#1a2332] mt-1">{{ number_format($goldWeight, 2) }}g <span class="text-xs font-semibold text-[#b8860b]">Gold</span></div>
            <div class="text-xs text-slate-500 mt-1">{{ number_format($silverWeight, 1) }}g Silver · {{ number_format($diamondCarats, 2) }} ct Diamond</div>
        </div>
        <div class="rounded-xl border border-rose-200 bg-gradient-to-br from-white to-rose-50 p-4 shadow-sm">
            <div class="text-xs font-semibold uppercase tracking-wide text-rose-500">Receivables & Payables</div>
            <div class="text-xl font-bold text-rose-700 mt-1">₹{{ number_format($outstandingCustomer, 0) }} <span class="text-xs font-normal text-slate-500">Due</span></div>
            <div class="text-xs text-slate-500 mt-1">Supplier Due: ₹{{ number_format($supplierOutstanding, 0) }}</div>
        </div>
    </div>

    <!-- Secondary KPIs -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        <div class="bg-white rounded-lg border border-[#e8dfd0] p-3 shadow-sm">
            <div class="text-[11px] font-medium text-[#9a8770]">Gold Sales</div>
            <div class="text-base font-bold text-[#b8860b]">₹{{ number_format($metalSales['Gold']->total ?? 0, 0) }}</div>
        </div>
        <div class="bg-white rounded-lg border border-[#e8dfd0] p-3 shadow-sm">
            <div class="text-[11px] font-medium text-[#9a8770]">Silver Sales</div>
            <div class="text-base font-bold text-slate-700">₹{{ number_format($metalSales['Silver']->total ?? 0, 0) }}</div>
        </div>
        <div class="bg-white rounded-lg border border-[#e8dfd0] p-3 shadow-sm">
            <div class="text-[11px] font-medium text-[#9a8770]">Diamond Sales</div>
            <div class="text-base font-bold text-sky-700">₹{{ number_format($diamondSales, 0) }}</div>
        </div>
        <div class="bg-white rounded-lg border border-[#e8dfd0] p-3 shadow-sm">
            <div class="text-[11px] font-medium text-[#9a8770]">Total Purchases</div>
            <div class="text-base font-bold text-[#1a2332]">₹{{ number_format($totalPurchaseValue, 0) }}</div>
        </div>
        <div class="bg-white rounded-lg border border-[#e8dfd0] p-3 shadow-sm">
            <div class="text-[11px] font-medium text-[#9a8770]">Old Gold Exchange</div>
            <div class="text-base font-bold text-[#1a2332]">{{ $oldGoldCount }} (₹{{ number_format($oldGoldValue, 0) }})</div>
        </div>
        <div class="bg-white rounded-lg border border-[#e8dfd0] p-3 shadow-sm">
            <div class="text-[11px] font-medium text-[#9a8770]">Pending Orders / Repairs</div>
            <div class="text-base font-bold text-[#1a2332]">{{ $pendingOrders }} / {{ $pendingRepairs }}</div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-[#e8dfd0] p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-[#1a2332] mb-3">24K Gold Rate Movement (₹/g)</h2>
            <canvas id="rateChart" height="140"></canvas>
        </div>
        <div class="bg-white rounded-xl border border-[#e8dfd0] p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-[#1a2332] mb-3">Sales vs Purchase Overview (₹)</h2>
            <canvas id="salesPurchaseChart" height="140"></canvas>
        </div>
    </div>

    <!-- Branch & Staff Sales + Recent Invoices -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-[#e8dfd0] p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-[#1a2332] mb-3">Branch-wise Sales</h2>
            <div class="space-y-3">
                @foreach($branchSales as $b)
                    <div class="flex items-center justify-between text-sm border-b border-slate-100 pb-2">
                        <div>
                            <div class="font-medium text-slate-800">{{ $b->name }}</div>
                            <div class="text-xs text-slate-400">{{ $b->code }}</div>
                        </div>
                        <div class="font-semibold text-slate-900">₹{{ number_format($b->total_sales ?? 0, 0) }}</div>
                    </div>
                @endforeach
            </div>
            <h2 class="text-sm font-semibold text-slate-800 mt-5 mb-3">Top Salespersons</h2>
            <div class="space-y-2">
                @foreach($staffSales as $s)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-700">{{ $s->name }}</span>
                        <span class="font-semibold text-[#b8860b]">₹{{ number_format($s->total_sales ?? 0, 0) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl border border-[#e8dfd0] p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-[#1a2332]">Recent Showroom Invoices</h2>
                <a href="{{ route('pos.invoices') }}" class="text-xs text-[#b8860b] font-semibold hover:underline">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs text-[#9a8770] uppercase bg-[#faf6ef]">
                        <tr>
                            <th class="px-3 py-2 text-left">Invoice #</th>
                            <th class="px-3 py-2 text-left">Customer</th>
                            <th class="px-3 py-2 text-left">Branch</th>
                            <th class="px-3 py-2 text-right">Amount</th>
                            <th class="px-3 py-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f0e8da]">
                        @forelse($recentInvoices as $inv)
                            <tr class="hover:bg-[#fffaf0]">
                                <td class="px-3 py-2 font-medium"><a href="{{ route('pos.invoice', $inv) }}" class="text-[#b8860b] hover:underline">{{ $inv->invoice_no }}</a></td>
                                <td class="px-3 py-2">{{ $inv->customer->name ?? 'Walk-in' }}</td>
                                <td class="px-3 py-2 text-slate-500">{{ $inv->branch->code ?? '' }}</td>
                                <td class="px-3 py-2 text-right font-semibold">₹{{ number_format($inv->grand_total, 2) }}</td>
                                <td class="px-3 py-2 text-center">
                                    <span class="px-2 py-0.5 text-xs rounded-full bg-emerald-100 text-emerald-700 capitalize">{{ $inv->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-3 py-4 text-center text-slate-400">No invoices yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rateCtx = document.getElementById('rateChart');
    if (rateCtx && window.Chart) {
        new window.Chart(rateCtx, {
            type: 'line',
            data: {
                labels: @json($rateHistory->map(fn($r) => $r->effective_at->format('d M'))),
                datasets: [{
                    label: '24K Gold (₹/g)',
                    data: @json($rateHistory->pluck('rate_per_gram')),
                    borderColor: '#d97706',
                    backgroundColor: 'rgba(217, 119, 6, 0.1)',
                    fill: true,
                    tension: 0.35
                }]
            },
            options: { plugins: { legend: { display: false } } }
        });
    }

    const spCtx = document.getElementById('salesPurchaseChart');
    if (spCtx && window.Chart) {
        new window.Chart(spCtx, {
            type: 'bar',
            data: {
                labels: ['Total Sales', 'Total Purchases', 'Old Gold Exchange', 'Stock Valuation'],
                datasets: [{
                    label: 'Value (₹)',
                    data: [{{ $totalSales }}, {{ $totalPurchaseValue }}, {{ $oldGoldValue }}, {{ $stockValuation }}],
                    backgroundColor: ['#059669', '#2563eb', '#d97706', '#0f172a'],
                    borderRadius: 6
                }]
            },
            options: { plugins: { legend: { display: false } } }
        });
    }
});
</script>
@endpush

