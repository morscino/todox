<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
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

   
    public function create(Request $request)
    {
        $user = $this->authUser();
        $credentials = $request->all();

        if(!$newTodo = $user->todos()->create($credentials)){
            return response()->json(['error'=>'Could not create New Todo'],500);
         } 

        return response()->json(['todo'=>$newTodo],201);
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show()
    {
         $user = $this->authUser();

         if (!$todos = $user->todos) {
             return response()->json(['error'=>'Could not get Todos'],500);
         }

         return response()->json(compact('todos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = $this->authUser();
        $newDetails = $request->only(['title','details']);

       if(!$todo = $user->todos()->whereId($id)->update($newDetails)){
         return response()->json(['error'=>'Could not Update Todo'],500);
       } 

      

        return  response()->json(['todo'=>Todo::findOrFail($id)],200);
    }

    
    public function destroy($id)
    {
        $user = $this->authUser();
        $todo = $user->todos()->whereId($id);
        if(!$todo = $todo->delete()){
         return response()->json(['error'=>'Could not Delete Todo'],500);
       } 

    return response()->json(['todo'=> $todo],200);
    }
}
