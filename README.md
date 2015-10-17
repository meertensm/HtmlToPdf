# HtmlToPdf
[![Latest Stable Version](https://poser.pugx.org/mcs/HtmlToPdf/v/stable)](https://packagist.org/packages/mcs/HtmlToPdf) [![Total Downloads](https://poser.pugx.org/mcs/HtmlToPdf/downloads)](https://packagist.org/packages/mcs/HtmlToPdf) [![Latest Unstable Version](https://poser.pugx.org/mcs/HtmlToPdf/v/unstable)](https://packagist.org/packages/mcs/HtmlToPdf) [![License](https://poser.pugx.org/mcs/HtmlToPdf/license)](https://packagist.org/packages/mcs/HtmlToPdf)

Installation:
```bash
$ composer require mcs/HtmlToPdf
```

Features:
 * Convert an html string to a pdf string
 * Does not use temporary files

Basic usage:

```php
require_once 'vendor/autoload.php';

use \MCS\HtmlToPdf;

try{

    $pdf = new HtmlToPdf('<html><body>Hi!<body></html>', '/usr/local/bin/wkhtmltopdf');

    header('Content-Type: application/pdf');

    echo $pdf->generate();

}
catch(Exception $e){
    echo $e->getMessage();
}
```

Advanced usage:

```php
use \MCS\HtmlToPdf;

try{

    //Get your html string
    $html = file_get_contents('demo.html');

    // Path to wkhtmltopdf
    $pathToWkhtmltopdf = '/usr/local/bin/wkhtmltopdf';

    // Initialise
    $pdf = new HtmlToPdf('<html><body>Hi!<body></html>', '/usr/local/bin/wkhtmltopdf');

    // Add a command before the wkhtmltopdf command
    $pdf->addBeforeCommand('unset DYLD_LIBRARY_PATH');

    // Add wkhtmltopdf parameters, second parameter is optional. See: http://wkhtmltopdf.org/usage/wkhtmltopdf.txt
    $pdf->setParam('grayscale');
    $pdf->setParam('orientation', 'landscape');

    // Execute
    $pdfString = $pdf->generate();

    // Show the generated pdf
    header('Content-Type: application/pdf');
    die($pdfString);

}
catch(Exception $e){
    echo $e->getMessage();
}
```
