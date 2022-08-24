<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\ColorsDataTable;
use Carbon\Carbon;
use App\Models\Color;

use App\Http\Controllers\Validations\ColorsRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Colors extends Controller
{

  public function __construct()
  {

    $this->middleware('AdminRole:colors_show', [
      'only' => ['index', 'show'],
    ]);
    $this->middleware('AdminRole:colors_add', [
      'only' => ['create', 'store'],
    ]);
    $this->middleware('AdminRole:colors_edit', [
      'only' => ['edit', 'update'],
    ]);
    $this->middleware('AdminRole:colors_delete', [
      'only' => ['destroy', 'multi_delete'],
    ]);
  }



  /**
   * Baboon Script By [it v 1.6.40]
   * Display a listing of the resource.
   * @return \Illuminate\Http\Response
   */
  public function index(ColorsDataTable $colors)
  {
    return $colors->render('admin.colors.index', ['title' => trans('admin.colors')]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * Show the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    return view('admin.colors.create', ['title' => trans('admin.create')]);
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * Store a newly created resource in storage.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response Or Redirect
   */
  public function store(ColorsRequest $request)
  {
    $data = $request->except("_token", "_method");
    $data['code'] = str_replace('#', '0xff', $data['color']);
    $colors = Color::create($data);

    $redirect = isset($request["add_back"]) ? "/create" : "";
    return redirectWithSuccess(aurl('colors' . $redirect), trans('admin.added'));
  }

  /**
   * Display the specified resource.
   * Baboon Script By [it v 1.6.40]
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $colors =  Color::find($id);
    return is_null($colors) || empty($colors) ?
      backWithError(trans("admin.undefinedRecord"), aurl("colors")) :
      view('admin.colors.show', [
        'title' => trans('admin.show'),
        'colors' => $colors
      ]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * edit the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $colors =  Color::find($id);

    return is_null($colors) || empty($colors) ?
      backWithError(trans("admin.undefinedRecord"), aurl("colors")) :
      view('admin.colors.edit', [
        'title' => trans('admin.edit'),
        'colors' => $colors
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
    foreach (array_keys((new ColorsRequest)->attributes()) as $fillableUpdate) {
      if (!is_null(request($fillableUpdate))) {
        $fillableCols[$fillableUpdate] = request($fillableUpdate);
      }
    }
    return $fillableCols;
  }

  public function update(ColorsRequest $request, $id)
  {
    // Check Record Exists
    $colors =  Color::find($id);
    if (is_null($colors) || empty($colors)) {
      return backWithError(trans("admin.undefinedRecord"), aurl("colors"));
    }
    $data = $this->updateFillableColumns();
    $data['code'] = str_replace('#', '0xff', $data['color']);
    Color::where('id', $id)->update($data);
    $redirect = isset($request["save_back"]) ? "/" . $id . "/edit" : "";
    return redirectWithSuccess(aurl('colors' . $redirect), trans('admin.updated'));
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * destroy a newly created resource in storage.
   * @param  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $colors = Color::find($id);
    if (is_null($colors) || empty($colors)) {
      return backWithSuccess(trans('admin.undefinedRecord'), aurl("colors"));
    }

    it()->delete('color', $id);
    $colors->delete();
    return redirectWithSuccess(aurl("colors"), trans('admin.deleted'));
  }


  public function multi_delete()
  {
    $data = request('selected_data');
    if (is_array($data)) {
      foreach ($data as $id) {
        $colors = Color::find($id);
        if (is_null($colors) || empty($colors)) {
          return backWithError(trans('admin.undefinedRecord'), aurl("colors"));
        }

        it()->delete('color', $id);
        $colors->delete();
      }
      return redirectWithSuccess(aurl("colors"), trans('admin.deleted'));
    } else {
      $colors = Color::find($data);
      if (is_null($colors) || empty($colors)) {
        return backWithError(trans('admin.undefinedRecord'), aurl("colors"));
      }

      it()->delete('color', $data);
      $colors->delete();
      return redirectWithSuccess(aurl("colors"), trans('admin.deleted'));
    }
  }
}
