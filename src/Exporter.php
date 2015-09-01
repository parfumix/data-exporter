<?php

namespace DataExporter;

use Flysap\Support;

abstract class Exporter {

    const DEFAULT_PATH = 'xls';

    /**
     * @var array
     */
    protected $options;

    /**
     * @var
     */
    protected $driver;

    /**
     * @var
     */
    protected $writer;

    /**
     * @var
     */
    protected $header = [];

    /**
     * @var
     */
    protected $filename;

    public function __construct(array $options = array()) {
        $this->setOptions($options);
    }


    /**
     * Set options ..
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options = array()) {
        $this->options = $options;

        return $this;
    }

    /**
     * Add new options .
     *
     * @param array $options
     * @return $this
     */
    public function addOptions(array $options = array()) {
        $this->options = array_merge($options, $this->options);

        return $this;
    }

    /**
     * Get options ..
     *
     * @return array
     */
    public function getOptions() {
        return $this->options;
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
     * Set writter .
     *
     * @param $writer
     * @return $this
     */
    public function setWriter($writer) {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Get writter .
     *
     * @return mixed
     */
    public function getWriter() {
        return $this->writer;
    }


    /**
     * Set driver source .
     *
     * @param DriverInterface $driver
     * @return $this
     */
    public function setDriver(DriverInterface $driver) {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver source .
     *
     * @return mixed
     */
    public function getDriver() {
        return $this->driver;
    }


    /**
     * Set filename .
     *
     * @param $filename
     * @return $this
     */
    public function setFilename($filename) {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename .
     *
     * @return mixed
     */
    public function getFilename() {
        if(!  $filename = $this->filename) {

            $class    = explode('\\',get_called_class());
            $class    = end($class);
            $filename = date('Y_m_d_H_i_s') .'_'. microtime(true) . '.' . strtolower($class);
        }

        return $filename;
    }


    /**
     * Get default path .
     *
     * @param bool $assFull
     * @return string
     */
    protected function getDefaultPath($assFull = true) {
        $defaultPath = self::DEFAULT_PATH;

        if( isset($this->options['save_path']))
            $defaultPath = $this->options['save_path'];

        #@todo check for storage path, we need use without laravel .
        $path = storage_path($defaultPath);

        if($assFull)
            return  $path . DIRECTORY_SEPARATOR . $this->getFilename();

        return $path;
    }

    /**
     * Download export attachment .
     *
     * @param null $path
     * @return mixed
     */
    public function download($path = null) {
        if( is_null($path) )
            $path = $this->getDefaultPath(false);

        if(! Support\is_path_exists($path))
            Support\mk_path($path);

        $saved = $this->export(
            $this->getDefaultPath(true)
        );

        $file_info = pathinfo($saved);

        $headers = isset($this->options['headers']) ? $this->options['headers'] : [];

        return Support\download_file($saved, $file_info['filename'] . '.' . $file_info['extension'], $headers['content-type']);
    }
}