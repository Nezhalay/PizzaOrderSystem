<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\User\UserController;

class UserController extends Controller
{
    public function home(){
        $pizza =product::orderBy('id','desc')->get();
        $category =category::get();
        return view('user.main.homePg',compact('pizza','category'));
    }

    public function changeAccountPage(){
        return view('user.account.changeAccount');
    }

    public function changePasswordPage(){
        return view('user.password.changePassword');
    }

    // pizza drtails
    public function pizzaDetails($pizzaId){
        $pizza =product::where('id',$pizzaId)->first();
        $pizzaList =product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //fulter count
    public function filter($categoryId){
        $pizza =product::where('category_id',$categoryId)->orderBy('id','desc')->get();
        $category =category::get();
        return view('user.main.homePg',compact('pizza','category'));
    }

    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user =User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue =$user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data =[
                'password'=> Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changeSuccess'=>'Password Change Success...']);
        }
        return back()->with(['notMatch'=>'The old password not match. Try Again!']);
    }

    //user account change
    public function changeAccount($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if($request->hasFile('image')){
            //1 old image name| check => delete | store
            $dbImage =User::where('id',$id)->first();
            $dbImage= $dbImage->image;

            if($dbImage != null){
                Storage::delete(['public/'.$dbImage]);
            }

            $fileName =uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['AccountSuccess'=>'Change Account Success...']);

    }

    //account request user data
    private function getUserData($request){
        return [
            'name' => $request ->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' =>$request->gender,
            'address' =>$request->address,
            'updated_at' =>Carbon::now(),
        ];
    }

    //user account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image'  => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }

    //Change Password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
