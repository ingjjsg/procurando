function cargarGrafico(){
    var vInstituto=document.frmpersona.id_organismo.value;
    var vMunicipio=document.frmpersona.id_municipio.value;
    var vMes = document.getElementById('strmes').value;
    var vAnio=document.getElementById('id_anio').value;

    //if(vMes=='0'){
        //document.getElementById('grafico').src="";
        //document.getElementById('grafico').style.display="none";


    //}else{
        document.getElementById('grafico').src="graficasAyudas.php?mes="+vMes+"&municipio="+vMunicipio+"&instituto="+vInstituto+"&anio="+vAnio;
        document.getElementById('grafico').style.display="block";
		//document.location.href="graficasAyudas.php?instituto=" + vInstituto + "&mes=" +vMes  + "&municipio=" + vMunicipio+"&anio="+vAnio;
    //}


}

function cargarOrganismo(){

xajax_llenarSelectOrganismo();
xajax_llenarSelectMunicipio();
}
