<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('profiles.edit', compact('user'));
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
            'username' => 'required|string|max:30',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',                     
        ];
        $customMessages = [
            //'required' => 'Cuidado!! el campo :attribute no se puede dejar vacío',
            'id.unique'=> 'ya existe un usuario resgistrado con este id.',
            //'name.required' => 'Cuidado!! el campo del nombre no se admite vacío',
        ];
        $validatedData = $request->validate($rules, $customMessages);                 

        $user = User::find($id);
        

        if ( !($user->email == $request->get('email')) || !($user->username == $request->get('username'))){
            $rules = [                                          
                'username' => 'unique:users,username',
                'email' => 'unique:users,username,email',                                
            ];  
            $validatedData = $request->validate($rules, $customMessages);
        }
        $pass = $request->get('password');        
        
        if (!Hash::check($pass, $user->password))
        {
            $user->password = Hash::make($pass);
        }
        
        if ($request->hasFile('imagen')){           
            $image = $request->file('imagen');
            $image->move('uploads', $image->getClientOriginalName());
            $user->profile_pic = $image->getClientOriginalName();
        }

        $user->name =  $request->get('name');
        $user->name =  $request->get('username');
        $user->email = $request->get('email');                        

        $user->save();

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
