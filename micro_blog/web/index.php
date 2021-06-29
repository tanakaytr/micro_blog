<?php
require '../bootstrap.php';
require '../MicroblogApplication.php';

$app = new MicroblogApplication(true);
$app->run();