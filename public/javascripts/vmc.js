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
//------------------------------------------------------------------
$.validator.regex = {
	'mobile'    : /^(13[0-9]|14[0-9]|15[0-9]|18[0-9]|17[0-9])\d{8}$/i,
	'email'     : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
	'username'  : /^[a-zA-z][a-zA-Z0-9_]{5,15}$/,
	'zipcode'   : /^[0-9]{6}$/,
	'idcard'    : /^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/,
	'tel'       : /^(\d{3,4}-?)?\d{7,9}$/g,
	'password'	: /^[a-zA-Z0-9_]{6,26}$/,
	'ip'        : /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/
};
$.validator.messages = {
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
	format : $.validator.format("格式{0}错误！")
};
$.extend($.validator.methods, {
	format : function(value, element, param)
	{	
		console.log(param);
		if (this.optional( element ) ) {            
			return "dependency-mismatch";
		}			
		if(typeof param != 'string' || param == '') return false;
		var regex = $.validator.regex;
		if(param.indexOf("|")) // »ò
		{
			var REs = param.split("|");
			for(i in REs)
			{				
				if (typeof regex[REs[i]] != 'undefined' &&  regex[REs[i]].test(value))
				{
					return true;
				}								
			}
			return false;
		}else if(param.indexOf("&")){ // ºÍ
			var REs = param.split("&");
			for(i in REs)
			{
				if (typeof regex[REs[i]] == 'undefined' || !regex[REs[i]].test(value))
				{
					return false;
				}								
			}
			return true;
		}else if(regex[param] != 'undefined' && regex[param].test(value))
		{
			return true;
		}else{ // ×ÔÐ´ÕýÔò±í´ïÊ½
			try{  
				var Re = new RegExp(input);
				return Re.text(value);
			}catch(e){  
				return false;
			} 
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
		// ÑéÖ¤ÊÇ·ñÓÐÉÏÒ»´ÎÑéÖ¤
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
		
		if('data' in param && typeof param.data == 'string')
		{
			var dataObj={};
			var arrData = param.data.split(",");
			for(d in arrData){
				var o = arrData[d].replace("#", "");
				if($("#" + o).length > 0)
				{
					//$.data(dataObj, d.replace("#"), $(d).val());
					dataObj[o] = $("#" + o).val();
				}
			}				
			param['data'] = dataObj;
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
				var valid = false;
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
					errors[ element.name ] = previous.message = $.isFunction( message ) ? message( value ) : message;
					validator.invalid[ element.name ] = true;						
				}
				validator.showErrors( errors );
				previous.valid = valid;
				validator.stopRequest( element, valid );
			}
		}, param ) );	    
		return "pending";
	},
	equalto: function( value, element, param ) {			
		var target = $( param );
		return true;
		if ( this.settings.onfocusout ) {
			target.unbind( ".validate-equalTo" ).bind( "blur.validate-equalTo", function() {
				$( element ).valid();
			});
		}
		return value === target.val();
	}
});
//------------------------------------------------------------------
$.VMC = {
	host : '',
	root : '',
	init : function(options){
		this.location = location.host;
		this.root = location.origin;
		var defaults = {
			uploader	: true, // Ôö¼ÓRules
			validator	: true,				
			dialoger	: true
		};				
		setting = $.extend(true, defaults, options);
		for (i in setting )
		{	
			if(setting[i] === true && typeof this[i] == 'function') 
				var operator = this[i]();
		}
	}	
};
//------------------------------------------------------------------
$.VMC.validator = function(form){
	var defaults = {
		name : '',
		messages: {},
		groups: {},
		rules: {},
		errorClass: "error",
		validClass: "right",
		errorElement: "label",				
		focusInvalid: true,
		errorContainer: $( [] ),
		errorLabelContainer: $( [] ),
		onsubmit: true,
		ignore: ":hidden",
		ignoreTitle: false,
		success : function(label) {							
			label.html("&nbsp;").addClass('right');
		},
		onkeyup : function(element, event){ // È¥³ý keyup remoteÊÂ¼þ            
			if($(element).attr('remote')) return ;
			if ( event.which === 9 && this.elementValue( element ) === "" ) {
				return;
			} else if ( element.name in this.submitted || element === this.lastElement ) {						
				this.element( element );
			}
		},
		errorPlacement : function(error, element) {
			if(element.parents('.form-item').length >0) // Íâ²ã´æÔÚ
			{
				error.appendTo ( element.parents('.form-item'));
				return ;
			}
			if(element.is(":radio") || element.is(":checkbox") || element.is("input[name=captcha]"))
			{
				error.appendTo ( element.parent() );
				return ;
			}
			error.insertAfter(element);
		}
	};				
	$('form[data-module="validator"]').each(function(n, obj)
	{				
		var initRule = function (Obj){					
			var attrs = $(Obj)[0].attributes;
			var rules = {};		
			var hasrule = false;
			for (i in attrs)
			{
				var attr = attrs[i].name;
				var value = attrs[i].value;
				if(typeof $.validator.methods[attr] != 'function') continue;
				if(attr == 'required' && value == 'false') continue ;						
				if(attr == 'format')
				{
					if(! attr in $.validator.regex && attr in $.validator.methods)
					{
						attr = value;
					}
				}							
				switch (attr)
				{
					case 'remote':								
						value = {
							url   : value,
							type : 'post',
							data : $(Obj).attr('data')
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
					case 'equalTo':
					case 'format' :
						break;
					default : 
						value = true;
						break;							
				}
				rules[attr] = value;
				hasrule = true;
			}	
			if(hasrule) return rules;
			return hasrule;					
		};				
		var initMessage = function (Obj, inputName)
		{
			var group = $(Obj).parents('.form-group');				
			var messages = {};
			var _define = {};
			var hasmsg = false;
			if($(group).find("span[data-message]").length < 1) return false;					
			$(group).find("span[data-message]").each(function(i, o){
				var attr = $(o).attr('data-message');
				var value = $(o).text();
				if(typeof value == 'string' && value == '') return ;
				_define[attr] = value;
				if(attr in rules[inputName])
				{
					messages[attr] = value;
					hasmsg = true;
				}						
			});
			
			if('format' in _define){

				for(i in rules[inputName]) // format = mobile, email = true
				{						
					var rule = rules[inputName][i];
					if( i == 'required' || 
						i in messages 
					) continue;
					if(rule in $.validator.methods || i in $.validator.methods)
					{
						messages[i] = _define['format'];
						hasmsg = true;
					}
				}
			}
			if(hasmsg == false && 'error' in _define)
			{
				return _define['error'];
			}					
			return messages;
		}
		if($(obj).find('input[required]').length < 1) return ;				
		var rules = {};
		var messages = {};
		$(obj).find('input[required]').each(function(i, item){						
			var name = $(item).attr('name');					
			var rule = initRule(item, name);					
			if(typeof rule == 'object')
			{
				rules[name] = rule;
				var message = initMessage(item, name);
				if(message)	
				{
					messages[name] = message;
				}
			}					
		});
		var thisSeting = $.extend(true, defaults, {rules : rules, messages : messages});					
		$(obj).validate(thisSeting);				
	});
};
//------------------------------------------------------------------
$.VMC.uploader = function() {
	$('div[data-module="uploader"]').each(function(n, obj){				
		var form = obj;
		var defaults = {
			name	: '',
			tag		: '',
			replaceFileInput : true,
			formData: {},
			accept	: '',
			showClass	: 'imgShow',
			showBox	: $([]),
			thumb	: true,
			thumbClass	: 'thumb',
			thumbBox	: $([]),
			thumbDefault: $.VMC.root + '/public/javascripts/images/add.jpg' // thumbÄ¬ÈÏÍ¼Æ¬
		};
		
		var add = function(e, data){
			var box = $(this).parents('[data-module="uploader"]');
			var thumb = $(box).find('.thumb');
			var show = $(box).find('.thumb img');
			$(thumb).append('<span class="loading icon-spinner icon-spin"></span>');
			$(show).hide();
			if (data.autoUpload || (data.autoUpload !== false &&
				$(this).fileupload('option', 'autoUpload'))) {
					data.process().done(function () {
					data.submit();
				});
			}					
			data.submit();
		};
		var done = function(e, data){
			var box = $(this).parents('[data-module="uploader"]');
			var thumb = $(box).find('.thumb');
			var show = $(box).find('.thumb img');
			var re = $.parseJSON(data.result);
			$(thumb).find('.loading').remove();
			if(re.image_id)
			{						
				$(show).prop('src', re.url);
				$(box).find('input[type="hidden"]').val(re.image_id);
				$(show).show();
			}else{
				$(thumb).append('<span class="uploadError">ÉÏ´«Ê§°Ü£¡</span>');
			}
			
			$(thumb).unbind("click").bind('click', function(){
				$(box).find("input[type='file']").trigger('click');
			});

		};

		var settings = $.extend(true, defaults, {
			name : $(obj).attr('name'),
			formData : {
				tag : $(obj).attr('tag'),
			},
			thumbBox : $(obj).find(".thumb"),
			showBox : $(obj).find(".thumb img"),
			trigger : $(obj).find("input[type='file']"),
			hidden	: $(obj).find("input[type='hidden']"),
			add : add,
			done : done
		});

		if( typeof $(settings.showBox).prop('src') != 'string' || $(settings.showBox).prop('src') == '')
		{
			 $(settings.showBox).prop('src', settings.thumbDefault);
		}
		$(settings.trigger).fileupload(settings);
		$(settings.thumbBox).unbind("click").bind('click', function(){
			$(settings.trigger).trigger('click');
		});

	});				
};
//------------------------------------------------------------------
$.VMC.init();}))