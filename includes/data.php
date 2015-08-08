<?php
function tempoRestante($dt_indicador)
{
	$data_atual=date("Y-m-d H:i:s");

	$seg_restante = strtotime($dt_indicador) - strtotime($data_atual);		

    if ($seg_restante<0){
		$seg_esgotado = abs($seg_restante);
		$min_esgotado=floor($seg_esgotado/60);
		$temp_esgotado=floor($min_esgotado/60)."h".($min_esgotado%60)."m".($seg_esgotado%60)."s";
		$temp_restante="$temp_esgotado";
		//$temp_restante="<font color='#FF0000'>-Esgotado hï¿œ:$temp_esgotado</font>";
	}
	else{
		$min_restante=floor($seg_restante/60);
		$temp_restante=floor($min_restante/60)."h".($min_restante%60)."m".($seg_restante%60)."s";
	}
	return $temp_restante;
}



/* Cï¿œdigo Original/ Original Code by Woodys
 * http://www.zend.com/codex.php?id=176
 * 
 * adaptaï¿œï¿œo/traduï¿œï¿œo para o portuguï¿œs e formato brasileiro das datas
 *
 * Alguns exclarecimentos
 * - O que ï¿œ TIMESTAMP do Unix?
 * - ï¿œ a contagem, em segundos, desde o dia 1 de janeiro de 1970 00:00:00 GMT
 *     ,i.e., os segundos que se passaram atï¿œ momento desde as ZERO horas do dia 1 de janeiro de 1970
 *     exemplo:
 *     timestamp = 1042752929  => passaram-se 1042752929 segundos desde 1/jan/1970 00horas 00min 00 seg
 *
 *  Traduï¿œï¿œo e Adaptaï¿œï¿œo by Calvin
 */

/* Converte formato DATE do MySQL para o humano
   2003-12-30 -> 30/12/2003 */
function mysql_date_para_humano($dt) 
{
    if ($dt=="0000-00-00") return '';
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,5,2));
    $da=strval(substr($dt,8,2));
    return date("d/m/Y", mktime (0,0,0,$mo,$da,$yr));
}



/* Converte formato do DATETIME do MySQL para um compreensï¿œvel para os homens
   2003-12-30 23:30:59 -> 30/12/2003 23:30:59 */
function mysql_datetime_para_humano($dt) 
{
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,5,2));
    $da=strval(substr($dt,8,2));
    $hr=strval(substr($dt,11,2));
    $mi=strval(substr($dt,14,2));
    $se=strval(substr($dt,17,2));
    return date("d/m/Y H:i:s", mktime ($hr,$mi,$se,$mo,$da,$yr));
}



/* Converte formato TIMESTAMP do MySQL para o humano
   20031230233029 -> 30/12/2003 23:30:59 */
function mysql_timestamp_para_humano($dt) 
{
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,4,2));
    $da=strval(substr($dt,6,2));
    $hr=strval(substr($dt,8,2));
    $mi=strval(substr($dt,10,2));
    $se=strval(substr($dt,12,2)); 
    return date("d/m/Y H:i:s", mktime ($hr,$mi,$se,$mo,$da,$yr));
}



/* Converte formato TIMESTAMP do MySQL para o humano
   20031230233029 -> 30/12/2003 23:30:59 */
function mysql_timestamp_para_humano_mysql_format($dt) 
{
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,4,2));
    $da=strval(substr($dt,6,2));
    $hr=strval(substr($dt,8,2));
    $mi=strval(substr($dt,10,2));
    $se=strval(substr($dt,12,2));
    return date("Y-m-d H:i:s", mktime ($hr,$mi,$se,$mo,$da,$yr));
}



/* Converte formato TIMESTAMP do Unix para o humano
   1072834230 -> 30/12/2003 23:30:59 */
function timestamp_para_humano($ts) 
{
    $d=getdate($ts);
    $yr=$d["year"];
    $mo=$d["mon"];
    $da=$d["mday"];
    $hr=$d["hours"];
    $mi=$d["minutes"];
    $se=$d["seconds"];
    return date("d/m/Y", mktime($hr,$mi,$se,$mo,$da,$yr));
}



