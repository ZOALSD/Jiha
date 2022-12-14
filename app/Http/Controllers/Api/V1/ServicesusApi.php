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
class ServicesusApi extends Controller
{
    protected $selectColumns = [
        "id",
        "category_id",
        "available",
        "price",
        "delivery",
        "disc",
        "image",
        "title"
    ];

    /**
     * Display the specified releationshop.
     * Baboon Api Script By [it v 1.6.40]
     * @return array to assign with index & show methods
     */
    protected  $arrWith = ['user_id', 'category_id'];



    /**
     * Baboon Api Script By [it v 1.6.40]
     * Display a listing of the resource. Api
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Serviceus = Serviceus::select($this->selectColumns)->with('category_id')->get();
        // $Serviceus = Serviceus::seget();
        return successResponseJson(["data" => $Serviceus]);
    }


    /**
     * Baboon Api Script By [it v 1.6.40]
     * Store a newly created resource in storage. Api
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesusRequest $request)
    {
        $data = $request->except("_token");

        $data["image"] = "";
        $Serviceus = Serviceus::create($data);
        if (request()->hasFile("image")) {
            $Serviceus->image = it()->upload("image", "servicesus/" . $Serviceus->id);
            $Serviceus->save();
        }

        $Serviceus = Serviceus::with($this->arrWith())->find($Serviceus->id, $this->selectColumns);
        return successResponseJson([
            "message" => trans("admin.added"),
            "data" => $Serviceus
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
        $Serviceus = Serviceus::with($this->arrWith())->find($id, $this->selectColumns);
        if (is_null($Serviceus) || empty($Serviceus)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }

        return successResponseJson([
            "data" => $Serviceus
        ]);;
    }


    /**
     * Baboon Api Script By [it v 1.6.40]
     * update a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function updateFillableColumns()
    {
        $fillableCols = [];
        foreach (array_keys((new ServicesusRequest)->attributes()) as $fillableUpdate) {
            if (!is_null(request($fillableUpdate))) {
                $fillableCols[$fillableUpdate] = request($fillableUpdate);
            }
        }
        return $fillableCols;
    }

    public function update(ServicesusRequest $request, $id)
    {
        $Serviceus = Serviceus::find($id);
        if (is_null($Serviceus) || empty($Serviceus)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }

        $data = $this->updateFillableColumns();

        if (request()->hasFile("image")) {
            it()->delete($Serviceus->image);
            $data["image"] = it()->upload("image", "servicesus/" . $Serviceus->id);
        }
        Serviceus::where("id", $id)->update($data);

        $Serviceus = Serviceus::with($this->arrWith())->find($id, $this->selectColumns);
        return successResponseJson([
            "message" => trans("admin.updated"),
            "data" => $Serviceus
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
        if (is_null($servicesus) || empty($servicesus)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }


        if (!empty($servicesus->image)) {
            it()->delete($servicesus->image);
        }
        it()->delete("serviceus", $id);

        $servicesus->delete();
        return successResponseJson([
            "message" => trans("admin.deleted")
        ]);
    }



    public function multi_delete()
    {
        $data = request("selected_data");
        if (is_array($data)) {
            foreach ($data as $id) {
                $servicesus = Serviceus::find($id);
                if (is_null($servicesus) || empty($servicesus)) {
                    return errorResponseJson([
                        "message" => trans("admin.undefinedRecord")
                    ]);
                }

                if (!empty($servicesus->image)) {
                    it()->delete($servicesus->image);
                }
                it()->delete("serviceus", $id);
                $servicesus->delete();
            }
            return successResponseJson([
                "message" => trans("admin.deleted")
            ]);
        } else {
            $servicesus = Serviceus::find($data);
            if (is_null($servicesus) || empty($servicesus)) {
                return errorResponseJson([
                    "message" => trans("admin.undefinedRecord")
                ]);
            }

            if (!empty($servicesus->image)) {
                it()->delete($servicesus->image);
            }
            it()->delete("serviceus", $data);

            $servicesus->delete();
            return successResponseJson([
                "message" => trans("admin.deleted")
            ]);
        }
    }
}
