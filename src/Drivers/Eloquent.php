<?php

namespace DataExporter\Drivers;

use DataExporter\Driver;
use DataExporter\DriverInterface;
use DataExporter\Eloquent\Exportable;
use Flysap\Scaffold\ScaffoldAble;

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
        elseif( $model instanceof ScaffoldAble )
            $columns = $model->scaffoldListing();
        else
            $columns = $model->getFillable();

        if( isset($model->id) ) {
            foreach ($columns as $column => $options) {
                $data[$column] = $this->getColumnValue($column, $model, $options);
            }

            $data = [$data];
        } else {
            $rows = $model->all();

            foreach($rows as $row) {
                foreach ($columns as $column => $options) {
                    $data[$column] = $this->getColumnValue($column, $row, $options);
                }
            }
        }

        $this->data = $data;

        return $this;
    }

    /**
     * Get value for specific column .
     *
     * @param $column
     * @param $source
     * @param null $options
     * @return mixed
     */
    protected function getColumnValue($column, $source, $options = null) {
        $value = $source->{$column};

        if( $options instanceof \Closure )
            $value = $options($value, $source);

        return $value;
    }
}