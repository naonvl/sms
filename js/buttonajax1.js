var request1;
var dest1;

function loadHTML(URL1, destination1){
    dest1 = destination1;
	if (window.XMLHttpRequest){
        request1 = new XMLHttpRequest();
        request1.onreadystatechange = processStateChange1;
        request1.open("GET", URL1, true);
        request1.send(null);
    } else if (window.ActiveXObject) {
        request1 = new ActiveXObject("Microsoft.XMLHTTP");
        if (request1) {
            request1.onreadystatechange = processStateChange1;
            request1.open("GET", URL1, true);
            request1.send();
        }
    }
}

function processStateChange1(){
    if (request1.readyState == 4){
        contentDiv = document.getElementById(dest1);
        if (request1.status == 200){
            response = request1.responseText;
            contentDiv.innerHTML = response;
        } else {
            contentDiv.innerHTML = "Error: Status "+request1.status;
        }
    }
}



function loadHTMLPost(URL1, destination1){
    dest1 = destination1;
	if (window.XMLHttpRequest){
        request1 = new XMLHttpRequest();
        request1.onreadystatechange = processStateChange1;
        request1.open("POST", URL1, true);
        request1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
      	request1.setRequestHeader("Content-length", parameters.length);
      	request1.setRequestHeader("Connection", "close");
		request1.send("good");
    } else if (window.ActiveXObject) {
        request1 = new ActiveXObject("Microsoft.XMLHTTP");
        if (request1) {
            request1.onreadystatechange = processStateChange1;
            request1.open("POST", URL1, true);
            request1.send();
        }
    }
}


function loadHTMLPost_button(URL1, destination1, button){
    dest1 = destination1;
	var str = 'button=' + button;

	if (window.XMLHttpRequest){
        request1 = new XMLHttpRequest();
        request1.onreadystatechange = processStateChange1;
        request1.open("POST", URL1, true);
        request1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		request1.send(str);
    } else if (window.ActiveXObject) {
        request1 = new ActiveXObject("Microsoft.XMLHTTP");
        if (request1) {
            request1.onreadystatechange = processStateChange1;
            request1.open("POST", URL1, true);
            request1.send();
        }
    }
}

function loadHTMLPost_button2(URL1, destination1, button, getId){
    dest1 = destination1;
	var str;
	//alert(document.getElementById(getId).value);
	str = getId + '=' + document.getElementById(getId).value;
	str = str + '&button=' + button;

	if (window.XMLHttpRequest){
        request1 = new XMLHttpRequest();
        request1.onreadystatechange = processStateChange1;
        request1.open("POST", URL1, true);
        request1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		request1.send(str);
    } else if (window.ActiveXObject) {
        request1 = new ActiveXObject("Microsoft.XMLHTTP");
        if (request1) {
            request1.onreadystatechange = processStateChange1;
            request1.open("POST", URL1, true);
            request1.send();
        }
    }
}


function loadHTMLPost_idcheck(URL1, destination1, button, getId, getId2){
	dest1 = destination1;	
	str = getId + '=' + document.getElementById(getId).value;
	str2 = getId2 + '=' + document.getElementById(getId2).value;
	
	var str = str + '&button=' + button;
	var str2 = str2 + '&button=' + button;
	var str = str + '&' + str2;
			
	if (window.XMLHttpRequest){
		request1 = new XMLHttpRequest();
		request1.onreadystatechange = processStateChange1;
		request1.open("POST", URL1, true);
		request1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		request1.send(str);		
	} else if (window.ActiveXObject) {
		request1 = new ActiveXObject("Microsoft.XMLHTTP");
		if (request1) {
			request1.onreadystatechange = processStateChange1;
			request1.open("POST", URL1, true);
			request1.send();
		}
	}
}
