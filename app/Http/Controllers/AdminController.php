<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //changePage
    public function changePage(){
        return view('admin.account.changePassword');
     }

    //ChangePassword
    public function changePassword(Request $request){
        /*
        1.all field must be fill
        2.changePassword length must be greater than 6
        3.new & confirm psaaword must be same
        4.client oldPassword must be same with dataBase Password
        5.password change
        */
        $this->passwordValidationCheck($request);

        $user =User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue =$user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data =[
                'password'=> Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            // return redirect('/');
            return back()->with(['changeSuccess'=>'Password Change Success...']);
        }
        return back()->with(['notMatch'=>'The old password not match. Try Again!']);
    }

    //direct admin details Page
    public function details(){
        return view('admin.account.details');
    }

    //admin Profile page
    public function edit(){
        return view('admin.account.edit');
    }

    // Admin list
    public function list(){
        $admin = user::when(request('key'),function ($query){
            $query ->orWhere('name','like','%' .request('key').'%')
                    ->orWhere('email','like','%' .request('key').'%')
                    ->orWhere('gender','like','%' .request('key').'%')
                    ->orWhere('phone','like','%' .request('key').'%')
                    ->orWhere('address','like','%' .request('key').'%');
        })
        ->where('role','admin')
        ->paginate('3');
        $admin->appends(request()->all());
        return view('admin.account.adminList',compact('admin'));

    }

    // Admin delete
    public function delete($id){
        user::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Product delete success...']);
    }

    // Change Role
    public function changeRole($id){
        $account = user::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    // Change
    public function change($id
    ,Request $request){
        $data = $this->requestUserData($request);
        user::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }
    // change RequestUserData
    private function requestUserData($request){
        return [
          'role' => $request ->role
        ];
    }

    //admin Profile update
    public function update($id,Request $request){
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
        return redirect()->route('admin#details')->with(['UpdateSuccess'=>'Admin Account Update...']);

    }

    //admin request user data
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

    //admin update validation check
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
