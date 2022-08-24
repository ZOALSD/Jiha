<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CustomersDataTable;
use Carbon\Carbon;
use App\Models\Customer;

use App\Http\Controllers\Validations\CustomersRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Customers extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:customers_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:customers_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:customers_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:customers_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(CustomersDataTable $customers)
            {
               return $customers->render('admin.customers.index',['title'=>trans('admin.customers')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.customers.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(CustomersRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$customers = Customer::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('customers'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$customers =  Customer::find($id);
        		return is_null($customers) || empty($customers)?
        		backWithError(trans("admin.undefinedRecord"),aurl("customers")) :
        		view('admin.customers.show',[
				    'title'=>trans('admin.show'),
					'customers'=>$customers
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$customers =  Customer::find($id);
        		return is_null($customers) || empty($customers)?
        		backWithError(trans("admin.undefinedRecord"),aurl("customers")) :
        		view('admin.customers.edit',[
				  'title'=>trans('admin.edit'),
				  'customers'=>$customers
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
				foreach (array_keys((new CustomersRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(CustomersRequest $request,$id)
            {
              // Check Record Exists
              $customers =  Customer::find($id);
              if(is_null($customers) || empty($customers)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("customers"));
              }
              $data = $this->updateFillableColumns(); 
              Customer::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('customers'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$customers = Customer::find($id);
		if(is_null($customers) || empty($customers)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("customers"));
		}
               
		it()->delete('customer',$id);
		$customers->delete();
		return redirectWithSuccess(aurl("customers"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$customers = Customer::find($id);
				if(is_null($customers) || empty($customers)){
					return backWithError(trans('admin.undefinedRecord'),aurl("customers"));
				}
                    	
				it()->delete('customer',$id);
				$customers->delete();
			}
			return redirectWithSuccess(aurl("customers"),trans('admin.deleted'));
		}else {
			$customers = Customer::find($data);
			if(is_null($customers) || empty($customers)){
				return backWithError(trans('admin.undefinedRecord'),aurl("customers"));
			}
                    
			it()->delete('customer',$data);
			$customers->delete();
			return redirectWithSuccess(aurl("customers"),trans('admin.deleted'));
		}
	}
            

}