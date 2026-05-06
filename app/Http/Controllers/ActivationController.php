<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivationService;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    protected ActivationService $activationService;

    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    public function activate(Request $request)
    {
        $user = Auth::user();
        
        try {
            $this->activationService->activateUser($user);
            return redirect()->back()->with('success', 'Account activated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
