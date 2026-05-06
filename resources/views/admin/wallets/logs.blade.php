@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Wallet Adjustment Logs</h2><p class="text-gray-400">Audit trail of all manual wallet modifications made by administrators.</p></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Admin</th><th>Target User</th><th>Wallet Affected</th><th>Amount</th><th>Date</th></tr></thead>
            <tbody>
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No manual adjustments recorded yet.</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection