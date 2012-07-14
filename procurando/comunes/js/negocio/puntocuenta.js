/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */


  function filtrar(){
      var id_proyecto_filtro=document.frmcontrato.id_proyecto_filtro.value;
      var id_codigo_proyecto=document.frmcontrato.strcodigopoyecto.value;
      var strcodigo_filtro=document.frmcontrato.strcodigo_filtro.value;
      var id_estatus_filtro=document.frmcontrato.lngstatus_filtro.value;
        xajax_selectAllPuntoCuenta('',id_proyecto_filtro,strcodigo_filtro,id_estatus_filtro,id_codigo_proyecto);
        $('contenedor').show();
 }


 function verfiltro(){
        xajax_formfiltro();
        xajax_llenarSelectEstatus_filtro();
        $('filtro').toggle();
        $('contenedor').show();
 }


function eliminarEmpresa(id)
{
      xajax_selectAllEmpresas('',id);
}

function eliminarInspector(id)
{
      xajax_selectAllInspector('',id);
}

function seleccion_tipo_empresa(codigo)
{
           if (codigo==11385)
           {
               alert('La empresa es Tipo Cooperativa Se eliminaran los montos de I.V.A.');
               document.frmcontrato.sngiva.value="0";
               document.frmcontrato.sngmontoiva.value="0";
               xajax_calcular('0','0');
           }
}

function habilitar_pestana(codigo)
{
    if (codigo==11357)
    {
      $('Empresa').show();
      $('Inspector').hide();
      $('lngporcentaje').hide();
      document.frmcontrato.lngporcentaje.value="0";
    }
    else
    {
      $('Empresa').hide();
      $('Inspector').show();
    }
}

function insertar_strcodigo(strcodigo)
{
    document.frmcontrato.strcodigo.value=strcodigo;
    $('id_expediente_buscado').hide();
        if (confirm('¿Desea agregar un Punto de Cuenta Asociado a este Proyecto?')){
           xajax_selectAllEmpresas();
           xajax_selectAllInspector();
           xajax_llenarSelectPlan('0');
           xajax_llenarSelectActividad('0','0');
           xajax_llenarSelectPartidaSinIVA('0','0','0');
           xajax_llenarSelectPartidaIVA('0','0','0');
           xajax_llenarTipoEmpresa('0');
           xajax_llenarSelectTipoContrato('0');
           xajax_llenarSelectOrigen('0');
           document.frmcontrato.lngcodigo.value="";
           document.frmcontrato.strempresainspector.value="";
           document.frmcontrato.lngporcentaje.value="0";
           document.frmcontrato.dtmfechainicial.value="";
           document.frmcontrato.dtmfechafinal.value="";
           document.frmcontrato.sngmontosiniva.value="0";
           document.frmcontrato.sngiva.value="0";
           document.frmcontrato.sngmontoiva.value="0";
           document.frmcontrato.sngmontototal.value="0";
           document.frmcontrato.id_empresa.value="";
           document.frmcontrato.id_tipo_empresa_catalogo.value="";
           document.frmcontrato.id_solicitante.value="";
           //document.frmcontrato.id_dp.value="";
           //document.frmcontrato.lngproyecto.value="";
        }
}

function buscar_expediente_inspector(accion)
{
    if (accion=='2')
       $('id_expediente_buscado').toggle();
    else
       $('id_expediente_buscado').show();
    var strcodigo=document.frmcontrato.strcodigo.value;
    xajax_buscar_expediente_inspector(strcodigo);
}

function calcular()
{
       var sngmontosiniva=document.frmcontrato.sngmontosiniva.value;
       var sngiva=document.frmcontrato.sngiva.value;
       xajax_calcular(sngmontosiniva,sngiva);
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
        if (confirm('�Desea agregar una empresa a este Punto de Cuenta?')){
            xajax_guardarEmpresa(xajax.getFormValues('frmcontrato'));
            alert('Guardada Empresa con exito');
            xajax_selectAllEmpresas(document.frmcontrato.lngcodigo.value);
            $('formulario_empresa').hide();
        }
        else
        {
            $('formulario_empresa').hide();
            $('Cancelado Ingreso de Nueva Empresa');
        }
   }
   else
        alert('Llene Todos los Campos');
}

