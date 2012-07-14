   function verificar_usuario()
   {
        if(document.form_login.login_.value == "")
        {
            alert('Debe ingresar un valor en el campo Usuario');
            var e = document.getElementById('login_');
            e.style.borderColor= 'Red';
            e.style.background= 'Bisque';
            e.focus();
            return false;
        }
        else if(document.form_login.password_.value == "")
        {
            alert('Debe ingresar un valor en el campo Password');
            var c = document.getElementById('password_');
            c.style.borderColor= 'Red';
            c.style.background= 'Bisque';
            c.focus();
            return false;
        }
        else
        {
              var pass=document.form_login.password_.value;
              var login=document.form_login.login_.value;
              xajax_verificarLogin(login,pass);
        }
    }

   function limpiar()
   {
        document.form_login.login_.value= "";
        document.form_login.password_.value="";

    }