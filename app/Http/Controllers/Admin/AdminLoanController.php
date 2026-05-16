<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanScheme;
use App\Models\LoanRequest;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
{
    public function indexSchemes()
    {
        $schemes = LoanScheme::latest()->paginate(10);
        return view('admin.loans.schemes', compact('schemes'));
    }

    public function createScheme()
    {
        return view('admin.loans.create_scheme');
    }

    public function storeScheme(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|gt:min_amount',
            'interest_rate' => 'required|numeric|min:0',
            'max_tenure_months' => 'required|integer|min:1',
        ]);

        LoanScheme::create($request->all());

        return redirect()->route('admin.loans.schemes')->with('success', 'Loan scheme created successfully!');
    }

    public function requests()
    {
        $requests = LoanRequest::with(['user', 'scheme'])->latest()->paginate(20);
        return view('admin.loans.requests', compact('requests'));
    }

    public function updateRequest(Request $request, $id)
    {
        $loan = LoanRequest::findOrFail($id);
        
        $updateData = [
            'status' => $request->status,
            'admin_remarks' => $request->admin_remarks
        ];

        if ($request->status === 'approved') {
            $updateData['approved_at'] = now();
        } elseif ($request->status === 'disbursed') {
            $updateData['disbursed_at'] = now();
        }

        $loan->update($updateData);

        return back()->with('success', 'Loan request status updated!');
    }
}
