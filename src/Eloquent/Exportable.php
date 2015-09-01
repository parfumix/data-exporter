<?php

namespace DataExporter\Eloquent;

interface Exportable {

    /**
     * Export fields .
     *
     * @return mixed
     */
    public function export();
}