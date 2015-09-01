<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;
use XLSXWriter;

class Xls extends Exporter implements ExporterInterface {

    /**
     * @var
     */
    protected $header;


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
            $this->getWriter()->setHeader($header);

        $this->getWriter()->addSheet('Sheet1');
        $this->getWriter()->setData($data);

        return $this->getWriter();
    }
}