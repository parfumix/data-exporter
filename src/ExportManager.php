<?php

namespace DataExporter;

class ExportManager {

    /**
     * @var
     */
    protected $exporters;

    public function __construct(array $configurations = array()) {

        $this->configurations = $configurations;

        $this->setExporters($configurations['exporters']);
    }


    /**
     * Set exporters .
     *
     * @param array $exporters
     * @return $this
     */
    public function setExporters(array $exporters) {
        $this->exporters = $exporters;

        return $this;
    }

    /**
     * Get all exporters .
     *
     * @return mixed
     */
    public function getExporters() {
        return $this->exporters;
    }

    public function hasExporter($exporter) {
        $exporters = $this->getExporters();

        $exporter = strtolower(trim($exporter));

        if (! isset($exporters[$exporter]))
            return false;

        return true;
    }

    /**
     * Load Exporter by alias .
     *
     * @param $exporter
     * @return mixed
     * @throws ExporterException
     */
    public function loadExporter($exporter) {
        $exporters = $this->getExporters();

        if (! $this->hasExporter($exporter))
            throw new $this("Exporter [$exporter] not supported.");

        $class = $exporters[$exporter]['class'];

        if (! class_exists($class))
            throw new ExporterException("Exporter [$exporter] not found.");

        return (new $class(
            array_except($exporters[$exporter], 'class')
        ));
    }


    /**
     * Export to .
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws ExporterException
     */
    public function __call($name, $arguments) {
        $name = substr($name, 2);

        $exporter = $this->loadExporter($name);

        list($driver, $options) = $arguments;

        return $exporter->export(
            $driver, $options
        );
    }
}