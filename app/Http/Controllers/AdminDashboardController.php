<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('banned');
    }
    
    public function index()
    {
        return view('admin/dashboard', [
            'user' => User::all(),
            'loged' => User::firstWhere('id', Auth::user()->id),
            'category' => Category::all(),
            'userc' => User::where('role', '!=', 'admin')->where('role', '!=', 'vendor')->count(),
            'vendor' => User::where('role', 'vendor')->count(),
            'transaction' => Cart::where('status', 'selesai')->count(),
            'products' => Product::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/act/create', [
            'loged' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        $validatedData['role'] = $request->role;
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['status'] = $request->status;
        $validatedData['image'] = 'profile-images/user.png';

        User::create($validatedData);
        return redirect('/administrator')->with('success', 'New User Has Been Created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function verify($user)
    {
        User::where('id', $user)->update(['email_verified_at' => now()]);
        return redirect('/administrator')->with('success', 'Account Has Been Verified');
    }

    public function ban($user)
    {
        User::where('id', $user)->update(['status' => 'banned']);
        return redirect('/administrator')->with('success', 'Account Has Been Banned');
    }

    public function unban($user)
    {
        User::where('id', $user)->update(['status' => 'available']);
        return redirect('/administrator')->with('success', 'Account Has Been Unbanned');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        return view('admin/act/edit', [
            'user' => User::firstWhere('id', $user),
            'loged' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:255'],
            'role' => ['required']
        ]);

        User::where('id', $user)->update(['username' => $validatedData['username'], 'role' => $validatedData['role']]);
        return redirect('/administrator')->with('success', 'User data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        User::where('email', $user)->delete();
        return redirect('/administrator')->with('success', 'User data has been deleted');
    }

    public function category() {
        return view('admin/category', [
            'category' => Category::all(),
            'loged' => User::firstWhere('id', Auth::user()->id)
        ]);
    }

    public function createcategory() {
        return view('admin/category/create', [
            'loged' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    public function addcategory(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'slug' => ['required', 'min:3', 'max:255']
        ]);

        Category::create($validatedData);
        return redirect('/admin/category')->with('success', 'New Category Has Been Added');
    }

    public function editcategory($id) {
        return view('admin/category/edit', [
            'category' => Category::firstWhere('id', $id),
            'loged' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    public function updatecategory(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'slug' => ['required', 'min:3', 'max:255']
        ]);

        Category::where('id', $id)->update(['name' => $validatedData['name'], 'slug' => $validatedData['slug']]);
        return redirect('/admin/category')->with('success', 'Category Has Been Updated');
    }

    public function deletecategory($id) {
        Category::where('id', $id)->delete();
        return redirect('/admin/category')->with('success', 'Category Has Been Deleted');
    }

    public function profile() {
        return view('admin/profile/profile', [
            'user' => User::firstWhere('id', Auth::user()->id),
            'loged' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    public function profileup(Request $request) {
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:255']
        ]);

        if ($request->phone_number) {
            if ($request->phone_number[0] == '0') {
                return redirect('/admin/profile')->with('failed', 'Awali no telpon dengan 62 bukan 0!');
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
        return redirect('/admin/profile')->with('updated', 'Your Profile Data Has Been Updated');
    }

    public function changeimg() {
        return view('admin/profile/img', [
            'loged' => User::firstWhere('id', Auth::user()->id),
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

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-images');
        }

        User::where('id', Auth::user()->id)->update(['image' => $validatedData['image']]);
        return redirect('/admin/profile')->with('updated', 'Profile Picture Has Been Updated');
    }

    public function changepw() {
        return view('admin/profile/change', [
            'loged' => User::firstWhere('id', Auth::user()->id),
        ]);
    }

    public function updatepw(Request $request) {
        if($request->password == '') {
            return redirect('/admin/changepw')->with('failed', 'Fill the current password!');
        }

        if(!Hash::check($request->password, Auth::user()->password)) {
            return redirect('/admin/changepw')->with('failed', 'Wrong Current Password');
        }

        $validatedData = $request->validate([
            'new_password' => ['required', 'min:8', 'max:255']
        ]);

        $password = Hash::make($validatedData['new_password']);

        User::where('id', Auth::user()->id)->update(['password' => $password]);
        return redirect('/admin/profile')->with('updated', 'Password Has Been Changed');
    }

    public function vendordata() {
        return view('admin/vendor', [
            'loged' => User::firstWhere('id', Auth::user()->id),
            'vendor' => Vendor::with(['user'])->get()
        ]);
    }

    public function transaction() {
        return view('admin/transaction', [
            'loged' => User::firstWhere('id', Auth::user()->id),
            'cart' => Cart::with(['product.category', 'product.vendor.user.address', 'user.address'])->get()
        ]);
    }
}
