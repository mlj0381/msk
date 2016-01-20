(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( [
			"jquery", 
			"desktop/comm/global/plugs/jquery-validation/jquery.validate.min.js", 
			"desktop/comm/global/plugs/jquery-validation/additional-methods.min.js"
		], 
		factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

	$.VMC = {
		
		validator : function( options, form ) {
			this.settings = $.extend( true, {}, $.validator.defaults, options );
			this.currentForm = form;
			this.init();
			
			this.plugs = $.validator;
			


			// 获取表单验证项
			this.rules = item();
			function item(form)
			{
				var rules = {};
				$(form).find('.required,[required]').each(function(n, obj){			
					var option = {};
					var attrs = $(obj.attributes);            
					var inputName = $(obj).attr('name');
					var rule = {};			
					for(i in attrs)
					{  
						attr = attrs[i].nodeName;
						value = attrs[i].nodeValue;
						if(attr == 'format' ) 
						{
							if(typeof($.validator.methods[value]) == 'function')
							{
								rule[value] = true;
								break;
							}else	//if(typeof(customRegx[value]) == 'string'){
							{	
								rule['regx'] = value;
							}
						}else if(typeof($.validator.methods[attr]) == 'function')
						{
							switch (attr)
							{						
								case 'remote':
									value = {
										url   : value,
										type : 'post'
									};
									break;
								case 'range':
									range = value.split(",");
									if(range.length != 2) break;
									value = range;
									break;
								case 'rangelength':
									var rang = value.split(",");
									if(rang.length != 2) break;                        
									break;
								case 'required':
									value = true;
									break;
							}
							rule[attr] = value;
						}          
					}			
					rules[inputName] = rule;
				});
				return rules;
			}
			
			// 表单验证方法
			this.methods = {};
			function method()
			{				
				
			}
		},

		regx : {
			'mobile'    : /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i,
			'email'     : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
			'username'  : /^[a-zA-z][a-zA-Z0-9_]{5,15}$/,
			'zipcode'   : /^[0-9]{6}$/,
			'idcard'    : /^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/,
			'tel'       : /^(\d{3,4}-?)?\d{7,9}$/g,
			'password'	: /^[a-zA-Z0-9_]{6,26}$/,
			'ip'        : /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/
		},
	};

}));