<?php
include "common.php";
session_destroy();
session_regenerate_id(true);
redirect("./index.php")
?>