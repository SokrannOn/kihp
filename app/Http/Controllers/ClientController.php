<?php

namespace App\Http\Controllers;

use App\Client;
use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
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

        $client = $lang->clients()->where('trash',0)->get();

        return view('admin.clients.index',compact('client','l'));
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
        if(Session::has('client_lang_id')){
            $lang = Session::get('client_lang_id');
        }
        $language = Language::whereNotIn('id',$lang)->where('active',1)->pluck('name','id');
        $l = Language::where('code',$locale)->value('id');
        $lang = Language::find($l);
        $category = $lang->categories()->pluck('name','categories.id');
        return view('admin.clients.create',compact('language','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get logo
        $time =Carbon::now()->format('s');
        $logo="logo.png";
        if($file =$request->file('image')){
            $logo=$time."_".$file->getClientOriginalName();
            $file->move('clientlogo',$logo);
        }

        $array_one[$request->language_id]=$request->language_id;
        if($request->session()->has('client_lang_id')){
            $lang = $request->session()->get('client_lang_id');
            $request->session()->forget('client_lang_id');
            $request->session()->put('client_lang_id',$lang+$array_one);
        }else{
            $request->session()->put('client_lang_id',$array_one);
        }

        $id =0;
        if($request->session()->has('client_id')){
            $cli = $request->session()->get('client_id');
            foreach ($cli as $c){
                $id = $c;
            }
        }

        $array_lang = $request->session()->get('client_lang_id');
        $language = Language::whereNotIn('id',$array_lang)->pluck('name','id');
        if(!count($language)){
            $request->session()->forget('client_lang_id');
            $request->session()->forget('client_id');
            $language = Language::pluck('name','id');
        }
        $check = Client::where('id',$id)->get();
        if (!count($check)) {
            $client = new Client();
            $client->date = Carbon::now()->toDateString();
            $client->category_id = $request->category_id;

            if ($request->publish == 1) {
                $client->publish = $request->publish;
                $client->publish_date = Carbon::now()->toDateString();
            } else {
                $client->publish = 0;
            }
            $client->trash = 0;
            $client->user_added = Auth::user()->id;
            $client->user_modifies = 0;
            $client->save();
            $id = $client->id;

            $request->session()->put('client_id', [$id => $id]);
            $client->languages()->attach($request->language_id, ['title' => $request->title,'description'=>$request->description,'logo'=>$logo]);
            return redirect()->back();
        } else {
            DB::table('client_language')->insert(['language_id' => $request->language_id, 'client_id' => $id, 'title' => $request->title,'description'=>$request->description,'logo'=>$logo]);
            if (!$request->session()->has('client_lang_id')) {
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
        $data = $l->clients()->where('client_id',$id)->get();
        $cat = $l->categories()->where('trash',0)->pluck('name','category_id');
        return view('admin.clients.edit',compact('data','cat'));
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
        $cli = Client::find($id);
        if($request->category_id) {
            $cli->category_id = $request->category_id;
        }else{
            $cli->category_id = 0;
        }
        if ($request->publishedit=='on'){
            $cli->publish = 1;
        }else{
            $cli->publish = 0;
        }
        $cli->user_modifies = Auth::user()->id;
        $cli->save();
        //get logo
        $time =Carbon::now()->format('s');
        $logo="logo.png";
        if($file =$request->file('imageEdit')){
            $logo=$time."_".$file->getClientOriginalName();
            $file->move('clientlogo',$logo);
            $logoName = DB::table('client_language')->select('logo')->where('id',$request->pivotId)->value('logo');
            if($logoName!='logo.png'){

                unlink(public_path('clientlogo/'.$logoName));
            }

        }

        DB::table('client_language')->where('id',$request->pivotId)->update(['title'=>$request->title,'description'=>$request->description,'logo'=>$logo]);
        return redirect(route('client.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cli = Client::find($id);
        $cli->trash = 1;
        $cli->save();
    }
}
