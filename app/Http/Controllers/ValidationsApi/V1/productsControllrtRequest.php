<?php

namespace App\Http\Controllers\ValidationsApi\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class productsControllrtRequest extends FormRequest
{

	/**
	 * Baboon Script By [it v 1.6.40]
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Baboon Script By [it v 1.6.40]
	 * Get the validation rules that apply to the request.
	 *
	 * @return array (onCreate,onUpdate,rules) methods
	 */
	protected function onCreate()
	{
		return [
			'name' => 'required|string',
			'price' => 'sometimes|nullable',
			'category_id' => 'sometimes|nullable|numeric',
			'image' => 'sometimes|nullable|file|image',
			'colors' => 'required',
			'sizes' => 'required|string',
			'desc_en' => 'required|string',
			'desc_ar' => 'required|string',
			'available' => 'required',
		];
	}

	protected function onUpdate()
	{
		return [
			'name' => 'sometimes|string',
			'price' => 'sometimes|nullable|integer',
			'category_id' => 'sometimes|nullable|numeric',
			'image' => 'sometimes|nullable|file|image',
			'colors' => 'sometimes',
			'sizes' => 'sometimes|string',
			'desc_en' => 'sometimes|string',
			'desc_ar' => 'sometimes',
			'available' => 'sometimes'

		];
	}


	public function rules()
	{
		return request()->isMethod('put') || request()->isMethod('patch') ?
			$this->onUpdate() : $this->onCreate();
	}


	/**
	 * Baboon Script By [it v 1.6.40]
	 * Get the validation attributes that apply to the request.
	 *
	 * @return array
	 */
	public function attributes()
	{
		return [
			'name' => trans('admin.name'),
			'price' => trans('admin.price'),
			'category_id' => trans('admin.category_id'),
			'image' => trans('admin.image'),
			'colors' => trans('admin.color'),
			'sizes' => trans('admin.size_id'),
			'desc_en' => trans('admin.desc_en'),
			'desc_ar' => trans('admin.desc_ar'),
			'available' => 'available',
		];
	}

	/**
	 * Baboon Script By [it v 1.6.40]
	 * response redirect if fails or failed request
	 *
	 * @return redirect
	 */
	public function response(array $errors)
	{
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
