<?php

namespace App\Http\Controllers\Api\V1;

use Validator;

use Carbon\Carbon;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\productsResource;
use App\Http\Controllers\ValidationsApi\V1\productsControllrtRequest;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class productsControllrtApi extends Controller
{
    protected $selectColumns = [
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
    public function arrWith()
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
        $data = product::leftJoin('favorites', function ($join) {
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


        return response()->json($data, 200);

        // $product = product::select($this->selectColumns)->with($this->arrWith())->orderBy("id", "desc")->get();
        // return successResponseJson(["data" => $product]);


    }


    /**
     * Baboon Api Script By [it v 1.6.40]
     * Store a newly created resource in storage. Api
     * @return \Illuminate\Http\Response
     */
    public function store(productsControllrtRequest $request)
    {
        $data = $request->except("_token", "_method");
        $data['image'] = "";
        $data['admin_id'] = 1;

        $product = product::create($data);

        if (request()->hasFile('image')) {
            $product->image = it()->upload('image', 'productscontrollrt/' . $product->id);
            $product->save();
        }

        $product = product::with($this->arrWith())->find($product->id, $this->selectColumns);
        return successResponseJson([
            "message" => trans("admin.added"),
            "data" => $product
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
        $product = product::with($this->arrWith())->find($id, $this->selectColumns);
        if (is_null($product) || empty($product)) {
            return errorResponseJson([
                "message" => trans("admin.undefinedRecord")
            ]);
        }

        return successResponseJson([
            "data" => $product
        ]);;
    }
    public function updateFillableColumns() {
        $fillableCols = [];
        foreach (array_keys((new productsControllrtRequest)->attributes()) as $fillableUpdate) {
           if (!is_null(request($fillableUpdate))) {
           $fillableCols[$fillableUpdate] = request($fillableUpdate);
         }
        }
        return $fillableCols;
    }


    public function update($id,productsControllrtRequest $request)
    {
        $product = product::find($id);
        if(is_null($product) || empty($product)){
         return errorResponseJson([
          "message"=>trans("admin.undefinedRecord")
         ]);
             }
         $data = $request->all();
      product::where("id",$id)->update($data);

      $product = product::with($this->arrWith())->find($id,$this->selectColumns);
      return successResponseJson([
       "message"=>trans("admin.updated"),
       "data"=> $product
       ]);
    }

    // /**
    //  * Baboon Api Script By [it v 1.6.40]
    //  * destroy a newly created resource in storage.
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $productscontrollrt = product::find($id);
    //     if (is_null($productscontrollrt) || empty($productscontrollrt)) {
    //         return errorResponseJson([
    //             "message" => trans("admin.undefinedRecord")
    //         ]);
    //     }


    //     if (!empty($productscontrollrt->image)) {
    //         it()->delete($productscontrollrt->image);
    //     }
    //     it()->delete("product", $id);

    //     $productscontrollrt->delete();
    //     return successResponseJson([
    //         "message" => trans("admin.deleted")
    //     ]);
    // }



    // public function multi_delete()
    // {
    //     $data = request("selected_data");
    //     if (is_array($data)) {
    //         foreach ($data as $id) {
    //             $productscontrollrt = product::find($id);
    //             if (is_null($productscontrollrt) || empty($productscontrollrt)) {
    //                 return errorResponseJson([
    //                     "message" => trans("admin.undefinedRecord")
    //                 ]);
    //             }

    //             if (!empty($productscontrollrt->image)) {
    //                 it()->delete($productscontrollrt->image);
    //             }
    //             it()->delete("product", $id);
    //             $productscontrollrt->delete();
    //         }
    //         return successResponseJson([
    //             "message" => trans("admin.deleted")
    //         ]);
    //     } else {
    //         $productscontrollrt = product::find($data);
    //         if (is_null($productscontrollrt) || empty($productscontrollrt)) {
    //             return errorResponseJson([
    //                 "message" => trans("admin.undefinedRecord")
    //             ]);
    //         }

    //         if (!empty($productscontrollrt->image)) {
    //             it()->delete($productscontrollrt->image);
    //         }
    //         it()->delete("product", $data);

    //         $productscontrollrt->delete();
    //         return successResponseJson([
    //             "message" => trans("admin.deleted")
    //         ]);
    //     }
    // }
}
