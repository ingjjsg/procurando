/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jesus
 */

 function filtrar(){
      var strcodigo_filtro    = document.frmcontacto.strcodigo_filtro.value;
      var id_resumen_movimiento_filtro  = document.frmcontacto.id_resumen_movimiento_filtro.value;
      var strdocumento_filtro = document.frmcontacto.strdocumento_filtro.value;
      var id_estatus_filtro   = document.frmcontacto.id_estatus_filtro.value;
//      var idestados           = document.frmcontacto.idestados.value;
//        xajax_selectAllPresupuestoModificado('', id_resumen_movimiento_filtro,strcodigo_filtro,strdocumento_filtro,id_estatus_filtro,idestados);
        xajax_selectAllPresupuestoModificado('', id_resumen_movimiento_filtro,strcodigo_filtro,strdocumento_filtro,id_estatus_filtro);
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
    alert('Seleccione un Cambio del Formulario de Movimientos Presupuesto Modificado para Guardar Cambio ')
  }
  else
  {
       if ((document.frmcontacto.strjustificacion.value == "") || (document.frmcontacto.id_razon.selectedIndex==0))
       {
         alert('Llene todo el Formulario de Justificacion de Movimiento Presupuesto Modificado')
       }
       else
       {
        if (confirm('¿Seguro desea cambiar el estado del Presupuesto Modificado?')){
            xajax_guardarEstado(document.frmcontacto.id_resumen_movimiento.value,document.frmcontacto.id_cambio.value,document.frmcontacto.id_razon.value,document.frmcontacto.strjustificacion.value);
        }
        else
             cargar();
       }
  }
 }

 function declararjustificacion(){
  if ((document.frmcontacto.id_retroceder.selectedIndex==0) && (document.frmcontacto.id_avanzar.selectedIndex==0))
  {
    alert('Seleccione un Cambio del Formulario de Movimientos Presupuesto Modificado para Guardar Cambio ')
  }
  else
  {
       $('justificacion').show();
       xajax_formJustificacion('INS');
       var html='<img src="../comunes/images/16_save.gif" onmouseout="UnTip()" border="0" onclick="guardar_salto();"/> <img src="../comunes/images/arrow_undo.png" onmouseover="Tip(\'Volver a Presupuesto Modificado\')" onmouseout="UnTip()" border="0" onclick="cargar();"/>';
       $("capaVolver").update(html);
  }

 }

 function actualizar_un_paso(acc,arreglo){
       $('justificacion').show();
       $('contenedor').show();
       if (acc=='R') msg='El Presupuesto Modificado Retrocedera un Estado';
       else msg='El Presupuesto Modificado Avanzara un Estado';
       alert(msg);
       xajax_formJustificacionUnPaso(acc,arreglo);
       $("capaVolver").show();
       if (acc=='R'){
	       var html='<img src="../comunes/images/16_save.gif" onmouseout="UnTip()" border="0" onclick="guardar_un_paso_R();"/> <img src="../comunes/images/arrow_undo.png" onmouseover="Tip(\'Volver a Presupuesto Modificado\')" onmouseout="UnTip()" border="0" onclick="cargar();"/>';
       }else{
			var html='<img src="../comunes/images/16_save.gif" onmouseout="UnTip()" border="0" onclick="guardar_un_paso_A();"/> <img src="../comunes/images/arrow_undo.png" onmouseover="Tip(\'Volver a Presupuesto Modificado\')" onmouseout="UnTip()" border="0" onclick="cargar();"/>';
	       }
       $("capaVolver").update(html);
 }



 function guardar_un_paso()
 {
       if ((document.frmcontacto.strjustificacion.value == "") || (document.frmcontacto.id_razon.selectedIndex==0) || (document.frmcontacto.id_cambio.selectedIndex==0))
       {
         alert('Llene todo el Formulario de Justificacion de Movimiento de Proyecto')
       }
       else
       {
            if (confirm('¿Seguro desea cambiar el estado del Proyecto?'))
            {
                 xajax_guardarEstado(document.frmcontacto.id_proyecto.value,document.frmcontacto.id_cambio.value,document.frmcontacto.id_razon.value,document.frmcontacto.strjustificacion.value);
            }
            else cargar();
       }

 }



 function guardar_un_paso_A()
 {
       if ((document.frmcontacto.strjustificacion1.value == "") || (document.frmcontacto.id_razon.selectedIndex==0) || (document.frmcontacto.id_cambio1.selectedIndex==0))
       {
         alert('Llene todo el Formulario de Justificacion de Movimiento de Presupuesto Modificado')
       }
       else
       {
            if (confirm('¿Seguro desea cambiar el estado del Presupuesto Modificado?'))
            {
                 xajax_guardarEstado(document.frmcontacto.id_resumen_movimiento2.value,document.frmcontacto.id_cambio1.value,document.frmcontacto.id_razon.value,document.frmcontacto.strjustificacion1.value);
            }
            else cargar();
       }

 }

 function guardar_un_paso_R()
 {
       if ((document.frmcontacto.strjustificacion1.value == "") || (document.frmcontacto.id_razon.selectedIndex==0) || (document.frmcontacto.id_cambio1.selectedIndex==0))
       {
         alert('Llene todo el Formulario de Justificacion de Movimiento de Presupuesto Modificado')
       }
       else
       {
            if (confirm('¿Seguro desea cambiar el estado del Presupuesto Modificado?'))
            {
                 xajax_guardarEstado(document.frmcontacto.id_resumen_movimiento2.value,document.frmcontacto.id_cambio1.value,document.frmcontacto.id_razon.value,document.frmcontacto.strjustificacion1.value);
            }
            else cargar();
       }

 }
 function cargar(){
        xajax_selectAllPresupuestoModificado();
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
          alert('El Presupuesto Modificado Avanzara de Estado');
      }
 }

  function actualizar_idproyecto_retroceder()
 {
      if (document.frmcontacto.id_retroceder.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_retroceder.value;
          xajax_llenarSelectSiguiente(document.frmcontacto.id_actual.value);
          alert('El Presupuesto Modificado Retrocedera de Estado');
      }
 }

 function retroceder_estado()
 {
      if (document.frmcontacto.id_avanzar.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_avanzar.value;
          xajax_llenarSelectAnterior(document.frmcontacto.id_actual.value);
          alert('El Presupuesto Modificado Avanzara de Estado');
      }
 }

  function avanzar_estado()
 {
      if (document.frmcontacto.id_retroceder.value != "")
      {
          $('id_cambio').value=document.frmcontacto.id_retroceder.value;
          xajax_llenarSelectSiguiente(document.frmcontacto.id_actual.value);
          alert('El Presupuesto Modificado Retrocedera de Estado');
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
