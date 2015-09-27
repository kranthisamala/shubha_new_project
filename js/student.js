$(document).ready(function(){
	$("#post_button").click(function(){
		$("#pic_post").hide();
		$("#create_global_post").hide();
		$("#create_post").toggle();
	});
	$(".nav").click(function(){
		$(".mid_block").hide();
		var block=$(this).attr("block");
		$("#"+block).show();
	});
	$("#request .request_block").mouseleave(function(){
		$(this).children(".reply").hide();
	});
	$("#request .request_block").mouseenter(function(){
		$(this).children(".reply").show();
	});
	$("#upload_pic").click(function(){
		$("#create_post").hide();
		$("#create_global_post").hide();
		$("#pic_post").toggle();
	});
	$("#global_post_button").click(function(){
		$("#pic_post").hide();
		$("#create_post").hide();
		$("#create_global_post").toggle();
	});
	
});