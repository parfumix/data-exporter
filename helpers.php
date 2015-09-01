<?php

namespace DataExporter;

/**
 * Export data to
 *
 * @param $exporter
 * @param DriverInterface $driver
 * @param array $options
 * @return mixed
 */
function export($exporter, DriverInterface $driver, array $options = array()) {
    $exporter = get_exporter($exporter, $driver, $options);

    return $exporter->export();
}

/**
 * Get exporter instance .
 *
 * @param $exporter
 * @param DriverInterface $driver
 * @param array $options
 * @return mixed
 */
function get_exporter($exporter, DriverInterface $driver, array $options = array()) {
    $func = 'get'.$exporter;
    $exporter = app('laravel-exporter')->$func(
        $driver, $options
    );

    return $exporter;
}