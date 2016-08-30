<?php
/**
 * Copyright (C) 2016 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 30/08/2016
 */
echo "Apache is shutting down<br>";
flush();
exec('pkill httpd 2>&1', $res);
echo "Apache is down see the app restart : " . $res . "<br>";
flush();