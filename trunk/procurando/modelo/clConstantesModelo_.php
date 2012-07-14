<?php
class clConstantesModelo {

  const id = 'POSTGRES';

  // esquemas
  const siembra_table='public.';
  const seguridad_table='public.';
  const public_table='public.';
  const siembraweb_table='public.';
  const scsd_table='public.';
  const cne_table='public.';
  const correspondencia_table='public.';

  const administrador_scsd="12088";
  const organismos_yaracuy="12003";

  const bdname = saris;
  const host = 'localhost';
  const user = postgres;
  const password = postgres;
  const puerto = 5432;



    //form naturales
  

  //FORM MAESTRO OPERACIONES PROYECTO
  const maestro_operaciones_controlador='12334';
  public static function acciones_maestro_operaciones_controlador() {return array('S' => '12335', 'R' => '12661', 'A' => '12662');}

  //form maestros
  const maestro_controlador='12137';
  public static function acciones_maestro_controlador() {return array('N' => '12143', 'U' => '12144', 'D' => '12145', 'V' => '12354');}

  //form perfiles
  const perfiles_controlador='12087';
  const form_perfiles_controlador='12139';
  public static function acciones_perfiles_controlador() {return array('N' => '12149', 'U' => '12150', 'D' => '12151', 'AP' => '12357', 'AE' => '12358', 'V' => '12359');}


  //form modelos
  const modelos_controlador='12142';
  const modelos_controlador_constantes='6';

  public static function acciones_modelos_controlador() {return array('N' => '12158', 'U' => '12159', 'D' => '12160');}
  public static function acciones_modelos_estados_hijos_controlador() {return array('AE' => '12350', 'NE' => '12351', 'DE' => '12352', 'UE' => '12352');}

  //form contacto
  const contacto_controlador='12138';
  public static function acciones_contactos_controlador() {return array('N' => '12146', 'U' => '12147', 'D' => '12148', 'V' => '12355', 'CC' => '12356');}

  //form naturales
  const form_comite='12137';
  const cierre_comite='12453';
  public static function acciones_comite_controlador() {return array('N' => '12143', 'U' => '12144', 'D' => '12145', 'V' => '12354');}



  //form asignar
  const asignar_controlador='12136';

  //form proyecto
  const estatus_proyecto='12336';

  //constantes del sistema
  const maestro_combos=0;
  const interno='12171';
  const maestro='12082';
  const usuarios='12083';
  const perfiles='12084';
  const modeloestados='6';
  const departamentos='12898';
  const personanatural='12278';
  const firmapersonal='12279';
  const companiaanomima='12280';
  const sociedadmercantil='12281';
  const cooperativas='12282';
  const fundaciones='12283';
  const alcaldias='12284';
  const padreMenu="12002";
  const padreruta= 12117;
  const rutavista="../vista/";
  const rutaiconomenu='../comunes/images/';
  const rutaarchivo='/tmp/';
  const rutaimagen='../comunes/uploads/';
  const rutaarchivosaris = '/home/jorge/www/saris/memoria_fotografica/';
  const numeroderegistros='20';
  const numerodepaginador='15';
  //public static function ModulosPadres() {return array('12174','12307','12134', '12626');}
  public static function ModulosPadres() {return array('289','294','12912','295','291');}
  public static function ModulosCorrespondencia() {return array('289','294');}  
  public static function ModulosOAS() {return array('12912','13291');}  
  public static function ModulosAgenda() {return array('13226','13228');}    
  public static function ModulosSeguridad() {return array('295');}      
  public static function ModulosDocumentos() {return array('13267','13287');}        
  public static function ModulosLitigio() {return array('13229');}        
  const bancos='12194';
  const tipo_solicitantes ='12201';
  const prioridad = '12123';
  const medidas_tiempo = '29';
  const clasificacion_proyectos = '12209';
  const tipo_proyectos = '30';
  const iva = '12266';
  const estatusempresaactiva='0';
  const tipooperacionespago='12270';
  const primer_estatus_proyecto = '12293';
  const unidad_meta = '10999';
  //public static function Condicionales() {return array("Menor que" => "<","Igual que" =>"=","Diferente de"=>"<>","Mayor que"=>">","Que Contenga" => "like","Empiece por" => "like-","Termine en" => "-like");}
  public static function Condicionales() {return array("Igual que" =>"=","Que Contenga" => "like");}
  //tipos de empresa
  public static function Condicionales_maestro_operaciones() {return array("Que Contenga" => "like");}
  //formulas
  const formulapersonanatural='12286';
  const formulafirmapersonal='12287';
  const formulacompaniaanomima='12288';
  const formulasociedadmercantil='12289';
  const formulacooperativas='12290';
  const formulafundaciones='12291';
  //
  const estatusvaluacion='12300';
  const estatusordenenadmon='12301';
  const estatusordenpagada='12302';
  const estatusordenrecibidabanco='12303';
  const estatusingresadosaris = '12306';
  const regimen_cerrado=13103;  
  const buscar_expediente='13221';    
  const buscar_persona='13260';    
  const buscar_refiere='13225';      
  // contratos
  const obras='12313';
  const inspeccion = '12314';
  // prioridades
  const prioridad_alta='13205';
  const prioridad_media='13213';
  const prioridad_baja='13206';  


	const IdMaestroProyecto = 104;
	const IdEstadoAsignarPreoyecto = 109;
	const IdEstadoSinAsignarPreoyecto = 107;

	const IdMaestroContrato = 11332;

