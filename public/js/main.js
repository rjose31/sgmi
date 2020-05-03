function showNotification(message, type, timer = 1500) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: type,
        title: message
    });
}

function toUpper(el)
{
    let p = el.selectionStart;
    el.value = el.value.toUpperCase();
    el.setSelectionRange(p, p);
}

function onlyNumbers(e)
{
    if (e.which !== 8 && e.which !== 0 && e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
}

$(function () {

    $('#hora').inputmask("hh:MM TT", {
        placeholder: "12:00 AM",
        insertMode: false,
        showMaskOnHover: true,
        hourFormat: 12
    });

    $('#telefono-alumno').inputmask('9999-9999');

    const cantidadClasesNuevo = $('#limite-clases-nuevo');
    const cantidadClasesEditar = $('#limite-clases-editar');
    let totalCountNuevo = 0;
    let totalCountEditar = 0;
    const nflCard = $('.nfl-card');
    const eflCard = $('.efl-card');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#docentes-activos').DataTable({
        "processing": true,
        "ajax": {
            "url": "/docentes/activos/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                return json;
            },
        },
        "columns": [
            {"data": "codigo_docente"},
            {"data": "nombre"},
            {"data": "id_tipo_docente"},
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <div class="btn-group">
                            <a href="/docentes/editar/${row['id']}" class="btn btn-warning" data-toggle="tooltip" title="Editar">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="/docentes/deshabilitar/${row['id']}" class="btn btn-danger deshabilitar-docente" data-toggle="tooltip" title="Deshabilitar">
                                <i class="fas fa-user-slash"></i>
                            </a>
                        </div>
                    `;
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[1, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $('#docentes-inactivos').DataTable({
        "processing": true,
        "ajax": {
            "url": "/docentes/inactivos/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                return json;
            },
        },
        "columns": [
            {"data": "codigo_docente"},
            {"data": "nombre"},
            {"data": "id_tipo_docente"},
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <div class="btn-group" aria-label="action buttons">
                            <a href="/docentes/habilitar/${row['id']}" class="btn btn-success habilitar-docente" data-toggle="tooltip" title="Habilitar">
                                <i class="fas fa-user-check"></i>
                            </a>
                        </div>
                    `;
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[1, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $('#alumnos-inactivos').DataTable({
        "processing": true,
        "ajax": {
            "url": "/alumnos/inactivos/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                console.log(json);
                return json;
            },
        },
        "columns": [
            {"data": "numero_cuenta"},
            {"data": "nombre"},
            {"data": "telefono"},
            {"data": "id_carrera"},
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <div class="btn-group">
                            <a href="/alumnos/habilitar/${row['id']}" class="btn btn-success habilitar-alumno" data-toggle="tooltip" title="Deshabilitar">
                                <i class="fas fa-user-check"></i>
                            </a>
                        </div>
                    `;
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[1, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $('#alumnos-activos').DataTable({
        "processing": true,
        "ajax": {
            "url": "/alumnos/activos/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                return json;
            },
        },
        "columns": [
            {"data": "numero_cuenta"},
            {"data": "nombre"},
            {"data": "telefono"},
            {"data": "id_carrera"},
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <div class="btn-group">
                            <a href="/alumnos/flujograma/${row['id']}" class="btn btn-info" data-toggle="tooltip" title="Flujograma">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="/alumnos/flujograma-descargar/${row['id']}" class="btn btn-success" data-toggle="tooltip" target="_blank" title="Descargar">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="/alumnos/editar/${row['id']}" class="btn btn-warning" data-toggle="tooltip" title="Editar">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="/alumnos/deshabilitar/${row['id']}" class="btn btn-danger deshabilitar-alumno" data-toggle="tooltip" title="Deshabilitar">
                                <i class="fas fa-user-slash"></i>
                            </a>
                        </div>
                    `;
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[1, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $('#usuarios-activos').DataTable({
        "processing": true,
        "ajax": {
            "url": "/usuarios/activos/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                return json;
            },
        },
        "columns": [
            {"data": "username"},
            {"data": "name"},
            {"data": "email"},
            {"data": "id_carrera"},
            {"data": "id_tipo_usuario"},
            {
                "data": null, "render": function (data, type, row) {
                    if(row['id_tipo_usuario'] !== 'Docente') {
                        return `
                        <div class="btn-group">
                            <a href="/usuarios/cc/${row['id']}" class="btn btn-secondary cantidad-clases" data-toggle="tooltip" title="Establecer Cantidad de Clases">
                                <input type="hidden" class="id-usuario-cc" value="${row['id']}" />
                                <i class="far fa-calendar-plus"></i>
                            </a>
                            <a href="/usuarios/rp/${row['id']}" class="btn btn-info reiniciar-pass" data-toggle="tooltip" title="Reiniciar Contraseña">
                                    <i class="fas fa-key"></i>
                                </a>
                            <a href="/usuarios/editar/${row['id']}" class="btn btn-warning" data-toggle="tooltip" title="Editar">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="/usuarios/deshabilitar/${row['id']}" class="btn btn-danger deshabilitar-usuario" data-toggle="tooltip" title="Deshabilitar">
                                <i class="fas fa-user-slash"></i>
                            </a>
                        </div>
                    `;
                    } else {
                        return `
                        <div class="btn-group">
                            <a href="/usuarios/cc/${row['id']}" class="btn btn-secondary cantidad-clases disabled" data-toggle="tooltip" title="Establecer Cantidad de Clases">
                                <i class="far fa-calendar-plus"></i>
                            </a>
                            <a href="/usuarios/rp/${row['id']}" class="btn btn-info reiniciar-pass disabled" data-toggle="tooltip" title="Reiniciar Contraseña">
                                    <i class="fas fa-key"></i>
                                </a>
                            <a href="/usuarios/editar/${row['id']}" class="btn btn-warning" data-toggle="tooltip" title="Editar">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="/usuarios/deshabilitar/${row['id']}" class="btn btn-danger deshabilitar-usuario" data-toggle="tooltip" title="Deshabilitar">
                                <i class="fas fa-user-slash"></i>
                            </a>
                        </div>
                    `;
                    }
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[1, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $('#usuarios-inactivos').DataTable({
        "processing": true,
        "ajax": {
            "url": "/usuarios/inactivos/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                return json;
            },
        },
        "columns": [
            {"data": "username"},
            {"data": "name"},
            {"data": "email"},
            {"data": "id_carrera"},
            {"data": "id_tipo_usuario"},
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <div class="btn-group">
                            <a href="/usuarios/habilitar/${row['id']}" class="btn btn-success habilitar-usuario" data-toggle="tooltip" title="Deshabilitar">
                                <i class="fas fa-user-check"></i>
                            </a>
                        </div>
                    `;
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[1, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $('#lista-carga-academica').DataTable({
        "processing": true,
        "ajax": {
            "url": "/ca/lista",
            "contentType": "application/json",
            "type": "GET",
            "dataSrc": function (json) {
                return json;
            },
        },
        "columns": [
            {"data": "periodo"},
            {"data": "id_carrera"},
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <div class="btn-group">
                            <a href="/ca/info/${row['id']}" class="btn btn-info" data-toggle="tooltip" title="Ver">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="/carga-academica/editar/${row['id']}" class="btn btn-warning" data-toggle="tooltip" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/carga-academica/descargar/${row['id']}" class="btn btn-success btn-descargar" data-toggle="tooltip" target="_blank" title="Descargar">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    `;
                }
            },
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[0, "asc"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $(document).on('click', '#btn-acerca-de', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desarrollado por Grupo #2',
            html: `
                <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Cesar Alberto Banegas Sandoval
                        <span class="badge badge-primary badge-pill">31311851</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Angie Arely Flores Cruz
                        <span class="badge badge-primary badge-pill">41111178</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Leonardo de Jesus Fuentes Garcia
                        <span class="badge badge-primary badge-pill">41251074</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Jean Carlos Hernandez Muñoz
                        <span class="badge badge-primary badge-pill">41441163</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Yahaira Melissa Melendez Deraz
                        <span class="badge badge-primary badge-pill">41611072</span>
                      </li>
                </ul>
            `,
            icon: 'info',
            showCancelButton: false,
            showConfirmButton: false,
        });

    });

    $(document).on('submit', '#nuevo-flujograma', function (e) {
        e.preventDefault();
        const nombre_flujograma = $('#nombre_flujograma').val().trim();
        const codigo_clase = $('input[id^="codClase"]').serializeArray();
        const nombre_clase = $('input[id^="nombreClase"]').serializeArray();
        const estado_clase = $('.estado-clase').serializeArray();

        let codigo = [];
        let nombre = [];
        let estado = [];

        for (let i = 0; i < codigo_clase.length; i++) {
            codigo.push(codigo_clase[i].value);
        }
        for (let i = 0; i < nombre_clase.length; i++) {
            nombre.push(nombre_clase[i].value);
        }
        for (let i = 0; i < estado_clase.length; i++) {
            estado.push(estado_clase[i].value);
        }

        if (nombre_flujograma.length > 0) {
            $.ajax({
                url: '/flujogramas/existe',
                type: 'GET',
                data: {nombre_flujograma: nombre_flujograma},
                success: function (data) {
                    if (data['existe'] === 0) {
                        $.ajax({
                            url: '/flujogramas/guardar',
                            type: 'POST',
                            data: {nombre_flujograma: nombre_flujograma, codigo_clase: codigo, nombre_clase: nombre, estado: estado},
                            beforeSend: function () {
                                showNotification('Guardando flujograma, por favor espere...', 'info', 3000);
                                $('#btn-guardar-flujograma').addClass('disabled');
                                $('#btn-guardar-flujograma > span.guardar').addClass('d-none');
                                $('#btn-guardar-flujograma > span.cargando').removeClass('d-none');
                            },
                            success: function () {
                                document.getElementById('nuevo-flujograma').reset();
                                showNotification('Flujograma guardado correctamente', 'success');
                                $('#btn-guardar-flujograma').removeClass('disabled');
                                $('#btn-guardar-flujograma > span.guardar').removeClass('d-none');
                                $('#btn-guardar-flujograma > span.cargando').addClass('d-none');
                                $('.nfl-card').CardWidget('collapse');
                            },
                            error: function () {
                                showNotification('No se pudo guardar el flujograma', 'error');
                                $('#btn-guardar-flujograma').removeClass('disabled');
                                $('#btn-guardar-flujograma > span.guardar').removeClass('d-none');
                                $('#btn-guardar-flujograma > span.cargando').addClass('d-none');
                            }
                        });
                    } else {
                        showNotification('Ya existe un flujograma con ese nombre', 'warning');
                    }
                }
            });
        } else {
            showNotification('Escribe un nombre para el flujograma', 'warning');
        }
    });

    $(document).on('submit', '#editar-flujograma', function (e) {
        e.preventDefault();
        let url = $('#editar-flujograma').attr('action');
        const id_flujograma = $('#id-flujograma').val();
        const nombre_flujograma = $('#nombre_flujograma').val().trim();
        const codigo_clase = $('input[id^="codClase"]').serializeArray();
        const nombre_clase = $('input[id^="nombreClase"]').serializeArray();
        const estado_clase = $('.estado-clase').serializeArray();
        const detalle_flujograma = $('.detalle-flujorama').serializeArray();

        let codigo = [];
        let nombre = [];
        let estado = [];
        let detalle = [];

        for (let i = 0; i < codigo_clase.length; i++) {
            codigo.push(codigo_clase[i].value);
        }
        for (let i = 0; i < nombre_clase.length; i++) {
            nombre.push(nombre_clase[i].value);
        }
        for (let i = 0; i < estado_clase.length; i++) {
            estado.push(estado_clase[i].value);
        }
        for (let i = 0; i < detalle_flujograma.length; i++) {
            detalle.push(detalle_flujograma[i].value);
        }

        console.log(nombre_flujograma);
        console.log(codigo);
        console.log(nombre);
        console.log(estado);
        console.log(detalle);

        if (nombre_flujograma.length > 0) {
            $.ajax({
                url: '/flujogramas/existe-editar/' + id_flujograma,
                type: 'GET',
                data: {nombre_flujograma: nombre_flujograma},
                success: function (data) {
                    if (data['existe'] === 0) {
                        $.ajax({
                            url: url,
                            type: 'GET',
                            data: {nombre_flujograma: nombre_flujograma, id_detalle: detalle, codigo_clase: codigo, nombre_clase: nombre, estado: estado},
                            beforeSend: function () {
                                showNotification('Modificando flujograma, por favor espere...', 'info', 2000);
                                $('#btn-editar-flujograma').addClass('disabled');
                                $('#btn-editar-flujograma > span.guardar').addClass('d-none');
                                $('#btn-editar-flujograma > span.cargando').removeClass('d-none');
                            },
                            success: function () {
                                showNotification('Flujograma modificado correctamente', 'success');
                                $('#btn-editar-flujograma').removeClass('disabled');
                                $('#btn-editar-flujograma > span.guardar').removeClass('d-none');
                                $('#btn-editar-flujograma > span.cargando').addClass('d-none');
                                // $('.efl-card').CardWidget('collapse');
                            },
                            error: function () {
                                showNotification('No se pudo modificar el flujograma', 'error');
                                $('#btn-editar-flujograma').removeClass('disabled');
                                $('#btn-editar-flujograma > span.guardar').removeClass('d-none');
                                $('#btn-editar-flujograma > span.cargando').addClass('d-none');
                            }
                        });
                    } else {
                        showNotification('Ya existe un flujograma con ese nombre', 'warning');
                    }
                }
            });
        } else {
            showNotification('Escribe un nombre para el flujograma', 'warning');
        }
    });

    $('#form-agregar-docente').submit(function (e) {
        e.preventDefault(); // Evita que se recargue lapágina

        let codigo = $('input[name="codigo_docente"]').val(); // Obtiene el codigo
        let nombre = $('input[name="nombre"]').val(); // Obtiene el nombre
        let idTipoDocente = $('select[name="id_tipo_docente"]').val(); // Obtiene el Tipo de Docente

        $.ajax({
            method: 'POST',
            url: '/docentes/agregar',
            data: {codigo_docente: codigo, nombre: nombre, id_tipo_docente: idTipoDocente},
            beforeSend: function () {
                $('#btn-guardar-docente').addClass('disabled');
                $('#btn-guardar-docente > span.guardar').addClass('d-none');
                $('#btn-guardar-docente > span.cargando').removeClass('d-none');
            },
            success: function () {
                document.getElementById('form-agregar-docente').reset();
                showNotification('Docente agregado correctamente', 'success');
                $('#btn-guardar-docente').removeClass('disabled');
                $('#btn-guardar-docente > span.guardar').removeClass('d-none');
                $('#btn-guardar-docente > span.cargando').addClass('d-none');
            },
            error: function () {
                showNotification('No se pudo agregar el docente', 'error');
                $('#btn-guardar-docente').removeClass('disabled');
                $('#btn-guardar-docente > span.guardar').removeClass('d-none');
                $('#btn-guardar-docente > span.cargando').addClass('d-none');
            }
        });
    });


    $('#form-editar-docente').submit(function (e) {
        e.preventDefault(); // Evita que se recargue lapágina

        let codigo = $('input[name="codigo_docente"]').val(); // Obtiene el codigo
        let nombre = $('input[name="nombre"]').val(); // Obtiene el nombre
        let idTipoDocente = $('select[name="id_tipo_docente"]').val(); // Obtiene el Tipo de Docente

        let action = document.getElementById('form-editar-docente').action;

        $.ajax({
            method: 'GET',
            url: action,
            data: {codigo_docente: codigo, nombre: nombre, id_tipo_docente: idTipoDocente},
            beforeSend: function () {
                $('#btn-editar-docente').addClass('disabled');
                $('#btn-editar-docente > span.guardar').addClass('d-none');
                $('#btn-editar-docente > span.cargando').removeClass('d-none');
            },
            success: function () {
                // window.location.replace('/docentes/activos');
                showNotification('Docente modificado correctamente', 'success');
                $('#btn-editar-docente').removeClass('disabled');
                $('#btn-editar-docente > span.guardar').removeClass('d-none');
                $('#btn-editar-docente > span.cargando').addClass('d-none');
            },
            error: function () {
                showNotification('No se pudo modificar el docente', 'error');
                $('#btn-editar-docente').removeClass('disabled');
                $('#btn-editar-docente > span.guardar').removeClass('d-none');
                $('#btn-editar-docente > span.cargando').addClass('d-none');
            }
        });
    });

    $('#form-agregar-alumno').submit(function (e) {
        e.preventDefault(); // Evita que se recargue lapágina

        let numero_cuenta = $('input[name="numero_cuenta"]').val(); // Obtiene el numero de cuenta
        let nombre = $('input[name="nombre"]').val(); // Obtiene el nombre
        let telefono = $('input[name="telefono"]').val();
        let idCarrera = $('select[name="id_carrera"]').val(); // Obtiene el id de la Carrera
        let idFlujograma = $('select[name="id_flujograma"]').val(); // Obtiene el id del Flujograma

        $.ajax({
            url: '/alumnos/check-nc/' + numero_cuenta,
            method: 'GET',
            success: function(json){
                let exists = json['success'];
                if(!exists) {
                    $.ajax({
                        method: 'POST',
                        url: '/alumnos/agregar',
                        data: {numero_cuenta: numero_cuenta, nombre: nombre, telefono: telefono, id_carrera: idCarrera, id_flujograma: idFlujograma},
                        beforeSend: function () {
                            $('#btn-guardar-alumno').addClass('disabled');
                            $('#btn-guardar-alumno > span.guardar').addClass('d-none');
                            $('#btn-guardar-alumno > span.cargando').removeClass('d-none');
                        },
                        success: function () {
                            document.getElementById('form-agregar-alumno').reset();
                            showNotification('Alumno agregado correctamente', 'success');
                            $('#btn-guardar-alumno').removeClass('disabled');
                            $('#btn-guardar-alumno > span.guardar').removeClass('d-none');
                            $('#btn-guardar-alumno > span.cargando').addClass('d-none');
                        },
                        error: function () {
                            showNotification('No se pudo agregar el alumno', 'error');
                            $('#btn-guardar-alumno').removeClass('disabled');
                            $('#btn-guardar-alumno > span.guardar').removeClass('d-none');
                            $('#btn-guardar-alumno > span.cargando').addClass('d-none');
                        }
                    });
                } else {
                    showNotification('Ya existe un alumno con ese numero de cuenta', 'warning');
                }
            },
            error: function() {
                showNotification('Ocurrió un error', 'error');
            }
        });
    });

    $('#form-editar-alumno').submit(function (e) {
        e.preventDefault(); // Evita que se recargue la página

        let id_alumno = $('input[name="id_alumno"]').val();
        let numero_cuenta = $('input[name="numero_cuenta"]').val(); // Obtiene el numero de cuenta
        let nombre = $('input[name="nombre"]').val(); // Obtiene el nombre
        let telefono = $('input[name="telefono"]').val();
        let idCarrera = $('select[name="id_carrera"]').val(); // Obtiene el id de la Carrera
        let idFlujograma = $('select[name="id_flujograma"]').val(); // Obtiene el id del Flujograma

        let action = document.getElementById('form-editar-alumno').action;

        $.ajax({
            url: '/alumnos/check-nce/' + id_alumno + '/' + numero_cuenta,
            method: 'GET',
            success: function(json) {
                let exists = json['success'];
                if(!exists) {
                    $.ajax({
                        method: 'GET',
                        url: action,
                        data: {numero_cuenta: numero_cuenta, nombre: nombre, telefono: telefono, id_carrera: idCarrera, id_flujograma: idFlujograma},
                        beforeSend: function () {
                            $('#btn-editar-alumno').addClass('disabled');
                            $('#btn-editar-alumno > span.guardar').addClass('d-none');
                            $('#btn-editar-alumno > span.cargando').removeClass('d-none');
                        },
                        success: function () {
                            // document.getElementById('form-editar-alumno').reset();
                            showNotification('Alumno modificado correctamente', 'success');
                            $('#btn-editar-alumno').removeClass('disabled');
                            $('#btn-editar-alumno > span.guardar').removeClass('d-none');
                            $('#btn-editar-alumno > span.cargando').addClass('d-none');
                        },
                        error: function () {
                            showNotification('No se pudo modificar el alumno', 'error');
                            $('#btn-editar-alumno').removeClass('disabled');
                            $('#btn-editar-alumno > span.guardar').removeClass('d-none');
                            $('#btn-editar-alumno > span.cargando').addClass('d-none');
                        }
                    });
                } else {
                    showNotification('Ya existe un alumno con ese numero de cuenta', 'warning');
                }
            },
            error: function() {
                showNotification('Ocurrió un error', 'error');
            }
        });
    });

    $('#form-agregar-usuario').submit(function (e) {
        e.preventDefault(); // Evita que se recargue lapágina

        let username = $('input[name="username"]').val(); // Obtiene el numero de cuenta
        let name = $('input[name="name"]').val(); // Obtiene el nombre
        let email = $('input[name="email"]').val(); // Obtiene el email
        let idCarrera = $('select[name="id_carrera"]').val(); // Obtiene el id de la carrera
        let idTipoUsuario = $('select[name="id_tipo_usuario"]').val(); // Obtiene el id del tipo de usuario
        // let password = $('input[name="password"]').val(); // Obtiene la contraseña

        $.ajax({
            url: '/usuarios/check-username/'+ username,
            method: 'GET',
            success: function(json) {
                let exists = json['success'];
                if(!exists) {
                    $.ajax({
                        method: 'POST',
                        url: '/usuarios/agregar',
                        data: {username: username, name: name, email: email, id_carrera: idCarrera, id_tipo_usuario: idTipoUsuario},
                        beforeSend: function () {
                            $('#btn-guardar-usuario').addClass('disabled');
                            $('#btn-guardar-usuario > span.guardar').addClass('d-none');
                            $('#btn-guardar-usuario > span.cargando').removeClass('d-none');
                        },
                        success: function () {
                            document.getElementById('form-agregar-usuario').reset();
                            showNotification('Usuario agregado correctamente', 'success');
                            $('#btn-guardar-usuario').removeClass('disabled');
                            $('#btn-guardar-usuario > span.guardar').removeClass('d-none');
                            $('#btn-guardar-usuario > span.cargando').addClass('d-none');
                        },
                        error: function () {
                            showNotification('No se pudo agregar el usuario', 'error');
                            $('#btn-guardar-usuario').removeClass('disabled');
                            $('#btn-guardar-usuario > span.guardar').removeClass('d-none');
                            $('#btn-guardar-usuario > span.cargando').addClass('d-none');
                        }
                    });
                } else {
                    showNotification('Ya existe un usuario con ese número de cuenta', 'warning');
                }
            },
            error: function() {
                showNotification('Ocurrió un error', 'error');
            }
        });
    });

    $(document).on('submit', '#alumno-flujograma', function (e) {
        e.preventDefault();

        let action = document.getElementById('alumno-flujograma').action;
        let cls = $('input[id^="estadoPlan"]').serializeArray();
        let clases = [];

        for (let i = 0; i < cls.length; i++) {
            clases.push(cls[i].value);
        }

        $.ajax({
            url: action,
            type: 'GET',
            data: {clases: clases},
            beforeSend: function () {
                showNotification('Guardando flujograma, por favor espere...', 'info', 3000);
                $('.btn-modificar-alumno-flujograma').addClass('disabled');
                $('.btn-modificar-alumno-flujograma > span.guardar').addClass('d-none');
                $('.btn-modificar-alumno-flujograma > span.cargando').removeClass('d-none');
            },
            success: function () {
                showNotification('Flujograma guardado correctamente', 'success');
                $('.btn-modificar-alumno-flujograma').removeClass('disabled');
                $('.btn-modificar-alumno-flujograma > span.guardar').removeClass('d-none');
                $('.btn-modificar-alumno-flujograma > span.cargando').addClass('d-none');
            },
            error: function () {
                showNotification('No se pudo guardar el flujograma', 'error');
                $('.btn-modificar-alumno-flujograma').removeClass('disabled');
                $('.btn-modificar-alumno-flujograma > span.guardar').removeClass('d-none');
                $('.btn-modificar-alumno-flujograma > span.cargando').addClass('d-none');
            }
        });
    });

    $('#form-editar-usuario').submit(function (e) {
        e.preventDefault(); // Evita que se recargue la página

        let idUsuario = $('input[name="id_usuario"]').val();
        let cuenta = $('input[name="username"]').val(); // Obtiene el Numero de Cuenta
        let nombre = $('input[name="name"]').val(); // Obtiene el Nombre
        let email = $('input[name="email"]').val(); // Obtiene el Email
        let carrera = $('select[name="id_carrera"]').val(); // Obtiene la Carrera
        let tipoUsuario = $('select[name="id_tipo_usuario"]').val(); // Obtiene el Tipo de Docente

        let action = document.getElementById('form-editar-usuario').action;

        $.ajax({
            url: '/usuarios/check-username/' + idUsuario + '/' + cuenta,
            method: 'GET',
            success: function(json) {
                let exists = json['success'];
                if(!exists) {
                    $.ajax({
                        method: 'GET',
                        url: action,
                        data: {username: cuenta, name: nombre, email: email, carrera: carrera, tipo_usuario: tipoUsuario},
                        beforeSend: function () {
                            $('#btn-editar-usuario').addClass('disabled');
                            $('#btn-editar-usuario > span.guardar').addClass('d-none');
                            $('#btn-editar-usuario > span.cargando').removeClass('d-none');
                        },
                        success: function () {
                            // window.location.replace('/docentes/activos');
                            showNotification('Usuario modificado correctamente', 'success');
                            $('#btn-editar-usuario').removeClass('disabled');
                            $('#btn-editar-usuario > span.guardar').removeClass('d-none');
                            $('#btn-editar-usuario > span.cargando').addClass('d-none');
                        },
                        error: function () {
                            showNotification('No se pudo modificar el usuario', 'error');
                            $('#btn-editar-usuario').removeClass('disabled');
                            $('#btn-editar-usuario > span.guardar').removeClass('d-none');
                            $('#btn-editar-usuario > span.cargando').addClass('d-none');
                        }
                    });
                } else {
                    showNotification('Ya existe un usuario con ese número de cuenta', 'warning');
                }
            },
            error: function() {
                showNotification('Ocurrió un error', 'error');
            }
        });
    });

    $('#form-modificar-perfil').submit(function (e) {
        e.preventDefault(); // Evita que se recargue la página

        // let cuenta = $('input[name="username"]').val(); // Obtiene el Numero de Cuenta
        let nombre = $('input[name="name"]').val(); // Obtiene el Nombre
        let email = $('input[name="email"]').val(); // Obtiene el Email
        let password = $('input[name="password"]').val(); // Obtiene la contraseña

        const action = document.getElementById('form-modificar-perfil').action;


        $.ajax({
            method: 'POST',
            url: action,
            data: {name: nombre, email: email, password: password},
            beforeSend: function () {
                $('#btn-modificar-perfil').addClass('disabled');
                $('#btn-modificar-perfil > span.guardar').addClass('d-none');
                $('#btn-modificar-perfil > span.cargando').removeClass('d-none');
            },
            success: function () {
                showNotification('Datos modificados correctamente', 'success');
                $('#btn-modificar-perfil').removeClass('disabled');
                $('#btn-modificar-perfil > span.guardar').removeClass('d-none');
                $('#btn-modificar-perfil > span.cargando').addClass('d-none');
            },
            error: function () {
                showNotification('No se pudieron modificar los datos', 'error');
                $('#btn-modificar-perfil').removeClass('disabled');
                $('#btn-modificar-perfil > span.guardar').removeClass('d-none');
                $('#btn-modificar-perfil > span.cargando').addClass('d-none');
            }
        });
    });

    $(document).on('click', '.reiniciar-pass', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: '¿Reiniciar Contraseña?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                let password =  Math.random().toString(36).substring(2, 7) + Math.random().toString(36).substring(2, 7);
               $.ajax({
                   method: 'GET',
                   url: url,
                   data: {pass: password},
                   success: function() {
                    Swal.fire({
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        title: 'Nueva Contraseña',
                        text: password,
                    }).then((result) => {
                        if(result.value)
                        {
                            showNotification('Contraseña reiniciada correctamente', 'success');
                        }
                    });
                   },
                   error: function()
                   {
                       showNotification('No se pudo reiniciar la contraseña', 'error');
                   }
               });
            }
        });
    });

    $(document).on('click', '.cantidad-clases', async function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const idUsuario = jQuery(this).children('input').val();
        $.ajax({
            url: '/usuarios/check-cc/' + idUsuario,
            method: 'GET',
            success: async function(data) {
                const { value: cantidad } = await Swal.fire({
                    title: 'Ingrese la cantidad de clases',
                    input: 'text',
                    inputValue: data['cantidad'],
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Debes ingresar la cantidad de clases';
                        } else if(!$.isNumeric(value)) {
                            return 'Debes ingresar solo números';
                        }
                    }
                });
                if (cantidad) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {cantidad: cantidad},
                        success: function() {
                            showNotification('Cantidad de clases asignada correctamente', 'success');
                        },
                        error: function() {
                            showNotification('No se pudo asignar la cantidad de clases', 'error');
                        }
                    });
                }
            },
            error: function() {

            }
        });
    });

    // Ventana de confirmación para cerrar sesión
    $('#btn-logout').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Cerrar Sesión?',
            icon: 'question',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                //logout
                document.getElementById('logout-form').submit();
            }
        });
    });

    // Confirmación para deshabilitar docente
    $(document).on('click', '.deshabilitar-docente', function (e) {
        e.preventDefault();
        let disableButton = $(this);
        let url = disableButton.attr('href');
        let table = $('#docentes-activos').DataTable();
        Swal.fire({
            title: '¿Deshabilitar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                    success: function () {
                        table.ajax.reload();
                        showNotification('Docente deshabilitado correctamente', 'success');
                    },
                    error: function () {
                        showNotification('No se pudo deshabilitar', 'error');
                    }
                });
            }
        });
    });

    // Confirmación para habilitar docente
    $(document).on('click', '.habilitar-docente', function (e) {
        e.preventDefault();
        let enableButton = $(this);
        let url = enableButton.attr('href');
        let table = $('#docentes-inactivos').DataTable();
        Swal.fire({
            title: '¿Habilitar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                    success: function () {
                        table.ajax.reload();
                        showNotification('Docente habilitado correctamente', 'success');
                    },
                    error: function () {
                        showNotification('No se pudo habilitar', 'error');
                    }
                });
            }
        });
    });

    // Confirmación para deshabilitar docente
    $(document).on('click', '.deshabilitar-alumno', function (e) {
        e.preventDefault();
        let disableButton = $(this);
        let url = disableButton.attr('href');
        let table = $('#alumnos-activos').DataTable();
        Swal.fire({
            title: '¿Deshabilitar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                    success: function () {
                        table.ajax.reload();
                        showNotification('Alumno deshabilitado correctamente', 'success');
                    },
                    error: function () {
                        showNotification('No se pudo deshabilitar', 'error');
                    }
                });
            }
        });
    });

    // Confirmación para habilitar docente
    $(document).on('click', '.habilitar-alumno', function (e) {
        e.preventDefault();
        let enableButton = $(this);
        let url = enableButton.attr('href');
        let table = $('#alumnos-inactivos').DataTable();
        Swal.fire({
            title: '¿Habilitar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                    success: function () {
                        table.ajax.reload();
                        showNotification('Alumno habilitado correctamente', 'success');
                    },
                    error: function () {
                        showNotification('No se pudo habilitar', 'error');
                    }
                });
            }
        });
    });

    // Confirmación para deshabilitar docente
    $(document).on('click', '.deshabilitar-usuario', function (e) {
        e.preventDefault();
        let disableButton = $(this);
        let url = disableButton.attr('href');
        let table = $('#usuarios-activos').DataTable();
        Swal.fire({
            title: '¿Deshabilitar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                    success: function () {
                        table.ajax.reload();
                        showNotification('Usuario deshabilitado correctamente', 'success');
                    },
                    error: function () {
                        showNotification('No se pudo deshabilitar', 'error');
                    }
                });
            }
        });
    });

    // Confirmación para habilitar docente
    $(document).on('click', '.habilitar-usuario', function (e) {
        e.preventDefault();
        let enableButton = $(this);
        let url = enableButton.attr('href');
        let table = $('#usuarios-inactivos').DataTable();
        Swal.fire({
            title: '¿Habilitar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                    success: function () {
                        table.ajax.reload();
                        showNotification('Usuario habilitado correctamente', 'success');
                    },
                    error: function () {
                        showNotification('No se pudo habilitar', 'error');
                    }
                });
            }
        });
    });


    // Pruebas para el flujograma
    $('.card-test').click(function (e) {
        e.preventDefault();
        let el = $(this).children('.card');
        el.removeClass('bg-warning');
        el.toggleClass('bg-success');
    });

    $('.f-card').click(function (e) {
        let el = $(this);
        let inputData = jQuery(this).children('input');
        if (el.hasClass('bg-warning')) {
            el.removeClass('bg-warning');
            el.addClass('bg-success');
            inputData.attr('value', '2');
            return;
        }
        if (el.hasClass('bg-success')) {
            el.removeClass('bg-success');
            inputData.attr('value', '0');
            return;
        }
        el.addClass('bg-warning');
        inputData.attr('value', '1');
    });

    nflCard.on('expanded.lte.cardwidget', function () {
        const estadoFlujograma = $(this).children('div .card-body').children('input');
        estadoFlujograma.attr('value', '1');
        $(this).addClass('card-primary');
        $(this).removeClass('card-danger');
    });

    nflCard.on('collapsed.lte.cardwidget', function () {
        const estadoFlujograma = $(this).children('div .card-body').children('input');
        estadoFlujograma.attr('value', '0');
        $(this).addClass('card-danger');
        $(this).removeClass('card-primary');
    });

    eflCard.on('expanded.lte.cardwidget', function () {
        const estadoFlujograma = $(this).children('div .card-body').children('.estado-clase');
        estadoFlujograma.attr('value', '1');
        $(this).addClass('card-primary');
        $(this).removeClass('card-danger');
    });

    eflCard.on('collapsed.lte.cardwidget', function () {
        const estadoFlujograma = $(this).children('div .card-body').children('.estado-clase');
        const input = $(this).children('div .card-body').children('div .input-group').children('input');
        input.val('');
        estadoFlujograma.attr('value', '0');
        $(this).addClass('card-danger');
        $(this).removeClass('card-primary');
    });

    $('#carrera_nuevo').change(function() {
        const carrera = $(this).val();
        let planEdtudio = $('#id_flujograma_nuevo');

        $.ajax({
            url: '/flujogramas/lista/' + carrera,
            type: 'GET',
            success: function(data) {
                planEdtudio.children().remove();
                if(data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let opt = document.createElement('option');
                        opt.value = data[i]['id'];
                        opt.innerHTML = data[i]['nombre'];
                        planEdtudio.append(opt);
                    }
                } else {
                    let opt = document.createElement('option');
                    opt.setAttribute('disabled', '');
                    opt.setAttribute('hidden', '');
                    opt.setAttribute('selected', '');
                    opt.value = '';
                    opt.innerHTML = 'Seleccionar...';
                    planEdtudio.append(opt);
                    planEdtudio.selectedIndex = 0;
                }
            }
        });
    });

    $('#carrera_editar').change(function() {
        const carrera = $(this).val();
        let planEdtudio = $('#id_flujograma_editar');

        $.ajax({
            url: '/flujogramas/lista/' + carrera,
            type: 'GET',
            success: function(data) {
                planEdtudio.children().remove();
                if(data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let opt = document.createElement('option');
                        opt.value = data[i]['id'];
                        opt.innerHTML = data[i]['nombre'];
                        planEdtudio.append(opt);
                    }
                } else {
                    let opt = document.createElement('option');
                    opt.setAttribute('disabled', '');
                    opt.setAttribute('hidden', '');
                    opt.setAttribute('selected', '');
                    opt.value = '';
                    opt.innerHTML = 'Seleccionar...';
                    planEdtudio.append(opt);
                    planEdtudio.selectedIndex = 0;
                }
            }
        });
    });

    $('#plan-estudio').change(function () {
        let planEstudio = $(this).val();
        let clases = $('#clases');

        $.ajax({
            type: 'GET',
            url: '/flujograma/' + planEstudio + '/clases',
            dataType: 'json',
            success: function (data) {
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let opt = document.createElement('option');
                        opt.value = data[i]['id'];
                        opt.innerHTML = data[i]['clase'];
                        clases.append(opt);
                    }
                    clases.attr('disabled', false);
                    // $('#btn-agregar-clase').removeClass('disabled');
                } else {
                    clases.attr('disabled', true);
                    // $('#btn-agregar-clase').addClass('disabled');
                    clases.children().remove();
                    let opt = document.createElement('option');
                    opt.innerHTML = 'Seleccionar...';
                    clases.append(opt);
                    clases.selectedIndex = 0;
                }
            },
            error: function () {

            }
        });
    });

    $('#plan-estudio-editar').change(function () {
        let planEstudio = $(this).val();
        let clases = $('#clases-editar');

        $.ajax({
            type: 'GET',
            url: '/flujograma/' + planEstudio + '/clases',
            dataType: 'json',
            success: function (data) {
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let opt = document.createElement('option');
                        opt.value = data[i]['id'];
                        opt.innerHTML = data[i]['clase'];
                        clases.append(opt);
                    }
                    clases.attr('disabled', false);
                    $('#btn-agregar-clase').removeClass('disabled');
                } else {
                    clases.attr('disabled', true);
                    $('#btn-agregar-clase').addClass('disabled');
                    clases.children().remove();
                    let opt = document.createElement('option');
                    opt.innerHTML = 'Seleccionar...';
                    clases.append(opt);
                    clases.selectedIndex = 0;
                }
            },
            error: function () {

            }
        });
    });

    const t = $('#cargaacademica').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No se encontró nada",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    const tdca = $('#form-ca-editar').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No se encontró nada",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        }
    });

    $(document).on('submit', '#form-datos-carga', function(e) {
        e.preventDefault();

        const cargaAcademica = t.rows().data();
        let exists = 0;
        let count = 0;

        const claseVal = $('select[name="clases"] option:selected').val();
        const clase = $('select[name="clases"] option:selected').html();
        const hora = $('input[name="hora"]').val();
        const aula = $('input[name="aula"]').val();
        const docente = $('select[name="docente"] option:selected').html();
        const dia = $('input[name="dia"]').val();
        const obs = $('input[name="observaciones"]').val();

        $.ajax({
            url: '/ca/check-count',
            method: 'GET',
            success: function(json) {
                totalCountNuevo = JSON.parse(json['count']);
                count = JSON.parse(json['count']);
                count = count - cargaAcademica.length;

                if(count > 0) {
                    for(let i = 0; i < cargaAcademica.length; i++) {
                        if(aula === cargaAcademica[i][2]) {
                            if(hora === cargaAcademica[i][1] && dia === cargaAcademica[i][4]) {
                                exists++;
                            }
                        }
                    }

                    if(claseVal.length > 0) {
                        if(exists === 0) {
                            t.row.add([
                                clase,
                                hora,
                                aula,
                                docente,
                                dia,
                                obs,
                                `<div class="btn-group">
                                    <a href="#" class="btn btn-danger quitar-clase">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>`
                            ]).draw(false);
                            let c = cargaAcademica.length + 1;
                            cantidadClasesNuevo.html(c + ' de ' + totalCountNuevo);
                            $('#form-datos-carga').trigger('reset');
                        } else {
                            showNotification('Ya hay una clase en esa aula a la misma hora y día', 'warning');
                        }
                    }
                } else {
                    showNotification('Has llegado al límite de clases que puede agregar', 'info');
                }
            },
            error: function(){}
        });
    });


    $(document).on('submit', '#form-datos-carga-editar', function(e) {
        e.preventDefault();

        const cargaAcademica = tdca.rows().data();
        let exists = 0;
        let count = 0;

        const claseVal = $('select[name="clases"] option:selected').val();
        const clase = $('select[name="clases"] option:selected').html();
        const hora = $('input[name="hora"]').val();
        const aula = $('input[name="aula"]').val();
        const docente = $('select[name="docente"] option:selected').html();
        const dia = $('input[name="dia"]').val();
        const obs = $('input[name="observaciones"]').val();


        $.ajax({
            url: '/ca/check-count',
            method: 'GET',
            success: function(json) {
                totalCountEditar = JSON.parse(json['count']);
                count = JSON.parse(json['count']);
                count = count - cargaAcademica.length;


                if(count > 0) {
                    for(let i = 0; i < cargaAcademica.length; i++) {
                        if(aula === cargaAcademica[i][2]) {
                            if(hora === cargaAcademica[i][1] && dia === cargaAcademica[i][4]) {
                                exists++;
                            }
                        }
                    }

                    if(claseVal.length > 0) {
                        if(exists === 0) {
                            tdca.row.add([
                                clase,
                                hora,
                                aula,
                                docente,
                                dia,
                                obs,
                                `<div class="btn-group">
                                    <a href="#" class="btn btn-danger quitar-clase">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>`
                            ]).draw(false);
                            let c = cargaAcademica.length + 1;
                            cantidadClasesEditar.html(c + ' de ' + totalCountEditar);
                            $('#form-datos-carga-editar').trigger('reset');
                        } else {
                            showNotification('No se puede agregar la clase', 'warning');
                        }
                    }
                } else {
                    showNotification('Has llegado al límite de clases que puede agregar', 'info');
                }
            },
            error: function(){}
        });
    });

    $(document).on('click', '#btn-guardar-carga', function(e) {
        e.preventDefault();

        const cargaAcademica = t.rows().data();
        const nombre = $('input[name="nombre-carga"]').val();


        let carga = new Array();

        if((nombre.trim()).length > 0){
            if(cargaAcademica.length > 0) {
                for(let i = 0; i < cargaAcademica.length; i++) {
                    let data = new Object();
                    data.clase = cargaAcademica[i][0];
                    data.hora = cargaAcademica[i][1];
                    data.aula = cargaAcademica[i][2];
                    data.docente = cargaAcademica[i][3];
                    data.dia = cargaAcademica[i][4];
                    data.obs = cargaAcademica[i][5];
                    carga.push(data);
                }

                let finalData = JSON.stringify(carga);

                if(cargaAcademica.length > 0) {
                    $.ajax({
                        url: '/carga-academica/agregar',
                        method: "POST",
                        data: {nombre: nombre, carga: finalData},
                        success: function () {
                            t.clear().draw();
                            $('#nombre-carga').val('');
                            showNotification('Carga Académica guardada correctamente', 'success');
                        },
                        error: function () {
                            showNotification('No se pudo guardar', 'error');
                        }
                    });
                }
            } else {
                showNotification('Agrega clases antes de guardar', 'info');
            }
        } else {
            showNotification('Escribe un nombre', 'warning');
        }
    });

    $(document).on('click', '#btn-editar-carga', function(e) {
        e.preventDefault();

        const cargaAcademica = tdca.rows().data();
        const idCarga = $('input[name="id-carga"]').val();
        const nombre = $('input[name="nombre-carga"]').val();
        // let data = {clase, hora, aula, docente, dia, obs};

        let carga = new Array();

        if((nombre.trim()).length > 0){
            if(cargaAcademica.length > 0) {
                for(let i = 0; i < cargaAcademica.length; i++) {
                    let data = new Object();
                    data.clase = cargaAcademica[i][0];
                    data.hora = cargaAcademica[i][1];
                    data.aula = cargaAcademica[i][2];
                    data.docente = cargaAcademica[i][3];
                    data.dia = cargaAcademica[i][4];
                    data.obs = cargaAcademica[i][5];
                    carga.push(data);
                }

                let finalData = JSON.stringify(carga);

                if(cargaAcademica.length > 0) {
                    $.ajax({
                        url: '/carga-academica/actualizar/' + idCarga,
                        method: "GET",
                        data: {nombre: nombre, carga: finalData},
                        success: function () {
                            showNotification('Carga Académica modificada correctamente', 'success');
                        },
                        error: function () {
                            showNotification('No se pudo modificar', 'error');
                        }
                    });
                }
            } else {
                showNotification('Agrega clases antes de guardar', 'info');
            }
        } else {
            showNotification('Escribe un nombre', 'warning');
        }
    });

    $(document).on('click', '.quitar-clase', function(e) {
        e.preventDefault();
        t.row($(this).parents('tr')).remove().draw();
        $.ajax({
            url: '/ca/check-count',
            method: 'GET',
            success: function(json) {
                totalCountNuevo = JSON.parse(json['count']);
                let c = t.rows().count();
                cantidadClasesNuevo.html(c + ' de ' + totalCountNuevo);
            }
        });
    });

    $(document).on('click', '.quitar-ca-editar', function(e) {
        e.preventDefault();
        tdca.row($(this).parents('tr')).remove().draw();
        $.ajax({
            url: '/ca/check-count',
            method: 'GET',
            success: function(json) {
                totalCountEditar = JSON.parse(json['count']);
                let c = tdca.rows().count();
                cantidadClasesEditar.html(c + ' de ' + totalCountEditar);
            }
        });
    });

    $(document).on('click', '#btn-recargar-docentes-activos', function (e) {
        e.preventDefault();
        const table = $('#docentes-activos').DataTable();
        table.ajax.reload();
    });

    $(document).on('click', '#btn-recargar-docentes-inactivos', function (e) {
        e.preventDefault();
        const table = $('#docentes-inactivos').DataTable();
        table.ajax.reload();
    });

    $(document).on('click', '#btn-recargar-alumnos-activos', function (e) {
        e.preventDefault();
        const table = $('#alumnos-activos').DataTable();
        table.ajax.reload();
    });

    $(document).on('click', '#btn-recargar-alumnos-inactivos', function (e) {
        e.preventDefault();
        const table = $('#alumnos-inactivos').DataTable();
        table.ajax.reload();
    });

    $(document).on('click', '#btn-recargar-usuarios-activos', function (e) {
        e.preventDefault();
        const table = $('#usuarios-activos').DataTable();
        table.ajax.reload();
    });

    $(document).on('click', '#btn-recargar-usuarios-inactivos', function (e) {
        e.preventDefault();
        const table = $('#usuarios-inactivos').DataTable();
        table.ajax.reload();
    });

    $(document).on('click', '#btn-recargar-carga-academica', function (e) {
        e.preventDefault();
        const table = $('#lista-carga-academica').DataTable();
        table.ajax.reload();
    });

    $(document).on('keypress', '#numero-cuenta', function (e) {
        if (e.which !== 8 && e.which !== 0 && e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    $(document).on('keypress', '#username', function (e) {
        if (e.which !== 8 && e.which !== 0 && e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    $(document).on('keypress', '#dia', function (e) {
        if (e.which !== 8 && e.which !== 0 && e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    $(document).on('keydown', '#nombre-alumno', function (e) {
        // const key = e.keyCode;
        // if (!((key === 8) || (key === 32) || (key === 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
        //     e.preventDefault();
        // }
    });
});
