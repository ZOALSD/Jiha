<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\VideosDataTable;
use Carbon\Carbon;
use App\Models\video;

use App\Http\Controllers\Validations\VideosRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Videos extends Controller
{

  public function __construct()
  {

    $this->middleware('AdminRole:videos_show', [
      'only' => ['index', 'show'],
    ]);
    $this->middleware('AdminRole:videos_add', [
      'only' => ['create', 'store'],
    ]);
    $this->middleware('AdminRole:videos_edit', [
      'only' => ['edit', 'update'],
    ]);
    $this->middleware('AdminRole:videos_delete', [
      'only' => ['destroy', 'multi_delete'],
    ]);
  }



  /**
   * Baboon Script By [it v 1.6.40]
   * Display a listing of the resource.
   * @return \Illuminate\Http\Response
   */
  public function index(VideosDataTable $videos)
  {
    return $videos->render('admin.videos.index', ['title' => trans('admin.videos')]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * Show the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    return view('admin.videos.create', ['title' => trans('admin.create')]);
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * Store a newly created resource in storage.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response Or Redirect
   */
  public function store(VideosRequest $request)
  {
    $data = $request->except("_token", "_method");
    $data['link'] = "";
    $data['admin_id'] = admin()->id();
    $videos = video::create($data);
    if (request()->hasFile('link')) {
      $videos->link = it()->upload('link', 'videos/' . $videos->id);
      $videos->save();
    }
    $redirect = isset($request["add_back"]) ? "/create" : "";
    return redirectWithSuccess(aurl('videos' . $redirect), trans('admin.added'));
  }

  /**
   * Display the specified resource.
   * Baboon Script By [it v 1.6.40]
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $videos =  video::find($id);
    return is_null($videos) || empty($videos) ?
      backWithError(trans("admin.undefinedRecord"), aurl("videos")) :
      view('admin.videos.show', [
        'title' => trans('admin.show'),
        'videos' => $videos
      ]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * edit the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $videos =  video::find($id);
    return is_null($videos) || empty($videos) ?
      backWithError(trans("admin.undefinedRecord"), aurl("videos")) :
      view('admin.videos.edit', [
        'title' => trans('admin.edit'),
        'videos' => $videos
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
    foreach (array_keys((new VideosRequest)->attributes()) as $fillableUpdate) {
      if (!is_null(request($fillableUpdate))) {
        $fillableCols[$fillableUpdate] = request($fillableUpdate);
      }
    }
    return $fillableCols;
  }

  public function update(VideosRequest $request, $id)
  {
    // Check Record Exists
    $videos =  video::find($id);
    if (is_null($videos) || empty($videos)) {
      return backWithError(trans("admin.undefinedRecord"), aurl("videos"));
    }
    $data = $this->updateFillableColumns();
    $data['admin_id'] = admin()->id();
    if (request()->hasFile('link')) {
      it()->delete($videos->link);
      $data['link'] = it()->upload('link', 'videos');
    }
    video::where('id', $id)->update($data);
    $redirect = isset($request["save_back"]) ? "/" . $id . "/edit" : "";
    return redirectWithSuccess(aurl('videos' . $redirect), trans('admin.updated'));
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * destroy a newly created resource in storage.
   * @param  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $videos = video::find($id);
    if (is_null($videos) || empty($videos)) {
      return backWithSuccess(trans('admin.undefinedRecord'), aurl("videos"));
    }
    if (!empty($videos->link)) {
      it()->delete($videos->link);
    }

    it()->delete('video', $id);
    $videos->delete();
    return redirectWithSuccess(aurl("videos"), trans('admin.deleted'));
  }


  public function multi_delete()
  {
    $data = request('selected_data');
    if (is_array($data)) {
      foreach ($data as $id) {
        $videos = video::find($id);
        if (is_null($videos) || empty($videos)) {
          return backWithError(trans('admin.undefinedRecord'), aurl("videos"));
        }
        if (!empty($videos->link)) {
          it()->delete($videos->link);
        }
        it()->delete('video', $id);
        $videos->delete();
      }
      return redirectWithSuccess(aurl("videos"), trans('admin.deleted'));
    } else {
      $videos = video::find($data);
      if (is_null($videos) || empty($videos)) {
        return backWithError(trans('admin.undefinedRecord'), aurl("videos"));
      }

      if (!empty($videos->link)) {
        it()->delete($videos->link);
      }
      it()->delete('video', $data);
      $videos->delete();
      return redirectWithSuccess(aurl("videos"), trans('admin.deleted'));
    }
  }
}
