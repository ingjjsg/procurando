
   function verDetalles(id, strtipo){
       div = $('div_'+id);
       div.toggle();

       if (div.innerHTML==''){
           div.update('<div align="center"><img src="imagenes/ajax-loader.gif"></div>');
           xajax_verDetallesComunicacion(id, strtipo, 2);
       }else {
           d = div.descendants();
           if(d[0].id!='div_c'+id){
               div.show();
               div.update('<div align="center"><img src="imagenes/ajax-loader.gif"></div>');
               xajax_verDetallesComunicacion(id, strtipo,2);
           }
       }
   }

   function CambiarEstatusCorrespondencia(id){
           xajax_actualizarEstatusCorrespondenciaEntrada(id);
//               xajax_verDetallesComunicacion('1', '2',2);
   }


