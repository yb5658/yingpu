// JavaScript Document
$(function(){
	$(".gb").click(function(){
		$(this).parent("div").stop(true,false).slideUp(1500);
	});
	/*搜索展开更多*/
	$(".z_g").click(function(){
		var k = $(this).attr("data-sz");
		if(k == 0){
			$(this).text("收起").addClass("z_g_h").attr("data-sz",1);
			$(this).parent("td").prev("td").find(".sp_4").css("display","inline");	
		};
		if(k == 1){
			$(this).text("展开").removeClass("z_g_h").attr("data-sz",0);
			$(this).parent("td").prev("td").find(".sp_4").css("display","none");	
		}
	});
	/*点击选中效果*/
	$(".yj").click(function(){
		$(this).addClass("em_h");
		$(this).parents("td").find("em").not($(this)).removeClass("em_h");	
	});
	//二级弹出
	$("#meau em").click(function(){
		var IDk = $(this).attr("data-id");
		$(".div_10").addClass("hid");
		//$(".div_10 em").removeClass("erji_h");
		$("#erji_"+IDk).removeClass("hid");	
	});
	/*二级点击选中效果*/
	$(".div_10 em").click(function(){
		$(".div_10 em").removeClass("erji_h");
		$(this).addClass("erji_h");
			
	});
	//判断选中的是哪一个
	$(".div_9 em").click(function(){
		var c = $(this).attr("id");
		$(this).parents(".div_9").find("input").val(c);
	});
	
	
	//列表页经过效果
	$(".div_11").mouseenter(function(){
		$(this).find(".div_12").css("background","#BEEFFD");
		$(this).find(".div_12 h2").stop(true,false).animate({"height":"61px"},500);
		$(this).find(".div_12 a").css("color","#3ea4c2");
	}).mouseleave(function(){
		$(this).find(".div_12").css("background","#fff");
		$(this).find(".div_12 h2").stop(true,false).animate({"height":"31px"},500);
		$(this).find(".div_12 a").css("color","#3b3b3b");
	});
	
	$(".div_13:odd").css("float","right");
	$(".div_13:even").css("float","left");
	
	$(".nav_5 li:odd").css("float","right");
	$(".nav_5 li:even").css("float","left");
	
	//$(".tr_3:odd").css("background","#F9F9F9");
	$(".tr_3:last td").css("border","none");
	$(".tr_4:last td").css("border","none");
	$(".tr_5:last td").css("border","none");
	$(".tr_9:last td").css("border","none");
	//仿单选
	$(".sp_radio").click(function(){
		var txt = $(this).find("b").text();
			$(this).parent(".radio").find("em").removeClass("em_3");
			$(this).find("em").addClass("em_3");
			$(this).parent(".radio").find("input").val(txt);
	});
	//仿多选
	$(".sp_checkbox").click(function(){
		var obj = $(this).parent(".div_25");
		obj.find(".sp_qx em").removeClass("em_3");
		obj.find(".sp_qx input").prop({"checked":false});
		var sz = $(this).attr("data-sz");
		if(sz == 0){
			$(this).find("em").addClass("em_3");
			$(this).attr("data-sz",1);
			$(this).find("input").prop({"checked":true});
		};
		if(sz == 1){
			$(this).find("em").removeClass("em_3");
			$(this).attr("data-sz",0);
			$(this).find("input").prop({"checked":false});
		};
	});
	//全选
	$(".sp_qx").click(function(){
		var sz = $(this).attr("data-sz");
		var obj = $(this).parent(".div_25");
		if(sz == 0){
			obj.find("em").addClass("em_3");
			obj.find("span").attr("data-sz",1);
			obj.find("input").prop({"checked":true});
		};
		if(sz == 1){
			obj.find("em").removeClass("em_3");
			obj.find("span").attr("data-sz",0);
			obj.find("input").prop({"checked":false});
		};	
	})
	//多选展开二级
	$(".yej span").click(function(){
		var sz = $(this).attr("data-sz");
		if(sz == 0){
			$(this).parent(".yej").next().show();
			$(this).find("em").addClass("em_3");
			$(this).attr("data-sz",1);
			$(this).find("input").prop({"checked":true});
		};
		if(sz == 1){
			$(this).parent(".yej").next().hide();
			$(this).find("em").removeClass("em_3");
			$(this).attr("data-sz",0);
			
			$(this).parent(".yej").next().find("em").removeClass("em_3");
			$(this).parent(".yej").next().find("input").prop({"checked":false});
		};	
	});



// 单选按钮记住密码
    $('.g_jizhu .mmmg1 img.mmg1').click(function(){
        $(this).parents('.mmmg1').siblings('.r_01').attr("checked", true);
        $(this).siblings().show();
        // $(this).hide();
    })
    $('.g_jizhu .mmmg1 img.mmg2').click(function(){
        $(this).parents('.mmmg1').siblings('.r_01').attr("checked", false);
        $(this).siblings().show();
        $(this).hide();
    })


//表单显示
	   $(window).scroll(function(){
			 var ytu1Top = $('.g_huiyuan').offset().top+10;
			 if($(window).scrollTop()>=ytu1Top){
			  $('.g_huiyuan').animate({'margin-top':0},1000);
			 }
			 
	  })



new WOW().init();
})
//banner
/*z=1;
$(function(){
	function fzz(){
		var obj=$(".nav_2 li:eq("+z+")");
		var sp=$(".h_1 span").eq(z);
		$(".sp_3 em").removeClass("em_1");
		$(".sp_3 em:eq("+z+")").addClass("em_1");
		$(".nav_2 li").not(obj).stop(true,false).fadeOut();
		obj.stop(true,false).fadeIn();
		
		$(".h_1 span").not(sp).stop(true,false).fadeOut();
		sp.stop(true,false).fadeIn();
		
		z++;
		if(z>$(".nav_2 li").length-1){z=0}
	}
	var tzz=setInterval(fzz,3000)
	$(".sp_3 em").mouseover(function(){
		clearInterval(tzz)
	}).click(function(){
		if(!$(".nav_2 li").is(":animated")){
			z=$(".sp_3 em").index(this)
			fzz();
		}	
	}).mouseout(function(){
		tzz=setInterval(fzz,3000)
	})
})*/