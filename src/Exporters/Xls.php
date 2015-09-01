<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;
use Flysap\Support;

class Xls extends Exporter implements ExporterInterface {

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            app('excel')
        );
    }

    /**
     * Export data ..
     *
     * @param $filename
     * @return mixed
     */
    public function export($filename = null) {
        $fullPath = $this->fullPath($filename);

        $fileInfo = pathinfo($fullPath);

        $this->getWriter()->create(
            $fileInfo['filename']
        )->save('xls', $fileInfo['dirname']);

        return $fullPath;
    }

}