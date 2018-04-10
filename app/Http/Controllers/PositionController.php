<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index()
    {
        $position = Position::all();
        return view('admin.position.index',compact('position'));

    }

    public function createPosition(){
        return view('admin.position.create');
    }

    public function store(Request $request){
        $this->validate($request,[
           'name'       =>'required',
           'description'   =>'required'
        ],[
            'name.required' =>'Position name required',
            'description.required' =>'Display name required'
        ]);

        $position = new Position();
        $position->name = $request->input('name');
        $position->description = $request->input('description');
        $position->user_id = Auth::user()->id;
        $position->save();
        return redirect('/admin/position/create');

    }
    public function edit($id){
        $p =Position::find($id);
//        return $position;
        return view('admin.position.edit',compact('p'));

    }

    public function updatePosition(Request $request,$id){
        $position = Position::find($id);
        $position->name=$request->input('name');
        $position->description=$request->input('description');
        $position->save();
        return redirect('/admin/position/create');
    }

    public function deletePosition($id){

        $p=Position::find($id);
        $p->delete();
    }


}
