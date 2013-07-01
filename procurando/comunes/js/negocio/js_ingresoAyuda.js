/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. Jaime
 */
function cargarReporte(){
    var vInstituto=document.frmayuda.id_organismo.value;
    var vSolicitud=document.frmayuda.id_ayuda.value;
    var vDesde=document.frmayuda.desde.value;
    var vHasta=document.frmayuda.hasta.value;
    document.location.href="reporteFormatoAyudas.php?idOrganismo=" + vInstituto + "&idSolicitud=" +vSolicitud + "&desde=" + vDesde + "&hasta=" + vHasta;
    
}
    function cargarFoto()
    {
          xajax_SubirFoto(xajax.getFormValues('frmfotoayuda'));
    }



    function cargarAsociacion(lngcodigo,lngcodigo_ayuda)
    {
          xajax_DetalleAsociacion(lngcodigo,lngcodigo_ayuda);
          //xajax_BuscarAyuda(lngcodigo_ayuda);
    }

    function cargar(lngcodigo,lngcodigo_ayuda)
    {
          xajax_DetallePersona(lngcodigo,lngcodigo_ayuda);
          //xajax_BuscarAyuda(lngcodigo_ayuda);
    }

    function buscar_departamento(id_organismo)
    {
          xajax_llenarSelectTipoDepartamento(id_organismo);
    }

    function buscar_ayuda(id_organismo)
    {
          xajax_llenarSelectTipoAyuda(id_organismo);
    }

    function buscar_cheque(cheque)
    {
          xajax_BuscarCheque(cheque);
    }

    function buscar_expediente(lngcodigo,strexpediente)
    {
         xajax_BuscarExpediente(lngcodigo,strexpediente);
    }

   function validar()
   {

        if(document.frmayuda.strcontenido.value == "")
        {
            alert('Debe ingresar un valor en el campo Contenido');
            var e = document.getElementById('strcontenido');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmayuda.dtmfecha.value == "")
        {
            alert('Debe ingresar un valor en el campo Fecha');
            var e = document.getElementById('dtmfecha');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmayuda.intperafect.value == "")
        {
            alert('Debe ingresar un valor en el campo Impacto Personas');
            var e = document.getElementById('intperafect');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmayuda.id_organismo.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el combo Organismo');
            var e = document.getElementById('id_organismo');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmayuda.id_ayuda.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el combo Ayuda');
            var e = document.getElementById('id_ayuda');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmayuda.id_estatus.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el combo Estatus');
            var e = document.getElementById('id_estatus');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else
          xajax_GuardarAyuda(xajax.getFormValues('frmayuda'));;

    }

 function validarAsociacion()
   {
        if(document.frmayuda.strcontenido.value == "")
        {
            alert('Debe ingresar un valor en el campo Contenido');
            var e = document.getElementById('strcontenido');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmayuda.dtmfecha.value == "")
        {
            alert('Debe ingresar un valor en el campo Fecha');
            var e = document.getElementById('dtmfecha');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmayuda.intperafect.value == "")
        {
            alert('Debe ingresar un valor en el campo Impacto Personas');
            var e = document.getElementById('intperafect');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.frmayuda.id_organismo.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el combo Organismo');
            var e = document.getElementById('id_organismo');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmayuda.id_ayuda.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el combo Ayuda');
            var e = document.getElementById('id_ayuda');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else if(document.frmayuda.id_estatus.selectedIndex==0)
        {
            alert('Debe ingresar un valor en el combo Estatus');
            var e = document.getElementById('id_estatus');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }
        else
          xajax_GuardarAyudaAsociacion(xajax.getFormValues('frmayuda'));

    }

    	 function validaEntero(e){
	     evt = e ? e : event;
	     tcl = (window.Event) ? evt.which : evt.keyCode;
	     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==0)) {
	       return true;
	       }
	     else return false;
	  }

