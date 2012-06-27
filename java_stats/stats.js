function get_member_details(str) {
    var xmlhttp;
    
    if (document.getElementById(str).innerHTML== '') {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById(str).innerHTML=xmlhttp.responseText;
            }
        }
        
        xmlhttp.open("GET","ajaxMemberDetails.php?q="+str,true);
        xmlhttp.send();
    }
	else {
		document.getElementById(str).innerHTML='';
	}
}