/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */

function ver(id)
{
    div = $('div_'+id);
    div.toggle();
    if (div.innerHTML==''){
        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
        xajax_verDeTallesProyecto(id);
    }
}

function retroceder_anterior(id)
{
    if (id!='')
    {
           var name="a_";
           var cajaindice=name+id;
           var fila=$(cajaindice).value;
           var cajavaluacion=name+fila+"-2";
           var cajaresumen=name+fila+"-3";
           var cajaproyecto=name+fila+"-4";
           var cajaestatus=name+fila+"-8";
           var cajacorrelativo=name+fila+"-6";
           var cajanombrevaluacion=name+fila+"-7";
           var cajafecha=name+fila+"-5";
           var valuacion=$(cajavaluacion).value;
           var resumen=$(cajaresumen).value;
           var nombre_proyecto=$(cajaproyecto).value;
           var nombre_estatus=$(cajaestatus).value;
           var correlativo=$(cajacorrelativo).value;
           var nombre_valuacion=$(cajanombrevaluacion).value;
           var fecha=$(cajafecha).value;
           xajax_llenarSelectRazonCambioEstatus();
           $('formulario_proyectos').hide();
           $('formulario_razondecambio').show();
           $('id_proyecto').value=id;
           $('id_operacion').value='r';
           $('text1').value=nombre_proyecto;
           $('text2').value=nombre_estatus;
           $('text3').value=valuacion;
           $('text4').value=resumen;
           $('text5').value=correlativo;
           $('text6').value=nombre_valuacion;
           $('text7').value=fecha;
    }
    else
    {
        alert('Id de Proyecto no valido');
    }
}

function avanzar_siguiente(id)
{
    if (id!='')
    {
           var name="a_";
           var cajaindice=name+id;
           var fila=$(cajaindice).value;
           var cajavaluacion=name+fila+"-2";
           var cajaresumen=name+fila+"-3";
           var cajaproyecto=name+fila+"-4";
           var cajaestatus=name+fila+"-8";
           var cajacorrelativo=name+fila+"-6";
           var cajanombrevaluacion=name+fila+"-7";
           var cajafecha=name+fila+"-5";
           var valuacion=$(cajavaluacion).value;
           var resumen=$(cajaresumen).value;
           var nombre_proyecto=$(cajaproyecto).value;
           var nombre_estatus=$(cajaestatus).value;
           var correlativo=$(cajacorrelativo).value;
           var nombre_valuacion=$(cajanombrevaluacion).value;
           var fecha=$(cajafecha).value;
           xajax_llenarSelectRazonCambioEstatus();
           $('formulario_proyectos').hide();
           $('formulario_razondecambio').show();
           $('id_proyecto').value=id;
           $('id_operacion').value='a';
           $('text1').value=nombre_proyecto;
           $('text2').value=nombre_estatus;
           $('text3').value=valuacion;
           $('text4').value=resumen;
           $('text5').value=correlativo;
           $('text6').value=nombre_valuacion;
           $('text7').value=fecha;
    }
    else
    {
        alert('Id de Proyecto no valido');
    }
}

function guardar()
{
   if (($('strrazoncambiostatus').value == "") && ($('id_razoncambioestatus_maestro').value==0))
   {
       alert('Escoja una Opción de Cambio');
   }
   else
   {
       xajax_cambiar_estado(xajax.getFormValues('frmmaestro_operaciones'));
       alert('El cambio e realizo con exito');
       xajax_catalogo();
   }
}

function volver()
{
       xajax_catalogo();
}