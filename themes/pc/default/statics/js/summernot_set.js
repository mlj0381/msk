
$('#summernote').summernote({
height:400,
lang:'zh-CN',
toolbar: [
            ['style',['style']],
            ['color', ['color']],
            ['height', ['height']],
            ['style',['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert',['link','picture','table']],
            ['misc',['fullscreen','codeview']]
    ],
onImageUpload: function(files, editor, editable) {
        var data = new FormData();
        var file = files[0];
        data.append('file',file);
        $.ajax({
            data: data,
            type: "POST",
            url: "<{link app=image ctl=site_upload act=index}>",
            cache: false,
            contentType: false,
            processData: false,
            success: function(re) {
                try{
                    re = $.parseJSON(re);
                }catch(e){

                }
                if(re.url)
                    
                editor.insertImage(editable, re.url);
            }
        });
    },onChange:function(){
        $('#summernote').html($('#summernote').code());
    }
});