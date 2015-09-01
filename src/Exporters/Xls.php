<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;
use XLSXWriter;

class Xls extends Exporter implements ExporterInterface {

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            new XLSXWriter()
        );
    }

    /**
     * Export data ..
     *
     * @param $path
     * @return mixed
     */
    public function export($path = null) {
        if(is_null($path))
            $path = $this->getDefaultPath(true);

        $data    = $this->getDriver()->getData();
        $writer  = $this->getWriter();

        $writer->writeSheet($data, '', $this->getHeader());

        $writer->writeToFile($path);

        return $path;
    }

}