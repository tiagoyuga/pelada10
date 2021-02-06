$(function () {
    $.fn.select2.defaults.set("theme", "bootstrap4");

    let placeholder = "Selecione";

    $('.select2').select2({
        placeholder: placeholder,
        allowClear: true,
        width: 'resolve'
    });

    $(".select2-allow-clear").select2({
        allowClear: true,
        placeholder: placeholder,
        containerCssClass: ':all:',
        width: 'resolve'
    });
});


function performRemoteSearch(options) {

    $(options.element).select2({
        allowClear: true,
        placeholder: 'Selecione',
        containerCssClass: ':all:',
        width: 'resolve',
        ajax: {
            url: options.url,
            delay: 250,
            minimumInputLength: 3,
            dataType: 'json',
            data: function (params) {

                return {
                    search: params.term
                };

            }, processResults: function (data) {

                return {
                    results: $.map(data, function (item) {
                        return {
                            text: options.textOption(item),
                            id: item.id
                        }
                    })
                };
            }
        }
    });
}
