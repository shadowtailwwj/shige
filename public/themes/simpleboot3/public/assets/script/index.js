$(document).ready(function () {
	window.setTimeout(function () {
		$(".loading").fadeOut(500)
	}, 400);
	$(".banner").huxiFn({})
	$(".aubtnl a").click(function () {
		var x = $(this).index();
		$(this).parents(".aubtnl").siblings(".liqibx").find(".qiehuan").eq(x).show().siblings(".qiehuan").hide();
	});
  $(".lvbtns a").click(function(){
    $(this).addClass("cur").siblings().removeClass("cur");
    var x = $(this).index();
    $(".ndwixq").eq(x).show().siblings(".ndwixq").hide();
  });
  $(".geqie a").click(function(){
    $(this).addClass("cur").siblings().removeClass("cur");
    var x = $(this).index();
    /* $(".ndwixq").eq(x).show().siblings(".ndwixq").hide(); */
  });
  $(".msba a,.gequqie a").click(function(){
    $(this).addClass("cur").siblings('a').removeClass("cur");
    var x = $(this).index();
    /* $(".ndwixq").eq(x).show().siblings(".ndwixq").hide(); */
  });
  
})
