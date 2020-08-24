function validateFileType(input) {
    var validExtensions = ['jpg','png','jpeg','PNG', 'JPG', 'JPEG'];
    var fileName = input.files[0].name;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
        input.type = ''
        input.type = 'file'
        $('#profileImage').attr('src',"");
        alert("Lubatud on ainult png, jpg, jpeg formaadid");
    }
    else
    {
        if (input.files && input.files[0]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
                $('#profileImage')
                    .attr('style', 'visibility: visible;')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);

            };
            filerdr.readAsDataURL(input.files[0]);
        }
    }
}