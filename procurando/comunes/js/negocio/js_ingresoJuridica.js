/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */

  function editar_asociacion(lngcodigo)
  {
    if (lngcodigo!='')
      location.href='vista_ingresoAsosiacion.php?id='+lngcodigo;
    else
      alert('Asociación no esta Registrada');
  }


  function busca_asociacion_nueva_ayuda(lngcodigo)
  {
    if (lngcodigo!='')
      location.href='vista_ingresoAyudaAsociacion.php?id='+lngcodigo;
    else
      alert('Asociación no esta Registrada');
  }
//
//  function filtrar(){
//      var strrif=document.frmcontacto.strrif.value;
//      xajax_selectAllJuridicas(strrif);
//        $('contenedor').appear();
//        $('filtro').fade();
// }

  function verfiltro(){
        xajax_formfiltro();
        $('filtro').appear();
        $('contenedor').appear();
 }
function eliminarAyuda(lngcodigo){
xajax_eliminarAyuda(lngcodigo);
}
  function eliminarAsociacion(lngcodigo_asociacion){
    xajax_eliminarAsociacion(lngcodigo_asociacion);
  }
    function eliminarPersonaAsociacion(lngcodigo_asociacion,lngcodigo){
    xajax_eliminarPersonaAsociacion(lngcodigo_asociacion,lngcodigo);
  }
   function lista_ayuda(lngcodigo)
   {
          location.href='vista_listaAyudasAsociacion.php?id='+lngcodigo;
   }

   function nueva_ayuda(lngcodigo)
   {
          location.href='vista_ingresoAyudaAsociacion.php?id='+lngcodigo;
   }


   function validar()
   {
        if(document.frmpersonajuridica.strrif.value == "")
        {
            alert('Debe ingresar un valor en el campo Rif');
            var e = document.getElementById('strrif');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.strnombre_asociacion.value == "")
        {
            alert('Debe ingresar un valor en el campo Nombre');
            var e = document.getElementById('strnombre_asociacion');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.strdireccion_asociacion.value == "")
        {
            alert('Debe ingresar un valor en el campo Direcci�n');
            var e = document.getElementById('strdireccion_asociacion');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.dtmfechafun.value == "")
        {
            alert('Debe ingresar un valor en el campo Fecha');
            var e = document.getElementById('dtmfechafun');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.strtelefono_asociacion.value == "")
        {
            alert('Debe ingresar un valor en el campo Tel�fono');
            var e = document.getElementById('strtelefono_asociacion');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.id_ramo.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Ramo');
            var e = document.getElementById('id_ramo');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.id_municipio_asociacion.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Municipio');
            var e = document.getElementById('id_municipio_asociacion');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmpersonajuridica.id_parroquia_asociacion.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Parroquia');
            var e = document.getElementById('id_parroquia_asociacion');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else
          xajax_GuardarAsociacion(xajax.getFormValues('frmpersonajuridica'));;

    }



    function asociar_persona(lngcodigo_asociacion,lngcodigo)
    {
          if ((lngcodigo_asociacion!='') && (lngcodigo!=''))
          	xajax_AsociarPersona(lngcodigo_asociacion,lngcodigo);
          else alert('Seleccione una Persona');
    }

    function retorno_variables(lngcodigo)
    {
          xajax_BuscaPersonaCatalogo(lngcodigo);
    }

    function cargar()
    {
          xajax_selectAllJuridicas();
    }

    function cargar_detalle(lngcodigo_asociacion)
    {
          xajax_DetalleAsociacion(lngcodigo_asociacion);
    }

    function buscar_parroquia(id_municipio)
    {
         xajax_llenarSelectParroquiaAsociacion(id_municipio);
    }

    function habilitar_lista()
    {
        if ($('contenedor_personasasociadas').visible())
           $('contenedor_personasasociadas').fade();
        else
           $('contenedor_personasasociadas').appear();
    }

    function busca_persona(nacionalidad,cedula)
    {
         xajax_BuscaPersona(nacionalidad,cedula);
    }

    function editar_persona(){
        var id=document.frmpersonajuridica.lngcodigo.value;
              poPupCenter('./vista_ingresoPersonaCatalogo.php?id='+id+'&accion=no&focus=1','',700,400);
    }

    function buscar_rif(rif)
    {
         xajax_BuscarRif(rif);
    }

    function buscarJ(rif)
    {
         xajax_buscarJ(rif);
    }
