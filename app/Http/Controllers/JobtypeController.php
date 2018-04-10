<?php

namespace App\Http\Controllers;

use App\Jobtype;
use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class JobtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = Lang::locale();
        $l = Language::where('code',$locale)->value('id');
        $lang = Language::find($l);
        $jobtype = $lang->jobtypes()->where('trash',0)->get();
        return view('admin.jobtypes.index',compact('jobtype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locale = Lang::locale();
        $lang=[];
        if(Session::has('job_type_lang_id')){
            $lang = Session::get('job_type_lang_id');
        }
        $language = Language::whereNotIn('id',$lang)->where('active',1)->pluck('name','id');
        return view('admin.jobtypes.create',compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array_one[$request->language_id]=$request->language_id;
        if($request->session()->has('job_type_lang_id')){
            $lang = $request->session()->get('job_type_lang_id');
            $request->session()->forget('job_type_lang_id');
            $request->session()->put('job_type_lang_id',$lang+$array_one);
        }else{
            $request->session()->put('job_type_lang_id',$array_one);
        }

        $id =0;
        if($request->session()->has('job_type_id')){
            $categ = $request->session()->get('job_type_id');
            foreach ($categ as $c){
                $id = $c;
            }
        }

        $array_lang = $request->session()->get('job_type_lang_id');
        $language = Language::whereNotIn('id',$array_lang)->pluck('name','id');
        if(!count($language)){
            $request->session()->forget('job_type_lang_id');
            $request->session()->forget('job_type_id');
            $language = Language::pluck('name','id');
        }
        $check = Jobtype::where('id',$id)->get();
        if($request->ajax()) {
            if (!count($check)) {
                $jobtype = new Jobtype();
                $jobtype->date = Carbon::now()->toDateString();
                $jobtype->trash = 0;
                $jobtype->user_added = Auth::user()->id;
                $jobtype->user_modifies =0;
                $jobtype->save();
                $id = $jobtype->id;
                $request->session()->put('job_type_id', [$id => $id]);
                $jobtype->languages()->attach($request->language_id, ['name' => $request->name]);
                return response()->json(['id' => 0, 'language' => $language]);
            } else {
                DB::table('jobtype_language')->insert(['language_id' => $request->language_id, 'jobtype_id' => $id, 'name' => $request->name]);
                if (!$request->session()->has('job_type_lang_id')) {
                    $id = 0;
                }
                return response()->json(['id' => 0, 'language' => $language]);
            }
        }
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
    public function edit($id,$langId)
    {
        $l = Language::find($langId);
        $data = $l->jobtypes()->where('jobtype_id',$id)->get();
        return view('admin.jobtypes.edit',compact('data'));
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
        $jobType = Jobtype::find($id);
        $jobType->user_modifies = Auth::user()->id;
        $jobType->save();
        DB::table('jobtype_language')->where('id',$request->pivotId)->update(['name'=>$request->name]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Jobtype::find($id);
        $cat->trash = 1;
        $cat->save();
    }
}
