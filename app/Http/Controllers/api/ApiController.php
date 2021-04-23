<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Traits\GeneralTrait;

class ApiController extends Controller
{
	use GeneralTrait;

    public function getcategories(){
      $categories = Category::select('id','name_'.app()->getLocale().' as name','slug_'.app()->getLocale().' as slug')->get();

      return response()->json($categories);
    }

    public function getcategory(Request $request){
      $category = Category::select('id','name_'.app()->getLocale().' as name','slug_'.app()->getLocale().' as slug')->where('id',$request->id)->first();
      if(!$category)
      	 return  $this->returnError("E1001","not found");

      return $this->returnData("category",$category,"success option");
    }


    public function dologin(Request $request){
       try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

             $credentials = $request -> only(['email','password']) ;

           $token =  \Auth::guard('admin-api')->attempt($credentials);

           if(!$token)
               return $this->returnError('E001','بيانات الدخول غير صحيحة');

             $admin = \Auth::guard('admin-api')->user();
             $admin->api_token = $token;
            //return token
             return $this -> returnData('admin' , $admin);

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}
