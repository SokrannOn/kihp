<?php

namespace App\Http\Controllers;

use App\Career;
use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
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
        $career = $lang->careers()->where('trash',0)->paginate(10);
        return view('admin.careers.index',compact('career','l'));
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
        if(Session::has('career_lang_id')){
            $lang = Session::get('career_lang_id');
        }
        $language = Language::whereNotIn('id',$lang)->where('active',1)->pluck('name','id');
        $l = Language::where('code',$locale)->value('id');
        $lang = Language::find($l);
        $category = $lang->categories()->pluck('name','categories.id');
        $jobcategory = $lang->jobcategories()->pluck('name','jobcategories.id');
        $jobtype = $lang->jobtypes()->pluck('name','jobtypes.id');
        return view('admin.careers.create',compact('language','category','jobcategory','jobtype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'language_id' => 'required',
            'category_id'      =>'required',
            'jobcategory_id' => 'required',
            'title'      =>'required',
            'jobtype_id' => 'required',
            'location'      =>'required',
            'close_date' => 'required',
            'description' => 'required',
        ],[
            'language_id.required'     =>trans('label.choose_item'),
            'category_id.required'     =>trans('label.choose_item'),
            'jobcategory_id.required'     =>trans('label.choose_item'),
            'jobtype_id.required'     =>trans('label.choose_item'),
            'title.required'        =>trans('label.fill'),
            'location.required'        =>trans('label.fill'),
            'close_date.required'        =>trans('label.fill'),
            'description' => trans('label.fill'),
        ]);
        $array_one[$request->language_id]=$request->language_id;
        if($request->session()->has('career_lang_id')){
            $lang = $request->session()->get('career_lang_id');
            $request->session()->forget('career_lang_id');
            $request->session()->put('career_lang_id',$lang+$array_one);
        }else{
            $request->session()->put('career_lang_id',$array_one);
        }

        $id =0;
        if($request->session()->has('career_id')){
            $car = $request->session()->get('career_id');
            foreach ($car as $c){
                $id = $c;
            }
        }

        $array_lang = $request->session()->get('career_lang_id');
        $language = Language::whereNotIn('id',$array_lang)->pluck('name','id');
        if(!count($language)){
            $request->session()->forget('career_lang_id');
            $request->session()->forget('career_id');
            $language = Language::pluck('name','id');
        }
        $check = Career::where('id',$id)->get();
        if (!count($check)) {
            $cat = new Career();
            $cat->date = Carbon::now()->toDateString();
            $cat->category_id = $request->category_id;
            $cat->jobcategory_id = $request->jobcategory_id;
            $cat->jobtype_id = $request->jobtype_id;
            $cat->location = $request->location;
            $cat->close_date = $request->close_date;
            if ($request->publish == 1) {
                $cat->publish = $request->publish;
                $cat->publish_date = Carbon::now()->toDateString();
            } else {
                $cat->publish = 0;
            }
            $cat->trash = 0;
            $cat->user_added = Auth::user()->id;
            $cat->user_modifies = 0;
            $cat->save();
            $id = $cat->id;
            $request->session()->put('career_id', [$id => $id]);
            $cat->languages()->attach($request->language_id, ['title' => $request->title,'description'=>$request->description]);
            return redirect()->back();
        } else {
            DB::table('career_language')->insert(['language_id' => $request->language_id, 'career_id' => $id, 'title' => $request->title,'description'=>$request->description]);
            if (!$request->session()->has('career_lang_id')) {
                $id = 0;
            }
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$langId)
    {
        $lang = Language::find($langId);
        $career = $lang->careers()->where('career_id',$id)->get();
        return view('admin.careers.view',compact('career','langId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$langId)
    {
        $lang = Language::find($langId);
        $data = $lang->careers()->where('career_id',$id)->get();
        $category = $lang->categories()->pluck('name','categories.id');
        $jobcategory = $lang->jobcategories()->pluck('name','jobcategories.id');
        $jobtype = $lang->jobtypes()->pluck('name','jobtypes.id');
        return view('admin.careers.edit',compact('data','category','jobcategory','jobtype'));
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
        $this->validate($request,[
            'category_id'      =>'required',
            'jobcategory_id' => 'required',
            'title'      =>'required',
            'jobtype_id' => 'required',
            'location'      =>'required',
            'close_date' => 'required',
            'description' => 'required',
        ],[
            'category_id.required'     =>trans('label.choose_item'),
            'jobcategory_id.required'     =>trans('label.choose_item'),
            'jobtype_id.required'     =>trans('label.choose_item'),
            'title.required'        =>trans('label.fill'),
            'location.required'        =>trans('label.fill'),
            'close_date.required'        =>trans('label.fill'),
            'description' => trans('label.fill'),
        ]);
        $cat = Career::find($id);
        $cat->category_id = $request->category_id;
        $cat->jobcategory_id = $request->jobcategory_id;
        $cat->jobtype_id = $request->jobtype_id;
        $cat->location = $request->location;
        $cat->close_date = $request->close_date;
        if ($request->publish=='on'){
            $cat->publish_date = Carbon::now()->toDateString();
            $cat->publish = 1;
        }else{
            $cat->publish = 0;
        }
        $cat->user_modifies = Auth::user()->id;
        $cat->save();
        DB::table('career_language')->where('id',$request->pivotId)->update(['title'=>$request->title,'description'=>$request->description]);
        return redirect(route('career.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Career::find($id);
        $cat->trash = 1;
        $cat->save();
    }
    public function selectByLanguage($id)
    {
        $lang = Language::find($id);
        $category = $lang->categories()->pluck('name','categories.id');
        $jobcategory = $lang->jobcategories()->pluck('name','jobcategories.id');
        $jobtype = $lang->jobtypes()->pluck('name','jobtypes.id');
        return response()->json(['category'=>$category,'jobcategory'=>$jobcategory,'jobtype'=>$jobtype]);
    }
}
