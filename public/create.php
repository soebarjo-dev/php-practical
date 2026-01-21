<?php
ob_start();

require "../views/form.php";
$content = ob_get_clean();

require "../views/layout.php";