
$(document).ready(function(){
	//requirements
	var capital=false;
	var number=false;
	var length=false;
	$("#signupSubmit").attr('disabled', true);
	$("#pswd_info").hide();
	$('input[type=password]').keyup(function() {
	    // keyup code here
	    var pswd = $("#pwd").val();
	    if (pswd.length>=8){
		    	$("#length").removeClass("fa-times").addClass("fa-check");
		    	length=true;
		    }else{
		    	$("#length").removeClass("fa-check").addClass("fa-times");
		    	length=false;
		    }

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
		    $('#capital').removeClass("fa-times").addClass("fa-check");
		    capital=true;
		} else {
		    $('#capital').removeClass("fa-check").addClass("fa-times");
		    capital=false;
		}

		//validate number
		if ( pswd.match(/\d/) ) {
		    $('#number').removeClass("fa-times").addClass("fa-check");
		    number=true;
		} else {
		    $('#number').removeClass("fa-check").addClass("fa-times");
		    number=false;
		}

		if (capital&&number&&length){
			$("#signupSubmit").attr('disabled', false);
		}

		}).focus(function() {
		    $('#pswd_info').show();
		    var pswd = $("#pwd").val();
		}).blur(function() {
		    $('#pswd_info').hide();
	});
	
	$("#logmein").click(function(){
    	window.location.href = "./login.php";
    	$("#").removeClass("blue");
    });
});

