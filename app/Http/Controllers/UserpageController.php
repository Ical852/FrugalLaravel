<?php

namespace App\Http\Controllers;

use App\Mail\DoneMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Address;
use App\Models\Rating;
use App\Models\Vendor;
use App\Models\Whistlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserpageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
    }

    public function index() {
        return view('user/profile', [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function updateprofile(Request $request) {
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:255']
        ]);

        if($request->phone_number) {
            if($request->phone_number[0] == '0') {
                return redirect('/user')->with('failed', 'Awali no telpon dengan 62 bukan 0!');
            }
        }

        $validatedData['phone_number'] = $request->phone_number;
        $validatedData['birth'] = $request->birth;
        $validatedData['gender'] = $request->gender;

        User::where('id', Auth::user()->id)->update([
            'username' => $validatedData['username'], 
            'phone_number' => $validatedData['phone_number'],
            'birth' => $validatedData['birth'],
            'gender' => $validatedData['gender']
        ]);
        return redirect('/user')->with('updated', 'Your Profile Data Has Been Updated');
    }

    public function changepw() {
        return view('user/changepw' , [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function resetpw(Request $request) {
        if($request->password == '') {
            return redirect('/user/changepw')->with('failed', 'Fill the current password!');
        }

        if(!Hash::check($request->password, Auth::user()->password)) {
            return redirect('/user/changepw')->with('failed', 'Wrong Current Password');
        }

        $validatedData = $request->validate([
            'new_password' => ['required', 'min:8', 'max:255']
        ]);

        $password = Hash::make($validatedData['new_password']);

        User::where('id', Auth::user()->id)->update(['password' => $password]);
        return redirect('/user')->with('updated', 'Password Has Been Changed');

    }

    public function update() {
        return view('user/updateimg', [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function updateimg(Request $request) {
        $validatedData = $request->validate([
            'image' => ['image', 'file', 'max:1024']
        ]);

        $currentImage = Auth::user()->image;
        if ($currentImage != 'profile-images/user.png') {
            unlink(public_path('storage/'.Auth::user()->image));
        }

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('profile-images');
        }

        User::where('id', Auth::user()->id)->update(['image' => $validatedData['image']]);
        return redirect('/user')->with('updated', 'Profile Picture Has Been Updated');
    }
    
    public function add($id) {
        $check = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->where('status', 'cart')->first();
        if($check) {
            return redirect('/user/cart')->with('failed', 'Barang Sudah Ada Di Cart');
        }

        $data = [
            'product_id' => $id,
            'user_id' => Auth::user()->id,
            'qty' => 1,
            'status' => 'cart' 
        ];

        Cart::create($data);
        return redirect('/user/cart')->with('success', 'Berhasil Menambah Barang Di Cart');
    }

    public function cart() {
        return view('user/cart', [
            'category' => Category::all(),
            'cart' => Cart::with(['product'])->where('user_id', Auth::user()->id)
                        ->where('status', 'cart')
                        ->get(),
            'check' => Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() ? 
                        Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() : '',
            'address' => Address::firstWhere('user_id', Auth::user()->id) ? Address::firstWhere('user_id', Auth::user()->id) : ''
        ]);
    }

    public function updatecart(Request $request) {
        Cart::where('id', $request->id)->update([
            'qty' => $request->qty
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    public function deletecart($id) {
        Cart::where('id', $id)->delete();
        return redirect('/user/cart')->with('success', 'Berhasil Membatalkan Pesanan');
    }

    public function address(Request $request) {
        $address = Address::firstWhere('user_id', Auth::user()->id);
        $validatedData = $request->validate([
            'name' => ['required']
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        if($address) {
            Address::where('user_id', Auth::user()->id)->update($validatedData);
            return redirect('/user/cart')->with('success', 'Berhasil Mengupdate Alamat');
        }

        Address::create($validatedData);
        return redirect('/user/cart')->with('success', 'Berhasil Menambahkan Alamat');
    }

    public function checkout() {
        $address = Address::firstWhere('user_id', Auth::user()->id);
        $already = Cart::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();

        if(!$address) {
            return redirect('/user/cart')->with('address', 'Isi Alamat Terlebih Dahulu');
        }

        if($already) {
            Cart::where('user_id', Auth::user()->id)->where('status', 'checkout')->delete();
        }

        Cart::where('user_id', Auth::user()->id)->where('status', 'cart')->update(['status' => 'checkout']);
        return redirect('/user/cart')->with('success', 'Berhasil Checkout Barang');
    }

    public function payment() {
        return view('user/payment', [
            'category' => Category::all(),
            'cart' => Cart::with(['product'])->where('user_id', Auth::user()->id)
                        ->where('status', 'cart')
                        ->get(),
            'check' => Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() ? 
                        Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() : '',
            'checkout' => Cart::with(['product', 'product.vendor', 'product.vendor.user'])->where('user_id', Auth::user()->id)->where('status', 'checkout')->get(),
            'cc' => Cart::where('user_id', Auth::user()->id)->where('status', 'checkout')->first()
        ]);
    }

    public function deletecheckout($id) {
        Cart::where('id', $id)->delete();
        return redirect('/user/payment')->with('success', 'Berhasil Membatalkan Pesanan');
    }

    public function process() {
        return view('user/payment', [
            'category' => Category::all(),
            'cart' => Cart::with(['product'])->where('user_id', Auth::user()->id)
                        ->where('status', 'cart')
                        ->get(),
            'check' => Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() ?
                        Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() : '',
            'checkout' => Cart::with(['product', 'product.vendor', 'product.vendor.user'])->where('user_id', Auth::user()->id)->where('status', 'diproses')->get(),
            'cc' => Cart::where('user_id', Auth::user()->id)->where('status', 'diproses')->first()
        ]);

    }

    public function ontheway() {
        return view('user/payment', [
            'category' => Category::all(),
            'cart' => Cart::with(['product'])->where('user_id', Auth::user()->id)
                        ->where('status', 'cart')
                        ->get(),
            'check' => Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() ?
                        Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() : '',
            'checkout' => Cart::with(['product', 'product.vendor', 'product.vendor.user'])->where('user_id', Auth::user()->id)->where('status', 'dikirim')->get(),
            'cc' => Cart::where('user_id', Auth::user()->id)->where('status', 'dikirim')->first()
        ]);

    }

    public function done() {
        return view('user/payment', [
            'category' => Category::all(),
            'cart' => Cart::with(['product'])->where('user_id', Auth::user()->id)
                        ->where('status', 'cart')
                        ->get(),
            'check' => Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() ?
                        Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() : '',
            'checkout' => Cart::with(['product', 'product.vendor', 'product.vendor.user'])->where('user_id', Auth::user()->id)->where('status', 'selesai')->get(),
            'cc' => Cart::where('user_id', Auth::user()->id)->where('status', 'selesai')->first()
        ]);
    }

    public function accept($id) {
        $cart = Cart::firstWhere('id', $id);
        $user = User::firstWhere('id', $cart->user_id);
        $product = Product::firstWhere('id', $cart->product_id);
        $vendor = Vendor::firstWhere('id', $product->vendor_id);
        $seller = User::firstWhere('id', $vendor->user_id);

        Mail::to($user->email)->send(new DoneMail($seller->phone_number, $id));
        Cart::where('id', $id)->update(['status' => 'selesai']);
        return redirect('/user/ontheway')->with('success', 'Berhasil Menyelesaikan Pesanan');
    }

    public function rating(Request $request, $getter) {
        list($product_id, $id) = explode('-', $getter);
        $cart = Cart::firstWhere('id', $id);
        $user = User::firstWhere('id', $cart->user_id);
        $product = Product::firstWhere('id', $cart->product_id);
        $vendor = Vendor::firstWhere('id', $product->vendor_id);
        $seller = User::firstWhere('id', $vendor->user_id);

        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $product_id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan
        ];

        Rating::create($data);
        Mail::to($user->email)->send(new DoneMail($seller->phone_number, $id));
        Cart::where('id', $id)->update(['status' => 'selesai']);
        return redirect('/user/ontheway')->with('success', 'Berhasil Menyelesaikan Pesanan');
    }

    public function wish($id) {
        $wishlist = Whistlist::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if ($wishlist) {
            return redirect('/user/whistlist')->with('failed', 'Sudah Ada di Wishlist');
        }
        Whistlist::create(['user_id' => Auth::user()->id, 'product_id' => $id]);
        return redirect('/user/whistlist')->with('success', 'Berhasil Menambahkan Ke Wishlist');
    }

    public function wishlist() {
        return view('user/wishlist', [
            'wishlist' => Whistlist::with(['product.vendor', 'product.rating'])->where('user_id', Auth::user()->id)->get(),
            'category' => Category::all(),
            'cart' => Cart::with(['product'])->where('user_id', Auth::user()->id)
                        ->where('status', 'cart')
                        ->get(),
            'check' => Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() ?
                        Cart::where('user_id', Auth::user()->id)
                        ->where('status', 'cart')->first() : '',
        ]);
    }
    
    public function wishdel($id) {
        Whistlist::where('id', $id)->delete();
        return redirect('/user/whistlist')->with('success', 'Berhasil Menghapus Wishlist');
    }

}
