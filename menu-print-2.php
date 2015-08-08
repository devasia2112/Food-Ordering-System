<?php
require('admin/controller/fpdf16/fpdf.php');
include('includes/config/config.php');
include('includes/Sql/sql.class.php');
include('includes/lang/pt-br.php');

// Query products
$sql = "SELECT p.product_code, p.image, p.name, p.description, pa.price "
     . "FROM products p "
     . "LEFT JOIN products_atributes pa ON pa.product_id = p.id "
     . "WHERE p.active=1 ORDER BY p.category_id ASC";
$res = mysql_query($sql) or die("error: query produtos");
$dados = array();
while ($row = mysql_fetch_array($res))
{
    $product_code = $row['product_code'];
    $image = $row['image'];
    $product_name = $row['name'];
    $product_description = $row['description'];
    $price = $row['price'];

    if ($price == null) $price = "0.00";
    
    $dados[] = array( "product_code" => $product_code,
		      "product_image" => $image,
		      "product_name" => $product_name,
		      "product_description" => $product_description,
		      "price" => $price );
}
//$result = file_put_contents('menu.txt', $dados);
//if (!empty($result)) echo "Menu do cliente gerado com sucesso. Formato do arquivo: PDF.<hr />";
//echo "<a href='menu-print.php'>Visualizar Arquivo</a>";

// display data for debug
//print "<pre>";print_r( $dados );print "</pre>";

  
  
class PDF extends FPDF
{
  var $B;
  var $I;
  var $U;
  var $HREF;

  function PDF($orientation='P',$unit='mm',$format='A4')
  {
      //Call parent constructor
      $this->FPDF($orientation,$unit,$format);
      //Initialization
      $this->B=0;
      $this->I=0;
      $this->U=0;
      $this->HREF='';
  }

  function WriteHTML($html)
  {
      //HTML parser
      $html=str_replace("\n",' ',$html);
      $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
      foreach($a as $i=>$e)
      {
	  if($i%2==0)
	  {
	      //Text
	      if($this->HREF)
		  $this->PutLink($this->HREF,$e);
	      else
		  $this->Write(5,$e);
	  }
	  else
	  {
	      //Tag
	      if($e[0]=='/')
		  $this->CloseTag(strtoupper(substr($e,1)));
	      else
	      {
		  //Extract attributes
		  $a2=explode(' ',$e);
		  $tag=strtoupper(array_shift($a2));
		  $attr=array();
		  foreach($a2 as $v)
		  {
		      if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
			  $attr[strtoupper($a3[1])]=$a3[2];
		  }
		  $this->OpenTag($tag,$attr);
	      }
	  }
      }
  }

  function OpenTag($tag,$attr)
  {
      //Opening tag
      if($tag=='B' || $tag=='I' || $tag=='U')
	  $this->SetStyle($tag,true);
      if($tag=='A')
	  $this->HREF=$attr['HREF'];
      if($tag=='BR')
	  $this->Ln(5);
  }

  function CloseTag($tag)
  {
      //Closing tag
      if($tag=='B' || $tag=='I' || $tag=='U')
	  $this->SetStyle($tag,false);
      if($tag=='A')
	  $this->HREF='';
  }

  function SetStyle($tag,$enable)
  {
      //Modify style and select corresponding font
      $this->$tag+=($enable ? 1 : -1);
      $style='';
      foreach(array('B','I','U') as $s)
      {
	  if($this->$s>0)
	      $style.=$s;
      }
      $this->SetFont('',$style);
  }

  function PutLink($URL,$txt)
  {
      //Put a hyperlink
      $this->SetTextColor(0,0,255);
      $this->SetStyle('U',true);
      $this->Write(5,$txt,$URL);
      $this->SetStyle('U',false);
      $this->SetTextColor(0);
  }

}



$pdf=new PDF();

//First page
$pdf->AddPage();
$pdf->SetFont('Arial','',50);
$pdf->Write(55,'MENU');
$pdf->Image('images/logo/thai-giant-statue-anek-suwannaphoom.jpg',70,70,60,0,'','http://www.kinthai.com.br');
$pdf->SetFont('Arial','',50);
$link=$pdf->AddLink('http://www.kinthai.com.br');
//$pdf->Write(55,'KINTHAI',$link);
$pdf->SetFont('');

//Second page
$pdf->AddPage();
$pdf->SetLink($link);



$n = 10;
$pp = 1;
$pn = 10;


foreach( $dados as $each ) {

/*
  echo $each[product_code];
  echo $each[product_image];
  echo $each[product_name];
  echo $each[product_description];
  echo $each[price];
*/

  if($pp == 5) {
    $n = 10;
    $pp = 1;
    $pn = 10;
    // add another page
    $pdf->AddPage();
  }
  
  

  
  
  
  
  
  
  $pdf->Image('admin/uploads/'.$each[product_image].'',10,$n,60,0,'jpg','');

  // set product name
  $pdf->SetFont('Arial','',15);
  $pdf->SetLeftMargin(75);
  $pdf->Write($pn, $each[product_name] . ' '.$pn.' ......... R$' . $each[price]);
  
  
  // set product description
  $pdf->SetFont('Arial','',10);
  //$pdf->SetLeftMargin(75);
  //$pdf->Write($n, $each[product_description]);
  $pdf->WriteHTML('<br /><br />' . $each[product_description]);
  

  
  
  
  

  
  //$pdf->SetLeftMargin(75);
  //$pdf->SetFontSize(11);
  //$pdf->WriteHTML($each[product_name]);
  //$pdf->WriteHTML($each[product_description]);
  
  $n +=70;
  $pp +=1;
  $pn +=80;
}




//$pdf->SetLeftMargin(45);
//$pdf->SetFontSize(14);
//$pdf->WriteHTML($html);
$pdf->Output();
?>