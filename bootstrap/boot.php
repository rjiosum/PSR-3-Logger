<?php
require_once dirname(__DIR__).'/vendor/autoload.php';

$appEnv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$appEnv->load();
