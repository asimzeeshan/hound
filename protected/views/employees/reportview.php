<?php
    // get the HTML
    ob_start();
    echo $this->renderPartial('reportviewcontent',array(
	'model'=>$model,
	));
    $content = ob_get_clean();
 
    // convert in PDF
    Yii::import('application.extensions.tcpdf1234.HTML2PDF');
    try
    {
        $html2pdf = new HTML2PDF('L', 'A4', 'en');
     //$html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output("All Employees List.pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>