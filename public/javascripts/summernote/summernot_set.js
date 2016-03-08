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
        var editor = $('#' + this.id);              
        editor.html(editor.code());
    }    
}
