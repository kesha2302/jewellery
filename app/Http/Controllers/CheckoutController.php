<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        Log::info('Checkout data saved in session:', [
                       'checkout_data' => $request->session()->get('checkout_data'),
                 ]);
        return view ('frontend.Checkoutpage');
    }

    public function checkoutSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'pincode' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Save data to the session
        $request->session()->put('checkout_data', $request->only([
            'name',
            'contact_number',
            'email',
            'pincode',
            'city',
            'state',
            'address'
        ]));

        return response()->json(['status' => 'success', 'message' => 'Order details saved. Proceed to payment.']);
    }
}
