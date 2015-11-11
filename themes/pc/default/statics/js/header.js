
$(function(){
	/*手机版扫码入口*/

    $('.kefu .mobile').hover(function(){
        $('.wxcode').removeClass('hidden');
    },function(){
        $('.wxcode').addClass('hidden');
    })


    /*全站导航*/
    $('.site_nav').bind('click',function(){
    	$('.website_menu').slideToggle();
    })
})