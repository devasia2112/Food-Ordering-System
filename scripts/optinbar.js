var pluginURL = '';
var optinbarHeight = '';
var optinbarWidth = '0'
var optinbarColor = '000000';
var optinbarOpacity = '1';
var optinbarBorderColor = 'ffffff';
var optinbarBorderOpacity = '1';
var optinbarBorderSize = '1px';
var optinbarPosition = 'top';
var optinbarScroll = 'fixed';
var optinbarWidthMode = 'full';
var optinbarAlign = 'center';
var optinbarHideName = '';
var optinbarShowTab = 'y';
var optinbarContent = '';
var optinbarContentWidth = '';
var optinbarExpire = 7;
var optinbarBackgroundPattern = '';
var optinbarDelay = 0;
var optinbarTabContent = '+';
var optinbarDim = 'n';
var optinbarTabXpos = '';
var closeSpeed = 300;
var openSpeed = 900;
var tabSpeed = 500;
var closeAnimation = 'jswing';
var openAnimation = 'easeOutBounce';

function init_optinbar(Height, plugin_url, color, opacity, border_color, border_size, pattern, position, scroll, width_mode, align, hide_name, expire, delay, show_tab, open_animation, close_animation, open_speed, close_speed, dim, tab_content, content)
{
	optinbarHeight = Height;
	pluginURL = plugin_url;
	optinbarColor = color;
	optinbarOpacity = opacity/100;
	optinbarBorderColor = border_color;
	optinbarBorderSize = border_size;
	optinbarBackgroundPattern = pattern;
	optinbarPosition = position;
	optinbarScroll = scroll;
	optinbarWidthMode = width_mode;
	optinbarAlign = align;
	optinbarHideName = hide_name;
	optinbarExpire = parseInt(expire);
	optinbarDelay = delay*1000;
	optinbarShowTab = show_tab;
	optinbarTabContent = tab_content;
	optinbarContent = content;
	optinbarDim = dim;
	openAnimation = open_animation;
	closeAnimation = close_animation;
	openSpeed = parseInt(open_speed);
	closeSpeed = parseInt(close_speed);
}

function display_optinbar()
{
	var optinbar_hide = getCookie("optinbar_hide");
	if (optinbar_hide != null && optinbar_hide != "")
	{
		if(optinbarShowTab != 'n'){
			optinTabShow(openSpeed);
			optinbarDelay = 0;
		}
	} else {
		setTimeout(optinBarShow, optinbarDelay);
	}
}

function validateCredentials()
{
	var textBoxCount = jQuery('.optinbarTextBox').length;
	
	if(textBoxCount == 2){
		var nameValue = jQuery('.optinbarTextBox:first').val();
		var emailValue = jQuery('.optinbarTextBox:last').val();
		
		if(nameValue == ''){
			optinbarNotification('Please enter a valid name');
			jQuery('.optinbarTextBox:first').focus();
			return false;
		} else if(emailValue == '' || !isValidEmail(emailValue)){
			optinbarNotification('Please enter a valid email');
			jQuery('.optinbarTextBox:last').focus();
			return false;
		} else {
			return true;
		}
		
	} else if(textBoxCount == 1){
		var emailValue = jQuery('.optinbarTextBox').val();
		if(emailValue == '' || !isValidEmail(emailValue)){
			optinbarNotification('Please enter a valid email');
			jQuery('.optinbarTextBox:last').focus();
			return false;
		} else {
			return true;
		}
	}
	
}

function optinbarNotification(str){
	jQuery('.optinbarNotification').html(str);
	
	
	if(optinbarWidthMode != 'full'){
		jQuery('.optinbarNotification').css('-webkit-border-bottom-left-radius', '5px');
		jQuery('.optinbarNotification').css('-moz-border-radius-bottomleft', '5px');
		jQuery('.optinbarNotification').css('border-bottom-left-radius', '5px');
	}
	
	jQuery('.optinbarNotification').fadeIn(500, function(){
		jQuery(this).delay(1000).fadeOut(500);
	});
}

