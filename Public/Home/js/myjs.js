$(function(){
     
  $('.div7_nr').hide();
    $('.div7 .div7_t h2').click(function(){
        $(this).addClass('cli');
        $(this).parents('.div7').siblings('.div7').find('.div7_t h2').removeClass('cli');
        $(this).siblings('a').addClass('xz');
        $(this).parents('.div7').siblings('.div7').find('.div7_t a').removeClass('xz');
        $(this).find('.img3').hide();
        $(this).find('.img4').show();
        $(this).parents('.div7').siblings('.div7').find('.img3').show();
        $(this).parents('.div7').siblings('.div7').find('.img4').hide();
        $(this).parent('.div7_t').siblings('.div7_nr').show().parents('.div7').siblings('.div7').find('.div7_nr').hide();

       

    });

   
})
