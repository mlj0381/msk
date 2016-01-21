(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( [
			"jquery", 
			"js/global/plugs/jquery-validation/jquery.validate.min", 
			"js/global/plugs/jquery-validation/additional-methods.min"
		], 
		factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

	$.VMC = {	
		
		validator : function(form, options) {		
			this.form	= $("#"+ form);			
			this.plugs	= $.validator;
			this.methods= $.VMC.methods;

			this.format	= {};
			
			var defaults = {
				rules	: {},
				messages: {},
				methods : {}
			};
			
			this.setting = $.extend( true, defaults, options);	
			
			this.init = function()
			{
				var methods = $.extend(true, $.VMC.methods, this.setting.methods);
				var messages = $.extend(true, $.VMC.messages, this.setting.messages);
				this.plugs.methods = this.setting.methods = $.extend( true, $.validator.methods, methods);
				this.plugs.messages = this.setting.methods = $.extend( true, $.validator.messages, messages);
				var formObj = $.VMC.initForm(this.form, $.validator);

				$(this.form).validate({
					rules : formObj.rules,
					messages : formObj.messages,
					errorPlacement : this.errorPlacement,
					success : this.success,
					onkeyup : this.onkeyup
				});
			};
			this.errorPlacement = function(error, element) {
				if( element.is(":radio") )
					error.appendTo ( element.parent() );	
				else if ( element.is(":checkbox") )
					error.appendTo ( element.parent() );
				else if ( element.is("input[name=captcha]") )
					error.appendTo ( element.parent() );
				else
					error.insertAfter(element);
			};

			this.success = function(label) {
				console.log(label);
			   label.html("&nbsp;").addClass("right");
			};

			this.onkeyup = function(element, event){ // 去除 keyup remote事件            
				if($(element).attr('remote')) return ;
				if ( event.which === 9 && this.elementValue( element ) === "" ) {
					return;
				} else if ( element.name in this.submitted || element === this.lastElement ) {
					this.element( element );
				}
			};

			this.init();			
		},

		initForm : function(form, plugs){
			
			this.form = form;
			this.rules = {};
			this.messages = {};			
			this.methods = plugs.methods;

			this.init = function()
			{
				var _this = this;
				$(this.form).find('.required,[required]').each(function(n, obj){					
					var attrs = $(obj.attributes);            
					var inputName = $(obj).attr('name');
					var rule = {};					
					if(typeof _this.rules[inputName] != 'object')
					{	
						for(i in attrs)
						{  
							attr = attrs[i].nodeName;
							value = attrs[i].nodeValue;	
							
							if(attr == 'format' ) 
							{
								if(typeof(_this.methods[value]) == 'function')
								{
									rule[value] = true;
									_messages(obj, value, _this); // 初始化提示									
								}else	//if(typeof(customRegx[value]) == 'string'){
								{	
									rule['format'] = value;
									_messages(obj, 'format', _this); // 初始化提示
								}
							}else if(typeof(_this.methods[attr]) == 'function')
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
								_messages(obj, attr, _this); // 初始化提示
							}
						}			
						_this.rules[inputName] = rule;
					}
				});				
			}

			var _messages = function(obj, method, _self)
			{
				var group = $(obj).parents('.form-group');					
				var message = $(group).find("span[data-message='" + method + "']").text();
				var error = $(group).find("span[data-message='error']").text();
				var name = $(obj).attr('name');
				if($(group).find("span[data-message]").length > 0)
				{
					if(typeof _self.messages[name] == 'undefined')  _self.messages[name] = {};
					
					if(error && error != '')
					{
						_self.messages[name][method] = error;
					}
					if(message && message != '')
					{
						_self.messages[name][method] = message;
					}
				}
			}

			this.init();			
			return this;
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
		methods : {
			format : function(value, element, param)
			{	
				if (this.optional( element ) ) {            
					return "dependency-mismatch";
				}
				if(param.indexOf("|")) // 或
				{
					var regxs = param.split("|");
					for(i in regxs)
					{				
						if ((typeof $.VMC.regx[regxs[i]] != 'undefined') &&  $.VMC.regx[regxs[i]].test(value))
						{
							return true;
						}								
					}
					return false;
				}else if(param.indexOf("&")){ // 和
					var regxs = param.split("&");
					for(i in regxs)
					{
						if ((typeof  $.VMC.regx[regxs[i]] != 'undefined') ||  $.VMC.regx.format[regxs[i]].test(value))
						{
							return false;
						}								
					}
					return true;
				}else{
					return typeof  $.VMC.regx[regxs[i]] != 'undefined' &&  $.VMC.regx[param.regx].test(value);
				}		
			},
			size : function(value, element, param)
			{		
				if (this.optional(element)) {
					return "dependency-mismatch";
				}
				var size = Number(param.replace('m', '')) * 1024 * 1024;		
				if ($(element).attr("type") === "file") {			
					if (element.files && element.files.length) {
						for (i = 0; i < element.files.length; i++) {
							file = element.files[i];					
							if(file.size > size) return false;
						}
					}
				}
				return true;
			},
			accept : function(value, element, param)
			{				
				var typeParam = typeof param === "string" ? param.replace(/\s/g, "").replace(/,/g, "|") : "image/*",
				optionalValue = this.optional(element),
				i, file;		
				if (optionalValue) {
					return optionalValue;
				}
				if ($(element).attr("type") === "file") {			
					typeParam = typeParam.replace(/\*/g, ".*").replace('jpg', 'jpeg');
					
					if (element.files && element.files.length) {
						for (i = 0; i < element.files.length; i++) {
							file = element.files[i];					
							if (!file.type.match(new RegExp( ".?(" + typeParam + ")$", "i"))) {
								return false;
							}
						}
					}
				}
				return true;
			},
			idcard : function(value, element){       
				if (value.length == 15)
				{
					var exp = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{2})(\w)$/);
					var strMatch = value.match(exp);
					if(strMatch == null) return false;
					var D = new Date("19"+ strMatch[3] + "/"+ strMatch[4]+"/" + strMatch[5]);
					if(
						D.getYear() == strMatch[3] && 
					   (D.getMonth()+1) == strMatch[4] && 
					   D.getDate()== strMatch[5]
					) return true;
				}else if (value.length == 18){
					var exp = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/); 
					var strMatch = value.match(exp);
					if(strMatch == null) return false;
					var D = new Date(strMatch[3]+"/"+ strMatch[4] + "/" + strMatch[5]);           
					if( D.getFullYear() == strMatch[3] && 
					   (D.getMonth()+1) == strMatch[4] && 
						D.getDate()== strMatch[5]
					)  return true;            
				}
				return false;
			},
			remote : function(value, element, param)
			{
				if (this.optional( element ) ) {            
					return "dependency-mismatch";
				}
				// 验证是否有上一次验证
				var previous = this.previousValue( element ), validator, data;
				if (!this.settings.messages[ element.name ] ) {
					this.settings.messages[ element.name ] = {};
				}
				
				previous.originalMessage = this.settings.messages[ element.name ].remote;

				this.settings.messages[ element.name ].remote = previous.message;
				param = typeof param === "string" && { url: param } || param;
				if ( previous.old === value ) {
					return previous.valid;
				}
				
				previous.old = value;
				validator = this;
				this.startRequest( element );
				data = {};
				data[ element.name ] = value;
				$.ajax( $.extend( true, {
					url: param,
					mode: "abort",
					port: "validate" + element.name,
					dataType: "json",
					data: data,
					context: validator.currentForm,
					success: function( response ) {
						// {success : '', }
						// {error:''}
						var valid = false; //response === true || response === "true",
						var errors, message, submitted;
					   
						if(typeof response == 'object')
						{   
							if(typeof response.success != 'undefined')
							{
								if(response.success !== 'true')
								{                            
									valid = true;
									message = response.success;
								}                     
							}else if(typeof response.error != 'undefined')
							{
								 message = response.error;
							}
						}else{
							message = validator.settings.messages[ element.name ].error;
						}

						message = message || previous.originalMessage;
						validator.settings.messages[ element.name ].remote = message; //previous.originalMessage;
						errors = {};
						if ( valid ) {
							submitted = validator.formSubmitted;
							validator.prepareElement( element );
							validator.formSubmitted = submitted;
							validator.successList.push( element );
							delete validator.invalid[ element.name ];
							validator.showErrors();
						} else {                   
							// message = response || validator.defaultMessage( element, "remote" );
							errors[ element.name ] = previous.message = $.isFunction( message ) ? message( value ) : message;
							validator.invalid[ element.name ] = true;
							//console.log(errors,typeof errors);
							
						}
						// console.log(errors, errors.length);
						validator.showErrors( errors );
						previous.valid = valid;
						validator.stopRequest( element, valid );
					}
				}, param ) );	    
				return "pending";
			}
		},	
		messages : {
			required: "必须填写",
			remote: "请修正此栏位",
			email: "请输入有效的电子邮件",
			url: "请输入有效的网址",
			date: "请输入有效的日期",
			dateISO: "请输入有效的日期 (YYYY-MM-DD)",
			number: "请输入正确的数字",
			digits: "只可输入数字",
			creditcard: "请输入有效的信用卡号码",
			equalTo: "你的输入不相同",
			extension: "请输入有效的后缀",
			maxlength: $.validator.format("最多 {0} 个字"),
			minlength: $.validator.format("最少 {0} 个字"),
			rangelength: $.validator.format("请输入长度为 {0} 至 {1} 之間的字串"),
			range: $.validator.format("请输入 {0} 至 {1} 之间的数值"),
			max: $.validator.format("请输入不大于 {0} 的数值"),
			min: $.validator.format("请输入不小于 {0} 的数值"),
			accept : $.validator.format("仅支持{0}文件！"),
			size : $.validator.format("文件大小控制在{0}以内！"),
			username : $.validator.format("文件大小控制在{0}以内！"),
		}		
	};

}));