const TDate = {
    dateBR : function(date, time = false, long = false, seconds = true) {
        let dateFormat = new Date(date);
        let day = dateFormat.getDate().toString().padStart(2, '0');
        if (long) {
            let daylong = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"][dateFormat.getDay()];
            var monthlong = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"][dateFormat.getMonth()];
            return `${daylong}, ${day} de ${monthlong} de ${dateFormat.getFullYear()}`
        }
        return day +
            '/' + (dateFormat.getMonth() + 1).toString().padStart(2, '0') +
            '/' + dateFormat.getFullYear() + (time ? ' ' +
                dateFormat.getHours().toString().padStart(2, '0') +
                ':' + dateFormat.getMinutes().toString().padStart(2, '0') + (seconds ? ':' + dateFormat.getSeconds().toString().padStart(2, '0') : '')
                : '');
    },
    dateUS: function (date, time = false, long = false, seconds = true) {
        let dateFormat = new Date(date);
        let day = dateFormat.getDate().toString().padStart(2, '0');
        return dateFormat.getFullYear()  +
            '-' + (dateFormat.getMonth() + 1).toString().padStart(2, '0') +
            '-' + day + (time ? ' ' +
                dateFormat.getHours().toString().padStart(2, '0') +
                ':' + dateFormat.getMinutes().toString().padStart(2, '0') + (seconds ? ':' + dateFormat.getSeconds().toString().padStart(2, '0') : '')
                : '');
    }
}

export default TDate
