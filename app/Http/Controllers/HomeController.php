<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Cart;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home', [
            'category' => Category::all(),
            'cart' => Auth::user() ? Cart::with(['product'])
                                        ->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : '',
            'products' => Product::with(['vendor', 'rating'])->where('status', 'ready')->inRandomOrder()->take(6)->get(),
            'latest' => Cart::with(['product', 'user'])->where('status', 'selesai')->orderBy('updated_at', 'DESC')->take(3)->get(),
            'new' => Product::with(['vendor'])->where('status', 'ready')->orderBy('updated_at', 'DESC')->take(6)->get()
        ]);
    }

    public function shop(Request $request) {
        if($request->sort == 'Name') {
            $field = 'products.name';
            $filter = 'ASC';
        } else if ($request->sort == 'exp') {
            $field = 'price';
            $filter = 'DESC';
        } else if ($request->sort == 'cheap') {
            $field = 'price';
            $filter = 'ASC';
        } else {
            $field = 'products.name';
            $filter = 'ASC';
        }

        return view('shop', [
            'products' => Product::select('products.name as name', 'products.*')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                                ->with(['vendor', 'rating'])
                                ->where('status', 'ready')
                                ->where('products.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('status', 'ready')
                                ->where('products.description', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('status', 'ready')
                                ->where('price', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('status', 'ready')
                                ->where('categories.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('status', 'ready')
                                ->where('categories.slug', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('status', 'ready')
                                ->where('vendors.location', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('status', 'ready')
                                ->where('vendors.name', 'LIKE', '%'.$request->search.'%')
                                ->orderBy($field, $filter)
                                ->paginate($request->show ? $request->show : 30),
            'category' => Category::all(),
            'market' => Vendor::all(),
            'cart' => Auth::user() ? Cart::with(['product'])
                                        ->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : ''
        ]);
    }

    public function category(Request $request, $slug) {
        if($request->sort == 'Name') {
            $field = 'products.name';
            $filter = 'ASC';
        } else if ($request->sort == 'exp') {
            $field = 'price';
            $filter = 'DESC';
        } else if ($request->sort == 'cheap') {
            $field = 'price';
            $filter = 'ASC';
        } else {
            $field = 'products.name';
            $filter = 'ASC';
        }

        $category = Category::firstWhere('slug', $slug);

        return view('/shop', [
            'products' => Product::select('products.name as name', 'products.*')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                                ->with(['vendor', 'rating'])
                                ->where('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('products.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('products.description', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('price', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('categories.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('categories.slug', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('vendors.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('category_id', $category->id)
                                ->where('status', 'ready')
                                ->where('vendors.location', 'LIKE', '%'.$request->search.'%')
                                ->orderBy($field, $filter)
                                ->paginate($request->show ? $request->show : 30),
            'category' => Category::all(),
            'market' => Vendor::all(),
            'cart' => Auth::user() ? Cart::with(['product'])->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : ''
        ]);
    }

    public function market(Request $request, $market) {
        if($request->sort == 'Name') {
            $field = 'products.name';
            $filter = 'ASC';
        } else if ($request->sort == 'exp') {
            $field = 'price';
            $filter = 'DESC';
        } else if ($request->sort == 'cheap') {
            $field = 'price';
            $filter = 'ASC';
        } else {
            $field = 'products.name';
            $filter = 'ASC';
        }

        $name = str_replace('_', ' ', $market);
        $vendor = Vendor::firstWhere('name', $name);

        return view('/shop', [
            'products' => Product::select('products.name as name', 'products.*')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                                ->with(['vendor', 'rating'])->where('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('products.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('products.description', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('price', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('categories.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('categories.slug', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('vendors.name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('vendor_id', $vendor->id)
                                ->where('status', 'ready')
                                ->where('vendors.location', 'LIKE', '%'.$request->search.'%')
                                ->orderBy($field, $filter)
                                ->paginate($request->show ? $request->show : 30),
            'category' => Category::all(),
            'market' => Vendor::all(),
            'cart' => Auth::user() ? Cart::with(['product'])->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : ''
        ]);
    }

    public function detail($id) {
        $product = Product::firstWhere('id', $id);

        return view('detail', [
            'category' => Category::all(),
            'product' => $product,
            'products' => Product::where('vendor_id', $product->vendor_id)
                                ->where('id', '!=', $id)
                                ->skip(0)->take(5)->get(),
            'cart' => Auth::user() ? Cart::with(['product'])->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : '',
            'rating' => Rating::with(['user'])->where('product_id', $id)->paginate(3)
        ]);
    }

    public function toko($toko) {
        $vendor = str_replace('_', ' ', $toko);
        $vendor_id = Vendor::firstWhere('name', $vendor);
        return view('toko', [
            'category' => Category::all(),
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : '',
            'cart' => Auth::user() ? Cart::with(['product'])->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
            'vendor' => Vendor::firstWhere('name', $vendor),
            'product' => Product::where('vendor_id', $vendor_id->id)->get()
        ]);
    }

    public function contact() {
        return view('contact', [
            'category' => Category::all(),
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : '',
            'cart' => Auth::user() ? Cart::with(['product'])->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
        ]);
    }
    
    public function blog() {
        return view('blog', [
            'category' => Category::all(),
            'check' => Auth::user() ? Cart::where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')->first() : '',
            'cart' => Auth::user() ? Cart::with(['product'])->where('user_id', Auth::user()->id)
                                        ->where('status', 'cart')
                                        ->get() : '',
        ]);
    }
}
