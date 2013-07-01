/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 function nuevo(accion)
 {
    $('formulario_comite').show();
    $('contenedor_comite').show();
    $('formulario_proyecto').hide();
    $('contenedor_proyecto').hide();
    $('formulario_contacto').hide();
    $('contenedor_contacto').hide();
    xajax_formComite(accion)
 }

 function editar(accion,arreglo){
        $('formulario_comite').show();
        $('formulario_proyecto').hide();
        $('contenedor_proyecto').hide();
        $('formulario_contacto').hide();
        $('contenedor_contacto').hide();
    xajax_formComite(accion,arreglo);
 }

  function asignarComiteProyecto(id_comite,strdescripcion,fecha_desde,fecha_hasta){
        $('contenedor_proyecto').show();
        $('formulario_contacto').hide();
        $('contenedor_contacto').hide();
        $('formulario_comite').hide();
        $('contenedor_comite').hide();
        xajax_selectAsignacionComiteProyecto(id_comite,strdescripcion,fecha_desde,fecha_hasta);
 }


 function asignarComite(id_comite,strdescripcion,fecha_desde,fecha_hasta){
        $('contenedor_contacto').show();
        $('formulario_proyecto').hide();
        $('contenedor_proyecto').hide();
        $('formulario_comite').hide();
        $('contenedor_comite').hide();
        xajax_selectAsignacionComite(id_comite,strdescripcion,fecha_desde,fecha_hasta);
 }

 function cargar(){
        $('contenedor_comite').show();
        xajax_selectAllComite();
 }


 function validaEntero(e){
     evt = e ? e : event;
     tcl = (window.Event) ? evt.which : evt.keyCode;
     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==0)) {
       return true;
       }
     else return false;
  }

   function validaDecimal(e){
     evt = e ? e : event;
     tcl = (window.Event) ? evt.which : evt.keyCode;
     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==46) || (tcl==44) || (tcl==0)) {
       return true;
       }
     else return false;
  }

    function ocultar(id, msj) {
        var log = $(id);
        log.innerHTML= msj;
        log.style.backgroundColor= '#fff36f';
        log.style.padding= '5px';
        new Effect.Fade(id, {from: 1, to: 0, duration: 1.0});
        new Effect.SlideUp(id, {queue: 'parallel', duration: 1.0});
    }
    function ocultar2(id) {
        Effect.Fade(id, { duration: 2.0 });
        Effect.SlideUp(id, { duration: 2.0 });
    }
    function eliminarComite(id_comite){
        if (confirm('¿Seguro desea eliminar el Comite?')){
            $('formulario_comite').hide();
            $('formulario_proyecto').hide();
            $('contenedor_proyecto').hide();
            $('formulario_contacto').hide();
            $('contenedor_contacto').hide();
            xajax_deleteComite(id_comite,xajax.getFormValues('frmcomite'));
        }
    }

    function validar(acc){
        if(document.frmcomite.strdescripcion.value == ""){
            alert('Debe ingresar un valor en el campo Nombre');
            var e = document.getElementById('strdescripcion');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }else{
            if(acc == 'INS'){
                xajax_insertComite(xajax.getFormValues('frmcomite'));
            }else if(acc == 'UPD'){
                xajax_updateComite(xajax.getFormValues('frmcomite'));
            }

        }
    }

    function eliminarcontacto(id_comite,id_contacto,strdescripcion){
        if (confirm('¿Seguro desea eliminar el Contacto?')){
            xajax_deleteContacoComite(id_comite,id_contacto,strdescripcion);
        }
    }

     function editarcontacto(accion,arreglo){
            $('formulario_contacto').show();
            xajax_formComiteIntegrantes(accion,arreglo);
     }

     function crearcontacto(accion,id_comite){
        $('formulario_contacto').show();
        xajax_formComiteIntegrantes(accion,id_comite);
     }

     function buscar_contactos(){
            departamento=document.frmcomite.id_departamento.value;
            xajax_llenarSelectContacto(departamento);
     }

    function validarInsertContactoComite(acc){
        if(document.frmcomite.id_comite.value == ""){
            alert('Debe ingresar un valor en el campo Nombre');
            var e = document.getElementById('id_comite');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }else{
            if(acc == 'INS'){
                xajax_insertContactoComite(xajax.getFormValues('frmcomite'));
            }

        }
    }

     function volver(id){
            if (id==''){
                $('contenedor_comite').show();
                xajax_selectAllComite();
            }
            else
            {
                $('contenedor_comite').show();
                $(id).hide();
            }
     }

     function crearproyecto(accion,id_comite){
            $('formulario_proyecto').show();
            xajax_formComiteProyecto(accion,id_comite);
     }

    function validarInsertProyectoComite(acc){
        if(document.frmcomite.idproyecto.value == ""){
            alert('Debe seleccionar un Proyecto');
            var e = document.getElementById('strnombre');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }else{
            if(acc == 'INS'){
                xajax_insertProyectoComite(xajax.getFormValues('frmcomite'));
            }

        }
    }

    function deleteProyectoComite(id_comite,id_proyecto,$strdescripcion){
        if (confirm('¿Seguro desea eliminar el Proyecto del Comite?')){
            xajax_deleteProyectoComite(id_comite,id_proyecto,$strdescripcion);
        }
    }

     function cerrarcomite(accion,arreglo){
            $('formulario_comite').show();
            xajax_formComiteCerrar(accion,arreglo);
     }

    function ValidarComiteCerrar(){
        if (confirm('¿Seguro desea Cerrar el Comite?')){
            $('formulario_comite').show();
            $('formulario_proyecto').hide();
            $('contenedor_proyecto').hide();
            $('formulario_contacto').hide();
            $('contenedor_contacto').hide();
            xajax_CerrarComite(xajax.getFormValues('frmcomite'));
        }


	 function CambiarEstatusProyecto(accion,arreglo){
	        $('contenedor_estatus_proyecto').show();
	        $('formulario_comite').hide();
	        $('formulario_proyecto').hide();
	        $('contenedor_proyecto').hide();
	        $('formulario_contacto').hide();
	        $('contenedor_contacto').hide();
	    xajax_formCambiarEstatusProyecto(accion,arreglo);
	 }


    }