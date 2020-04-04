<?php declare(strict_types=1); ?>
<?php

include 'src/Controller.php';

use Controller\Business;

$app = new Business();

echo $app->execute($argv[1]);


?>