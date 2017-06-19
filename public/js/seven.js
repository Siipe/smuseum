$.fn.showLoadingSnippet = function() {
    $('body').addClass('modal-open');
    $(this).find('.loading-overlay').addClass('animationload');
    $(this).find('.loading-icon').addClass('osahanloading');
    $(this).show();
};

$.fn.hideLoadingSnippet = function() {
    $('body').removeClass('modal-open');
    $(this).find('.loading-overlay').removeClass('animationload');
    $(this).find('.loading-icon').removeClass('osahanloading');
    $(this).hide();
};

$(document).ready(function () {
    $('a.confirm').on('click', function(e) {
        e.preventDefault();
        var message = $(this).data('message') || 'Deseja prosseguir';
        confirmDialog('Confirmação', message, function() {
            location.href = $(this).attr('href');
        }.bind(this));
    });

    $('.cancel-modal').on('click', function () {
        $('#modal-cropper').modal('hide');
        cleanCropperComponent();
    });

    $('#update-image').on('click', function () {
        $('#browse-image').trigger('click');
    });

    $('#browse-image').on('change', function (e) {
        $('#modal-cropper').modal();
        cleanCropperComponent();
        handleUpload(e);
        $(this).val('');
    });
});

function adicionarAoCarrinho(id, url) {
    bootbox.prompt({
        title: "Quantidade",
        inputType: 'number',
        callback: function(result) {
            if (result) {
                async(
                    url,
                    {
                        id : id,
                        quantidade : result
                    },
                    function(resp) {
                        customAlert('fa fa-check', 'Sucesso!', resp.message);
                    }
                );
            }
        }
    });
}

function handleUpload(e) {
    var reader = new FileReader(), $image = $('<img />'), containerWidth = $('#cropper-container').width();
    reader.onload = function (event) {
        var img = new Image();
        img.onload = function () {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            var width = img.width > containerWidth * 0.8 ? containerWidth * 0.8 : img.width;
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

function async(action, data, success, fail, dataType) {
    $('#seven-loading').showLoadingSnippet();
    var config = {
        url: action,
        dataType: 'undefined' === typeof dataType ? 'json' : dataType,
        type: 'POST',
        data: data,
        success: function (response) {
            $('#seven-loading').hideLoadingSnippet();
            if (!response.failure) {
                if ('function' === typeof success) {
                    success(response);
                }
            } else {
                if ('function' === typeof fail) {
                    fail(response);
                } else {
                    customAlert(
                        'fa fa-bug',
                        'Ocorreu um erro no processamento da requisição',
                        response.message
                    )
                }
            }
        },
        error: function (err) {
            $('#seven-loading').hideLoadingSnippet();
            customAlert(
                'fa fa-bug',
                'Ocorreu um erro na chamada assíncrona',
                err.responseText
            )
        }
    };
    $.ajax(config);
}

function customAlert(icon, title, message, callback) {
    bootbox.dialog({
        title: "<i class=\"" + icon + "\"></i> " + title,
        message: message || 'Nenhuma mensagem a ser exibida',
        buttons: {
            success: {
                label: 'OK',
                className: "btn btn-sm btn-primary",
                callback: function () {
                    $(this).modal('hide');
                    if (typeof callback !== 'undefined') {
                        callback();
                    }
                }
            }
        }
    });
}

function confirmDialog(title, message, callback)
{
    bootbox.confirm({
        title: title,
        message: message,
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar',
                className: 'btn btn-sm btn-default'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> OK',
                className: 'btn btn-sm btn-primary'
            }
        },
        callback: function (result) {
            if (result && 'function' === typeof callback) {
                callback(result);
            }
        }
    });
}