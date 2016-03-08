var optionHtml = {
    id : 'summernote',
    height : 400,
    lang:'zh-CN',
    url : '/',
    toolbar: [
            ['style',['style']],
            ['color', ['color']],
            ['height', ['height']],
            ['style',['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert',['link','picture','table']],
            ['misc',['fullscreen','codeview']]
    ],
    onChange : function(){
        $('#' + optionHtml.id).html($('#' + optionHtml.id).code());
    },
    onImageUpload: function(files, editor, $editable) {
        var data = new FormData();
        var file = files[0];
        data.append('file',file);
        $.ajax({
            data: data,
            type: "POST",
            url: optionHtml.url,
            cache: false,
            contentType: false,
            processData: false,
            success: function(re) {
                try{
                    re = $.parseJSON(re);
                }catch(e){

                }
                if(re.url){
                    //editor.insertImage($editable, re.url);
                    // var img = '<img src="'+re.url+'" />';
                    console.log(editor, $editable);
                }

            }
        });
    }
}