function guardar_form_inspector(){
   if (($('fecha_desde_inspector').value!='') && ($('fecha_hasta_inspector').value!=''))
   {
        if (confirm('¿Desea agregar un Inspector a este Punto de Cuenta?')){
            xajax_guardarInspector(xajax.getFormValues('frmcontrato'));
            alert('Guardada Inspector con exito');
            xajax_selectAllInspector(document.frmcontrato.lngcodigo.value);
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
        if (confirm('¿Seguro desea eliminar el Contrato?')){
            xajax_deleteContrato(id_contratoproyecto);
        }
    }


    function cargar(lngpunto_cuenta)
    {
           $('Empresa').hide();
           $('Inspector').hide();
           xajax_DetallePuntoCuenta(lngpunto_cuenta);
    }

    function validar()
    {
         var bandera=true;
         if (document.frmcontrato.lngtipo.value==11358)
		 {
	         if ($('lngporcentaje').value=='')
	              {
	                   alert('Porcentaje de Inspecci�n Requerido');
	                   $("lngporcentaje").focus();
	                   bandera=false;
	              }
		 }
		 else
		 {
			document.frmcontrato.lngporcentaje.value="0";
		 }
         if ($('dtmfechainicial').value=='')
              {
                   alert('Fecha Inicio Obra Requerido');
                   $("dtmfechainicial").focus();
                   bandera=false;
              }
         else if ($('dtmfechafinal').value=='')
              {
                   alert('Fecha Final Obra Requerido');
                   $("dtmfechafinal").focus();
                   bandera=false;
              }
         else if ($('sngmontosiniva').value=='')
              {
                   alert('Monto sin I.V.A. Requerido');
                   $("sngmontosiniva").focus();
                   bandera=false;
              }
         else if ($('sngiva').value=='')
              {
                   alert('%I.V.A. Requerido');
                   $("sngiva").focus();
                   bandera=false;
              }
         else if ($('sngmontoiva').value=='')
              {
                   alert('Monto I.V.A. Requerido');
                   $("sngmontoiva").focus();
                   bandera=false;
              }
         else if ($('sngmontototal').value=='')
              {
                   alert('Monto Total Requerido');
                   $("sngmontototal").focus();
                   bandera=false;
              }
         else if ($('id_empresa').value=="")
              {
                   alert('Seleccionar una Empresa o Inspector');
                   bandera=false;
              }
         else if ($('lngtipo').value==0)
              {
                   alert('Seleccionar Tipo de Punto de Cuenta');
                   bandera=false;
              }
         else if ($('lngorigen').value==0)
              {
                   alert('Seleccionar Origen de Punto de Cuenta');
                   bandera=false;
              }
         else if ($('lngorigen').value==0)
              {
                   alert('Seleccionar Origen de Punto de Cuenta');
                   bandera=false;
              }
         else if ($('lngstatus').value==0)
              {
                   alert('Seleccionar Estatus de Punto de Cuenta');
                   bandera=false;
              }
         else if ($('id_plan').value==0)
              {
                   alert('Seleccionar Plan del Punto de Cuenta');
                   bandera=false;
              }
         else if ($('lngpartida1').value==0)
              {
                   alert('Seleccionar Partida del Monto sin I.V.A. del Punto de Cuenta');
                   bandera=false;
              }
         else if ($('lngtipoempresa').value==0)
              {
                   alert('Seleccionar Tipo de Empresa del Punto de Cuenta');
                   bandera=false;
              }
          if (bandera)
          {
            if ($('lngcodigo').value=='')
                 xajax_insertPuntoCuenta(xajax.getFormValues('frmcontrato'));
            else
                 xajax_updatePuntoCuenta(xajax.getFormValues('frmcontrato'));
          }
    }



    function retorno_variables_obras(id_proyecto,strproyecto,strcodigo,memdireccion,id_tipoduracion_maestro,intduracion,id_solicitante,id_estado,id_municipio,id_estatus_maestro)
    {
           if (id_proyecto!='$id_proyecto$') $('lngproyecto').value=id_proyecto;
           if (strcodigo!='$strcodigo$') $('strcodigo').value=strcodigo;
           if (strproyecto!='$strproyecto$') $('strproyecto').value=strproyecto;
           if (id_estado!='$id_estado$') xajax_llenarSelectEstados(id_estado);
           if (id_municipio!='$id_municipio$') xajax_llenarMunicipios(id_municipio);
           if (id_estatus_maestro!='$iid_estatus_maestro$') xajax_llenarSelectEstatus(id_estatus_maestro);
           if (memdireccion!='$memdireccion$') $('memdireccion').value=memdireccion;
           if (intduracion!='$intduracion$') $('intduracion').value=intduracion;
           if (id_tipoduracion_maestro!='$id_tipoduracion_maestro$') $('id_duracion').value=id_tipoduracion_maestro;
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
           $('Inspector').show();
           var cadena=str.split("*");
           $('strempresainspector').value=cadena[2];
           //$('lngporcentaje').value=cadena[1];
           $('dtmfechainicial').value=cadena[3];
           $('dtmfechafinal').value=cadena[4];
           xajax_llenarTipoEmpresa(cadena[5]);
           $('id_empresa').value=cadena[6];
           xajax_llenarSelectTipoContrato('11358');
           $('Empresa').hide();
    }


    function seleccion_empresa(str)
    {
           $('Empresa').show();
           var cadena=str.split("*");
           $('strempresainspector').value=cadena[1];
           //$('lngporcentaje').value=cadena[1];
           $('dtmfechainicial').value=cadena[2];
           $('dtmfechafinal').value=cadena[3];
           xajax_llenarTipoEmpresa(cadena[4]);
           if (cadena[4]==11385)
           {
               alert('La empresa es Tipo Cooperativa Se eliminaran los montos de I.V.A.');
               document.frmcontrato.sngiva.value="0";
               document.frmcontrato.sngmontoiva.value="0";
               xajax_calcular('0','0');
           }
           $('id_empresa').value=cadena[5];
           xajax_llenarSelectTipoContrato('11357');
           $('Inspector').hide();
    }


    function retorno_variables_empresa(id_empresa, strrif, strdireccion, strcontacto, strtelefono, strempresainspector, id_tipo_empresa, strobjeto)
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