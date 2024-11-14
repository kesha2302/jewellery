<?php

namespace App\Http\Controllers;

use App\Models\Cartsession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginview()
    {
        return view ('frontend.login');
    }
    public function registerview()
    {
        return view ('frontend.register');
    }

    public function signupdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'contact' => 'required|digits:10',

        ]);


        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $user= new User();
        $user->fullname=$request->input('fullname');
        $user->email=$request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->address=$request->input('address');
        $user->state=$request->input('state');
        $user->city=$request->input('city');
        $user->pincode=$request->input('pincode');
        $user->contact=$request->input('contact');

        $user->save();

        return redirect('Login');

        // echo "<pre>";
        // print_r($request->all());
    }

    public function logindata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('customer_id', $user->customer_id);
            $request->session()->put('success', 'Login successful!');
            $request->session()->put('username', $user->fullname);
            // return redirect('/')->with([
            //     'success' => 'Login successful!',
            //     'username' => $user->fullname
            // ]);

            $previousCartData = Cartsession::where('customer_id', $user->customer_id)
            ->latest('created_at')
            ->first();

            if ($previousCartData) {
                $cart = [];

                $productIds = explode(',', $previousCartData->product_ids);
                $names = explode(',', $previousCartData->name);
                $prices = explode(',', $previousCartData->price);
                $discountPrices = explode(',', $previousCartData->discount_price);
                $quantities = explode(',', $previousCartData->quantity);
                $images = explode(',', $previousCartData->image);

                foreach ($productIds as $index => $productId) {
                    $cart[$productId] = [
                        'product_id' => $productId,
                        'name' => $names[$index],
                        'price' => $prices[$index],
                        'discount_price' => $discountPrices[$index],
                        'quantity' => $quantities[$index],
                        'image' => $images[$index],
                    ];
                }

                $request->session()->put('cart', $cart);

            }

            return redirect('/');
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        $cart = $request->session()->get('cart');
        // $totalAmount = $request->session()->get('totalAmount');

        if (!empty($cart)) {
            $user = Auth::user();

            $productIds = [];
            $names = [];
            $prices = [];
            $discountPrices = [];
            $quantities = [];
            $images = [];

            foreach ($cart as $item) {
                $productIds[] = $item['product_id'];
                $names[] = $item['name'];
                $prices[] = $item['price'];
                $discountPrices[] = $item['discount_price'];
                $quantities[] = $item['quantity'];
                $images[] = $item['image'];
            }

        $cartsession = new Cartsession();
        $cartsession->customer_id = $user->customer_id;
        $cartsession->product_ids = implode(',', $productIds);
        $cartsession->name = implode(',', $names);
        $cartsession->price = implode(',', $prices);
        $cartsession->discount_price = implode(',', $discountPrices);
        $cartsession->quantity = implode(',', $quantities);
        $cartsession->image = implode(',', $images);
        // $cartsession->total_amount = $totalAmount;

        $cartsession->save();

        }

        $request->session()->forget('cart');
        $request->session()->forget('totalAmount');

        $request->session()->forget('customer_id');
        $request->session()->forget('success');
        $request->session()->forget('username');
        Auth::logout();
        return redirect('/');
    }
}

