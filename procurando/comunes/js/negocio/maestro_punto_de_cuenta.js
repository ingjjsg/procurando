/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */

 function filtrar(){
      var id_proyecto_filtro  = document.frmcontacto.id_proyecto_filtro.value;
      var strcodigo_filtro    = document.frmcontacto.strcodigo_filtro.value;
      var strdocumento_filtro = document.frmcontacto.strdocumento_filtro.value;
      var id_estatus_filtro   = document.frmcontacto.id_estatus_filtro.value;
      var idestados           = document.frmcontacto.idestados.value;
        xajax_selectAllPuntodeCuenta('',id_proyecto_filtro,strcodigo_filtro,strdocumento_filtro,id_estatus_filtro,idestados);
        $('capaVolver').hide();
        $('contenedor').show();
        $('formulario').hide();
        $('justificacion').hide();
 }

 function verfiltro(){
        xajax_formfiltro();
        $('filtro').toggle();
        $('capaVolver').hide();
        //$('contenedor').toggle();
        $('formulario').hide();
        $('justificacion').hide();
 }

 function guardar_salto(){
  if ((document.frmcontacto.id_retroceder.selectedIndex==0) && (document.frmcontacto.id_avanzar.selectedIndex==0))
  {
    alert('Seleccione un Cambio del Formulario Movimientos de Aprobaci�n Punto de Cuenta para Guardar Cambio ')
  }
  else
  {
       if ((document.frmcontacto.strjustificacion.value == "") || (document.frmcontacto.id_razon.selectedIndex==0))
       {
         alert('Llene todo el Formulario Justificacion de Movimiento Aprobaci�n Punto de Cuenta')
       }
       else
       {
        if (confirm('¿Seguro desea cambiar el estado de la Aprobaci�n Punto de Cuenta?')){
            xajax_guardarEstado(document.frmcontacto.id_proyecto.value,document.frmcontacto.id_cambio.value,document.frmcontacto.id_razon.value,document.frmcontacto.strjustificacion.value);
        }
        else
             cargar();
       }
  }
 }

 function declararjustificacion(){
  if ((document.frmcontacto.id_retroceder.selectedIndex==0) && (document.frmcontacto.id_avanzar.selectedIndex==0))
  {
    alert('Seleccione un Cambio del Formulario Movimientos de Aprobaci�n Punto de Cuenta para Guardar Cambio ')
  }
  else
  {
       $('justificacion').show();
       xajax_formJustificacion('INS');
       var html='<img src="../comunes/images/16_save.gif" onmouseout="UnTip()" border="0" onclick="guardar_salto();"/> <img src="../comunes/images/arrow_undo.png" onmouseover="Tip(\'Volver a Proyectos\')" onmouseout="UnTip()" border="0" onclick="cargar();"/>';
       $("capaVolver").update(html);
  }

 }

 function actualizar_un_paso(acc,arreglo){
       $('justificacion').show();
       $('contenedor').show();
       if (acc=='R') msg='La Aprobaci�n Punto de Cuenta Retrocedera un Estado';
       else msg='La Aprobaci�n Punto de Cuenta Avanzara un Estado';
       alert(msg);
       xajax_formJustificacionUnPaso(acc,arreglo);
       $("capaVolver").show();
       var html='<img src="../comunes/images/16_save.gif" onmouseout="UnTip()" border="0" onclick="guardar_un_paso();"/> <img src="../comunes/images/arrow_undo.png" onmouseover="Tip(\'Volver a Proyectos\')" onmouseout="UnTip()" border="0" onclick="cargar();"/>';
       $("capaVolver").update(html);
 }


 function guardar_un_paso()
 {
       if ((document.frmcontacto.strjustificacion.value == "") || (document.frmcontacto.id_razon.selectedIndex==0) || (document.frmcontacto.id_cambio.selectedIndex==0))
       {
         alert('Llene todo el Formulario de Justificacion Movimiento de Aprobaci�n Punto de Cuenta')
       }
       else
       {
            if (confirm('¿Seguro desea cambiar el estado de la Aprobaci�n Punto de Cuenta?'))
            {
                 xajax_guardarEstado(document.frmcontacto.id_proyecto.value,document.frmcontacto.id_cambio.value,document.frmcontacto.id_razon.value,document.frmcontacto.strjustificacion.value);
            }
            else cargar();
       }

 }

 function cargar(){
        xajax_selectAllPuntodeCuenta();
        $('capaVolver').hide();
        $('contenedor').show();
        $('formulario').hide();
        $('justificacion').hide();
 }

  function editar(accion,arreglo){
        xajax_formMaestro(accion,arreglo);
        $('capaVolver').show();
        $('formulario').show();
        $('filtro').hide();
        $('filtro_div').hide();

        //xajax_verificar_accion('137','U');
 }

 function actualizar_idproyecto_avanzar()
 {
      if (document.frmcontacto.id_avanzar.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_avanzar.value;
          xajax_llenarSelectAnterior(document.frmcontacto.id_actual.value);
          alert('La Aprobaci�n Punto de Cuenta Avanzara de Estado');
      }
 }

  function actualizar_idproyecto_retroceder()
 {
      if (document.frmcontacto.id_retroceder.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_retroceder.value;
          xajax_llenarSelectSiguiente(document.frmcontacto.id_actual.value);
          alert('La Aprobaci�n Punto de Cuenta Retrocedera de Estado');
      }
 }

 function retroceder_estado()
 {
      if (document.frmcontacto.id_avanzar.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_avanzar.value;
          xajax_llenarSelectAnterior(document.frmcontacto.id_actual.value);
          alert('La Aprobaci�n Punto de Cuenta Avanzara de Estado');
      }
 }

  function avanzar_estado()
 {
      if (document.frmcontacto.id_retroceder.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_retroceder.value;
          xajax_llenarSelectSiguiente(document.frmcontacto.id_actual.value);
          alert('La Aprobaci�n Punto de Cuenta Retrocedera de Estado');
      }
 }


 function ocultar(id, msj) {
        var log = $(id);
        log.innerHTML= msj;
        log.style.backgroundColor= '#fff36f';
        log.style.padding= '5px';
        new Effect.Fade(id, {from: 1, to: 0, duration: 2.0});
        new Effect.SlideUp(id, {queue: 'parallel', duration: 2.0});
  }
