<?php

namespace App\Http\Controllers;

use App\Mail\CancelMail;
use App\Mail\ConfirmMail;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VendorpageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('vendor');
        $this->middleware('banned');
    }

    public function index(Request $request) {
        $vendor = Vendor::firstWhere('user_id', Auth::user()->id);
        return view('vendor/dashboard', [
            'pesanan' => $vendor ? Cart::with(['product', 'user.address'])->join('products', 'carts.product_id', '=', 'products.id')
                        ->where('products.vendor_id', $vendor->id)
                        ->where('carts.status', $request->status ? $request->status : '!=', 'cart')
                        ->select('carts.*')->get() : '',
            'check' => $vendor ? Cart::join('products', 'carts.product_id', '=', 'products.id')
                        ->where('products.vendor_id', $vendor->id)
                        ->where('carts.status', '!=', 'cart')
                        ->select('carts.*')->first() : '',
            'user' => User::firstWhere('id', Auth::user()->id),
            'tp' => $vendor ? Product::where('vendor_id', $vendor->id)->count() : '',
            'tt' => $vendor ? Cart::join('products', 'carts.product_id', '=', 'products.id')
                        ->where('products.vendor_id', $vendor->id)
                        ->where('carts.status', 'selesai')
                        ->select('carts.*')->count() : ''
        ]);
    }

    public function yourmarket() {
        $vendor = Vendor::firstWhere('user_id', Auth::user()->id);

        return view('vendor/toko', [
            'check' => Vendor::firstWhere('user_id', Auth::user()->id),
            'products' => $vendor ? Product::with(['vendor'])->where('vendor_id', $vendor->id)->get() : '',
            'checkproduct' => $vendor ? Product::firstWhere('vendor_id', $vendor->id) : '',
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function openmarket() {
        $check = Vendor::firstWhere('user_id', Auth::user()->id);
        if($check) {
            return redirect('/yourmarket')->with('failed', 'Anda Sudah Punya Toko');
        }

        $user = User::firstWhere('id', Auth::user()->id);
        $phone_number = $user->phone_number;

        if(!$phone_number) {
            return redirect('/vendor/profile')->with('failed', 'Isi Nomor Telepon Terlebih Dahulu');
        }

        return view('vendor/market/createmarket', [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function addmarket(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'location' => ['required', 'min:3'],
            'request' => ['required']
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        Vendor::create($validatedData);
        return redirect('/yourmarket')->with('success', 'Toko Has Been Created');
    }

    public function editmarket() {
        return view('vendor/market/editmarket', [
            'market' => Vendor::firstWhere('user_id', Auth::user()->id),
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function updatemarket(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'location' => ['required', 'min:3'],
            'request' => ['required']
        ]);

        Vendor::where('user_id', Auth::user()->id)->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'location' => $validatedData['location'],
            'request' => $validatedData['request']
        ]);

        return redirect('/yourmarket')->with('success', 'Toko Has Been Updated');
    }

    public function closemarket() {
        $vendor = Vendor::firstWhere('user_id', Auth::user()->id);
        $image = $vendor->image;
        
        if($image) {
            unlink(public_path('storage/'. $image));
        }

        Vendor::where('user_id', Auth::user()->id)->delete();
        Product::where('vendor_id', $vendor->id)->delete();

        return redirect('/yourmarket')->with('success', 'Toko Has Been Closed');
    }

    public function createproduct() {
        return view('vendor/produk/create', [
            'category' => Category::all(),
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function addproduct(Request $request) {
        $vendor = Vendor::firstWhere('user_id', Auth::user()->id);
        $vendor_id = $vendor->id;

        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'qty' => ['required', 'numeric'],
            'status' => ['required']
        ]);

        $validatedData['vendor_id'] = $vendor_id;

        Product::create($validatedData);
        return redirect('/yourmarket')->with('success', 'Produk Berhasil Ditambahkan');
    }

    public function editproduct($id) {
        return view('vendor/produk/edit', [
            'category' => Category::all(),
            'product' => Product::firstWhere('id', $id),
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function updateproduct(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'qty' => ['required', 'numeric'],
            'status' => ['required']
        ]);

        Product::where('id', $id)->update($validatedData);
        return redirect('/yourmarket')->with('success', 'Produk Berhasil Diupdate');
    }

    public function uploadimg($id) {
        return view('vendor/produk/uploadimg', [
            'id' => $id,
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function uploadimg2($id) {
        return view('vendor/produk/uploadimg2', [
            'id' => $id,
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function uploadimg3($id) {
        return view('vendor/produk/uploadimg3', [
            'id' => $id,
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function uploadimg4($id) {
        return view('vendor/produk/uploadimg4', [
            'id' => $id,
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function updateimg(Request $request, $id) {
        $product = Product::firstWhere('id', $id);
        $image = $product->image;
        
        $validatedData = $request->validate([
            'image' => ['required' ,'image', 'file', 'max:1024']
        ]);

        if($image) {
            unlink(public_path('storage/'. $image));
        }

        $validatedData['image'] = $request->file('image')->store('products-images');

        Product::where('id', $id)->update(['image' => $validatedData['image']]);
        return redirect('/yourmarket')->with('success', 'Gambar Produk Berhasil Diupdate');
    }

    public function updateimg2(Request $request, $id) {
        $product = Product::firstWhere('id', $id);
        $image = $product->image2;
        
        $validatedData = $request->validate([
            'image' => ['required' ,'image', 'file', 'max:1024']
        ]);

        if($image) {
            unlink(public_path('storage/'. $image));
        }

        $validatedData['image'] = $request->file('image')->store('products-images');

        Product::where('id', $id)->update(['image2' => $validatedData['image']]);
        return redirect('/yourmarket')->with('success', 'Gambar Produk Berhasil Diupdate');
    }

    public function updateimg3(Request $request, $id) {
        $product = Product::firstWhere('id', $id);
        $image = $product->image3;
        
        $validatedData = $request->validate([
            'image' => ['required' ,'image', 'file', 'max:1024']
        ]);

        if($image) {
            unlink(public_path('storage/'. $image));
        }

        $validatedData['image'] = $request->file('image')->store('products-images');

        Product::where('id', $id)->update(['image3' => $validatedData['image']]);
        return redirect('/yourmarket')->with('success', 'Gambar Produk Berhasil Diupdate');
    }

    public function updateimg4(Request $request, $id) {
        $product = Product::firstWhere('id', $id);
        $image = $product->image4;
        
        $validatedData = $request->validate([
            'image' => ['required' ,'image', 'file', 'max:1024']
        ]);

        if($image) {
            unlink(public_path('storage/'. $image));
        }

        $validatedData['image'] = $request->file('image')->store('products-images');

        Product::where('id', $id)->update(['image4' => $validatedData['image']]);
        return redirect('/yourmarket')->with('success', 'Gambar Produk Berhasil Diupdate');
    }

    public function vendorimg() {
        return view('vendor/market/image', [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function upvendorimg(Request $request) {
        $vendor = Vendor::firstWhere('user_id', Auth::user()->id);
        $image = $vendor->image;

        $validatedData = $request->validate([
            'image' => ['required', 'image', 'file', 'max:1024']
        ]);

        if($image) {
            unlink(public_path('storage/'. $image));
        }

        $validatedData['image'] = $request->file('image')->store('vendor-images');

        Vendor::where('user_id', Auth::user()->id)->update(['image' => $validatedData['image']]);
        return redirect('/yourmarket')->with('success', 'Gambar Vendor Berhasil Diupdate');
    }

    public function deleteproduct($id) {
        $product = Product::firstWhere('id', $id);
        $image = $product->image;
        $image2 = $product->image2;
        $image3 = $product->image3;
        $image4 = $product->image4;

        if($image) {
            unlink(public_path('storage/'. $image));
        }

        if($image2) {
            unlink(public_path('storage/'. $image2));
        }

        if($image3) {
            unlink(public_path('storage/'. $image3));
        }

        if($image4) {
            unlink(public_path('storage/'. $image4));
        }

        Product::where('id', $id)->delete();
        return redirect('/yourmarket')->with('success', 'Produk Berhasil Dihapus');
    }

    public function confirm($id) {
        $cart = Cart::firstWhere('id', $id);
        $user = User::firstWhere('id', $cart->user_id);

        Mail::to($user->email)->send(new ConfirmMail(Auth::user()->phone_number, $id));

        Cart::where('id', $id)->update(['status' => 'diproses']);
        return redirect('/vendorpage')->with('success', 'Berhasil Mengonfirmasi Pesanan');
    }

    public function cancel(Request $request, $id) {
        $cart = Cart::firstWhere('id', $id);
        $user = User::firstWhere('id', $cart->user_id);
        $alasan = $request->alasan;

        if (!$alasan) {
            return redirect('/vendorpage')->with('failed', 'Masukkan Alasan Untuk Membatalkan');
        }

        Mail::to($user->email)->send(new CancelMail(Auth::user()->phone_number, $id, $alasan));

        Cart::where('id', $id)->delete();
        return redirect('/vendorpage')->with('success', 'Berhasil Membatalkan Pesanan');
    }

    public function send($id) {
        $cart = Cart::firstWhere('id', $id);
        $user = User::firstWhere('id', $cart->user_id);

        Mail::to($user->email)->send(new SendMail(Auth::user()->phone_number, $id));

        Cart::where('id', $id)->update(['status' => 'dikirim']);
        return redirect('/vendorpage')->with('success', 'Berhasil Mengirim Pesanan');
    }

    public function profile() {
        return view('vendor/profile/profile', [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function profileup(Request $request) {
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:255']
        ]);

        if ($request->phone_number) {
            if ($request->phone_number[0] == '0') {
                return redirect('/vendor/profile')->with('failed', 'Awali no telpon dengan 62 bukan 0!');
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
        return redirect('/vendor/profile')->with('updated', 'Your Profile Data Has Been Updated');
    }

    public function changeimg() {
        return view('vendor/profile/img', [
            'user' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function updatepimg(Request $request) {
        $validatedData = $request->validate([
            'image' => ['image', 'file', 'max:1024']
        ]);

        $currentImage = Auth::user()->image;
        if ($currentImage != 'profile-images/user.png') {
            unlink(public_path('storage/'.Auth::user()->image));
        }

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-images');
        }

        User::where('id', Auth::user()->id)->update(['image' => $validatedData['image']]);
        return redirect('/vendor/profile')->with('updated', 'Profile Picture Has Been Updated');
    }

    public function changepw() {
        return view('vendor/profile/change', [
            'user' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    public function updatepw(Request $request) {
        if($request->password == '') {
            return redirect('/vendor/changepw')->with('failed', 'Fill the current password!');
        }

        if(!Hash::check($request->password, Auth::user()->password)) {
            return redirect('/vendor/changepw')->with('failed', 'Wrong Current Password');
        }

        $validatedData = $request->validate([
            'new_password' => ['required', 'min:8', 'max:255']
        ]);

        $password = Hash::make($validatedData['new_password']);

        User::where('id', Auth::user()->id)->update(['password' => $password]);
        return redirect('/vendor/profile')->with('updated', 'Password Has Been Changed');
    }

}
