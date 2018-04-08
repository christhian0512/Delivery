<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function admin()
    {
        return view('admin');
    }
    
    public function overview()
    {
        return view('overview');
    }

    
    
    public function index()
    {
        $users = User::all();

        
        return view('users.index')
            ->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {   $data=$request->all();
        $validator= Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('users/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
        
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
        
        //Mail::to($user->email)->send(new VerifyMail($user));
        return redirect('users/create')->with('status', 'An activation code has been sent to the user.');
        
        }
    }


    public function show($id)
    {
        $user = User::find($id);

        // show the view and pass the nerd to it
        return view('users.show')
            ->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::find($id);

        // show the view and pass the nerd to it
        return view('users.edit')
            ->with('user', $user);
    }

    public function update(Request $request,$id)
    {   $data=$request->all();
        $validator= Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
        $user = User::find($id);
            $user->name       = $data['name'];
            $user->email      = $data['email'];
            $user->phone = $data['phone'];
            $user->password = $data['password'];
            $user->role = $data['role'];
            $user->save();
            return redirect('users')->with('status', 'User edited succesfully.');
        }

    }


    public function destroy($id)
    {
        //
    }
}
