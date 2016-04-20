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
	'username'  : /^[a-zA-Z0-9_]{6,18}$/,
	'zipcode'   : /^[0-9]{6}$/,
	'idcard'    : /^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/,
	'tel'       : /^(\d{3,4}-?)?\d{7,9}$/g,
	'time'		: /^(([01]?[0-9])|(2[0-3])):[0-5]?[0-9]$/,
	'password'	: /^[a-zA-Z0-9_]{6,20}$/,
	'brankcard'	: /^(\d{16}|\d{19})$/,
	'positive'	: /^[0-9]+(\.\d+)?$/, //正数
	'age'		: /^([1-9]|[1-9][0-9]|1[01][0-9])$/,  //1-119
	'qq'		: /^\d{6,11}$/, 
	'proprotion': /^(\d{1,2}(\.\d{1,3})?|100)$/, //100内的数
	'ip'        : /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/
};
$.validator.messages = {
	required: "必须填写",
	remote: "请修正此栏位",
	email: "请输入有效的电子邮件",
	url: "请输入有效的网址",
	date: "请输入有效的日期",
	dateISO: "请输入有效的日期 (YYYY-MM-DD)",
	age:"请输入0-120之间的数字",
	number: "请输入正确的数字",
	digits: "只可输正整数",
	positive: "只可输入正数",
	creditcard: "请输入有效的信用卡号码",
	equalTo: "两次密码输入不一致",
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
	brankcard: $.validator.format("请填写正确的银行卡号！"),
	qq: $.validator.format("请填写正确的QQ号"),
	proprotion: $.validator.format("请输入正确的销售比例")
	//format : $.validator.format("格式{0}错误！")
};
$.extend(true, $.validator.methods, {

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

	},
	fun : function(value, element, param)
	{
		if (this.optional( element ) ) {
			return "dependency-mismatch";
		}
		if(typeof param != 'string' || param == '') return false;
		var regex = $.validator.regex;

		if(param.indexOf("|") > 0){
			var REs = param.split("|");
			for(i in REs){
				if (typeof regex[REs[i]] != 'undefined' &&  regex[REs[i]].test(value)){
					return true;
				}
			}
			return false;
		}else if(param.indexOf("&") > 0){
			var REs = param.split("&");
			for(i in REs)
			{
				if (typeof regex[REs[i]] == 'undefined' || !regex[REs[i]].test(value))
				{
					return false;
				}
			}
			return true;
		}else if( param in regex)
		{			
			return regex[param].test(value);
		}else{
			try{
				var Re = new RegExp(param);
				return Re.text(value);
			}catch(e){
				return false;
			}
		}
		return true;
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
			uploader	: true,
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
		ignore: "",
		ignoreTitle: false,
		success : function(label, element) {

			if($(element).parents('.timeLimit').length >0)
			{	
				if($('.timeStart').val() !="" && $('.timeEnd').val() !="")
				{
					label.html("&nbsp;").addClass('right');	
				}
				else return;
				
			}
			label.html("&nbsp;").addClass('right');
		},
		onkeyup : function(element, event){
			if($(element).attr('remote')) return ;
			if ( event.which === 9 && this.elementValue( element ) === "" ) {
				return;
			} else if ( element.name in this.submitted || element === this.lastElement ) {
				this.element( element );
			}
		},
		errorPlacement : function(error, element){		
			element.parents('.form-group').find('label.error,label.right').remove();
			if(element.parents('.form-item').length >0)
			{
				error.appendTo ( element.parents('.form-item').parent());
				return ;
			}			
			if(element.is(":radio") || element.is(":checkbox") || element.is("input[name=captcha]"))
			{
				error.appendTo ( element.parent() );
				return ;
			}
			if(element.parents('.timeLimit').length >0)
			{
				var $par = $(element).parents('.timeLimit');

				if($par.find('.timeStart').val() =="" || $par.find('.timeEnd').val() =="")
				{
					error.appendTo ( element.parents('.timeLimit').parent() );	
				}
				return;
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
				if(typeof $.validator.methods[attr] != 'function' && attr != 'format') continue;
				//if(attr == 'required' && value == 'false') continue ;
				if(attr == 'format' && typeof $.validator.methods[value] == 'function')
				{
					attr = value;
				}else if(attr == 'format'){
					attr = 'fun';
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
					case 'required' : 
						if(value != 'true')
							value = false;
						else
							value = true;
						break;
					case 'accept' :
					case 'equalTo' :
					case 'equalto':
					case 'accept' :
					case 'fun' :
						//value = value;
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
					if( i == 'required' ||	(i in messages) ) continue;
					if((rule in $.validator.methods) || (i in $.validator.methods))
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
	var images = [];
	$('div[data-module="uploader"]').each(function(n, obj){
		var box = {
			thumbBox : $(obj).find(".thumb"),
			showBox : $(obj).find(".thumb img"),
			handle : $(obj).find("input[type='file']"),
			hidden	: $(obj).find("input[type='hidden']"),
			thumbDefault: $.VMC.root + '/public/javascripts/images/add.jpg'
		};
		var settings = {
			name : $(obj).attr('name'),
			url : $(box.handle).attr('data-url'),
			formData : {
				tag : $(obj).attr('tag'),
			},
			add : function(e, data){
				var box = $(this).parents('[data-module="uploader"]');
				var thumb = $(box).find('.thumb');
				var show = $(box).find('.thumb img');
				thumb.find(".uploadError").hide();				
				$(thumb).append('<span class="loading icon-spinner icon-spin"></span>');
				$(show).hide();
				data.submit();
			},
			done : function(e, data){
				var box = $(this).parents('[data-module="uploader"]');				
				var thumb = $(box).find('.thumb');
				var show = $(box).find('.thumb img');
				var re = $.parseJSON(data.result);
				$(thumb).find('.loading').remove();
				var ErrorTip = '<span class="uploadError">上传失败</span>';
				var hidden = $(box).find('input[type="hidden"]');
				var labelName = $(hidden).attr('name');
				var message = '';
				if(re.image_id)
				{
					$(show).prop('src', re.url);					
					$(hidden).val(re.image_id);
					$(box).find('input[type="hidden"]').val(re.image_id);
					$(show).show();				
					message = $.validator.format('<label id="{0}-error" class="right" for="{1}">&nbsp;</label>', [labelName, labelName]);
					
				}else if($(box).find('.uploadError').length < 1)
				{
					$(thumb).append(ErrorTip);
					message = $.validator.format('<label id="{0}-error" class="error" for="{1}">{2}</label>', [labelName, labelName, '上传失败'])
				}
				$(box).find('label.error,label.right').remove();
				$(box).append(message);
			}
		};
		if( typeof $(box.showBox).prop('src') != 'string' || $(box.showBox).prop('src') == '')
		{
			 $(box.showBox).prop('src', box.thumbDefault);
		}
		$(box.handle).fileupload(settings);
		
	});
};
//------------------------------------------------------------------
//------------------------------------------------------------------
$.VMC.format = function( source, params ) {
	if ( arguments.length === 1 ) {
		return function() {
			var args = $.makeArray( arguments );
			args.unshift( source );
			return $.VMC.format.apply( this, args );
		};
	}
	if ( arguments.length > 2 && params.constructor !== Array  ) {
		params = $.makeArray( arguments ).slice( 1 );
	}
	if ( params.constructor !== Array ) {
		params = [ params ];
	}
	$.each( params, function( i, n ) {
		source = source.replace( new RegExp( "\\{" + i + "\\}", "g" ), function() {
			return n;
		});
	});
	return source;
};
//Example : $.VMC.format("<label type='{0}'>{1}</label>", 'A', 'B')
//------------------------------------------------------------------
//$("input[format='region'][required]").region();
//------------------------------------------------------------------
$.VMC.init();}));