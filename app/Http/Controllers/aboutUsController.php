<?php

namespace App\Http\Controllers;

use App\Aboutus;
use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class aboutUsController extends Controller
{

    public function index()
    {   $locale = Lang::locale();
        $lid = Language::where('code',$locale)->value('id');
        $language = Language::find($lid);
        $about = $language->aboutuses()->where('trash',0)->get();
        return view('admin.aboutUs.view',compact('about','lid'));
    }

    public function deleteAb($id){
        $a = Aboutus::find($id);
        $a->trash = 1;
        $a->save();
    }

    public function create(Request $request)
    {
        $aId=null;
        $locale = Lang::locale();
        $lid = Language::where('code',$locale)->value('id');
        $language = Language::find($lid);
        $category = $language->categories()->where('trash',0)->pluck('name','categories.id');
        $language = Language::where('active',1)->pluck('name','id');
        if ($request->session()->has('languageAbout')){
            $aboutId = $request->session()->get('category');
            $aId = $aboutId['id'];
            $lId = $request->session()->get('languageAbout');
            $language = Language::whereNotIn('id',$lId)->pluck('name','id');
        }

        return view('admin.aboutUs.create',compact('language','category','aId'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'language_id'=>'required',
            'category_id'=>'required',
            'description'=>'required'
        ],[
            'language_id.required'=>trans('label.choose_item'),
            'category_id.required'=>trans('label.choose_item'),
            'description.required'=>trans('label.fill')
        ]);
        if($request->session()->has('languageAbout')){
            $lA = $request->session()->get('languageAbout');
            $request->session()->put('languageAbout',[$request->input('language_id')=>$request->input('language_id')]+$lA);
        }else{
            $request->session()->put('languageAbout',[$request->input('language_id')=>$request->input('language_id')]);
        }
        $aId = $request->session()->get('aboutId');
        $lId = $request->session()->get('languageAbout');
        $language = Language::whereNotIn('id',$lId)->get();
        if(!count($language)){
            $request->session()->forget('aboutId');
            $request->session()->forget('languageAbout');
            $request->session()->forget('category');
        }
        $ab = Aboutus::find($aId['id']);
        if ($ab){
            $ab->languages()->attach($request->input('language_id'),['description'=>$request->input('description')]);
        }else{
            $about = new Aboutus();
            $about->category_id = $request->input('category_id');
            $about->date=Carbon::now()->toDateString();
            if($request->input('publish')=='on'){
                $about->publish=1;
            }else{
                $about->publish=0;
            }
            $about->trash=0;
            $about->user_id=Auth::user()->id;
            $about->user_modify=0;
            $about->save();
            $id = $about->id;
            $request->session()->put('aboutId',['id'=>$id]);
            $request->session()->put('category',['id'=>$request->input('category_id')]);
            $about->languages()->attach($request->input('language_id'),['description'=>$request->input('description')]);
        }

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
