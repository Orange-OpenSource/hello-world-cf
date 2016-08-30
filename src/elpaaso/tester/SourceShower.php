<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 16/07/2014
 */


namespace elpaaso\tester;


class SourceShower
{
    private $filename;
    private $language;

    public function __construct($filename, $language = "php")
    {
        if (!is_file($filename)) {
            throw new \Exception('File "' . $filename . '" doesn\'t exist');
        }
        $this->filename = $filename;
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    public function __toString()
    {
        $text = '<pre class="language-' . $this->language . ' line-numbers"><code>';
        $text .= htmlentities(file_get_contents($this->filename));
        $text .= '</code></pre>';
        return $text;
    }
} 