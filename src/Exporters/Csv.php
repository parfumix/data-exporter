<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;

class Csv extends Exporter implements ExporterInterface {

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            app('excel')
        );
    }

    public function export($filename = null) {
        $fullPath = $this->fullPath($filename);

        $fileInfo = pathinfo($fullPath);

        $this->getWriter()->create(
            $fileInfo['filename']
        )->save('csv', $fileInfo['dirname']);

        return $fullPath;
    }
}