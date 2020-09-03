<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\Validator;

class Todocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //returns list of all todos
        return response(TodoResource::collection(Todo::all(),200));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store a new todo in database
        $validate=Validator::make($request->toArray(),[
            "name"=>"required",
            "status"=>"required"
        ]);
        if($validate->fails()){
            return response($validate->errors(),400);
        }

        return response(new TodoResource(Todo::create($validate->validate())),201);//new todo created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get a specific todo
        $todo= Todo::find($id);
        
        return response(new TodoResource($todo,200));

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

        $validate=Validator::make($request->toArray(),[
            "name"=>"required",
            "status"=>"required"
        ]);
        if($validate->fails()){
            return response($validate->errors(),400);
        }
       
        $todo = Todo::find($id);
        
        $todo->name =  $request->get('name');
        $todo->status =  $request->get('status');
        
        $todo->save();
        return response(null,200);
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
        $todo=Todo::find($id);
        $todo->delete();
        return response(null,200);
    }
}
