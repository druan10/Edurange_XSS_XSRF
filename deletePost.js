$(document).ready(function(){

	console.log("ready");

	// Add id's to each blog post

	$('.deletePost').each(function(index){
		$(this).attr('index', index);
	});

	$(".deletePost").click(function(){
		if(!confirm('are you sure') ){
			return false;
		}else{
		var index = $(this).attr("index");
		$.ajax({
		    type: 'POST',
		    url: './deletePost.php',
		    dataype: 'text',
		    data: { 
		        'index': index
		    },
		    success: function(data){
		        location.reload();
			    }
			});
		}
	});

});