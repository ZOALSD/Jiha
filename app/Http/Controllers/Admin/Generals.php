<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\GeneralsDataTable;
use Carbon\Carbon;
use App\Models\General;

use App\Http\Controllers\Validations\GeneralsRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Generals extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:generals_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:generals_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:generals_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:generals_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(GeneralsDataTable $generals)
            {
               return $generals->render('admin.generals.index',['title'=>trans('admin.generals')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.generals.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(GeneralsRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$generals = General::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('generals'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$generals =  General::find($id);
        		return is_null($generals) || empty($generals)?
        		backWithError(trans("admin.undefinedRecord"),aurl("generals")) :
        		view('admin.generals.show',[
				    'title'=>trans('admin.show'),
					'generals'=>$generals
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$generals =  General::find($id);
        		return is_null($generals) || empty($generals)?
        		backWithError(trans("admin.undefinedRecord"),aurl("generals")) :
        		view('admin.generals.edit',[
				  'title'=>trans('admin.edit'),
				  'generals'=>$generals
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
				foreach (array_keys((new GeneralsRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(GeneralsRequest $request,$id)
            {
              // Check Record Exists
              $generals =  General::find($id);
              if(is_null($generals) || empty($generals)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("generals"));
              }
              $data = $this->updateFillableColumns(); 
              General::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('generals'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$generals = General::find($id);
		if(is_null($generals) || empty($generals)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("generals"));
		}
               
		it()->delete('general',$id);
		$generals->delete();
		return redirectWithSuccess(aurl("generals"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$generals = General::find($id);
				if(is_null($generals) || empty($generals)){
					return backWithError(trans('admin.undefinedRecord'),aurl("generals"));
				}
                    	
				it()->delete('general',$id);
				$generals->delete();
			}
			return redirectWithSuccess(aurl("generals"),trans('admin.deleted'));
		}else {
			$generals = General::find($data);
			if(is_null($generals) || empty($generals)){
				return backWithError(trans('admin.undefinedRecord'),aurl("generals"));
			}
                    
			it()->delete('general',$data);
			$generals->delete();
			return redirectWithSuccess(aurl("generals"),trans('admin.deleted'));
		}
	}
            

}