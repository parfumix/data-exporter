<?php

namespace DataExporter;

use Flysap\Support;

abstract class Exporter {

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

    /**
     * @var
     */
    protected $template;

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
        $this->options = [];
        $this->addOptions($options);

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

        if( isset($options['template']) )
            $this->setTemplate((new Template($options['template'])));

        if( isset($options['filename']) )
            $this->setFilename($options['filename']);

        if( isset($options['header']) )
            $this->setHeader($options['header']);

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
     * Set style template
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template) {
        $this->template = $template;

        return $this;
    }

    /**
     * Get style template .
     *
     * @return mixed
     */
    public function getTemplate() {
        return $this->template;
    }


    /**
     * Get default path .
     *
     * @param null $filename
     * @return string
     */
    protected function fullPath($filename = null) {
        if( ! $path = config('laravel-exporter')['default_path'])
            $path = '';

        #@todo check for storage path, we need use without laravel .
        $path = storage_path($path);

        if( is_null($filename) )
            $filename = $this->getFilename();

        if(! Support\is_path_exists($path))
            Support\mk_path($path);

        return  $path . DIRECTORY_SEPARATOR . $filename;
    }

    /**
     * Download export attachment .
     *
     * @param null $filename
     * @param callable $callback
     * @return mixed
     */
    public function download($filename = null, \Closure $callback = null) {
        $saved = $this->export(
            $filename, $callback
        );

        $file_info = pathinfo($saved);

        $headers = isset($this->options['headers']) ? $this->options['headers'] : [];

        return Support\download_file($saved, $file_info['filename'] . '.' . $file_info['extension'], $headers['content-type']);
    }
}