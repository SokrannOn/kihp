<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class brandController extends Controller
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
=======
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

>>>>>>> 4d1c881b0feea2ff9cff40ec255fe05297911e45
    public function show($id)
    {
        //
    }

<<<<<<< HEAD
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
=======

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


>>>>>>> 4d1c881b0feea2ff9cff40ec255fe05297911e45
    public function destroy($id)
    {
        //
    }
}
