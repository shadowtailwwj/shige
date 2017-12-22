$(document).ready(function(){
	window.setTimeout(function(){
		$(".loading").fadeOut(500)
	},400)
	
	$(".xluns").lunboFn({stopTime: 4515});
	
	
	
	$(".snntls a").click(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		var x = $(this).index();
		$(this).parents(".snntls").siblings(".dianjwz").eq(x).show().siblings(".dianjwz").hide();
	})
	$(".lvbtns a").click(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		var x = $(this).index();
		$(".wenbenqih").eq(x).show().siblings(".wenbenqih").hide();
	})
	
})