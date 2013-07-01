function acceptNum(evt){
    var nav4 = window.Event ? true : false;
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || (key >= 48 && key <= 57));
}

function formatearDecimal(cantDecimales, formInput){
    var ofrmcampo= formInput;
	if (cantDecimales > 0){
		var i=0;
		var aux=1;
		for (i = 0; i< cantDecimales; i++){
			aux= aux * 10;
		}
		numero = ofrmcampo.value * aux;
		numero = Math.round(numero);
		numero = numero/aux;
	}
    formInput.value= numero;
}
function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 8)
        return true
    if (key > 47 && key < 58) {
        if (field.value == "")
            return true
        regexp = /,[0-9]{2}$/
        return !(regexp.test(field.value))
    }
    if (key == 46) {
        if (field.value == "")
            return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
  return false
}
function validaSelect(formInput,campo){
     var resultado = true;
     var ofrmcampo = formInput;
     if(ofrmcampo.selectedIndex == 0 ){
         resultado = false;
     }
     if (!resultado ){
         alert('Por Favor seleccione una opcion para el campo ' + campo +'.');
         ofrmcampo.style.borderColor= 'Red';
         ofrmcampo.focus();
     }
    return resultado;
}
function campoRequerido(formInput,campo){
    var resultado = true;
	var ofrmcampo = formInput;
	if ((ofrmcampo.value == "") || (ofrmcampo.value.length == 0)){
        alert('Por favor introduzca un valor en ' + campo +'.');
		ofrmcampo.style.borderColor= 'Red';
         ofrmcampo.focus();
		resultado = false;
	}
	return resultado;
}
function setSelectInput(formInput,valor){
    var objSelect = formInput;
    for (var i=0;i<objSelect.length;i++){
        if(objSelect[i].value == valor){
            formInput[i].selected = true;
        }
    }
}
function setInputText(formInput,valor){
    formInput.value = valor;
}
function setHidden(frmhidden,valorhidden){
    var ofrmhidden = frmhidden;
    ofrmhidden.value = valorhidden;
}
function setRadioInput(formInput,valor){
    var objRadio = formInput;
    for (var i=0;i<objRadio.length;i++){
        if(objRadio[i].value == valor){
            formInput[i].checked = true;
        }
    }
}
function validarEditor(formInput, campo){
    var resultado = true;
    fckEditor1val = FCKeditorAPI.__Instances[formInput].GetHTML();
    fckEditor1val2 = fckEditor1val.stripTags();
    if(fckEditor1val2 == "" ){
        alert('Por favor introduzca el contenido del documento.');
        resultado = false;
	}
	return resultado;
}
function validaLogin(formInput1, formInput2){
    var resultado = true;
	var ofrmcampo1 = formInput1;
    var ofrmcampo2 = formInput2;
	if (ofrmcampo1.value == 2){
        alert('Este login no esta disponible debe introducir otro login');
		ofrmcampo2.style.borderColor= 'Red';
        ofrmcampo2.focus();
		resultado = false;
	}else if (ofrmcampo1.value == ""){
        alert('Debe verificar si el login esta disponible');
        ofrmcampo2.focus();
		resultado = false;
    }
	return resultado;
}
function compararPassword(formInput1, formInput2){
    var resultado = true;
	var ofrmcampo1 = formInput1;
    var ofrmcampo2 = formInput2;
	if (ofrmcampo1.value != ofrmcampo2.value){
        alert('Los password no son iguales');
        ofrmcampo1.style.borderColor= 'Red';
		ofrmcampo2.style.borderColor= 'Red';
        ofrmcampo2.focus();
		resultado = false;
	}
	return resultado;
}
function validaLongitud(formInput,campo,cantidad){
	var resultado = true;
	var ofrmcampo = formInput;
	if (ofrmcampo.value.length >= cantidad){
		alert('Ha excedido la longitud maxima de caracteres para el campo ' + campo +'.');
		ofrmcampo.focus();
		resultado = false;
	}
	return resultado;
}

function campoAsunto(formInput,campo){
    var resultado = true;
	var ofrmcampo = formInput;
    ofrmcampo.value = ofrmcampo.value.replace(/^\s*|\s*$/g,"");
    var valor = ofrmcampo.value.toLowerCase();
	if (valor == "en el texto"){
        alert('Debe introducir un valor diferente en el ' + campo +'.');
		ofrmcampo.style.borderColor= 'Red';
        ofrmcampo.focus();
		resultado = false;
	}
	return resultado;
}

function passwordDiffZero(formInput){
    var resultado = true;
	var ofrmcampo = formInput;
	if ((ofrmcampo.value == "0000")){
        alert('Por favor introduzca un valor diferente de \'0000\'');
		ofrmcampo.style.borderColor= 'Red';
         ofrmcampo.focus();
		resultado = false;
	}
	return resultado;
}

function mueveReloj(im){
    var m="am";

    momentoActual = new Date();

    hora = momentoActual.getHours();

    minuto = momentoActual.getMinutes();

    segundo = momentoActual.getSeconds();



    if(hora==12){

        m="pm";

    }

    if(hora==13){

        hora="0"+1;

        m="pm";

    }

    if(hora==14){

        hora="0"+2;

        m="pm";

    }

    if(hora==15){

        hora="0"+3;

        m="pm";

    }

    if(hora==16){

        hora="0"+4;

        m="pm";

    }

    if(hora==17){

        hora="0"+5;

        m="pm";

    }

    if(hora==18){

        hora="0"+6;

        m="pm";

    }

    if(hora==19){

        hora="0"+7;

        m="pm";

    }

    if(hora==20){

        hora="0"+8;

        m="pm";

    }

    if(hora==21){

        hora="0"+9;

        M="pm";

    }

    if(hora==22){

        hora=10;

        m="pm";

    }

    if(hora==23){

        hora=11;

        m="pm";

    }

    if((hora==0)||(hora==24)){

        hora=12;

        m="am";

    }



    str_segundo = new String (segundo)

    if (str_segundo.length == 1)

        segundo = "0" + segundo;



    str_minuto = new String (minuto)

    if (str_minuto.length == 1)

        minuto = "0" + minuto;



    str_hora = new String (hora)

    if (str_hora.length == 1)

        hora = "0" + hora;



    horaImprimible = hora + ":" + minuto + ":" + segundo+" "+m;



    if (im==1){

        //document.getElementById('reloj').innerHTML = "<img src='imagenes/design/flag_ve.gif'>&nbsp;&nbsp;" + horaImprimible;

        document.getElementById('reloj').innerHTML = horaImprimible;

        setTimeout("mueveReloj(1)",1000);

    }

    else{

        document.getElementById('reloj').innerHTML = horaImprimible;

        setTimeout("mueveReloj(0)",1000);

    }





}