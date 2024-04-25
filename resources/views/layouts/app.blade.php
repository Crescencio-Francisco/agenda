<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="{{ asset('bootstrap\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons\font\bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    @yield('content')
    @include('layouts.footer')
    <script src="{{ asset('bootstrap\js\bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome\js\all.min.js') }}"></script>
    <script src="{{ asset('fullcalendar\dist\index.global.min.js') }}"></script>
    <script src="{{ asset('fullcalendar\packages\bootstrap5\index.global.min.js') }}"></script>
    <script src="{{ asset('fullcalendar\packages\core\locales-all.global.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var eventos = {!! json_encode($eventos) !!};

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                themeSystem: 'bootstrap5',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                },
                locale: 'pt-br',
                // initialDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                editable: true,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events

                events: eventos,
                eventClick: function(info) {
                    // const abrirModal = new bootstrap.Modal(document.getElementById("modalEditar"));

                    document.getElementById("ver_id").value = info.event.id,
                        document.getElementById("apagar_id").value = info.event.id,
                        document.getElementById("ver_title").innerText = info.event.title,
                        document.getElementById("ver_description").innerText = info.event.extendedProps
                        .description,
                        document.getElementById("ver_start").innerText = info.event.start
                        .toLocaleString(),
                        document.getElementById("ver_end").innerText = info.event.end !== null ? info
                        .event.end.toLocaleString() : info.event.start.toLocaleString(),

                        abrirModal.show();

                },
                select: function(info) {
                    const abrirModal = new bootstrap.Modal(document.getElementById("modalRegistar"));
                    document.getElementById("dataInicio").value = converterData(info.start);
                    document.getElementById("dataTermino").value = converterData(info.end);

                    abrirModal.show();
                }
            });


            calendar.render();

            function converterData(dataSelecionada) {
                const data = new Date(dataSelecionada);

                const ano = data.getFullYear()
                const mes = String(data.getMonth() + 1).padStart(2, '0');
                const dia = String(data.getDate()).padStart(2, '0');
                const hora = String(data.getHours()).padStart(2, '0');
                const minuto = String(data.getMinutes()).padStart(2, '0');

                return `${ano}-${mes}-${dia} ${hora}:${minuto}`
            }

        });




        // Fechar alert
        setTimeout(function() {
            document.getElementById('alerta').classList.add('d-none');
        }, 3000);
    </script>


    {{-- <script src="{{ asset('js\app.js') }}"></script> --}}

</body>

</html>
