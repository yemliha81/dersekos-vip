<?php
echo date_default_timezone_get() . "
";
date_default_timezone_set('Europe/Istanbul');
echo date_default_timezone_get() . "
";
echo date('Y-m-d H:i:s');
?>