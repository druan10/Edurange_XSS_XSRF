
$(document).ready(function(){
	//requirements
	var capital=false;
	var number=false;
	var length=false;
	var usernameFormat=false;
	var passwordsMatch=false;
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
		
		var password = $("#pwd").val();
    	var confirmPassword = $("#pwd2").val();

	    if (password == confirmPassword){
	    	passwordsMatch=true;
	    }else{
			passwordsMatch=false;
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

	$('#username').keyup(function() {
	    // keyup code here
	    var username = $("#username").val();
	    if (username.match(/^[a-zA-Z0-9\_]{4,10}$/)){
	    		usernameFormat=true;
	    		$('#usernameReq').removeClass("fa-times").addClass("fa-check");
	    	}else{
    			usernameFormat=false
	    		$('#usernameReq').removeClass("fa-check").addClass("fa-times");
	    	}
	    });
	    

	$('input').keyup(function() {
		if (capital&&number&&length&&usernameFormat&&passwordsMatch){
			$("#signupSubmit").attr('disabled', false);
		}else{
			$("#signupSubmit").attr('disabled', true);
		}
	});

});



