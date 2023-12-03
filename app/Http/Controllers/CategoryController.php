<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category
    public function list(){
        $categories = category::when( request('key'),function($query){
                      $query->where('name','like','%'.request('key').'%');
                    })
                    ->orderBy('category_id','desc')
                    ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

     //add category page
     public function createPage(){
        return view('admin.category.create');
    }

    // category create
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        category::create($data);
        return redirect()->route('category#list');
    }

    //category delete
    public function delete($id){
        category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted...']);
    }

    //category Edit
    public function edit($id){
        $category = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //category Update
    public function update($id,Request $request){
        // dd($id,$request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        category::where('category_id',$id)->update($data);
        return redirect()->route('category#list');
    }

    //category ValidationCheck
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|min:4|unique:categories,name'   //min:value ကအနည်းဆုံး၄လုံး(သို့)၅လူံးသတ်မှတ်ပေး
        ])->validate();
    }

    //category request
    private function requestCategoryData($request){
        return[
            'name' => $request ->categoryName
        ];
    }
    
}
