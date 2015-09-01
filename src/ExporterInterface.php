<?php

namespace DataExporter;

interface ExporterInterface {

    public function export(array $options = array());
}