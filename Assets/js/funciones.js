let tblCriterio, tblReportes, tblPreguntas, tblFormulario, tblEstablecimiento, tblRepresentante, tblUsuarios, tblRol, tblProceso, tblGestion, tblCategoria, tblLibros, tblPrestar;
document.addEventListener("DOMContentLoaded", function () {
    const language = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

    }
    const buttons = [{
        //Botón para Excel
        extend: 'excel',
        footer: true,
        title: 'DIAGNOSTICO GESTION DE CALIDAD_ TURISMO COMUNITARIO  ',
        filename: 'Export_File',

        //Aquí es donde generas el botón personalizado
        text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i>Descargar Excel</button>'
    },
    //Botón para PDF
    {
        extend: 'pdf',
        footer: true,
        title: 'DIAGNOSTICO GESTION DE CALIDAD_ TURISMO COMUNITARIO',
        filename: 'reporte',
        text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Descargar PDF</button>'
    },
    //Botón para print
    {
        extend: 'print',
        footer: true,
        title: 'DIAGNOSTICO GESTION DE CALIDAD_ TURISMO COMUNITARIO',
        subtitle: 'DIAGNOSTICO DE EVALUACION SISTEMA DE GESTION DE CALIDAD BASADO ISO 9001-2015',
        filename: 'Export_File_print',
        text: '<button class="btn btn-info"><i class="fa fa-print"></i>Imprimir</button>'
    }
    ]
    //Tabla fomrulario

    tblFormulario = $('#tblFormulario').DataTable({
        ajax: {
            url: base_url + "Formulario/listar",
            dataSrc: ''
        },
        columns: [
            { 'data': 'id_formulario' },
            { 'data': 'nombre_formulario' },
            { 'data': 'descripcion_formulario' },
            { 'data': 'estado_formulario' },
            { 'data': 'acciones' }
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin tabla fomrulario

    //Tabla Reporte
    tblReportes = $('#tblReportes').DataTable({
        responsive: true,
        bDestroy: true,
        iDisplayLength: 50,
        order: [
            [0, "asc"]
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>",
        buttons
    });

    //Fin tabla fomrulario
    //******************Tabla Representante********************
    tblRepresentante = $('#tblRepresentante').DataTable({
        ajax: {
            url: base_url + "Representante/listar",
            dataSrc: ''
        },
        columns: [
            { 'data': 'id_representante' },
            { 'data': 'nombre_representante' },
            { 'data': 'apellido_representante' },
            { 'data': 'cedula_representante' },
            { 'data': 'correo_representante' },
            { 'data': 'telefono_representante' },
            { 'data': 'direccion_representante' },
            { 'data': 'id_usuario' },
            { 'data': 'estado_representante' },
            { 'data': 'acciones' }
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla representante
    //******************Tabla Establecimiento********************
    tblEstablecimiento = $('#tblEstablecimiento').DataTable({
        ajax: {
            url: base_url + "Establecimiento/listar",
            dataSrc: ''
        },
        columns: [
            { 'data': 'id_establecimiento' },
            { 'data': 'nombre_establecimiento' },
            { 'data': 'direccion_establecimiento' },
            { 'data': 'id_representante' },
            { 'data': 'estado_establecimiento' },
            { 'data': 'acciones' }
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla representante

    //******************Tabla Usuario********************
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            { 'data': 'id_usuario' },
            { 'data': 'nombre_usuario' },
            { 'data': 'apellido_usuario' },
            { 'data': 'correo_usuario' },
            { 'data': 'nombre_rol' },
            { 'data': 'usuario_usuario' },
            { 'data': 'estado_usuario' },
            { 'data': 'acciones' }
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });

    //Fin de la tabla usuarios


    //Tabla Categoria
    tblCategoria = $('#tblCategoria').DataTable({
        ajax: {
            url: base_url + "Categoria/listar",
            dataSrc: ''

        },

        columns: [{
            'data': 'id_categoria'
        },
        {
            'data': 'nombre_categoria'
        },
        {
            'data': 'estado_categoria'
        },
        {
            'data': 'acciones'
        }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla Categorias
    //Tabla Criterio
    tblCriterio = $('#tblCriterio').DataTable({
        ajax: {
            url: base_url + "Criterio/listar",
            dataSrc: ''

        },

        columns: [{
            'data': 'valor_criterio'
        },
        {
            'data': 'identificacion_criterio'
        },
        {
            'data': 'fase_criterio'
        },
        {
            'data': 'nombre_criterio'
        },
        {
            'data': 'estado_criterio'
        },
        {
            'data': 'acciones'
        }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla Categorias
    //Tabla Rol
    tblRol = $('#tblRol').DataTable({

        ajax: {
            url: base_url + "Rol/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id_rol'
        },
        {
            'data': 'nombre_rol'
        },
        {
            'data': 'estado_rol'
        },
        {
            'data': 'acciones'
        }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla Procesos

    //Tabla Proceso
    tblProceso = $('#tblProceso').DataTable({

        ajax: {
            url: base_url + "Proceso/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id_proceso'
        },
        {
            'data': 'nombre_proceso'
        },
        {
            'data': 'estado_proceso'
        },
        {
            'data': 'acciones'
        }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla Procesos

    //Tabla Gestion
    tblGestion = $('#tblGestion').DataTable({
        ajax: {
            url: base_url + "Gestion/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id_gestion'
        },
        {
            'data': 'nombre_gestion'
        },
        {
            'data': 'nombre_proceso'
        },
        {
            'data': 'estado_gestion'
        },
        {
            'data': 'acciones'
        }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla Gestion

    $('.nombre_gestion').select2({
        placeholder: 'Buscar Categoria',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Categoria/buscarCategoria',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.nombre_proceso').select2({
        placeholder: 'Buscar Proceso',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Proceso/buscarProceso',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

})

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}

// **********************Usuarios*********************************
function frmUsuario() {
    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    const urls = base_url + "Rol/obtener";
    const http = new XMLHttpRequest();
    http.open("GET", urls, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = "";
            let filas = '';
            for (const child of res) {
                filas += '<option id="id_rol" value="' + child.id_rol + '">' + child.nombre_rol + '</option>';
            }
            $('#id_rol').html(filas);
            $("#nuevo_usuario").modal("show");

        }
    }
}
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    if (usuario.value == "" || nombre.value == "") {
        alertas('Todo los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                frm.reset();
                tblUsuarios.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
function btnEditarUser(id) {
    frmUsuario();
    document.getElementById("title").textContent = "Actualizar usuario";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id_usuario;
            document.getElementById("nombre").value = res.nombre_usuario;
            document.getElementById("apellido").value = res.apellido_usuario;
            document.getElementById("correo").value = res.correo_usuario;
            document.getElementById("id_rol").value = res.id_rol;
            document.getElementById("usuario").value = res.usuario_usuario;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
}
function btnEliminarUser(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
function btnReingresarUser(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Usuarios
// **********************Representante*********************************
function frmRepresentante() {
    document.getElementById("title").textContent = "Nuevo Representante";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmRepresentante").reset();
    const urls = base_url + "Usuarios/obtener";
    const http = new XMLHttpRequest();
    http.open("GET", urls, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let filas = '';
            for (const child of res) {
                filas += '<option id="id_usuario" value="' + child.id_usuario + '">' + child.nombre_usuario + '</option>';
            }
            $('#id_usuario').html(filas);
            $("#nuevo_representante").modal("show");
        }
    }
}
function registrarRepresentante(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    if (apellido.value == "" || nombre.value == "") {
        alertas('Todo los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Representante/registrar";
        const frm = document.getElementById("frmRepresentante");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_representante").modal("hide");
                frm.reset();
                tblRepresentante.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
function btnEditarRepresentante(id) {
    frmRepresentante();
    document.getElementById("title").textContent = "Actualizar Representante";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Representante/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id_representante;
            document.getElementById("nombre").value = res.nombre_representante;
            document.getElementById("apellido").value = res.apellido_representante;
            document.getElementById("cedula").value = res.cedula_representante;
            document.getElementById("correo").value = res.correo_representante;
            document.getElementById("telefono").value = res.telefono_representante;
            document.getElementById("direccion").value = res.direccion_representante;
            document.getElementById("id_usuario").value = res.id_usuario;
            $("#nuevo_representante").modal("show");
        }
    }
}
function btnEliminarRepresentante(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Representante no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Representante/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRepresentante.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
function btnReingresarRepresentante(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Representante/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRepresentante.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Representante

// **********************Establecimiento*********************************
function frmEstablecimiento() {
    document.getElementById("title").textContent = "Nuevo Establecimiento";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmEstablecimiento").reset();
    document.getElementById("id").value = "";
    const urls = base_url + "Representante/obtener";
    const http = new XMLHttpRequest();
    http.open("GET", urls, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = "";
            let filas = '';
            for (const child of res) {
                filas += '<option id="id_representante" value="' + child.id_representante + '">' + child.nombre_representante + '</option>';
            }
            $('#id_representante').html(filas);
            $("#nuevo_establecimiento").modal("show");

        }
    }
}
function registrarEstablecimiento(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const direccion = document.getElementById("direccion");
    if (direccion.value == "" || nombre.value == "") {
        alertas('Todo los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Establecimiento/registrar";
        const frm = document.getElementById("frmEstablecimiento");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_establecimiento").modal("hide");
                frm.reset();
                tblEstablecimiento.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
function btnEditarEstablecimiento(id) {
    frmEstablecimiento();
    document.getElementById("title").textContent = "Actualizar Establecimiento";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Establecimiento/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id_establecimiento;
            document.getElementById("nombre").value = res.nombre_establecimiento;
            document.getElementById("direccion").value = res.direccion_establecimiento;
            document.getElementById("id_representante").value = res.id_representante;
            $("#nuevo_establecimiento").modal("show");
        }
    }
}
function btnEliminarEstablecimiento(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Establecimiento no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Establecimiento/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRepresentante.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
function btnReingresarEstablecimiento(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Establecimiento/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRepresentante.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Establecimiento
// **********************Categoria*********************************
function frmCategoria() {
    document.getElementById("title").textContent = "Nueva Categoría";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCategoria").reset();
    document.getElementById("id_categoria").value = "";
    $("#nuevoCategoria").modal("show");
}
// Registrar Categoria
function registrarCategoria(e) {
    e.preventDefault();
    const nombre_categoria = document.getElementById("nombre_categoria");
    if (nombre_categoria.value == "") {
        alertas('Nombre de la categoría requerida', 'warning');
    } else {
        const url = base_url + "Categoria/registrar";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoCategoria").modal("hide");
                frm.reset();
                tblCategoria.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
function btnEditarCategoria(id) {
    document.getElementById("title").textContent = "Actualizar Categoría";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Categoria/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_categoria").value = res.id_categoria;
            document.getElementById("nombre_categoria").value = res.nombre_categoria;
            $("#nuevoCategoria").modal("show");
        }
    }
}
function btnEliminarCategoria(id) {
    Swal.fire({
        title: 'Esta seguro desea eliminar la Categoría?',
        text: "La categoría no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categoria/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCategoria.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
function btnReingresarCategoria(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categoria/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCategoria.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Categoria
// **********************Criterio*********************************
function frmCriterio() {
    document.getElementById("title").textContent = "Nuevo Criterio";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCriterio").reset();
    document.getElementById("id_criterio").value = "";
    $("#nuevoCriterio").modal("show");
}
// Registrar Criterio
function registrarCriterio(e) {
    e.preventDefault();
    const nombre_criterio = document.getElementById("nombre_criterio");
    if (nombre_criterio.value == "") {
        alertas('La categoria es requerida', 'warning');
    } else {
        const url = base_url + "Criterio/registrar";
        const frm = document.getElementById("frmCriterio");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoCriterio").modal("hide");
                frm.reset();
                tblCriterio.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
// Editar Criterio
function btnEditarCriterio(id) {
    document.getElementById("title").textContent = "Actualizar Criterio";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Criterio/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_criterio").value = res.id_criterio;
            document.getElementById("valor_criterio").value = res.valor_criterio;
            document.getElementById("identificacion_criterio").value = res.identificacion_criterio;
            document.getElementById("fase_criterio").value = res.fase_criterio;
            document.getElementById("nombre_criterio").value = res.nombre_criterio;

            $("#nuevoCriterio").modal("show");
        }
    }
}
// Eliminar Criterio
function btnEliminarCriterio(id) {
    Swal.fire({
        title: 'Esta seguro desea eliminar la Criterio?',
        text: "El Criterio no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Criterio/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCriterio.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
// Reingresar Criterio
function btnReingresarCriterio(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Criterio/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCriterio.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Criterio
//*************************  Rol *****************************
function frmRol() {
    document.getElementById("title").textContent = "Nueva Rol";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmRol").reset();
    document.getElementById("id_rol").value = "";
    $("#nuevoRol").modal("show");
}
// Registrar Rol
function registrarRol(e) {
    e.preventDefault();
    const nombre_rol = document.getElementById("nombre_rol");
    if (nombre_rol.value == "") {
        alertas('La nombre del Rol es requerido', 'warning');
    } else {
        const url = base_url + "Rol/registrar";
        const frm = document.getElementById("frmRol");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoRol").modal("hide");
                frm.reset();
                tblRol.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
// Editar Rol
function btnEditarRol(id) {
    document.getElementById("title").textContent = "Actualizar Rol";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Rol/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_rol").value = res.id_rol;
            document.getElementById("nombre_rol").value = res.nombre_rol;
            $("#nuevoRol").modal("show");
        }
    }
}
// Eliminar Rol
function btnEliminarRol(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Rol no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Rol/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRol.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
// Reingresar Rol
function btnReingresarRol(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Rol/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRol.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Rol
//*************************  Proceso *****************************
function frmProceso() {
    document.getElementById("title").textContent = "Nueva Proceso";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmProceso").reset();
    document.getElementById("id_proceso").value = "";
    $("#nuevoProceso").modal("show");
}
// Registrar Proceso
function registrarProceso(e) {
    e.preventDefault();
    const nombre_proceso = document.getElementById("nombre_proceso");
    if (nombre_proceso.value == "") {
        alertas('El nombre del proceso es requerido', 'warning');
    } else {
        const url = base_url + "Proceso/registrar";
        const frm = document.getElementById("frmProceso");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoProceso").modal("hide");
                frm.reset();
                tblProceso.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
// Editar Proceso
function btnEditarProceso(id) {
    document.getElementById("title").textContent = "Actualizar Proceso";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Proceso/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_proceso").value = res.id_proceso;
            document.getElementById("nombre_proceso").value = res.nombre_proceso;
            $("#nuevoProceso").modal("show");
        }
    }
}
// Eliminar Proceso
function btnEliminarProceso(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El proceso no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Proceso/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblProceso.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
// Reingresar Proceso
function btnReingresarProceso(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Proceso/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblProceso.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Proceso
//**************************** Gestion ************************
function frmGestion() {
    document.getElementById("title").textContent = "Nueva Gestión";
    document.getElementById("btnAccion").textContent = "Registrar";
    const urls = base_url + "Proceso/obtener";
    const http = new XMLHttpRequest();
    http.open("GET", urls, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_gestion").value = "";
            document.getElementById("nombre_gestion").value = "";
            let filas = '';
            for (const child of res) {
                filas += '<option id="id_procesos" value="' + child.id_proceso + '">' + child.nombre_proceso + '</option>';
            }
            $('#id_proceso').html(filas);
            $("#nuevoGestion").modal("show");
        }
    }
}
// Registrar Gesion 
function registrarGestion(e) {
    e.preventDefault();
    const nombre_gestion = document.getElementById("nombre_gestion");
    if (nombre_gestion.value == "") {
        alertas('El nombre de la gestión es requerida', 'warning');
    } else {
        const url = base_url + "Gestion/registrar";
        const frm = document.getElementById("frmGestion");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoGestion").modal("hide");
                frm.reset();
                tblGestion.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
// Editar Gestión 
function btnEditarGestion(id) {
    frmGestion();
    document.getElementById("title").textContent = "Actualizar Gestión";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Gestion/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_gestion").value = res.id_gestion;
            document.getElementById("nombre_gestion").value = res.nombre_gestion;
            document.getElementById("id_proceso").value = res.id_proceso;
            $("#nuevoGestion").modal("show");
        }
    }
}
// Eliminar Gestión 
function btnEliminarGestion(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La Gestión no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Gestion/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblGestion.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
// Reingresar Gestión 
function btnReingresarGestion(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Gestion/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblGestion.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Gesttion

//****************************** Formulario ***************************
function frmFormulario() {
    document.getElementById("title").textContent = "Nuevo Formulario";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmFormulario").reset();
    document.getElementById("id_formulario").value = "";
    document.getElementById("nombre_formulario").value = "";
    $("#nuevoFormulario").modal("show");
}
//Registrar Formulario
function registrarFormulario(e) {
    e.preventDefault();
    const nombre_formulario = document.getElementById("nombre_formulario");
    const descripcion_formulario = document.getElementById("descripcion_formulario");
    if (nombre_formulario.value == "" || descripcion_formulario.value == "") {
        alertas('Datos vacios', 'warning');
    } else {
        const url = base_url + "Formulario/wsdfg";
        const frm = document.getElementById("frmFormulario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoFormulario").modal("hide");
                alertas("Formulario Creado Correctamente", "success");
                window.location.href = base_url + "Formulario/edit/" + res.msg;
            }
        }
    }
}
//Guardar Formulario
function GuardaFormulario(e) {
    e.preventDefault();
    const nombre_formulario = document.getElementById("nombre_formulario");
    const descripcion_formulario = document.getElementById("descripcion_formulario");
    if (nombre_formulario.value == "" || descripcion_formulario.value == "") {
        alertas('Datos vacios', 'warning');
        console.log(nombre_gestion);
        console.log(descripcion_gestion);
    } else {
        const url = base_url + "Formulario/registrar";
        const frm = document.getElementById("frmEditFormulario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoFormulario").modal("hide");
                //frm.reset();
                alertas("Guardando Formulario", "success");
                window.location.href = base_url + "Formulario";
            }
        }
    }
}
//Editar Formulario
function btnEditarFormulario(id) {
    const url = base_url + "Formulario/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            window.location.href = base_url + "Formulario/edit/" + res.id_formulario;
        }
    }
}
//Eliminar Formulario
function btnEliminarFormulario(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El formulario no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Formulario/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblFormulario.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Reingresar Formulario
function btnReingresarFormulario(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Formulario/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblFormulario.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
//Fin Formulario
//********************Evaluacion********************************

//Listar evaluacion segun establecimiento
function listEvaluacion(e) {
    e.preventDefault();
    const listaEvaluacion = document.getElementById('list-evaluacion');
    const template = document.getElementById('template-listarEvaluacion').content;
    const fragment = document.createDocumentFragment();
    const opcionEstablecimientos = document.getElementById("id_Establecimiento").value;
    console.log(opcionEstablecimientos);

    const url = base_url + "Reporte/listar/" + opcionEstablecimientos;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            Object.values(res).forEach(evaluacion => {
                console.log("foreach" + evaluacion.id_establecimiento);

            });
            listaEvaluacion.innerHTML = '';
            for (const evaluacion of res) {
                const clone = template.cloneNode(true);
                clone.getElementById('evaluacion_formulario').textContent = evaluacion.nombre_formulario
                clone.getElementById('evaluacion_fecha').textContent = evaluacion.fecha
                clone.getElementById('evaluacion_evaluador').textContent = evaluacion.nombre_usuario + ' ' + evaluacion.apellido_usuario
                clone.querySelectorAll('.btn-primary')[0].dataset.id = evaluacion.id_evaluacion
                clone.querySelectorAll('.btn-danger')[0].dataset.id = evaluacion.id_evaluacion
                fragment.appendChild(clone);
            }
            listaEvaluacion.appendChild(fragment);
        }
    }
    listaEvaluacion.addEventListener('click', e => {
        btnAction(e)
    })
}

const btnAction = e => {
    e.preventDefault();

    if (e.target.classList.contains('btn-primary')) {
        listarReporte(e.target.dataset.id);
    }
    if (e.target.classList.contains('btn-danger')) {
        btnEliminarEvaluacion(e.target.dataset.id);
    }
    e.stopPropagation()
}
//Listar resumen 

function resumenSimulacion(id_simulacion) {
    const listPregunta = document.getElementById('list-pregunta');
    const listResumen = document.getElementById('list_resumen');
    const resultado = document.getElementById('seccion_resultado');

    const templatePregunta = document.getElementById('template-listPreguntas').content;
    const templateCriterio = document.getElementById('template-respCriterios').content;
    const templateResumen = document.getElementById('template-listResumen').content;
    const templateResultado = document.getElementById('template-totalResultado').content;

    const fragmentoPregunta = document.createDocumentFragment();
    const fragmentoCriterio = document.createDocumentFragment();
    const fragmentoResumen = document.createDocumentFragment();
    const fragmentoResultado = document.createDocumentFragment();

    const url = base_url + "Simulador/listarResumen/" + id_simulacion;
    const frm = document.getElementById("frmSimulacion");

    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);

            //Visualizar y/o ocultar secciones
            $('#seccion_parametro').toggle();
            $('#seccion_resultados').toggle();
            $('#seccion_botones').toggle();
            $('#seccion_botones2').toggle();

            //Inicializando seciones
            listPregunta.innerHTML = '';
            listResumen.innerHTML = '';
            resultado.innerHTML = '';
            //Resultado
            const clone1 = templateResultado.cloneNode(true);
            clone1.getElementById('total_resultado').textContent = res.promedio + '%'
            clone1.getElementById('total_calificacion').textContent = res.valor
            clone1.getElementById('calificacion').className = res.clase
            fragmentoResultado.appendChild(clone1);
            resultado.appendChild(fragmentoResultado);

            //Resumen
            for (const resumen of res.resumen) {
                const clone2 = templateResumen.cloneNode(true);
                clone2.getElementById('categoria').textContent = resumen.nombre_categoria
                clone2.getElementById('total').textContent = resumen.total + '%'
                clone2.getElementById('acciones').textContent = resumen.acciones
                clone2.getElementById('acciones').className = resumen.clase;
                fragmentoResumen.appendChild(clone2);
            }
            listResumen.appendChild(fragmentoResumen);
            //Preguntas
            for (const simulacion of res.simulacion) {
                const clone3 = templatePregunta.cloneNode(true);
                clone3.querySelector('textarea').textContent = simulacion.nombre_pregunta
                clone3.querySelector('input').textContent = simulacion.id_pregunta
                //Criterios
                const listCriterio = clone3.getElementById('list-criterio');
                listCriterio.innerHTML = '';
                console.log(simulacion.id_criterio)


                for (const criterios of res.criterios) {
                    const clone4 = templateCriterio.cloneNode(true);
                    clone4.querySelector('label').textContent = criterios.valor_criterio
                    var x = document.createElement("INPUT");
                    x.setAttribute("type", "radio");
                    if (simulacion.id_criterio == criterios.id_criterio) {
                        x.setAttribute("checked", "true");
                    }
                    x.setAttribute("disabled", "false");
                    clone4.getElementById('criterio').appendChild(x)
                    fragmentoCriterio.appendChild(clone4);
                    clone3.querySelectorAll('.row')[1] = fragmentoCriterio

                }

                listCriterio.appendChild(fragmentoCriterio);
                fragmentoPregunta.appendChild(clone3);
            }
            listPregunta.appendChild(fragmentoPregunta);
        }
    }
}

//
function resumenEvaluacion(id_evaluacion) {
    const listPregunta = document.getElementById('list-pregunta');
    const listResumen = document.getElementById('list_resumen');
    const resultado = document.getElementById('seccion_resultado');

    const templatePregunta = document.getElementById('template-listPreguntas').content;
    const templateCriterio = document.getElementById('template-respCriterios').content;
    const templateResumen = document.getElementById('template-listResumen').content;
    const templateResultado = document.getElementById('template-totalResultado').content;

    const fragmentoPregunta = document.createDocumentFragment();
    const fragmentoCriterio = document.createDocumentFragment();
    const fragmentoResumen = document.createDocumentFragment();
    const fragmentoResultado = document.createDocumentFragment();

    const url = base_url + "Evaluacion/listarResumen/" + id_evaluacion;
    const frm = document.getElementById("frmEvaluacion");

    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);

            //Visualizar y/o ocultar secciones
            $('#seccion_parametro').toggle();
            $('#seccion_resultados').toggle();
            $('#seccion_botones').toggle();
            $('#seccion_botones2').toggle();

            //Inicializando seciones
            listPregunta.innerHTML = '';
            listResumen.innerHTML = '';
            resultado.innerHTML = '';
            //Resultado
            const clone1 = templateResultado.cloneNode(true);
            clone1.getElementById('total_resultado').textContent = res.promedio + '%'
            clone1.getElementById('total_calificacion').textContent = res.valor
            clone1.getElementById('calificacion').className = res.clase
            fragmentoResultado.appendChild(clone1);
            resultado.appendChild(fragmentoResultado);

            //Resumen
            for (const resumen of res.resumen) {
                const clone2 = templateResumen.cloneNode(true);
                clone2.getElementById('categoria').textContent = resumen.nombre_categoria
                clone2.getElementById('total').textContent = resumen.total + '%'
                clone2.getElementById('acciones').textContent = resumen.acciones
                clone2.getElementById('acciones').className = resumen.clase;
                fragmentoResumen.appendChild(clone2);
            }
            listResumen.appendChild(fragmentoResumen);
            //Preguntas
            for (const evaluacion of res.evaluacion) {
                const clone3 = templatePregunta.cloneNode(true);
                clone3.querySelector('textarea').textContent = evaluacion.nombre_pregunta
                clone3.querySelector('input').textContent = evaluacion.id_pregunta
                //Criterios
                const listCriterio = clone3.getElementById('list-criterio');
                listCriterio.innerHTML = '';
                console.log(evaluacion.id_criterio)


                for (const criterios of res.criterios) {
                    const clone4 = templateCriterio.cloneNode(true);
                    clone4.querySelector('label').textContent = criterios.valor_criterio
                    var x = document.createElement("INPUT");
                    x.setAttribute("type", "radio");
                    if (evaluacion.id_criterio == criterios.id_criterio) {
                        x.setAttribute("checked", "true");
                    }
                    x.setAttribute("disabled", "false");
                    clone4.getElementById('criterio').appendChild(x)
                    fragmentoCriterio.appendChild(clone4);
                    clone3.querySelectorAll('.row')[1] = fragmentoCriterio
                }

                listCriterio.appendChild(fragmentoCriterio);
                fragmentoPregunta.appendChild(clone3);
            }
            listPregunta.appendChild(fragmentoPregunta);
        }
    }
}
function listarReporte(id_evaluacion) {

    espere('¡Espere por favor!', 'Cargando Información')
    const listPregunta = document.getElementById('list-pregunta');
    const listResumen = document.getElementById('list_resumen');
    const resultado = document.getElementById('seccion_resultado');

    const templatePregunta = document.getElementById('template-listPreguntas').content;
    const templateCriterio = document.getElementById('template-respCriterios').content;
    const templateResumen = document.getElementById('template-listResumen').content;
    const templateResultado = document.getElementById('template-totalResultado').content;

    const fragmentoPregunta = document.createDocumentFragment();
    const fragmentoCriterio = document.createDocumentFragment();
    const fragmentoResumen = document.createDocumentFragment();
    const fragmentoResultado = document.createDocumentFragment();

    const url = base_url + "Reporte/listarReporte/" + id_evaluacion;
    const frm = document.getElementById("frmReporte");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);

            //Visualizar y/o ocultar secciones
            $('#seccion_seleccion').toggle();
            $('#seccion_evaluacion').toggle();
            $('#seccion_informacion').toggle();
            $('#seccion_botones2').toggle();
            $('#seccion_preguntas').toggle();
            $('#idFormulario').toggle();

            //Asignar datos Establecimiento
            document.getElementById('idestablecimiento').value = res.establecimiento['id_establecimiento']
            document.getElementById('nombre_establecimiento').textContent = res.establecimiento['nombre_establecimiento']
            document.getElementById('direccion_establecimiento').textContent = res.establecimiento['direccion_establecimiento']
            document.getElementById('nombre_representante').textContent = res.establecimiento['nombre_representante'] + ' ' + res.establecimiento['apellido_representante']
            document.getElementById('telefono_representante').textContent = res.establecimiento['telefono_representante']

            //Inicializando seciones
            listPregunta.innerHTML = '';
            listResumen.innerHTML = '';
            resultado.innerHTML = '';
            //Resultado
            const clone1 = templateResultado.cloneNode(true);
            clone1.getElementById('total_resultado').textContent = res.promedio + '%'
            clone1.getElementById('total_calificacion').textContent = res.valor
            clone1.getElementById('calificacion').className = res.clase
            fragmentoResultado.appendChild(clone1);
            resultado.appendChild(fragmentoResultado);

            //Resumen
            for (const resumen of res.resumen) {
                const clone2 = templateResumen.cloneNode(true);
                clone2.getElementById('categoria').textContent = resumen.nombre_categoria
                clone2.getElementById('total').textContent = resumen.total + '%'
                clone2.getElementById('acciones').textContent = resumen.acciones
                clone2.getElementById('acciones').className = resumen.clase;
                fragmentoResumen.appendChild(clone2);
            }
            listResumen.appendChild(fragmentoResumen);
            //Preguntas
            for (const evaluacion of res.evaluacion) {
                document.getElementById('idFormulario').textContent = evaluacion.nombre_formulario

                const clone3 = templatePregunta.cloneNode(true);
                clone3.querySelector('textarea').textContent = evaluacion.nombre_pregunta
                clone3.querySelector('input').textContent = evaluacion.id_pregunta
                //Criterios
                const listCriterio = clone3.getElementById('list-criterio');
                listCriterio.innerHTML = '';
                console.log(evaluacion.id_criterio)

                for (const criterios of res.criterios) {
                    const clone4 = templateCriterio.cloneNode(true);
                    clone4.querySelector('label').textContent = criterios.valor_criterio
                    var x = document.createElement("INPUT");
                    x.setAttribute("type", "radio");
                    if (evaluacion.id_criterio == criterios.id_criterio) {
                        x.setAttribute("checked", "true");
                    }
                    x.setAttribute("disabled", "false");
                    clone4.getElementById('criterio').appendChild(x)
                    fragmentoCriterio.appendChild(clone4);
                    clone3.querySelectorAll('.row')[1] = fragmentoCriterio
                }

                listCriterio.appendChild(fragmentoCriterio);
                fragmentoPregunta.appendChild(clone3);
            }
            listPregunta.appendChild(fragmentoPregunta);
        }
    }
}
function Imprimir(e) {
    e.preventDefault();
    $('#id_titulo').toggle();

    $('#seccion_botones2').toggle();
    print();
    $('#seccion_botones2').toggle();
}


//Listar Preguntas para evaluar
function PreguntasSimulador(e) {
    e.preventDefault();
    espere('¡Espere por favor!', 'Cargando Preguntas')

    const listaPregunta = document.getElementById('list-pregunta');
    const listaCriterioCalificacion = document.getElementById('seccion_criterios');

    const template = document.getElementById('template-listarpregunta').content;
    const template_criterio = document.getElementById('template-criteriosCalificacion').content;
    const template2 = document.getElementById('template-listarCriterio').content;

    const fragment = document.createDocumentFragment();
    const fragmentCriterio = document.createDocumentFragment();
    const fragmentCriterioCalificacion = document.createDocumentFragment();
    const url = base_url + "Simulador/listarPreguntas/";
    const frm = document.getElementById("frmSimulacion");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            listaPregunta.innerHTML = '';
            $('#idButtonIniciar').toggle();
            $('#seccion_preguntas').toggle();
            $('#idformularios').toggle();
            $('#seccion_parametro').toggle();
            $('#idFormulario').toggle();
            $('#seccion_botones').toggle();
            listaCriterioCalificacion.innerHTML = '';
            document.getElementById('idFormulario').textContent = res.formulario['nombre_formulario']

            for (const criterios of res.criterios) {
                const clone = template_criterio.cloneNode(true);
                clone.getElementById('identificacion_criterio').textContent = criterios.identificacion_criterio
                clone.getElementById('valor_criterio').textContent = criterios.valor_criterio
                clone.getElementById('nombre_criterio').textContent = criterios.nombre_criterio
                clone.getElementById('fase_criterio').textContent = criterios.fase_criterio
                fragmentCriterioCalificacion.appendChild(clone);
            }
            listaCriterioCalificacion.appendChild(fragmentCriterioCalificacion);
            for (const preguntas of res.preguntas) {
                const clone = template.cloneNode(true);
                clone.querySelector('textarea').textContent = preguntas.nombre_pregunta
                clone.querySelector('input').textContent = preguntas.id_pregunta
                const listaCriterio = clone.getElementById('list-criterio');
                listaCriterio.innerHTML = '';
                for (const criterios of res.criterios) {
                    const clone2 = template2.cloneNode(true);
                    clone2.querySelector('label').textContent = criterios.valor_criterio
                    clone2.querySelector('input').dataset.id = criterios.id_criterio
                    clone2.querySelector('input').name = preguntas.id_pregunta
                    fragmentCriterio.appendChild(clone2);
                    clone.querySelectorAll('.row')[1] = fragmentCriterio
                }
                listaCriterio.appendChild(fragmentCriterio);
                fragment.appendChild(clone);
            }
            listaPregunta.appendChild(fragment);
        }
    }
}
//Listar Preguntas para evaluar

function listarPreguntas(e) {
    e.preventDefault();
    espere('¡Espere por favor!', 'Cargando Preguntas')
    const listaPregunta = document.getElementById('list-pregunta');
    const listaCalificacion = document.getElementById('seccion_criterio');

    const templatePregunta = document.getElementById('template-listPreguntas').content;
    const templateCalificacion = document.getElementById('template-listCalificacion').content;
    const templateCriterio = document.getElementById('template-listCriterios').content;

    const fragmentoPregunta = document.createDocumentFragment();
    const fragmentoCriterio = document.createDocumentFragment();
    const fragmentoCalificacion = document.createDocumentFragment();

    const url = base_url + "Evaluacion/listarPreguntas";
    const frm = document.getElementById("frmEvaluacion");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            //Visualizar y/o ocultar secciones
            $('#seccion_seleccion').toggle();
            $('#seccion_informacion').toggle();
            $('#seccion_parametro').toggle();
            $('#seccion_preguntas').toggle();
            $('#seccion_botones').toggle();

            //Asignar datos Establecimiento
            document.getElementById('idFormulario').textContent = res.formulario['nombre_formulario']
            document.getElementById('idestablecimiento').value = res.establecimiento['id_establecimiento']
            document.getElementById('nombre_establecimiento').textContent = res.establecimiento['nombre_establecimiento']
            document.getElementById('direccion_establecimiento').textContent = res.establecimiento['direccion_establecimiento']
            document.getElementById('nombre_representante').textContent = res.establecimiento['nombre_representante']
            document.getElementById('telefono_representante').textContent = res.establecimiento['telefono_representante']

            //Inicilizar secciones
            listaPregunta.innerHTML = '';
            listaCalificacion.innerHTML = '';
            //Asignar Calificaciones
            for (const criterios of res.criterios) {
                const clone1 = templateCalificacion.cloneNode(true);
                clone1.getElementById('identificacion_criterio').textContent = criterios.identificacion_criterio
                clone1.getElementById('valor_criterio').textContent = criterios.valor_criterio
                clone1.getElementById('nombre_criterio').textContent = criterios.nombre_criterio
                clone1.getElementById('fase_criterio').textContent = criterios.fase_criterio
                fragmentoCalificacion.appendChild(clone1);
            }
            listaCalificacion.appendChild(fragmentoCalificacion);
            //Asignar Preguntas
            for (const preguntas of res.preguntas) {
                const clone2 = templatePregunta.cloneNode(true);
                clone2.querySelector('textarea').textContent = preguntas.nombre_pregunta
                clone2.querySelector('input').textContent = preguntas.id_pregunta
                const listaCriterio = clone2.getElementById('list-criterio');
                listaCriterio.innerHTML = '';
                //Asignar Criterios
                for (const criterios of res.criterios) {
                    const clone3 = templateCriterio.cloneNode(true);
                    clone3.querySelector('label').textContent = criterios.valor_criterio
                    clone3.querySelector('input').dataset.id = criterios.id_criterio
                    clone3.querySelector('input').name = preguntas.id_pregunta
                    fragmentoCriterio.appendChild(clone3);
                    clone2.querySelectorAll('.row')[1] = fragmentoCriterio
                }
                listaCriterio.appendChild(fragmentoCriterio);
                fragmentoPregunta.appendChild(clone2);
            }
            listaPregunta.appendChild(fragmentoPregunta);
        }
    }
}
//Listar Evaluacion
function registrarEvaluacion(e) {
    e.preventDefault();
    espere('¡Espere por favor!', 'Procesando Información')

    const estab = document.getElementById('id_formulario');
    const formu = document.getElementById('id_establecimiento');
    console.log('establecimiento:' + estab.value)
    console.log('formulario:' + formu.value)

    const url = base_url + "Evaluacion/registrar";
    const frm = document.getElementById("frmEvaluacion");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res)
            frm.reset();
            alertas(res.msg, res.icono);
            resumenEvaluacion(res.id_evaluacion);
        }

    }
}
function registrarSimulacion(e) {
    e.preventDefault();
    espere('¡Espere por favor!', 'Procesando Información')

    const formulario = document.getElementById('id_formulario');
    const establecimiento = document.getElementById('id_establecimiento');
    console.log('Establecimiento' + establecimiento.value)
    console.log("Formulario " + formulario.value)
    const url = base_url + "Simulador/registrar";
    const frm = document.getElementById("frmSimulacion");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res)
            frm.reset();
            alertas(res.msg, res.icono);
            resumenSimulacion(res.id_evaluacion);
        }

    }
}
function listEstablecimiento() {

    const url = base_url + "Evaluacion/listaEstablecimiento/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
        }
    }
}

function listarDetalles() {
    const establecimiento = document.getElementById("id_establecimiento");
    console.log('Establecimiento' + establecimiento.value)
    const formulario = document.getElementById("id_formulario");
    let gender = document.forms[0]
    var listaProductos = [];
    for (i = 0; i < gender.length; i++) {
        if (gender[i].checked == true) {
            console.log("gender" + i + "; nombre" + gender[i].name + "=> id" + gender[i].dataset.id)
            listaProductos.push({
                "id_pregunta": gender[i].name,
                "id_criterio": gender[i].dataset.id,
                "id_establecimiento": establecimiento.value,
                "id_formulario": formulario.value
            })

        }
    }
    $("#respuesta").val(JSON.stringify(listaProductos));
}
function btnEliminarEvaluacion(id) {
    Swal.fire({
        title: 'Esta seguro desea eliminar la Evaluacion?',
        text: "La Evaluacion no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Evaluacion/eliminarevaluacion/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                }
            }
        }
    })

}
//Fin Evaluacion
//Inicio Pregunta
function frmPregunta() {
    document.getElementById("title").textContent = "Nueva Pregunta";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmPregunta").reset();
    const selectGestiones = document.getElementById("id_gestion");
    const selectCategorias = document.getElementById("id_categoria");
    document.getElementById("id_pregunta").value = "";
    document.getElementById("nombre_pregunta").value = "";
    const urls = base_url + "Formulario/cargardatos";
    const http = new XMLHttpRequest();
    http.open("GET", urls, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            for (const categoria of res.categorias) {
                const opcioncategoria = document.createElement("option");
                opcioncategoria.value = categoria.id_categoria;
                opcioncategoria.text = categoria.nombre_categoria;
                selectCategorias.appendChild(opcioncategoria);
            }
            for (const gestion of res.gestiones) {
                const opciongestion = document.createElement("option");
                opciongestion.value = gestion.id_gestion;
                opciongestion.text = gestion.nombre_gestion;
                selectGestiones.appendChild(opciongestion);
            }
        }
    }
}
function nuevaPregunta() {
    frmPregunta();
    $("#nuevaPregunta").modal("show");
}
function registrarPregunta(e, id_formulario) {
    e.preventDefault();
    const nombre_pregunta = document.getElementById("nombre_pregunta");
    if (nombre_pregunta.value == "") {
        alertas('La pregunta es requerida', 'warning');
    } else {
        const url = base_url + "Formulario/registrarpregunta";
        const frm = document.getElementById("frmPregunta");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevaPregunta").modal("hide");
                console.log("res");
                console.log(res);
                frm.reset();
                alertas(res.msg, res.icono);
                window.location.href = base_url + "Formulario/edit/" + id_formulario;
            }
        }
    }
}

function btnEditarPregunta(id) {
    frmPregunta();
    document.getElementById("title").textContent = "Modificar Pregunta";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Formulario/editarpregunta/" + id;
    const https = new XMLHttpRequest();
    https.open("GET", url, true);
    https.send();
    https.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_pregunta").value = res.id_pregunta;
            document.getElementById("nombre_pregunta").value = res.nombre_pregunta;
            document.getElementById("id_categoria").value = res.id_categoria;
            document.getElementById("id_gestion").value = res.id_gestion;
            document.getElementById("id_formulario").value = res.id_formulario;
            $("#nuevaPregunta").modal("show");

        }
    }

}

function btnEliminarPregunta(id, id_formulario) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Formulario/eliminarpregunta/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    window.location.href = base_url + "Formulario/edit/" + id_formulario;
                }
            }

        }
    })
}



function preview(e) {
    var input = document.getElementById('imagen');
    var filePath = input.value;
    var extension = /(\.png|\.jpeg|\.jpg)$/i;
    if (!extension.exec(filePath)) {
        alertas('Seleccione un archivo valido', 'warning');
        deleteImg();
        return false;
    } else {
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML = `
        <button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times-circle"></i></button>
        `;
    }

}
function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}
function frmConfig(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    const correo = document.getElementById("correo");
    if (nombre.value == "" || telefono.value == "" || direccion.value == "" || correo.value == "") {
        alertas('Todo los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Configuracion/actualizar";
        const frm = document.getElementById("frmConfig");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnRolesUser(id) {
    const http = new XMLHttpRequest();
    const url = base_url + "Usuarios/permisos/" + id;
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("frmPermisos").innerHTML = this.responseText;
            $("#permisos").modal("show");
        }
    }
}
function btnRoles(id) {
    const http = new XMLHttpRequest();
    const url = base_url + "Rol/permisos/" + id;
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("frmPermisos").innerHTML = this.responseText;
            $("#permisos").modal("show");
        }
    }
}
function registrarPermisos(e) {
    e.preventDefault();
    const http = new XMLHttpRequest();
    const frm = document.getElementById("frmPermisos");
    const url = base_url + "Rol/registrarPermisos";
    http.open("POST", url);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#permisos").modal("hide");
            if (res == 'ok') {
                alertas('Permisos Asignado', 'success');
            } else {
                alertas('Error al asignar los permisos', 'error');
            }
        }
    }
}
/*
function registrarPermisos(e) {
    e.preventDefault();
    const http = new XMLHttpRequest();
    const frm = document.getElementById("frmPermisos");
    const url = base_url + "Usuarios/registrarPermisos";
    http.open("POST", url);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#permisos").modal("hide");
            if (res == 'ok') {
                alertas('Permisos Asignado', 'success');
            } else {
                alertas('Error al asignar los permisos', 'error');
            }
        }
    }
}
*/
function modificarClave(e) {
    e.preventDefault();
    var formClave = document.querySelector("#frmCambiarPass");
    formClave.onsubmit = function (e) {
        e.preventDefault();
        const clave_actual = document.querySelector("#clave_actual").value;
        const nueva_clave = document.querySelector("#clave_nueva").value;
        const confirmar_clave = document.querySelector("#clave_confirmar").value;
        if (clave_actual == "" || nueva_clave == "" || confirmar_clave == "") {
            alertas('Todo los campos son requeridos', 'warning');
        } else if (nueva_clave != confirmar_clave) {
            alertas('Las contraseñas no coinciden', 'warning');
        } else {
            const http = new XMLHttpRequest();
            const frm = document.getElementById("frmPermisos");
            const url = base_url + "Usuarios/cambiarPas";
            http.open("POST", url);
            http.send(new FormData(formClave));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    $('#cambiarClave').modal("hide");
                    alertas(res.msg, res.icono);
                }
            }
        }

    }
}

function alertas(msg, icono) {
    Swal.fire({
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 2000
    })
}

function espere(titulo,mensaje){
    Swal.fire({
        title: titulo,
        html: mensaje,
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        timer: 2000,
        width: 600,
        padding: '3em',
        color: '#006404',
        background: '#fff',
        backdrop: 'rgba(0,30,2,0.8)'
    });
}
