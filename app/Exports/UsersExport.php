<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::with('wallet')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Referral Code',
            'Sponsor Code',
            'Status',
            'Balance',
            'Registered At'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->referral_code,
            $user->sponsor_id,
            ucfirst($user->status),
            '$' . number_format($user->wallet->income_wallet ?? 0, 2),
            $user->created_at->format('Y-m-d H:i:s')
        ];
    }
}
