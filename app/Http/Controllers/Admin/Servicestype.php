<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ServicestypeDataTable;
use Carbon\Carbon;
use App\Models\Servicetype;

use App\Http\Controllers\Validations\ServicestypeRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Servicestype extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:servicestype_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:servicestype_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:servicestype_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:servicestype_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(ServicestypeDataTable $servicestype)
            {
               return $servicestype->render('admin.servicestype.index',['title'=>trans('admin.servicestype')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.servicestype.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(ServicestypeRequest $request)
            {
                $data = $request->except("_token", "_method");
            	$data['admin_id'] = admin()->id(); 
		  		$servicestype = Servicetype::create($data); 

			return successResponseJson([
				"message" => trans("admin.added"),
				"data" => $servicestype,
			]);
			 }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$servicestype =  Servicetype::find($id);
        		return is_null($servicestype) || empty($servicestype)?
        		backWithError(trans("admin.undefinedRecord"),aurl("servicestype")) :
        		view('admin.servicestype.show',[
				    'title'=>trans('admin.show'),
					'servicestype'=>$servicestype
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$servicestype =  Servicetype::find($id);
        		return is_null($servicestype) || empty($servicestype)?
        		backWithError(trans("admin.undefinedRecord"),aurl("servicestype")) :
        		view('admin.servicestype.edit',[
				  'title'=>trans('admin.edit'),
				  'servicestype'=>$servicestype
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
				foreach (array_keys((new ServicestypeRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(ServicestypeRequest $request,$id)
            {
              // Check Record Exists
              $servicestype =  Servicetype::find($id);
              if(is_null($servicestype) || empty($servicestype)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("servicestype"));
              }
              $data = $this->updateFillableColumns(); 
              $data['admin_id'] = admin()->id(); 
              Servicetype::where('id',$id)->update($data);

              $servicestype = Servicetype::find($id);
              return successResponseJson([
               "message" => trans("admin.updated"),
               "data" => $servicestype,
              ]);
			}

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$servicestype = Servicetype::find($id);
		if(is_null($servicestype) || empty($servicestype)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("servicestype"));
		}
               
		it()->delete('servicetype',$id);
		$servicestype->delete();
		return redirectWithSuccess(aurl("servicestype"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$servicestype = Servicetype::find($id);
				if(is_null($servicestype) || empty($servicestype)){
					return backWithError(trans('admin.undefinedRecord'),aurl("servicestype"));
				}
                    	
				it()->delete('servicetype',$id);
				$servicestype->delete();
			}
			return redirectWithSuccess(aurl("servicestype"),trans('admin.deleted'));
		}else {
			$servicestype = Servicetype::find($data);
			if(is_null($servicestype) || empty($servicestype)){
				return backWithError(trans('admin.undefinedRecord'),aurl("servicestype"));
			}
                    
			it()->delete('servicetype',$data);
			$servicestype->delete();
			return redirectWithSuccess(aurl("servicestype"),trans('admin.deleted'));
		}
	}
            

}