        const IdMaestroValuacion = 11262;
        const IdEstadoAsignarValuacion = 11265;
	const IdEstadoSinAsignarValuacion = 11264;

        const IdMaestroPresupuestoModificado = 11241;
        const IdEstadoAsignarPresupuesto = 11234;
	const IdEstadoSinAsignarPresupuesto = 11233;

	public static function TiposDocumento(){ return array(self::IdMaestroProyecto,self::IdMaestroContrato,self::IdMaestroValuacion);}

	const IdMaestroTipoDocumento = 15;//12417;
	const IdMaestroEstadoDocumento= 253;//12443;
	const IdMaestroCategoriaDocumento = 19;//12422;

        public static function acciones_bandeja_revision(){return array(
            'ver' => '12835',
            'seguimiento' => '304',
            'editar'=>'305',
            'enviar_coordinador' => '306',
            'enviar_gerente' => '307',
            'enviar' => '308',
            'reenviar' => '309',
            'imprimir' => '310',
            'eliminar' => '311',
            'adjunto' => '312',
            'plantilla' => '313'

        );}

        public static function acciones_redactar(){return array(
            'redactar'=>'324',
            'ver'=>'12841',
            'modificar'=>'325',
            'enviar'=>'326',
            'enviar_revision'=>'327',
            'imprimir'=>'328',
            'plantilla'=>'329',
            'borrar'=>'330',
            'ver_adjunto'=>'331',
            'reenviar'=>'332',
            'adjuntar'=>'333'
        );}

        public static function acciones_actividades(){return array(
            'ver_todas_actividades'=>'334',
            'crear'=>'335',
            'asignar_actividades'=>'336',
            'asignar_analista'=>'337',
            'ver_mis_actividades'=>'338',
            'cerrar'=>'301'

        );}

        public static function acciones_bandeja_entrada(){return array(
            'ver'=>'293',
            'seguimiento'=>'296',
            'plantilla'=>'297',
            'adjunto'=>'298',
            'asignar'=>'299',
            'responder'=>'300',
            'cerrar'=>'301',
            'ver_actividades'=>'302',
            'imprimir'=>'303'
        );}

        public static function acciones_externos(){return array(
            'redactar'=>'340'
        );}

        public static function acciones_borradores(){return array(
            'ver'=>'12838',
            'seguimiento'=>'314',
            'editar'=>'315',
            'enviar_coordinador'=>'316',
            'enviar_gerente'=>'317',
            'enviar'=>'318',
            'reenviar'=>'319',
            'imprimir'=>'320',
            'eliminar'=>'321',
            'adjunto'=>'322',
            'plantilla'=>'323'
        );}

        public static function formularios(){return array(
            'bandeja_entrada'=>'292',
            'bandeja_revision'=>'12834',
            'borradores'=>'12837',
            'redactar'=>'12840',
            'actividades'=>'12843',
            'externos'=>'12846',
            'pendientes'=>'12849',
            'reportes'=>'12852',
            'clientes'=>'12953',
            'abogados'=>'12964',
            'abogados_contrarios'=>'12980'


                );
        }
        
        public static function acciones_clientes(){ return array(
            'ver' => '12954'
        );
        
        
        
        
        
        }
        
        public static function acciones_abogados(){ return array(
            'ver' => '12965'
        );
        }
        
        public static function acciones_abogados_contrarios(){ return array(
            'ver' => '12981',
            'guardar' => '12982',
            'editar' => '12983',
            'eliminar' => '12984'
        );
        }
        
        public static function combos(){return array(
            'estados'      => '12913',
            'estado_civil' => '12955',
            'sexo'         => '12960',
            'banco'         => '12966',
            'honorarios'         => '13008',
            'tipo_tramite'  => '13010',
            'actuacion'  => '13012',
            'tipo_organismo'  => '13015',
            'referencias_divorcio'  => '13098',            
            'regimen'  => '13101',                
            'citacion'  => '13110',              
            'ramo'  => '13110',            
            'tipo_minuta'  => '13023',
            'fase'  => '13131',            
            'municipio'  => '13141',       
            'actuaciones'  => '13162',
            'espacios'  => '13170',               
            'estado_fisico_expediente'  => '13173',
            'tipo_archivador'  => '13176',
            'piso_archivador'  => '13179',                
            'gaveta_archivador'  => '13183',
            'estados_minuta'  => '13189',
            'tipos_agenda'  => '13198',               
            'tipo_evento_agenda'  => '13201',
            'tipo_prioridad_agenda'  => '13204',
            'tipo_recordatorio_agenda'  => '13207',                
            'tipo_estado_agenda'  => '13210',
            'tipo_departamento_agenda'  => '12875',
            'tipo_refiere_agenda'  => '13222',

            'tipos_documento'  => '13198',               
            'tipo_evento_documento'  => '13201',
            'tipo_prioridad_documento'  => '13204',
            'tipo_recordatorio_documento'  => '13207',                
            'tipo_estado_documento'  => '13210',
            'tipo_departamento_documento'  => '12875',
            'tipo_refiere_documento'  => '13222'              
        );
        }
        
        public static function tipo_tramite(){
            return array(
              'divorcio' => '13009'  
            );
        }


        public static function acciones_abogados_honorarios(){ return array(
            'ver' => '12987',
            'guardar' => '12988',
            'editar' => '12989',
            'eliminar' => '12990'
        );
        }        

        
        public static function acciones_abogados_juzgado(){ return array(
            'ver' => '12993',
            'guardar' => '12994',
            'editar' => '12995',
            'eliminar' => '12996'
        );
        }
        


}
?>
