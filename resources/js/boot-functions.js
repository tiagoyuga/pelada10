function block(element = false) {

    const settings = {
        message: 'Aguarde...',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff',
            'font-size': '16px',
            'font-weight': 'bold'
        }
    };

    if (element) {
        $(element).block(settings);
    } else {
        $.blockUI(settings);
    }
}

function unBlock(element = false) {

    if (element) {
        $(element).unblock();
    } else {
        $.unblockUI();
    }
}

function showMessage(type, m, time) {

    if (isNaN(time)) {

        time = 7;
    }

    time = time * 1000;

    let positionClass;
    if (type !== 's' && type !== 'i' && type !== 'w' && type !== 'e') {
        positionClass = 'toast-top-full-width';
        type = 'e';
        m = "CONFIGURAÇÃO INVÁLIDA";
    } else {
        positionClass = 'toast-top-right';
    }

    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            positionClass: positionClass,
            timeOut: time
        };
        if (type === 's')
            toastr.success(m);
        else if (type === 'i')
            toastr.info(m);
        else if (type === 'w')
            toastr.warning(m);
        else if (type === 'e')
            toastr.error(m);
    }, 0);
}

function showIframeBlock(element) {

    //TODO ajustar para quando for mobile, reposicionar tamanho

    $.blockUI({
        message: $(element),
        css: {
            zIndex: '1011',
            position: 'fixed',
            padding: '0px',
            margin: '0px',
            width: '70%',
            top: '4%',
            left: '15%',
            textAlign: 'center',
            color: 'rgb(0, 0, 0)',
            border: '3px solid rgb(170, 170, 170)',
            backgroundColor: 'rgb(255, 255, 255)',
            cursor: 'wait',
            height: '80%',
        }
    });

    $('.blockOverlay').attr('title','Fechar').click($.unblockUI);

    //setTimeout($.unblockUI, 2000);
}

function toDateBr(dateUS) {
    let today = new Date(dateUS);
    return  today.getDate().toString().padStart(2, 0) +
        '/' + (today.getMonth() + 1).toString().padStart(2, 0) +
        '/' + today.getFullYear();
}
