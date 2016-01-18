jQuery.fn.extend({
	formValid : function(params) {
		var form = $(this);
        var options = {};
        options.rules = {};

		for(m in customMethod)
        {
            $.validator.methods[m] = customMethod[m];
        }

		$(form).find('.required,[required]').each(function(n, obj){
            var option = {};
            var attrs = $(obj.attributes);            
            var inputName = $(obj).attr('name');
            var rule = {};            
            for(i in attrs)
            {  
                attr = attrs[i].nodeName;
                value = attrs[i].nodeValue;
				if(attr == 'format') attr = value;
                if(typeof($.validator.methods[attr]) == 'function')
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
                        /*
						case 'required':
                            rule = "required";
                            break;      
							*/
                    }
                    if(typeof(rule) == 'object')
                    {
                        rule[attr] = value;
                    }                    
                }           
            }
            options['rules'][inputName] = rule;
		});        
        //console.log(options);
        options.errorPlacement = function(error, element) {
			if ( element.is(":radio") )
				error.appendTo ( element.parent() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.parent() );
			else if ( element.is("input[name=captcha]") )
				error.appendTo ( element.parent() );
			else
				error.insertAfter(element);
		};
        options.success = function(label) {
		   label.html("&nbsp;").addClass("right");
	    }
        options.onkeyup = function(element, event){ // 去除 keyup remote事件            
            if($(element).attr('remote')) return ;
			if ( event.which === 9 && this.elementValue( element ) === "" ) {
				return;
			} else if ( element.name in this.submitted || element === this.lastElement ) {
				this.element( element );
			}
        }       
        
        // $.extend(true, {}, $.validator.methods, );
        //console.log($.validator.methods);
        $(form).validate(options);        
	}
});




// 自字定义消息
$.validator.prototype.customMessage = function( name, method) {
    var objFormItem = $("input[name='" + name + "']").parents('.form-group');    
    var msgTip = $(objFormItem).find("span[data-message='" + method + "']").text();
    var errorMsg = $(objFormItem).find("span[data-message='error']").text();
    if(msgTip != '') return msgTip;
    if(errorMsg != '') return errorMsg;   
    var m = this.settings.messages[ name ];
    return m && ( m.constructor === String ? m : m[ method ]);
}

var customRegx = {
    'mobile'    : /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i,
    'email'     : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
    'username'  : /^[a-zA-z][a-zA-Z0-9_]{5,15}$/,
    'zipcode'   : /^[0-9]{6}$/,
    'idcard'    : /^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/,
    'tel'       : /^(\d{3,4}-?)?\d{7,9}$/g,
    'ip'        : /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/
};

var customMethod = {
    username : function(value, element)
    {      
        return this.optional(element) ||           
               customRegx.mobile.test(value) || 
               customRegx.email.test(value) || 
               customRegx.username.test(value)
    },
    mobile : function(value, element){
        return this.optional(element) || 
            (length == 11 && customRegx.mobile.test(value));
    },
    email : function(value, element){
        return this.optional(element) || 
            (length == 11 && customRegx.email.test(value));
    },
    zipcode : function(value, element){
        return this.optional(element) || 
            (length == 11 && customRegx.zipcode.test(value));
    },    
    tel : function(value, element){
        return this.optional(element) || 
            (length == 11 && customRegx.tel.test(value));
    },
    phone : function(value, element){ // 手机和固话
        return this.optional(element) || 
            (length > 0 && (customRegx.tel.test(value) || customRegx.tel.test(value)));
    },
    ip : function(value, element){
        
        return this.optional(element) || 
            (length == 11 && customRegx.ip.test(value));
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

        console.log(value);
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
                    console.log(errors,typeof errors);
                    
                }
                console.log(errors, errors.length);
                validator.showErrors( errors );
                previous.valid = valid;
                validator.stopRequest( element, valid );
            }
        }, param ) );
	    
        return "pending";
    }
}