<?php
header("Content-Type: text/plain ; charset=utf-8");
header("Cache-Control: no-cache , private");
header("Pragma: no-cache");

function FormatVCAPProps($PROP) {

	$services_props = json_decode($_ENV['VCAP_SERVICES'], true);
	foreach($services_props as $service_provider => $service_list)
	{
		foreach ($service_list as $some_service)
		{
			if (strpos($some_service['name'], $PROP) !== false)
			{
				$vcap_props[] = $some_service;
			}
		}
	}
	$app_props = json_decode($_ENV['VCAP_APPLICATION'], true);
	foreach($app_props as $app_key => $app_value)
	{
		foreach($app_value as $app_subvalue)
		{
			if ((strpos($app_subvalue, $PROP)) !== false)
			{
				$vcap_props[] = $app_value . ":" . $app_subvalue;
			}
			else
			{
				return array();
			}
		}
		if ((strpos($app_key, $PROP)) !== false)
		{
			$vcap_props[] = $app_key . ":" . $app_value;
		}
		else
		{
			return array();
		}
	}
	/*
	$scheme = ($_SERVER['HTTPS'] != '') ? 'https' : 'http';
	$cfg['PmaAbsoluteUri'] = $scheme . '://' . $appCfg['uris'][0] . "/";
	*/
	return $vcap_props;
}

$size=0;
$IPSTACK = $_ENV['CF_INSTANCE_ADDR'];
$HOME = $_ENV['HOME'];
$PWD = $_ENV['PWD'];
$TMPDIR = $_ENV['TMPDIR'];
$USER = $_ENV['USER'];
$LEVEL = $_ENV['LEVEL'];
$WEATHER = $_ENV['WEATHER'];
$Response = [ $IPSTACK , $HOME, $PWD, $TMPDIR, $USER, $LEVEL, $WEATHER ];
$vcap_props = array();
$stdout = fopen('mylog.log', 'w');
file_put_contents('php://stdout', 'Jai detecte dans le manifest les app properties suivantes : \n ' . $LEVEL . '\n ' . $WEATHER);
if(isset($_REQUEST['term']))
{
	$PROP=trim(strtolower($_REQUEST['term']));
	foreach($Response as $value)
	{
		if ($value == $PROP)
		{
			$vcap_props[] = FormatVCAPProps($value);
		}
	}
}
else {
	die();
}


//$VCAPPROPS = FormatVCAPProps($PROP);
echo json_encode($vcap_props);
?>
