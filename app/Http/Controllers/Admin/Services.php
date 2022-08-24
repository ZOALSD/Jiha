<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ServicesDataTable;
use Carbon\Carbon;
use App\Models\Service;

use App\Http\Controllers\Validations\ServicesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Services extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:services_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:services_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:services_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:services_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(ServicesDataTable $services)
            {
               return $services->render('admin.services.index',['title'=>trans('admin.services')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.services.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(ServicesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$services = Service::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('services'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$services =  Service::find($id);
        		return is_null($services) || empty($services)?
        		backWithError(trans("admin.undefinedRecord"),aurl("services")) :
        		view('admin.services.show',[
				    'title'=>trans('admin.show'),
					'services'=>$services
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$services =  Service::find($id);
        		return is_null($services) || empty($services)?
        		backWithError(trans("admin.undefinedRecord"),aurl("services")) :
        		view('admin.services.edit',[
				  'title'=>trans('admin.edit'),
				  'services'=>$services
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
				foreach (array_keys((new ServicesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(ServicesRequest $request,$id)
            {
              // Check Record Exists
              $services =  Service::find($id);
              if(is_null($services) || empty($services)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("services"));
              }
              $data = $this->updateFillableColumns(); 
              Service::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('services'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$services = Service::find($id);
		if(is_null($services) || empty($services)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("services"));
		}
               
		it()->delete('service',$id);
		$services->delete();
		return redirectWithSuccess(aurl("services"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$services = Service::find($id);
				if(is_null($services) || empty($services)){
					return backWithError(trans('admin.undefinedRecord'),aurl("services"));
				}
                    	
				it()->delete('service',$id);
				$services->delete();
			}
			return redirectWithSuccess(aurl("services"),trans('admin.deleted'));
		}else {
			$services = Service::find($data);
			if(is_null($services) || empty($services)){
				return backWithError(trans('admin.undefinedRecord'),aurl("services"));
			}
                    
			it()->delete('service',$data);
			$services->delete();
			return redirectWithSuccess(aurl("services"),trans('admin.deleted'));
		}
	}
            

}