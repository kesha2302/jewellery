<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function allproducts()
    {
        $categories = Category::with('products')->get();

    return view('frontend.allproducts', compact('categories'));
    }

    public function productidview($id)
    {
        $product = Product::with('subcategory', 'category')->findOrFail($id);
        return view('frontend.productidview', compact('product'));
    }

    public function banner()
    {
        $banners = Banner::all();
        return view('frontend.banner', compact('banners'));
    }

    public function aboutus()
    {
        $aboutus = Aboutus::all();
        return view('frontend.aboutus', compact('aboutus'));
    }

    public function contactus()
    {
        $contactus = Contact::all();
        return view('frontend.contact', compact('contactus'));
    }

    public function feedbackform(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email|max:255',
            'comment' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $feedback= new Feedback();
        $feedback->name=$request->input('name');
        $feedback->email=$request->input('email');
        $feedback->description=$request->input('comment');

        $feedback->save();

        return redirect('/Contactus');

    }

    public function exprolnewarrivals()
    {
        $products = Product::with('subcategory', 'category')
            ->where('created_at', '>=', now()->subDays(7))
            ->get();

        return view('frontend.explorenewarrival', compact('products')); // Pass products to the view
    }

    public function productdropdown()
    {
        // $products = Product::with('category', 'subcategory')->get();
        // return view('frontend.layout.header', compact('products'));
        $categories = Category::all();
        return view('frontend.layout.header', compact('categories'));
    }

    public function categoryfooter()
    {
        $categories = Category::all();

        return view('frontend.layout.footer', compact('categories'));
    }

    public function categoryshow($id)
    {
        // Fetch the category by ID
        $categories = Category::findOrFail($id);

        // Fetch products related to the category
        $products = Product::where('category_id', $id)->get();

        // Return the view with the category and its products
        return view('frontend.allcategoryproduct', compact('categories', 'products'));
    }


}
