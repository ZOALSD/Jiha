<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Serviceus;
use Validator;
use App\Http\Controllers\ValidationsApi\V1\ServicesusRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class ServicesusApi extends Controller{
	protected $selectColumns = [
		"id",
		"user_id",
		"services_type_id",
		"name",
		"image_ID",
		"shop_name",
		"phone",
		"other_phone",
	];

            /**
             * Display the specified releationshop.
             * Baboon Api Script By [it v 1.6.40]
             * @return array to assign with index & show methods
             */
            public function arrWith(){
               return ['user_id','services_type_id',];
            }


            /**
             * Baboon Api Script By [it v 1.6.40]
             * Display a listing of the resource. Api
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
            	$Serviceus = Serviceus::select($this->selectColumns)->with($this->arrWith())->orderBy("id","desc")->paginate(15);
               return successResponseJson(["data"=>$Serviceus]);
            }


            /**
             * Baboon Api Script By [it v 1.6.40]
             * Store a newly created resource in storage. Api
             * @return \Illuminate\Http\Response
             */
    public function store(ServicesusRequest $request)
    {
    	$data = $request->except("_token");
    	
                $data["image_ID"] = "";
        $Serviceus = Serviceus::create($data); 
               if(request()->hasFile("image_ID")){
              $Serviceus->image_ID = it()->upload("image_ID","servicesus/".$Serviceus->id);
              $Serviceus->save();
              }

		  $Serviceus = Serviceus::with($this->arrWith())->find($Serviceus->id,$this->selectColumns);
        return successResponseJson([
            "message"=>trans("admin.added"),
            "data"=>$Serviceus
        ]);
    }


            /**
             * Display the specified resource.
             * Baboon Api Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $Serviceus = Serviceus::with($this->arrWith())->find($id,$this->selectColumns);
            	if(is_null($Serviceus) || empty($Serviceus)){
            	 return errorResponseJson([
            	  "message"=>trans("admin.undefinedRecord")
            	 ]);
            	}

                 return successResponseJson([
              "data"=> $Serviceus
              ]);  ;
            }


            /**
             * Baboon Api Script By [it v 1.6.40]
             * update a newly created resource in storage.
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
            	$Serviceus = Serviceus::find($id);
            	if(is_null($Serviceus) || empty($Serviceus)){
            	 return errorResponseJson([
            	  "message"=>trans("admin.undefinedRecord")
            	 ]);
  			       }

            	$data = $this->updateFillableColumns();
                 
               if(request()->hasFile("image_ID")){
              it()->delete($Serviceus->image_ID);
              $data["image_ID"] = it()->upload("image_ID","servicesus/".$Serviceus->id);
               }
              Serviceus::where("id",$id)->update($data);

              $Serviceus = Serviceus::with($this->arrWith())->find($id,$this->selectColumns);
              return successResponseJson([
               "message"=>trans("admin.updated"),
               "data"=> $Serviceus
               ]);
            }

            /**
             * Baboon Api Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $servicesus = Serviceus::find($id);
            	if(is_null($servicesus) || empty($servicesus)){
            	 return errorResponseJson([
            	  "message"=>trans("admin.undefinedRecord")
            	 ]);
            	}


              if(!empty($servicesus->image_ID)){
               it()->delete($servicesus->image_ID);
              }
               it()->delete("serviceus",$id);

               $servicesus->delete();
               return successResponseJson([
                "message"=>trans("admin.deleted")
               ]);
            }



 			public function multi_delete()
            {
                $data = request("selected_data");
                if(is_array($data)){
                    foreach($data as $id){
                    $servicesus = Serviceus::find($id);
	            	if(is_null($servicesus) || empty($servicesus)){
	            	 return errorResponseJson([
	            	  "message"=>trans("admin.undefinedRecord")
	            	 ]);
	            	}

                    	if(!empty($servicesus->image_ID)){
                    	it()->delete($servicesus->image_ID);
                    	}
                    	it()->delete("serviceus",$id);
                    	$servicesus->delete();
                    }
                    return successResponseJson([
                     "message"=>trans("admin.deleted")
                    ]);
                }else {
                    $servicesus = Serviceus::find($data);
	            	if(is_null($servicesus) || empty($servicesus)){
	            	 return errorResponseJson([
	            	  "message"=>trans("admin.undefinedRecord")
	            	 ]);
	            	}
 
                    	if(!empty($servicesus->image_ID)){
                    	it()->delete($servicesus->image_ID);
                    	}
                    	it()->delete("serviceus",$data);

                    $servicesus->delete();
                    return successResponseJson([
                     "message"=>trans("admin.deleted")
                    ]);
                }
            }

            
}