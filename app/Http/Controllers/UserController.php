<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /* Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all();

        return view('users.index', compact('users'));
    }

    /* Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /* Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
 
=======
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);
        
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $user->image = $image_name;

        }
        $user->save();
<<<<<<< HEAD
        return redirect('/user');
=======
        return redirect('/user'); 

>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
    }

    /* Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /* Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /* Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
    public function trash(){
        $trashedUsers = User::onlyTrashed()->get();
<<<<<<< HEAD
        return view('users.blocked',compact('trashedUsers'));
=======
        return view('users.blockedusers',compact('trashedUsers'));
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
    }
    public function restore($id){
        $user = User::withTrashed()->find($id);
        if($user){
            $user->restore();
            return redirect()->route('users.index')->with('success','User unblocked successfully');
        }
        return redirect()->route('users.index')->with('error','User not found');  
      }

    public function forceDelete($id){
        $user = User::withTrashed()->find($id);
        if($user){
            $user->forceDelete();
            return redirect()->route('users.index')->with('success','User Deleted successfully');
        }
        return redirect()->route('users.index')->with('error','User not found');  
      }
}