function isValidEmail(str) {   				
	return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);			
}

function optinBarShow(speed)
{
	lockScroll();
	if (speed == null){
   		speed = openSpeed;
 	}

	jQuery('body').prepend('<div id="optinbar_dim"></div><div id="optinbar"><p style="padding:0px;"></p><div class="optinbar_close"></div><div class="optinbarNotification"></div></div>');
	jQuery('#optinbar p:first-child').html(optinbarContent);

	optinbarHeight =  jQuery('#optinbar').height();
	optinbarWidth = jQuery('#optinbar').width();
	
	//alert(optinbarHeight);

	setBarStyleAndPosition('#optinbar', optinbarWidth, optinbarHeight, speed);
	if(optinbarDim == 'y'){
		jQuery('#optinbar_dim').fadeIn();
	}
	
	var padding = {};
	padding["padding-"+optinbarPosition] = parseInt(optinbarHeight) + parseInt(optinbarBorderSize.replace("px", ""));
	
	if(optinbarWidthMode == 'full'){
		if(openAnimation == 'fade')
		{
			jQuery("body").css(padding);
		} else {
			jQuery("body").animate(padding, speed, openAnimation);
		}
	}
	
	jQuery('.optinbar_form').bind('submit', function(e){
	
		var textBoxCount = jQuery('.optinbarTextBox').length;
	
		if(textBoxCount == 2){
			var nameValue = jQuery('.optinbarTextBox:first').val();
			var emailValue = jQuery('.optinbarTextBox:last').val();
			
			if(nameValue == ''){
				optinbarNotification('Please enter a valid name');
				jQuery('.optinbarTextBox:first').focus();
				return false;
			} else if(emailValue == '' || !isValidEmail(emailValue)){
				optinbarNotification('Please enter a valid email');
				jQuery('.optinbarTextBox:last').focus();
				return false;
			} else {
				return true;
			}
			
		} else if(textBoxCount == 1){
			var emailValue = jQuery('.optinbarTextBox').val();
			if(emailValue == '' || !isValidEmail(emailValue)){
				optinbarNotification('Please enter a valid email');
				jQuery('.optinbarTextBox:last').focus();
				return false;
			} else {
				return true;
			}
		}
	});
	
	jQuery('.optinbar_close, #optinbar_dim').bind('click', function() {
		setCookie("optinbar_hide",1,optinbarExpire,"/");
		if(optinbarShowTab != 'n'){
			optinTabShow();
		}
		optinBarHide();
	});
	
	if(optinbarPosition == 'top')
		set_adminbar_margin_top('#optinbar');
	
	jQuery('.optinbar_form label').inFieldLabels();
	
	if(optinbarHideName == 'on'){
		jQuery('.optinbar_user_email_icon').next().next().focus();
	} else {
		jQuery('.optinbar_user_icon').next().next().focus();
	}
	unlockScroll();
	optinbarDelay = 0;
}


function optinTabShow(speed)
{
	if (speed == null){
   		speed = openSpeed;
 	}

	jQuery('body').prepend('<div class="optinbar_tab"><h4>' + optinbarTabContent + '</h4></div>');

	tabHeight =  jQuery('.optinbar_tab').height();
	tabWidth = jQuery('.optinbar_tab').width();

	setTabStyleAndPosition('.optinbar_tab', optinbarWidth, optinbarHeight, speed);
		
	jQuery('.optinbar_tab').bind('click', function() {
			
		optinTabHide();
		optinBarShow();
	});
	
	if(optinbarPosition == 'top')
		set_adminbar_margin_top('.optinbar_tab');
	
	
}

