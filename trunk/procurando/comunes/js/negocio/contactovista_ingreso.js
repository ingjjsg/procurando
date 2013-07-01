/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

            function cargar(acc,cargo, estatus, perfil, dpto, coord, coordExt){
                if(acc == 'INS'){
                    xajax_llenarSelectCargo();
                    xajax_llenarSelectEstatus();
                    xajax_llenarSelectPerfil();
                    xajax_llenarSelectDpto();
                }else{
                    xajax_llenarSelectCargo(cargo);
                    xajax_llenarSelectEstatus(estatus);
                    xajax_llenarSelectPerfil(perfil);
                    xajax_llenarSelectDpto(dpto);
                    xajax_llenarSelectCoord(dpto, coord);
                    xajax_llenarSelectCoordext(dpto, coordExt);
                }
            }
            function validar(acc, tipo, login){
                if (!campoRequerido(document.frmcontacto.strnombre,"Nombre")) return false;
                if (!campoRequerido(document.frmcontacto.strapellido,"Apellido")) return false;
                if (!campoRequerido(document.frmcontacto.strdocumento,"Cedula")) return false;
                if (!campoRequerido(document.frmcontacto.stremail,"Email")) return false;
                if (!campoRequerido(document.frmcontacto.strtlfhab,"Telefono")) return false;
                if(tipo == 'Interno'){
                    if (!campoRequerido(document.frmcontacto.strmediafirma,"Media Firma")) return false;
                }
                if (!campoRequerido(document.frmcontacto.memdireccion,"Dirección")) return false;
                if(tipo == 'Interno'){
                    if (!validarEditor('firma', 'Firma')) return false;
                    if (!campoRequerido(document.frmcontacto.strlogin,"Login")) return false;
                    if (!validaSelect(document.frmcontacto.id_cargo_maestro,'Cargo'))return false;
                    if (!validaSelect(document.frmcontacto.id_estatus_maestro,'Estatus'))return false;
                    if (!validaSelect(document.frmcontacto.id_profile_maestro,'Perfil'))return false;
                    if (!validaSelect(document.frmcontacto.id_dpto_maestro,'Departamento'))return false;
                    xajax_verificarLogin(document.frmcontacto.strlogin.value);
                    if(login != document.frmcontacto.strlogin.value){
                        if (!validaLogin(document.frmcontacto.valLogin, document.frmcontacto.strlogin)) return false;
                    }
                }
                if(acc == 'INS'){
                    if(tipo == 'Interno'){
                        document.frmcontacto.strfirma.value= FCKeditorAPI.__Instances['firma'].GetHTML();
                    }
                    xajax_insertContacto(xajax.getFormValues('frmcontacto'));
                }else{
                    if(tipo == 'Interno'){
                        document.frmcontacto.strfirma.value= FCKeditorAPI.__Instances['firma'].GetHTML();
                    }
                    xajax_updateContacto(xajax.getFormValues('frmcontacto'));
                }
            }

