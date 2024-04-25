document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        themeSystem: 'bootstrap5',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        locale: 'pt-br',
        initialDate: '2024-04-23',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events


        events: '/home' // Rota para recuperar os eventos do banco de dados

    });
    calendar.render();

});


function converterData(dataSelecionada) {
    const data = new Date(dataSelecionada);

    const ano = data.getFullYear()
    const mes = String(data.getMonth() + 1).padStart(2, '0');
    const dia = String(data.getDate()).padStart(2, '0');
    const hora = String(data.getHours()).padStart(2, '0');
    const minuto = String(data.getMinutes()).padStart(2, '0');

    return `${ano}-${mes}-${dia} ${hora}:${minuto}`
}
