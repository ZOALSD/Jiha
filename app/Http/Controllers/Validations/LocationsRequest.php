<?php
namespace App\Http\Controllers\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationsRequest extends FormRequest {

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
             'days_wrok'=>'required|array',
             'location'=>'required|string',
             'phone'=>'required',
             'lat'=>'string',
             'lng'=>'string',
             'hour_start'=>'required',
             'hour_end'=>'required',
		];
	}

	protected function onUpdate() {
		return [
             'days_wrok'=>'required|array',
             'location'=>'required|string',
			 'phone'=>'required',
             'lat'=>'string',
             'lng'=>'string',
             'hour_start'=>'required',
             'hour_end'=>'required',
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
             'days_wrok'=>trans('admin.days_wrok'),
             'location'=>trans('admin.location'),
             'phone'=>trans('admin.phone'),
             'lat'=>trans('admin.lat'),
             'lng'=>trans('admin.lng'),
             'hour_start'=>trans('admin.hour_start'),
             'hour_end'=>trans('admin.hour_end'),
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