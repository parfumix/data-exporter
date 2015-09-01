<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;
use XLSXWriter;

class Xls extends Exporter implements ExporterInterface {

    /**
     * @var
     */
    protected $header = [];

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            new XLSXWriter()
        );
    }

    /**
     * Set header .
     *
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header = array()) {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the header .
     *
     * @return mixed
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * Export data ..
     *
     * @return mixed
     */
    public function export() {
        $data = $this->getDriver()->getData();

        $this->getWriter()->writeSheet($data, '', $this->getHeader());

        return $this->getWriter();
    }
}