function optinBarHide(speed)
{
	if (speed == null){
   		speed = closeSpeed;
 	}
 	
	var position = {};
	position[optinbarPosition] = -optinbarHeight;
	if(optinbarPosition == 'middle'){
		position['top'] = -optinbarHeight;
	}
	
	if(closeAnimation == 'fade'){
		jQuery("#optinbar").fadeOut(function(){
			jQuery('#optinbar').remove();
			if(optinbarDim == 'y'){
				jQuery('#optinbar_dim').fadeOut();
			}
		});
	} else {
		jQuery("#optinbar").animate(position, speed, closeAnimation, function(){
			jQuery('#optinbar').remove();
			if(optinbarDim == 'y'){
				jQuery('#optinbar_dim').fadeOut();
			}
		});
	}
	
	var padding = {};
	padding["padding-"+optinbarPosition] = 0;
	
	if(closeAnimation == 'fade'){
		jQuery("body").css(padding);
	} else {
		jQuery("body").animate(padding, speed, closeAnimation);
	}
	
}

function optinTabHide(speed)
{
	if (speed == null){
   		speed = closeSpeed;
 	}
	
	var position = {};
	position[optinbarPosition] = -jQuery('.optinbar_tab').height();
	if(optinbarPosition == 'middle'){
		position['top'] = -jQuery('.optinbar_tab').height();
	}
	jQuery(".optinbar_tab").animate(position, tabSpeed/2, 'jswing', function(){
		jQuery('.optinbar_tab').remove();
	});
}

function setTabStyleAndPosition(object, width, height, speed)
{
	var style = {};
	
	style[optinbarPosition] = -jQuery('.optinbar_tab').height();
	if(optinbarPosition == 'middle'){
		style['top'] = -jQuery('.optinbar_tab').height();
	}
	style['background-color'] =  '#000000'; //'rgb(' + hex2rgb(optinbarColor) + ')';
	style['background-color'] =  '#000000'; //'rgba(' + hex2rgb(optinbarColor) + ', ' + optinbarOpacity + ')';
	style['border-color'] = 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
	style['border-color'] = 'rgba(' + hex2rgb(optinbarBorderColor) + ', ' + optinbarBorderOpacity + ')';
	style['border-width'] = optinbarBorderSize;
	
	if(optinbarPosition == 'top'){
		style['position'] = optinbarScroll;
	}
	
	if(optinbarTabContent != '+'){
		style['padding'] = '5px 10px';
		jQuery('.optinbar_tab h4').css('font-family', 'Helvetica Neue, Helvetica, Arial, Courier');
		jQuery('.optinbar_tab h4').css('font-weight', '200');
	}
	
	if(optinbarBackgroundPattern != '')
		style['background-image'] = 'url("' + pluginURL + '/optinbar/assets/images/backgrounds/' + optinbarBackgroundPattern + '.png")';
	
	style['border-'+optinbarPosition] = '0px';
	style['-webkit-border-'+optinbarPosition+'-left-radius'] = 0;
	style['-moz-border-radius-'+optinbarPosition+'left'] = 0;
	style['border-'+optinbarPosition+'-left-radius'] = 0;
	style['-webkit-border-'+optinbarPosition+'-right-radius'] = 0;
	style['-moz-border-radius-'+optinbarPosition+'right'] = 0;
	style['border-'+optinbarPosition+'-right-radius'] = 0;
	
	if(optinbarWidthMode == 'auto' && optinbarPosition != 'middle')
	{
		if(optinbarAlign == 'center'){
			style['right'] = window.innerWidth/2;
		} else if(optinbarAlign == 'right'){
			style['right'] = '5px';
		} else if(optinbarAlign == 'left'){
			style['left'] = '10px';
		}
		//alert(optinbarTabXpos);
	} else {
		style['right'] = '5px';
	}
	
	if(optinbarPosition == 'middle'){
		style['border-top'] = '0px';
		style['-webkit-border-top-left-radius'] = 0;
		style['-moz-border-radius-topleft'] = 0;
		style['border-top-left-radius'] = 0;
		style['-webkit-border-top-right-radius'] = 0;
		style['-moz-border-radius-topright'] = 0;
		style['border-top-right-radius'] = 0;
	}
	
	
	jQuery(object).css(style);
						
	var position = {};
	position[optinbarPosition] = 0;
	if(optinbarPosition == 'middle'){
		position['top'] = 0;
	}

	jQuery(object).animate(position, tabSpeed, 'easeOutBounce');	
}

