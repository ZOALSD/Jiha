<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\LocationsDataTable;
use Carbon\Carbon;
use App\Models\Location;

use App\Http\Controllers\Validations\LocationsRequest;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Locations extends Controller
{

  public function __construct()
  {

    $this->middleware('AdminRole:locations_show', [
      'only' => ['index', 'show'],
    ]);
    $this->middleware('AdminRole:locations_add', [
      'only' => ['create', 'store'],
    ]);
    $this->middleware('AdminRole:locations_edit', [
      'only' => ['edit', 'update'],
    ]);
    $this->middleware('AdminRole:locations_delete', [
      'only' => ['destroy', 'multi_delete'],
    ]);
  }



  /**
   * Baboon Script By [it v 1.6.40]
   * Display a listing of the resource.
   * @return \Illuminate\Http\Response
   */
  public function index(LocationsDataTable $locations)
  {
    return $locations->render('admin.locations.index', ['title' => trans('admin.locations')]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * Show the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    return view('admin.locations.create', ['title' => trans('admin.create')]);
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * Store a newly created resource in storage.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response Or Redirect
   */
  public function store(LocationsRequest $request)
  {

    
    $data = $request->except("_token", "_method");
    // dd($data);
    $data['hour_start'] = date('H:m', strtotime(request('hour_start')));
    // $data['hour_end'] = date('H:m', strtotime(request('hour_end')));

    $data['days_wrok'] = implode(',',$data['days_wrok']);
    // dd($data);
    $locations = Location::create($data);
    $redirect = isset($request["add_back"]) ? "/create" : "";
    return redirectWithSuccess(aurl('locations' . $redirect), trans('admin.added'));
  }

  /**
   * Display the specified resource.
   * Baboon Script By [it v 1.6.40]
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $locations =  Location::find($id);
    return is_null($locations) || empty($locations) ?
      backWithError(trans("admin.undefinedRecord"), aurl("locations")) :
      view('admin.locations.show', [
        'title' => trans('admin.show'),
        'locations' => $locations
      ]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * edit the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $locations =  Location::find($id);
    return is_null($locations) || empty($locations) ?
      backWithError(trans("admin.undefinedRecord"), aurl("locations")) :
      view('admin.locations.edit', [
        'title' => trans('admin.edit'),
        'locations' => $locations
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
    foreach (array_keys((new LocationsRequest)->attributes()) as $fillableUpdate) {
      if (!is_null(request($fillableUpdate))) {
        $fillableCols[$fillableUpdate] = request($fillableUpdate);
      }
    }
    return $fillableCols;
  }

  public function update(LocationsRequest $request, $id)
  {
    // Check Record Exists
    $locations =  Location::find($id);
    if (is_null($locations) || empty($locations)) {
      return backWithError(trans("admin.undefinedRecord"), aurl("locations"));
    }
    $data = $this->updateFillableColumns();
    $data['hour_start'] = date('H:i', strtotime(request('hour_start')));
    $data['hour_end'] = date('H:i', strtotime(request('hour_end')));
    Location::where('id', $id)->update($data);
    $redirect = isset($request["save_back"]) ? "/" . $id . "/edit" : "";
    return redirectWithSuccess(aurl('locations' . $redirect), trans('admin.updated'));
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * destroy a newly created resource in storage.
   * @param  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $locations = Location::find($id);
    if (is_null($locations) || empty($locations)) {
      return backWithSuccess(trans('admin.undefinedRecord'), aurl("locations"));
    }

    it()->delete('location', $id);
    $locations->delete();
    return redirectWithSuccess(aurl("locations"), trans('admin.deleted'));
  }


  public function multi_delete()
  {
    $data = request('selected_data');
    if (is_array($data)) {
      foreach ($data as $id) {
        $locations = Location::find($id);
        if (is_null($locations) || empty($locations)) {
          return backWithError(trans('admin.undefinedRecord'), aurl("locations"));
        }

        it()->delete('location', $id);
        $locations->delete();
      }
      return redirectWithSuccess(aurl("locations"), trans('admin.deleted'));
    } else {
      $locations = Location::find($data);
      if (is_null($locations) || empty($locations)) {
        return backWithError(trans('admin.undefinedRecord'), aurl("locations"));
      }

      it()->delete('location', $data);
      $locations->delete();
      return redirectWithSuccess(aurl("locations"), trans('admin.deleted'));
    }
  }
}
