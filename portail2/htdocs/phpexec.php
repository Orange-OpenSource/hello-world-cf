<?php
echo "Je vais tuer httpd !!<br>";
flush();
exec('pkill httpd 2>&1', $res);
$Response = "il s'est passe : " . $res . "<br>";
echo json_encode($Response);
flush();

?>