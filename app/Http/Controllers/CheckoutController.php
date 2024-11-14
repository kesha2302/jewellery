<?php

namespace App\Http\Controllers;

use App\Models\Cartsession;
use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        Log::info('Checkout Submit called', ['request_data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'pincode' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
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
            'address',
            'payment_method'
        ]));

        Log::info('Checkout data saved in session', [
            'checkout_data' => $request->session()->get('checkout_data'),
        ]);


        $this->processOrder($request);

        return response()->json(['status' => 'success', 'message' => 'Order details saved.']);
    }

    private function processOrder(Request $request)
    {
        $user = Auth::user();
        $totalCost = $request->session()->get('totalAmount');
        $checkoutData = $request->session()->get('checkout_data');
        $cartItems = $request->session()->get('cart', []);



        if ($request->payment_method === 'cod') {
            $productIds = [];
            $productNames = [];
            $quantities = [];
            $totalPrices = [];


            foreach ($cartItems as $item) {
                $productIds[] = $item['product_id'];
                $productNames[] = $item['name'];
                $quantities[] = $item['quantity'];
                $totalPrices[] = $item['price'];
            }

            $productIdsStr = implode(',', $productIds);
            $productNamesStr = implode(',', $productNames);
            $quantitiesStr = implode(',', $quantities);
            $totalPricesStr = implode(',', $totalPrices);

            // Handle Cash on Delivery
            $orderId = 'order_' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Save order data
            $orderItem = new Order();
            $orderItem->order_id = $orderId;
            $orderItem->customer_id = $user->customer_id;
            $orderItem->product_ids = $productIdsStr;
            $orderItem->product_name = $productNamesStr;
            $orderItem->quantity = $quantitiesStr;
            $orderItem->price = $totalPricesStr;
            $orderItem->total_cost = $totalCost;
            $orderItem->save();

            $checkout = new Checkout();
            $checkout->customer_id = $user->customer_id;
            $checkout->order_id = $orderId;
            $checkout->name = $checkoutData['name'];
            $checkout->email = $checkoutData['email'];
            $checkout->address = $checkoutData['address'];
            $checkout->state = $checkoutData['state'];
            $checkout->city = $checkoutData['city'];
            $checkout->pincode = $checkoutData['pincode'];
            $checkout->contact = $checkoutData['contact_number'];
            $checkout->payment_id = 'cod';  // Store 'cod' for Cash on Delivery
            $checkout->total_cost = $totalCost;
            $checkout->save();

            $productNames = implode(', ', array_column($cartItems, 'name'));
            $quantities = implode(', ', array_column($cartItems, 'quantity'));
            $prices = implode(', ', array_column($cartItems, 'price'));

            // Send confirmation email

            Mail::send('frontend.paymentemail', [
                'user' => $user,
                'checkout' => $checkout,
                'orderItem' => $orderItem,
                'paymentMethod' => $checkoutData['payment_method'],
                'cartItems' => $cartItems,
                'productNames' => $productNames,
                'quantities' => $quantities,
                'prices' => $prices,
                'checkoutData' => $checkoutData,
                'logoPath' => public_path('AdminPanel/assets/images/logos/logo.jpg'),
            ], function ($message) use ($user, $checkout, $cartItems) {
                $logoPath = public_path('AdminPanel/assets/images/logos/logo.jpg');
                $message->to($user->email)
                    ->subject('Order Confirmation - Your Order with veehaagate.com ' . $checkout->order_id . ' has been successfully placed!');

                $message->embedData(file_get_contents($logoPath), 'logo.jpg', 'image/jpeg');

                foreach ($cartItems as $item) {
                    $message->embedData(file_get_contents(public_path('productsimg/' . $item['image'])), $item['image'], 'image/jpeg');
                }

                // $message->cc('veehaagate@gmail.com');
            });

            // Mail::send('Frontend.paymentemail', [
            //     'user' => $user,
            //     'checkout' => $checkout,
            //     'orderItem' => $orderItem,
            //     'paymentMethod' => $checkoutData['payment_method'],
            //     'cartItems' => $cartItems,
            //     'productNames' => $productNames,
            //     'quantities' => $quantities,
            //     'prices' => $prices,
            //     'checkoutData' => $checkoutData,
            // ], function ($message) use ($user,$checkout) {
            //     $message->to($user->email)
            //     ->subject('Order Confirmation - Your Order with veehaagate.com ' . $checkout->order_id . ' has been successfully placed!');
            // });

            // Mail::send('Frontend.paymentemail', ['user' => $user, 'checkout' => $checkout, 'orderItem' => $orderItem], function ($message) use ($user) {
            //     $message->to($user->email)->subject('Payment Confirmation');
            //     // $message->cc('veehaagate@gmail.com');
            // });

            Cartsession::where('customer_id', $user->customer_id)->delete();

            // Clear session data
            $request->session()->forget('checkout_data');
            $request->session()->forget('cart');
            $request->session()->forget('totalAmount');

            return response()->json(['status' => 'success', 'message' => 'Order placed successfully.']);
        }

    }

    public function updateSessionTotal(Request $request)
{
    $request->validate([
        'totalAmount' => 'required|numeric',
    ]);

    // Update the session variable
    session(['totalAmount' => $request->totalAmount]);

    return response()->json(['message' => 'Total amount updated successfully']);
}


}
