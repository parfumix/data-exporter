<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;

class Pdf extends Exporter implements ExporterInterface {

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            app('excel')
        );
    }

    /**
     * Export data ..
     *
     * @param $filename
     * @param callable $callback
     * @return mixed
     */
    public function export($filename = null, \Closure $callback = null) {
        $fullPath = $this->fullPath($filename);

        $fileInfo = pathinfo($fullPath);

        $this->getWriter()->create($fileInfo['filename'], function($excel) use($callback, $filename) {
            $data = $this->getDriver()->getData();

            if(! is_null($callback)) {
                $callback($excel, $data);
            } else {
                $excel->sheet($filename, function($sheet) use($data) {

                    if( $template = $this->getTemplate() ) {
                        if( $font = $template->getFontStyle() )
                            $sheet->setFont($font);
                    }

                    $sheet->fromArray($data);
                });
            }
        })->save('xls', $fileInfo['dirname']);

        return $fullPath;
    }
}