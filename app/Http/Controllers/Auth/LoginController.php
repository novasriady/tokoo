<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index () {
        return view('pages/auth/login');
    }

    public function login (Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::getUserByUsername($username);

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            if ($user->isadmin === 0) {
                $cart = OrderModel::getCartsByUserId($user->id);
                if ($cart) {
                    session()->put('cart', $cart);
                }

                return redirect()->route('user.home');
            } else {
                return redirect()->route('admin.dashboard');
            }
        } else {
            return back()->with('error', 'Username atau Password anda salah!');
        }
    }
}
