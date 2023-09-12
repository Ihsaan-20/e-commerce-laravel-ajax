<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AdminController extends Controller
{
    public function index()
    {   
        // $id = Auth::user()->id;
        // $userData = User::find($id);
        // return view('admin.dashboard', compact('userData'));
        return view('admin.dashboard');
    }
    // login method;
    public function AdminLogin()
    {
        return view('admin.login');
    }//end method;

    //logout method;
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//end method;


}
