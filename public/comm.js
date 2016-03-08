! function() {
    /**
     * Jquery 个性化
     */
    var r20 = /%20/g,
        rbracket = /\[\]$/,
        rCRLF = /\r?\n/g,
        rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
        rsubmittable = /^(?:input|select|textarea|keygen)/i;
	
	// 参数组合
    function buildParams(prefix, obj, traditional, add) {
        var name;

        if (jQuery.isArray(obj)) {
            // Serialize array item.
            jQuery.each(obj, function(i, v) {
                if (traditional || rbracket.test(prefix)) {
                    // Treat each array item as a scalar.
                    add(prefix, v);

                } else {
                    // Item is non-scalar (array or object), encode its numeric index.
                    buildParams(prefix + "[" + (typeof v === "object" ? i : "") + "]", v, traditional, add);
                }
            });

        } else if (!traditional && jQuery.type(obj) === "object") {
            // Serialize object item.
            for (name in obj) {
                buildParams(prefix + "[" + name + "]", obj[name], traditional, add);
            }

        } else {
            // Serialize scalar item.
            add(prefix, obj);
        }
    }

    // Serialize an array of form elements or a set of
    // key/values into a query string
    jQuery.param = function(a, traditional) {
        var prefix,
            s = [],
            add = function(key, value) {
                // If value is a function, invoke it and return its value
                value = jQuery.isFunction(value) ? value() : (value == null ? "" : value);
                s[ s.length ] = key + "=" + encodeURIComponent( value );
                //s[s.length] = (key) + "=" + (value);
            };

        // Set traditional to true for jQuery <= 1.3.2 behavior.
        if (traditional === undefined) {
            traditional = jQuery.ajaxSettings && jQuery.ajaxSettings.traditional;
        }

        // If an array was passed in, assume that it is an array of form elements.
        if (jQuery.isArray(a) || (a.jquery && !jQuery.isPlainObject(a))) {
            // Serialize the form elements
            jQuery.each(a, function() {
                add(this.name, this.value);
            });

        } else {
            // If traditional, encode the "old" way (the way 1.3.2 or older
            // did it), otherwise encode params recursively.
            for (prefix in a) {
                buildParams(prefix, a[prefix], traditional, add);
            }
        }

        // Return the resulting serialization
        return s.join("&").replace(r20, "+");
    };
}();

var BlockLoading = Metronic.blockUI,
    UnblockLoading = Metronic.unblockUI;
	Messagebox = toastr;

jQuery(document).ready(function() {
	Metronic.init();
	// Layout.init();
	window.load_page = function(url, container, params, callback) {
		return ;
		/*
		container = container || $('[data-updatecontainer="default"]');
		var data = false;
		if (params && typeof params === 'string') {
			$.each(params.split('&'), function(i, kv) {
				kv = kv.split('=');
				if (kv[1]) {
					if (typeof data !== 'object') data = {};
					data[kv[0]] = kv[1];
				}
			});
		}
		BlockLoading({
			target: container,
			animate: true
		});

		container.load(url, data, function(re, f, obj) {
			if (container.is('div[data-updatecontainer="default"]')) pushState(url);
			if (callback && typeof callback === 'function') {
				callback();
			}

		});
		*/

	};

	$(document.body).on('click', 'a:not(a[target="_blank"],a[href^="javascript:"],a[data-toggle],a[data-target],a[data-event])', function(e) {
		//e.stopPropagation();
		if ($(this).attr('data-confirm') && !confirm($(this).attr('data-confirm'))) {
			return false;
		}
		var _this = $(this);
		var url = _this.prop('href');
		var target = _this.prop('target');
		// var c = _this.closest('[data-updatecontainer]');
		if (target == '_command') {
			$.ajax({
				url: url,
				success: function(responseText) {
					jsonCommond(responseText);
				},
				error: function(xhr) {
					Messagebox.error('STATUS:' + xhr.status, '请求异常');
				}
			});
			return false;
		}
		/*
		if (c.length)
			load_page(url, c);
		else
			load_page(url);
		*/
		return false;		
	});
});

/*
 * 消息处理
*/
var jsonCommond = function(response) {
    re = jsonDecode(response);
    if (!re) {
        return Messagebox.error('操作失败!' + response, '异常');
    }
    if (re.success) {
        Messagebox.success(re.success, '成功');
        if (re.redirect) {
            //load_page(re.redirect);
        }
        return;
    }
    if (re.error) {
        Messagebox.error(re.error, '错误');
    }
};

/**
 * 处理回车提交
 */
$(document).on('keydown',function(e){
    if(e.keyCode == 13 && $(e.target).is('input') && e.target.form){
        try{
            if($(e.target).data('events')['keydown']){
                return true;
            }
        }catch(e){

        }finally{

        }

        e.stopPropagation();
        return false;
    }
});

jsonDecode = function(re) {
    if (typeof(re) == 'object') {
        return re;
    }
    try {
        re = JSON.parse(re);
        if (!re || typeof(re) != 'object')
            re = $.parseJSON(re);
        if (!re || typeof(re) != 'object')
            return false;
    } catch (e) {
        return false;
    }
}
bootbox.setDefaults({
    locale: 'zh_CN'
});