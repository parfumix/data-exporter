<?php

namespace DataExporter;

interface ExporterInterface {

    /**
     * Save to disk .
     *
     * @param $path
     * @param callable $callback
     * @return mixed
     */
    public function export($path = null, \Closure $callback = null);

    /**
     * Download export attachment .
     *
     * @param null $path
     * @param callable $callback
     * @return mixed
     */
    public function download($path = null, \Closure $callback = null);
}