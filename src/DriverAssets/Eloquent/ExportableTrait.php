<?php

namespace DataExporter\DriverAssets\Eloquent;

use Flysap\Scaffold\ScaffoldAble;

trait ExportableTrait {

    /**
     * Get columns for exporting .
     *
     * @return mixed
     */
    public function getExportColumns() {
        if( $this instanceof ScaffoldAble )
            return $this->skyShow();

        return $this->getFillable();
    }

}