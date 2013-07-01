
  function filtrar(){
      var id_instituto=document.frmcontacto.id_organismo.value;
      var nacionalidad=document.frmcontacto.strnacionalidad.value;
      var cedula=document.frmcontacto.cedula.value;
      xajax_selectAllSolicitudes(id_instituto,nacionalidad,cedula);
        $('contenedor').appear();
        $('filtro').fade();
 }

  function verfiltro(){
        xajax_formfiltro();
        xajax_llenarSelectOrganismo();
        $('filtro').appear();
        $('contenedor').appear();
 }

function filtrarAsociacion(){
      var id_instituto=document.frmcontacto.id_organismo.value;
      var strrif=document.frmcontacto.strrif.value;
      xajax_selectAllSolicitudesAsociacion(id_instituto,strrif);
        $('contenedor').appear();
        $('filtro').fade();
 }

  function verfiltroAsociacion(){
        xajax_formfiltroAsociacion();
        xajax_llenarSelectOrganismo();
        $('filtro').appear();
        $('contenedor').appear();
 }



function filtrarMunicipioOrganismo(){
    
      var id_instituto=document.frmcontacto.id_organismo.value;
      var id_municipio=document.frmcontacto.id_municipio.value;
      if(id_instituto!="0"){
        document.getElementById('pdf_personas').show();
        }else{
            document.getElementById('pdf_personas').hide();
        }
         if(id_instituto!="0" && id_municipio!="0"){
        document.getElementById('pdf_ayudas').show();
        }else{
            document.getElementById('pdf_ayudas').hide();
        }
        var anio=document.getElementById('id_anio').value;
      xajax_selectMunicipioOrganismo(id_instituto,id_municipio,anio);
        $('contenedor').appear();
        $('filtro').fade();
      
 }

function verfiltroMunicipioOrganismo(){
        xajax_formfiltroMunicipioOrganismo();
        xajax_llenarSelectOrganismo();
        xajax_llenarSelectMunicipio();
        xajax_llenarSelectAnio();
        $('filtro').appear();
        $('contenedor').appear();
 }

function filtrarMunicipioOrganismoAsociacion(){
      var id_instituto=document.frmcontacto.id_organismo.value;
      var id_municipio=document.frmcontacto.id_municipio.value;
       if(id_instituto!="0" && id_municipio!="0"){
        document.getElementById('pdf').show();
        }else{
            document.getElementById('pdf').hide();
        }
      xajax_selectMunicipioOrganismoAsociacion(id_instituto,id_municipio);
        $('contenedor').appear();
        $('filtro').fade();
 }

function verfiltroMunicipioOrganismoAsociacion(){
        xajax_formfiltroMunicipioOrganismoAsociacion();
        xajax_llenarSelectOrganismo();
        xajax_llenarSelectMunicipio();
        $('filtro').appear();
        $('contenedor').appear();
 }

function generarPDF(tipo){
    var id_anio=document.getElementById('id_anio').value
    var id_instituto=document.frmcontacto.id_organismo.value;
    var id_municipio=document.frmcontacto.id_municipio.value;
    location.href='reporteAyudasOrganismoMunicipio.php?idMunicipio='+id_municipio+'&idOrganismo='+id_instituto+'&tipo='+tipo+'&anio='+id_anio;
}


function generarPDFAsociacion(){
    var id_instituto=document.frmcontacto.id_organismo.value;
    var id_municipio=document.frmcontacto.id_municipio.value;
    location.href='reporteAyudasOrganismoMunicipioAsociacion.php?idMunicipio='+id_municipio+'&idOrganismo='+id_instituto;
}
