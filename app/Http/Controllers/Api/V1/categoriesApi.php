<?php

namespace App\Http\Controllers\Api\V1;

use Validator;

use Carbon\Carbon;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Serviceus;
use App\Http\Controllers\ValidationsApi\V1\categoriesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class categoriesApi extends Controller
{
    protected $selectColumns = [
        "id",
        "name",
        //  "parent_id",
        "image",
        "service"
    ];

    protected $selectPro = [
        "id",
        "name",
        "price",
        "image",
        'colors',
        "sizes",
        "desc_en",
        "desc_ar",
        "available",
        'category_id'
    ];

    /**
     * Display the specified releationshop.
     * Baboon Api Script By [it v 1.6.40]
     * @return array to assign with index & show methods
     */
    public function arrWithPro()
    {
        return ['category']; //
    }


    /**
     * Baboon Api Script By [it v 1.6.40]
     * Display a listing of the resource. Api
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category::select($this->selectColumns)->where('parent_id', null)->orderBy("id", "desc")->get();
        return successResponseJson(["data" => $category]);
    }


    /**
     * Baboon Api Script By [it v 1.6.40]
     * Store a newly created resource in storage. Api
     * @return \Illuminate\Http\Response
     */
    public function store(categoriesRequest $request)
    {
        $data = $request->except("_token");

        $data["user_id"] = auth()->id();
        $category = category::create($data);

        $category = category::with($this->arrWith())->find($category->id, $this->selectColumns);
        return successResponseJson([
            "message" => trans("admin.added"),
            "data" => $category
        ]);
    }


    //reTurn Categorise OR Data
    public function SupCategorise($id)
    {
        $service = category::where(['id'=>$id , 'service' => 1])->count();
        if($service){
           $data = Serviceus::where('category_id',$id)->get();
            return response()->json(["Data" => $data, "Sup" => 0], 200);
        }
        $count = category::where('Parent_id', $id)->count();

        if ($count == 0) {
            $data = product::where('category_id', $id)
                ->leftJoin('favorites', function ($join) {
                    $join->on('products.id', '=', 'favorites.products_id')
                        ->where('favorites.user_id', '=', auth('sanctum')->id());
                })
                ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                ->select(
                    'products.id',
                    'products.name',
                    'products.price',
                    'products.image',
                    'products.colors',
                    'products.sizes',
                    'products.available',
                    'products.desc_en',
                    'products.desc_ar',
                    'favorites.products_id as favorit',
                    'categories.name as categoy',
                    'categories.image as categoy_image'
                )->get();

            //  $data = product::with($this->arrWithPro())->select($this->selectPro)->where('category_id', $id)->get();
            return response()->json(["Data" => $data, "Sup" => 0], 200);
        } else {
            $Sup = category::where('Parent_id', $id)->select($this->selectColumns)->get();
            $cate = category::where('id', $id)->select($this->selectColumns)->get();
            return response()->json(["Categorise" => $cate, "Sup" => $Sup], 200);
        }
    }

    /**
     * Display the specified resource.
     * Baboon Api Script By [it v 1.6.40]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = category::with($this->arrWith())->find($id, $this->selectColumns);
        if (is_null($category) || empty($category)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }

        return successResponseJson([
            "data" => $category
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
        foreach (array_keys((new categoriesRequest)->attributes()) as $fillableUpdate) {
            if (!is_null(request($fillableUpdate))) {
                $fillableCols[$fillableUpdate] = request($fillableUpdate);
            }
        }
        return $fillableCols;
    }

    public function update(categoriesRequest $request, $id)
    {
        $category = category::find($id);
        if (is_null($category) || empty($category)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }

        $data = $this->updateFillableColumns();

        $data["user_id"] = auth()->id();
        category::where("id", $id)->update($data);

        $category = category::with($this->arrWith())->find($id, $this->selectColumns);
        return successResponseJson([
            "message" => trans("admin.updated"),
            "data" => $category
        ]);
    }

    /**
     * Baboon Api Script By [it v 1.6.40]
     * destroy a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = category::find($id);
        if (is_null($categories) || empty($categories)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }


        if (!empty($categories->image)) {
            it()->delete($categories->image);
        }
        it()->delete("category", $id);

        $categories->delete();
        return successResponseJson([
            "message" => trans("admin.deleted")
        ]);
    }



    public function multi_delete()
    {
        $data = request("selected_data");
        if (is_array($data)) {
            foreach ($data as $id) {
                $categories = category::find($id);
                if (is_null($categories) || empty($categories)) {
                    return errorResponseJson([
                        "message" => trans("admin.undefinedRecord")
                    ]);
                }

                if (!empty($categories->image)) {
                    it()->delete($categories->image);
                }
                it()->delete("category", $id);
                $categories->delete();
            }
            return successResponseJson([
                "message" => trans("admin.deleted")
            ]);
        } else {
            $categories = category::find($data);
            if (is_null($categories) || empty($categories)) {
                return errorResponseJson([
                    "message" => trans("admin.undefinedRecord")
                ]);
            }

            if (!empty($categories->image)) {
                it()->delete($categories->image);
            }
            it()->delete("category", $data);

            $categories->delete();
            return successResponseJson([
                "message" => trans("admin.deleted")
            ]);
        }
    }
}
