<?php


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $this->SetY(15);
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 15, 'Noticia Exportada', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 15, base_url(uri_string()), 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}


if(isset($_GET['print'])){
    if($_GET['print']=="true"){
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Artur Boladeres');
        $pdf->SetTitle($news_item["title"]);
        $pdf->SetSubject($news_item["title"]);
        $pdf->SetKeywords('noticia exportada');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage();

        $contingut= '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            
        </head>
        <body>

        <h2 style="background-color: lightgrey;">'.$news_item["title"].'</h2>
        <p>'.$news_item["text"].'</p>
            
        </body>
        </html>
        ';

        $pdf->writeHTML($contingut, true, false, true, false, '');


        $pdf->Output('noticia-' . $news_item['title'] . '.pdf', 'D');
    }else{
        echo '<h2>'.$news_item['title'].'</h2>';
        echo '<p>'. $news_item['text'] .'</p>';
        echo '<a href="?print=true" class="btn btn-primary">Descargar PDF</a>';
    }
}else{
    echo '<h2>'.$news_item['title'].'</h2>';
    echo '<p>'. $news_item['text'] .'</p>';
    echo '<a href="?print=true" class="btn btn-primary">Descargar PDF</a>';
}




