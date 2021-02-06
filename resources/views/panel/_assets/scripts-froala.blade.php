<!-- Include CSS for icons. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>

<!-- Include Editor style. -->
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_editor.pkgd.min.css" rel="stylesheet"
      type="text/css"/>
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_style.min.css" rel="stylesheet"
      type="text/css"/>

<!-- Include Editor JS files. -->
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/js/froala_editor.pkgd.min.js"></script>

<!-- Initialize the editor. -->
<script>
    $(function () {
        $('.froalaEditor').froalaEditor({
            requestHeaders: {
                Authorization: '{{ csrf_token() }}'
            },
            //requestWithCredentials: true,
            language: 'pt_br',
            linkAutoPrefix: 'http://',
            // pastePlain: true, // Removes text formatting when pasting content into the rich text editor.
            toolbarSticky: true,
            toolbarStickyOffset: 40,  // pixels
            toolbarButtons: ['undo', 'redo', '|', 'paragraphFormat', 'bold', 'italic', 'underline', 'strikeThrough', '|', 'formatUL', 'formatOL', 'align', 'outdent', 'indent', '|', 'insertImage', 'insertFile', 'insertVideo', 'insertLink', 'insertHR', '|', 'clearFormatting', 'insertTable', 'specialCharacters', 'html'],
            imageUploadURL: '/editor/upload-images',
            imageManagerLoadURL: '/editor/list-images',
            imageManagerDeleteURL: '/editor/delete-images',
            fileUploadURL: '/editor/upload-files',
            imageMaxSize: 5 * 1024 * 1024,  // Set max image size to 5MB.
            imageDefaultWidth: 600,
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif', 'bmp'] // Allow to upload
        })
    });
</script>
