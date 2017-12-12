<?php

namespace App\DataTables;

use App\Subcategory;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SubcategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        // $dataTable = new EloquentDataTable($query);
        // return $dataTable;
        $query = $this->query();

        return $this->dataTable->eloquent($this->query())->addColumn('action', function($query){
            return '<a href="#delete-"' . $query->id . '" class="btn btn-sm btn-danger">Delete</a>';
        })->make(true);
    }

    // public function ajax()
    // {
    //     $query = $this->query();

    //     return $this->dataTable->eloquent($this->query())->addColumn('action', function($query){
    //         return '<a href="#delete-"' . $query->id . '" class="btn btn-sm btn-danger">Delete</a>';
    //     })->make(true);
    // }



    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $subcategories = Subcategory::with('category');
        return $this->applyScopes($subcategories);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(
                    //     [
                    //     'defaultContent' => 'error',
                    //     'data'           => 'action',
                    //     'name'           => 'action',
                    //     'title'          => 'ACTION',
                    //     'render'         => null,
                    //     'orderable'      => false,
                    //     'searchable'     => false,
                    //     'exportable'     => false,
                    //     'printable'      => false,
                    // ]
                )
                    ->parameters([
                        'dom'     => 'Bfrtip',
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'buttons' => [
                            'create',
                            'export',
                            'print',
                            'reset',
                            'reload',
                        ],
                    ]);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
           'ID' => ['data'=>'id','name'=>'id'],
           'NAME' => ['data'=>'name','name'=>'name'],
           'CATEGORY' => ['data'=>'category.name','name'=>'category.name'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'subcategorydatatable_' . time();
    }
}