function setBarStyleAndPosition(object, width, height, speed)
{
	
	optinbarContentWidth = jQuery('#optinbar p:first-child').width();

	var style = {};
	style[optinbarPosition] = -height;
	style['background-color'] = '#000000'; //'rgb(' + hex2rgb(optinbarColor) + ')';
	style['background-color'] = 'rgba(' + hex2rgb(optinbarColor) + ', ' + optinbarOpacity + ')'; //'#222';
	style['border-color'] = 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
	style['border-color'] = 'rgba(' + hex2rgb(optinbarBorderColor) + ', ' + optinbarBorderOpacity + ')';
	style['border-width'] = optinbarBorderSize;
	
	if(optinbarPosition == 'top')
		style['position'] = optinbarScroll;
	
	if(optinbarBackgroundPattern != '')
		style['background-image'] = 'url("' + pluginURL + '/optinbar/assets/images/backgrounds/' + optinbarBackgroundPattern + '.png")';
	
	if(optinbarPosition == 'top')
		var posBorder = 'bottom';
	else
		var posBorder = 'top';
	
	style['border-'+posBorder] = optinbarBorderSize + ' solid ' + 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
	
	jQuery('.optinbar_close').css(optinbarPosition, (height-(jQuery('.optinbar_close').height()))-10);
	
	if(optinbarWidthMode == 'auto')
	{
		style['width'] = optinbarContentWidth;
		style['-webkit-border-'+posBorder+'-left-radius'] = 5;
		style['-moz-border-radius-'+posBorder+'left'] = 5;
		style['border-'+posBorder+'-left-radius'] = 5;
		style['-webkit-border-'+posBorder+'-right-radius'] = 5;
		style['-moz-border-radius-'+posBorder+'right'] = 5;
		style['border-'+posBorder+'-right-radius'] = 5;
		
		style['border-left'] = optinbarBorderSize + ' solid ' + 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
		style['border-right'] = optinbarBorderSize + ' solid ' + 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
		
		
		if(optinbarAlign == 'center'){
			style['left'] = window.innerWidth/2 - (jQuery('#optinbar p:first-child').width()+40)/2;
			jQuery('.optinbar_close').css('right', '-10px');
		} else if(optinbarAlign == 'right'){
			style['right'] = '20px';
			jQuery('.optinbar_close').css('right', '-10px');
		} else if(optinbarAlign == 'left'){
			style['left'] = '20px';
			jQuery('.optinbar_close').css('left', '-10px');
		}
		
		jQuery('.optinbar_close').css(optinbarPosition, (height-(jQuery('.optinbar_close').height()/2)-5));
		//optinbarTabXpos = (window.innerWidth/2 - (jQuery('#optinbar p:first-child').width()+40))*-1;
	} else {
	
		jQuery('.optinbar_close').css('background-image', 'url('+pluginURL+'/Delivery/images/icons/close4.png)');
		style['left'] = '0px';
	
	}
	
	if(optinbarPosition == 'middle'){
		style['-webkit-border-radius'] = 0;
		style['-moz-border-radius'] = 0;
		style['border-radius'] = 0;
		style['border-top'] = optinbarBorderSize + ' solid ' + 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
		style['border-bottom'] = optinbarBorderSize + ' solid ' + 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
		jQuery('.optinbar_close').css('top', '10px');
		if(optinbarWidthMode == 'auto'){
			style['border'] = optinbarBorderSize + ' solid ' + 'rgb(' + hex2rgb(optinbarBorderColor) + ')';
			style['-webkit-border-radius'] = 5;
			style['-moz-border-radius'] = 5;
			style['border-radius'] = 5;
			jQuery('.optinbar_close').css('top', '-15px');
			if(optinbarAlign == 'left'){
				jQuery('.optinbar_close').css('left', '-15px');
			} else{
				jQuery('.optinbar_close').css('right', '-15px');
			}
		}
	}
	
	if(openAnimation == 'fade' && optinbarPosition != 'middle'){
		style[optinbarPosition] = 0;
		style['display'] = 'none';
	}
	
	if(optinbarPosition == 'middle' && openAnimation == 'fade'){
		style['top'] = window.innerHeight/2 - jQuery('#optinbar').height()/2;
		style['display'] = 'none';
	}
	
	jQuery(object).css(style);
	
					
	var position = {};
	position[optinbarPosition] = 0;
	
	if(optinbarPosition == 'middle'){
		position['top'] = window.innerHeight/2 - jQuery('#optinbar').height()/2;
	}
	
	if(openAnimation == 'fade'){
		jQuery(object).fadeIn();
	} else {
		jQuery(object).animate(position, speed, openAnimation);
	}
	
	
	
	
}

