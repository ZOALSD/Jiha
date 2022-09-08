<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\product;
use App\Models\ProductSizes;
use App\Http\Controllers\Controller;

use App\DataTables\productsControllrtDataTable;
use App\Http\Controllers\Validations\productsControllrtRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class productsControllrt extends Controller
{

  public function __construct()
  {

    $this->middleware('AdminRole:productscontrollrt_show', [
      'only' => ['index', 'show'],
    ]);
    $this->middleware('AdminRole:productscontrollrt_add', [
      'only' => ['create', 'store'],
    ]);
    $this->middleware('AdminRole:productscontrollrt_edit', [
      'only' => ['edit', 'update'],
    ]);
    $this->middleware('AdminRole:productscontrollrt_delete', [
      'only' => ['destroy', 'multi_delete'],
    ]);
  }



  /**
   * Baboon Script By [it v 1.6.40]
   * Display a listing of the resource.
   * @return \Illuminate\Http\Response
   */
  public function index(productsControllrtDataTable $productscontrollrt)
  {
    return $productscontrollrt->render('admin.productscontrollrt.index', ['title' => trans('admin.productscontrollrt')]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * Show the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    return view('admin.productscontrollrt.create', ['title' => trans('admin.create')]);
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * Store a newly created resource in storage.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response Or Redirect
   */
  public function store(productsControllrtRequest $request)
  {
    $data = $request->except("_token", "_method");
    $data['image'] = "";
    $data['admin_id'] = admin()->id();
    $data['sizes'] = implode(',', $data['sizes']);
    $data['colors'] = implode(',', $data['colors']);
    $data['available'] = $request->available;

    $productscontrollrt = product::create($data);

    if (request()->hasFile('image')) {
      $productscontrollrt->image = it()->upload('image', 'productscontrollrt/' . $productscontrollrt->id);
      $productscontrollrt->save();
    }
    $redirect = isset($request["add_back"]) ? "/create" : "";
    return redirectWithSuccess(aurl('productscontrollrt' . $redirect), trans('admin.added'));
  }

  /**
   * Display the specified resource.
   * Baboon Script By [it v 1.6.40]
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $productscontrollrt =  product::find($id);
    return is_null($productscontrollrt) || empty($productscontrollrt) ?
      backWithError(trans("admin.undefinedRecord"), aurl("productscontrollrt")) :
      view('admin.productscontrollrt.show', [
        'title' => trans('admin.show'),
        'productscontrollrt' => $productscontrollrt
      ]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * edit the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $productscontrollrt =  product::find($id);
    return is_null($productscontrollrt) || empty($productscontrollrt) ?
      backWithError(trans("admin.undefinedRecord"), aurl("productscontrollrt")) :
      view('admin.productscontrollrt.edit', [
        'title' => trans('admin.edit'),
        'productscontrollrt' => $productscontrollrt
      ]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * update a newly created resource in storage.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function updateFillableColumns()
  {
    $fillableCols = [];
    foreach (array_keys((new productsControllrtRequest)->attributes()) as $fillableUpdate) {
      if (!is_null(request($fillableUpdate))) {
        $fillableCols[$fillableUpdate] = request($fillableUpdate);
      }
    }
    return $fillableCols;
  }

  public function update(productsControllrtRequest $request, $id)
  {
    // Check Record Exists
    $productscontrollrt =  product::find($id);
    if (is_null($productscontrollrt) || empty($productscontrollrt)) {
      return backWithError(trans("admin.undefinedRecord"), aurl("productscontrollrt"));
    }
    
    $data = $this->updateFillableColumns();
    if ($request->sizes) $data['sizes'] = implode(',', $data['sizes']);
    if ($request->colors) $data['colors'] = implode(',', $data['colors']);
    $data['available'] = $request->available;
    $data['admin_id'] = admin()->id();

    if (request()->hasFile('image')) {
      it()->delete($productscontrollrt->image);
      $data['image'] = it()->upload('image', 'productscontrollrt');
    }
    
    product::where('id', $id)->update($data);
    $redirect = isset($request["save_back"]) ? "/" . $id . "/edit" : "";
    return redirectWithSuccess(aurl('productscontrollrt' . $redirect), trans('admin.updated'));
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * destroy a newly created resource in storage.
   * @param  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $productscontrollrt = product::find($id);
    if (is_null($productscontrollrt) || empty($productscontrollrt)) {
      return backWithSuccess(trans('admin.undefinedRecord'), aurl("productscontrollrt"));
    }
    if (!empty($productscontrollrt->image)) {
      it()->delete($productscontrollrt->image);
    }

    it()->delete('product', $id);
    $productscontrollrt->delete();
    return redirectWithSuccess(aurl("productscontrollrt"), trans('admin.deleted'));
  }


  public function multi_delete()
  {
    $data = request('selected_data');
    if (is_array($data)) {
      foreach ($data as $id) {
        $productscontrollrt = product::find($id);
        if (is_null($productscontrollrt) || empty($productscontrollrt)) {
          return backWithError(trans('admin.undefinedRecord'), aurl("productscontrollrt"));
        }
        if (!empty($productscontrollrt->image)) {
          it()->delete($productscontrollrt->image);
        }
        it()->delete('product', $id);
        $productscontrollrt->delete();
      }
      return redirectWithSuccess(aurl("productscontrollrt"), trans('admin.deleted'));
    } else {
      $productscontrollrt = product::find($data);
      if (is_null($productscontrollrt) || empty($productscontrollrt)) {
        return backWithError(trans('admin.undefinedRecord'), aurl("productscontrollrt"));
      }

      if (!empty($productscontrollrt->image)) {
        it()->delete($productscontrollrt->image);
      }
      it()->delete('product', $data);
      $productscontrollrt->delete();
      return redirectWithSuccess(aurl("productscontrollrt"), trans('admin.deleted'));
    }
  }
}
