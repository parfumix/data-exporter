<?php

namespace DataExporter\Drivers;

use DataExporter\Driver;
use DataExporter\DriverInterface;
use DataExporter\Eloquent\Exportable;

class Eloquent extends Driver implements DriverInterface {

    /**
     * Set data to eloquent driver .
     *
     * @param $model
     * @return $this
     */
    public function setData($model) {
        $data = array();

        if( $model instanceof Exportable )
            $columns = $model->getExportColumns();
        else
            $columns = $model->getFillable();

        if( isset($model->id) ) {
            foreach ($columns as $column => $options) {
                $data[$column] = $model->{$column};
            }
        } else {
            $rows = $model->all();

            foreach($rows as $row) {
                foreach ($columns as $column => $options) {
                    $data[$column] = $row->{$column};
                }
            }
        }

        $this->data = $data;

        return $this;
    }
}