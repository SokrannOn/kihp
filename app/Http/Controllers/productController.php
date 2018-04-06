<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Categoryproduct;
use App\Language;
use App\Photoproduct;
use App\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class productController extends Controller
{

    public function index()
    {
        return view('admin.product.view');
    }

    public function getViewContent(){
        $locale = Lang::locale();
        $lang = Language::where('code',$locale)->value('id');
        $language = Language::find($lang);
        $pro = $language->products()->where('trash',0)->get();
        return view('admin.product.content_view',compact('pro','lang'));
    }

    public function detail($id){
        $locale = Lang::locale();
        $lang = Language::where('code',$locale)->value('id');
        $language = Language::find($lang);
        $pro = $language->products()->where('products.id',$id)->get();
        return view('admin.product.detail',compact('pro','lang'));
    }

    public function create(Request $request)
    {

        $selectBrand =null;
        $selectCategory = null;
        $selectLang = null;
        $locale = Lang::locale();
        $id   = Language::where('code',$locale)->value('id');
        $la = Language::find($id);
        $lang =[];
        if($request->session()->has('productLanguage')){
            $langId= $request->session()->get('productLanguage');
            $selectLang =Language::where('active',1)->whereNotIn('id',$langId)->value('id');
            $lang   = Language::where('active',1)->whereNotIn('id',$langId)->pluck('name','id');
        }else{
            $lang   = Language::where('active',1)->pluck('name','id');
        }
        if ($request->session()->has('productid')){
            $id = $request->session()->get('productid');
            $product = Product::find($id['id']);
            $selectBrand= $product->brand_id;
            $selectCategory=$product->categoryproduct_id;
        }
        $brand  = Brand::where('active',1)->pluck('name','id');
        $categoryProduct = $la->categoryproducts()->pluck('name','categoryproducts.id');
        return view('admin.product.create',compact('lang','brand','categoryProduct','att','selectBrand','selectCategory','selectLang'));
    }


    public function store(Request $request)
    {

       $this->validate($request,[
          'mainphoto'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:8000'
       ],[
           'mainphoto.required'=>'Main photo is required',
           'mainphoto.size'=>'Your image big than 2M',
           'description'=>'Description required'
       ]);
        $language = $request->input('language_id');
        if($request->session()->has('productLanguage')){
            $ne = $request->session()->get('productLanguage');
            $request->session()->put('productLanguage',$ne+[$language=>$language]);
        }else{
            $request->session()->put('productLanguage',[$language=>$language]);
        }
        $proId = $request->session()->get('productid');
        $filter = $request->session()->get('productLanguage');
        $filterLanguage = Language::whereNotIn('id',$filter)->get();
        if(!count($filterLanguage)){
            $request->session()->forget('productLanguage');
            $request->session()->forget('productid');
        }
       $pro = Product::find($proId['id']);
       if(!count($pro)){

           $time =Carbon::now()->toDateString();
           $name="default.png";
           if($file =$request->file('mainphoto')){
               $name=$time."_".$file->getClientOriginalName();
               $file->move('mainProduct',$name);
           }
           $product = new Product();
           $product->brand_id = $request->input('brand');
           $product->photo = $name;
           $product->categoryproduct_id = $request->input('categoryproduct_id');
           if($request->input('publish')=='on'){
               $product->publish =1;
           }else{
               $product->publish =0;
           }
           $product->trash=0;
           $product->user_id = Auth::user()->id;
           $product->save();
           $id = $product->id;
           if($request->file('picdetail')){
               foreach ($request->file('picdetail') as $fileDetail){
                   if(!empty($fileDetail)){
                       $filename = $fileDetail->getClientOriginalName();
                       $fileDetail->move('picDetailProduct',$filename);
                       $dePro = new Photoproduct();
                       $dePro->product_id = $id;
                       $dePro->name = $filename;
                       $dePro->save();
                   }
               }
           }
           $request->session()->put('productid',['id'=>$id]);
           $product->languages()->attach($language,['name'=>$request->input('name'),'description'=>$request->input('description')]);
       }else{
           $pro->languages()->attach($language,['name'=>$request->input('name'),'description'=>$request->input('description')]);
       }
       return redirect()->back();
    }


    public function show($id)
    {
        $pro = Product::find($id);
        $pro->trash = 1;
        $pro->save();
    }


    public function edit($id)
    {
        $allLang = Language::where('active',1)->pluck('name','id');
        $brand = Brand::where('active',1)->pluck('name','id');
        $product = Product::find($id);
        $locale = Lang::locale();
        $lang = Language::where('code',$locale)->value('id');
        $language = Language::find($lang);
        $category = $language->categoryproducts()->pluck('name','categoryproducts.id');
        $pro = $language->products()->where('products.id',$id)->get();
        return view('admin.product.edit',compact('lang','allLang','category','product','brand','pro'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'mainphoto'=>'image|mimes:jpg,png,jpeg,gif,svg|max:8000',
            'name'=>'required'
        ],[
            'mainphoto.size'=>'Your image big than 2M',
            'description'=>'Description required',
            'name'=>'name required'
        ]);

        $ds = DIRECTORY_SEPARATOR;
        $product = Product::find($id);
        $oldpic =$product->photo;
        $time =Carbon::now()->toDateString();
        $name="default.png";
        if($file =$request->file('mainphoto')){
            unlink(public_path('mainProduct'.$ds.$oldpic));
            $name=$time."_".$file->getClientOriginalName();
            $file->move('mainProduct',$name);
            $product->photo = $name;
        }
        $product->brand_id = $request->input('brand_id');
        $product->categoryproduct_id = $request->input('categoryproduct_id');
        if($request->input('publish')=='on'){
            $product->publish =1;
        }else{
            $product->publish =0;
        }
        $product->user_id = Auth::user()->id;
        $product->save();
        $productID = $product->id;
        DB::table('language_product')->where([['product_id',$productID],['language_id',$request->input('language_id')]])->update(['name'=>$request->input('name'),'description'=>$request->input('description')]);
        if($request->file('picdetail')){
            foreach ($request->file('picdetail') as $fileDetail){
                if(!empty($fileDetail)){
                    $filename = $fileDetail->getClientOriginalName();
                    $fileDetail->move('picDetailProduct',$filename);
                    $dePro = new Photoproduct();
                    $dePro->product_id = $productID;
                    $dePro->name = $filename;
                    $dePro->save();
                }
            }
        }
        return redirect()->route('product.index');
    }

    public function deletImgdetail($id){
        $ds = DIRECTORY_SEPARATOR;
        $pho = Photoproduct::find($id);
        $name = $pho->name;
        if(count($pho)){
            unlink(public_path('picDetailProduct'.$ds.$name));
            $pho->delete();
        }


    }


    public function destroy($id)
    {
        //
    }
}
