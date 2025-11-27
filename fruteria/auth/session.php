<?php
declare(strict_types=1);

session_start();

if (empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

