<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\SizesDataTable;
use Carbon\Carbon;
use App\Models\Size;

use App\Http\Controllers\Validations\SizesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Sizes extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:sizes_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:sizes_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:sizes_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:sizes_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(SizesDataTable $sizes)
            {
               return $sizes->render('admin.sizes.index',['title'=>trans('admin.sizes')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.sizes.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(SizesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$sizes = Size::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('sizes'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$sizes =  Size::find($id);
        		return is_null($sizes) || empty($sizes)?
        		backWithError(trans("admin.undefinedRecord"),aurl("sizes")) :
        		view('admin.sizes.show',[
				    'title'=>trans('admin.show'),
					'sizes'=>$sizes
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$sizes =  Size::find($id);
        		return is_null($sizes) || empty($sizes)?
        		backWithError(trans("admin.undefinedRecord"),aurl("sizes")) :
        		view('admin.sizes.edit',[
				  'title'=>trans('admin.edit'),
				  'sizes'=>$sizes
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
				foreach (array_keys((new SizesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(SizesRequest $request,$id)
            {
              // Check Record Exists
              $sizes =  Size::find($id);
              if(is_null($sizes) || empty($sizes)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("sizes"));
              }
              $data = $this->updateFillableColumns(); 
              Size::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('sizes'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$sizes = Size::find($id);
		if(is_null($sizes) || empty($sizes)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("sizes"));
		}
               
		it()->delete('size',$id);
		$sizes->delete();
		return redirectWithSuccess(aurl("sizes"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$sizes = Size::find($id);
				if(is_null($sizes) || empty($sizes)){
					return backWithError(trans('admin.undefinedRecord'),aurl("sizes"));
				}
                    	
				it()->delete('size',$id);
				$sizes->delete();
			}
			return redirectWithSuccess(aurl("sizes"),trans('admin.deleted'));
		}else {
			$sizes = Size::find($data);
			if(is_null($sizes) || empty($sizes)){
				return backWithError(trans('admin.undefinedRecord'),aurl("sizes"));
			}
                    
			it()->delete('size',$data);
			$sizes->delete();
			return redirectWithSuccess(aurl("sizes"),trans('admin.deleted'));
		}
	}
            

}