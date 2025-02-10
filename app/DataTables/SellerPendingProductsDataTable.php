<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\SellerPendingProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function Laravel\Prompts\select;

class SellerPendingProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query){
            $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
        //     $moreBtn = '<div class="dropdown dropleft d-inline">
        //     <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        //     <i class="fas fa-cog"></i>
        //     </button>
        //     <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
        //       <a class="dropdown-item has-icon" href="'.route('', ['product' => $query->id]).'"><i class="far fa-heart"></i> Image Gallery</a>
        //       <a class="dropdown-item has-icon" href="'.route('', ['product' => $query->id]).'"><i class="far fa-file"></i> Variants</a>
        //     </div>
        //   </div>';

            return $editBtn.$deleteBtn;
        })
            ->addColumn('image', function($query){
                return "<img width='70px' src='".asset($query->thumb_image)."' ></img>";
            })
            ->addColumn('type', function($query){
                switch ($query->product_type) {
                    case 'type_dontion':
                        return '<i class="badge badge-success">Donation</i>';
                        break;
                    case 'type_selling':
                        return '<i class="badge badge-warning">Selling</i>';
                        break;

                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
            })
            ->addColumn('approved',function($query){
                if($query->is_approved==1){
                    return '<i class="badge badge-success">Approved</i>';
                }else
                {
                    return '<i class="badge badge-warning">Pending</i>';
                }
            })

            ->addColumn('Status',function($query){
                if($query->status==1){
                    return '<i class="badge badge-success">Active</i>';
                }else
                {
                    return '<i class="badge badge-warning">Deactive</i>';
                }
            })
            ->addColumn('vendor',function($query){
                return $query->vendor->shop_name;
            })
            ->addColumn('approve', function($query){
                return "<select class='form-control is_approved' data-id = '$query->id'>
                <option value='0'>Pending</option>
                <option value='1'>Approved</option>
                </select>";
            })
            ->rawColumns(['image','type','action','approved','Status','approve'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('is_approved', 0)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sellerpendingproducts-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('vendor'),
            Column::make('image'),
            Column::make('name'),
            Column::make('type'),
            Column::make('price'),
            Column::make('qty'),
            Column::make('eco_rating'),
            Column::make('Status'),
            Column::make('approved'),
            Column::make('approve')->width(150),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SellerPendingProducts_' . date('YmdHis');
    }
}
