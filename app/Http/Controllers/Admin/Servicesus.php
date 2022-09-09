<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ServicesusDataTable;
use Carbon\Carbon;
use App\Models\Serviceus;

use App\Http\Controllers\Validations\ServicesusRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Servicesus extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:servicesus_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:servicesus_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:servicesus_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:servicesus_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(ServicesusDataTable $servicesus)
            {
               return $servicesus->render('admin.servicesus.index',['title'=>trans('admin.servicesus')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.servicesus.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(ServicesusRequest $request)
            {
                $data = $request->except("_token", "_method");
            	$data['image'] = "";
		  		$servicesus = Serviceus::create($data); 
               if(request()->hasFile('image')){
              $servicesus->image = it()->upload('image','servicesus/'.$servicesus->id);
              $servicesus->save();
              }

			return successResponseJson([
				"message" => trans("admin.added"),
				"data" => $servicesus,
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
        		$servicesus =  Serviceus::find($id);
        		return is_null($servicesus) || empty($servicesus)?
        		backWithError(trans("admin.undefinedRecord"),aurl("servicesus")) :
        		view('admin.servicesus.show',[
				    'title'=>trans('admin.show'),
					'servicesus'=>$servicesus
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$servicesus =  Serviceus::find($id);
        		return is_null($servicesus) || empty($servicesus)?
        		backWithError(trans("admin.undefinedRecord"),aurl("servicesus")) :
        		view('admin.servicesus.edit',[
				  'title'=>trans('admin.edit'),
				  'servicesus'=>$servicesus
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
				foreach (array_keys((new ServicesusRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(ServicesusRequest $request,$id)
            {
              // Check Record Exists
              $servicesus =  Serviceus::find($id);
              if(is_null($servicesus) || empty($servicesus)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("servicesus"));
              }
              $data = $this->updateFillableColumns(); 
               if(request()->hasFile('image')){
              it()->delete($servicesus->image);
              $data['image'] = it()->upload('image','servicesus');
               } 
              Serviceus::where('id',$id)->update($data);

              $servicesus = Serviceus::find($id);
              return successResponseJson([
               "message" => trans("admin.updated"),
               "data" => $servicesus,
              ]);
			}

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$servicesus = Serviceus::find($id);
		if(is_null($servicesus) || empty($servicesus)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("servicesus"));
		}
               		if(!empty($servicesus->image)){
			it()->delete($servicesus->image);		}

		it()->delete('serviceus',$id);
		$servicesus->delete();
		return redirectWithSuccess(aurl("servicesus"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$servicesus = Serviceus::find($id);
				if(is_null($servicesus) || empty($servicesus)){
					return backWithError(trans('admin.undefinedRecord'),aurl("servicesus"));
				}
                    					if(!empty($servicesus->image)){
				  it()->delete($servicesus->image);
				}
				it()->delete('serviceus',$id);
				$servicesus->delete();
			}
			return redirectWithSuccess(aurl("servicesus"),trans('admin.deleted'));
		}else {
			$servicesus = Serviceus::find($data);
			if(is_null($servicesus) || empty($servicesus)){
				return backWithError(trans('admin.undefinedRecord'),aurl("servicesus"));
			}
                    
			if(!empty($servicesus->image)){
			 it()->delete($servicesus->image);
			}			it()->delete('serviceus',$data);
			$servicesus->delete();
			return redirectWithSuccess(aurl("servicesus"),trans('admin.deleted'));
		}
	}
            

}