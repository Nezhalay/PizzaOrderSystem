<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        // $pizzas =product::get();
        $pizzas =product::select('products.*','categories.name as category_name')
                    ->when(request('key'),function($query){
                $query->where('products.name','like','%'.request('key').'%');
                })
                    ->leftJoin('categories','products.category_id','categories.category_id')
                    ->orderBy('products.created_at','desc')
                    ->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //pizza createPage
    public function createPage(){
        $categories =category::select('category_id','name')->get();
        return view('admin.product.createPage',compact('categories'));
    }

    //delete product
    public function delete($id){
        product::where('category_id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product delete success...']);
    }

    //Edit product
    public function edit($id){
        $pizza = product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.category_id')
                ->where('products.category_id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    // Update pizza product
    public function updatePage($id){
        $pizza = product::where('id',$id)->first();
        $category = category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //create product
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);

        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName ;

        product::create($data);
        return redirect()->route('product#list');
    }

     //update pizza product(click btn)
     public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data  = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = product::where('id',$request->ID)->first();
            $oldImageName = $oldImageName ->image ;

            if($oldImageName !=null ){
                Storage::delete(['public/'.$oldImageName]);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request ->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] =$fileName;              //database's image
        }

        product::where('id',$request->ID)->update($data);
        return redirect()->route('product#list');
    }


    private function requestProductInfo($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time'=> $request->waitingTime,

        ];
    }

    //create Valication
    private function productValidationCheck($request,$action){
        $validationRules = [

            'pizzaName' => 'required|min:5|unique:products,name,'.$request->ID,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'waitingTime' => 'required',
        ];

        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,png,jpeg,webp|file': 'mimes:jpg,png,jpeg,webp|file';
        // dd($validationRules);
        Validator::make($request->all(), $validationRules )->validate();
    }
}





 // 'pizzaImage' => 'required|mimes:jpg,png,jpeg,webp|file',

// if($request->hasFile('pizzaImage')){
        //             $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        //             $request->file('pizzaImage')->storeAs('public',$fileName);
        //             $data['image']=$fileName ;
        //         }


