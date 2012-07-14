/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

            
            
  function FloattoFloatVE(monto)
  {
    var val = monto.toString()
   // var expresion = /^(\d{1,3}\,)(\d{3,3}\,){1,10}(\.\d+)$/;
    var expresion = /^(\d{1,3}\,?){0,6}(\d{1,3})(\.\d{1,6})?$/;
    if(val.match(expresion)){
        //monto = redondeo2decimales(monto);
        //val = monto.toString();
        var numero = null;
        if(val.substring(val.length-3,val.length-2)!=',' && val.substring(val.length-2,val.length-1)!=',')
          {numero = val.gsub(/\,/,'');}
        else {
          numero = val.gsub(/\./,'');
          numero = numero.gsub(/\,/,'.');
        }
        numero = numero.split(/\./);
        var digitos = numero[0].length;
        var primer = digitos % 3;
        var miles = Math.ceil(digitos / 3);
        var i = 0;
        var floatve = '';
        for(var n=0;n<miles;n++) {
          if(n==0){
            if(primer==0){
              floatve = floatve + numero[0].substring(0,3);
              i += 3;
            }
            else{
              floatve = floatve + numero[0].substring(0,primer);
              i += primer;
            }
          }
          else{
            floatve = floatve + numero[0].substring(i,i+3);
            i += 3;
          }
          if(n!=(miles-1)) floatve = floatve + '.';
        }
        floatve = floatve + ',';
        if (numero.length>1) floatve = floatve + numero[1].substring(0,3);
        else floatve = floatve + '00';
        return floatve;
    }else {
      if(ValidarNumeroV2VE_(val)) return val; else return '0,00';
    }
  }