$(function() {

    /**
     * 全站导航
     */
    var siteNav = $('.site_nav')[0];
    var webMenu = $('.website_menu')[0];
    var timer = null;
    webMenu.onmouseover = siteNav.onmouseover = function() {
        clearInterval(timer);
        webMenu.style.display = "block";
        $('.site_nav a i').attr('class', 'icon-angle-up');
    }
    webMenu.onmouseout = siteNav.onmouseout = function() {
        timer = setTimeout(hide, 100);

        function hide() {
            webMenu.style.display = "none";
        }
        $('.site_nav a i').attr('class', 'icon-angle-down');
    }


    /**
     * 城市选择
     */
    $('.location').hover(
        function() {
            $(this).find('i').attr('class', 'icon-angle-up');
        },
        function() {
            $(this).find('i').attr('class', 'icon-angle-down')
        }
    )
    $('.location ul li').click(function() {

        $(this).addClass('active').siblings().removeClass('active');
        var provName = $(this).children('a').text();
        $('#cityPlan small').text(provName);
    })

    /**
     * tab选项卡切换
     * tabmenu  菜单项
     * tabcon   内容项
     * activeClass    选中菜单的class名
     */

    function tabslider(tabmenu, tabcon, activeClass) {

        $(tabcon).hide();
        $(tabcon).first().show(); //默认第一个内容显示
        $(tabmenu).each(function(index, el) {
            $(this).click(function() {
                $(this).addClass(activeClass).siblings().removeClass(activeClass);
                $(tabcon).eq(index).show().siblings().hide();
            })
        });
    }

    tabslider('.fav_nav span a', '.fav_con > div', 'active'); //我的收藏调用

    tabslider('.fav_goods .fav_g_nav ul li', '.fav_g_con > div', 'active'); //我的收藏-商品收藏调用

    tabslider('.fav_shop .fav_s_nav ul li', '.fav_s_con > div', 'active'); //我的收藏-店铺收藏调用

    tabslider('.like_menu span a', '.like_con > ul', 'active'); //购物车浏览记录

    tabslider('.clearing_tab .clearing_menu li', '.clearing_con > table', 'active'); //卖家中心结算管理

    tabslider('.buyStore_tab .tabMenu li', '.tabCon > div', 'active'); //购买过的店铺

    tabslider('.goods-listbox .tab_toggle span', '.list_maincon > div', 'btn-danger'); //购买过的店铺

    tabslider('.appra_box .appra_nav li', '.appra_itemcon > div.appra_items', 'active'); //我的评价



    /**
     *首页楼层滚动效果
     */

    $(window).scroll(function() {

        var scrollTop = $(this).scrollTop(); //获取滚动条滚动的距离

        if (scrollTop > 340 && scrollTop < 3460) {
            $('.fixed_floorNav').removeClass('hidden');
        } else {
            $('.fixed_floorNav').addClass('hidden');
        }
        //console.log(scrollTop)

        $('.floor').each(function() {
            var offsetTop = $(this).offset().top; //获取每个区块距离页面顶部的距离
            var index = $('.floor').index(this);

            if (offsetTop - scrollTop <= $(this).innerHeight() / 2) {
                $('.fixed_floorNav li:eq(' + index + ')').addClass('active').siblings().removeClass('active');
            } else {
                return false;
            }
        })
    })

    $('.fixed_floorNav li').click(function() {
        var index = $('.fixed_floorNav li').index(this);
        var val = $('.floor').eq(index).offset().top
        $("html,body").stop().animate({
            scrollTop: val
        }, 1000);

    })





    /*
     *首页返回顶部
     */
    $(function() {
        $('.gotoTop').click(function() {
            $("html,body").stop().animate({
                scrollTop: 0
            }, 1000);
        })
    })



    /**
     * 去除a,button点击后的虚线框
     */

    $("a,button").bind("focus", function() {
        if (this.blur) {
            this.blur();
        }
    });



    /**
     * 单个图片上传功能
     */

    $('.filebox input[type="file"]').fileupload({

        add: function(e, data) {

            if (!data.files[0]['type'].match(/^image/)) {
                alert('非法上传，不是图片类型');
                return false;
            }
            data.submit();
        },
        progress: function(e) {
            var inputfile = e.target || e.srcElement;
            $(inputfile).siblings('.showImg').find('.loading').removeClass('hidden');
            $(inputfile).siblings('.showImg').find('img').addClass('hidden');
        },
        done: function(e, data) {

            var inputfile = e.target || e.srcElement;

            function loadinghide() {
                $(inputfile).siblings('.showImg').find('.loading').addClass('hidden');
                $(inputfile).siblings('.showImg').find('img').removeClass('hidden');
            }
            setTimeout(loadinghide, 100);
            var re = $.parseJSON(data.result);
            var input = e.target || e.srcElement;
            $(input).prev('input[type="hidden"]').attr('value', re.image_id);
            $(input).next('.showImg').find('img').attr('src', re.url);
        }
    });

    loading();

    function loading() {
        $('.filebox .showImg').append('<span class="loading hidden icon-spinner icon-spin"></span>');
    }




   


})



/**
 * 星星等级评分
 */
;(function($){
    $.fn.starRating = function(options){
        var defaults = {
            //各种参数默认值
            numbox:'span',
            childElem:'i',
            brightClass:'bright',
            grayClass:'gray'
        }

        var options = $.extend({},defaults,options);

        this.each(function(index, el) {

            var _this = $(this);   
            var num = 5;
            _this.find(options.childElem).bind('click',function(){
                //承载星星的dom元素
                var star = _this.find(options.childElem); 
                //星星的个数  
                var starLen = star.size(); 
                //被点击星星的索引    
                var selfIndex = star.index(this);
                //星星是否选中  
                var status = $(this).hasClass(options.brightClass);
                //选中星的个数 
                var selectStar;

                star.removeClass(options.brightClass);
                for(var i = 0; i <= selfIndex; i++){
                    star.eq(i).addClass(options.brightClass);
                    selectStar = _this.find(options.childElem+'.'+options.brightClass).size();
                    
                }
                num = selectStar;
                $(this).parent().siblings(options.numbox).text(num);
            });
        });

        return this;
    }
})(jQuery);