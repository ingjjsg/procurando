/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 function editar(accion,arreglo){
        xajax_formMaestro(accion,arreglo);
        //xajax_verificar_accion('137','U');
 }


 function cargar(){
        xajax_selectAllMaestroPadres();
 }


 function validaEntero(e){
     evt = e ? e : event;
     tcl = (window.Event) ? evt.which : evt.keyCode;
     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==0)) {
       return true;
       }
     else return false;
  }

   function validaDecimal(e){
     evt = e ? e : event;
     tcl = (window.Event) ? evt.which : evt.keyCode;
     if((tcl>=48 && tcl<=57) || (tcl==8) || (tcl==9) || (tcl==13) || (tcl==46) || (tcl==44) || (tcl==0)) {
       return true;
       }
     else return false;
  }

    function ocultar(id, msj) {
        var log = $(id);
        log.innerHTML= msj;
        log.style.backgroundColor= '#fff36f';
        log.style.padding= '5px';
        new Effect.Fade(id, {from: 1, to: 0, duration: 2.0});
        new Effect.SlideUp(id, {queue: 'parallel', duration: 2.0});
    }
    function ocultar2(id) {
        Effect.Fade(id, { duration: 2.0 });
        Effect.SlideUp(id, { duration: 2.0 });
    }
    function eliminarMaestro(id_maestro){
        if (confirm('¿Seguro desea eliminar el Maestro?')){
            xajax_deleteMaestro(id_maestro,xajax.getFormValues('frmcontacto'));
        }
    }
    
    function validar(acc){
        if(document.frmcontacto.stritema.value == ""){
            alert('Debe ingresar un valor en el campo Nombre');
            var e = document.getElementById('stritema');
            e.style.borderColor= 'Red';
            e.focus();
            return false;
        }else{
            if(acc == 'INS'){
                xajax_insertMaestro(xajax.getFormValues('frmcontacto'));
            }else if(acc == 'UPD'){
                xajax_updateMaestro(xajax.getFormValues('frmcontacto'));
            }

        }
    }