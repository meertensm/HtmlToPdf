<?php

    require_once 'vendor/autoload.php';

    use \MCS\HtmlToPdf;

    try{

        //Get your html string
        $html = file_get_contents('demo.html');

        // Path to wkhtmltopdf
        $pathToWkhtmltopdf = '/usr/local/bin/wkhtmltopdf';

        // Initialise
        $pdf = new HtmlToPdf($html, $pathToWkhtmltopdf);

        // Add a command before the wkhtmltopdf command
        // $pdf->addBeforeCommand('unset DYLD_LIBRARY_PATH');

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

