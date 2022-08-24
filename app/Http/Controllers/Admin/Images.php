<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ImagesDataTable;
use Carbon\Carbon;
use App\Models\Image;

use App\Http\Controllers\Validations\ImagesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Images extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:images_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:images_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:images_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:images_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(ImagesDataTable $images)
            {
               return $images->render('admin.images.index',['title'=>trans('admin.images')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.images.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(ImagesRequest $request)
            {
                $data = $request->except("_token", "_method");
            	$data['image'] = "";
		  		$images = Image::create($data); 
               if(request()->hasFile('image')){
              $images->image = it()->upload('image','images/'.$images->id);
              $images->save();
              }
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('images'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$images =  Image::find($id);
        		return is_null($images) || empty($images)?
        		backWithError(trans("admin.undefinedRecord"),aurl("images")) :
        		view('admin.images.show',[
				    'title'=>trans('admin.show'),
					'images'=>$images
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$images =  Image::find($id);
        		return is_null($images) || empty($images)?
        		backWithError(trans("admin.undefinedRecord"),aurl("images")) :
        		view('admin.images.edit',[
				  'title'=>trans('admin.edit'),
				  'images'=>$images
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function updateFillableColumns() {
				$fillableCols = [];
				foreach (array_keys((new ImagesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(ImagesRequest $request,$id)
            {
              // Check Record Exists
              $images =  Image::find($id);
              if(is_null($images) || empty($images)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("images"));
              }
              $data = $this->updateFillableColumns(); 
               if(request()->hasFile('image')){
              it()->delete($images->image);
              $data['image'] = it()->upload('image','images');
               } 
              Image::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('images'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$images = Image::find($id);
		if(is_null($images) || empty($images)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("images"));
		}
               		if(!empty($images->image)){
			it()->delete($images->image);		}

		it()->delete('image',$id);
		$images->delete();
		return redirectWithSuccess(aurl("images"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$images = Image::find($id);
				if(is_null($images) || empty($images)){
					return backWithError(trans('admin.undefinedRecord'),aurl("images"));
				}
                    					if(!empty($images->image)){
				  it()->delete($images->image);
				}
				it()->delete('image',$id);
				$images->delete();
			}
			return redirectWithSuccess(aurl("images"),trans('admin.deleted'));
		}else {
			$images = Image::find($data);
			if(is_null($images) || empty($images)){
				return backWithError(trans('admin.undefinedRecord'),aurl("images"));
			}
                    
			if(!empty($images->image)){
			 it()->delete($images->image);
			}			it()->delete('image',$data);
			$images->delete();
			return redirectWithSuccess(aurl("images"),trans('admin.deleted'));
		}
	}
            

}