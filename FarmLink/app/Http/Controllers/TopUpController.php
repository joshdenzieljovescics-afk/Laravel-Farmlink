<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopUpController extends Controller
{
    /**
     * Display the top-up page
     */
    public function index()
    {
        return view('topup');
    }

    /**
     * Process the top-up transaction
     */
    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:1000000'
        ]);

        $user = Auth::user();
        $amount = $request->input('amount');

        try {
            DB::beginTransaction();

            // Update user's farm tokens
            $user->farm_tokens = $user->farm_tokens + $amount;
            $user->save();

            // Optional: Create a transaction record
            // You can create a separate transactions table to log all top-ups
            // DB::table('transactions')->insert([
            //     'user_id' => $user->id,
            //     'type' => 'topup',
            //     'amount' => $amount,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);

            DB::commit();

            return redirect()
                ->route('topup')
                ->with('success', "Successfully added {$amount} FarmTokens to your account!");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->route('topup')
                ->with('error', 'Failed to process top-up. Please try again.');
        }
    }
}