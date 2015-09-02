<?php

namespace DataExporter;

class Template {

    protected $options;

    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    /**
     * Set font style .
     *
     * @param $family
     * @param null $size
     * @param bool $bold
     * @return $this
     */
    public function setFontStyle($family, $size = null, $bold = false) {
        $this->options['font'] = array(
            'family' => $family,
            'size' => $size,
            'bold' => $bold,
        );

        return $this;
    }

    /**
     * Get font style .
     *
     * @return mixed
     */
    public function getFontStyle() {
        return $this->options['font'];
    }

    /**
     * Set background color
     *
     * @param $color
     * @return $this
     */
    public function setBackgroundColor($color) {
        $this->options['background'] = $color;

        return $this;
    }

    /**
     * Get background color .
     *
     * @return mixed
     */
    public function getBackgroundColor() {
        return $this->options['background'];
    }
}