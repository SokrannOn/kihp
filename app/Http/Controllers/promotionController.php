<?php

namespace App\Http\Controllers;

use App\Category;
use App\Language;
use App\Promotion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class promotionController extends Controller
{

    public function index()
    {
        return view('admin.promotion.view');
    }

    public function viewPro(Request $request,$id){
        $locale = Lang::locale();
        $lid = Language::where('code',$locale)->value('id');
        $language = Language::find($lid);
        $promotion = Promotion::find($id);
        $promo = $language->promotions()->where('promotions.id',$id)->get();
        return view('admin.promotion.detail',compact('promo','promotion'));
    }

    public function viewList(){
        $locale = Lang::locale();
        $lid = Language::where('code',$locale)->value('id');
        $language = Language::find($lid);
        $promo = $language->promotions()->where('trash',0)->get();
        return view('admin.promotion.content_view',compact('promo','lid'));
    }

    public function create(Request $request)
    {
        $cId =null;
        $locale = Lang::locale();
        $lid = Language::where('code',$locale)->value('id');
        $language = Language::find($lid);
        $lang = Language::where('active',1)->pluck('name','id');
        if($request->session()->has('languagePromotion')){
            $filtLang = $request->session()->get('languagePromotion');
            $lang = Language::whereNotIn('id',$filtLang)->pluck('name','id');
            $categoryId =$request->session()->get('idCategoryPromotion');
            $cId = $categoryId['id'];
        }
        $category = $language->categories()->pluck('name','categories.id');
        return view('admin.promotion.create',compact('lang','category','cId'));
    }


    public function store(Request $request)
    {
       $this->validate($request,[
          'language_id'     =>'required',
           'category_id'    =>'required',
           'name'           =>'required',
           'description'    =>'required'
       ],[
           'language_id.required'=>'language required',
           'category_id.required'=>'Category required',
           'name.required'=>'Name required',
           'description.required'=>'required'
       ]);
       $languageId = $request->input('language_id');
       if ($request->session()->has('languagePromotion')){
           $getLag = $request->session()->get('languagePromotion');
           $request->session()->put('languagePromotion',[$languageId=>$languageId]+$getLag);
       }else{
           $request->session()->put('languagePromotion',[$languageId=>$languageId]);
       }
       $promoId = $request->session()->get('promotionId');
       $filtLang = $request->session()->get('languagePromotion');
       $countLang = Language::whereNotIn('id',$filtLang)->get();
        if(!count($countLang)){
            $request->session()->forget('languagePromotion');
            $request->session()->forget('promotionId');
            $request->session()->forget('idCategoryPromotion');
        }
        $promotion = Promotion::find($promoId['id']);
        if(!count($promotion)){
            $p = new Promotion();
            $p->date = Carbon::now()->toDateString();
            if($request->input('publish')=='on'){
                $p->publish =1;
            }else{
                $p->publish =0;
            }
            $p->category_id = $request->input('category_id');
            $p->trash = 0;
            $p->user_id=Auth::user()->id;
            $p->user_modify = 0;
            $p->save();
            $id = $p->id;
            $request->session()->put('idCategoryPromotion',['id'=>$request->input('category_id')]);
            $request->session()->put('promotionId',['id'=>$id]);
            $p->languages()->attach($languageId,['name'=>$request->input('name'),'description'=>$request->input('description')]);
        }else{
            $promotion->languages()->attach($languageId,['name'=>$request->input('name'),'description'=>$request->input('description')]);
        }
        return redirect()->back();
    }


    public function show($id)//Update trash to true
    {
        $promo = Promotion::find($id);
        $promo->trash = 1;
        $promo->save();
    }

    public function edit($id)
    {
        $locale = Lang::locale();
        $lid = Language::where('code',$locale)->value('id');
        $language = Language::find($lid);
        $lang = Language::where('active',1)->pluck('name','id');
        $promotion = Promotion::find($id);
        $category = $language->categories()->where('trash',0)->pluck('name','categories.id');
        $promo = $language->promotions()->where('promotions.id',$id)->get();
        return view('admin.promotion.edit',compact('promo','lang','promotion','lid','category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'language_id'     =>'required',
            'category_id'    =>'required',
            'name'           =>'required',
            'description'    =>'required'
        ],[
            'language_id.required'=>'language required',
            'category_id.required'=>'Category required',
            'name.required'=>'Name required',
            'description.required'=>'required'
        ]);
        $name = $request->input('name');
        $description = $request->input('description');
        $p = Promotion::find($id);
        $p->date = Carbon::now()->toDateString();
        if($request->input('publish')=='on'){
            $p->publish =1;
        }else{
            $p->publish =0;
        }
        $p->category_id = $request->input('category_id');
        $p->user_modify = Auth::user()->id;;
        $p->save();
        $id = $p->id;
        DB::table('language_promotion')->where([['language_id',$request->input('language_id')],['promotion_id',$id]])->update(['name'=>$name,'description'=>$description]);
        return redirect()->route('promotion.index');
    }

    public function destroy($id)
    {
        //
    }
}
