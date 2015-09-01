<?php

namespace DataExporter;

interface ExporterInterface {

    /**
     * Save to disk .
     *
     * @param $path
     * @return mixed
     */
    public function export($path = null);

    /**
     * Download export attachment .
     *
     * @param null $path
     * @return mixed
     */
    public function download($path = null);
}