<?php

namespace App\Http\Controllers;

use App\Models\Cartsession;
use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function handlepayment(Request $request)
    {

        $user = Auth::user();

        $totalCost = $request->session()->get('totalAmount');
        $checkoutData = $request->session()->get('checkout_data');
        $cartItems = $request->session()->get('cart', []);
        $discount = $totalCost * 0.10; // 10% of the total cost
        $discountedTotalCost = $totalCost - $discount;


        Log::info('Handle payment called', ['request_data' => $request->all()]);



        if(isset($request->razorpay_payment_id) && $request->razorpay_payment_id != '')
        {
            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            // $response = $payment->capture(array('amount'=>$totalCost * 100));
            $response = $payment->capture(array('amount' => $discountedTotalCost * 100));

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


            $orderId = 'order_' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Save cart data in one row
            $orderItem = new Order();

            $orderItem->order_id = $orderId;
            $orderItem->customer_id = $user->customer_id;
            $orderItem->product_ids = $productIdsStr;
            $orderItem->product_name = $productNamesStr;
            $orderItem->quantity = $quantitiesStr;
            $orderItem->price = $totalPricesStr;
            // $orderItem->total_cost = $totalCost;
            $orderItem->total_cost = $discountedTotalCost;
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
              $checkout->payment_id = $response['id'];
            //   $checkout->total_cost = $totalCost;
              $checkout->total_cost = $discountedTotalCost;
              $checkout->save();

            $email = $user->email;


            Mail::send('Frontend.paymentemail', ['user' => $user, 'checkout' => $checkout, 'orderItem' => $orderItem], function($message) use ($email) {
                $message->to($email)->subject('Payment Confirmation');
            });

            Cartsession::where('customer_id', $user->customer_id)->delete();

            $request->session()->forget('checkout_data');
            $request->session()->forget('cart');
            $request->session()->forget('totalAmount');

            return redirect('/');

        } else {
           echo "<script>console.error('Payment ID not provided or empty.');</script>";
        }
    }
}
