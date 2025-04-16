<?php
// includes/functions.php

// Redirect helper
function redirect($url)
{
    header("Location: " . $url);
    exit;
}
?>