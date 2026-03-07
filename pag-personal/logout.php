<?php
session_start();
session_unset();
session_destroy();

// Redireciona para a home
header("Location: ../pag-menu/home.html");
exit;
