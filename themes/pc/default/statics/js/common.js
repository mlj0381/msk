
$(function(){

	/**
     *手机版扫码入口 
     */

    $('.kefu .mobile').hover(function(){
        $('.wxcode').removeClass('hidden');
    },function(){
        $('.wxcode').addClass('hidden');
    })


    /**
     * 全站导航
     */

    $('.site_nav').click(function(){
        $('.website_menu').slideToggle();
    })


    /**
     * 首页搜索
     */

    /*$('.search_label span').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        var index = $('.search_label span').index(this);
        if(index=="0"){
            $('.search_form').attr('action','<{link app=b2c ctl=site_list act=index}>');
        }else{
            $('.search_form').attr('action','');
        }
    })*/
    
    
    


    /**
     * 滑动门tab切换
     * tabmenu  菜单项
     * tabcon   内容项
     * className    选中菜单的class名
     */
    
    function tabslider(tabmenu,tabcon,className){

            $(tabcon).hide();
            $(tabcon).first().show();   //默认第一个内容显示
            $(tabmenu).each(function(index, el) {
                $(this).click(function(){
                    $(this).addClass(className).siblings().removeClass(className);
                    $(tabcon).eq(index).show().siblings().hide();      
                })
            });
    }
     
    tabslider('.fav_nav span a','.gl_item_box','active');   //我的收藏调用
    
})