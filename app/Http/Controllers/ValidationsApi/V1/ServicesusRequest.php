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
             'category_id'=>'required|integer',
             'available'=>'required|string|in:1,0',
             'price'=>'required|numeric',
             'delivery'=>'required|numeric|in:1,0',
             'disc'=>'sometimes|nullable|string',
             'image'=>'sometimes|nullable|file|image',
             'title'=>'sometimes|nullable|string',
		];
	}


	protected function onUpdate() {
		return [
             'category_id'=>'required|integer',
             'available'=>'required|string|in:1,0',
             'price'=>'required|numeric',
             'delivery'=>'required|numeric|in:1,0',
             'disc'=>'sometimes|nullable|string',
             'image'=>'sometimes|nullable|file|image',
             'title'=>'sometimes|nullable|string',
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
             'category_id'=>trans('admin.category_id'),
             'available'=>trans('admin.available'),
             'price'=>trans('admin.price'),
             'delivery'=>trans('admin.delivery'),
             'disc'=>trans('admin.disc'),
             'image'=>trans('admin.image'),
             'title'=>trans('admin.title'),
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