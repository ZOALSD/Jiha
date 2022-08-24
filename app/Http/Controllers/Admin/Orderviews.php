<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\OrderviewsDataTable;
use Carbon\Carbon;
use App\Models\Orderview;

use App\Http\Controllers\Validations\OrderviewsRequest;
use App\Models\Card;
use App\Models\Order;
use App\Models\User;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Orderviews extends Controller
{

  public function __construct()
  {

    $this->middleware('AdminRole:orderviews_show', [
      'only' => ['index', 'show'],
    ]);
    $this->middleware('AdminRole:orderviews_add', [
      'only' => ['create', 'store'],
    ]);
    $this->middleware('AdminRole:orderviews_edit', [
      'only' => ['edit', 'update'],
    ]);
    $this->middleware('AdminRole:orderviews_delete', [
      'only' => ['destroy', 'multi_delete'],
    ]);
  }



  /**
   * Baboon Script By [it v 1.6.40]
   * Display a listing of the resource.
   * @return \Illuminate\Http\Response
   */
  public function index(OrderviewsDataTable $orderviews)
  {
    return $orderviews->render('admin.orderviews.index', ['title' => trans('admin.orderviews')]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * Show the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    return view('admin.orderviews.create', ['title' => trans('admin.create')]);
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * Store a newly created resource in storage.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response Or Redirect
   */
  public function store(OrderviewsRequest $request)
  {
    $data = $request->except("_token", "_method");
    $orderviews = Orderview::create($data);
    $redirect = isset($request["add_back"]) ? "/create" : "";
    return redirectWithSuccess(aurl('orderviews' . $redirect), trans('admin.added'));
  }

  /**
   * Display the specified resource.
   * Baboon Script By [it v 1.6.40]
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $orderviews =  Order::where('card_id', $id)->with('product')->get();
    $total = 0;
    foreach ($orderviews as $order) {
      $total += $order->quantity * $order->price;
    }
    $card = Card::find($id);
    $customer = User::find($card->user_id);
    return view('admin.orderviews.show', [
      'title' => trans('admin.show'),
      'orders' => $orderviews,
      'summation' => $total,
      'customer' => $customer,
      'card' => $card
    ]);
  }


  /**
   * Baboon Script By [it v 1.6.40]
   * edit the form for creating a new resource.
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $orderviews =  Orderview::find($id);
    return is_null($orderviews) || empty($orderviews) ?
      backWithError(trans("admin.undefinedRecord"), aurl("orderviews")) :
      view('admin.orderviews.edit', [
        'title' => trans('admin.edit'),
        'orderviews' => $orderviews
      ]);
  }

  public function seen($id,OrderviewsDataTable $orderviews)
  {
    Card::where('id',$id)->update(['seen' => 1]);
    return $orderviews->render('admin.orderviews.index', ['title' => trans('admin.orderviews')]);
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
    foreach (array_keys((new OrderviewsRequest)->attributes()) as $fillableUpdate) {
      if (!is_null(request($fillableUpdate))) {
        $fillableCols[$fillableUpdate] = request($fillableUpdate);
      }
    }
    return $fillableCols;
  }

  public function update(OrderviewsRequest $request, $id)
  {
    // Check Record Exists
    $orderviews =  Orderview::find($id);
    if (is_null($orderviews) || empty($orderviews)) {
      return backWithError(trans("admin.undefinedRecord"), aurl("orderviews"));
    }
    $data = $this->updateFillableColumns();
    Orderview::where('id', $id)->update($data);
    $redirect = isset($request["save_back"]) ? "/" . $id . "/edit" : "";
    return redirectWithSuccess(aurl('orderviews' . $redirect), trans('admin.updated'));
  }

  /**
   * Baboon Script By [it v 1.6.40]
   * destroy a newly created resource in storage.
   * @param  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $orderviews = Orderview::find($id);
    if (is_null($orderviews) || empty($orderviews)) {
      return backWithSuccess(trans('admin.undefinedRecord'), aurl("orderviews"));
    }

    it()->delete('orderview', $id);
    $orderviews->delete();
    return redirectWithSuccess(aurl("orderviews"), trans('admin.deleted'));
  }


  public function multi_delete()
  {
    $data = request('selected_data');
    if (is_array($data)) {
      foreach ($data as $id) {
        $orderviews = Orderview::find($id);
        if (is_null($orderviews) || empty($orderviews)) {
          return backWithError(trans('admin.undefinedRecord'), aurl("orderviews"));
        }

        it()->delete('orderview', $id);
        $orderviews->delete();
      }
      return redirectWithSuccess(aurl("orderviews"), trans('admin.deleted'));
    } else {
      $orderviews = Orderview::find($data);
      if (is_null($orderviews) || empty($orderviews)) {
        return backWithError(trans('admin.undefinedRecord'), aurl("orderviews"));
      }

      it()->delete('orderview', $data);
      $orderviews->delete();
      return redirectWithSuccess(aurl("orderviews"), trans('admin.deleted'));
    }
  }
}