jQuery(window).resize(function(){
	//jQuery('#optinbar p:first-child').css('width', (window.innerWidth-75)+'px');
});

function hex2rgb(hex) {
	hex = (hex.substr(0,1)=="#") ? hex.substr(1) : hex;
	return [parseInt(hex.substr(0,2), 16), parseInt(hex.substr(2,2), 16), parseInt(hex.substr(4,2), 16)];
}

function set_adminbar_margin_top(object)
{
	if(jQuery('#wpadminbar').css('display') == 'block'){
		jQuery(object).css('margin-top', '28px');
	}
}

jQuery(window).resize(function(){
	
	if(optinbarAlign == 'center'){
		//alert('yup');
		jQuery('#optinbar').css('left', window.innerWidth/2 - jQuery('#optinbar').width()/2);
	}
	if(optinbarWidthMode == 'full')
	{
		jQuery('#optinbar').css('left', 0);
	}
});

function lockScroll()
{
	
	// lock scroll position, but retain settings for later
	 var scrollPosition = [
	   self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
	   self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
	 ];
	 var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
	 html.data('scroll-position', scrollPosition);
	 html.data('previous-overflow', html.css('overflow'));
	 html.css('overflow', 'hidden');
	 window.scrollTo(scrollPosition[0], scrollPosition[1]);
	
}

function unlockScroll()
{
	
	// un-lock scroll position
	var html = jQuery('html');
	var scrollPosition = html.data('scroll-position');
	html.css('overflow', html.data('previous-overflow'));
	window.scrollTo(scrollPosition[0], scrollPosition[1]);
	
}

function getCookie( name ) {	

	var start = document.cookie.indexOf( name + "=" );

	var len = start + name.length + 1;

	if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {

		return null;

	}

	if ( start == -1 ) return null;

	var end = document.cookie.indexOf( ';', len );

	if ( end == -1 ) end = document.cookie.length;

	return unescape( document.cookie.substring( len, end ) );

}



function setCookie( name, value, expires, path, domain, secure ) {

	var today = new Date();

	today.setTime( today.getTime() );

	if ( expires ) {

		expires = expires * 1000 * 60 * 60 * 24;

	}

	var expires_date = new Date( today.getTime() + (expires) );

	document.cookie = name+'='+escape( value ) +

		( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()

		( ( path ) ? ';path=' + path : '' ) + 

		( ( domain ) ? ';domain=' + domain : '' ) +

		( ( secure ) ? ';secure' : '' );

}



function deleteCookie( name, path, domain ) {

	if ( getCookie( name ) ) document.cookie = name + '=' +

			( ( path ) ? ';path=' + path : '') +

			( ( domain ) ? ';domain=' + domain : '' ) +

			';expires=Thu, 01-Jan-1970 00:00:01 GMT';

}
