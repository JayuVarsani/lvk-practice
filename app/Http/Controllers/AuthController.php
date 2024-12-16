<?php

// namespace App\Src\Admin\Modules\Auth;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginPost(LoginRequest $request)
    {
        if ($request->authentication()) {
            $request->session()->regenerate();
            $this->flashAlert('Welcome back!', 'info');
            return redirect()->route('admin.dashboard');
        }
        $this->flashAlert('Login failed!', 'danger');
        return redirect()->route('admin.login.index');
    }

    public function flashAlert($message = '', $type = 'success')
    {
        session()->flash('alert', ['message' => $message, 'type' => $type]);
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function forgotPasswordPost(ForgotPasswordRequest $request)
    {
        $request->sendLink()
            ? $this->flashAlert('Reset Link is Sended. Please Check Your Mail')
            : $this->flashAlert('Something Went Wrong!', 'danger');
        return redirect()->route('admin.password.request');
    }

    public function resetPassword(Request $request)
    {
        return view('admin.auth.reset-password', ['request' => $request]);
    }

    public function resetPasswordPost(ResetPasswordRequest $request)
    {
        $request->reset()
            ? $this->flashAlert('Your password has been changed!', 'info')
            : $this->flashAlert('Something went wrong!!! Try again', 'danger');
        return redirect()->route('admin.login.index');
    }

    //'$2y$12$GD8HoY4rNbxxewtUahniS.Xochh.fl163ol8ghlfObEb5L/HwOaoO'

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('admin.login.index');
    }
}
