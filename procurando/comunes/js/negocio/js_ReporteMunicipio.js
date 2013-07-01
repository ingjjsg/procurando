function cargarReporteMunicipio(combo){
    var indice = combo.value;
if(indice!='0'){
      location.href="./reporteAyudasMunicipios.php?id="+indice;
    }
}