/* Converte formato TIMESTAMP do Unix para o humano
   1072834230 -> 30/12/2003 23:30:59 */
function timestamp_para_humano2($ts) 
{
    $d=getdate($ts);
    $yr=$d["year"];
    $mo=$d["mon"];
    $da=$d["mday"];
    $hr=$d["hours"];
    $mi=$d["minutes"];
    $se=$d["seconds"];
    return date("d/m/Y H:i", mktime($hr,$mi,$se,$mo,$da,$yr));
}



/* Converte o TIMESTAMP do Unix para o TIMESTAMP do MySQL
   1072834230 -> 20031230233029 */
function timestamp_para_mysql_timestamp($ts) 
{
    $d=getdate($ts);
    $yr=$d["year"];
    $mo=$d["mon"];
    $da=$d["mday"];
    $hr=$d["hours"];
    $mi=$d["minutes"];
    $se=$d["seconds"];
    return sprintf("%04d%02d%02d%02d%02d%02d",$yr,$mo,$da,$hr,$mi,$se);
}



/* Converte o TIMESTAMP do Unix para o DATE do MySQL
   1072834230 -> 2003-12-23 */
function timestamp_para_mysql_date($ts) 
{
    $d=getdate($ts);
    $yr=$d["year"];
    $mo=$d["mon"];
    $da=$d["mday"];
    return sprintf("%04d-%02d-%02d",$yr,$mo,$da);
}



/* Converte o TIMESTAMP do Unix para o DATETIME do MySQL
   1072834230 -> 2003-12-23 23:30:59 */
function timestamp_para_mysql_datetime($ts) 
{
    $d=getdate($ts);
    $yr=$d["year"];
    $mo=$d["mon"];
    $da=$d["mday"];
    $hr=$d["hours"];
    $mi=$d["minutes"];
    $se=$d["seconds"];
    return sprintf("%04d-%02d-%02d %02d:%02d:%02d",$yr,$mo,$da,$hr,$mi,$se);
}




/* Converte formato TIMESTAMP do MySQL para o TIMESTAMP do Unix
   20031230233029 -> 1072834230 */
function mysql_timestamp_para_timestamp($dt) 
{
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,4,2));
    $da=strval(substr($dt,6,2));
    $hr=strval(substr($dt,8,2));
    $mi=strval(substr($dt,10,2));
    $se=strval(substr($dt,10,2));
    return mktime($hr,$mi,$se,$mo,$da,$yr);
}



/* Converte formato DATETIME do MySQL para o TIMESTAMP do Unix
   2003-12-30 23:30:59 -> 1072834230 */
function mysql_datetime_para_timestamp($dt) 
{
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,5,2));
    $da=strval(substr($dt,8,2));
    $hr=strval(substr($dt,11,2));
    $mi=strval(substr($dt,14,2));
    $se=strval(substr($dt,17,2));
    return mktime($hr,$mi,$se,$mo,$da,$yr);
}



/* pegar um valor de data (em um formato qualquer) enviado por um usuï¿œrio e transformar no
   formato DATE do MySQL */
function mysql_cvdate($s) 
{
    return timestamp_para_mysql_date(cvdate($s)); 
}




/* Calcula a diferenï¿œa de tempo entre os valores $comeco e $fim e retorno em portuguï¿œs literal a quantidade
   de tempo da diferenï¿œa entre os valores.
  nota: ambos os valores de entrada devem estar no formato timstamp UNIX: */
function timeleft($comeco,$fim) 
{
    $dif=$fim-$comeco;
    $years=intval($dif/(60*60*24*365));
    $dif=$dif-($years*(60*60*24*365));
    $months=intval($dif/(60*60*24*30));
    $dif=$dif-($months*(60*60*24*30));
    $weeks=intval($dif/(60*60*24*7));
    $dif=$dif-($weeks*(60*60*24*7));
    $days=intval($dif/(60*60*24));
    $dif=$dif-($days*(60*60*24));
    $hours=intval($dif/(60*60));
    $dif=$dif-($hours*(60*60));
    $minutes=intval($dif/(60));
    $seconds=$dif-($minutes*60);
    $s='';
    if ($years<>0) $s.= $years." anos "; 
    if ($months<>0) $s.= $months." meses "; 
    if ($weeks<>0) $s.= $weeks.' semanas ';
    if ($days<>0) $s.= $days.' dias ';
    if ($hours<>0) $s.= $hours.' horas ';
    if ($minutes<>0) $s.= $minutes.' minutos ';
    if ($seconds<>0) $s.= $seconds.' segundos '; 
    return $s;
}



