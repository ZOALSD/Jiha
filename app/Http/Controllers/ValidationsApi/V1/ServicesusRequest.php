<?php
namespace App\Http\Controllers\ValidationsApi\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicesusRequest extends FormRequest {

	/**
	 * Baboon Script By [it v 1.6.40]
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Baboon Script By [it v 1.6.40]
	 * Get the validation rules that apply to the request.
	 *
	 * @return array (onCreate,onUpdate,rules) methods
	 */
	protected function onCreate() {
		return [
             'user_id'=>'sometimes|nullable|integer',
             'services_type_id'=>'required|integer',
             'name'=>'required|string',
             'image_ID'=>'required|image',
             'shop_name'=>'sometimes|nullable|string',
             'phone'=>'required|integer',
             'other_phone'=>'sometimes|nullable|integer',
		];
	}


	protected function onUpdate() {
		return [
             'user_id'=>'sometimes|nullable|integer',
             'services_type_id'=>'required|integer',
             'name'=>'required|string',
             'image_ID'=>'required|image',
             'shop_name'=>'sometimes|nullable|string',
             'phone'=>'required|integer',
             'other_phone'=>'sometimes|nullable|integer',
		];
	}

	public function rules() {
		return request()->isMethod('put') || request()->isMethod('patch') ?
		$this->onUpdate() : $this->onCreate();
	}


	/**
	 * Baboon Script By [it v 1.6.40]
	 * Get the validation attributes that apply to the request.
	 *
	 * @return array
	 */
	public function attributes() {
		return [
             'user_id'=>trans('admin.user_id'),
             'services_type_id'=>trans('admin.services_type_id'),
             'name'=>trans('admin.name'),
             'image_ID'=>trans('admin.image_ID'),
             'shop_name'=>trans('admin.shop_name'),
             'phone'=>trans('admin.phone'),
             'other_phone'=>trans('admin.other_phone'),
		];
	}

	/**
	 * Baboon Script By [it v 1.6.40]
	 * response redirect if fails or failed request
	 *
	 * @return redirect
	 */
	public function response(array $errors) {
		return $this->ajax() || $this->wantsJson() ?
		response([
			'status' => false,
			'StatusCode' => 422,
			'StatusType' => 'Unprocessable',
			'errors' => $errors,
		], 422) :
		back()->withErrors($errors)->withInput(); // Redirect back
	}



}