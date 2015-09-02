$(document).ready(function(){
	$("#post_button").click(function(){
		$("#create_post").toggle();
	});
	$(".nav").click(function(){
		$(".mid_block").hide();
		var block=$(this).attr("block");
		$("#"+block).show();
	});
});