/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */
var idContratoProyecto=0;
var idResumenMovimiento=0;

  function filtrar(){
      var id_proyecto_filtro=document.frmcontrato.id_proyecto_filtro.value;
      var strcodigo_filtro=document.frmcontrato.strcodigo_filtro.value;
      var id_estatus_filtro=document.frmcontrato.lngstatus_filtro.value;
        xajax_selectAllContrato('',id_proyecto_filtro,strcodigo_filtro,id_estatus_filtro);
        $('contenedor').show();
 }

 function cambiar_estatus()
 {
   if (confirm('¿Está Ud. seguro de pasar este Aprobación Punto de Cuenta a Contratación?')){
       xajax_CambiarStatus(xajax.getFormValues('frmcontrato'));
   }
 }

 function verfiltro(){
        xajax_formfiltro();
        xajax_llenarSelectEstatus_filtro();
        $('filtro').toggle();
        $('contenedor').show();
 }


function abrirCronograma(id){
     if (id!='')
          {
                idContratoProyecto=id;
                poPupCenter('cronogramaEjecucionVista.php','',800,600);
          }
     else
              alert('El Contrato debe Existir para poder cargar el cronograma');


}

function abrirPresupuestoOriginal(id)
{
     if (id!='')
          {
               idContratoProyecto=id;
               abrirPresupuesto();
          }
     else
              alert('Seleccione un Dato del Combo')
}


function analisisValuacion(id)
{
     if (id!='')
          {
               idResumenMovimiento=id;
               abrirAnalisisValuacion();
          }
     else
              alert('Seleccione un Dato del Combo')
}

function abrirAnalisisValuacion(){
          poPupCenter('./analisisvaluacionVista.php','',800,600);
}

function resumenMovimientoPresupuesto(id)
{
     if (id!='')
          {
               idContratoProyecto=id;
               abrirPresupuesto();
          }
     else
              alert('Seleccione un Dato del Combo')
}

function resumenMovimiento(id)
{
     if (id!='')
          {
               idResumenMovimiento=id;
               abrirAumentoDisminucion();
          }
     else
               alert('Seleccione un Dato del Combo')
}

function abrirAumentoDisminucion(){
          poPupCenter('./aumentoDisminucionVista.php','',800,600);
}

function enviarCorreo(){
    var proyecto=document.frmcontrato.lngcodigo.value;
    if (document.frmcontrato.lngtipo.value=='11357')
        tipo='E';
    else
        tipo='I';
    var idcontratocomunicacion=document.frmcontrato.lngcodigo.value;
          poPupCenter('./correspondenciaContratoVista.php?proy='+proyecto+'&tipo='+tipo+'&idcontratocomunicacion='+idcontratocomunicacion,'',800,600);
}

function getIdResumenMovimiento(){
     return idResumenMovimiento;
}

function abrirPresupuesto(){
          poPupCenter('./presupuestoOriginalVista.php','',800,600);
}

function getIdContratoProyecto()
{
     return idContratoProyecto;
}

function abrirPendiente(){
          poPupCenter('./trabajosPendientes.php','',800,600);
}

function volver_empresa(){
       ocultar('formulario_empresa', 'Cancelado Ingreso de Nueva Empresa');
}

function volver_inspector(){
            ocultar('formulario_inspector', 'Cancelado Ingreso de Nuevo Inspector');
}


function nueva_empresa(accion){
     $('formulario_empresa').show();
     xajax_formEmpresa(accion);
}

function nuevo_inspector(accion){
     $('formulario_inspector').show();
     xajax_formInspector(accion);
}

function guardar_form_empresa(){
   if (($('fecha_inicio_empresa').value!='') && ($('fecha_hasta_empresa').value!=''))
   {
        if (confirm('Â¿Desea agregar una empresa a este Punto de Cuenta?')){
            xajax_guardarEmpresa(xajax.getFormValues('frmcontrato'));
            xajax_selectAllEmpresas(document.frmcontrato.lngcodigo.value);
            ocultar('formulario_empresa', 'Guardada Empresa con exito');
        }
        else
        {
            ocultar('formulario_empresa', 'Cancelado Ingreso de Nueva Empresa');
        }
   }
   else
        alert('Llene Todos los Campos');
}

