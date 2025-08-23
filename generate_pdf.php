<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setChroot(__DIR__);


$dompdf = new Dompdf($options);


$htmlContent = require_once 'page.php';


$dompdf->loadHtml($htmlContent);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();


//Attachment : true = force download or false = open in browser
$dompdf->stream('sample.pdf', ['Attachment' => false]);
