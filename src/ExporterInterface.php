<?php

namespace DataExporter;

interface ExporterInterface {

    public function export(DriverInterface $driver, array $options = array());
}