<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;

class Xls extends Exporter implements ExporterInterface {

    /**
     * @var
     */
    protected $header;

    public function __construct(array $options = array()) {
        parent::__construct($options);
    }

    /**
     * Set header .
     *
     * @param array $header
     * @param array $options
     */
    public function setHeader(array $header = array(), array $options = array()) {

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
     * @param array $options
     * @param callable $callback
     * @return mixed
     */
    public function export(array $options = array(), \Closure $callback = null) {
        if( ! is_null($callback) )
            $data = $callback(
                $this->getDriver()->getData()
            );

        if( $header = $this->getHeader() )
            $this->xls->setHeader($header);

        $this->xls->addSheet('Sheet1');
        $this->xls->setData($data);

        return $this->xls;
    }
}