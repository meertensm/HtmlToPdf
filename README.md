# HtmlToPdf
[![Latest Stable Version](https://poser.pugx.org/mcs/html-to-pdf/v/stable)](https://packagist.org/packages/mcs/html-to-pdf) [![Total Downloads](https://poser.pugx.org/mcs/html-to-pdf/downloads)](https://packagist.org/packages/mcs/html-to-pdf) [![Latest Unstable Version](https://poser.pugx.org/mcs/html-to-pdf/v/unstable)](https://packagist.org/packages/mcs/html-to-pdf) [![License](https://poser.pugx.org/mcs/html-to-pdf/license)](https://packagist.org/packages/mcs/html-to-pdf)

Installation:
```bash
$ composer require mcs/html-to-pdf
```

Features:
 * Convert an html string to a pdf string using wkhtmltopdf
 * Does not use temporary files

Basic usage:

```php
try{

    $pdf = new MCS\HtmlToPdf('<html><body>Hi!<body></html>', '/usr/local/bin/wkhtmltopdf');

    header('Content-Type: application/pdf');

    echo $pdf->generate();

}
catch(Exception $e){
    echo $e->getMessage();
}
```

Advanced usage:

```php
try{

    //Get your html string
    $html = file_get_contents('demo.html');

    // Path to wkhtmltopdf
    $pathToWkhtmltopdf = '/usr/local/bin/wkhtmltopdf';

    // Initialise
    $pdf = new MCS\HtmlToPdf($html, $pathToWkhtmltopdf);

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
