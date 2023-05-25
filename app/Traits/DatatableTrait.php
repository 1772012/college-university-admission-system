<?php

namespace App\Traits;

trait DatatableTrait
{
    /**
     *  Generate column
     *
     *  @param $datatable
     *  @param string $colName
     *  @param string $viewSource
     *  @return void
     */
    private static function generateColumn($datatable, string $colName, string $viewSource): void
    {
        $datatable->addColumn($colName, function ($model) use ($colName, $viewSource) {
            return view($viewSource .'.' . $colName, [
                'model' => $model,
            ]);
        });
    }
}
