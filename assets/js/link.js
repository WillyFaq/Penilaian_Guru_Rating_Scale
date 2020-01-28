$(document).ready(function(){
	var url = document.URL;
	//console.log(url);
	var segments = url.split('/');
	var post = segments[4].split('=');
	//console.log(segments[4]);
	console.log(post[1]);
	if(post[1]==undefined){
	    $("#home").addClass('active');
		return;
	}
	var pram = post[1].split('&'); 
	if(pram[1]==undefined){
		$("#"+post[1]).addClass('active');
	}else{
		$("#"+pram[0]).addClass('active');
	}
	
});