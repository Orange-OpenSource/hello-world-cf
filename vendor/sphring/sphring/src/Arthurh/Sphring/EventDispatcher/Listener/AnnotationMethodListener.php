<?php
/**
 * Copyright (C) 2014 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 15/10/2014
 */

namespace Arthurh\Sphring\EventDispatcher\Listener;

use Arthurh\Sphring\Enum\SphringEventEnum;

/**
 * EventListener which Triggered event for method annotation
 * Class AnnotationMethodListener
 * @package Arthurh\Sphring\EventDispatcher\Listener
 */
class AnnotationMethodListener extends AnnotationClassListener
{
    /**
     * Return the name of the event triggered
     * @return string
     */
    public function getDefaultEventName()
    {
        return SphringEventEnum::ANNOTATION_METHOD;
    }
}
