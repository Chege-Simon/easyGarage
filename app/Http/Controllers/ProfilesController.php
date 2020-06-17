<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;


class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function edit()
    {
        $user = Auth::user();
        return view('editProfile',compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'national_id' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
         
        if($request->email != $user->email && !$request->validate(['email' => ['unique:users']])){
            return Redirect::to('/profile/edit')->with('warning','Email already used!');
        }else if($request->national_id != $user->national_id && !$request->validate(['national_id' => ['unique:users']])){
            return Redirect::to('/profile/edit')->with('warning','National ID already used!');
        }
        $update = ['first_name' => $request->first_name,'last_name' => $request->last_name, 'email' => $request->email, 'national_id' => $request->national_id];
        User::where('id',$id)->update($update);
   
        return Redirect::to('profile')->with('success','Great! Details updated successfully');
    }
    public function delete()
    {
        $user = Auth::user();
        return view('deleteUser', compact('user'));
    }
    public function destroy()
    {
        $user = Auth::user();
        
        if(isset($_POST['delete'])) {
            // $user = \User::find(Auth::user()->id);
            Auth::logout();
        
            if ($user->delete()) {
                    return Redirect::to('/')->with('success', 'Your account has been deleted!');
                }else{
                    return Redirect::to('/')->with('error', 'An error occured!');
                }
        }else if(isset($_POST['cancel'])) {
            $user = Auth::user();
            return Redirect::to('profile')->with('success','Thank you for staying with us!');
        }
    }
    public function changePassword()
    {
        $user = Auth::user();
        return view('changePassword', compact('user'));
    }
}
