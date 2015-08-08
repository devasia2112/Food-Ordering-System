<?php
/*
require_once 'Services/GeoNames.php';
$geo = new Services_GeoNames();
// http://api.geonames.org/postalCodeLookupJSON?postalcode=18460-000&country=BR&username=demo
*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script type="text/javascript" src="http://api.geonames.org/export/geonamesData.js?username=demo"></script>
<script type="text/javascript" src="scripts/jsr_class.js"></script>
<style>
  #suggestDiv {border: 1px solid #8FABFF; visibility:hidden; text-align: left;  white-space: nowrap; background-color: #eeeeee;}
  .suggestions { font-size: 14;background-color: #eeeeee;  }
  .suggestionMouseOver { font-size: 14;background: #3333ff; color: white;  }
</style>
<script>
// postalcodes is filled by the JSON callback and used by the mouse event handlers of the suggest box
var postalcodes;

// this function will be called by our JSON callback
// the parameter jData will contain an array with postalcode objects
function getLocation(jData) 
{
  if (jData == null) 
  {
    // There was a problem parsing search results
    return;
  }

  // save place array in 'postalcodes' to make it accessible from mouse event handlers
  postalcodes = jData.postalcodes;
    	
  if (postalcodes.length > 1) 
  {
    // we got several places for the postalcode
    // make suggest box visible
    document.getElementById('suggestBoxElement').style.visibility = 'visible';
    var suggestBoxHTML  = '';
    // iterate over places and build suggest box content
    for (i=0;i< jData.postalcodes.length;i++) {
      // for every postalcode record we create a html div 
      // each div gets an id using the array index for later retrieval 
      // define mouse event handlers to highlight places on mouseover
      // and to select a place on click
      // all events receive the postalcode array index as input parameter
      suggestBoxHTML += "<div class='suggestions' id=pcId" + i + " onmousedown='suggestBoxMouseDown(" + i +")' onmouseover='suggestBoxMouseOver(" +  i +")' onmouseout='suggestBoxMouseOut(" + i +")'> " + postalcodes[i].countryCode + ' ' + postalcodes[i].postalcode + ' &nbsp;&nbsp; ' + postalcodes[i].placeName  + ' &nbsp;&nbsp; ' + postalcodes[i].adminName1 +'</div>';
    }
    // display suggest box
    document.getElementById('suggestBoxElement').innerHTML = suggestBoxHTML;
  } 
  else 
  {
    if (postalcodes.length == 1) 
    {
      // exactly one place for postalcode
      // directly fill the form, no suggest box required 
      var placeInput = document.getElementById("placeInput");
      placeInput.value = postalcodes[0].placeName;

      var ufPlaceInput = document.getElementById("ufPlaceInput");
      ufPlaceInput.value = postalcodes[0].adminName1;
    }
    closeSuggestBox();
  }
}

function closeSuggestBox() 
{
  document.getElementById('suggestBoxElement').innerHTML = '';
  document.getElementById('suggestBoxElement').style.visibility = 'hidden';
}

// remove highlight on mouse out event
function suggestBoxMouseOut(obj) 
{
  document.getElementById('pcId'+ obj).className = 'suggestions';
}

// the user has selected a place name from the suggest box
function suggestBoxMouseDown(obj) 
{
  closeSuggestBox();
  var placeInput = document.getElementById("placeInput");
  placeInput.value = postalcodes[obj].placeName;
}

// function to highlight places on mouse over event
function suggestBoxMouseOver(obj) 
{
  document.getElementById('pcId'+ obj).className = 'suggestionMouseOver';
}

// this function is called when the user leaves the postal code input field
// it call the geonames.org JSON webservice to fetch an array of places 
// for the given postal code 
function postalCodeLookup() 
{
  // display loading in suggest box
  document.getElementById('suggestBoxElement').style.visibility = 'visible';
  document.getElementById('suggestBoxElement').innerHTML = '<small><i>carregando ..</i></small>';
  var postalcode = document.getElementById("postalcodeInput").value;
  request = 'http://api.geonames.org/postalCodeLookupJSON?postalcode=' + postalcode  + '&country=BR&username=demo&callback=getLocation';

  // Create a new script object
  aObj = new JSONscriptRequest(request);

  // Build the script tag
  aObj.buildScriptTag();

  // Execute (add) the script tag
  aObj.addScriptTag();
}

// set the country of the user's ip (included in geonamesData.js) as selected country 
// in the country select box of the address form
function setDefaultCountry() 
{
  var countrySelect = document.getElementById("countrySelect");
  for (i=0;i< countrySelect.length;i++) 
  {
    // the javascript geonamesData.js contains the countrycode
    // of the userIp in the variable 'geonamesUserIpCountryCode'
    if (countrySelect[i].value == geonamesUserIpCountryCode) 
    {
      // set the country selectionfield
      countrySelect.selectedIndex = i;
    }
  }
}
</script>
</head>

<body onload="setDefaultCountry();">

<form name="myform">
<div id="seus_dados" class="box">
    <div class="form_dados">
        <fieldset><legend>Seus Dados</legend>
            <dl>
                <dt><label>Nome</label></dt>
                <dd>
                    <input type="text" value="" size="40" name="consumer-name">
                </dd>

                <dt><label>E-mail</label></dt>
                <dd>
                    <input type="text" value="" size="22" name="consumer-email">
                    <input type="text" value="" size="22" name="email-confirmation">
                </dd>

                <dt><label>CEP</label></dt>
                <dd>
                    <input id="postalcodeInput" name="postalcode" onblur="postalCodeLookup();" size="10" type="text">
                    <img style="display: none;" id="address_waiting" alt="Aguarde" src="imgs/spinner_grey.gif">
                </dd>

                <dt style="" id="line7"><label>Cidade</label></dt>
                <dd style="" id="line8">
                    <input id="placeInput" name="place" size="30" onblur="closeSuggestBox();" type="text" readonly /><br>
                    <div style="visibility: hidden;" id="suggestBoxElement"></div>
                </dd>

                <dt style="" id="line9"><label>Estado</label></dt>
                <dd style="" id="line10">
                    <input id="ufPlaceInput" name="uf" size="30" onblur="closeSuggestBox();" type="text" readonly />
                </dd>



                <dt style="color: red; float: left; display: none;" id="address_error_message1"><br style="display: none;" id="address_error_message2"> </dt>
                <dd style="color: red; float: left; display: none;" id="address_error_message3">CEP não encontrado. Insira os dados manualmente.</dd>

                <dt style="" id="line1"><label>Logradouro</label></dt>
                <dd style="" id="line2">
                    <input type="text" onblur="javascript:preencheu(this);" value="" size="25" name="address.street"><label>Numero</label>
                    <input type="text" onblur="javascript:preencheu(this);" value="" size="5" name="address_streetNumber">
                </dd>

                <dt style="" id="line3">Complemento</dt>
                <dd style="" id="line4">
                    <input type="text" onblur="javascript:preencheu(this);" value="" size="25" name="address.complement">(ex: ap 23 - opcional)
                </dd>

                <dt style="" id="line5"><label>Bairro</label></dt>
                <dd style="" id="line6">
                    <input type="text" onblur="javascript:preencheu(this);" value="" size="25" name="address.neighbourhood">
                </dd>

                <dt id="line11"><label>Telefone fixo</label></dt>
                <dd id="line12">
                    <input type="text" value="" size="15" name="telephone">(##-####-####)
                </dd>
            </dl>
        </fieldset>
    </div>

    <small id="alert_nome" style="display: none;" class="nome_alert">Seu nome e sobrenomes devem ser preenchidos da mesma forma em que aparecem em seu CPF.</small>
    <small id="alert_email" style="display: none;" class="email_alert">Endereço no qual você irá receber os comprovantes da transação. Caso seu provedor possua sistema anti-spam e você não receba e-mails do MoIP, autorize os recebimentos de moip@moip.com.br</small>
    <small id="alert_cep" style="display: none;" class="cep_alert">Atenção ao preenchimento do endereço. Você deve preenchê-lo corretamente para que seja possível realizar a verificação dos dados.</small>
    <small id="alert_telefone" style="display: none;" class="telefone_alert">Importante! O telefone fixo deve estar instalado no endereço informado acima.</small>
    <div style="clear:both"></div>
</div>
</form>

</body>
</html>