function guardar_form_inspector(){
   if (($('fecha_desde_inspector').value!='') && ($('fecha_hasta_inspector').value!=''))
   {
        if (confirm('Â¿Desea agregar una empresa a este Punto de Cuenta?')){
            xajax_guardarInspector(xajax.getFormValues('frmcontrato'));
            xajax_selectAllInspector(document.frmcontrato.lngcodigo.value);
            ocultar('formulario_inspector', 'Guardada Inspector con exito');
        }
        else
        {
            ocultar('formulario_inspector', 'Cancelado Ingreso de Nuevo Inspector');
        }
   }
   else
        alert('Llene Todos los Campos');

}

function ver(id)
{
    div = $('div_'+id);
    div.toggle();
    if (div.innerHTML==''){
        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
        xajax_verDeTallesContrato(id);
    }else {
        d = div.descendants();
        if(d[0].id!='div_c'+id){
            div.show();
            div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
            xajax_verDeTallesContrato(id);
        }
    }
}

 function validaEntero(e){
     evt = e ? e : event;
     tcl = (window.Event) ? evt.which : evt.keyCode;
     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==0)) {
       return true;
       }
     else return false;
  }

   function validaTelefono(e){
     evt = e ? e : event;
     tcl = (window.Event) ? evt.which : evt.keyCode;
     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==0) || (tcl==45)) {
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
        Effect.Fade(id, { duration: 2.0 });
        Effect.SlideUp(id, { duration: 2.0 });
    }

    function resetear()
    {
            alert("Contrato Eliminado");
            xajax_selectAllContrato();
    }


    function eliminarContrato(id_contratoproyecto){
        if (confirm('Â¿Seguro desea eliminar el Contrato?')){
            xajax_deleteContrato(id_contratoproyecto);
        }
    }


    function cargar(lngproyecto)
    {
          xajax_DetalleContrato(lngproyecto);
    }

    function ver_contratado(id,tipo)
    {
          if (tipo==11357)
          {

          }
          else
          {

          }
    }

    function contratar()
    {
            if ($('lngcodigo').value=='')
                 alert('Seleccione un Contrato a Actualizar');
            else
                 xajax_updateContrato(xajax.getFormValues('frmcontrato'));
    }

    function validar()
    {
            if ($('lngcodigo').value=='')
                 alert('Seleccione un Contrato a Actualizar');
            else
                 xajax_updateContrato(xajax.getFormValues('frmcontrato'));
    }



    function retorno_variables_obras(id_proyecto,strproyecto,strcodigo,memdireccion,id_tipoduracion_maestro,intduracion,id_solicitante,id_estado,id_municipio,id_estatus_maestro)
    {
           if (id_proyecto!='$id_proyecto$') $('lngproyecto').value=id_proyecto;
           if (strcodigo!='$strcodigo$') $('strcodigo').value=strcodigo;
           if (strproyecto!='$strproyecto$') $('strproyecto').value=strproyecto;
           if (id_estado!='$id_estado$') xajax_llenarSelectEstados(id_estado);
           if (id_municipio!='$id_municipio$') xajax_llenarMunicipios(id_municipio);
           if (id_estatus_maestro!='$id_estatus_maestro$') xajax_llenarSelectEstatus(id_estatus_maestro);
           if (memdireccion!='$memdireccion$') $('memdireccion').value=memdireccion;
    }

    function retorno_variables_inspector(id_empresa,strcedula,strciv,nombre_completo,tipo_empresa_catalogo,id_dp)
    {
           if (strcedula!='$strcedula$') $('strcedula').value=strcedula;
           if (strciv!='$strciv$') $('strciv').value=strciv;
           if (nombre_completo!='$nombre_completo$') $('nombre_completo').value=nombre_completo;
           if (tipo_empresa_catalogo!='$tipo_empresa_catalogo$') $('tipo_empresa_catalogo').value=tipo_empresa_catalogo;
           if (id_dp!='$id_dp$') $('id_dp').value=id_dp;
    }

    function seleccion_inspector(str)
    {
         var cadena=str.split("*");
           $('strempresainspector').value=cadena[2];
           //$('lngporcentaje').value=cadena[1];
           $('dtmfechainicial').value=cadena[3];
           $('dtmfechafinal').value=cadena[4];
           xajax_llenarTipoEmpresa(cadena[5]);
           $('id_empresa').value=cadena[6];
           xajax_llenarSelectTipoContrato('11358');

    }


    function seleccion_empresa(str)
    {
         var cadena=str.split("*");
           $('strempresainspector').value=cadena[1];
           //$('lngporcentaje').value=cadena[1];
           $('dtmfechainicial').value=cadena[2];
           $('dtmfechafinal').value=cadena[3];
           xajax_llenarTipoEmpresa(cadena[4]);
           $('id_empresa').value=cadena[5];
           xajax_llenarSelectTipoContrato('11357');
    }


    function retorno_variables_empresa(id_empresa, strrif, strobjeto, strdireccion, strcontacto, strtelefono, strempresainspector, id_tipo_empresa)
    {
           if (id_empresa!='$id_empresa$') $('id_empresa_catalogo').value=id_empresa;
           if (strrif!='$strrif$') $('strrif').value=strrif;
           if (strobjeto!='$strobjeto$') $('strobjeto').value=strobjeto;
           if (strcontacto!='$strcontacto$') $('strcontacto').value=strcontacto;
           if (strdireccion!='$strdireccion$') $('strdireccion').value=strdireccion;
           if (id_tipo_empresa!='$id_tipo_empresa$') $('id_tipo_empresa').value=id_tipo_empresa;
           if (strempresainspector!='$strempresainspector$') $('strempresainspector_catalogo').value=strempresainspector;
    }


    function retorno_variables_proyecto(id_proyecto,strproyecto,memdireccion,id_estado,id_municipio,id_tipoduracion_maestro,intduracion,dtmfechaingreso,id_solicitante)
    {
           if (id_proyecto!='$id_proyecto$') $('id_proyecto').value=id_proyecto;
           if (id_solicitante!='$id_solicitante$') $('id_solicitante').value=id_solicitante;
           if (strproyecto!='$strproyecto$') $('strproyecto').value=strproyecto;
           if (memdireccion!='$memdireccion$') $('memdireccion').value=memdireccion;
           if (intduracion!='$intduracion$') $('intduracion').value=intduracion;
           if (dtmfechaingreso!='$dtmfechaingreso$') $('dtmfechainicial').value=dtmfechaingreso;
           if (id_estado!='$id_estado$') xajax_llenarSelectEstados(id_estado);
           if (id_municipio!='$id_municipio$') xajax_llenarMunicipios(id_municipio);
           if (id_tipoduracion_maestro!='$id_tipoduracion_maestro$') xajax_llenarSelectDuracion(id_tipoduracion_maestro);
    }


    function buscar_tipo_empresa()
    {
        window.open('catalogo_tblcontratoproyecto_tipo_empresa.php','...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
    }

    function buscar_tipo_inspector()
    {
         window.open('catalogo_tblcontratoproyecto_tipo_inspector.php','...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
    }


    function buscar_unidadadministrador()
    {
            window.open('catalogo_tblcontratoproyecto_unidadadministrativa.php','...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
    }

    function retorno_variables_unidadadministrativa(codemp,coduniadm,coduac,denuniadm,estemireq,codestpro1,numsol,codtipsol,codfuefin,fecregsol,estsol,consol,monto,monbasinm,montotcar,estapro,proyecto,codestpro2,codestpro3,actividad,especifica,fuente,tiposolicitud)
    {
           if (codestpro1!='$codestpro1$') $('id_codestpro1').value=codestpro1;
           if (proyecto!='$proyecto$') $('proyecto').value=proyecto;
           if (codestpro2!='$codestpro2$') $('id_codestpro2').value=codestpro2;
           if (especifica!='$especifica$') $('especifica').value=especifica;
           if (codestpro3!='$codestpro3$') $('id_codestpro3').value=codestpro3;
           if (actividad!='$actividad$') $('actividad').value=actividad;
           if (denuniadm!='$denuniadm$') $('denuniadm').value=denuniadm;
           if (coduniadm!='$coduniadm$') $('id_coduniadm').value=coduniadm;
           if (monto!='$monto$') $('sngmontoiva').value=monto;
           if (monbasinm!='$monbasinm$') $('sngmontosiniva').value=monbasinm;
           if (montotcar!='$montotcar$') $('sngmontototal').value=montotcar;
           if (numsol!='$numsol$') $('numsol').value=numsol;
           if (codfuefin!='$codfuefin$') $('codfuefin').value=codfuefin;
           if (fuente!='$fuente$') $('des_codfuefin').value=fuente;
           if (codtipsol!='$codtipsol$') $('codtipsol').value=codtipsol;
           if (tiposolicitud!='$tiposolicitud$') $('dentipsol').value=tiposolicitud;
           if (fecregsol!='$fecregsol$') $('fecregsol').value=fecregsol;
           if (consol!='$consol$') $('consol').value=consol;
    }



    function buscar_obra()
    {
            window.open('catalogo_tblcontratoproyecto_obra.php','...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
    }

    function habilitar_catalogo()
    {
        $('tipo_empresa').show();
           var tipo_obra=document.frmcontrato.id_tipocontrato_maestro.value;
            if (tipo_obra=='316')
               $('etiqueta_empresa').update('Empresa');
            if (tipo_obra=='317')
                $("etiqueta_empresa").update('Inspector');
            $('etiqueta_empresa').innerHTML;
    }

    function respuesta(id_empresas,strempresainspector)
    {
        opener.document.getElementById('id_empresa').value=id_empresas;
        opener.document.getElementById('strempresa').value=strempresainspector;
        opener.document.getElementById('idestados').value=1;
        close();

    }

    function buscar_proyecto()
    {
            window.open('catalogo_tblcontratoproyecto_proyecto.php','...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
    }

    function buscar_iva()
    {
            var proyecto=$('id_codestpro1').value;
            var especifica=$('id_codestpro2').value;
            var actividad=$('id_codestpro3').value;
            var codunidadejecutora=$('id_coduniadm').value;
            if ((proyecto=='') || (especifica=='') || (actividad=='') || (codunidadejecutora==''))
            {
                alert('Seleccione datos del Catalogo de Uindad Ejecutora')
            }
            else
            {
                window.open('catalogo_tblcontratoproyecto_iva.php?pro='+proyecto+'&esp='+especifica+'&act='+actividad+'&uni='+codunidadejecutora,'...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
            }
    }

    function retorno_variables_iva(spg_cuenta,denominacion)
    {
           if (spg_cuenta!='$spg_cuenta$') $('id_partida2').value=spg_cuenta;
           if (denominacion!='$denominacion$') $('denominacion').value=denominacion;
    }


    function buscar_partida_obra()
    {
            var proyecto=$('id_codestpro1').value;
            var especifica=$('id_codestpro2').value;
            var actividad=$('id_codestpro3').value;
            var codunidadejecutora=$('id_coduniadm').value;
            if ((proyecto=='') || (especifica=='') || (actividad=='') || (codunidadejecutora==''))
            {
                alert('Seleccione datos del Catalogo de Uindad Ejecutora')
            }
            else
            {
                window.open('catalogo_tblcontratoproyecto_partida_obra.php?pro='+proyecto+'&esp='+especifica+'&act='+actividad+'&uni='+codunidadejecutora,'...','menubar=no,toolbar=no,scrollbars=yes,width=650,height=500,resizable=yes');
            }
    }

    function retorno_variables_partida_obra(spg_cuenta,denominacion)
    {
           if (spg_cuenta!='$spg_cuenta$') $('id_partida1').value=spg_cuenta;
           if (denominacion!='$denominacion$') $('denominacion2').value=denominacion;
    }


    function llenar_combo_sin_iva()
    {
            var id_plan=document.frmcontrato.id_plan.value;
            var id_actividad=document.frmcontrato.id_actividad.value;
            xajax_llenarSelectPartidaSinIVA(id_plan,id_actividad);
            xajax_llenarSelectPartidaIVA(id_plan,id_actividad);
    }