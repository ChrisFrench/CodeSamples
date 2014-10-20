<?php 
namespace Proposals\Admin\Controllers;

class Pdf extends \Admin\Controllers\BaseAuth 
{
   
    public function generate($f3) {
        //LOAD the Data for the proposal from the database
        $id = $f3->get('PARAMS.id');
        $proposal = (new \Proposals\Admin\Models\Proposals)->setState('filter.id', $id)->getItem();
        
        $f3->set('proposal', $proposal);
        
        //Load Custom Config
        define('K_TCPDF_EXTERNAL_CONFIG', true);
        \Proposals\RystPDFConfig::config();
        
        // Include the main TCPDF library (search for installation path).
        //Override config
        $pdf = new \Proposals\Admin\Lib\RystPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // create new PDF document with our new class

        // set document information
        $pdf->SetCreator('Ryst');
        $pdf->SetAuthor('Ryst');
        $pdf->SetTitle('Ryst Proposal');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

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

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.


        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

	$fontname = $pdf->addTTFfont( 'herolight', 'OpenTypeUnicode', '', 32);
	$pdf->SetFont('herolight', 14);

	// get the current page break margin	
	$bMargin = $pdf->getBreakMargin();
	// get current auto-page-break mode
	$auto_page_break = $pdf->getAutoPageBreak();
	// disable auto-page-break
	$pdf->SetAutoPageBreak(false, 0);
	// set bacground image
	$img_file = K_PATH_IMAGES.'pdfbg.png';
	$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
	// restore auto-page-break status
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	// set the starting point for the page content
	$pdf->setPageMark();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(0,0,0), 'opacity'=>1, 'blend_mode'=>'Normal'));
        // We should be able to generate the HTML like this
        $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Proposals/Admin/Views::pdf/cover.php' );
        // Print text using writeHTMLCell()

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

	// get the current page break margin	
	$bMargin = $pdf->getBreakMargin();
	// get current auto-page-break mode
	$auto_page_break = $pdf->getAutoPageBreak();
	// disable auto-page-break
	$pdf->SetAutoPageBreak(false, 0);
	// set bacground image
	$img_file = K_PATH_IMAGES.'pdfbg2.png';
	$pdf->Image($img_file, 0, 0, 210, 239, '', '', '', false, 300, '', false, false, 0);
	// restore auto-page-break status
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	// set the starting point for the page content
	$pdf->setPageMark();

	 $pdf->SetFont('helvetica', 14);
        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        // We should be able to generate the HTML like this
        $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Proposals/Admin/Views::pdf/page1.php' );
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

	// get the current page break margin	
	$bMargin = $pdf->getBreakMargin();
	// get current auto-page-break mode
	$auto_page_break = $pdf->getAutoPageBreak();
	// disable auto-page-break 
	$pdf->SetAutoPageBreak(false, 0);
	// set bacground image
	$img_file = K_PATH_IMAGES.'pdfbg2.png';
	$pdf->Image($img_file, 0, 0, 210, 239, '', '', '', false, 300, '', false, false, 0);
	// restore auto-page-break status
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	// set the starting point for the page content
	$pdf->setPageMark();

	 $pdf->SetFont('helvetica', 14);
        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        // We should be able to generate the HTML like this
        $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Proposals/Admin/Views::pdf/page2.php' );
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


    // ---------------------------------------------------------

    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('example_001.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
        
    }


}