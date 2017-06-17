$(document).ready(function() {
    $('.cancel-modal').on('click', function() {
        $('#modal-cropper').modal('hide');
        cleanCropperComponent();
    });

    $('#update-image').on('click', function() {
        $('#browse-image').trigger('click');
    });

    $('#browse-image').on('change', function(e) {
        $('#modal-cropper').modal();
        cleanCropperComponent();
        handleUpload(e);
        $(this).val('');
    });
});

function handleUpload(e) {
    var reader = new FileReader(), $image = $('<img />'), containerWidth = $('#cropper-container').width();
    reader.onload = function(event) {
        var img = new Image();
        img.onload = function() {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            var width = img.width > containerWidth*0.8 ? containerWidth*0.8 : img.width;
            var height = width / img.width * img.height;
            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0, width, height);
            $image.attr('src', canvas.toDataURL("image/png")).appendTo('.crop');
            resizeableImage($image);
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
}

function cleanCropperComponent() {
    $('.resize-container').remove();
}