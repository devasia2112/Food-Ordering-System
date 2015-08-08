// JavaScript Document
var req; 

function loadXMLDoc(url,valor,cid) 
{ 
    req = null; 
    // Procura por um objeto nativo (Mozilla/Safari) 
    if (window.XMLHttpRequest) { 
        req = new XMLHttpRequest(); 
        req.onreadystatechange = processReqChange; 
        req.open("GET", url+'?uf='+valor+'&cid='+cid, true); 
        req.send(null); 
    // Procura por uma versao ActiveX (IE) 
    } else if (window.ActiveXObject) { 
        req = new ActiveXObject("Microsoft.XMLHTTP"); 
        if (req) { 
			req.onreadystatechange = processReqChange; 
            req.open("GET", url+'?uf='+valor+'&cid='+cid, true); 
            req.send(); 
        } 
    } 
} 

function processReqChange() 
{ 
    // apenas quando o estado for "completado" 
    if (req.readyState == 4) { 
        // apenas se o servidor retornar "OK" 
        if (req.status == 200) { 
            // procura pela div id="atualiza" e insere o conteudo 
            // retornado nela, como texto HTML 
            document.getElementById('atualiza').innerHTML = req.responseText;			
        } else { 
            alert("Houve um problema ao obter os dados:\n" + req.statusText); 
        } 
    } 
} 

function Atualiza(valor,cid) 
{ 
    loadXMLDoc("combo_cidade.php",valor,cid); 
}
