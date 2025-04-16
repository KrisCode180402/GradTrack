<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/app/Controllers/StudentController.php';

$studentCtrl = new StudentController();
$studentCtrl->dashboard();
?>
