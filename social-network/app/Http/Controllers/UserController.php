<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $users = User::has('roles')->with("roles")->paginate(5);                        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();  
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
      
        $rules = [                        
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:30|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ];     
        $customMessages = [
            //'required' => 'Cuidado!! el campo :attribute no se puede dejar vacío',
            'id.unique'=> 'ya existe un usuario resgistrado con este id.',
            //'name.required' => 'Cuidado!! el campo del nombre no se admite vacío',
        ];
        $validatedData = $request->validate($rules, $customMessages);                

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'profile_pic' => '',
            'friend_count'=> 0,
            'status' => 1,
            'password' => Hash::make($data['password']),
        ]);
            
        $user->roles()->attach(Role::where('name', $data['role'])->first());        
        $user->save();

        return redirect('/users')->with('success', 'El usuario ha sido registrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $rules = [            
            'id' => 'exists:users,id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:30|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ];
        $customMessages = [
            //'required' => 'Cuidado!! el campo :attribute no se puede dejar vacío',
            'id.unique'=> 'ya existe un usuario resgistrado con este id.',
            //'name.required' => 'Cuidado!! el campo del nombre no se admite vacío',
        ];
        $validatedData = $request->validate($rules, $customMessages);        

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->name =  $request->get('username');
        $user->email = $request->get('email');
        $user->password = $request->get('password');        
        $user->save();

        return redirect('/users')->with('success', 'Información del ususario '.$id.' actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'El usuario '.$id.' ha sido eliminado!');
    }
}
