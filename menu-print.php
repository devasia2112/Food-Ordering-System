<?php
error_reporting(0);
ob_start();
include 'admin/controller/fpdf16/fpdf.php';
require 'includes/config/config.php';
include 'includes/Sql/sql.class.php';
$array_company = GenericSql::getEmpresa();
$c_image = 'images/logo/' . $array_company[logotipo];
// call company data here does not work!!!! need to be manually hardcoded.. better find another solution for PDFs.

class PDF extends FPDF
{
	var $B;
	var $I;
	var $U;
	var $HREF;

    //Page header
    function Header()
    {
        //Logo
        $this->Image( 'images/logo/350x120.gif', 10, 8, 58 );

        //Arial bold 15
        $this->SetFont('Arial','I',12);
        //Move to the right
        $this->Cell(160);
        //Title
        $this->Cell(30,10,'Food Ordering System',0,0,'R');
        //Line break
        $this->Ln(17);

        //Arial bold 12
        $this->SetFont('Arial','B',12);
        //Title
        $this->Cell(30,10,'Call +00 (00) 0000 0000 to place your order',0,0,'L');
        //Line break
        $this->Ln(5);

        //Arial bold 12
        $this->SetFont('Arial','B',12);
        //Title
        $this->Cell(30,10,'Orders for group with 6 hours in advance, we delivery at your place.',0,0,'L');
        //Line break
        $this->Ln(10);
    }
    //Page footer
    function Footer()
    {
        $datahoje = date("Y-m-d H:i:s");
        //Position at 1.5 cm from bottom
        $this->SetY(-15);

        //Arial bold 8
        $this->SetFont('Arial','B',12);
        $this->SetTextColor(0,0,0);
        //Title
        $this->Cell(30,10,'Call +00 (00) 0000 0000 to place your order',0,0,'L');

        //Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(0,0,0);
        //Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C'); ///{nb}

        //Arial bold 15
        $this->SetFont('Arial','I',8);
        //Move to the right
        $this->Cell(-20);
        //Title
        $this->Cell(0,10,$datahoje,0,0,'L');
    }

    //Load data
    function LoadData($file)
    {
        //Read file lines
        $lines=file($file);
        $data=array();
        foreach($lines as $line)
            $data[]=explode(';',chop($line));
        return $data;
    }


    //Colored table
    function FancyTable($header,$data)
    {
        //Colors, line width and bold font
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(255,255,255);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(.1);
        $this->SetFont('Arial','', 10);
        //Header
        $w=array(20,150,20);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],6,$header[$i],1,0,'L',true);
        $this->Ln();
        //Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 10);
        //Data
        $fill=false;
        foreach($data as $row)
        {
            $this->Cell($w[0],4,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],4,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],4,$row[2],'LR',0,'L',$fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }




    // Write custom HTML code
    function PDF($orientation='P', $unit='mm', $size='A4')
    {
        // Call parent constructor
        $this->FPDF($orientation,$unit,$size);
        // Initialization
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
    }
    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }
    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    // Write custom HTML code





}


//$html = "<br /><br /><b>Servicos de Personal Chef e Entregas</b><br /><br />
//Kinthai atende a diversas ocasioes seja ela um encontro familiar, uma reuniao de negocios, uma comemoracao entre amigos e mesmo individual, isso mesmo temos um atendimento exclusivo para uma pessoa. <br />
//Nos aceitamos pagamentos via Dinheiro, Visa, Amex (American Express), Diners e MasterCard. <br />
//";

$pdf = new PDF();
//Column titles
$header = array('COD.','MENU','$');
//Data loading
$data = $pdf->LoadData('menu.txt');
//Logo
$pdf -> SetFont('Arial','',12);
$pdf -> AddPage();
$pdf -> FancyTable($header,$data);

// Write out my custom terms and conditions
$pdf -> SetLeftMargin(10);
$pdf -> SetFontSize(12);
$pdf -> WriteHTML($html);

$pdf -> Output();
?>
