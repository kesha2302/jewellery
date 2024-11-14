<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('frontend.editprofile', compact('user'));
    }

    public function update(Request $request)
    {


        $user = auth()->user();

        if ($user instanceof User) {

            $user->fullname = $request->input('fullname');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->state = $request->input('state');
            $user->city = $request->input('city');
            $user->pincode = $request->input('pincode');
            $user->contact = $request->input('contact');

            $user->save();

            return redirect('/edit-profile')->with('success', 'Profile updated successfully');
        } else {

            return redirect('/edit-profile')->with('error', 'Failed to update profile. User not found or invalid.');
        }
    }

    public function orderhistory()
    {
        $user = auth()->user();

        $orders = $user->orders;
        // $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(5);
        // $orders = $user->orders ?? collect();
        // $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        return view('frontend.orderhistory', compact('user', 'orders'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        $checkout = Checkout::where('order_id', $order->order_id)->first();
        if ($checkout) {
            $checkout->delete();
        }

        // $order->status = 'Cancelled';
        // $order->save();

        $order->delete();

        return redirect()->back()->with('order_cancelled', 'Order has been cancelled.');
    }

}
