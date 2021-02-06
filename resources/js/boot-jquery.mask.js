try {

    $(function () {
        $('.mask_date').mask('00/00/0000', {clearIfNotMatch: true, placeholder: "__/__/____"});
        $('.mask_time').mask('00:00:00', {clearIfNotMatch: true});
        $('.mask_date_time').mask('00/00/0000 00:00:00', {clearIfNotMatch: true});
        $('.mask_phone').mask('0000-0000', {clearIfNotMatch: true});
        //$('.mask_phone_with_ddd').mask('(00) 0000-0000', {clearIfNotMatch: true});
        let maskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };

        $('.mask_phone_with_ddd').mask(maskBehavior, options);
        $('.mask_ip_address').mask('099.099.099.099', {clearIfNotMatch: true});
        $('.mask_percent').mask('##0,00%', {reverse: true});
        $('.mask_cep').mask('00000-000', {clearIfNotMatch: true});
        $('.mask_cep_api').mask('00000-000', {
            clearIfNotMatch: true, placeholder: "__/__/____", onComplete: function (cep) {
                console.log('Mask is done!:', cep);
            },
            onKeyPress: function (cep, event, currentField, options) {
                console.log('An key was pressed!:', cep, ' event: ', event, 'currentField: ', currentField.attr('class'), ' options: ', options);
            },
            onInvalid: function (val, e, field, invalid, options) {
                var error = invalid[0];
                console.log("Digit: ", error.v, " is invalid for the position: ", error.p, ". We expect something like: ", error.e);
            }
        });
        $('.mask_cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.mask_cpf').mask('000.000.000-00', {reverse: true});
        $('.mask_money').mask('#.##0,00', {reverse: true});
    });

} catch (e) {
}
