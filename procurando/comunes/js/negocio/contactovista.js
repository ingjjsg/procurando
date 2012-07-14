/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


            function abrirVentana(opcion){
                switch (opcion) {
                    case 1:
                        window.open('./contactoVistaIngreso.php?acc=INS&tipo=Interno&id_tipo_maestro=171', 'contenido', '');
                        break;
                }
            }
            function eliminarContacto(id_contacto){
                if (confirm('¿Seguro desea eliminar el Contacto?')){
                    xajax_deleteContacto(id_contacto);
                }
            }
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                Effect.Fade(id, { duration: 2.0 });
                Effect.SlideUp(id, { duration: 2.0 });
            }
            function ver(id){
                div = $('div_'+id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_verDeTallesContacto(id);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_c'+id){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_verDeTallesContacto(id);
                    }
                }
            }
            function verForm(id){
                xajax_selectAllDpto();
                div = $(id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                }else{
                    d = div.descendants();
                }
            }
            function resetPassword(id){
                if (confirm('¿Seguro desea actualizar el password para el contacto con el id: '+id+'?')){
                    xajax_resetContactoPassword(id);
                }
            }
            function filtrar(){
                var nombre= document.frmcontacto.nombre.value;
                var apellido= document.frmcontacto.apellido.value;
                var login= document.frmcontacto.login.value;
                var cedula= document.frmcontacto.cedula.value;
                var dpto= document.frmcontacto.id_dpto.value;
                if(dpto == 0){
                    dpto= "";
                }
                xajax_selectAllContactofiltros(nombre, apellido, login, cedula, dpto);
                verForm('formulario');
            }
