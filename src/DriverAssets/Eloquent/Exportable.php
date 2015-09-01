<?php

namespace DataExporter\DriverAssets\Eloquent;

interface Exportable {

    /**
     * Export fields .
     *
     * @return mixed
     */
    public function getExportColumns();
}