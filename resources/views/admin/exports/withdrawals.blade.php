<!DOCTYPE html>
<html>
<head>
    <title>Withdrawal Report</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #777; }
        .status-paid { color: green; font-weight: bold; }
        .status-pending { color: orange; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Withdrawal & Payout Report</h1>
        <p>Generated on: {{ date('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>Amount</th>
                <th>Payable</th>
                <th>Method</th>
                <th>Details</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($withdrawals as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->user->name ?? 'N/A' }} ({{ $item->user->referral_code ?? 'N/A' }})</td>
                <td>${{ number_format($item->amount, 2) }}</td>
                <td><strong>${{ number_format($item->payable_amount, 2) }}</strong></td>
                <td>{{ $item->payment_method }}</td>
                <td>{{ $item->account_details }}</td>
                <td class="{{ $item->status == 'approved' ? 'status-paid' : ($item->status == 'pending' ? 'status-pending' : '') }}">
                    {{ ucfirst($item->status) }}
                </td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Payout Verification Document</p>
    </div>
</body>
</html>
