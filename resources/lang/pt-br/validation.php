<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    "accepted"         => "O campo :attribute deve ser aceito.",
    "active_url"       => "Essa não é uma URL válida.",
    "after"            => "Esse campo deverá conter uma data posterior a :date.",
    "alpha"            => "Esse campo deverá conter apenas letras.",
    "alpha_dash"       => "Esse campo deverá conter apenas letras, números e traços.",
    "alpha_num"        => "Esse campo deverá conter apenas letras e números.",
    "array"            => "Esse campo precisa ser um conjunto.",
    "before"           => "Esse campo deverá conter uma data anterior a :date.",
    "between"          => array(
        "numeric" => "Esse campo deverá ter um valor entre :min - :max.",
        "file"    => "Esse campo deverá ter um tamanho entre :min - :max kilobytes.",
        "string"  => "Esse campo deverá conter entre :min - :max caracteres.",
        "array"   => "Esse campo precisa ter entre :min - :max itens."
    ),
    "confirmed"        => "A confirmação para esse campo não coincide.",
    "date"             => "Esse campo não contém uma data válida.",
    "date_format"      => "A data indicada para esse campo não respeita o formato :format.",
    "different"        => "Os campos :attribute e :other deverão conter valores diferentes.",
    "digits"           => "Esse campo deverá conter :digits dígitos.",
    "digits_between"   => "Esse campo deverá conter entre :min a :max dígitos.",
    "email"            => "Esse campo não contém um endereço de email válido.",
    "exists"           => "O valor selecionado para esse campo é inválido.",
    "image"            => "Esse campo deverá conter uma imagem.",
    "in"               => "Esse campo não contém um valor válido.",
    "integer"          => "Esse campo deverá conter um número inteiro.",
    "ip"               => "Esse campo deverá conter um IP válido.",
    "max"              => array(
        "numeric" => "Esse campo não deverá conter um valor superior a :max.",
        "file"    => "Esse campo não deverá ter um tamanho superior a :max kilobytes.",
        "string"  => "Esse campo não deverá conter mais de :max caracteres.",
        "array"   => "Esse campo deve ter no máximo :max itens."
    ),
    "mimes"            => "Esse campo deverá conter um arquivo do tipo: :values.",
    "min"              => array(
        "numeric" => "Esse campo deverá ter um valor superior ou igual a :min.",
        "file"    => "Esse campo deverá ter no mínimo :min kilobytes.",
        "string"  => "Esse campo deverá conter no mínimo :min caracteres.",
        "array"   => "Esse campo deve ter no mínimo :min itens."
    ),
    "not_in"           => "Esse campo contém um valor inválido.",
    "numeric"          => "Esse campo deverá conter um valor numérico.",
    "regex"            => "O formato do valor para esse campo é inválido.",
    "required"         => "Campo obrigatório.",
    "required_if"      => "É obrigatória a indicação de um valor para esse campo quando o valor do campo :other é igual a :value.",
    "required_with"    => "É obrigatória a indicação de um valor para esse campo quando :values está presente.",
    "required_with_all" => "The :attribute field is required when :values is present.",
    "required_without" => "É obrigatória a indicação de um valor para esse campo quanto :values não está presente.",
    "required_without_all" => "É obrigatória a indicação de um valor para esse campo quando nenhum dos :values está presente.",
    "same"             => "Os campos :attribute e :other deverão conter valores iguais.",
    "size"             => array(
        "numeric" => "Esse campo deverá conter o valor :size.",
        "file"    => "Esse campo deverá ter o tamanho de :size kilobytes.",
        "string"  => "Esse campo deverá conter :size caracteres.",
        "array"   => "Esse campo deve ter :size itens."
    ),
    "unique"           => "O :attribute já existe.",
    "url"              => "O formato inválido.",
    "cpf"              => "Esse cpf é inválido.",
    "cnpj"             => "Esse cnpj é inválido.",
    "cpfExiste"        => "Esse cpf já se encontra registrado.",
    "cnpjExiste"       => "Esse cnpj já se encontra registrado.",
    "areas"             => "É necessário selecionar ao menos uma área.",
    "permissoesDeGrupo" => "É necessário selecionar ao menos uma permissão.",
    "data_anterior"      => "É necessário informar uma data anterior a data atual",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    "recaptcha" => 'Esse campo não está correto.',
    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(),

);