/* Converte uma data humana para o formato TIMESTAMP do Unix, retorna zero se houver erro.
   
   Suporta delimitadores de datas como traï¿œo, ponto, barra e espaï¿œo; nomes de mï¿œs, ano com apenas 2 digitos
   Exemplo de entradas que a funï¿œï¿œo aceita:
   30-12-2003 23:30:59
   30-12-2003
   30 12 2003
   30.12.03
   30/dez/2003
   30 dezembro 03
   30 de dezembro de 03
   30 de dezembro de 2003
   30, dezembro de 2003
 */
function cvdate($s) 
{
    $delimiter='';
    $s = str_replace(' de ','/',strtolower($s));
    if (strpos($s,'-')>0) $delimiter='-';
    elseif (strpos($s,'/')>0) $delimiter='/';
    elseif (strpos($s,' ')>0) $delimiter=' ';
    elseif (strpos($s,'.')>0) $delimiter='.';
    $s = str_replace(', ',$delimiter,$s);
    if (empty($delimiter)) return 0;
    $p1=strpos($s,$delimiter);
    $p2=strpos($s,$delimiter,$p1+1);
    $a=substr($s,$p2+1);
    $m=substr($s,$p1+1,$p2-($p1+1));
    $d=substr($s,0,$p1);
    if (intval($a)<100)
    {
        $a=(intval($a)>69)? strval(1900+intval($a)) : strval(2000+intval($a));
    }
    if (intval($m)==0) // contï¿œm mï¿œs em extenso
    {
        return cvdate_portugues($d,$m,$a);
    }else{
        return cvdate_numerico($d,$m,$a);
    }
}



/* funï¿œï¿œo auxiliar do cvdate */
function cvdate_portugues($d,$m,$y) 
{
    $d2=0; $m2=0; $y2=0;
    $d2=intval($d);
    $m=strtolower($m);
    switch(substr($m,0,3)) {
        case 'jan': $m2=1; break;
        case 'fev': $m2=2; break;
        case 'mar': $m2=3; break;
        case 'abr': $m2=4; break;
        case 'mai': $m2=5; break;
        case 'jun': $m2=6; break;
        case 'jul': $m2=7; break;
        case 'ago': $m2=8; break;
        case 'set': $m2=9; break;
        case 'out': $m2=10; break;
        case 'nov': $m2=11; break;
        case 'dez': $m2=12; break;
    }
    $y2=intval($y);
    if (($d2==0)||($m2==0)||($y2==0)) return 0;
    return mktime(0,0,0,$m2,$d2,$y2);
}


/* funï¿œï¿œo auxiliar do cvdate */
function cvdate_numerico($d,$m,$y) 
{
    $d2=0; $m2=0; $y2=0;
    $d2=intval($d);
    $m2=intval($m);
    $y2=intval($y);
    if (($d2==0)||($m2==0)||($y2==0)) return 0;
    return mktime(0,0,0,$m2,$d2,$y2);
} 


function brtosql($data)
{
	$aux=explode ("/",$data);
	return ("$aux[2]-$aux[1]-$aux[0]");
}

// convert dates with hiphen
function brtosqlh($data)
{
	$aux=explode ("-",$data);
	return ("$aux[0]-$aux[1]-$aux[2]");
}


function sqltobr($data)
{
	$aux=explode ("-",$data);
	return ("$aux[2]-$aux[1]-$aux[0]");
}


function niversql($data)
{
	$aux=explode ("-",$data);
	return ("$aux[2]/$aux[1]");
}



