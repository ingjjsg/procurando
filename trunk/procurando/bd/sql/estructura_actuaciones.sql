CREATE TABLE tblactuaciones
(
  id_proactuacion serial NOT NULL,
  id_proclientecasos integer DEFAULT 0,
  id_proabogadoscasos integer DEFAULT 0,
  id_documentoscasos integer DEFAULT 0,
  id_usuario integer DEFAULT 0,
  id_ano integer DEFAULT 0,
  id_materia integer DEFAULT 0,
  id_estatus integer DEFAULT 0,
  strnroexpediente text,
  strtitulo text,
  strdescripcion text,
  id_refer integer DEFAULT 0,
  fecapertura timestamp with time zone,
  feccierre timestamp with time zone,
  bolborrado integer DEFAULT 0,
  strletrado text,
  id_actuacion integer DEFAULT 0,
  id_honorario integer DEFAULT 0,
  id_tipo_tramite integer DEFAULT 0,
  id_tipo_atencion integer DEFAULT 0,
  id_tipo_organismo integer DEFAULT 0,
  id_organismo integer DEFAULT 0,
  id_tipo_minuta integer DEFAULT 0,
  id_minuta integer DEFAULT 0,
  strobservacion text,
  fecexpediente timestamp with time zone,
  strdireccion_asistido text,
  strdireccion_conyugue text,
  strdireccion_ultimo_domicilio text,
  fecseparacion date,
  intmonto_manutencion numeric DEFAULT 0,
  id_regimen integer DEFAULT 0,
  strdias text,
  strhoras text,
  intcuotames1 numeric DEFAULT 0,
  intcuotames2 numeric DEFAULT 0,
  cedula_abogado_responsable text,
  cedula_abogado_ejecutor text,
  cedula_cliente text,
  strdocumentos text,
  cedula_conyugue text,
  id_citacion integer,
  strobservacion_cerrar text,
  strnroexpedienteauxiliar character varying(100),
  strrepresentante character(1),
  id_estado_fisico_expediente integer DEFAULT 0,
  id_tipo_espacio integer DEFAULT 0,
  id_tipo_archivador integer DEFAULT 0,
  id_tipo_piso_archivador integer DEFAULT 0,
  id_tipo_archivador_gaveta integer DEFAULT 0,
  id_abogado_resp integer,
  id_abogado_ejecutor integer,
  id_solicitante integer,
  id_contrarios integer,
  CONSTRAINT pk_tblproactuaciones PRIMARY KEY (id_proactuacion)
);


CREATE TABLE tblactuacion_situaciones
(
  id_proactuacion_situacion serial NOT NULL,
  id_tipo_minuta integer DEFAULT 0,
  id_minuta integer DEFAULT 0,
  strobservacion text,
  id_proactuacion integer DEFAULT 0,
  fecminuta date,
  bolborrado integer DEFAULT 0,
  id_estado_minuta integer,
  CONSTRAINT pk_id_proactuacion_situaciones PRIMARY KEY (id_proactuacion_situacion),
  CONSTRAINT fk_id_proactuacion FOREIGN KEY (id_proactuacion)
      REFERENCES tblactuaciones (id_proactuacion) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE tblactuacion_fases
(
  id_proactuacion_fase integer NOT NULL DEFAULT nextval('tblproactuacion_fases_id_proactuacion_fase_seq'::regclass),
  id_tipo_fase integer DEFAULT 0,
  id_fase integer DEFAULT 0,
  strobservacion text,
  id_proactuacion integer DEFAULT 0,
  fecfase date,
  bolborrado integer DEFAULT 0,
  CONSTRAINT pk_id_proactuacion_fase PRIMARY KEY (id_proactuacion_fase),
  CONSTRAINT fk_id_proactuacion FOREIGN KEY (id_proactuacion)
      REFERENCES tblactuaciones (id_proactuacion) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)

