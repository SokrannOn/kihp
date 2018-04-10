<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
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
        $activities = $lang->activities()->where('trash',0)->get();
        return view('admin.news.index',compact('activities','l'));
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
        if(Session::has('activity_lang_id')){
            $lang = Session::get('activity_lang_id');
        }
        $language = Language::whereNotIn('id',$lang)->where('active',1)->pluck('name','id');
        $l = Language::where('code',$locale)->value('id');
        $lang = Language::find($l);
        $category = $lang->categories()->pluck('name','categories.id');
        return view('admin.news.create',compact('language','category'));
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
            'language_id'          =>'required',
            'title' => 'required',
            'category_id'      =>'required',
            'summarize' => 'required',
            'image' => 'required|image',
        ],[
            'language_id.required'         =>trans('label.choose_item'),
            'category_id.required'     =>trans('label.choose_item'),
            'title.required'        =>trans('label.fill'),
            'summarize.required'        =>trans('label.fill'),
            'image.required'        =>trans('label.image_required'),
            'image.image'        =>trans('label.image_mimes'),
        ]);

        $DS = DIRECTORY_SEPARATOR;

        $array_one[$request->language_id]=$request->language_id;
        if($request->session()->has('activity_lang_id')){
            $lang = $request->session()->get('activity_lang_id');
            $request->session()->forget('activity_lang_id');
            $request->session()->put('activity_lang_id',$lang+$array_one);
        }else{
            $request->session()->put('activity_lang_id',$array_one);
        }

        $id =0;
        if($request->session()->has('activity_id')){
            $ac = $request->session()->get('activity_id');
            foreach ($ac as $a){
                $id = $a;
            }
        }

        $array_lang = $request->session()->get('activity_lang_id');
        $language = Language::whereNotIn('id',$array_lang)->pluck('name','id');
        if(!count($language)){
            $request->session()->forget('activity_lang_id');
            $request->session()->forget('activity_id');
            $language = Language::pluck('name','id');
        }
        $check = Activity::where('id',$id)->get();
        if (!count($check)) {
            $activity = new Activity();
            $activity->date = Carbon::now()->toDateString();
            $activity->category_id = $request->category_id;
            $activity->reference = $request->reference;

            if ($request->publish == 1) {
                $activity->publish = $request->publish;
                $activity->publish_date = Carbon::now()->toDateString();
            } else {
                $activity->publish = 0;
            }
            $activity->trash = 0;
            $time =Carbon::now()->format('s');
            $mainphoto="default_mainphoto.png";
            if($file =$request->file('image')){
                $mainphoto=$time."_".$file->getClientOriginalName();
                $file->move('newsImages',$mainphoto);
            }
            $activity->main_photo = $mainphoto;
            $activity->user_added = Auth::user()->id;
            $activity->user_modifies = 0;
            $activity->save();
            $id = $activity->id;

            $request->session()->put('activity_id', [$id => $id]);
            $activity->languages()->attach($request->language_id, ['title' => $request->title,'main_content'=>$request->summarize,'content'=>$request->description]);
            return redirect()->back();
        } else {
            DB::table('activity_language')->insert(['language_id' => $request->language_id, 'activity_id' => $id, 'title' => $request->title,'main_content'=>$request->summarize,'content'=>$request->description]);
            if (!$request->session()->has('activity_lang_id')) {
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
        $data = $l->activities()->where('activity_id',$id)->get();
        $cat = $l->categories()->where('trash',0)->pluck('name','category_id');
        return view('admin.news.edit',compact('data','cat'));
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
            'title' => 'required',
            'category_id'      =>'required',
            'summarize' => 'required',
        ],[
            'category_id.required'     =>trans('label.choose_item'),
            'title.required'        =>trans('label.fill'),
            'summarize.required'        =>trans('label.fill'),
            'imageEdit.required'        =>trans('label.image_required'),
        ]);
        $act = Activity::find($id);
        $act->category_id = $request->category_id;
        if ($request->publishedit=='on'){
            $act->publish_date = Carbon::now()->toDateString();
            $act->publish = 1;
        }else{
            $act->publish = 0;
        }
        $act->reference = $request->reference;
        $act->user_modifies = Auth::user()->id;
        //get logo
        $time =Carbon::now()->format('s');
        $mainphoto="default_mainphoto.png";
        if($file =$request->file('imageEdit')){
            $mainphoto=$time."_".$file->getClientOriginalName();
            $file->move('newsImages',$mainphoto);
            $photoName = $act->main_photo;
            $act->main_photo = $mainphoto;
            if($photoName!='default_mainphoto.png'){

                unlink(public_path('newsImages/'.$photoName));
            }

        }
        $act->save();

        DB::table('activity_language')->where('id',$request->pivotId)->update(['title'=>$request->title,'main_content'=>$request->summarize,'content'=>$request->description]);
        return redirect(route('news.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ac = Activity::find($id);
        $ac->trash = 1;
        $ac->save();
    }
}
