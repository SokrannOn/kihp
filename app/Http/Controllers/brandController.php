<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class brandController extends Controller
{

    public function index()
    {
        $brand = Brand::all();
        return view('admin.brand.brand_list',compact('brand'));
    }


    public function create()
    {
        return view('admin.brand.create');
    }


    public function store(Request $request)
    {
        if($request->ajax()){
            $b = new Brand();
            $b->name = $request->name;
            if($request->active=='on'){
                $b->active = 1;
            }else{
                $b->active = 0;
            }
            $b->user_id = Auth::user()->id;
            $b->save();
        }
        $brand = Brand::all();
        return view('admin.brand.brand_list',compact('brand'));
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' =>'required'
        ],[
            'name.required' => 'Name field required'
        ]);
        $b = Brand::find($id);
        $b->name = $request->name;
        if($request->active=='on'){
            $b->active = 1;
        }else{
            $b->active = 0;
        }
        $b->user_id = Auth::user()->id;
        $b->save();
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
