<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\product;
use App\Http\Controllers\Controller;

use App\DataTables\productOrderDataTable;


class ProductOrder extends Controller
{

    public function __construct()
    {
  
      $this->middleware('AdminRole:manageorder_show', [
        'only' => ['index', 'show'],
      ]);
      $this->middleware('AdminRole:manageorder_add', [
        'only' => ['create', 'store'],
      ]);
      $this->middleware('AdminRole:manageorder_edit', [
        'only' => ['edit', 'update'],
      ]);
      $this->middleware('AdminRole:manageorder_delete', [
        'only' => ['destroy', 'multi_delete'],
      ]);
    }


    public function index(productOrderDataTable $order)
    {
        // dd($order);
      return $order->render('admin.order.index', ['title' => trans('admin.order')]);
    }
  

}