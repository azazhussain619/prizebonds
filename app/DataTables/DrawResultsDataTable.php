<?php

namespace App\DataTables;

use App\Models\Denomination;
use App\Models\DrawResult;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class DrawResultsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(DrawResult $model): QueryBuilder
    {
        return $model::with('denomination', 'draw', 'prize')->select('draw_results.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('prizes-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
//                        Button::make('excel'),
//                        Button::make('csv'),
//                        Button::make('pdf'),
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
            Column::make('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('denomination.name'),
            Column::make('draw.date'),
            Column::make('prize.category'),
            Column::make('prize.prize')
                ->searchable(false)
                ->orderable(false),
            Column::make('serial'),
//            Column::make('action')
//                ->title('Action')
//                ->searchable(false)
//                ->orderable(false)
//                ->render('\'<a class="btn btn-sm btn-info" href="prizes/\' + (full[\'id\']) + \'/edit">Edit</a>\';\'\'')
//                ->footer('Action')
//                ->exportable(false)
//                ->printable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DrawResults_' . date('YmdHis');
    }
}
