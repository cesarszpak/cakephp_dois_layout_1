base_url='<?php echo $this->webroot;?>ajax/estatisticas/add/';
ajaxFunction("<?php echo $hash;?>");
function ajaxFunction(sechash){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				return false;
			}
		}
	}
	
	// Create a function that will receive data sent from the server
	referrer = document.referrer.replace(/http:\/\//g,"");
	referrer = referrer.replace(/\//g,"|[|");
	URL = document.URL.replace(/http:\/\//g,"");
	URL = URL.replace(/\//g,"|[|");
	var url = base_url+sechash+'/'+URL+'/'+referrer;
	ajaxRequest.open("GET", url, true);
	ajaxRequest.send(null); 
}
