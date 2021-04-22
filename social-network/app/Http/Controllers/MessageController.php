<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
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
        /*$messages = Menssage::all()->paginate(10);                        
        return view('home', compact('messages'));*/
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
        $data = $request->all();
      
        $rules = [                        
            'message' => 'required|string|max:200',            
        ];     
        $customMessages = [
            //'required' => 'Cuidado!! el campo :attribute no se puede dejar vacío',
            'message.required'=> 'No existe ningún mensaje.',
            'message.string'=> 'El mensaje es una cadena.',
            'message.max'=> 'El mensaje debe tener una tamaño maximo de 200 caracteres.'
            //'name.required' => 'Cuidado!! el campo del nombre no se admite vacío',
        ];
        $validatedData = $request->validate($rules, $customMessages);                        
        
        $message = Message::create([
            'message' => $data['message'],
            'ip' => '123',
            'created' => 123,
            'uploads' => '123',
            'like_count' => 0,
            'comment_count' => 0,
            'share_count' => 0,
            'uid'=> $request->user()->id
        ]);       
        //$message->users()->attach(User::where('id', $request->user()->id)->first());        
        $message->save();

        return redirect('/home')->with('success', 'El mensaje se ha publicado!!');
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
        //
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
        //
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
