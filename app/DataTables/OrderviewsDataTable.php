<?php

namespace App\DataTables;

use App\Models\Orderview;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
// Auto DataTable By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved [it v 1.6.40]
class OrderviewsDataTable extends DataTable
{


  /**
   * dataTable to render Columns.
   * Auto Ajax Method By Baboon Script [it v 1.6.40]
   * @return \Illuminate\Http\JsonResponse
   */
  public function dataTable(DataTables $dataTables, $query)
  {
    return datatables($query)
      ->addColumn('actions', 'admin.orderviews.buttons.actions')

      ->addColumn('seen', '{{ trans("admin.".$seen) }}')
      ->addColumn('delivery', '{{ trans("admin.".$delivery) }}')
      // ->addColumn('delivery', 'admin.orderviews.buttons.delivery')

      ->addColumn('created_at', '{{ date("Y-m-d H:i:s",strtotime($created_at)) }}')
      ->addColumn('updated_at', '{{ date("Y-m-d H:i:s",strtotime($updated_at)) }}')
      ->addColumn('checkbox', '<div  class="icheck-danger">
                  <input type="checkbox" class="selected_data" name="selected_data[]" id="selectdata{{ $id }}" value="{{ $id }}" >
                  <label for="selectdata{{ $id }}"></label>
                </div>')
     ->addColumn('image_notification', '{!! view("admin.show_image",["image"=>$image_notification])->render() !!}')
      ->rawColumns(['checkbox', 'actions','image_notification','delivery']);
  }


  /**
   * Get the query object to be processed by dataTables.
   * Auto Ajax Method By Baboon Script [it v 1.6.40]
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
   */
  public function query()
  {
    return Orderview::query()->select("cards.*")->where('status',1)->with('user_id');
  }


  /**
   * Optional method if you want to use html builder.
   *[it v 1.6.40]
   * @return \Yajra\Datatables\Html\Builder
   */
  public function html()
  {
    $html =  $this->builder()
      ->columns($this->getColumns())
      //->ajax('')
      ->parameters([
        'searching'   => true,
        'paging'   => true,
        'bLengthChange'   => false,
        'bInfo'   => false,
        'responsive'   => true,
        'dom' => 'Blfrtip',
        "lengthMenu" => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('admin.all_records')]],
        'buttons' => [],
        'initComplete' => "function () {
            " . filterElement('1,2,3,4,5,8', 'input') . "
                        //seenuser_id,total,number_notification,image notification,seen6
            " . filterElement('8', 'select', [
          '1' => trans('admin.1'),
          '0' => trans('admin.0'),
        ]) . "

        " . filterElement('7', 'select', [
          '1' => trans('admin.1'),
          '0' => trans('admin.0'),
        ]) . "


	            }",
        'order' => [[1, 'desc']],

        'language' => [
          'sProcessing' => trans('admin.sProcessing'),
          'sLengthMenu'        => trans('admin.sLengthMenu'),
          'sZeroRecords'       => trans('admin.sZeroRecords'),
          'sEmptyTable'        => trans('admin.sEmptyTable'),
          'sInfo'              => trans('admin.sInfo'),
          'sInfoEmpty'         => trans('admin.sInfoEmpty'),
          'sInfoFiltered'      => trans('admin.sInfoFiltered'),
          'sInfoPostFix'       => trans('admin.sInfoPostFix'),
          'sSearch'            => trans('admin.sSearch'),
          'sUrl'               => trans('admin.sUrl'),
          'sInfoThousands'     => trans('admin.sInfoThousands'),
          'sLoadingRecords'    => trans('admin.sLoadingRecords'),
          'oPaginate'          => [
            'sFirst'            => trans('admin.sFirst'),
            'sLast'             => trans('admin.sLast'),
            'sNext'             => trans('admin.sNext'),
            'sPrevious'         => trans('admin.sPrevious'),
          ],
          'oAria'            => [
            'sSortAscending'  => trans('admin.sSortAscending'),
            'sSortDescending' => trans('admin.sSortDescending'),
          ],
        ]
      ]);

    return $html;
  }



  /**
   * Get columns.
   * Auto getColumns Method By Baboon Script [it v 1.6.40]
   * @return array
   */

  protected function getColumns()
  {
    return [

      [
        'name' => 'id',
        'data' => 'id',
        'title' => trans('admin.record_id'),
        'width'          => '10px',
        'aaSorting'      => 'none'
      ],
      [
        'name' => 'user_id',
        'data' => 'user_id.first_name',
        'title' => 'first name',
      ],
      [
        'name' => 'user_id',
        'data' => 'user_id.last_name',
        'title' => 'last name',
      ],
      [
        'name' => 'user_id',
        'data' => 'user_id.phone',
        'title' => 'phone number',
      ],
      [
        'name' => 'total',
        'data' => 'total',
        'title' => trans('admin.total'),
      ],
      [
        'name' => 'number_notification',
        'data' => 'number_notification',
        'title' => trans('admin.number_notification'),
      ],
      [
        'name' => 'image_notification',
        'data' => 'image_notification',
        'title' => trans('admin.image notification'),
      ],
      [
        'name' => 'cards.delivery',
        'data' => 'delivery',
        'title' => 'delivery',
      ],
      [
        'name' => 'cards.seen',
        'data' => 'seen',
        'title' => trans('admin.seen'),
      ],
      [
        'name' => 'actions',
        'data' => 'actions',
        'title' => trans('admin.actions'),
        'exportable' => false,
        'printable'  => false,
        'searchable' => false,
        'orderable'  => false,
      ],
    ];
  }

  /**
   * Get filename for export.
   * Auto filename Method By Baboon Script
   * @return string
   */
  protected function filename()
  {
    return 'orderviews_' . time();
  }
}
