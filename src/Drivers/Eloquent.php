<?php

namespace DataExporter\Drivers;

use DataExporter\Driver;
use DataExporter\DriverAssets\Eloquent\Exportable;
use DataExporter\DriverInterface;
use DataExporter\ExporterException;
use Flysap\Scaffold\ScaffoldAble;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends Driver implements DriverInterface {

    /**
     * Set data to eloquent driver .
     *
     * @param $model
     * @param callable $callback
     * @return $this
     * @throws ExporterException
     */
    public function setData($model, \Closure $callback = null) {

        if(! $model instanceof Model)
            throw new ExporterException(_('Invalid model'));

        $data = array();

        if( ! is_null($callback) ) {
            $data = $callback($model);
        } else {
            if( $model instanceof Exportable )
                $columns = $model->getExportColumns();
            elseif( $model instanceof ScaffoldAble )
                $columns = $model->scaffoldListing();
            else
                $columns = $model->getFillable();

            if( isset($model->id) ) {
                foreach ($columns as $column => $options) {
                    $data[$model->id][$column] = $this->getColumnValue($column, $model, $options);
                }

            } else {
                $rows = $model->all();

                foreach($rows as $key => $row) {
                    foreach ($columns as $column => $options) {
                        $data[$key][$column] = $this->getColumnValue($column, $row, $options);
                    }
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