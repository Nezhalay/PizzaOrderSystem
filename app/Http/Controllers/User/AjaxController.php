<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'desc'){
            $data = product::orderBy('created_at','desc')->get();
        }else{
            $data = product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

        // pizza add to card
        public function addToCard(Request $request){
            $data =$this->getOrderData($request);
            // return back();
            logger($data);
        }

        private function getOrderData($request){
            return[
                'user_id'    =>$request->userId,
                'product_id' =>$request->pizzaId,
                'qty'        =>$request->count,
                'created_at' =>Carbon::now(),
                'updated_at' =>Carbon::now(),

            ];
        }
}
