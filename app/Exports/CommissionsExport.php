<?php

namespace App\Exports;

use App\Models\CommissionLedger;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CommissionsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return CommissionLedger::with(['user', 'fromUser'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Member Name',
            'Member Code',
            'Type',
            'Amount',
            'From Member',
            'Description',
            'Date'
        ];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->user->name ?? 'N/A',
            $item->user->referral_code ?? 'N/A',
            ucfirst($item->commission_type),
            '$' . number_format($item->amount, 2),
            $item->fromUser->name ?? 'System',
            $item->description,
            $item->created_at->format('Y-m-d H:i:s')
        ];
    }
}
