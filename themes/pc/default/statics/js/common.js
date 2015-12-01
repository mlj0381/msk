
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

    tabslider('.like_menu span a','.like_con > ul','active');   //购物车浏览记录
    
})



/**
 *首页楼层滚动效果
 */
$(function(){
    $(window).scroll(function(){
        var scrollTop=$(this).scrollTop();        //获取滚动条滚动的距离
        $('.floor').each(function(){
            var offsetTop=$(this).offset().top;    //获取每个区块距离页面顶部的距离
            var index=$('.floor').index(this);
            
            if(offsetTop-scrollTop<=$(this).innerHeight()/2){
                $('.fixed_floorNav li:eq('+index+')').addClass('active').siblings().removeClass('active');
            }else{
                return false;
            }
        })
    })

    $('.fixed_floorNav li').click(function(){
        var index=$('.fixed_floorNav li').index(this);
        var val=$('.floor').eq(index).offset().top
        $("html,body").stop().animate({scrollTop:val},1000);

    })  

})


/*
 *首页返回顶部
 */
$(function(){
    $('.gotoTop').click(function(){
        $("html,body").stop().animate({scrollTop:0},1000);
    })
})