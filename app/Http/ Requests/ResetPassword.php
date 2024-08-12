<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest {

	/**
	 * determine if the user is unthorized to make this request.
	 * 
	 * @return bool
	 */
	 public function authorize(){
	 	return true;
	 }

	 /**
	  * get the validation rules that apply to the request.
	  * 
	  *  @return array
	  */

	 public function rules(){
	 	return[
	 		'password' => 'required|min:6',
	 		'confirm_password' => 'required|min:6|same:password']
	 }

}
?>