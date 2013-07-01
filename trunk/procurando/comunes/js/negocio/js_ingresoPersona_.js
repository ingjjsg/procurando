/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */

  function eliminarPersona(lngcodigo){
    xajax_eliminarPersona(lngcodigo);
  }
  function eliminarAyuda(lngcodigo){
xajax_eliminarAyuda(lngcodigo);
}
  function filtrar(){
      var nacionalidad=document.frmcontacto.strnacionalidad.value;
      var cedula=document.frmcontacto.cedula.value;
      xajax_selectAllPersonas(nacionalidad,cedula);
        $('contenedor').appear();
        $('filtro').fade();
 }

  function verfiltro(){
        xajax_formfiltro();
        $('filtro').appear();
        $('contenedor').appear();
 }

    function respuesta()
    {
                var lngcodigo=document.frmpersona.lngcodigo.value;
                window.opener.retorno_variables(lngcodigo);
                close();
    }





   function validar()
   {
        if(document.frmpersona.cedula.value == "")
        {
            alert('Debe ingresar un valor en el campo Cedula');
            var e = document.getElementById('cedula');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersona.strnombre.value == "")
        {
            alert('Debe ingresar un valor en el campo Nombre');
            var e = document.getElementById('strnombre');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersona.strapellido.value == "")
        {
            alert('Debe ingresar un valor en el campo Apellido');
            var e = document.getElementById('strapellido');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersona.strdireccion.value == "")
        {
            alert('Debe ingresar un valor en el campo Direcci�n');
            var e = document.getElementById('strdireccion');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersona.dtmfechapnac.value == "")
        {
            alert('Debe ingresar un valor en el campo Fecha de Nacimiento');
            var e = document.getElementById('dtmfechapnac');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmpersona.id_sexo.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Sexo');
            var e = document.getElementById('id_sexo');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmpersona.id_estado_civil.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Estado Civil');
            var e = document.getElementById('id_estado_civil');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmpersona.id_municipio.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Municipio');
            var e = document.getElementById('id_municipio');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmpersona.id_parroquia.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el campo Parroquia');
            var e = document.getElementById('id_parroquia');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else
          xajax_GuardarPersona(xajax.getFormValues('frmpersona'));;

    }

    function nueva_ayuda(lngcodigo)
    {
          location.href='vista_listaAyudas.php?id='+lngcodigo;
    }

    function cargar(lngcodigo)
    {
          xajax_DetallePersona(lngcodigo);
    }

        function habilitar_asociacion(rif)
    {
        $('asociacion_formulario').appear();
        xajax_formulario_asociacion();
        $('principal').fade()
        if (rif!='') buscar_rif(rif);
    }

    function elegir_asociacion(id)
    {
        if (id!='')
        {
            $('asociacion_formulario').fade();
            $('lngcodigo_asociacion').value= $('strrif_recibido').value;
            $('nombre_asociacion').value= $('strnombre_asociacion').value;
            $('principal').appear();
            alert('Asociacion ha sido seleccionada con Exito');
        }
        else
           alert('Asociacion no ha sido seleccionada');
    }

    function buscar_persona(nacionalidad,id_persona)
    {
         xajax_DetalleBuscaPersona(nacionalidad,id_persona);
//         cargar(id_persona)
    }

    function buscar_Correo(correo)
    {
         xajax_DetalleBuscaCorreo(correo);

    }
    function buscar_datos()
    {
         xajax_DetalleBuscaDatos();

    }





    function setSeguridad(){

        xajax_GuardarSeguridad(xajax.getFormValues('frmpersona'))
    }





    function buscar_Clave()
    {
         xajax_DetalleBuscaClave();

    }



    function buscar_rif_corto(rif)
    {
         xajax_DetalleBuscarRifCorto(rif);
    }

    function buscar_rif(rif)
    {
         xajax_DetalleBuscarRif(rif);
    }

    function buscar_parroquia(id_municipio)
    {
         xajax_llenarSelectParroquia(id_municipio);
    }

    function esconder_formulario_asociacion()
    {
        $('asociacion_formulario').fade();
        $('principal').appear();
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

	     function seleccionarCedula(nacionalidad,cedula){
    	xajax_seleccionarCedula(nacionalidad,cedula);
    }



