
$(function(){


    /**
     * 全站导航
     */

    $('.site_nav').click(function(){
        $('.website_menu').slideToggle();
    })

    
    /**
     * 城市选择
     */
     $('.location ul li').click(function(){

        $(this).addClass('active').siblings().removeClass('active');
        var provName=$(this).children('a').text();
        $('#cityPlan small').text(provName);
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

        if(scrollTop>340&&scrollTop<3460){
            $('.fixed_floorNav').removeClass('hidden');
        }else{
            $('.fixed_floorNav').addClass('hidden');
        }
        //console.log(scrollTop)

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




/**
 * 单个图片上传功能
 */
$(function(){
    $('.filebox input[type="file"]').fileupload({

      add: function(e, data) {
          if (!data.files[0]['type'].match(/^image/)) {
              alert('非法上传，不是图片类型');
              //e.stopPropagation();
              return false;
          }
          data.submit();
      },
      progress:function(e){
          var inputfile = e.target || e.srcElement;
          $(inputfile).siblings('.showImg').find('.loading').removeClass('hidden');
          $(inputfile).siblings('.showImg').find('img').addClass('hidden');
      },
      done: function(e, data) {
          var inputfile = e.target || e.srcElement;
          function loadinghide(){
              $(inputfile).siblings('.showImg').find('.loading').addClass('hidden');
              $(inputfile).siblings('.showImg').find('img').removeClass('hidden');
          }
          setTimeout(loadinghide,100);
          var re = $.parseJSON(data.result);
          var input = e.target || e.srcElement;
          
          $(input).prev('input[type="hidden"]').attr('value', re.image_id);
          $(input).next('.showImg').find('img').attr('src',re.url);
      }
    });

    function loading(){
      $('.filebox .showImg').append('<span class="loading hidden icon-spinner icon-spin"></span>');
    }
    loading();
    
});