function dateDiffSin($sDataInicial, $sDataFinal)
{
  $sDataI = explode("/", $sDataInicial);
  $sDataF = explode("/", $sDataFinal);

  $nDataInicial = mktime(0, 0, 0, $sDataI[1], $sDataI[0], $sDataI[2]);
  $nDataFinal = mktime(0, 0, 0, $sDataF[1], $sDataF[0], $sDataF[2]);

  return (floor(($nDataFinal - $nDataInicial)/86400));
}



function dateDiff($sDataInicial, $sDataFinal) 
{
	$sDataI = explode("-", $sDataInicial);
	$sDataF = explode("-", $sDataFinal);

	$nDataInicial = mktime(0, 0, 0, $sDataI[1], $sDataI[0], $sDataI[2]);
	$nDataFinal = mktime(0, 0, 0, $sDataF[1], $sDataF[0], $sDataF[2]);

	return ($nDataInicial > $nDataFinal) ?
	floor(($nDataInicial - $nDataFinal)/86400) : floor(($nDataFinal - $nDataInicial)/86400);
}


# Another date_diff function
/*
function date_diff($old_date, $new_date) {
  $offset = strtotime($new_date . " UTC") - strtotime($old_date . " UTC");
  return $offset/60/60/24;
}
*/


function date_time($date_time, $output_string, $utilizar_funcao_date = false) 
{
	// Verifica se a string estï¿œ num formato vï¿œlido de data ("aaaa-mm-dd" ou "aaaa-mm-dd hh:mm:ss")
	if (preg_match("/^(\d{4}(-\d{2}){2})( \d{2}(:\d{2}){2})?$/", $date_time)) 
	{
		$valor['d'] = substr($date_time, 8, 2);
		$valor['m'] = substr($date_time, 5, 2);
		$valor['Y'] = substr($date_time, 0, 4);
		$valor['y'] = substr($date_time, 2, 2);
		$valor['H'] = substr($date_time, 11, 2);
		$valor['i'] = substr($date_time, 14, 2);
		$valor['s'] = substr($date_time, 17, 2);
		// Verifica se a string estï¿œ num formato vï¿œlido de horï¿œrio ("hh:mm:ss")
	} 
	else if (preg_match("/^(\d{2}(:\d{2}){2})?$/", $date_time)) 
	{
		$valor['d'] = NULL;
		$valor['m'] = NULL;
		$valor['Y'] = NULL;
		$valor['y'] = NULL;
		$valor['H'] = substr($date_time, 0, 2);
		$valor['i'] = substr($date_time, 3, 2);
		$valor['s'] = substr($date_time, 6, 2);
	} 
	else 
	{
		return false;
	}
	if ($utilizar_funcao_date) 
	{
		return date($output_string, mktime($valor['H'], $valor['i'], $valor['s'], $valor['m'], $valor['d'], $valor['Y']));
	}
	foreach (array('d', 'm', 'Y', 'y', 'H', 'i', 's') as $caractere) 
	{
		$output_string = ereg_replace("(^|[^\\\\])".$caractere, "\\1".$valor[$caractere], $output_string);
	}
	$output_string = ereg_replace("(^|[^\\\\])\\\\", "\\1", $output_string);
    return $output_string;
}


// função para somar datas
// modo de usar
// echo SomarData("04/04/2007", 1, 2, 1);  NESSE EX. ACRESCENTAMOS 1 DIA 2 MESES E 1 ANO
function SomarData($data, $dias, $meses, $ano)
{
  //passe a data no formato dd/mm/yyyy
   $data = explode(ï¿œ-ï¿œ, $data);
   $newData = date(ï¿œd/m/Yï¿œ, mktime(0, 0, 0, $data[1] + $meses,
  $data[0] + $dias, $data[2] + $ano) );
   return $newData;
}


// Funï¿œï¿œo para subtrair datas
// modo de usar: $backdate = subDayIntoDate($date,5);    // Subtrair 5 dias

function subDayIntoDate($date,$days) 
{
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday - $days, $thisyear );
     return strftime("%Y-%m-%d", $nextdate);
}




