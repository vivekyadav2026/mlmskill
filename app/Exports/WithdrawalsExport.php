<?php

namespace App\Exports;

use App\Models\Withdrawal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WithdrawalsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Withdrawal::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'User Code',
            'Amount',
            'Payable',
            'Charge',
            'Method',
            'Details',
            'Status',
            'Date'
        ];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->user->name ?? 'N/A',
            $item->user->referral_code ?? 'N/A',
            '$' . number_format($item->amount, 2),
            '$' . number_format($item->payable_amount, 2),
            '$' . number_format($item->charge, 2),
            $item->payment_method,
            $item->account_details,
            ucfirst($item->status),
            $item->created_at->format('Y-m-d H:i:s')
        ];
    }
}
