<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 22/08/2014
 */

//Logs directly in loggregator
file_put_contents('php://stdout', "Test logging stdout\n");
file_put_contents('php://stderr', "Test logging stderr\n");