/*
 * Devido ï¿œ variaï¿œï¿œo de dias entre os meses (pode ter 28, 29, 30 ou 31), o cï¿œlculo com 
 * diferenï¿œas entre timestamps nunca poderï¿œ ser exato, a nï¿œo ser que o cï¿œlculo comece 
 * pelo nï¿œmero de dias (ou horas, minutos, segundos). Para minimizar ao mï¿œximo essa 
 * diferenï¿œa, eu criei esta constante para utilizar durante o cï¿œlculo:
 *
 */
 
function converte_segundos($total_segundos, $inicio = 'Y') 
{
    define('dias_por_mes', ((((365*3)+366)/4)/12) );

    $comecou = false;

    if ($inicio == 'Y')
    {
        $array['anos'] = floor( $total_segundos / (60*60*24* dias_por_mes *12) );
        $total_segundos = ($total_segundos % (60*60*24* dias_por_mes *12));
        $comecou = true;
    }
    if (($inicio == 'm') || ($comecou == true))
    {
        $array['meses'] = floor( $total_segundos / (60*60*24* dias_por_mes ) );
        $total_segundos = ($total_segundos % (60*60*24* dias_por_mes ));
        $comecou = true;
    }
    if (($inicio == 'd') || ($comecou == true))
    {
        $array['dias'] = floor( $total_segundos / (60*60*24) );
        $total_segundos = ($total_segundos % (60*60*24));
        $comecou = true;
    }
    if (($inicio == 'H') || ($comecou == true))
    {
        $array['horas'] = floor( $total_segundos / (60*60) );
        $total_segundos = ($total_segundos % (60*60));
        $comecou = true;
    }
    if (($inicio == 'i') || ($comecou == true))
    {
        $array['minutos'] = floor($total_segundos / 60);
        $total_segundos = ($total_segundos % 60);
        $comecou = true;
    }
    $array['segundos'] = $total_segundos;

    return $array;
}






/*
 * Mostra todos os sabados entre as datas
 *
 */
 
function getAllSaturdays($from_date, $to_date)
{
    // getting number of days between two date range.
    $number_of_days = count_days(strtotime($from_date),strtotime($to_date));
   
    for($i = 1; $i<=$number_of_days; $i++)
    {
        $day = Date('l',mktime(0,0,0,date('m'),date('d')+$i,date('y')));
        if($day == 'Saturday')
        {
            echo Date('d-m-Y',mktime(0,0,0,date('m'),date('d')+$i,date('y'))),'<br/>';
        }
    }
}


// USADA na funï¿œï¿œo acima :: Retorna o numeros de dias entre duas datas
function count_days( $a, $b )
{
    // First we need to break these dates into their constituent parts:
    $gd_a = getdate( $a );
    $gd_b = getdate( $b );
    // Now recreate these timestamps, based upon noon on each day
    // The specific time doesn't matter but it must be the same each day
    $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
    $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
    // Subtract these two numbers and divide by the number of seconds in a
    // day. Round the result since crossing over a daylight savings time
    // barrier will cause this time to be off by an hour or two.
    return round( abs( $a_new - $b_new ) / 86400 );
}




// Usado em tempo que o usuï¿œrio esta com a sessï¿œo aberta no sistema/browser.
function timesince( $tsmp ) 
{
	$diffu = array(  'seconds'=>2, 'minutos' => 120, 'horas' => 7200, 'dias' => 172800, 'meses' => 5259487,  'anos' =>  63113851 );
	$diff = time() - strtotime($tsmp);
	$dt = '0 seconds ago';
	foreach($diffu as $u => $n){ if($diff>$n) {$dt = floor($diff/(.5*$n)).' '.$u.' atras';} }
	return $dt;
}



// calcula a diferença entre duas datas
function diferenca_dias($inicial, $final)
{
        $inicial	= strtotime($inicial); 	// 07/04/2003 (mm/dd/aaaa) data menor
        $final 		= strtotime($final);    // 07/10/2003 (mm/dd/aaaa) data maior
        return ( $final-$inicial ) / 86400; 	//transformação do timestamp em dias
}

?>
