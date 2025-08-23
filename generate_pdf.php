<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setChroot(__DIR__);


$dompdf = new Dompdf($options);


ob_start(); ?>
<h1>Sample PDF</h1>
<img src="/img/logo_underline.png" alt="novocib logo">
<p>This is a sample PDF generated from HTML content.</p>
<?php $htmlContent = ob_get_clean();


$dompdf->loadHtml($htmlContent);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();


//Attachment : true = force download or false = open in browser
$dompdf->stream('sample.pdf', ['Attachment' => false]);
