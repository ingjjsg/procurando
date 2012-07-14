<?php
    session_start();
    require_once '../modelo/clCrearMenu.php';
    require_once '../modelo/clConstantesModelo.php';

    function crearMenu($id_usuario,$sistema)
    {
        $html= "";
        $htmlpadre="";
        $htmltotal="";
        $data= "";
   	    $modulos=array();
   	    $modulo_padre=array();
   	    $link_modulo=array();
        $crearmenu= new clCrearMenu();
        $modulos_padres=$sistema;
        /*obtengo todos los formularios asignados al usuario*/
        $formulariosasignados= $crearmenu->obtenerMenuAsignadoUsuario($id_usuario);
        /*obtengo todos los formularios asignados de los modulos padres*/
        if($formulariosasignados)
        {
        	$modulosasignados = array();
        	$j=0;
	        while ($j<count($formulariosasignados))
	        {
	        	$modulosasignados[]= $formulariosasignados[$j]['id_menu_maestro'];
	          $j++;
	        }
   		$modulos_permitidos=array_unique($modulosasignados);
        	foreach ($modulos_padres as $padre)
                {
		  $modulos=$crearmenu->Verificar_hijos($padre);
                      if (count($modulos)>0)
                      {
    	               // $htmlpadre='<div class="menu_enlaces">';
	                $htmlpadre='<div id="titulo_interno_masgrande" class="menu_enlaces_titulo" >';
	                $modulo_padre=$crearmenu->Descripcion_modulo($padre);
                          $htmlpadre.='<p><img width="14" height="16" alt="" src="imagenes/menu_enlaces_titulo_vineta.png"/>';
	                    $htmlpadre.=strtoupper($modulo_padre[0]['stritema']);
	                    $htmlpadre.='</p>';
	                $htmlpadre.='</div>';


        		$i=0;
                        $entro=false;
		        while ($i<count($modulos))
		        {
           		if (in_array($modulos[$i]['lngnumero'], $modulos_permitidos))
           		{
                        $entro=true;
                        $link_modulo=$crearmenu->Descripcion_modulo($modulos[$i]['lngnumero']);
                        //print_r($link_modulo);
                        $html.='<div class="menu_enlaces_texto"">';
                        //$html.="<h1>SUB TÍTULO</h1>";
                        $html.="<ul>";
                  	    $html.= "<li><a href='".clConstantesModelo::rutavista.$link_modulo[0]['stritemc']."' target='contenido'>".$modulos[$i]['stritema']. "</a></li>";
                        $html.='</ul></div><div class="menu_izq_superior"> </div>';
           		    }
		          $i++;
		        }//while
                        if ($entro)
                          {
                           $htmltotal=$htmltotal.$htmlpadre.$html;
                          }//if entro
		        $htmltotal.='<br>';
 			}//foreach
 	        //    $htmltotal.='</div>';
                    $htmltotal.='<div class="menu_izq_inferior">&nbsp;</div>';
                    $html="";
                    $htmlpadre="";
            }
        }
        return $htmltotal;
    }


?>