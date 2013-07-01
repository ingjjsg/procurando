--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.tblnotas DROP CONSTRAINT fk_tblmaestros_tiponota;
ALTER TABLE ONLY public.tbldestinatarios DROP CONSTRAINT fk_tblmaestros_tipoenvio;
ALTER TABLE ONLY public.tblcorrespondencias DROP CONSTRAINT fk_tblmaestros_tipocorresp;
ALTER TABLE ONLY public.tblcorrespondencias DROP CONSTRAINT fk_tblmaestros_tipo;
ALTER TABLE ONLY public.tblcorrelativo DROP CONSTRAINT fk_tblmaestros_tipo;
ALTER TABLE ONLY public.tblcontacto DROP CONSTRAINT fk_tblmaestros_tipo;
ALTER TABLE ONLY public.tblcontactoprofile DROP CONSTRAINT fk_tblmaestros_profile;
ALTER TABLE ONLY public.tblactividades DROP CONSTRAINT fk_tblmaestros_prioridad;
ALTER TABLE ONLY public.tbldestinatarios DROP CONSTRAINT fk_tblmaestros_gerencia;
ALTER TABLE ONLY public.tblcorrelativo DROP CONSTRAINT fk_tblmaestros_gerencia;
ALTER TABLE ONLY public.tblrutaactividad DROP CONSTRAINT fk_tblmaestros_estatus;
ALTER TABLE ONLY public.tblactividades DROP CONSTRAINT fk_tblmaestros_estatus;
ALTER TABLE ONLY public.tblrutacorresp DROP CONSTRAINT fk_tblmaestros_estatus;
ALTER TABLE ONLY public.tbldestinatarios DROP CONSTRAINT fk_tblmaestros_estatus;
ALTER TABLE ONLY public.tblcorrespondencias DROP CONSTRAINT fk_tblmaestros_estatus;
ALTER TABLE ONLY public.tblcontacto DROP CONSTRAINT fk_tblmaestros_estatus;
ALTER TABLE ONLY public.tblcorrespondencias DROP CONSTRAINT fk_tblmaestros_dpto;
ALTER TABLE ONLY public.tblcontacto DROP CONSTRAINT fk_tblmaestros_cargo;
ALTER TABLE ONLY public.tbldepartamentoactividad DROP CONSTRAINT fk_tblmaestros;
ALTER TABLE ONLY public.tblaccesoforma DROP CONSTRAINT fk_tblmaestro_profile;
ALTER TABLE ONLY public.tblaccesoforma DROP CONSTRAINT fk_tblmaestro_menu;
ALTER TABLE ONLY public.tblactividades DROP CONSTRAINT fk_tbldestinatarios;
ALTER TABLE ONLY public.tbladjunto DROP CONSTRAINT fk_tblcorrespondencias;
ALTER TABLE ONLY public.tblnotas DROP CONSTRAINT fk_tblcorrespondencias;
ALTER TABLE ONLY public.tblrutacorresp DROP CONSTRAINT fk_tblcorrespondencias;
ALTER TABLE ONLY public.tblfirmaautorizada DROP CONSTRAINT fk_tblcorrespondencias;
ALTER TABLE ONLY public.tbldestinatarios DROP CONSTRAINT fk_tblcorrespondencias;
ALTER TABLE ONLY public.tblvalidacion DROP CONSTRAINT fk_tblcorrespondencia;
ALTER TABLE ONLY public.tbldetallecontactoactividad DROP CONSTRAINT fk_tblcontactoactividad;
ALTER TABLE ONLY public.tblcontactoactividad DROP CONSTRAINT fk_tblcontacto_asigna;
ALTER TABLE ONLY public.tblvalidacion DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblcontactoactividad DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblrutaactividad DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblnotas DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblrutacorresp DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblfirmaautorizada DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblcorrespondencias DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblcontactoprofile DROP CONSTRAINT fk_tblcontacto;
ALTER TABLE ONLY public.tblautorizado_est DROP CONSTRAINT fk_tblautorizado_perfil_maestro;
ALTER TABLE ONLY public.tblautorizado_est DROP CONSTRAINT fk_tblautorizado_estados;
ALTER TABLE ONLY public.tbladjunto_documento DROP CONSTRAINT fk_tblactuaciones;
ALTER TABLE ONLY public.tbldepartamentoactividad DROP CONSTRAINT fk_tblactividades;
ALTER TABLE ONLY public.tbladjunto DROP CONSTRAINT fk_tblactividades;
ALTER TABLE ONLY public.tblcontactoactividad DROP CONSTRAINT fk_tblactividades;
ALTER TABLE ONLY public.tblrutaactividad DROP CONSTRAINT fk_tblactividades;
ALTER TABLE ONLY public.tblnotas DROP CONSTRAINT fk_tblactividades;
ALTER TABLE ONLY public.tblestados DROP CONSTRAINT fk_meestados_maestros;
ALTER TABLE ONLY public.tblproexpediente_personas_demandadas DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_abogados_representantes DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_abogados_ejecutores DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_abogados_demandantes DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_abogados DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_actuaciones DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_fases DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproexpediente_situaciones DROP CONSTRAINT fk_id_proexpediente;
ALTER TABLE ONLY public.tblproactuaciones_litigio DROP CONSTRAINT fk_id_proactuacion;
ALTER TABLE ONLY public.tblactuacion_situaciones DROP CONSTRAINT fk_id_proactuacion;
ALTER TABLE ONLY public.tblactuacion_fases DROP CONSTRAINT fk_id_proactuacion;
ALTER TABLE ONLY public.tblestados DROP CONSTRAINT fk_estinicial_maestros;
ALTER TABLE ONLY public.tblestados DROP CONSTRAINT fk_estfinal_maestros;
ALTER TABLE ONLY public.tblvalidacion DROP CONSTRAINT pk_validacion;
ALTER TABLE ONLY public.tblrutacorresp DROP CONSTRAINT pk_tblrutacorresp;
ALTER TABLE ONLY public.tblrutaactividad DROP CONSTRAINT pk_tblruta;
ALTER TABLE ONLY public.tblproexpediente_abogados_representantes DROP CONSTRAINT pk_tblproexpediente_abogados_representantes;
ALTER TABLE ONLY public.tblproexpediente_abogados_ejecutores DROP CONSTRAINT pk_tblproexpediente_abogados_ejecutores;
ALTER TABLE ONLY public.tblproexpediente_abogados_demandantes DROP CONSTRAINT pk_tblproexpediente_abogados_demandantes;
ALTER TABLE ONLY public.tblproexpediente_abogados DROP CONSTRAINT pk_tblproexpediente_abogados;
ALTER TABLE ONLY public.tblproexpediente DROP CONSTRAINT pk_tblproexpediente;
ALTER TABLE ONLY public.tblproclientecasos DROP CONSTRAINT pk_tblproclientecasos;
ALTER TABLE ONLY public.tblactuaciones DROP CONSTRAINT pk_tblproactuaciones;
ALTER TABLE ONLY public.tblnotas DROP CONSTRAINT pk_tblnotas;
ALTER TABLE ONLY public.tblmaestros_sistemas DROP CONSTRAINT pk_tblmaestros_sistemas;
ALTER TABLE ONLY public.tblmaestros DROP CONSTRAINT pk_tblmaestros;
ALTER TABLE ONLY public.tblfirmaautorizada DROP CONSTRAINT pk_tblfirmaautorizada;
ALTER TABLE ONLY public.tbl_expediente_referidos DROP CONSTRAINT pk_tblexpediente_referido;
ALTER TABLE ONLY public.tblestados DROP CONSTRAINT pk_tblestados;
ALTER TABLE ONLY public.tbldetallecontactoactividad DROP CONSTRAINT pk_tbldetallecontactoactividad;
ALTER TABLE ONLY public.tbldestinatarios DROP CONSTRAINT pk_tbldestinatarios;
ALTER TABLE ONLY public.tbldepartamentoactividad DROP CONSTRAINT pk_tbldepartamentoactividad;
ALTER TABLE ONLY public.tbl_demandantes DROP CONSTRAINT pk_tbldemandantes;
ALTER TABLE ONLY public.tblcorrespondencias DROP CONSTRAINT pk_tblcorrespondencias;
ALTER TABLE ONLY public.tblcorrelativo DROP CONSTRAINT pk_tblcorrelativo;
ALTER TABLE ONLY public.tblcontactoprofile DROP CONSTRAINT pk_tblcontactoprofile;
ALTER TABLE ONLY public.tblcontactoactividad DROP CONSTRAINT pk_tblcontactoactividad;
ALTER TABLE ONLY public.tblcontacto DROP CONSTRAINT pk_tblcontacto;
ALTER TABLE ONLY public.tblautorizado_est DROP CONSTRAINT pk_tblautorizado_est;
ALTER TABLE ONLY public.tblasociaciones DROP CONSTRAINT pk_tblasociaciones;
ALTER TABLE ONLY public.tbladjunto_documento DROP CONSTRAINT pk_tbladjunto_documento;
ALTER TABLE ONLY public.tbladjunto DROP CONSTRAINT pk_tbladjunto;
ALTER TABLE ONLY public.tblactividades DROP CONSTRAINT pk_tblactividades;
ALTER TABLE ONLY public.tblaccesoforma DROP CONSTRAINT pk_tblaccesoforma;
ALTER TABLE ONLY public.tbl_contrarios DROP CONSTRAINT pk_tbl_contrarios;
ALTER TABLE ONLY public.tbl_abogados_representantes DROP CONSTRAINT pk_tbl_abogados_representantes;
ALTER TABLE ONLY public.tbl_abogados_contrarios DROP CONSTRAINT pk_tbl_abogados_contrarios;
ALTER TABLE ONLY public.tblproexpediente_personas_demandadas DROP CONSTRAINT pk_proexpediente_personas_demandadas;
ALTER TABLE ONLY public.tbl_clientes DROP CONSTRAINT pk_proclientes;
ALTER TABLE ONLY public.tblproabogadoscasos DROP CONSTRAINT pk_proabogadoscasos;
ALTER TABLE ONLY public.tblunidadtributaria DROP CONSTRAINT pk_id_unidad;
ALTER TABLE ONLY public.tblproexpediente_situaciones DROP CONSTRAINT pk_id_proexpediente_situaciones;
ALTER TABLE ONLY public.tblproexpediente_fases DROP CONSTRAINT pk_id_proexpediente_fase;
ALTER TABLE ONLY public.tblproexpediente_actuaciones DROP CONSTRAINT pk_id_proexpediente_actuaciones;
ALTER TABLE ONLY public.tblproactuaciones DROP CONSTRAINT pk_id_proactuaciones;
ALTER TABLE ONLY public.tblactuacion_situaciones DROP CONSTRAINT pk_id_proactuacion_situaciones;
ALTER TABLE ONLY public.tblactuacion_fases DROP CONSTRAINT pk_id_proactuacion_fase;
ALTER TABLE ONLY public.tblproactuaciones_litigio DROP CONSTRAINT pk_id_litigio_actuaciones;
ALTER TABLE ONLY public.tblprojuzgados DROP CONSTRAINT pk_id_jusgados;
ALTER TABLE ONLY public.tblprohonorarios_litigio DROP CONSTRAINT pk_id_honorarios_litigio;
ALTER TABLE ONLY public.tblprohonorarios DROP CONSTRAINT pk_id_honorarios;
ALTER TABLE ONLY public.tblproexpediente_hijos DROP CONSTRAINT pk_id_hijos;
ALTER TABLE ONLY public.tbldocumento_seguimiento DROP CONSTRAINT pk_id_documento_seguimiento;
ALTER TABLE ONLY public.tbldocumento DROP CONSTRAINT pk_id_documento;
ALTER TABLE ONLY public.tbldictamenes DROP CONSTRAINT pk_id_dictamen;
ALTER TABLE ONLY public.tblagenda_litigio DROP CONSTRAINT pk_id_agenda_litigio;
ALTER TABLE ONLY public.tblagenda DROP CONSTRAINT pk_id_agenda;
ALTER TABLE ONLY public.tblcontactoexterno DROP CONSTRAINT pk_contacto_externo;
ALTER TABLE ONLY public.tbl_abogados DROP CONSTRAINT pd_tbl_abogados;
ALTER TABLE public.tblunidadtributaria ALTER COLUMN id_unidad DROP DEFAULT;
ALTER TABLE public.tblprojuzgados ALTER COLUMN id_juzgados DROP DEFAULT;
ALTER TABLE public.tblprohonorarios_litigio ALTER COLUMN id_honorarios DROP DEFAULT;
ALTER TABLE public.tblprohonorarios ALTER COLUMN id_honorarios DROP DEFAULT;
ALTER TABLE public.tblproexpediente_situaciones ALTER COLUMN id_proexpediente_situacion DROP DEFAULT;
ALTER TABLE public.tblproexpediente_personas_demandadas ALTER COLUMN id_proexpediente_personas_demandadas DROP DEFAULT;
ALTER TABLE public.tblproexpediente_hijos ALTER COLUMN id_hijos DROP DEFAULT;
ALTER TABLE public.tblproexpediente_fases ALTER COLUMN id_proexpediente_fase DROP DEFAULT;
ALTER TABLE public.tblproexpediente_actuaciones ALTER COLUMN id_proexpediente_actuaciones DROP DEFAULT;
ALTER TABLE public.tblproexpediente_abogados_representantes ALTER COLUMN id_proexpediente_abogados_representantes DROP DEFAULT;
ALTER TABLE public.tblproexpediente_abogados_ejecutores ALTER COLUMN id_proexpediente_abogados_ejecutores DROP DEFAULT;
ALTER TABLE public.tblproexpediente_abogados_demandantes ALTER COLUMN id_proexpediente_abogados_demandantes DROP DEFAULT;
ALTER TABLE public.tblproexpediente_abogados ALTER COLUMN id_proexpediente_abogados DROP DEFAULT;
ALTER TABLE public.tblproexpediente ALTER COLUMN id_proexpediente DROP DEFAULT;
ALTER TABLE public.tblproclientecasos ALTER COLUMN id_proclientecasos DROP DEFAULT;
ALTER TABLE public.tblproactuaciones_litigio ALTER COLUMN id_litigio_actuaciones DROP DEFAULT;
ALTER TABLE public.tblproactuaciones ALTER COLUMN id_proactuaciones DROP DEFAULT;
ALTER TABLE public.tblproabogadoscasos ALTER COLUMN id_proabogadoscasos DROP DEFAULT;
ALTER TABLE public.tblmaestros_sistemas ALTER COLUMN id_maestro DROP DEFAULT;
ALTER TABLE public.tbldocumento_seguimiento ALTER COLUMN id_documento_seguimiento DROP DEFAULT;
ALTER TABLE public.tbldocumento ALTER COLUMN id_documento DROP DEFAULT;
ALTER TABLE public.tbldictamenes ALTER COLUMN id_dictamen DROP DEFAULT;
ALTER TABLE public.tblasociaciones ALTER COLUMN lngcodigo_asociacion DROP DEFAULT;
ALTER TABLE public.tblagenda_litigio ALTER COLUMN id_agenda DROP DEFAULT;
ALTER TABLE public.tblagenda ALTER COLUMN id_agenda DROP DEFAULT;
ALTER TABLE public.tbladjunto_documento ALTER COLUMN id_adjunto DROP DEFAULT;
ALTER TABLE public.tblactuaciones ALTER COLUMN id_proactuacion DROP DEFAULT;
ALTER TABLE public.tblactuacion_situaciones ALTER COLUMN id_proactuacion_situacion DROP DEFAULT;
ALTER TABLE public.tblactuacion_fases ALTER COLUMN id_proactuacion_fase DROP DEFAULT;
ALTER TABLE public.tbl_expediente_referidos ALTER COLUMN lngcodigo DROP DEFAULT;
ALTER TABLE public.tbl_demandantes ALTER COLUMN lngcodigo DROP DEFAULT;
ALTER TABLE public.tbl_contrarios ALTER COLUMN id_contrarios DROP DEFAULT;
ALTER TABLE public.tbl_clientes ALTER COLUMN id_cliente DROP DEFAULT;
ALTER TABLE public.tbl_abogados_representantes ALTER COLUMN id_abogado DROP DEFAULT;
ALTER TABLE public.tbl_abogados_contrarios ALTER COLUMN id_abogadoscon DROP DEFAULT;
ALTER TABLE public.tbl_abogados ALTER COLUMN id_abogado DROP DEFAULT;
DROP VIEW public.vista_tblproexpediente_fases;
DROP VIEW public.vista_tblproexpediente;
DROP VIEW public.vista_movimiento_documentos;
DROP VIEW public.vista_honorarios_tramites_cargados;
DROP VIEW public.vista_honorarios_cargados;
DROP VIEW public.vista_agenda;
DROP VIEW public.vista_abogados_casos_litigios_cargados_total;
DROP VIEW public.vista_abogados_casos_litigio_cargados;
DROP VIEW public.vista_abogados_casos_cargados_total;
DROP VIEW public.vista_abogados_casos_cargados;
DROP TABLE public.tblvalidacion;
DROP SEQUENCE public.tblvalidacion_id_validacion_seq;
DROP SEQUENCE public.tblunidadtributaria_id_unidad_seq;
DROP TABLE public.tblunidadtributaria;
DROP TABLE public.tblrutacorresp;
DROP SEQUENCE public.tblrutacorresp_id_rutacorresp_seq;
DROP TABLE public.tblrutaactividad;
DROP SEQUENCE public.tblrutaactividad_id_ruta_seq;
DROP SEQUENCE public.tblprojuzgados_id_juzgados_seq;
DROP TABLE public.tblprojuzgados;
DROP SEQUENCE public.tblprohonorarios_litigio_id_honorarios_seq;
DROP TABLE public.tblprohonorarios_litigio;
DROP SEQUENCE public.tblprohonorarios_id_honorarios_seq;
DROP TABLE public.tblprohonorarios;
DROP SEQUENCE public.tblproexpediente_situaciones_id_proexpediente_situacion_seq;
DROP TABLE public.tblproexpediente_situaciones;
DROP SEQUENCE public.tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq;
DROP TABLE public.tblproexpediente_personas_demandadas;
DROP SEQUENCE public.tblproexpediente_id_proexpediente_seq;
DROP SEQUENCE public.tblproexpediente_hijos_id_hijos_seq;
DROP TABLE public.tblproexpediente_hijos;
DROP SEQUENCE public.tblproexpediente_fases_id_proexpediente_fase_seq;
DROP TABLE public.tblproexpediente_fases;
DROP SEQUENCE public.tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq;
DROP TABLE public.tblproexpediente_actuaciones;
DROP SEQUENCE public.tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq;
DROP TABLE public.tblproexpediente_abogados_representantes;
DROP SEQUENCE public.tblproexpediente_abogados_id_proexpediente_abogados_seq;
DROP SEQUENCE public.tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq;
DROP TABLE public.tblproexpediente_abogados_ejecutores;
DROP SEQUENCE public.tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq;
DROP TABLE public.tblproexpediente_abogados_demandantes;
DROP TABLE public.tblproexpediente_abogados;
DROP SEQUENCE public.tblproclientecasos_id_proclientecasos_seq;
DROP TABLE public.tblproclientecasos;
DROP SEQUENCE public.tblproactuaciones_litigio_id_litigio_actuaciones_seq;
DROP TABLE public.tblproactuaciones_litigio;
DROP SEQUENCE public.tblproactuaciones_id_proactuaciones_seq;
DROP TABLE public.tblproactuaciones;
DROP SEQUENCE public.tblproabogadoscasos_id_proabogadoscasos_seq;
DROP TABLE public.tblproabogadoscasos;
DROP TABLE public.tblnotas;
DROP SEQUENCE public.tblnotas_id_notas_seq;
DROP VIEW public.tblmaestros_vista;
DROP SEQUENCE public.tblmaestros_sistemas_id_maestro_seq;
DROP TABLE public.tblmaestros_sistemas;
DROP TABLE public.tblmaestros;
DROP SEQUENCE public.tblmaestros_id_maestro_seq;
DROP TABLE public.tblfirmaautorizada;
DROP SEQUENCE public.tblfirmaautorizada_id_firma_seq;
DROP TABLE public.tblestados;
DROP SEQUENCE public.tblestados_id_estados_seq;
DROP SEQUENCE public.tbldocumento_seguimiento_id_documento_seguimiento_seq;
DROP TABLE public.tbldocumento_seguimiento;
DROP SEQUENCE public.tbldocumento_id_documento_seq;
DROP SEQUENCE public.tbldictamenes_id_dictamen_seq;
DROP TABLE public.tbldictamenes;
DROP TABLE public.tbldetallecontactoactividad;
DROP SEQUENCE public.tbldetallecontactoactividad_id_detallecontactoactividad_seq;
DROP TABLE public.tbldestinatarios;
DROP SEQUENCE public.tbldestinatarios_id_destinatarios_seq;
DROP TABLE public.tbldepartamentoactividad;
DROP SEQUENCE public.tbldepartamentoactividad_id_departamentoactividad_seq;
DROP TABLE public.tblcorrespondencias;
DROP SEQUENCE public.tblcorrespondencias_id_corresp_seq;
DROP TABLE public.tblcorrelativo;
DROP SEQUENCE public.tblcorrelativo_id_correlativo_seq;
DROP TABLE public.tblcontactoprofile;
DROP SEQUENCE public.tblcontactoprofile_id_contactoprofile_seq;
DROP TABLE public.tblcontactoexterno;
DROP TABLE public.tblcontactoactividad;
DROP SEQUENCE public.tblcontactoactividad_id_contactoactividad_seq;
DROP SEQUENCE public.tblcontacto_externo_id_contacto_externo_seq;
DROP TABLE public.tblcontacto;
DROP SEQUENCE public.tblcontacto_id_contacto_seq;
DROP TABLE public.tblautorizado_est;
DROP SEQUENCE public.tblautorizado_est_id_autorizados_est_seq;
DROP SEQUENCE public.tblasociaciones_lngcodigo_asociacion_seq;
DROP TABLE public.tblasociaciones;
DROP SEQUENCE public.tblagenda_litigio_id_agenda_seq;
DROP TABLE public.tblagenda_litigio;
DROP SEQUENCE public.tblagenda_id_agenda_seq;
DROP TABLE public.tblagenda;
DROP SEQUENCE public.tbladjunto_documento_id_adjunto_seq;
DROP TABLE public.tbladjunto_documento;
DROP TABLE public.tbladjunto;
DROP SEQUENCE public.tbladjunto_id_adjunto_seq;
DROP SEQUENCE public.tblactuaciones_id_proactuacion_seq;
DROP TABLE public.tblactuaciones;
DROP SEQUENCE public.tblactuacion_situaciones_id_proactuacion_situacion_seq;
DROP TABLE public.tblactuacion_situaciones;
DROP SEQUENCE public.tblactuacion_fases_id_proactuacion_fase_seq;
DROP TABLE public.tblactuacion_fases;
DROP TABLE public.tblactividades;
DROP SEQUENCE public.tblactividades_id_actividad_seq;
DROP TABLE public.tblaccesoforma;
DROP SEQUENCE public.tblaccesoforma_id_accesoforma_seq;
DROP SEQUENCE public.tbl_expediente_referidos_lngcodigo_seq;
DROP TABLE public.tbl_expediente_referidos;
DROP SEQUENCE public.tbl_demandantes_lngcodigo_seq;
DROP TABLE public.tbl_demandantes;
DROP SEQUENCE public.tbl_contrarios_id_contrarios_seq;
DROP TABLE public.tbl_contrarios;
DROP SEQUENCE public.tbl_clientes_id_cliente_seq;
DROP TABLE public.tbl_clientes;
DROP SEQUENCE public.tbl_abogados_representantes_id_abogado_seq;
DROP TABLE public.tbl_abogados_representantes;
DROP SEQUENCE public.tbl_abogados_id_abogado_seq;
DROP SEQUENCE public.tbl_abogados_contrarios_id_abogadoscon_seq;
DROP TABLE public.tbl_abogados_contrarios;
DROP TABLE public.tbl_abogados;
DROP VIEW public.documentos;
DROP TABLE public.tbldocumento;
DROP VIEW public.count_expedientes_cerrados;
DROP VIEW public.count_expedientes_abiertos;
DROP TABLE public.tblproexpediente;
DROP FUNCTION public.pc_chartoint(chartoconvert character varying);
DROP FUNCTION public.last_day(date);
DROP TYPE public.dblink_pkey_results;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: dblink_pkey_results; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE dblink_pkey_results AS (
	"position" integer,
	colname text
);


ALTER TYPE public.dblink_pkey_results OWNER TO postgres;

--
-- Name: last_day(date); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION last_day(date) RETURNS date
    LANGUAGE sql
    AS $_$
select ((date_trunc('month', $1) + interval '1 month') - interval '1 day')::date;
$_$;


ALTER FUNCTION public.last_day(date) OWNER TO postgres;

--
-- Name: pc_chartoint(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pc_chartoint(chartoconvert character varying) RETURNS integer
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
SELECT CASE WHEN trim($1) SIMILAR TO '[0-9]+'
        THEN CAST(trim($1) AS integer)
    ELSE NULL END;

$_$;


ALTER FUNCTION public.pc_chartoint(chartoconvert character varying) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tblproexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente (
    id_proexpediente integer NOT NULL,
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
    id_contrarios integer
);


ALTER TABLE public.tblproexpediente OWNER TO postgres;

--
-- Name: count_expedientes_abiertos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW count_expedientes_abiertos AS
    SELECT (tblproexpediente.cedula_cliente)::integer AS cedula_cliente, count(tblproexpediente.id_proexpediente) AS count FROM tblproexpediente WHERE (tblproexpediente.feccierre IS NULL) GROUP BY tblproexpediente.cedula_cliente;


ALTER TABLE public.count_expedientes_abiertos OWNER TO postgres;

--
-- Name: count_expedientes_cerrados; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW count_expedientes_cerrados AS
    SELECT (tblproexpediente.cedula_cliente)::integer AS cedula_cliente, count(tblproexpediente.id_proexpediente) AS count FROM tblproexpediente WHERE (tblproexpediente.feccierre IS NOT NULL) GROUP BY tblproexpediente.cedula_cliente;


ALTER TABLE public.count_expedientes_cerrados OWNER TO postgres;

--
-- Name: tbldocumento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbldocumento (
    id_documento integer NOT NULL,
    id_usuario integer DEFAULT 0 NOT NULL,
    id_tipo integer DEFAULT 0 NOT NULL,
    id_evento integer DEFAULT 0 NOT NULL,
    id_prioridad integer DEFAULT 0 NOT NULL,
    id_estado integer DEFAULT 0 NOT NULL,
    id_recordatorio integer DEFAULT 0 NOT NULL,
    id_unidad integer DEFAULT 0 NOT NULL,
    fecdocumento date,
    strdescripcion text,
    strtitulo text,
    id_expediente integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0,
    id_tipo_organismo integer DEFAULT 0,
    id_organismo integer DEFAULT 0,
    strpersona text,
    id_refiere integer,
    visto character varying(1) DEFAULT 1,
    id_contacto integer DEFAULT 0,
    date character varying(100) NOT NULL,
    id_seguimiento integer DEFAULT 0 NOT NULL,
    origen character(1) NOT NULL,
    strnumero character varying(10),
    strtelefono character varying(100),
    strrespuesta text,
    strubicacion text,
    strdirigido text,
    strrecibido text
);


ALTER TABLE public.tbldocumento OWNER TO postgres;

--
-- Name: documentos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW documentos AS
    SELECT tbldocumento.id_usuario, tbldocumento.id_tipo, tbldocumento.id_evento, tbldocumento.id_prioridad, tbldocumento.id_estado, tbldocumento.id_recordatorio, tbldocumento.id_unidad, tbldocumento.fecdocumento, tbldocumento.strdescripcion, tbldocumento.strtitulo, tbldocumento.id_expediente, tbldocumento.bolborrado, tbldocumento.id_tipo_organismo, tbldocumento.id_organismo, tbldocumento.strpersona, tbldocumento.id_refiere, tbldocumento.visto, tbldocumento.id_contacto, tbldocumento.date, tbldocumento.id_seguimiento, tbldocumento.origen, tbldocumento.strnumero, tbldocumento.strtelefono, tbldocumento.strrespuesta, tbldocumento.strubicacion FROM tbldocumento;


ALTER TABLE public.documentos OWNER TO postgres;

--
-- Name: tbl_abogados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_abogados (
    id_abogado integer NOT NULL,
    strdireccion text,
    strcodigopostal text,
    strlocalidad text,
    id_estado integer,
    id_municipio integer,
    strtelefono text,
    strmovil text,
    strfax text,
    stremail text,
    strpin text,
    strobservaciones text,
    intbanco integer,
    strcuentaban text,
    strfoto text,
    strcurriculum text,
    strnombre text,
    strapellido text,
    strnif_cif text,
    strnumcolegiado text,
    strrif text,
    id_sexo integer,
    strcedula text,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tbl_abogados OWNER TO postgres;

--
-- Name: tbl_abogados_contrarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_abogados_contrarios (
    id_abogadoscon integer NOT NULL,
    strdireccion text,
    strcodipostal text,
    strlocalidad text,
    id_estado integer,
    id_municipio integer,
    strmovil text,
    strtelefono text,
    strfax text,
    stremail text,
    strpin text,
    strobservaciones text,
    strnombre text NOT NULL,
    strapellido text NOT NULL,
    strnif_cif text,
    strcedula text,
    strnumcolegiado text,
    strrif text,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tbl_abogados_contrarios OWNER TO postgres;

--
-- Name: tbl_abogados_contrarios_id_abogadoscon_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_abogados_contrarios_id_abogadoscon_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_abogados_contrarios_id_abogadoscon_seq OWNER TO postgres;

--
-- Name: tbl_abogados_contrarios_id_abogadoscon_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_abogados_contrarios_id_abogadoscon_seq OWNED BY tbl_abogados_contrarios.id_abogadoscon;


--
-- Name: tbl_abogados_contrarios_id_abogadoscon_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_abogados_contrarios_id_abogadoscon_seq', 52, true);


--
-- Name: tbl_abogados_id_abogado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_abogados_id_abogado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_abogados_id_abogado_seq OWNER TO postgres;

--
-- Name: tbl_abogados_id_abogado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_abogados_id_abogado_seq OWNED BY tbl_abogados.id_abogado;


--
-- Name: tbl_abogados_id_abogado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_abogados_id_abogado_seq', 22, true);


--
-- Name: tbl_abogados_representantes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_abogados_representantes (
    id_abogado integer NOT NULL,
    strdireccion text,
    strcodigopostal text,
    strlocalidad text,
    id_estado integer,
    id_municipio integer,
    strtelefono text,
    strmovil text,
    strfax text,
    stremail text,
    strpin text,
    strobservaciones text,
    intbanco integer,
    strcuentaban text,
    strfoto text,
    strcurriculum text,
    strnombre text,
    strapellido text,
    strnif_cif text,
    strnumcolegiado text,
    strrif text,
    id_sexo integer,
    strcedula text,
    bolborrado integer DEFAULT 0,
    id_tipo_organismo integer,
    id_organismo integer
);


ALTER TABLE public.tbl_abogados_representantes OWNER TO postgres;

--
-- Name: tbl_abogados_representantes_id_abogado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_abogados_representantes_id_abogado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_abogados_representantes_id_abogado_seq OWNER TO postgres;

--
-- Name: tbl_abogados_representantes_id_abogado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_abogados_representantes_id_abogado_seq OWNED BY tbl_abogados_representantes.id_abogado;


--
-- Name: tbl_abogados_representantes_id_abogado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_abogados_representantes_id_abogado_seq', 13, true);


--
-- Name: tbl_clientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_clientes (
    id_cliente integer NOT NULL,
    strnombre character varying(100),
    strapellido character varying(100),
    strcedula character varying(10),
    strdireccion text,
    id_estado integer,
    id_municipio integer,
    strtelefono character varying(20),
    stremail character varying(100),
    id_estado_civil integer,
    id_sexo integer,
    inthijos integer,
    strcodigopostal character varying(50),
    datefecnac date,
    strobservacion text,
    id_representante integer,
    id_organizacion integer,
    strdocumentoconst text,
    strrif character varying(50),
    strmovil character varying(50),
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tbl_clientes OWNER TO postgres;

--
-- Name: tbl_clientes_id_cliente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_clientes_id_cliente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_clientes_id_cliente_seq OWNER TO postgres;

--
-- Name: tbl_clientes_id_cliente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_clientes_id_cliente_seq OWNED BY tbl_clientes.id_cliente;


--
-- Name: tbl_clientes_id_cliente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_clientes_id_cliente_seq', 12, true);


--
-- Name: tbl_contrarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_contrarios (
    id_contrarios integer NOT NULL,
    strnombre text,
    strapellido text,
    strcedula text,
    strdireccion text,
    id_estado integer,
    id_municipio integer,
    strtelefono text,
    stremail text,
    id_estado_civil integer,
    id_sexo integer,
    inthijos integer,
    strcodigopostal text,
    datefecnac timestamp without time zone,
    strobservacion text,
    id_representante integer,
    id_organizacion integer,
    strdocumentoconst text,
    strrif text,
    strmovil text,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tbl_contrarios OWNER TO postgres;

--
-- Name: tbl_contrarios_id_contrarios_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_contrarios_id_contrarios_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_contrarios_id_contrarios_seq OWNER TO postgres;

--
-- Name: tbl_contrarios_id_contrarios_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_contrarios_id_contrarios_seq OWNED BY tbl_contrarios.id_contrarios;


--
-- Name: tbl_contrarios_id_contrarios_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_contrarios_id_contrarios_seq', 280, true);


--
-- Name: tbl_demandantes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_demandantes (
    lngcodigo integer NOT NULL,
    cedula character varying,
    nombres character varying,
    telefono character varying,
    direccion text,
    tiempo_servicio character varying,
    fecingreso date,
    fecegreso date,
    motivo_culminacion_laboral character varying,
    cancelo_adelanto_prestaciones boolean,
    concepto character varying,
    monto double precision
);


ALTER TABLE public.tbl_demandantes OWNER TO postgres;

--
-- Name: tbl_demandantes_lngcodigo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_demandantes_lngcodigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_demandantes_lngcodigo_seq OWNER TO postgres;

--
-- Name: tbl_demandantes_lngcodigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_demandantes_lngcodigo_seq OWNED BY tbl_demandantes.lngcodigo;


--
-- Name: tbl_demandantes_lngcodigo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_demandantes_lngcodigo_seq', 8, true);


--
-- Name: tbl_expediente_referidos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_expediente_referidos (
    lngcodigo integer NOT NULL,
    tiempo_servicio character varying,
    fecingreso date,
    fecegreso date,
    motivo_culminacion_laboral character varying,
    concepto character varying,
    monto double precision,
    id_expediente integer,
    id_demandante integer,
    monto_demanda double precision,
    bolborrado integer DEFAULT 0,
    cancelo_adelanto_prestaciones character(1) DEFAULT 0
);


ALTER TABLE public.tbl_expediente_referidos OWNER TO postgres;

--
-- Name: tbl_expediente_referidos_lngcodigo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_expediente_referidos_lngcodigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_expediente_referidos_lngcodigo_seq OWNER TO postgres;

--
-- Name: tbl_expediente_referidos_lngcodigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_expediente_referidos_lngcodigo_seq OWNED BY tbl_expediente_referidos.lngcodigo;


--
-- Name: tbl_expediente_referidos_lngcodigo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_expediente_referidos_lngcodigo_seq', 12, true);


--
-- Name: tblaccesoforma_id_accesoforma_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblaccesoforma_id_accesoforma_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblaccesoforma_id_accesoforma_seq OWNER TO postgres;

--
-- Name: tblaccesoforma_id_accesoforma_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblaccesoforma_id_accesoforma_seq', 190, true);


--
-- Name: tblaccesoforma; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblaccesoforma (
    id_accesoforma integer DEFAULT nextval('tblaccesoforma_id_accesoforma_seq'::regclass) NOT NULL,
    id_profile_maestro integer DEFAULT 0 NOT NULL,
    id_menu_maestro integer DEFAULT 0 NOT NULL,
    stracciones character varying(255),
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblaccesoforma OWNER TO postgres;

--
-- Name: COLUMN tblaccesoforma.id_accesoforma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblaccesoforma.id_accesoforma IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblaccesoforma.id_profile_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblaccesoforma.id_profile_maestro IS 'codigo del perfil que proviene de la tabla maestro';


--
-- Name: COLUMN tblaccesoforma.id_menu_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblaccesoforma.id_menu_maestro IS 'codigo del menu que proviene de la tabla maestro';


--
-- Name: COLUMN tblaccesoforma.stracciones; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblaccesoforma.stracciones IS 'cadena de caracteres que contiene los control que funcionan para este formulario';


--
-- Name: COLUMN tblaccesoforma.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblaccesoforma.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblactividades_id_actividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblactividades_id_actividad_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblactividades_id_actividad_seq OWNER TO postgres;

--
-- Name: tblactividades_id_actividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblactividades_id_actividad_seq', 2, true);


--
-- Name: tblactividades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblactividades (
    id_actividad integer DEFAULT nextval('tblactividades_id_actividad_seq'::regclass) NOT NULL,
    id_destinatarios integer DEFAULT 0 NOT NULL,
    strdescripcion text,
    id_prioridad_maestro integer DEFAULT 0 NOT NULL,
    id_estatus_maestro integer DEFAULT 0 NOT NULL,
    memtitulo character varying(200),
    dtmresolucion timestamp with time zone,
    dtmcierre timestamp with time zone,
    id_contacto integer,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblactividades OWNER TO postgres;

--
-- Name: COLUMN tblactividades.id_actividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.id_actividad IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblactividades.id_destinatarios; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.id_destinatarios IS 'codigo del destinatario';


--
-- Name: COLUMN tblactividades.strdescripcion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.strdescripcion IS 'descripcion de la actividad';


--
-- Name: COLUMN tblactividades.id_prioridad_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.id_prioridad_maestro IS 'codigo de la prioridad de la actividad y proviene de la tabla maestro';


--
-- Name: COLUMN tblactividades.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.id_estatus_maestro IS 'codigo del estatu de la actividad y proviene de la tabla maestro';


--
-- Name: COLUMN tblactividades.memtitulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.memtitulo IS 'titulo de la actividad';


--
-- Name: COLUMN tblactividades.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblactividades.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblactuacion_fases; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblactuacion_fases (
    id_proactuacion_fase integer NOT NULL,
    id_tipo_fase integer DEFAULT 0,
    id_fase integer DEFAULT 0,
    strobservacion text,
    id_proactuacion integer DEFAULT 0,
    fecfase date,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblactuacion_fases OWNER TO postgres;

--
-- Name: tblactuacion_fases_id_proactuacion_fase_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblactuacion_fases_id_proactuacion_fase_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblactuacion_fases_id_proactuacion_fase_seq OWNER TO postgres;

--
-- Name: tblactuacion_fases_id_proactuacion_fase_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblactuacion_fases_id_proactuacion_fase_seq OWNED BY tblactuacion_fases.id_proactuacion_fase;


--
-- Name: tblactuacion_fases_id_proactuacion_fase_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblactuacion_fases_id_proactuacion_fase_seq', 1, false);


--
-- Name: tblactuacion_situaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblactuacion_situaciones (
    id_proactuacion_situacion integer NOT NULL,
    id_tipo_minuta integer DEFAULT 0,
    id_minuta integer DEFAULT 0,
    strobservacion text,
    id_proactuacion integer DEFAULT 0,
    fecminuta date,
    bolborrado integer DEFAULT 0,
    id_estado_minuta integer
);


ALTER TABLE public.tblactuacion_situaciones OWNER TO postgres;

--
-- Name: tblactuacion_situaciones_id_proactuacion_situacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblactuacion_situaciones_id_proactuacion_situacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblactuacion_situaciones_id_proactuacion_situacion_seq OWNER TO postgres;

--
-- Name: tblactuacion_situaciones_id_proactuacion_situacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblactuacion_situaciones_id_proactuacion_situacion_seq OWNED BY tblactuacion_situaciones.id_proactuacion_situacion;


--
-- Name: tblactuacion_situaciones_id_proactuacion_situacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblactuacion_situaciones_id_proactuacion_situacion_seq', 1, false);


--
-- Name: tblactuaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblactuaciones (
    id_proactuacion integer NOT NULL,
    id_usuario integer DEFAULT 0,
    id_ano integer DEFAULT 0,
    id_origen integer DEFAULT 0,
    id_motivo integer DEFAULT 0,
    id_fase integer DEFAULT 0,
    id_actuacion integer DEFAULT 0,
    id_tipo_organismo integer DEFAULT 0,
    id_organismo integer DEFAULT 0,
    id_refer integer DEFAULT 0,
    id_estado_fisico_expediente integer DEFAULT 0,
    id_tipo_espacio integer DEFAULT 0,
    id_tipo_archivador integer DEFAULT 0,
    id_tipo_piso_archivador integer DEFAULT 0,
    id_tipo_archivador_gaveta integer DEFAULT 0,
    strnroexpediente text,
    strdescripcion text,
    fecapertura timestamp with time zone,
    feccierre timestamp with time zone,
    fecexpediente timestamp with time zone,
    intcuantias numeric DEFAULT 0,
    strdocumentos text,
    strobservacion_cerrar text,
    strnroexpedienteauxiliar character varying(100),
    strrepresentante character(1),
    fecadmdem date,
    fecnotdem date,
    fecultnotordtri date,
    fecinsaudpre date,
    fecculfaspre date,
    feccondem date,
    fecadmpru date,
    fecjuiorapub date,
    fecpubsen date,
    fecapelacion date,
    bolborrado integer DEFAULT 0,
    id_contrario integer,
    id_tipo_organismo_centralizado integer DEFAULT 0,
    otrafase character varying(400),
    otromotivo character varying(250)
);


ALTER TABLE public.tblactuaciones OWNER TO postgres;

--
-- Name: tblactuaciones_id_proactuacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblactuaciones_id_proactuacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblactuaciones_id_proactuacion_seq OWNER TO postgres;

--
-- Name: tblactuaciones_id_proactuacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblactuaciones_id_proactuacion_seq OWNED BY tblactuaciones.id_proactuacion;


--
-- Name: tblactuaciones_id_proactuacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblactuaciones_id_proactuacion_seq', 70, true);


--
-- Name: tbladjunto_id_adjunto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbladjunto_id_adjunto_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbladjunto_id_adjunto_seq OWNER TO postgres;

--
-- Name: tbladjunto_id_adjunto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbladjunto_id_adjunto_seq', 7, true);


--
-- Name: tbladjunto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbladjunto (
    id_adjunto integer DEFAULT nextval('tbladjunto_id_adjunto_seq'::regclass) NOT NULL,
    id_corresp integer,
    id_actividad integer,
    id_archivo character varying(50) DEFAULT 0,
    stradjunto character varying(250),
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbladjunto OWNER TO postgres;

--
-- Name: COLUMN tbladjunto.id_adjunto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto.id_adjunto IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tbladjunto.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto.id_corresp IS 'codigo de la actividad de origen';


--
-- Name: COLUMN tbladjunto.id_archivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto.id_archivo IS 'numero aleatorio de identificacion del adjunto para evitar duplicidad';


--
-- Name: COLUMN tbladjunto.stradjunto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto.stradjunto IS 'direccion de ubicacion del archivo';


--
-- Name: tbladjunto_documento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbladjunto_documento (
    id_adjunto integer NOT NULL,
    id_proexpediente integer,
    stradjunto character varying(250),
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbladjunto_documento OWNER TO postgres;

--
-- Name: COLUMN tbladjunto_documento.id_adjunto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto_documento.id_adjunto IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tbladjunto_documento.id_proexpediente; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto_documento.id_proexpediente IS 'codigo de la actividad de origen';


--
-- Name: COLUMN tbladjunto_documento.stradjunto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbladjunto_documento.stradjunto IS 'direccion de ubicacion del archivo';


--
-- Name: tbladjunto_documento_id_adjunto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbladjunto_documento_id_adjunto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbladjunto_documento_id_adjunto_seq OWNER TO postgres;

--
-- Name: tbladjunto_documento_id_adjunto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbladjunto_documento_id_adjunto_seq OWNED BY tbladjunto_documento.id_adjunto;


--
-- Name: tbladjunto_documento_id_adjunto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbladjunto_documento_id_adjunto_seq', 39, true);


--
-- Name: tblagenda; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblagenda (
    id_agenda integer NOT NULL,
    id_usuario integer DEFAULT 0 NOT NULL,
    id_tipo integer DEFAULT 0 NOT NULL,
    id_evento integer DEFAULT 0 NOT NULL,
    id_prioridad integer DEFAULT 0 NOT NULL,
    id_estado integer DEFAULT 0 NOT NULL,
    id_recordatorio integer DEFAULT 0 NOT NULL,
    id_unidad integer DEFAULT 0 NOT NULL,
    fecagenda date,
    strdescripcion text,
    strtitulo text,
    id_expediente integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0,
    id_tipo_organismo integer DEFAULT 0,
    id_organismo integer DEFAULT 0,
    strpersona text,
    id_refiere integer,
    visto character varying(1) DEFAULT 1,
    id_contacto integer DEFAULT 0,
    date character varying(100) NOT NULL,
    id_seguimiento integer DEFAULT 0 NOT NULL,
    origen character(1) NOT NULL,
    tipo_expediente integer DEFAULT 0
);


ALTER TABLE public.tblagenda OWNER TO postgres;

--
-- Name: tblagenda_id_agenda_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblagenda_id_agenda_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblagenda_id_agenda_seq OWNER TO postgres;

--
-- Name: tblagenda_id_agenda_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblagenda_id_agenda_seq OWNED BY tblagenda.id_agenda;


--
-- Name: tblagenda_id_agenda_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblagenda_id_agenda_seq', 287, true);


--
-- Name: tblagenda_litigio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblagenda_litigio (
    id_agenda integer NOT NULL,
    id_usuario integer DEFAULT 0 NOT NULL,
    id_tipo integer DEFAULT 0 NOT NULL,
    id_evento integer DEFAULT 0 NOT NULL,
    id_prioridad integer DEFAULT 0 NOT NULL,
    id_estado integer DEFAULT 0 NOT NULL,
    id_recordatorio integer DEFAULT 0 NOT NULL,
    id_unidad integer DEFAULT 0 NOT NULL,
    fecagenda date,
    strdescripcion text,
    strtitulo text,
    id_expediente_litigio integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0,
    id_tipo_organismo integer DEFAULT 0,
    id_organismo integer DEFAULT 0,
    strpersona text,
    id_refiere integer,
    visto character varying(1) DEFAULT 1,
    id_contacto integer DEFAULT 0,
    date character varying(100) NOT NULL,
    id_seguimiento integer DEFAULT 0 NOT NULL,
    origen character(1) NOT NULL
);


ALTER TABLE public.tblagenda_litigio OWNER TO postgres;

--
-- Name: tblagenda_litigio_id_agenda_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblagenda_litigio_id_agenda_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblagenda_litigio_id_agenda_seq OWNER TO postgres;

--
-- Name: tblagenda_litigio_id_agenda_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblagenda_litigio_id_agenda_seq OWNED BY tblagenda_litigio.id_agenda;


--
-- Name: tblagenda_litigio_id_agenda_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblagenda_litigio_id_agenda_seq', 1, false);


--
-- Name: tblasociaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblasociaciones (
    lngcodigo_asociacion integer NOT NULL,
    strnombre_asociacion character varying(250),
    strweb character varying(50),
    dtmfechafun date,
    strtelefono_asociacion character varying(50),
    strdireccion_asociacion character varying(250),
    strrif character varying(25),
    id_municipio_asociacion integer DEFAULT 0 NOT NULL,
    id_parroquia_asociacion integer DEFAULT 0 NOT NULL,
    id_ramo integer DEFAULT 0,
    id_cliente integer DEFAULT 0
);


ALTER TABLE public.tblasociaciones OWNER TO postgres;

--
-- Name: tblasociaciones_lngcodigo_asociacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblasociaciones_lngcodigo_asociacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblasociaciones_lngcodigo_asociacion_seq OWNER TO postgres;

--
-- Name: tblasociaciones_lngcodigo_asociacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblasociaciones_lngcodigo_asociacion_seq OWNED BY tblasociaciones.lngcodigo_asociacion;


--
-- Name: tblasociaciones_lngcodigo_asociacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblasociaciones_lngcodigo_asociacion_seq', 3, true);


--
-- Name: tblautorizado_est_id_autorizados_est_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblautorizado_est_id_autorizados_est_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblautorizado_est_id_autorizados_est_seq OWNER TO postgres;

--
-- Name: tblautorizado_est_id_autorizados_est_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblautorizado_est_id_autorizados_est_seq', 159, true);


--
-- Name: tblautorizado_est; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblautorizado_est (
    id_autorizados_est integer DEFAULT nextval('tblautorizado_est_id_autorizados_est_seq'::regclass) NOT NULL,
    id_estados integer DEFAULT 0,
    id_perfil_maestro integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblautorizado_est OWNER TO postgres;

--
-- Name: COLUMN tblautorizado_est.id_autorizados_est; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblautorizado_est.id_autorizados_est IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblautorizado_est.id_estados; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblautorizado_est.id_estados IS 'salto al que esta autorizado el perfil y proviene de la tabla estados';


--
-- Name: COLUMN tblautorizado_est.id_perfil_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblautorizado_est.id_perfil_maestro IS 'perfil autorizado para realizar el cambio y proviene de la tabla maestros';


--
-- Name: COLUMN tblautorizado_est.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblautorizado_est.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblcontacto_id_contacto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcontacto_id_contacto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblcontacto_id_contacto_seq OWNER TO postgres;

--
-- Name: tblcontacto_id_contacto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcontacto_id_contacto_seq', 728, true);


--
-- Name: tblcontacto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcontacto (
    id_contacto integer DEFAULT nextval('tblcontacto_id_contacto_seq'::regclass) NOT NULL,
    strpassword character varying(100),
    strlogin character varying(20),
    id_tipo_maestro integer DEFAULT 0 NOT NULL,
    strdocumento character varying(15) NOT NULL,
    strnombre character varying(50),
    strapellido character varying(50),
    strtlfhab character varying(40),
    strext character varying(5),
    stremail character varying(40),
    memdireccion character varying(100),
    id_cargo_maestro integer DEFAULT 0,
    id_estatus_maestro integer,
    strfirma text,
    strmediafirma character varying(200),
    bolborrado integer DEFAULT 0 NOT NULL,
    id_dpto_maestro integer DEFAULT 0,
    id_coord_maestro integer DEFAULT 0,
    id_coordext_maestro integer DEFAULT 0
);


ALTER TABLE public.tblcontacto OWNER TO postgres;

--
-- Name: COLUMN tblcontacto.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_contacto IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblcontacto.strpassword; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strpassword IS 'clave de acceso';


--
-- Name: COLUMN tblcontacto.strlogin; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strlogin IS 'usuario del contacto';


--
-- Name: COLUMN tblcontacto.id_tipo_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_tipo_maestro IS 'codigo del tipo de contacto que proviene de la tabla maestro';


--
-- Name: COLUMN tblcontacto.strdocumento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strdocumento IS 'contiene la cedula, rif, pasaporte o cualquier documento que sirva para identificar el contacto';


--
-- Name: COLUMN tblcontacto.strnombre; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strnombre IS 'nombre del contacto';


--
-- Name: COLUMN tblcontacto.strapellido; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strapellido IS 'apellido del contacto';


--
-- Name: COLUMN tblcontacto.strtlfhab; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strtlfhab IS 'telefono de habitacion';


--
-- Name: COLUMN tblcontacto.strext; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strext IS 'extension del numero telefonico si existe';


--
-- Name: COLUMN tblcontacto.stremail; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.stremail IS 'e-mail del contacto';


--
-- Name: COLUMN tblcontacto.memdireccion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.memdireccion IS 'direccion de ubicacion del contacto';


--
-- Name: COLUMN tblcontacto.id_cargo_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_cargo_maestro IS 'codigo del cargo del contacto y proviene de la tabla maestro';


--
-- Name: COLUMN tblcontacto.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_estatus_maestro IS 'codigo del estatus del cargo del contacto y proviene de la tabla maestro';


--
-- Name: COLUMN tblcontacto.strfirma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strfirma IS 'firma del contacto';


--
-- Name: COLUMN tblcontacto.strmediafirma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.strmediafirma IS 'media firma del contacto';


--
-- Name: COLUMN tblcontacto.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: COLUMN tblcontacto.id_dpto_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_dpto_maestro IS 'departamento al que pertenece';


--
-- Name: COLUMN tblcontacto.id_coord_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_coord_maestro IS 'coordinación al que esta adscrito';


--
-- Name: COLUMN tblcontacto.id_coordext_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontacto.id_coordext_maestro IS 'coordinación2 al que esta adscrito';


--
-- Name: tblcontacto_externo_id_contacto_externo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcontacto_externo_id_contacto_externo_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblcontacto_externo_id_contacto_externo_seq OWNER TO postgres;

--
-- Name: tblcontacto_externo_id_contacto_externo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcontacto_externo_id_contacto_externo_seq', 4, true);


--
-- Name: tblcontactoactividad_id_contactoactividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcontactoactividad_id_contactoactividad_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblcontactoactividad_id_contactoactividad_seq OWNER TO postgres;

--
-- Name: tblcontactoactividad_id_contactoactividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcontactoactividad_id_contactoactividad_seq', 1, true);


--
-- Name: tblcontactoactividad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcontactoactividad (
    id_contactoactividad integer DEFAULT nextval('tblcontactoactividad_id_contactoactividad_seq'::regclass) NOT NULL,
    id_actividad integer DEFAULT 0 NOT NULL,
    id_contacto integer DEFAULT 0 NOT NULL,
    dtminicio timestamp with time zone,
    dtmresolucion timestamp with time zone,
    id_estatus_maestro integer,
    bolborrado integer DEFAULT 0 NOT NULL,
    id_contacto_asigna integer
);


ALTER TABLE public.tblcontactoactividad OWNER TO postgres;

--
-- Name: COLUMN tblcontactoactividad.id_contactoactividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.id_contactoactividad IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblcontactoactividad.id_actividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.id_actividad IS 'codigo de la actidad de origen';


--
-- Name: COLUMN tblcontactoactividad.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.id_contacto IS 'codigo del contacto al cual se le asigna la actividad';


--
-- Name: COLUMN tblcontactoactividad.dtminicio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.dtminicio IS 'fecha de inicio de la actividad';


--
-- Name: COLUMN tblcontactoactividad.dtmresolucion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.dtmresolucion IS 'fecha de resolucion de la actividad';


--
-- Name: COLUMN tblcontactoactividad.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.id_estatus_maestro IS 'estatus de la actividad';


--
-- Name: COLUMN tblcontactoactividad.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoactividad.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblcontactoexterno; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcontactoexterno (
    id_contacto_externo integer DEFAULT nextval('tblcontacto_externo_id_contacto_externo_seq'::regclass) NOT NULL,
    strtrato character varying(20),
    strcontactoext character varying(100),
    strinstitucion character varying(200),
    strcargo character varying(150),
    strtelefono character varying(50),
    stremail character varying(100),
    strdireccion character varying(200),
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblcontactoexterno OWNER TO postgres;

--
-- Name: COLUMN tblcontactoexterno.id_contacto_externo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.id_contacto_externo IS 'corelativo propio de la tabla';


--
-- Name: COLUMN tblcontactoexterno.strtrato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.strtrato IS 'trato que se le darà a la persona: ciudadano, señor, etc';


--
-- Name: COLUMN tblcontactoexterno.strcontactoext; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.strcontactoext IS 'persona contacto';


--
-- Name: COLUMN tblcontactoexterno.strinstitucion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.strinstitucion IS 'instituciòn de donde precide el contacto';


--
-- Name: COLUMN tblcontactoexterno.strcargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.strcargo IS 'cargo de la persona a la que se le envia  la correspondencia';


--
-- Name: COLUMN tblcontactoexterno.strtelefono; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.strtelefono IS 'telefono';


--
-- Name: COLUMN tblcontactoexterno.stremail; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.stremail IS 'email';


--
-- Name: COLUMN tblcontactoexterno.strdireccion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.strdireccion IS 'direccion';


--
-- Name: COLUMN tblcontactoexterno.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoexterno.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblcontactoprofile_id_contactoprofile_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcontactoprofile_id_contactoprofile_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblcontactoprofile_id_contactoprofile_seq OWNER TO postgres;

--
-- Name: tblcontactoprofile_id_contactoprofile_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcontactoprofile_id_contactoprofile_seq', 725, true);


--
-- Name: tblcontactoprofile; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcontactoprofile (
    id_contactoprofile integer DEFAULT nextval('tblcontactoprofile_id_contactoprofile_seq'::regclass) NOT NULL,
    id_contacto integer DEFAULT 0 NOT NULL,
    id_profile_maestro integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblcontactoprofile OWNER TO postgres;

--
-- Name: COLUMN tblcontactoprofile.id_contactoprofile; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoprofile.id_contactoprofile IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblcontactoprofile.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoprofile.id_contacto IS 'codigo del contacto y proviene de la tabla tblcontacto';


--
-- Name: COLUMN tblcontactoprofile.id_profile_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoprofile.id_profile_maestro IS 'codigo del perfil del contacto y proviene de la tabla maestro';


--
-- Name: COLUMN tblcontactoprofile.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcontactoprofile.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblcorrelativo_id_correlativo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcorrelativo_id_correlativo_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblcorrelativo_id_correlativo_seq OWNER TO postgres;

--
-- Name: tblcorrelativo_id_correlativo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcorrelativo_id_correlativo_seq', 80, true);


--
-- Name: tblcorrelativo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcorrelativo (
    id_correlativo integer DEFAULT nextval('tblcorrelativo_id_correlativo_seq'::regclass) NOT NULL,
    id_gerencia_maestro integer DEFAULT 0 NOT NULL,
    id_coord_maestro integer,
    lnganio integer DEFAULT 0 NOT NULL,
    id_tipo_maestro integer DEFAULT 0 NOT NULL,
    lnginicio integer DEFAULT 0,
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblcorrelativo OWNER TO postgres;

--
-- Name: COLUMN tblcorrelativo.id_correlativo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.id_correlativo IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblcorrelativo.id_gerencia_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.id_gerencia_maestro IS 'codigo de la gerencia y proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrelativo.id_coord_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.id_coord_maestro IS 'codigo de la coordinacion y proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrelativo.lnganio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.lnganio IS 'año en curso';


--
-- Name: COLUMN tblcorrelativo.id_tipo_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.id_tipo_maestro IS 'codigo del tipo de documento (memo, circular, oficio, etc) y proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrelativo.lnginicio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.lnginicio IS 'donde comienza el correlativo';


--
-- Name: COLUMN tblcorrelativo.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrelativo.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblcorrespondencias_id_corresp_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcorrespondencias_id_corresp_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblcorrespondencias_id_corresp_seq OWNER TO postgres;

--
-- Name: tblcorrespondencias_id_corresp_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcorrespondencias_id_corresp_seq', 21, true);


--
-- Name: tblcorrespondencias; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcorrespondencias (
    id_corresp integer DEFAULT nextval('tblcorrespondencias_id_corresp_seq'::regclass) NOT NULL,
    id_tipo_maestro integer DEFAULT 0 NOT NULL,
    id_tipocorresp_maestro integer DEFAULT 0 NOT NULL,
    id_unidad_maestro integer DEFAULT 0 NOT NULL,
    dtmfecha timestamp with time zone NOT NULL,
    strasunto character varying(150) NOT NULL,
    strcuerpo text,
    lngenviada integer DEFAULT 0,
    strcorrelativo character varying(15) DEFAULT 0 NOT NULL,
    id_contacto integer DEFAULT 0,
    id_estatus_maestro integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0 NOT NULL,
    dtmfechaenvio timestamp with time zone
);


ALTER TABLE public.tblcorrespondencias OWNER TO postgres;

--
-- Name: COLUMN tblcorrespondencias.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.id_corresp IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblcorrespondencias.id_tipo_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.id_tipo_maestro IS 'codigo del tipo de destino (interna, externa) y proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrespondencias.id_tipocorresp_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.id_tipocorresp_maestro IS 'codigo del tipo de documento (memo, circular, oficio, etc) y proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrespondencias.id_unidad_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.id_unidad_maestro IS 'codigo del departamento creador de la correspondencia y que proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrespondencias.dtmfecha; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.dtmfecha IS 'fecha de creacion';


--
-- Name: COLUMN tblcorrespondencias.strasunto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.strasunto IS 'asunto de la correspondencia';


--
-- Name: COLUMN tblcorrespondencias.strcuerpo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.strcuerpo IS 'cuerpo de la correspondencia';


--
-- Name: COLUMN tblcorrespondencias.lngenviada; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.lngenviada IS '1 si esta enviada y 0 sino ha sido enviada';


--
-- Name: COLUMN tblcorrespondencias.strcorrelativo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.strcorrelativo IS 'correlativo proveniente de la tabla correlativo.';


--
-- Name: COLUMN tblcorrespondencias.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.id_contacto IS 'codigo del contacto y proviene de la tabla contacto';


--
-- Name: COLUMN tblcorrespondencias.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.id_estatus_maestro IS 'codigo del estatus de la correspondencia y proviene de la tabla maestro';


--
-- Name: COLUMN tblcorrespondencias.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblcorrespondencias.bolborrado IS 'codigo del estatus de la correspondencia y proviene de la tabla maestro';


--
-- Name: tbldepartamentoactividad_id_departamentoactividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbldepartamentoactividad_id_departamentoactividad_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbldepartamentoactividad_id_departamentoactividad_seq OWNER TO postgres;

--
-- Name: tbldepartamentoactividad_id_departamentoactividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbldepartamentoactividad_id_departamentoactividad_seq', 1, true);


--
-- Name: tbldepartamentoactividad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbldepartamentoactividad (
    id_departamentoactividad integer DEFAULT nextval('tbldepartamentoactividad_id_departamentoactividad_seq'::regclass) NOT NULL,
    id_actividad integer,
    id_departamento_maestro integer,
    id_contacto integer,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tbldepartamentoactividad OWNER TO postgres;

--
-- Name: COLUMN tbldepartamentoactividad.id_departamentoactividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldepartamentoactividad.id_departamentoactividad IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tbldepartamentoactividad.id_actividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldepartamentoactividad.id_actividad IS 'codigo de la actividad';


--
-- Name: COLUMN tbldepartamentoactividad.id_departamento_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldepartamentoactividad.id_departamento_maestro IS 'codigo de la gerenacia o coordinacion a cual fue asignada la actividad';


--
-- Name: COLUMN tbldepartamentoactividad.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldepartamentoactividad.id_contacto IS 'codigo del contacto que asigno la actividad a la gerencia o coordinacion';


--
-- Name: COLUMN tbldepartamentoactividad.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldepartamentoactividad.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tbldestinatarios_id_destinatarios_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbldestinatarios_id_destinatarios_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbldestinatarios_id_destinatarios_seq OWNER TO postgres;

--
-- Name: tbldestinatarios_id_destinatarios_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbldestinatarios_id_destinatarios_seq', 25, true);


--
-- Name: tbldestinatarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbldestinatarios (
    id_destinatarios integer DEFAULT nextval('tbldestinatarios_id_destinatarios_seq'::regclass) NOT NULL,
    id_destino_maestro integer DEFAULT 0 NOT NULL,
    id_corresp integer DEFAULT 0 NOT NULL,
    id_estatus_maestro integer DEFAULT 0,
    bolborrado integer DEFAULT 0 NOT NULL,
    id_tipoenvio_maestro integer DEFAULT 0
);


ALTER TABLE public.tbldestinatarios OWNER TO postgres;

--
-- Name: COLUMN tbldestinatarios.id_destinatarios; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldestinatarios.id_destinatarios IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tbldestinatarios.id_destino_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldestinatarios.id_destino_maestro IS 'codigo de la gerencia o coordinación y proviene de la tabla maestro';


--
-- Name: COLUMN tbldestinatarios.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldestinatarios.id_corresp IS 'codigo de la correspondencia y proviene de la tabla correspondencias';


--
-- Name: COLUMN tbldestinatarios.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldestinatarios.id_estatus_maestro IS 'codigo del estatus de la correspondencia y proviene de la tabla maestro';


--
-- Name: COLUMN tbldestinatarios.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldestinatarios.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: COLUMN tbldestinatarios.id_tipoenvio_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldestinatarios.id_tipoenvio_maestro IS 'tipo del envio de la corespondencia: CCO, CC, PR y proviene de la tabla maesto';


--
-- Name: tbldetallecontactoactividad_id_detallecontactoactividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbldetallecontactoactividad_id_detallecontactoactividad_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbldetallecontactoactividad_id_detallecontactoactividad_seq OWNER TO postgres;

--
-- Name: tbldetallecontactoactividad_id_detallecontactoactividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbldetallecontactoactividad_id_detallecontactoactividad_seq', 1, true);


--
-- Name: tbldetallecontactoactividad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbldetallecontactoactividad (
    id_detallecontactoactividad integer DEFAULT nextval('tbldetallecontactoactividad_id_detallecontactoactividad_seq'::regclass) NOT NULL,
    id_contactoactividad integer,
    dtmregistro timestamp with time zone,
    menresultado text,
    menobservaciones character varying(200),
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tbldetallecontactoactividad OWNER TO postgres;

--
-- Name: COLUMN tbldetallecontactoactividad.id_detallecontactoactividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldetallecontactoactividad.id_detallecontactoactividad IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tbldetallecontactoactividad.id_contactoactividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldetallecontactoactividad.id_contactoactividad IS 'codigo del contactoactividad';


--
-- Name: COLUMN tbldetallecontactoactividad.dtmregistro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldetallecontactoactividad.dtmregistro IS 'fecha de registro del detalle';


--
-- Name: COLUMN tbldetallecontactoactividad.menresultado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldetallecontactoactividad.menresultado IS 'resultado del detalle de la actividad';


--
-- Name: COLUMN tbldetallecontactoactividad.menobservaciones; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldetallecontactoactividad.menobservaciones IS 'observaciones del detalle de la actividad';


--
-- Name: COLUMN tbldetallecontactoactividad.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tbldetallecontactoactividad.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tbldictamenes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbldictamenes (
    id_dictamen integer NOT NULL,
    id_usuario integer DEFAULT 0 NOT NULL,
    id_materia integer DEFAULT 0 NOT NULL,
    id_tipo_materia integer DEFAULT 0 NOT NULL,
    id_estado integer DEFAULT 0 NOT NULL,
    fecdictamen date,
    strtitulo text,
    strasunto text,
    stranrodictamen text,
    strpersonas text,
    bolborrado integer DEFAULT 0,
    id_tipo_organismo integer,
    id_organismo integer
);


ALTER TABLE public.tbldictamenes OWNER TO postgres;

--
-- Name: tbldictamenes_id_dictamen_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbldictamenes_id_dictamen_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbldictamenes_id_dictamen_seq OWNER TO postgres;

--
-- Name: tbldictamenes_id_dictamen_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbldictamenes_id_dictamen_seq OWNED BY tbldictamenes.id_dictamen;


--
-- Name: tbldictamenes_id_dictamen_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbldictamenes_id_dictamen_seq', 2, true);


--
-- Name: tbldocumento_id_documento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbldocumento_id_documento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbldocumento_id_documento_seq OWNER TO postgres;

--
-- Name: tbldocumento_id_documento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbldocumento_id_documento_seq OWNED BY tbldocumento.id_documento;


--
-- Name: tbldocumento_id_documento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbldocumento_id_documento_seq', 86, true);


--
-- Name: tbldocumento_seguimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbldocumento_seguimiento (
    id_documento_seguimiento integer NOT NULL,
    id_documento integer DEFAULT 0 NOT NULL,
    id_remite integer DEFAULT 0 NOT NULL,
    id_origen character varying(1),
    id_remitente integer DEFAULT 0 NOT NULL,
    fecdocumento_movimiento date
);


ALTER TABLE public.tbldocumento_seguimiento OWNER TO postgres;

--
-- Name: tbldocumento_seguimiento_id_documento_seguimiento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbldocumento_seguimiento_id_documento_seguimiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbldocumento_seguimiento_id_documento_seguimiento_seq OWNER TO postgres;

--
-- Name: tbldocumento_seguimiento_id_documento_seguimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbldocumento_seguimiento_id_documento_seguimiento_seq OWNED BY tbldocumento_seguimiento.id_documento_seguimiento;


--
-- Name: tbldocumento_seguimiento_id_documento_seguimiento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbldocumento_seguimiento_id_documento_seguimiento_seq', 73, true);


--
-- Name: tblestados_id_estados_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblestados_id_estados_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblestados_id_estados_seq OWNER TO postgres;

--
-- Name: tblestados_id_estados_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblestados_id_estados_seq', 42, true);


--
-- Name: tblestados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblestados (
    id_estados integer DEFAULT nextval('tblestados_id_estados_seq'::regclass) NOT NULL,
    id_meestados_maestros integer DEFAULT 0,
    id_estinicial_maestro integer DEFAULT 0,
    id_estfinal_maestro integer DEFAULT 0,
    bolactivo integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblestados OWNER TO postgres;

--
-- Name: COLUMN tblestados.id_estados; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblestados.id_estados IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblestados.id_meestados_maestros; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblestados.id_meestados_maestros IS 'modelo de estado al que pertenece  el salto';


--
-- Name: COLUMN tblestados.id_estinicial_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblestados.id_estinicial_maestro IS 'estatus inicial';


--
-- Name: COLUMN tblestados.id_estfinal_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblestados.id_estfinal_maestro IS 'estatus final';


--
-- Name: COLUMN tblestados.bolactivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblestados.bolactivo IS 'si el registro esta activo';


--
-- Name: COLUMN tblestados.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblestados.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblfirmaautorizada_id_firma_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblfirmaautorizada_id_firma_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblfirmaautorizada_id_firma_seq OWNER TO postgres;

--
-- Name: tblfirmaautorizada_id_firma_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblfirmaautorizada_id_firma_seq', 3, true);


--
-- Name: tblfirmaautorizada; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblfirmaautorizada (
    id_firma integer DEFAULT nextval('tblfirmaautorizada_id_firma_seq'::regclass) NOT NULL,
    id_corresp integer DEFAULT 0 NOT NULL,
    id_contacto integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblfirmaautorizada OWNER TO postgres;

--
-- Name: COLUMN tblfirmaautorizada.id_firma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblfirmaautorizada.id_firma IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblfirmaautorizada.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblfirmaautorizada.id_corresp IS 'codigo de la correspondencia a la que pertenece la firma';


--
-- Name: COLUMN tblfirmaautorizada.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblfirmaautorizada.id_contacto IS 'codigo del contacto que firmara la correspondencia';


--
-- Name: COLUMN tblfirmaautorizada.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblfirmaautorizada.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblmaestros_id_maestro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblmaestros_id_maestro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblmaestros_id_maestro_seq OWNER TO postgres;

--
-- Name: tblmaestros_id_maestro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblmaestros_id_maestro_seq', 14103, true);


--
-- Name: tblmaestros; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblmaestros (
    id_maestro integer DEFAULT nextval('tblmaestros_id_maestro_seq'::regclass) NOT NULL,
    id_origen integer NOT NULL,
    stritema character varying(250),
    stritemb character varying(100),
    stritemc character varying(50),
    lngnumero integer DEFAULT 0,
    sngcant double precision DEFAULT 0,
    bolborrado integer DEFAULT 0 NOT NULL,
    id_sistema integer NOT NULL
);


ALTER TABLE public.tblmaestros OWNER TO postgres;

--
-- Name: COLUMN tblmaestros.id_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.id_maestro IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblmaestros.id_origen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.id_origen IS 'origen o padre del registro';


--
-- Name: COLUMN tblmaestros.stritema; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.stritema IS 'en este campo se registrara el nombre del maestro';


--
-- Name: COLUMN tblmaestros.stritemb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.stritemb IS 'aqui va la descripcion del maestro';


--
-- Name: COLUMN tblmaestros.stritemc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.stritemc IS 'se puede utilizar para guardar información complementaria';


--
-- Name: COLUMN tblmaestros.lngnumero; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.lngnumero IS 'guardar informacion de un numero entero';


--
-- Name: COLUMN tblmaestros.sngcant; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.sngcant IS 'aqui se pueden cuargar cantidades , montos etc.';


--
-- Name: COLUMN tblmaestros.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblmaestros_sistemas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblmaestros_sistemas (
    id_maestro integer NOT NULL,
    id_origen integer NOT NULL,
    stritema character varying(100),
    stritemb character varying(100),
    stritemc character varying(50),
    lngnumero integer DEFAULT 0,
    sngcant double precision DEFAULT 0,
    bolborrado integer DEFAULT 0 NOT NULL,
    id_sistema integer NOT NULL
);


ALTER TABLE public.tblmaestros_sistemas OWNER TO postgres;

--
-- Name: COLUMN tblmaestros_sistemas.id_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.id_maestro IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblmaestros_sistemas.id_origen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.id_origen IS 'origen o padre del registro';


--
-- Name: COLUMN tblmaestros_sistemas.stritema; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.stritema IS 'en este campo se registrara el nombre del maestro';


--
-- Name: COLUMN tblmaestros_sistemas.stritemb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.stritemb IS 'aqui va la descripcion del maestro';


--
-- Name: COLUMN tblmaestros_sistemas.stritemc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.stritemc IS 'se puede utilizar para guardar información complementaria';


--
-- Name: COLUMN tblmaestros_sistemas.lngnumero; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.lngnumero IS 'guardar informacion de un numero entero';


--
-- Name: COLUMN tblmaestros_sistemas.sngcant; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.sngcant IS 'aqui se pueden cuargar cantidades , montos etc.';


--
-- Name: COLUMN tblmaestros_sistemas.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblmaestros_sistemas.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblmaestros_sistemas_id_maestro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblmaestros_sistemas_id_maestro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblmaestros_sistemas_id_maestro_seq OWNER TO postgres;

--
-- Name: tblmaestros_sistemas_id_maestro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblmaestros_sistemas_id_maestro_seq OWNED BY tblmaestros_sistemas.id_maestro;


--
-- Name: tblmaestros_sistemas_id_maestro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblmaestros_sistemas_id_maestro_seq', 12, true);


--
-- Name: tblmaestros_vista; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW tblmaestros_vista AS
    SELECT (SELECT count(a.id_maestro) AS count FROM tblmaestros a WHERE (a.id_origen = b.id_maestro)) AS hijo, b.id_maestro, b.id_origen, b.stritema, b.stritemb, b.stritemc, b.lngnumero, b.sngcant, b.bolborrado, b.id_sistema FROM tblmaestros b;


ALTER TABLE public.tblmaestros_vista OWNER TO postgres;

--
-- Name: tblnotas_id_notas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblnotas_id_notas_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblnotas_id_notas_seq OWNER TO postgres;

--
-- Name: tblnotas_id_notas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblnotas_id_notas_seq', 1, true);


--
-- Name: tblnotas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblnotas (
    id_notas integer DEFAULT nextval('tblnotas_id_notas_seq'::regclass) NOT NULL,
    id_tiponota_maestro integer DEFAULT 0 NOT NULL,
    id_actividad integer DEFAULT 0,
    id_corresp integer DEFAULT 0,
    dtmnota timestamp with time zone,
    memobsernota character varying(200),
    id_contacto integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblnotas OWNER TO postgres;

--
-- Name: COLUMN tblnotas.id_notas; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.id_notas IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblnotas.id_tiponota_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.id_tiponota_maestro IS 'codigo de pertenencia de la nota es decir si es a una correspondencia o una actividad';


--
-- Name: COLUMN tblnotas.id_actividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.id_actividad IS 'codigo de la actividad a la cual se le cargara la nota';


--
-- Name: COLUMN tblnotas.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.id_corresp IS 'codigo de la correspondencia a la cual se le cargara la nota';


--
-- Name: COLUMN tblnotas.dtmnota; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.dtmnota IS 'fecha de la creacion de la nota';


--
-- Name: COLUMN tblnotas.memobsernota; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.memobsernota IS 'observaciones generadas a la nota';


--
-- Name: COLUMN tblnotas.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.id_contacto IS 'codigo del contacto que genero la nota';


--
-- Name: COLUMN tblnotas.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblnotas.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblproabogadoscasos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproabogadoscasos (
    id_proabogadoscasos integer NOT NULL,
    id_abogado integer,
    id_caso integer,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproabogadoscasos OWNER TO postgres;

--
-- Name: tblproabogadoscasos_id_proabogadoscasos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproabogadoscasos_id_proabogadoscasos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproabogadoscasos_id_proabogadoscasos_seq OWNER TO postgres;

--
-- Name: tblproabogadoscasos_id_proabogadoscasos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproabogadoscasos_id_proabogadoscasos_seq OWNED BY tblproabogadoscasos.id_proabogadoscasos;


--
-- Name: tblproabogadoscasos_id_proabogadoscasos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproabogadoscasos_id_proabogadoscasos_seq', 1, false);


--
-- Name: tblproactuaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproactuaciones (
    id_proactuaciones integer NOT NULL,
    id_tipo_actuacion integer DEFAULT 0,
    id_actuacion integer DEFAULT 0,
    strdescripcionactuacion text,
    fecactuacion date,
    bolborrado integer DEFAULT 0,
    strnombreactuacion character varying(250)
);


ALTER TABLE public.tblproactuaciones OWNER TO postgres;

--
-- Name: tblproactuaciones_id_proactuaciones_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproactuaciones_id_proactuaciones_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproactuaciones_id_proactuaciones_seq OWNER TO postgres;

--
-- Name: tblproactuaciones_id_proactuaciones_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproactuaciones_id_proactuaciones_seq OWNED BY tblproactuaciones.id_proactuaciones;


--
-- Name: tblproactuaciones_id_proactuaciones_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproactuaciones_id_proactuaciones_seq', 16, true);


--
-- Name: tblproactuaciones_litigio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproactuaciones_litigio (
    id_litigio_actuaciones integer NOT NULL,
    id_proactuacion integer DEFAULT 0,
    stronombreactuacion text,
    fecactuacion date,
    bolborrado integer DEFAULT 0,
    strdescripcionactuacion text,
    strexpedientetribunal character varying(100),
    anexa_agenda integer DEFAULT 0
);


ALTER TABLE public.tblproactuaciones_litigio OWNER TO postgres;

--
-- Name: tblproactuaciones_litigio_id_litigio_actuaciones_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproactuaciones_litigio_id_litigio_actuaciones_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproactuaciones_litigio_id_litigio_actuaciones_seq OWNER TO postgres;

--
-- Name: tblproactuaciones_litigio_id_litigio_actuaciones_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproactuaciones_litigio_id_litigio_actuaciones_seq OWNED BY tblproactuaciones_litigio.id_litigio_actuaciones;


--
-- Name: tblproactuaciones_litigio_id_litigio_actuaciones_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproactuaciones_litigio_id_litigio_actuaciones_seq', 30, true);


--
-- Name: tblproclientecasos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproclientecasos (
    id_proclientecasos integer NOT NULL,
    id_cliente integer,
    id_caso integer,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproclientecasos OWNER TO postgres;

--
-- Name: tblproclientecasos_id_proclientecasos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproclientecasos_id_proclientecasos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproclientecasos_id_proclientecasos_seq OWNER TO postgres;

--
-- Name: tblproclientecasos_id_proclientecasos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproclientecasos_id_proclientecasos_seq OWNED BY tblproclientecasos.id_proclientecasos;


--
-- Name: tblproclientecasos_id_proclientecasos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproclientecasos_id_proclientecasos_seq', 1, false);


--
-- Name: tblproexpediente_abogados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_abogados (
    id_proexpediente_abogados integer NOT NULL,
    id_abogados integer DEFAULT 0,
    id_proexpediente integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_abogados OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_demandantes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_abogados_demandantes (
    id_proexpediente_abogados_demandantes integer NOT NULL,
    id_abogados integer DEFAULT 0,
    id_proexpediente integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_abogados_demandantes OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq OWNED BY tblproexpediente_abogados_demandantes.id_proexpediente_abogados_demandantes;


--
-- Name: tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq', 47, true);


--
-- Name: tblproexpediente_abogados_ejecutores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_abogados_ejecutores (
    id_proexpediente_abogados_ejecutores integer NOT NULL,
    id_abogados integer DEFAULT 0,
    id_proexpediente integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_abogados_ejecutores OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq OWNED BY tblproexpediente_abogados_ejecutores.id_proexpediente_abogados_ejecutores;


--
-- Name: tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq', 13, true);


--
-- Name: tblproexpediente_abogados_id_proexpediente_abogados_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_abogados_id_proexpediente_abogados_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_abogados_id_proexpediente_abogados_seq OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_id_proexpediente_abogados_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_abogados_id_proexpediente_abogados_seq OWNED BY tblproexpediente_abogados.id_proexpediente_abogados;


--
-- Name: tblproexpediente_abogados_id_proexpediente_abogados_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_abogados_id_proexpediente_abogados_seq', 1, false);


--
-- Name: tblproexpediente_abogados_representantes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_abogados_representantes (
    id_proexpediente_abogados_representantes integer NOT NULL,
    id_abogados integer DEFAULT 0,
    id_proexpediente integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_abogados_representantes OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq OWNER TO postgres;

--
-- Name: tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq OWNED BY tblproexpediente_abogados_representantes.id_proexpediente_abogados_representantes;


--
-- Name: tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq', 42, true);


--
-- Name: tblproexpediente_actuaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_actuaciones (
    id_proexpediente_actuaciones integer NOT NULL,
    id_tipo_actuacion integer DEFAULT 0,
    id_actuacion integer DEFAULT 0,
    id_escrito integer DEFAULT 0,
    strobservacion text,
    id_proexpediente integer DEFAULT 0,
    fecactuacion date,
    bolborrado integer DEFAULT 0,
    strdescripcionactuacion text,
    strexpedientetribunal character varying(100)
);


ALTER TABLE public.tblproexpediente_actuaciones OWNER TO postgres;

--
-- Name: tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq OWNER TO postgres;

--
-- Name: tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq OWNED BY tblproexpediente_actuaciones.id_proexpediente_actuaciones;


--
-- Name: tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq', 15, true);


--
-- Name: tblproexpediente_fases; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_fases (
    id_proexpediente_fase integer NOT NULL,
    id_tipo_fase integer DEFAULT 0,
    id_fase integer DEFAULT 0,
    strobservacion text,
    id_proexpediente integer DEFAULT 0,
    fecfase date,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_fases OWNER TO postgres;

--
-- Name: tblproexpediente_fases_id_proexpediente_fase_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_fases_id_proexpediente_fase_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_fases_id_proexpediente_fase_seq OWNER TO postgres;

--
-- Name: tblproexpediente_fases_id_proexpediente_fase_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_fases_id_proexpediente_fase_seq OWNED BY tblproexpediente_fases.id_proexpediente_fase;


--
-- Name: tblproexpediente_fases_id_proexpediente_fase_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_fases_id_proexpediente_fase_seq', 12, true);


--
-- Name: tblproexpediente_hijos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_hijos (
    id_hijos integer NOT NULL,
    id_proexpediente integer DEFAULT 0,
    id_sexo integer DEFAULT 0,
    nombrehijo text,
    cedulahijo text,
    fecnachijo date,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_hijos OWNER TO postgres;

--
-- Name: tblproexpediente_hijos_id_hijos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_hijos_id_hijos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_hijos_id_hijos_seq OWNER TO postgres;

--
-- Name: tblproexpediente_hijos_id_hijos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_hijos_id_hijos_seq OWNED BY tblproexpediente_hijos.id_hijos;


--
-- Name: tblproexpediente_hijos_id_hijos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_hijos_id_hijos_seq', 13, true);


--
-- Name: tblproexpediente_id_proexpediente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_id_proexpediente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_id_proexpediente_seq OWNER TO postgres;

--
-- Name: tblproexpediente_id_proexpediente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_id_proexpediente_seq OWNED BY tblproexpediente.id_proexpediente;


--
-- Name: tblproexpediente_id_proexpediente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_id_proexpediente_seq', 26, true);


--
-- Name: tblproexpediente_personas_demandadas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_personas_demandadas (
    id_proexpediente_personas_demandadas integer NOT NULL,
    id_contrarios integer DEFAULT 0,
    id_proexpediente integer DEFAULT 0,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblproexpediente_personas_demandadas OWNER TO postgres;

--
-- Name: tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq OWNER TO postgres;

--
-- Name: tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq OWNED BY tblproexpediente_personas_demandadas.id_proexpediente_personas_demandadas;


--
-- Name: tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq', 101, true);


--
-- Name: tblproexpediente_situaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproexpediente_situaciones (
    id_proexpediente_situacion integer NOT NULL,
    id_tipo_minuta integer DEFAULT 0,
    id_minuta integer DEFAULT 0,
    strobservacion text,
    id_proexpediente integer DEFAULT 0,
    fecminuta date,
    bolborrado integer DEFAULT 0,
    id_estado_minuta integer
);


ALTER TABLE public.tblproexpediente_situaciones OWNER TO postgres;

--
-- Name: tblproexpediente_situaciones_id_proexpediente_situacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproexpediente_situaciones_id_proexpediente_situacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblproexpediente_situaciones_id_proexpediente_situacion_seq OWNER TO postgres;

--
-- Name: tblproexpediente_situaciones_id_proexpediente_situacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproexpediente_situaciones_id_proexpediente_situacion_seq OWNED BY tblproexpediente_situaciones.id_proexpediente_situacion;


--
-- Name: tblproexpediente_situaciones_id_proexpediente_situacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproexpediente_situaciones_id_proexpediente_situacion_seq', 30, true);


--
-- Name: tblprohonorarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblprohonorarios (
    id_honorarios integer NOT NULL,
    id_tipo integer DEFAULT 0 NOT NULL,
    id_tramite integer DEFAULT 0 NOT NULL,
    id_unidad integer DEFAULT 0 NOT NULL,
    numunidad integer DEFAULT 0 NOT NULL,
    modulo character varying DEFAULT 'OAS'::character varying
);


ALTER TABLE public.tblprohonorarios OWNER TO postgres;

--
-- Name: tblprohonorarios_id_honorarios_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblprohonorarios_id_honorarios_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblprohonorarios_id_honorarios_seq OWNER TO postgres;

--
-- Name: tblprohonorarios_id_honorarios_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblprohonorarios_id_honorarios_seq OWNED BY tblprohonorarios.id_honorarios;


--
-- Name: tblprohonorarios_id_honorarios_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblprohonorarios_id_honorarios_seq', 31, true);


--
-- Name: tblprohonorarios_litigio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblprohonorarios_litigio (
    id_honorarios integer NOT NULL,
    id_tipo integer DEFAULT 0 NOT NULL,
    id_tramite integer DEFAULT 0 NOT NULL,
    id_unidad integer DEFAULT 0 NOT NULL,
    numunidad integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblprohonorarios_litigio OWNER TO postgres;

--
-- Name: tblprohonorarios_litigio_id_honorarios_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblprohonorarios_litigio_id_honorarios_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblprohonorarios_litigio_id_honorarios_seq OWNER TO postgres;

--
-- Name: tblprohonorarios_litigio_id_honorarios_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblprohonorarios_litigio_id_honorarios_seq OWNED BY tblprohonorarios_litigio.id_honorarios;


--
-- Name: tblprohonorarios_litigio_id_honorarios_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblprohonorarios_litigio_id_honorarios_seq', 1, false);


--
-- Name: tblprojuzgados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblprojuzgados (
    id_juzgados integer NOT NULL,
    strnombre character varying(250),
    strdireccion character varying(250),
    strlocalidad character varying(250),
    idestado integer DEFAULT 0 NOT NULL,
    idmunicipio integer DEFAULT 0 NOT NULL,
    strtelefono character varying(250),
    strfax character varying(250),
    strobservaciones character varying(250)
);


ALTER TABLE public.tblprojuzgados OWNER TO postgres;

--
-- Name: tblprojuzgados_id_juzgados_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblprojuzgados_id_juzgados_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblprojuzgados_id_juzgados_seq OWNER TO postgres;

--
-- Name: tblprojuzgados_id_juzgados_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblprojuzgados_id_juzgados_seq OWNED BY tblprojuzgados.id_juzgados;


--
-- Name: tblprojuzgados_id_juzgados_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblprojuzgados_id_juzgados_seq', 3, true);


--
-- Name: tblrutaactividad_id_ruta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblrutaactividad_id_ruta_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblrutaactividad_id_ruta_seq OWNER TO postgres;

--
-- Name: tblrutaactividad_id_ruta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblrutaactividad_id_ruta_seq', 0, true);


--
-- Name: tblrutaactividad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblrutaactividad (
    id_ruta integer DEFAULT nextval('tblrutaactividad_id_ruta_seq'::regclass) NOT NULL,
    id_actividad integer DEFAULT 0 NOT NULL,
    dtmruta timestamp with time zone,
    id_estatus_maestro integer DEFAULT 0 NOT NULL,
    memruta character varying(200),
    id_contacto integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblrutaactividad OWNER TO postgres;

--
-- Name: COLUMN tblrutaactividad.id_ruta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.id_ruta IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblrutaactividad.id_actividad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.id_actividad IS 'codigo de la actividad a la cual se le generara el movimiento';


--
-- Name: COLUMN tblrutaactividad.dtmruta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.dtmruta IS 'fecha del movimiento';


--
-- Name: COLUMN tblrutaactividad.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.id_estatus_maestro IS 'codigo del estatus de llegada del movimiento generado';


--
-- Name: COLUMN tblrutaactividad.memruta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.memruta IS 'observaciones del movimiento';


--
-- Name: COLUMN tblrutaactividad.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.id_contacto IS 'codigo del contacto que genero el movimiento';


--
-- Name: COLUMN tblrutaactividad.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutaactividad.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblrutacorresp_id_rutacorresp_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblrutacorresp_id_rutacorresp_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblrutacorresp_id_rutacorresp_seq OWNER TO postgres;

--
-- Name: tblrutacorresp_id_rutacorresp_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblrutacorresp_id_rutacorresp_seq', 72, true);


--
-- Name: tblrutacorresp; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblrutacorresp (
    id_rutacorresp integer DEFAULT nextval('tblrutacorresp_id_rutacorresp_seq'::regclass) NOT NULL,
    id_corresp integer DEFAULT 0 NOT NULL,
    dtmrutacorresp timestamp with time zone,
    id_estatus_maestro integer DEFAULT 0 NOT NULL,
    memrutacorresp text,
    id_contacto integer DEFAULT 0 NOT NULL,
    bolborrado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tblrutacorresp OWNER TO postgres;

--
-- Name: COLUMN tblrutacorresp.id_rutacorresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.id_rutacorresp IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblrutacorresp.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.id_corresp IS 'codigo de la correspondencia a la cual se le generara el movimiento';


--
-- Name: COLUMN tblrutacorresp.dtmrutacorresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.dtmrutacorresp IS 'fecha del movimiento';


--
-- Name: COLUMN tblrutacorresp.id_estatus_maestro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.id_estatus_maestro IS 'codigo del estatus de llegada del movimiento generado';


--
-- Name: COLUMN tblrutacorresp.memrutacorresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.memrutacorresp IS 'observaciones del movimiento';


--
-- Name: COLUMN tblrutacorresp.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.id_contacto IS 'codigo del contacto que genero el movimiento';


--
-- Name: COLUMN tblrutacorresp.bolborrado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblrutacorresp.bolborrado IS '0 indica que el registro no se encuentra borrado y 1 para cuando el registro se encuenta borrado';


--
-- Name: tblunidadtributaria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblunidadtributaria (
    id_unidad integer NOT NULL,
    intprecio numeric DEFAULT 0,
    ano character varying(4)
);


ALTER TABLE public.tblunidadtributaria OWNER TO postgres;

--
-- Name: tblunidadtributaria_id_unidad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblunidadtributaria_id_unidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblunidadtributaria_id_unidad_seq OWNER TO postgres;

--
-- Name: tblunidadtributaria_id_unidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblunidadtributaria_id_unidad_seq OWNED BY tblunidadtributaria.id_unidad;


--
-- Name: tblunidadtributaria_id_unidad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblunidadtributaria_id_unidad_seq', 2, true);


--
-- Name: tblvalidacion_id_validacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblvalidacion_id_validacion_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tblvalidacion_id_validacion_seq OWNER TO postgres;

--
-- Name: tblvalidacion_id_validacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblvalidacion_id_validacion_seq', 17, true);


--
-- Name: tblvalidacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblvalidacion (
    id_validacion integer DEFAULT nextval('tblvalidacion_id_validacion_seq'::regclass) NOT NULL,
    dtmfecha date,
    codigo_validacion character varying(100),
    id_contacto integer,
    id_corresp integer,
    bolborrado integer DEFAULT 0
);


ALTER TABLE public.tblvalidacion OWNER TO postgres;

--
-- Name: COLUMN tblvalidacion.id_validacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblvalidacion.id_validacion IS 'correlativo propio de la tabla';


--
-- Name: COLUMN tblvalidacion.dtmfecha; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblvalidacion.dtmfecha IS 'fecha de envio de la correspondencia';


--
-- Name: COLUMN tblvalidacion.codigo_validacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblvalidacion.codigo_validacion IS 'codigo unico de validacion de la correspondencia';


--
-- Name: COLUMN tblvalidacion.id_contacto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblvalidacion.id_contacto IS 'codigo del contacto que envio la correspondencia';


--
-- Name: COLUMN tblvalidacion.id_corresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tblvalidacion.id_corresp IS 'codigo de la correspondencia que fue enviada';


--
-- Name: vista_abogados_casos_cargados; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_abogados_casos_cargados AS
    SELECT count(tblproexpediente.cedula_abogado_responsable) AS contador, (SELECT ((upper(tbl_abogados.strnombre) || ', '::text) || upper(tbl_abogados.strnombre)) FROM tbl_abogados WHERE (tbl_abogados.strcedula = tblproexpediente.cedula_abogado_responsable)) AS strnombre, (SELECT upper((tblmaestros.stritema)::text) AS upper FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_tramite)) AS tramite FROM tblproexpediente WHERE (tblproexpediente.feccierre IS NULL) GROUP BY tblproexpediente.cedula_abogado_responsable, (SELECT upper((tblmaestros.stritema)::text) AS upper FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_tramite)) ORDER BY (SELECT ((upper(tbl_abogados.strnombre) || ', '::text) || upper(tbl_abogados.strnombre)) FROM tbl_abogados WHERE (tbl_abogados.strcedula = tblproexpediente.cedula_abogado_responsable)), count(tblproexpediente.cedula_abogado_responsable) DESC;


ALTER TABLE public.vista_abogados_casos_cargados OWNER TO postgres;

--
-- Name: vista_abogados_casos_cargados_total; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_abogados_casos_cargados_total AS
    SELECT count(tblproexpediente.cedula_abogado_responsable) AS contador, (SELECT ((upper(tbl_abogados.strnombre) || ', '::text) || upper(tbl_abogados.strnombre)) FROM tbl_abogados WHERE (tbl_abogados.strcedula = tblproexpediente.cedula_abogado_responsable)) AS strnombre FROM tblproexpediente WHERE (tblproexpediente.feccierre IS NULL) GROUP BY tblproexpediente.cedula_abogado_responsable ORDER BY (SELECT ((upper(tbl_abogados.strnombre) || ', '::text) || upper(tbl_abogados.strnombre)) FROM tbl_abogados WHERE (tbl_abogados.strcedula = tblproexpediente.cedula_abogado_responsable)), count(tblproexpediente.cedula_abogado_responsable) DESC;


ALTER TABLE public.vista_abogados_casos_cargados_total OWNER TO postgres;

--
-- Name: vista_abogados_casos_litigio_cargados; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_abogados_casos_litigio_cargados AS
    SELECT count(tblactuaciones.id_usuario) AS contador, (SELECT ((upper((tblcontacto.strnombre)::text) || ', '::text) || upper((tblcontacto.strnombre)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tblactuaciones.id_usuario)) AS strnombre, (SELECT upper((tblmaestros.stritema)::text) AS stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblactuaciones.id_fase)) AS tramite FROM tblactuaciones GROUP BY tblactuaciones.id_usuario, (SELECT upper((tblmaestros.stritema)::text) AS stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblactuaciones.id_fase)) ORDER BY (SELECT ((upper((tblcontacto.strnombre)::text) || ', '::text) || upper((tblcontacto.strnombre)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tblactuaciones.id_usuario)), count(tblactuaciones.id_usuario) DESC;


ALTER TABLE public.vista_abogados_casos_litigio_cargados OWNER TO postgres;

--
-- Name: vista_abogados_casos_litigios_cargados_total; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_abogados_casos_litigios_cargados_total AS
    SELECT count(tblactuaciones.id_usuario) AS contador, (SELECT ((upper((tblcontacto.strnombre)::text) || ', '::text) || upper((tblcontacto.strnombre)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tblactuaciones.id_usuario)) AS strnombre FROM tblactuaciones GROUP BY tblactuaciones.id_usuario, (SELECT upper((tblmaestros.stritema)::text) AS stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblactuaciones.id_fase)) ORDER BY (SELECT ((upper((tblcontacto.strnombre)::text) || ', '::text) || upper((tblcontacto.strnombre)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tblactuaciones.id_usuario)), count(tblactuaciones.id_usuario) DESC;


ALTER TABLE public.vista_abogados_casos_litigios_cargados_total OWNER TO postgres;

--
-- Name: vista_agenda; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_agenda AS
    SELECT tblagenda.id_agenda, tblagenda.id_usuario, tblagenda.id_tipo, tblagenda.id_evento, tblagenda.id_prioridad, tblagenda.id_estado, tblagenda.id_recordatorio, tblagenda.id_unidad, tblagenda.fecagenda, tblagenda.strdescripcion, tblagenda.strtitulo, tblagenda.id_expediente, tblagenda.bolborrado, tblagenda.id_tipo_organismo, tblagenda.id_organismo, tblagenda.strpersona, tblagenda.id_refiere, tblagenda.visto, tblagenda.id_contacto, tblagenda.date, tblagenda.id_seguimiento, tblagenda.origen, tblagenda.tipo_expediente, (SELECT a.strnroexpediente FROM tblproexpediente a WHERE (a.id_proexpediente = tblagenda.id_expediente)) AS str_expediente FROM tblagenda;


ALTER TABLE public.vista_agenda OWNER TO postgres;

--
-- Name: vista_honorarios_cargados; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_honorarios_cargados AS
    SELECT DISTINCT tblprohonorarios.id_tipo, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblprohonorarios.id_tipo)) AS stritema, tblprohonorarios.modulo FROM tblprohonorarios ORDER BY tblprohonorarios.id_tipo, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblprohonorarios.id_tipo)), tblprohonorarios.modulo;


ALTER TABLE public.vista_honorarios_cargados OWNER TO postgres;

--
-- Name: vista_honorarios_tramites_cargados; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_honorarios_tramites_cargados AS
    SELECT tblprohonorarios.id_honorarios, tblprohonorarios.id_tipo, tblprohonorarios.id_tramite, tblprohonorarios.id_unidad, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblprohonorarios.id_tramite)) AS stritema, (SELECT tblunidadtributaria.ano FROM tblunidadtributaria WHERE (tblunidadtributaria.id_unidad = tblprohonorarios.id_unidad)) AS ano FROM tblprohonorarios GROUP BY tblprohonorarios.id_honorarios, tblprohonorarios.id_tipo, tblprohonorarios.id_tramite, tblprohonorarios.id_unidad;


ALTER TABLE public.vista_honorarios_tramites_cargados OWNER TO postgres;

--
-- Name: vista_movimiento_documentos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_documentos AS
    SELECT tbldocumento_seguimiento.id_documento_seguimiento, (SELECT tbldocumento.strnumero FROM tbldocumento WHERE (tbldocumento.id_documento = tbldocumento_seguimiento.id_documento)) AS strnumero, tbldocumento_seguimiento.id_documento, (SELECT ((btrim((tblcontacto.strnombre)::text) || ', '::text) || btrim((tblcontacto.strapellido)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tbldocumento_seguimiento.id_remite)) AS remite, tbldocumento_seguimiento.id_origen, (SELECT ((btrim((tblcontacto.strnombre)::text) || ', '::text) || btrim((tblcontacto.strapellido)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tbldocumento_seguimiento.id_remitente)) AS remitente, to_char((tbldocumento_seguimiento.fecdocumento_movimiento)::timestamp with time zone, 'DD/MM/YYYY'::text) AS fecha FROM tbldocumento_seguimiento;


ALTER TABLE public.vista_movimiento_documentos OWNER TO postgres;

--
-- Name: vista_tblproexpediente; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tblproexpediente AS
    SELECT tblproexpediente.id_proexpediente, tblproexpediente.strnroexpediente, tblproexpediente.strtitulo, tblproexpediente.strdescripcion, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_refer)) AS id_refer, to_char(tblproexpediente.fecapertura, 'DD/MM/YYYY'::text) AS fecapertura, to_char(tblproexpediente.feccierre, 'DD/MM/YYYY'::text) AS feccierre, tblproexpediente.bolborrado, tblproexpediente.strletrado, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_actuacion)) AS id_actuacion, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_honorario)) AS id_honorario, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_tramite)) AS id_tipo_tramite_text, tblproexpediente.id_tipo_tramite, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_atencion)) AS id_tipo_atencion, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_organismo)) AS id_tipo_organismo, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_organismo)) AS id_organismo, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_minuta)) AS id_tipo_minuta, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_minuta)) AS id_minuta, tblproexpediente.strobservacion, tblproexpediente.fecexpediente, tblproexpediente.strdireccion_asistido, tblproexpediente.strdireccion_conyugue, tblproexpediente.strdireccion_ultimo_domicilio, tblproexpediente.fecseparacion, tblproexpediente.intmonto_manutencion, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_regimen)) AS id_regimen, tblproexpediente.strdias, tblproexpediente.strhoras, tblproexpediente.intcuotames1, tblproexpediente.intcuotames2, tblproexpediente.cedula_abogado_responsable, tblproexpediente.cedula_abogado_ejecutor, tblproexpediente.cedula_cliente, tblproexpediente.strdocumentos, tblproexpediente.cedula_conyugue, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_citacion)) AS id_citacion, tblproexpediente.strobservacion_cerrar, tblproexpediente.strnroexpedienteauxiliar, tblproexpediente.strrepresentante, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_estado_fisico_expediente)) AS id_estado_fisico_expediente, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_espacio)) AS id_tipo_espacio, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_archivador)) AS id_tipo_archivador, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_piso_archivador)) AS id_tipo_piso_archivador, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente.id_tipo_archivador_gaveta)) AS id_tipo_archivador_gaveta, (SELECT ((upper((tblcontacto.strapellido)::text) || ', '::text) || upper((tblcontacto.strnombre)::text)) FROM tblcontacto WHERE (tblcontacto.id_contacto = tblproexpediente.id_abogado_resp)) AS id_abogado_resp, (SELECT ((upper(tbl_abogados.strapellido) || ', '::text) || upper(tbl_abogados.strnombre)) FROM tbl_abogados WHERE (tbl_abogados.id_abogado = tblproexpediente.id_abogado_ejecutor)) AS id_abogado_ejecutor, (SELECT ((upper((tbl_clientes.strapellido)::text) || ', '::text) || upper((tbl_clientes.strnombre)::text)) FROM tbl_clientes WHERE (tbl_clientes.id_cliente = tblproexpediente.id_solicitante)) AS id_solicitante, (SELECT ((upper(tbl_contrarios.strapellido) || ', '::text) || upper(tbl_contrarios.strnombre)) FROM tbl_contrarios WHERE (tbl_contrarios.id_contrarios = tbl_contrarios.id_contrarios) LIMIT 1) AS id_contrarios, tbl_clientes.strnombre, tbl_clientes.strapellido, tbl_clientes.strcedula, tbl_clientes.strdireccion, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tbl_clientes.id_estado)) AS id_estado, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tbl_clientes.id_municipio)) AS id_municipio, tbl_clientes.strtelefono, tbl_clientes.stremail FROM tblproexpediente, tbl_clientes WHERE (tblproexpediente.id_solicitante = tbl_clientes.id_cliente);


ALTER TABLE public.vista_tblproexpediente OWNER TO postgres;

--
-- Name: vista_tblproexpediente_fases; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tblproexpediente_fases AS
    SELECT tblproexpediente_fases.id_proexpediente_fase, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente_fases.id_tipo_fase)) AS id_tipo_fase, (SELECT tblmaestros.stritema FROM tblmaestros WHERE (tblmaestros.id_maestro = tblproexpediente_fases.id_fase)) AS id_fase, tblproexpediente_fases.strobservacion, tblproexpediente_fases.id_proexpediente, tblproexpediente_fases.fecfase FROM tblproexpediente_fases WHERE (tblproexpediente_fases.bolborrado <> 1) ORDER BY tblproexpediente_fases.id_proexpediente_fase DESC LIMIT 1;


ALTER TABLE public.vista_tblproexpediente_fases OWNER TO postgres;

--
-- Name: id_abogado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_abogados ALTER COLUMN id_abogado SET DEFAULT nextval('tbl_abogados_id_abogado_seq'::regclass);


--
-- Name: id_abogadoscon; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_abogados_contrarios ALTER COLUMN id_abogadoscon SET DEFAULT nextval('tbl_abogados_contrarios_id_abogadoscon_seq'::regclass);


--
-- Name: id_abogado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_abogados_representantes ALTER COLUMN id_abogado SET DEFAULT nextval('tbl_abogados_representantes_id_abogado_seq'::regclass);


--
-- Name: id_cliente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_clientes ALTER COLUMN id_cliente SET DEFAULT nextval('tbl_clientes_id_cliente_seq'::regclass);


--
-- Name: id_contrarios; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_contrarios ALTER COLUMN id_contrarios SET DEFAULT nextval('tbl_contrarios_id_contrarios_seq'::regclass);


--
-- Name: lngcodigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_demandantes ALTER COLUMN lngcodigo SET DEFAULT nextval('tbl_demandantes_lngcodigo_seq'::regclass);


--
-- Name: lngcodigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_expediente_referidos ALTER COLUMN lngcodigo SET DEFAULT nextval('tbl_expediente_referidos_lngcodigo_seq'::regclass);


--
-- Name: id_proactuacion_fase; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactuacion_fases ALTER COLUMN id_proactuacion_fase SET DEFAULT nextval('tblactuacion_fases_id_proactuacion_fase_seq'::regclass);


--
-- Name: id_proactuacion_situacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactuacion_situaciones ALTER COLUMN id_proactuacion_situacion SET DEFAULT nextval('tblactuacion_situaciones_id_proactuacion_situacion_seq'::regclass);


--
-- Name: id_proactuacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactuaciones ALTER COLUMN id_proactuacion SET DEFAULT nextval('tblactuaciones_id_proactuacion_seq'::regclass);


--
-- Name: id_adjunto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladjunto_documento ALTER COLUMN id_adjunto SET DEFAULT nextval('tbladjunto_documento_id_adjunto_seq'::regclass);


--
-- Name: id_agenda; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblagenda ALTER COLUMN id_agenda SET DEFAULT nextval('tblagenda_id_agenda_seq'::regclass);


--
-- Name: id_agenda; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblagenda_litigio ALTER COLUMN id_agenda SET DEFAULT nextval('tblagenda_litigio_id_agenda_seq'::regclass);


--
-- Name: lngcodigo_asociacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblasociaciones ALTER COLUMN lngcodigo_asociacion SET DEFAULT nextval('tblasociaciones_lngcodigo_asociacion_seq'::regclass);


--
-- Name: id_dictamen; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldictamenes ALTER COLUMN id_dictamen SET DEFAULT nextval('tbldictamenes_id_dictamen_seq'::regclass);


--
-- Name: id_documento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldocumento ALTER COLUMN id_documento SET DEFAULT nextval('tbldocumento_id_documento_seq'::regclass);


--
-- Name: id_documento_seguimiento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldocumento_seguimiento ALTER COLUMN id_documento_seguimiento SET DEFAULT nextval('tbldocumento_seguimiento_id_documento_seguimiento_seq'::regclass);


--
-- Name: id_maestro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblmaestros_sistemas ALTER COLUMN id_maestro SET DEFAULT nextval('tblmaestros_sistemas_id_maestro_seq'::regclass);


--
-- Name: id_proabogadoscasos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproabogadoscasos ALTER COLUMN id_proabogadoscasos SET DEFAULT nextval('tblproabogadoscasos_id_proabogadoscasos_seq'::regclass);


--
-- Name: id_proactuaciones; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproactuaciones ALTER COLUMN id_proactuaciones SET DEFAULT nextval('tblproactuaciones_id_proactuaciones_seq'::regclass);


--
-- Name: id_litigio_actuaciones; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproactuaciones_litigio ALTER COLUMN id_litigio_actuaciones SET DEFAULT nextval('tblproactuaciones_litigio_id_litigio_actuaciones_seq'::regclass);


--
-- Name: id_proclientecasos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproclientecasos ALTER COLUMN id_proclientecasos SET DEFAULT nextval('tblproclientecasos_id_proclientecasos_seq'::regclass);


--
-- Name: id_proexpediente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente ALTER COLUMN id_proexpediente SET DEFAULT nextval('tblproexpediente_id_proexpediente_seq'::regclass);


--
-- Name: id_proexpediente_abogados; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados ALTER COLUMN id_proexpediente_abogados SET DEFAULT nextval('tblproexpediente_abogados_id_proexpediente_abogados_seq'::regclass);


--
-- Name: id_proexpediente_abogados_demandantes; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados_demandantes ALTER COLUMN id_proexpediente_abogados_demandantes SET DEFAULT nextval('tblproexpediente_abogados_dem_id_proexpediente_abogados_dem_seq'::regclass);


--
-- Name: id_proexpediente_abogados_ejecutores; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados_ejecutores ALTER COLUMN id_proexpediente_abogados_ejecutores SET DEFAULT nextval('tblproexpediente_abogados_eje_id_proexpediente_abogados_eje_seq'::regclass);


--
-- Name: id_proexpediente_abogados_representantes; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados_representantes ALTER COLUMN id_proexpediente_abogados_representantes SET DEFAULT nextval('tblproexpediente_abogados_rep_id_proexpediente_abogados_rep_seq'::regclass);


--
-- Name: id_proexpediente_actuaciones; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_actuaciones ALTER COLUMN id_proexpediente_actuaciones SET DEFAULT nextval('tblproexpediente_actuaciones_id_proexpediente_actuaciones_seq'::regclass);


--
-- Name: id_proexpediente_fase; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_fases ALTER COLUMN id_proexpediente_fase SET DEFAULT nextval('tblproexpediente_fases_id_proexpediente_fase_seq'::regclass);


--
-- Name: id_hijos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_hijos ALTER COLUMN id_hijos SET DEFAULT nextval('tblproexpediente_hijos_id_hijos_seq'::regclass);


--
-- Name: id_proexpediente_personas_demandadas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_personas_demandadas ALTER COLUMN id_proexpediente_personas_demandadas SET DEFAULT nextval('tblproexpediente_personas_dem_id_proexpediente_personas_dem_seq'::regclass);


--
-- Name: id_proexpediente_situacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_situaciones ALTER COLUMN id_proexpediente_situacion SET DEFAULT nextval('tblproexpediente_situaciones_id_proexpediente_situacion_seq'::regclass);


--
-- Name: id_honorarios; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblprohonorarios ALTER COLUMN id_honorarios SET DEFAULT nextval('tblprohonorarios_id_honorarios_seq'::regclass);


--
-- Name: id_honorarios; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblprohonorarios_litigio ALTER COLUMN id_honorarios SET DEFAULT nextval('tblprohonorarios_litigio_id_honorarios_seq'::regclass);


--
-- Name: id_juzgados; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblprojuzgados ALTER COLUMN id_juzgados SET DEFAULT nextval('tblprojuzgados_id_juzgados_seq'::regclass);


--
-- Name: id_unidad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblunidadtributaria ALTER COLUMN id_unidad SET DEFAULT nextval('tblunidadtributaria_id_unidad_seq'::regclass);


--
-- Data for Name: tbl_abogados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_abogados (id_abogado, strdireccion, strcodigopostal, strlocalidad, id_estado, id_municipio, strtelefono, strmovil, strfax, stremail, strpin, strobservaciones, intbanco, strcuentaban, strfoto, strcurriculum, strnombre, strapellido, strnif_cif, strnumcolegiado, strrif, id_sexo, strcedula, bolborrado) FROM stdin;
5	a			12936	12939	04262345322			c@gmail.com			0				c	coello		12233		12962	789	1
6	a			12936	12939				c@gmail.com			0				c	coello				12962	789	1
4				12936	12948							0				Jorge	Piña				12961	12079341	1
3	direccion			12936	12948	000000000						0				Carlos	Mogollon			1233445	12961	13179167	1
7	gkviyv	3001		12936	12940	234567	234567		yfyrfry@gmail.com	34567	cfjc	12974			rgv	jaime	suarez		234567	23456	12961	12345678	1
8	calle paez			12936	12939	04165121312			bla@gmail.com			0				blafe	coello		12235j		12962	16594668	1
10	Sexta Avenida con calle 21 y paseo Guayabal, San Felipe Yaracuy	3201	San Felipe	12936	12948	0424-5065394	0424-5065394		alejandradelvigne@hotmail.com	29A297FA		0				Alejandra  Isaura	Delvigne Mendoza		108.984	V-13986423-5	12962	13986423	0
11	Sexta Avenida con calle 21 y paseo Guayabal, San Felipe Yaracuy	3201	San Felipe	12936	12948	0424-5065394	0424-5065394		alejandradelvigne@hotmail.com	29A297FA		0				Alejandra  Isaura	Delvigne Mendoza		108.984	V-13986423-5	12962	13986423	1
13	Sexta avenida, entre  calle 21 y paseo Guayabal, San Felipe. 	3201	San Felipe	12936	12942	04263101974	04263101974		carlos021_40@hotmail.com	30D42A11		0				Carlos 	Camacaro		114393	14377793-2	12961	14377793	0
14	6ta av entre calle 21 y paseo guayabal	3201	San Felipe 	12936	12948	0412 7610001			lfyuraly@Gmail.com	26B10885		0				Yuraly	Laya		62559		12962	7918880	0
9	6ta avenida entre calle 21, paseo guayabal	3201	san felipe	12936	12948	04165016611			yessi_donaire@hotmail.com	28b82d27		0				Yessica	Grupillo		129315	176991751	12962	17699175	0
12	6ta Avenida entre calle 21 y Paseo Guayabal	3201	San Felipe	12936	12948	0424-5143761			yjgimenez@hotmail.com			0				Yulenni Josefina	Gimenez Nadal		119.384	V-14709673-5	12962	14709673	0
15	urb. la ascension, calle 1, N° 28, San Felipe-Yaracuy 		San Felipe	12936	12948	0416-7532593			jesus_gz@hotmail.com			0				Jesus 	Galindez			V-07912137-8	12961	7912137	0
16	N/P			12936	12948	(0414) 545.55.79			pruebagmail.com			0				SUHAIL ANAYANTZI	HERNANDEZ ALVARADO				12962	12282113	0
17	N/P			12936	12948	(0414) 528.51.22			prueba@gmail.com			0				ERICK	DURAN				12961	14919653	0
18	6 Av. con Guayabal			12936	12948	(0426) 152.44.40			lada_yar@hotmail.com			0				lenin	delgado				12961	12278774	0
19	Urb. Las Tejitas Calle principal con calle de servicio casa 69 			12936	12941	(0426) 756.88.79			miguelvergara@hotmail.es			0				Miguel 	Vergara				12961	13795178	0
20	Calle principal el Guayabo			12936	12951	(0426) 435.37.93			animadepicapica@gmail.com			0				HUMBERTO	FALCON				12961	13503717	0
21	Urb. San Antonio transversal 5 nro 16-7a			12936	12948	(0414) 522.08.84			sonia_ca24@hotmail.com			0				SONIA	VELAZQUEZ		170922		12962	15910627	0
22	calle 19 entre 3 y 4 avenida nro 3-22			12936	12948	(0416) 089.57.24			mescalona7510@yahoo.es			0				mara	castillo		1818		12962	7510279	0
\.


--
-- Data for Name: tbl_abogados_contrarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_abogados_contrarios (id_abogadoscon, strdireccion, strcodipostal, strlocalidad, id_estado, id_municipio, strmovil, strtelefono, strfax, stremail, strpin, strobservaciones, strnombre, strapellido, strnif_cif, strcedula, strnumcolegiado, strrif, bolborrado) FROM stdin;
7	qerteter	112	gfdgdf	12936	12948	(0412) 344.53.45	(0412) 435.34.55	132424325	fsbgh@ghgf.com	94815	sdvfdbgfbh	hector	escalona	3e43425	11648851		12434354	0
42	urb. vella vista casa B-14			12936	12948							Carlos 	Abreu Marin		11895002	128867		0
10	calle 15 entre avenidas 8 y 9		san felipe	12936	12948		(0412) 564.23.69		mimilesilva@hotmail.com	74201		Mimile 	Silva		14442223	74.201		0
11	cascabel			12936	12948		(0416) 501.66.11		juan_perez@hotmail.com			carlos	pinto		14875623			0
12	Calle 15 con Av. 10 Municipio San felipe	3201	San felipe	12936	12948		(0412) 780.57.78		Jesus	149.146		Jesus	Jordan		17.611.104	149.146		0
13	Av. la Patria con Av. 12 Edif. Reanpaso, Piso 1 Oficina 2	3201		12936	12948		(0424) 111.28.68		Maigualidad@hotmail.com	73.225		Maygualida 	Leon Castillo		6.326.389			0
16	4ta. Av. con Calle 13, Centro profesional Capri, piso 4 Oficina 4-2  Estado Yaracuy		San Felipe	12936	12948		(0416) 155.89.69					Zafiro 	Navas		7513976	24.555		0
18	Calle Caja de Agua, media cuadra de la Comandancia de Policia Parroquia Campo Elias del Municipio Bruzual del Estado Yaracuy 		San felipe	12936	12948							Ana Yaceny A	Arias		34361	34361		0
19	Escritorio Juridico Bermudez Asociados calle 12entre Av. 9y 10 Edif. Cadi planta baja	3201		12936	12948							Gloria Evelina	Gimenez Gonzalez		7589584	119215		0
20	Barquisimeto Estado Lara			12926	0							Yiorli A	Alvarez A		14938336	108630		0
21	Barquisimeto Estado Lara			12926	0							Juan Carlos	Rincones		13795019	126004		0
22	San Felipe		San Felipe	12936	12948		(0416) 754.99.50					Luis Eduardo	Dominguez		4972225	20918		0
23	Av. 34 entre 32y33 Centro Empresarial Guanaguanare piso 2 Oficina 2-2 Acarigua Estado Portuguesa			12931	0	(0414) 510.61.85						Carlos 	Cedeño Azocar		8067620	56364		0
24	Edificio Lopez Ortega, 8va Avenida			0	0							Gilberto 	Corona Ramirez		65407			0
25	Carrera 15 entre calles 27 y 28, edificio Torre Centro-Pent-House Sur. Barquisimeto Edo. Lara		San Felipe	12936	12948		(0000) 000.00.00					Ruben Dario 	Rodriguez		13842371	90096		0
26	Av. 34 entre calle 32 y 33 Centro Empresarial Guanaguanare Piso 2 Oficina 2-2 Acarigua  Estado Portuguesa			12931	0	(0424) 545.90.20						Norely	Aguin de Cedeño		13328560	77874		0
27	Av. Libertador entre Calles 12 y 13  Municipio San Felipe Centro Comercial Yurubì piso 02 Local 08		San felipe	12936	12948							Mary Leny	Dominguez		16481201	127.019		0
28	edificio Dios provee, piso 1 oficina 04, Avenida Sexta Municipio Nirgua Estado Yaracuy			0	0							Adriana 	Rodriguez Linarez		10858671	102619		0
29	Centro Profesional Capri, piso 2 oficina 2-19.  San Felipe Estado Yaracuy			0	0							Josmir Jenedy	Segura		18758209			0
30	Centro Profesional y Comercial ROSAJUAN Av. 10 esquina Calle 16 San felipe	3201		12936	12948							Ramon E	Marin G		7514182	55313		0
14	Avenida 6, entre calle 3 y 14, Edificio Don Dario, ofinas 3 y 4 .			12936	12948							Elio José 	Zerpa		826945	0568		0
15	Avenida 6, entre calles 13 y 14, Edificio Don Mario, oficinas 3 y 4.			12936	12948							Robert José	Zerpa		10857662	67336		0
17	Avenida 3 entre calles 3 y 4, casa numero 82			12936	12946							Balmore	Rodriguez		7506089	34902		0
31	Calle 11 entre Av. 8 y 9 San Felipe	3201		12936	12948							DHYKSSON	aSILDA		16262706	148001		1
9	a	123	b	12936	12948	(0412) 367.23.44	(0426) 342.32.67	2131425435345	b@gmail.com	4234324	dsfadst	b	suarez	325r34534	456	56757	j-123124324	1
8	a		b	12936	12948	(0412) 367.23.44	(0426) 342.32.67	2131425435345	b@gmail.com	4234324	dsfadst	b	suarez	325r34534	456	56757	j-123124324	1
6	c fhcf	301	nnuq	12936	12939	(2345) 678.99.87	(2234) 567.89.34	1234567	yrdrdtrtd	23	jvjufltu	carlos	diaz		111111111	5733	345678	1
32	Av 6 entre calles 11 y 12			12936	12948							Yosmar Leidibel	Duin Griman		000000	153759		0
33	calle 15 Inspectoria del Trabajo en el estado Yaracuy			12936	12948	(0424) 430.39.22						Jesus Humberto	Delgado		000	82844		0
34	Calle 12 entre Av. 10 y 11 casa Nº 10-3 Municipio San Felipe.	3201		12936	12948							Yohana Mirella	Moreno Parra		16949128	129.316		0
35	San Felipe	3201		12936	12948						Demanda por Prestaciones Sociales	Maria Gloria 	Reyes Gonzalez		14998541	119.216		0
36	San Felipe, Yaracuy			0	0							Yanitza Alexandra	Ramirez		13696016	101.672		0
37	Calle 11 entre Av 9 y 10			12936	12948							Milena	Aristimuño		4970377			0
38	calle 12 av 9 y 10 edif CADI			12936	12948							Luz Eddy	Hernandez Castro		13503768	102812		0
39	calle 12 entre av 9 y 10			12936	12948							Jhoselyn 	Marquez		14798964	102883		0
40	calle 11 av 9 y 10			12936	12948							Yusbiry	Pineda		13986167	115081		0
41	Av. 3 calle 10 Nº 19-81 La Mata  ciudad de Cabudare Municipio Palavecino del Estado Lara			12936	12948						Demanda por Prestaciones Sociales	Yris Coromoto	Medina Gonzalez		7349818	38096		0
43	urb. vella vista B-14			12936	12948							Yasneris 	Mujica Marin		15108576	106263		0
44	Calle 11 entre Av. 8 y 9 San Felipe 			12936	12948						Beneficio de jubilaciòn	Dhyksson	Asilda		148001	148001		0
45	Calle 12 entre Av. 10 y 11 Casa Nº 10-3 san felipe			12936	12948							Saraith	Addad		10860414	79119		0
46	calle 19, carrera 23 			12936	12947							Rosangela 	Vazquez		16323330	121912		0
47	Av. 8 entre Calle 11 y 12 Edificio Jandal, Piso 1 Oficina 4 Escritorio Juridico Salcedo & Asociados san felipe			12936	12948						Demanda por Prestaciones Sociales.	Katherine Betina	Gomez Romero		18531637	149832		0
48	6ta av  esquina calle 11 			12936	12948							Gissel de Jesus	Gimenez Handen		17775745	135668		0
49	calle 12 con av 6 			12936	12948							Mariela	Piñero		11270572	108417		0
50	San Felipe Estado Yaracuy			0	0							Douglas	Fuentes		8519302	74.264		0
51	C.C. Doña Celia 2do Nivel carrera 11 esquina Calle 20 Yaritagua municipio Peña del Estado Yaracuy			12936	12948						Demanda por Prestaciones Sociales 	Mirenis del Carmen 	Coronado Perez		12283870	118932		0
52	4ta av, calle 12 y 13			12936	12948							Luis 	Fonseca		3911535	17619		0
\.


--
-- Data for Name: tbl_abogados_representantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_abogados_representantes (id_abogado, strdireccion, strcodigopostal, strlocalidad, id_estado, id_municipio, strtelefono, strmovil, strfax, stremail, strpin, strobservaciones, intbanco, strcuentaban, strfoto, strcurriculum, strnombre, strapellido, strnif_cif, strnumcolegiado, strrif, id_sexo, strcedula, bolborrado, id_tipo_organismo, id_organismo) FROM stdin;
3				0	0							0				Gimena	Gonzales				0	4720418	0	\N	\N
2				0	0							0				Guillermo 	Luna				0	17111234	0	13015	13016
4	direccion			12936	12940							0				Erika	Chacon				0	7889854	0	14059	14060
6	av los sauces			12936	12948	041585941						0				juan	mendoza				12962	15388859	0	0	0
7	calle Principal de Brisas del Terminal	3201	San Felipe	12936	12948	0414-5496571	0414-5496571		silvag.isis@hotmail.com	2387F320		0				Isis Mariam 	Silva			18547988-5	12962	18547988	0	14059	13434
8	Callejon cascabel entre Av. Yaracuy y Av. Cedeño	3201		12936	12948	04149527324			Gaby331@hotmail.com	273B264C		0				Gabriela	Gonzalez		12.0850		12962	15284955	0	14059	13426
9	Callejon Cascabel entre Av cedeño y Ravell	3201		12936	12942		(0412) 774.89.42					12967				Norelida 	Gimenez				12962	14710381	0	14059	13020
1	ugyuoguot	3001		12936	12939	12345			iygy@iyl.com			0				valeria2	suarez			123456	12962	111111	1	13015	13395
5				0	0							0									12962		1	14059	13425
10	6ta avenida entre calles 8 y 9			0	0							0				Amilcar  Manuel	Salazar Caro				0	92.441	0	0	0
11	6 avenida al lado del paseo guayabal			12936	12948							0				Carolina	Puertas		49.419		0	7914585	0	0	0
12	6ta avenidad con calle 21 y paseo Guayabal.			12936	12942	(0254) 232.46.87						0				Carlos 	Camacaro		114393		12961	14377793	0	13015	13016
13	6ta av entre calle 21 con quebrada guayabal			12936	12948							0				Yessica 	Grupillo		129315		12962	17699175	0	0	0
\.


--
-- Data for Name: tbl_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_clientes (id_cliente, strnombre, strapellido, strcedula, strdireccion, id_estado, id_municipio, strtelefono, stremail, id_estado_civil, id_sexo, inthijos, strcodigopostal, datefecnac, strobservacion, id_representante, id_organizacion, strdocumentoconst, strrif, strmovil, bolborrado) FROM stdin;
8	kelly	sandoval	17254816	las tapias calle alegria calle principal casa s/n	12936	12948	(0426) 454.70.86		12956	12962	0		1982-03-12		\N	\N	\N	\N	\N	0
9	GABY LYA	GARCIA AGUIAR	16483620	URB. NUEVO BORAURE ENTRE CALLES 6 Y 4	12936	12944	(0412) 522.21.82	n/t	12956	12962	0		1985-03-17		\N	\N	\N	\N	\N	0
10	Jose	Moreno	13094455	Avenida 02 entre 33 y 34	12936	12948	(0426) 107.77.12	np	12957	12961	1	3201	1977-06-05		\N	\N	\N	\N	\N	0
11	Alicia	Gimenez	12536225	Sector Chariagro, Parroquia Albarico, Municipio San Felipe	12936	12948	(0416) 058.73.90		12957	12962	0	3201	1973-02-05		\N	\N	\N	\N	\N	0
12	YUDERKYS	ACOSTA MARCHENA	11649725	CALLE 6 /5Y 6 Av.	12936	12942	(0414) 574.92.65		12956	12962	0		2013-01-29		\N	\N	\N	\N	\N	0
\.


--
-- Data for Name: tbl_contrarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_contrarios (id_contrarios, strnombre, strapellido, strcedula, strdireccion, id_estado, id_municipio, strtelefono, stremail, id_estado_civil, id_sexo, inthijos, strcodigopostal, datefecnac, strobservacion, id_representante, id_organizacion, strdocumentoconst, strrif, strmovil, bolborrado) FROM stdin;
5	victor	gonzalez	8518352	aaa	12936	12948	(0412) 134.65.67	adsa@gkkl.com	12957	12961	2	222	2000-12-12 00:00:00	agdfsh	\N	\N	\N	\N	\N	0
6	victor	gonzalez	8518352	aaa	12936	12948	(0412) 134.65.67	adsa@gkkl.com	12957	12961	2	222	2000-12-12 00:00:00	agdfsh	\N	\N	\N	\N	\N	1
7	victor	gonzalez	8518352	aaa	12936	12948	(0412) 134.65.67	adsa@gkkl.com	12957	12961	2	222	2000-12-12 00:00:00	agdfsh	\N	\N	\N	\N	\N	1
8	victor	gonzalez	8518352	aaa	12936	12948	(0412) 134.65.67	adsa@gkkl.com	12957	12961	2	222	2000-12-12 00:00:00	agdfsh	\N	\N	\N	\N	\N	1
9	ab	suarez	123	a	12936	12948	(0412) 345.67.88	aqws@gmail.com	12958	12961	2	1234	1988-12-28 00:00:00	asdfsf	\N	\N	\N	\N	\N	1
12	a	suarez	123	a	12936	12948	(0412) 345.67.88	a@gmail.com	12958	12961	2	1234	1978-12-28 00:00:00	a	\N	\N	\N	\N	\N	1
11	a	suarez	123	a	12936	12948	(0412) 345.67.88	a@gmail.com	12958	12961	2	1234	1978-12-28 00:00:00	a	\N	\N	\N	\N	\N	1
18	Claret	Ruiz	8516146	Urbanizacion Brisas del Terminal, calle 3, casa N° 30	12936	12942			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
13	Gladys Yolanda	Suarez	4720418	no encontrada	12936	12941	(5656) 565.65.65	ingjjsg@gmail.com	12956	12962	2	N/P	2013-01-16 00:00:00		\N	\N	\N	\N	\N	0
15	Henrry Eleuterio	Diaz Abarca	7.905.900	avneida caracas	12936	12948	(0414) 566.33.32	ajnxknx	12957	12962	0	3201	1956-03-02 00:00:00		\N	\N	\N	\N	\N	0
16	violeta	brant	2566914	cartagena	12936	12948	(0416) 501.66.12	violeta@hotmail.com	12959	12962	2	N/P	2001-10-21 00:00:00		\N	\N	\N	\N	\N	0
17	Carlos Jesus 	Rodriguez Perez	4477147		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
20	Carlos Jose 	Gimenez Velasquez	7582834		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
21	Nixon Alexander	Camacho Escarcha	16594785		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
22	Miguel Angel	Camacho Camacho	7578705		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
23	Rainier Alberto	Gonzalez Cordero	10373068		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
24	Ramon Florencio	Rivero Vera	16022760		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
25	Jose Gregorio	Sequera Sequera	16453377		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
26	Hermenegildo Ramon	Beltran Ochoa	4475578		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
27	Tomas Alfredo	Castillo Garcia	8831398		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
28	Celso Guillermo	Montes Gutierrez	7575003		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
29	Victor Julio	Mendoza Gomez	8516336		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
30	Agustin	Pinto Sumoza	6605456		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
31	Orlando Jose	Graterol Valderrama	15107478		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
32	Freddy Alberto	Torres	8517399		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
33	Yanitza Alexandra	Ramirez	13696016		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
35	Fabricio Antonio	Ruiz Castillo	15598634		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
37	Yosmar	Pinto	15283169		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
38	Eligio Ramon 	Peralta Bonito	7598080		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
40	Pablo Antonio	Oliveros Hernandez	7586162		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
41	Genaro	Parra	7577079		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
10	a	suarez	123	a	12936	12948	(0412) 345.67.88	a@gmail.com	12958	12961	2	1234	1978-12-28 00:00:00	a	\N	\N	\N	\N	\N	1
42	William Jose	Marquez Colmenarez	7906947		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
43	Genadio	Segundo GrandaGutierrez	10374072		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
44	Manuel Clemente 	Hernandez Jimenez	7507066		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
52	Manuel Antonio	León Rodriguez	7557825		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
45	Caris Rafael 	Quintero Leon	8514460		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
46	Jose Luis 	Gimenez Barrios	11279020		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
47	Marcos Ramon	Gimenez Torrealba	11272310		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
48	Jean Carlos	Jimenez	13618633		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
49	Winston	Zerpa	12936269		12936	12948			0	12961	0	3201	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
51	Americo	Gonzalez	10859142		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
53	Ventura Antonio	Rios Pacheco	4971820		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
14	njh	ghfhj	165946689	ughyguy	12936	12940	(0412) 125.85.96	a@g.com	12958	12962	0	N/P	2013-01-16 00:00:00		\N	\N	\N	\N	\N	1
55	Eduardo Garmendia	Gonzalez Hernandez	8511985		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
56	Gabrielina Mercedes	Echeverria Faneite	14483200	Calle 15 entre Av. 10 y 11 San Felipe Estado Yaracuy	12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
57	Maria Inmaculada	Castillo Sequera	14209871		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
59	Rafael Ramon 	Rouffet Escobar	5465398		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
60	Jose Hermogenes	Cabrera Nieves	4130292		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
61	Carlos Alberto	Arias Dominguez	15070442		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
62	Eliodoro Antonio	Quiñonez Martinez	7511239		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
65	Carlos Alfredo	Sanchez Rumbo	10232545		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
67	Victor Julio	Piñero	6717788		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
50	Jorge Felix	Gutierrez Hernández	7910226		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
19	Maigualida	Gutierrez	10373079	Avenida 2 entre calles 11 y 12, casa N° 11-59	12936	12950			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
36	Jesus Maria	Escalona Campos	10855995		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
58	Jairo German	Velasquez Rosas	9098938		12936	12946			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
34	Angel Ramón	Cordero	10868949		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
39	Freddy Antonio	Marchan Rivero	12938329		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
66	María Audiencia	Galindez	7587090		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
63	Solangui Josefina	Arriechi Pérez	12285433		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
4	jean	suarez	15230592	jvhgvk	12936	12939	(1234) 567.89.87	ufdyu	12957	12961	3	3001	2012-12-12 00:00:00		\N	\N	\N	\N	\N	1
54	Gregorio Antonio	Garmendia Colmenarez	11273895		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
64	Eva Maria	Yovera Escorche	18302057	Calle 15 entre Av 10 y 11 San Felipe Yaracuy	12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
68	Juana Francisca 	Torres Lobo	12283174		0	0			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
69	Jesus Ramon	Ochoa Guillen	7906150		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
70	María Natividad 	Ortiz	5456974		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
71	Nabetzi Sorelis 	Galíndez Martínez	15387506		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
72	María Magdalena 	Molletones Márquez	7576249		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
73	Nellys Del Carmen 	Mendoza Peroza	11260617		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
74	Santiago Apostol	Oviedo	8771456		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
75	Elis Misael	Espinoza Jayaro	6208918		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
76	Xiomara Mercedes 	Oropeza Urbina	7585415		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
77	Raul Marcelino	Lopez	7584220		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
78	Zoila Rosa 	González	7580396		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
79	Carlos Alberto	David Chinchilla	14272319		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
80	Domingo Afredo	Mota	4476254		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
81	Narciso Ramón 	Pineda	3292952		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
82	Marbella Josefina	Villegas Sequera 	13695939	Calle 15 entre Av 10 y 11 San Felipe Estado Yaracuy	12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
83	Carlos Antonio 	Heredia Graterol	3912475		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
84	Luis Enrique	 González Castillo	7579166		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
85	Fernando Antonio 	Pérez	10373055		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
86	Antonio Enrique 	Torres Lobos	11276640		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
87	Víctor Manuel	 Puertas Carrizales	11654070		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
88	Yulimar del Carmen	Ulacio Rojas	15387855	Avenida 02 entre 33 y 34	12936	12948			12957	12962	1	N/P	1980-05-27 00:00:00		\N	\N	\N	\N	\N	0
89	Victor J	Castillo	7505032	Cumaripa Municipio Bruzual del Edo Yaracuy	12936	12948			0	12961	0	3201	2013-01-21 00:00:00	Demanda por Prestaciones Sociales 	\N	\N	\N	\N	\N	0
90	Alicia Josefina	 Rojas	7586374		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
91	Ana Mercedes 	Traviezo	7578235		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
92	Judith Mercedes 	Herrera Mora	4888553		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
93	Angel R	Escalona B	4475965	Calle 15 con Av. 10 Municipio san felipe. Procuraduria Especial de Trabajo 	12936	12948			0	12961	0	3201	2013-01-21 00:00:00	Demanda de Prestaciones Sociales	\N	\N	\N	\N	\N	0
94	Damelys Coromoto 	Guevara Oropeza	10365306		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
95	Carlos Alberto  	González Pérez	7907649		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
96	Víctor José  	Castellano Galíndez	7589736		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
97	Zulay Coromoto 	Acosta de Querales	10370476		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
98	Edys María 	Herrera de Sánchez 	7503680		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
99	Milagro Coromoto 	Sánchez	11654864		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
100	Lila Margarita 	Montero de Tovar 	12282657		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
101	Dulce María 	Salero	4964098		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
102	Erika 	Gonzalez	12433135		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00	Demanda por Prestaciones Sociales y Salarios Caidos	\N	\N	\N	\N	\N	0
103	Yraida Margarita	 González García 	6130282		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
104	María Elicia	 Hernández 	6630906		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
105	Alicia del Carmen 	Alvarado Duran 	7909116		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
106	Filandia Teresa 	Albis Lucena 	7513032		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
107	Juan	Cuicas	7559209		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
108	Roiban	 Sandoval 	11277994		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
109	Mario 	Bustillos	10366.65		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
110	Freddy 	Salazar 	4480953		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
111	Henry Eleuterio	Diaz Abarca	7905900		0	0			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
112	Richard	Gutierrez	7911707		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
113	Eduin 	Morillo 	11647504		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
114	Luis	 Inojosa	3911882		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
115	Joici J	Carmona E	14209588	Calle 29 con Av 3 y 2 , Municipio Independencia.	12936	12948			0	12962	0	N/P	2013-01-21 00:00:00	Demanda por prestaciones Sociales 	\N	\N	\N	\N	\N	0
116	Willbert Alexi 	Montiel Bazán	12079561		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
117	Eduar jose	Travieso	17319751	calle principal de Bicure	12936	12950			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
118	luis	Gimenez	4965038		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
119	Ismael 	Grao	13986871	Sector Chariagro, Parroquia albarico	12936	12948			12957	12961	0	3201	1978-01-28 00:00:00		\N	\N	\N	\N	\N	0
120	Nelson 	Araque	1987700		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
121	Gixon Jose	Suarez	12938883		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
122	Luis David	Escalona	11278378		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
123	Carlos Francisco	Roa Andrades	13985286		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
124	Jhonny Alberto	Gimenez Gomez	10279735		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
125	Jacinto Daniel	Puerta Peralta	11653808		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
126	Jose del Carmen	Jimenez Oropeza	8518430		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
127	Cruz Jose	Silva Medina	12277689		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
128	Yris C	Medina G	7349818	Av. 3 con Calle 10 Nº 10-81 La Mata Ciudad de Cabudare Municipio Palavecino Edo. Lara	12936	12948			0	12962	0	N/P	2013-01-21 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
129	Douglas Armando	sanchez 	11648141		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
130	Nelly Coromoto	Escobar	7911789		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
131	Octavio Ramon 	Castillo	4475795		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
132	Walter Jose	Parra Barillas	8513226		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
133	Bitelba 	Gonzalez de Marin	2177212	Calle25 cruce con la Av cartagena, Quinta Emilia Nº 13-34 Sector Corocito Municipio Independencia	12936	12948			0	12962	0	N/P	2013-01-21 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
134	Mirna Coromoto	Maturel Escalona	11649527		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
136	Neivis Yalin	Duran	11277030		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
135	Hermenegilda Zenobia	 Valles	7575893		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
137	Aureliano Jose	Diaz Corniel	13096338		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
138	Carlos Ildemar	Villegas Cordero	12279383		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
139	Naudy Vicente	Silva Coronel	12280982		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
141	Jose Ramon 	Lira Ortega	13313689		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
140	Petra María	Cordero	7510552		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
142	Gil Francisco	Lira Hernandez	13313975		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
143	Dewinght Stanley	Marin Orozco	7905297		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
144	Raul Salvador	Diaz Fernandez	5539176		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
145	Rodrigo Juarez	Figueroa	8518231		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
146	Ender Jose	Perez Blanco	12745742		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
147	Marbelys Beatriz	Rios Campos	12282943		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
149	Juan Ramona	Diaz Rodriguez	6603254		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
148	Silvestre 	Figueredo	2573808		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
150	Norka Thais	Silva Griman	12283166		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
151	Aura	Montes	4481442		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
152	Rosa Dominga	Peralta	3455694		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
153	Moraima Garrido	Garrido	4477624		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
154	Carmen 	Alejos	4479844		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
155	Mara Clemencia 	Leal	3979283		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
156	Francisca 	Graterol	4343217		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
157	Yolanda	Aguilar	3708981		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
158	Simón	 Hernández	3708141		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
159	Egilda	Mendoza	4125406		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
160	Marcos Jose 	Campos	2570576		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
161	Victor Julio	Gonzalez	12725631	Av. Indio Yara, Sector Jose Gregorio hernandez,casas/n Aroa Municipio Bolivar Edo. Yaracuy	12936	12948			0	12961	0	N/P	2013-01-21 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
162	Arbelys Yesenia 	Dorante Rivero	14798228		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
163	Francisco 	Rodriguez	3458595		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
165	Virginia	Avila	5462466		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
166	Abrahan Ali	Guevara Jimenez	20393997		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
164	Maria Rafaela	Sanchez Machado	3913715		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
167	Cruz	Arevalo	3458885		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
168	Nelson Jose	Gutierrez Sanchez	8510636		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
169	Juan 	Palacios	4967525		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
170	Sobeida Alejandra	Betancourt Valero 	18302333		0	0			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
171	María 	Sequera B	10374675		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
172	Mario Ascensión 	Yovera	3259330		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
173	Eladia Maria	Montero de Nadal	3456191		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
174	Eladia Maria	Montero de Nadal	3456191		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
175	Félix Ramón 	Ríos Bruno	3602037		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
176	Dulce Esperanza	Campos Piña	4970706		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
177	Yoselin Margarita	Sandrea Martinez	17256423		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
179	Mirian Aracely 	Gonzalez Salas	12707554		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
180	Rosa Benita	Asuaje	3911185		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
181	Orlinda Mercedes 	Montoya	7912155		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
182	 Elisa 	Gutiérrez López 	11277384		12936	12948			0	0	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
183	Douglas Francisco	 Mendoza Silvestre	10373659		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
185	Andrés Ramón  	Delgado	3458614		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
186	Jonathan David	Colmenarez Mogollon	15284857		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
187	Euclides Antonio 	Parra Gonzalez	12285274		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
188	Sergio Manuel 	Suarez Guedez	10371553		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
189	Raul Antonio	Camacho	7555152		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
191	Eduardo Jose	Perazzo Ramirez	10374907		12936	0			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
190	Ángel  Ramon 	Aguiar Baudin	10374352		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
192	Maryhevin Alexandra 	Pereira de Perez	12938247		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
178	Ramon 	Parra	17156316		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
184	Egla Marina 	Rusa Suarez	11647086		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
193	Pedro Ramon	Sirit Jimenez	7165816		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
194	Maria Angelica 	Sanchez Perez	15966166		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
195	Guillermo Javier	Oropeza Lima	15965171		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
196	Alberto Polanco	Alvarez	7580926		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
198	Yvor Alejandro 	Campos	15285876		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
197	Angelica Maria	Perez Montiel	12077591		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
199	Jose Martin 	Escobar Arroyo	17633049		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
200	Jesus Alberto 	Solorzano Medina	18115618		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
201	Juan Lorenzo 	Palacios	4970578		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
202	Mario Rivas 	Briceño	4971427		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
203	Clexis Nathalia	Diaz Gutierrez	17699544		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
204	Julio Jose 	Colmenarez Arteaga	15338378		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
205	Juan Carlos Luis	Orozco Romero	13094597		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
206	Eugenio 	Trejo Alfin	13618770		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
207	Maria Laura	Snchez Quintero	17523287		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
208	Eddy Jhoan	Peralta	14442848		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
209	Rosa Maria 	Yovera	5889992		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
210	Edgar Jose	Parra	10764935		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
211	Irene Carolina	Bazan	13503786		12936	0			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
212	Mileive Josefina	Peraza	15387810		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
213	Libaldo Jose Trejo	 Trejo	7909685		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
214	Luis Angel	Piña	19551266		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
215	Juan Ramon	Ugarte	7484201		12936	12948			0	12961	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
216	Martha Esmeralda 	Borges	10370276		12936	12948			0	12962	0	N/P	2013-01-21 00:00:00		\N	\N	\N	\N	\N	0
217	Vicente	Pimentel	4959414		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
218	Alvarado Daniel	Camacho Veroes	12077307		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
219	Neidi Coromoto	Pineda Gimenez	16951051		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
220	Jose Gabriel 	Jimenez Rosales	17469247		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
221	Marluy 	Escalona Rivas	12279172		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
222	Maribel del Rosario	Yanez Freitez	10854323		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
224	Sandi 	Garcia Landinez	15387754		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
251	Evelyn 	Pacheco Gonzalez	13435517		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
223	Nelson Enrique 	Seco Peraza	20464314		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
225	Jaivert Paul	Pacheco Colmenarez	20464832		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
226	Domingo	Guzman Colina	4109048		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
227	William Eduardo	Alvarado Aguero	7585015		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
228	Cruz	Colmenarez	11271967		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
229	Eduardo Antonio	Alvarez	4233500		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
230	Jose Rafael 	Fonseca Mora	2573514	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Beneficio de Jubilaciòn	\N	\N	\N	\N	\N	0
231	Edgar Manuel	Alvarado	10855432		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
232	Solylexis Mariant	Maturet Lozada	18052531		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
233	Oswaldo Enrique	Guerra	7404690		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
234	Claudio Jose	Linarez Teran	15448129		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
235	Antonio Luis	Yepez	7377609		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
236	Richar Elieser 	Ruiz	10580861		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
237	Johan Epifanio	Sanchez	14998762		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
238	Leopoldo Francisco	Starke Colmenarez	4837237		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
239	Mercedes Ramon	Mendoza	3087157		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
240	Victor manuel	Marin Rodriguez	5464072		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
241	Francisco Sulpicio	Pinto	7580831		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
242	Omar Alexander	Alejos	4968833		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
243	Samuel Jose	Sanabria	6602668		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
244	Hernan Jesus	Vasquez	4381279		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
245	Norberto Carmelo	Vega	10367068		0	0			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
246	Jose Gustavo	Villegas	7914299	Av. 8 entre calle 11 y 12 Edificio Jandal Piso 1 Oficina 4 San Felipe Escritorio Juridico Salcedo & Asociados	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
247	Wilter	Urbano Villegas	7553535		0	0			0	0	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
248	Michelina	Guarnieri	5458480		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
249	Juan Alfonso 	Cobis medina	16951233	Av. 8 entre calle 11 y 12 Edificio jandal Piso 1 Oficina 4  San Felipe Escritorio Juridico salcedo & Asociados 	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
250	Jose David 	Bello Guedez	5888918	Av. 8 entre calle 11 y 12 EdificioJandal Piso 1 oficina 4 San Felipe Escritorio Juridico Salcedo& Asociados	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
252	Norys Maria	Pertez Cuenca	18053964		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
253	Wuilliany 	Pérez	17255050		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
255	America Aurora 	Franceschi	11654023		0	0			0	0	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
254	Yohanny Jesus	Hernandez Tovar	18301274	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
256	Elia Lisbeth	 Barrios	12728254		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
257	Reinaldo Jose 	Galindez Oropeza	12705879	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
258	Samir Antonio 	Rojas Machado	13264635	san Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
259	Nelly Beatriz	 Martínez Giménez	7551539		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
260	Yohen raul 	Coroba perez	12724408	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
261	Rafael Eduardo 	sandoval Jimenez	5749261	san felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
262	Regulo Antonio 	Arias Andrade	8513714	San felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales.	\N	\N	\N	\N	\N	0
263	Jose gregorio 	caruci Perez	13644144	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
264	Manuel Felipe 	Gimenez	2177068		12936	12940			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
265	Eduardo 	Ochoa	3712093	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
266	Evelio Antonio 	Perez Perez	8513705	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
267	Angel Alexis 	Manriquez Perez	12081800	San felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Accidente Laboral	\N	\N	\N	\N	\N	0
268	Pedro Antonio 	Anzola Colmenarez	7553107	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
269	Leonor Alfonso 	Cueva hernandez	5460219	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
270	Oswaldo Jose 	Moreno Mendoza	7590857	San felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
271	Ydegar Sevilla 	Martínez	7508295		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
272	Eliel Napoleon 	Morillo Ramones	13985355	San Felipe	12936	12948			0	12961	0	N/P	2013-01-22 00:00:00	Demanda por Prestaciones Sociales	\N	\N	\N	\N	\N	0
273	Nora Ernestina	García De Herrera	7589680		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
274	Isleny Carmenia 	Arteaga Galavis	17611755		12936	12948			0	12962	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
275	Rolando José 	Fuentes Leal 	6603166		12936	12948			0	12961	0	N/P	2013-01-22 00:00:00		\N	\N	\N	\N	\N	0
276	Maria C	Hernandez	4127748		0	0			0	0	0	N/P	2013-01-29 00:00:00		\N	\N	\N	\N	\N	0
277	Elizabeth	Pinto Sequera	3910248		0	0			0	0	0	N/P	2013-01-29 00:00:00		\N	\N	\N	\N	\N	0
278	Doris M	Suarez O	3709736		0	0			0	0	0	N/P	2013-01-29 00:00:00		\N	\N	\N	\N	\N	0
279	Migdalia 	Rivero	4480913		0	0			0	0	0	N/P	2013-01-29 00:00:00		\N	\N	\N	\N	\N	0
280	Nancy	Griman	4477949		0	0			0	0	0	N/P	2013-01-29 00:00:00		\N	\N	\N	\N	\N	0
\.


--
-- Data for Name: tbl_demandantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_demandantes (lngcodigo, cedula, nombres, telefono, direccion, tiempo_servicio, fecingreso, fecegreso, motivo_culminacion_laboral, cancelo_adelanto_prestaciones, concepto, monto) FROM stdin;
\.


--
-- Data for Name: tbl_expediente_referidos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_expediente_referidos (lngcodigo, tiempo_servicio, fecingreso, fecegreso, motivo_culminacion_laboral, concepto, monto, id_expediente, id_demandante, monto_demanda, bolborrado, cancelo_adelanto_prestaciones) FROM stdin;
5	2	2012-12-20	2012-12-20	rwestst	hd	23	30	5	23	0	1
6	2	2012-12-20	2012-12-19	JVGHC	GHS	123	30	4	2345	0	1
7	122	2012-12-20	2012-12-20	ERSEYSY		0	30	9	3445	0	0
8	3	2006-12-20	2012-12-20	KGYYUYU	RYDTS	234	33	4	345	0	1
9	2	2008-12-15	2012-12-20	ERSEYS	HFCRDG	23	33	4	23.5	0	1
11	3	2012-12-18	2012-12-18	fssz	RDTRS	234	33	9	23	0	1
10	3	2012-12-20	2012-12-21	SERS	WEDRTY	0	33	5	2345	0	1
12	22	2012-12-20	2012-12-20	ESYER	ES	45	34	4	23	0	1
\.


--
-- Data for Name: tblaccesoforma; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblaccesoforma (id_accesoforma, id_profile_maestro, id_menu_maestro, stracciones, bolborrado) FROM stdin;
1	112	103	130,131,132,133,134,135,136,137,223,224,225,	0
2	112	104	138,139,140,141,142,143,144,145,146,147,148,	0
3	112	105	149,150,151,152,153,154,	0
4	112	106	155,	0
5	112	107	156,	0
6	112	108	157,	0
7	112	109	158,159,160,161,	0
8	112	110	162,	0
9	112	210	212,	0
10	112	211	213,	0
11	112	221	222,226,227,228,229,230,231,232,241,	0
12	112	263	264,	0
13	112	266	267,268,269,270,271,272,273,274,275,276,277,	0
14	113	103	130,131,132,133,134,135,136,137,223,224,225,	0
15	113	104	138,139,140,141,142,143,144,145,146,147,148,	0
16	113	105	149,150,151,152,153,154,	0
17	113	107		0
18	113	108		0
19	113	109	158,159,160,161,	0
20	113	110	162,	0
21	113	210	212,	0
22	113	221	222,226,227,228,229,230,231,232,241,	0
23	113	263	264,	0
24	113	266	267,268,269,270,271,272,273,274,275,276,277,	0
25	287	103	130,131,132,133,134,137,224,225,	0
26	287	104	138,139,140,142,143,144,146,148,	0
27	287	105	153,154,	0
28	287	263	264,	0
29	287	266	267,268,269,270,271,274,275,276,277,	0
32	117	103	130,131,132,133,134,135,136,137,223,224,225,	0
33	117	104	138,139,140,141,142,143,144,145,146,147,148,	0
34	117	105	149,150,151,152,153,154,	0
35	117	109	158,159,160,161,	0
36	117	110	162,	0
38	117	221	222,226,227,228,229,230,231,232,241,	0
39	117	263	264,	0
40	117	266	267,268,269,270,271,272,273,274,275,276,277,	0
41	118	103	130,131,132,133,134,137,224,225,	0
42	118	104	138,139,140,142,143,144,146,148,	0
43	118	105	149,153,154,	0
44	118	109	158,159,160,161,	0
45	118	110	162,	0
46	118	210	212,	0
47	118	221	222,226,227,228,230,232,241,	0
48	118	263	264,	0
49	118	266	267,268,269,270,271,274,275,276,277,	0
50	285	103	130,131,133,137,224,225,	0
51	285	104	138,139,140,142,143,144,146,148,	0
52	285	105	149,153,154,	0
53	285	109	158,159,160,161,	0
54	285	110	162,	0
55	285	210	212,	0
56	285	221	222,226,227,228,230,232,241,	0
57	285	263	264,	0
58	285	266	267,268,269,270,274,275,276,277,	0
59	288	103	130,131,134,137,224,225,	0
60	288	104	138,139,140,142,143,144,146,148,	0
61	288	105	149,150,151,152,153,154,	0
62	288	109	158,159,160,161,	0
63	288	110	162,	0
64	288	210	212,	0
65	288	221	222,226,227,228,230,232,241,	0
66	288	263	264,	0
67	288	266	267,268,269,271,274,275,276,277,	0
68	114	103	130,131,137,224,225,	0
69	114	104	138,139,140,142,143,144,146,148,	0
70	114	105	149,150,151,152,153,154,	0
71	114	109	158,159,160,161,	0
72	114	110	162,	0
73	114	210	212,	0
74	114	221	222,226,227,228,229,230,231,232,241,	0
75	114	263	264,	0
76	114	266	267,268,269,271,272,273,274,275,276,277,	0
101	116	292	293,296,297,298,299,300,301,302,303,	0
85	112	292	293,296,297,298,299,300,301,302,303,	0
86	112	12834	304,305,306,307,308,309,310,311,312,313,12835,	0
107	116	12849		0
87	112	12837	314,315,316,317,318,319,320,321,322,323,12838,	0
88	112	12840	324,325,326,327,328,329,330,331,332,333,12841,	0
89	112	12843	334,335,336,337,338,339,12844,	0
90	112	12846	340,12847,	0
106	116	12846	340,12847,	0
102	116	12834	304,305,306,307,308,309,310,311,312,313,12835,	0
103	116	12837	314,315,316,317,318,319,320,321,322,323,12838,	0
104	116	12840	324,325,326,327,328,329,330,331,332,333,12841,	0
109	114	12843	334,335,336,337,338,339,12844,	0
105	116	12843	334,335,336,337,338,339,12844,	0
110	116	12867		0
111	113	12855		0
92	112	12852	12853,	0
93	112	12855	12856,	0
94	112	12858	12859,	0
95	112	12861	12862,	0
96	112	12864	12865,	0
97	112	12867	12868,	0
98	112	12870	12871,	0
99	112	12873	12874,	0
108	116	12852		0
91	112	12849	12850,	0
116	112	12992	12993,12994,12995,12996,	0
118	112	13006	13007,	0
120	112	13118	13120,	0
122	112	13129	13130,	0
125	116	12964	12965,	0
127	116	12986	12987,12988,12989,12990,	0
130	116	13118	13120,	0
132	116	13129	13130,	0
134	112	13196	13197,	0
135	112	13231	13232,13320,13321,13325,13330,	0
137	112	13237	13238,13326,13327,13328,13329,	0
138	112	13240	13241,13331,13332,13333,13337,	0
117	112	13003	13004,13317,13318,13319,13322,13323,13324,	0
121	112	13123	13125,13308,13309,13310,13312,	0
123	112	13139	13140,13313,13314,13315,13316,	0
140	112	13247	13248,	0
142	112	13253	13254,	0
144	112	13262	13263,	0
129	116	13082	13084,13300,13302,13307,	0
131	116	13123	13125,13308,13310,13312,	0
133	116	13139	13140,13314,13315,13316,	0
145	112	13265	13266,	0
143	112	13258	13259,	0
146	112	13269	13270,	0
147	112	13272	13273,	0
148	112	13276	13277,	0
149	112	13279	13280,	0
150	112	13282	13283,	0
151	112	13285	13286,	0
152	112	13289	13290,	0
153	112	13293	13294,	0
113	112	12964	12965,13295,13296,13297,13298,	0
114	112	12980	12981,12982,12983,12984,13299,	0
136	112	13234	13235,13339,13340,13341,13342,	0
139	112	13243	13244,13343,13344,13345,13346,	0
141	112	13250	13251,13334,13335,13336,13338,	0
112	112	12953	12954,13304,13305,13306,13311,	0
119	112	13082	13084,13300,13301,13302,13307,	0
154	114	13196	13197,	0
155	114	13262	13263,	0
156	114	13265	13266,	0
157	114	13279	13280,	0
158	114	13282	13283,	0
159	114	13285	13286,	0
160	114	13258	13259,	0
161	114	13269	13270,	0
162	114	13272	13273,	0
163	114	13276	13277,	0
164	114	13289	13290,	0
165	285	13258	13259,	0
166	285	13269	13270,	0
167	285	13272	13273,	0
168	285	13276	13277,	0
169	285	13289	13290,	0
170	285	13196	13197,	0
171	285	13262	13263,	0
172	285	13265	13266,	0
173	285	13279	13280,	0
174	285	13282	13283,	0
175	285	13285	13286,	0
176	112	13772	13773,	0
177	112	13786	13787,13788,13789,13790,	0
178	112	13793	13794,	0
115	112	12986	12987,12988,12989,12990,13303,	0
124	116	12953	12954,13304,13305,13311,	0
128	116	13003	13004,13318,13319,13322,13323,13324,	0
179	116	13293	13294,	0
126	116	12980	12981,12982,12983,12984,13299,	0
180	287	13231	13232,13320,13321,13325,13330,	0
181	287	13234	13235,13339,13340,13341,13342,	0
182	287	13237	13238,13326,13327,13328,13329,	0
183	287	13243	13244,13343,13344,13346,	0
184	287	13786	13787,13788,13789,	0
185	287	13793	13794,	0
186	287	13253	13254,	0
187	287	13247	13248,	0
188	287	13240	13241,13331,13332,13333,13337,	0
189	287	14081	14082,	0
190	112	14081	14082,	0
\.


--
-- Data for Name: tblactividades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblactividades (id_actividad, id_destinatarios, strdescripcion, id_prioridad_maestro, id_estatus_maestro, memtitulo, dtmresolucion, dtmcierre, id_contacto, bolborrado) FROM stdin;
2	22	 . j.g .	243	247	juegp	2012-06-26 00:00:00-04:30	\N	672	0
\.


--
-- Data for Name: tblactuacion_fases; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblactuacion_fases (id_proactuacion_fase, id_tipo_fase, id_fase, strobservacion, id_proactuacion, fecfase, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblactuacion_situaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblactuacion_situaciones (id_proactuacion_situacion, id_tipo_minuta, id_minuta, strobservacion, id_proactuacion, fecminuta, bolborrado, id_estado_minuta) FROM stdin;
\.


--
-- Data for Name: tblactuaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblactuaciones (id_proactuacion, id_usuario, id_ano, id_origen, id_motivo, id_fase, id_actuacion, id_tipo_organismo, id_organismo, id_refer, id_estado_fisico_expediente, id_tipo_espacio, id_tipo_archivador, id_tipo_piso_archivador, id_tipo_archivador_gaveta, strnroexpediente, strdescripcion, fecapertura, feccierre, fecexpediente, intcuantias, strdocumentos, strobservacion_cerrar, strnroexpedienteauxiliar, strrepresentante, fecadmdem, fecnotdem, fecultnotordtri, fecinsaudpre, fecculfaspre, feccondem, fecadmpru, fecjuiorapub, fecpubsen, fecapelacion, bolborrado, id_contrario, id_tipo_organismo_centralizado, otrafase, otromotivo) FROM stdin;
34	672	0	13824	13892	14028	13014	13418	0	0	13174	13172	13177	13180	13184	LTG-20122012-33	MHHJVHJV<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	34567		\N	UP11-W45	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059	2345678	
33	672	0	13824	13892	14027	13796	13398	0	0	13174	13171	13177	13180	13184	LTG-20122012-32	&nbsp;hj j j jg gj <br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	2345		\N	UP11-2345	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015	\N	\N
35	672	0	0	0	13929	13796	14060	0	0	0	0	0	0	0	LTG-06012013-34	ultimo caso prueba<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	40000000		\N	UP11-54564	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		otros
36	672	0	13824	13892	14027	13796	0	0	0	0	0	0	0	0	LTG-09012013-35	hjghjghjkcgk<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	1200	\N	\N	UP11-jki455	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	\N	0		
37	672	0	13824	13846	14027	13796	13016	0	0	0	0	0	0	0	LTG-11012013-36	&nbsp;sadasd	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	1233		\N	UP11-fsgr	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
51	720	0	13822	13833	14023	13796	13019	0	0	13174	0	0	0	0	LTG-22012013-50	La Causa se encuentra en la etapa etapa conciliatoria y fue suspendida por 30 Dias desde el 20 de Diciembre del 2012, Se revisaran las Pruebas con el Abog demandante&nbsp; y los Abogados para ver si se puede llegar a un acuerdo.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	633825.48		\N	UP11-L-2010-000368	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
38	723	0	13823	13834	14083	13796	13426	0	0	0	0	0	0	0	LTG-21012013-37	Cobro de diferrencia de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	126250.97		\N	UP11-L-2012-000390	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
45	723	0	13823	13834	14083	13796	13422	0	0	0	0	0	0	0	LTG-21012013-44	Cobro de diferencia de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	130570.4		\N	UP11-L-2010-000279	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
47	723	0	13823	13834	14025	13796	13426	0	0	0	0	0	0	0	LTG-21012013-46	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	21399.47		\N	UP11-L2010-000188	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
39	721	0	13814	13831	13929	13796	13016	0	0	0	0	0	0	0	LTG-21012013-38	DEMANDA POR PRESTACIONES SOCIALES<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	0		\N	UP11-L-2012-000379	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
43	723	0	13823	13834	14025	13796	13425	0	0	0	0	0	0	0	LTG-21012013-42	Cobro de prestaciones sociales y otros conceptos legales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	1612424.36		\N	UP11-L-2011-000363	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
44	719	0	13822	13927	14030	13796	14060	0	0	0	0	0	0	0	LTG-21012013-43	La causa se encuentra en ejecuci&oacute;n forzosa.&nbsp; El 30 de Octubre de 2.012,&nbsp; se firmo transacci&oacute;n con la parte demandante por la cantidad de 26.212,18 bs, pagaderos en dos partes<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	12793.5		\N	UP11-L-2009-000268	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
42	719	0	13822	13833	14023	13796	13016	0	0	0	0	0	0	0	LTG-21012013-41	Demanda por prestasciones sociales, vacaciones fraccionadas, bono vacacional fraccionado, indemnizacion por despido, indemnizacion sustitutiva de preaviso<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	12838.09		\N	UP11-L-2012-000352	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
40	723	0	13823	13834	14083	13796	13422	0	0	0	0	0	0	0	LTG-21012013-39	Cobro de prestaciones sociales y demas beneficios laborales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	183827.55		\N	UP11-L2012-000396	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
46	719	0	13822	13833	14025	13796	13422	0	0	0	0	0	0	0	LTG-21012013-45	La causa se encuentra en etapa de juicio, con fecha de juicio el 27 de febrero de 2.013 a las 10:00 am<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	0		\N	UP11-L-2010-000203	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
48	723	0	13823	13834	14027	13796	13016	0	0	0	0	0	0	0	LTG-21012013-47	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	7340.06		\N	UP11-L2011-000278	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
49	723	0	13823	13928	14027	13796	0	0	0	0	0	0	0	0	LTG-21012013-48	Solicitud de reenganche y pago de salarios caidos.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	30393.19		\N	UP11-L2011-000319	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	0		
55	722	0	13820	13832	14023	13796	13019	0	0	0	0	0	0	0	LTG-22012013-54	Se encuentra inactiva desde el 06 de agosto del a&ntilde;o 2010, por cambio de Juez, en fecha 01 de Julio del a&ntilde;o 2011 la nueva Juez fue abocada a la causa, pero aun no tiene fecha para la continuidad de la audiencia. <br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	29272.52		\N	UP11-L-2009-000233	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
52	719	0	13822	13833	14023	13796	13422	0	0	0	0	0	0	0	LTG-22012013-51	<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	679679.41		\N	UP11-L-2010-000369	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
41	723	0	13823	13834	14029	13796	13412	0	0	0	0	0	0	0	LTG-21012013-40	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	951101.62		\N	UP11-L-2008-000184	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
50	719	0	13822	13833	14023	13796	13422	0	0	0	0	0	0	0	LTG-22012013-49	La causa se encuentra en la fase de sustanciaci&oacute;n, estudiaran las pruebas, el abogado de los&nbsp; demandantes, con la apoderada del Instituto &nbsp; a los fines de llegar un acuerdo o si hay posibilidades de ganar en juicio<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	500075.31		\N	UP11-L-2010-000370	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
59	723	0	13823	13834	14025	13796	13412	0	0	0	0	0	0	0	LTG-22012013-58	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	92343.36		\N	UP11-L-2008-000628	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
53	719	0	13822	13833	14025	13796	13422	0	0	0	0	0	0	0	LTG-22012013-52	La causa se encuentra en fase de juicio, teniendo fijada la fecha para el 08 de Marzo de 2.013 a las 10 am<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	0		\N	UP11-L-2010-000358	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
54	720	0	13822	13833	14025	13796	13019	0	0	0	0	0	0	0	LTG-22012013-53	Esta causa se encuentra en Etapa de Juicio, y la audiencia de Juicio es el 08-03-2013 a las 10am<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	492327.43		\N	UP11-L-2010-000335	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
56	719	0	13822	13833	14025	13796	13425	0	0	0	0	0	0	0	LTG-22012013-55	<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	0		\N	UP11-L-2012-00084	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
57	723	0	13823	13834	14025	13796	13422	0	0	0	0	0	0	0	LTG-22012013-56	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	31953.73		\N	UP11-L-2009-000231	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
58	722	0	13820	13832	14025	13796	13425	0	0	0	0	0	0	0	LTG-22012013-57	La causa se encuentra en etapa de juicio, tiene fecha fijada de audiencia para el 18/02/2013 a las 10:00Am <br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	94801.4		\N	UP11-L-2010-000099	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
60	723	0	13823	13834	14025	13796	13016	0	0	0	0	0	0	0	LTG-22012013-59	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	41842.31		\N	UP11-L-2009-000462	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
61	723	0	13823	13834	13929	13796	0	0	0	0	0	0	0	0	LTG-22012013-60	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	32823.91	\N	\N	UP11-L-20096-000441	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	\N	0		
62	723	0	13823	13834	13929	13796	13426	0	0	0	0	0	0	0	LTG-22012013-61	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	32823.91		\N	UP11-L-2009-000441	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
64	723	0	13823	13834	14025	13796	13016	0	0	0	0	0	0	0	LTG-22012013-63	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	143905.42		\N	UP11-L-2012-000026	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
65	723	0	13823	13834	14025	13796	13016	0	0	0	0	0	0	0	LTG-22012013-64	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	71899.25		\N	UP11-L-2011-000143	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
63	722	0	13820	13832	14029	13796	13016	0	0	0	0	0	0	0	LTG-22012013-62	En la presente causa el 18/01/2013 se introdujo propuesta de pago, para cancelar el monto sentenciado en dos ejercicios fiscales, es decir&nbsp; 2013-2014, aun no hay pronunciamiento del juez.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	59351.57		\N	UP11-L-2007-000522	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
67	722	0	13820	13832	14023	13796	13019	0	0	0	0	0	0	0	LTG-22012013-66	La presente causa se encuentra en etapa conciliatoria, audiencia fijada para el 25/01/2013 a las 9:00am.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	46160.71		\N	UP11-L-2010-000162	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
66	723	0	13823	13834	13929	13796	13426	0	0	0	0	0	0	0	LTG-22012013-65	Cobro de prestaciones sociales.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	13237.78		\N	UP11-L-20121-000331	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
68	724	0	13829	13917	14022	13014	13016	0	0	0	0	0	0	0	LTG-29012013-67	Calificacion de Falta por Inasistencia.<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	0		\N	057-2012-01-00808	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	13015		
69	719	0	13822	13833	14026	13796	13426	0	0	0	0	0	0	0	LTG-29012013-68	Demanda por cobro de aportes a la ley de politica, bono unico de contratacion colectiva, aportes al fondo nacional de jubilacion, bono de alimentacion 2000-2004<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	193278.88		\N	UP11-L-2010-000488	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
70	719	0	13822	13927	14025	13796	13426	0	0	0	0	0	0	0	LTG-29012013-69	Demanda por otros beneficios como son bono unico por contratacion colectiva, aportes de caja de ahorro, fondo de jubilacion, ley de politica habitacional, cesta tickets 2002-2004<br type="_moz" />	0001-01-01 00:00:00-04:27:44 BC	\N	0001-01-01 00:00:00-04:27:44 BC	0		\N	UP11-L-2012-000238	 	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	14059		
\.


--
-- Data for Name: tbladjunto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbladjunto (id_adjunto, id_corresp, id_actividad, id_archivo, stradjunto, bolborrado) FROM stdin;
6	\N	\N	50ca1b5e5fb2d	documento_flaca.odt	0
7	21	\N	50cf9b58a5608	constancia_oas_individual02-dec-2012-210957.pdf	0
\.


--
-- Data for Name: tbladjunto_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbladjunto_documento (id_adjunto, id_proexpediente, stradjunto, bolborrado) FROM stdin;
33	33	documentos/expediente_33_A14-Francisco Souza (1).pdf	0
34	34	documentos/expediente_34_A14-Francisco Souza.pdf	0
35	34	documentos/expediente_34_A14-Francisco Souza.pdf	0
36	37	documentos/expediente_37_MODELO OFICIO PROCURADURIA.docx	0
37	33	documentos/expediente_33_LIQUIDACION DE DIPUTADOS 2012 yrania2-1.xls	0
\.


--
-- Data for Name: tblagenda; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblagenda (id_agenda, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecagenda, strdescripcion, strtitulo, id_expediente, bolborrado, id_tipo_organismo, id_organismo, strpersona, id_refiere, visto, id_contacto, date, id_seguimiento, origen, tipo_expediente) FROM stdin;
219	235	13221	13202	13205	13212	13208	12013	2012-12-14	Refiere a Expediente Nro:LTG-12122012-5<br /><br />aaaaaaaaaaaa<br type="_moz" />	prueba	6	0	13438	13481		13225	1	0	2012/12/12, 09:59:43 pm	218	R	1
220	714	13221	13202	13205	13212	13208	12013	2012-12-14	Refiere a Expediente Nro:LTG-12122012-5<br /><br />aaaaaaaaaaaa<br type="_moz" />	prueba	6	0	13438	13481		13225	1	0	2012/12/12, 09:59:43 pm	218	R	1
218	672	13221	13202	13205	13212	13208	12012	2012-12-14	Refiere a Expediente Nro:LTG-12122012-5<br /><br />aaaaaaaaaaaa<br type="_moz" />	prueba	6	0	13438	13481		13225	0	0	2012/12/12, 09:59:43 pm	0	E	1
221	672	13221	13216	13205	13212	13208	12015	2013-01-04	Refiere a Expediente Nro:LTG-20122012-33<br /><br />MHHJVHJV<br type="_moz" />	prueba	34	0	13397	0	 KHBHB	13225	1	0	2013/01/03, 02:29:01 pm	0	E	1
222	715	13221	13216	13205	13212	13208	12013	2013-01-04	Refiere a Expediente Nro:LTG-20122012-33<br /><br />MHHJVHJV<br type="_moz" />	prueba	34	0	13397	0	 KHBHB	13225	1	0	2013/01/03, 02:29:01 pm	221	R	1
224	715	13221	13216	13205	13212	13208	12013	2013-01-07	Refiere a Expediente Nro:LTG-20122012-33<br /><br />MHHJVHJV<br type="_moz" />	KJBK	34	0	13016	13436	 HB K	13225	1	0	2013/01/03, 02:31:38 pm	223	R	1
223	672	13221	13216	13205	13212	13208	12015	2013-01-07	Refiere a Expediente Nro:LTG-20122012-33<br /><br />MHHJVHJV<br type="_moz" />	KJBK	34	0	13016	13436	 HB K	13225	0	0	2013/01/03, 02:31:38 pm	0	E	1
225	672	13221	13216	13205	13212	13208	12015	2013-01-15	Refiere a Expediente Nro:LTG-20122012-33<br /><br />MHHJVHJV<br type="_moz" />	titulo	34	0	13016	13436	 persona	0	1	0	2013/01/03, 02:44:30 pm	0	E	1
233	715	13221	13216	13205	13212	13208	12013	2013-01-16	&nbsp;n kh&ntilde;kh ninoska	ninoska	34	0	13016	13436	Jimenez, Angel 	13225	0	0	2013-01-16	232	R	1
226	672	13221	13216	13205	13212	13208	12015	2013-01-08	mb hjbvhb<br type="_moz" />	desrrollo	34	0	13016	13436	Jimenez, Angel 	0	0	0	2013/01/03, 02:44:30 pm	0	E	1
227	672	13221	13216	13205	13212	13208	12015	2013-01-30	bn gjvgv<br type="_moz" />	otra prueba	34	0	13016	13436	Jimenez, Angel 	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
228	672	13221	13216	13205	13212	13208	12015	2013-01-08	nm khbhk<br type="_moz" />	otra agenda	34	0	13016	13436	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
232	672	13221	13216	13205	13212	13208	12015	2013-01-16	&nbsp;n kh&ntilde;kh ninoska	ninoska	34	0	13016	13436	Jimenez, Angel 	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
230	672	13221	13216	13205	13212	13208	12015	2013-01-08	nm khbhk<br type="_moz" />	otra agenda	34	0	13016	13436	Jimenez, Angel 	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
231	715	13221	13216	13205	13212	13208	12013	2013-01-08	nm khbhk<br type="_moz" />	otra agenda	34	0	13016	13436	Jimenez, Angel 	13225	0	0	2013-01-08	230	R	1
229	715	13221	13216	13205	13212	13208	12013	2013-01-08	nm khbhk<br type="_moz" />	otra agenda	34	0	13016	13436	Jimenez, Angel 	13225	0	0	2013-01-08	228	R	1
235	715	13221	13216	13205	13212	13208	12013	6792-09-28	mbgjvgvgvgvgv<br type="_moz" />	al fin	34	0	14059	13418	Jimenez, Angel 	13225	1	0	6792-09-28	234	R	1
234	672	13221	13216	13205	13212	13208	12015	6792-09-28	mbgjvgvgvgvgv<br type="_moz" />	al fin	34	0	14059	13418	Jimenez, Angel 	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
237	715	13221	13216	13205	13212	13208	12013	2013-01-09	PRUEBA FINAL<br type="_moz" />	Prueba Agenda	35	0	14059	14060	Jimenez, Angel 	13225	1	0	2013-01-09	236	R	1
236	672	13221	13216	13205	13212	13208	12015	2013-01-09	PRUEBA FINAL<br type="_moz" />	Prueba Agenda	35	0	14059	14060	Jimenez, Angel 	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
238	672	13221	13216	13205	13212	13208	12015	2013-01-01	<br type="_moz" />	prueba	35	0	14059	14060	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
239	715	13221	13216	13205	13212	13208	12013	2013-01-01	<br type="_moz" />	prueba	35	0	14059	14060	Jimenez, Angel 	13225	1	0	2013-01-01	238	R	1
241	715	13221	13216	13205	13212	13208	12013	2013-01-23	aaaa<br type="_moz" />	instalacion de audiencia preliminar	33	0	13015	13398	Jimenez, Angel 	13225	1	0	2013-01-23	240	R	1
240	672	13221	13216	13205	13212	13208	12015	2013-01-23	aaaa<br type="_moz" />	instalacion de audiencia preliminar	33	0	13015	13398	Jimenez, Angel 	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
242	672	13221	13216	13205	13212	13208	12015	2013-01-15	&nbsp;zxxcxc	audiencia preliminar	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
243	715	13221	13216	13205	13212	13208	12013	2013-01-15	&nbsp;zxxcxc	audiencia preliminar	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013-01-15	242	R	1
244	672	13221	13216	13205	13212	13208	12015	2013-01-12	&nbsp;	aas	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
245	715	13221	13216	13205	13212	13208	12013	2013-01-12	&nbsp;	aas	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013-01-12	244	R	1
246	672	13221	13216	13205	13212	13208	12015	2013-01-01	&nbsp;	zxcds	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
247	715	13221	13216	13205	13212	13208	12013	2013-01-01	&nbsp;	zxcds	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013-01-01	246	R	1
248	672	13221	13216	13205	13212	13208	12015	2013-01-01	retery<br type="_moz" />	eee	33	0	13015	13016	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
249	715	13221	13216	13205	13212	13208	12013	2013-01-01	retery<br type="_moz" />	eee	33	0	13015	13016	Jimenez, Angel 	13225	1	0	2013-01-01	248	R	1
250	672	13221	13216	13205	13212	13208	12015	2013-01-16	<br type="_moz" />	prueba	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
251	715	13221	13216	13205	13212	13208	12013	2013-01-16	<br type="_moz" />	prueba	37	0	13015	13016	Jimenez, Angel 	13225	1	0	2013-01-16	250	R	1
252	723	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
253	715	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
254	722	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
255	719	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
256	720	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
257	721	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
258	724	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
259	728	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
260	723	13221	13216	13205	13212	13208	12015	2013-01-22	<br type="_moz" />	a	38	0	14059	13426	Camacaro, Carlos	13225	1	0	2013-01-22	252	R	1
262	715	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
263	724	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
265	722	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
266	728	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
267	723	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
268	719	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
269	720	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	1	0	2013-01-22	261	R	1
270	719	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
271	715	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
272	724	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
273	721	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
274	722	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
275	728	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
276	723	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
277	719	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
278	720	13221	13216	13205	13212	13208	12015	2013-02-27	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	Audiencia de Juicio	46	0	14059	13422	Delvigne, Alejandra	13225	1	0	2013-02-27	270	R	1
261	721	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	0	0	2013/01/03, 02:44:30 pm	0	E	1
264	721	13221	13216	13205	13212	13208	12015	2013-01-22	Escrito de Pruebas<br type="_moz" />	Escrito de Pruebas 	39	0	0	0	Laya, Yuraly	13225	0	0	2013-01-22	261	R	1
279	723	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013/01/03, 02:44:30 pm	0	E	1
280	715	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
281	724	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
282	721	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
283	722	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
284	723	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
285	728	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
286	719	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
287	720	13221	13216	13205	13212	13208	12015	2013-02-12	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	Revision de expediente.	40	0	14059	13422	Camacaro, Carlos	13225	1	0	2013-02-12	279	R	1
\.


--
-- Data for Name: tblagenda_litigio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblagenda_litigio (id_agenda, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecagenda, strdescripcion, strtitulo, id_expediente_litigio, bolborrado, id_tipo_organismo, id_organismo, strpersona, id_refiere, visto, id_contacto, date, id_seguimiento, origen) FROM stdin;
\.


--
-- Data for Name: tblasociaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblasociaciones (lngcodigo_asociacion, strnombre_asociacion, strweb, dtmfechafun, strtelefono_asociacion, strdireccion_asociacion, strrif, id_municipio_asociacion, id_parroquia_asociacion, id_ramo, id_cliente) FROM stdin;
\.


--
-- Data for Name: tblautorizado_est; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblautorizado_est (id_autorizados_est, id_estados, id_perfil_maestro, bolborrado) FROM stdin;
39	11	116	0
40	12	116	0
90	12	114	0
91	13	114	0
92	17	114	0
93	18	114	0
94	20	114	0
98	30	112	0
99	31	112	0
100	32	112	0
116	30	113	0
117	31	113	0
118	32	113	0
120	21	113	0
121	22	113	0
122	23	113	0
123	21	112	0
124	22	112	0
125	23	112	0
126	24	114	0
127	25	114	0
128	33	114	0
129	34	114	0
130	35	114	0
131	36	114	0
136	21	117	0
137	22	117	0
138	23	117	0
139	30	117	0
140	31	117	0
141	32	117	0
144	39	118	0
145	40	118	0
146	28	285	0
147	29	285	0
148	41	285	0
149	42	285	0
150	26	287	0
151	27	287	0
152	26	116	0
153	27	116	0
154	37	116	0
155	38	116	0
156	28	118	0
157	29	118	0
158	24	112	0
159	25	112	0
\.


--
-- Data for Name: tblcontacto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcontacto (id_contacto, strpassword, strlogin, id_tipo_maestro, strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, id_cargo_maestro, id_estatus_maestro, strfirma, strmediafirma, bolborrado, id_dpto_maestro, id_coord_maestro, id_coordext_maestro) FROM stdin;
708	de88e3e4ab202d87754078cbb2df6063	cabreu	171	14997300	Carolina 	Abreu	(0111) 111.11.11		ayajure@pge.gob.ve	cabreu	165	168	<div style="text-align: center;"><u><b><span style="font-size: 14px;">Abreu Carolina</span></b></u><b><span style="font-size: 14px;"><br /></span></b><span style="font-size: 14px;"><br type="_moz" /></span></div>	cabreu	0	12875	12011	0
714	de88e3e4ab202d87754078cbb2df6063	rcalabrese	171	7517597	ROSA AURA 	CALABRESE YANEZ	(0111) 111.11.11		procuraduria@gmail.com	direccion	13696	168	direccion<br type="_moz" />	ROSA CALABRESE	0	12875	12012	0
715	de88e3e4ab202d87754078cbb2df6063	abermudez	171	7583441	AUDREY YANET	BERMUDEZ MARIN 	(0111) 111.11.11		procurando@gmail.com	direccion	13696	168	abermudez<br type="_moz" />	abermudez	0	12875	12015	0
716	de88e3e4ab202d87754078cbb2df6063	mcalvete	171	7908777	MILDRED	CALVETE NADINE 	(0111) 111.11.11		NACALVETE@HOTMAIL.COM	mcalvete	13696	168	mcalvete<br />	mcalvete	0	12875	12014	0
672	de88e3e4ab202d87754078cbb2df6063	ajimenez	171	12345678	Angel 	Jimenez	(0000) 000.00.00		angeljimenez89@hotmail.com	San Felipe	165	168	<div style="text-align: center;"><b>ANGEL JIMENEZ</b></div>	ajimenez	0	12875	12013	0
709	4a7d1ed414474e4033ac29ccb8653d9b	ebriaschi	171	14997789	Elianel 	Briaschi	(0000) 000.00.00		ebriaschi@hotmail.com	San Felipe	13186	168	<div style="text-align: center;"><b><u>Briaschi Elianel</u></b></div>	ebriaschi	1	12875	12011	0
711	4a7d1ed414474e4033ac29ccb8653d9b	gmendoza	171	131791671	Griselda	Mendoza	(0000) 000.00.00		gmendoza@hotmail.com	San Felipe	13186	168	<div style="text-align: center;"><u><b>Mendoza Griselda </b></u></div>	gmendoza	1	12875	12011	0
718	37c1c491f67bd0c479c0e0c720c256e0	jgimenez	171	13094722	Julimer	Gimenez	(0416) 858.93.86		juligisil30@hotmail.com	Urb San Miguel, Calle 3 # 72-74 	13696	168	jgimenez<br type="_moz" />	Jgimenez	0	12875	12011	0
713	f09696910bdd874a99cd74c8f05b5c44	jpina	171	12079341	Jorge	Piña	(0000) 000.00.00		jpina@hotmail.com	San Felipe	13186	168	<div style="text-align: center;"><u><b>Pi&ntilde;a Jorge</b></u></div>	jpina	0	12875	12011	0
724	7db60018101c11c4b274e533fe505f8f	jgalindez	171	7912137	Jesus	Galindez	(0416) 753.25.93		jesus_gz@hotmail.com	urb. la ascension, Calle 1, #28 	13186	168	Jesus Galindez<br type="_moz" />	jgalindez	0	12875	12015	0
707	4a7d1ed414474e4033ac29ccb8653d9b	cmogollon	171	13179167	Carlos	Mogollon	(0000) 000.00.00		cmogollon@hotmail.com	San Felipe	166	168	<div style="text-align: center;"><u><b>CARLOS MOGOLLON</b></u></div>	acarolina	1	12875	12011	0
721	001c05b83f2c21254f42298199c4b947	ylaya	171	7918880	Yuraly	Laya	(0412) 761.00.01		lfyuraly@gmail.com	urb. Mendoza, Av 10, casa# A-6	13186	168	Yuraly Laya<br type="_moz" />	ylaya	0	12875	12015	0
722	80bacd1a5bb4f535ca77e019a48ff594	ygrupillo	171	17699175	Yessica	Grupillo	(0416) 501.66.11		yessi_donaire@hotmail.com	Av. Alberto Ravell, urb Valle fresco, etapa 1 # 7	13186	168	Yessica Grupillo<br type="_moz" />	ygrupillo	0	12875	12015	0
235	de88e3e4ab202d87754078cbb2df6063	jmujica	171	1231321	Jose	Mujica	(0000) 000.00.00		jmujica@hotmail.com	Migracion dirección	164	168	<div style="text-align: center;"><span style="font-size: 14px;"><i><span style="font-weight: bold;">Abogado Mujica Jose<br /></span></i><span style="font-size: 10px;"><span style="font-weight: bold;">Procurador del Estado Yaracuy</span></span><i><span style="font-weight: bold;"><br type="_moz" /></span></i></span></div>	Jmujica	0	12875	12012	0
723	6591f28f586622df623be2702ea627e1	ccamacaro	171	14377793	Carlos	Camacaro	(0426) 310.19.74		carlos021_40@hotmail.com	calle principal sector piedra Grande, diagonal fundacion del niño	13186	168	Carlos Camacaro<br type="_moz" />	ccamacaro	0	12875	12015	12015
710	736142bd44554a076047ce4c14ce7749	svelasquez	171	15910627	Sonia	Velazquez	(0000) 000.00.00		svelazquez@hotmail.com	San Felipe	13186	168	<div style="text-align: center;"><strong><u><b>Velazquez Sonia</b></u></strong></div>	svelazquez	0	12875	12011	0
725	df724f766c74ec3519602c3feaf3b5e8	ldelgado	171	12278774	LENIN	DELGADO	(0426) 152.44.40		lada_yar@hotmail.com	Urb. Las Acequias Cocorote	13186	168	Lenin Delgado<br type="_moz" />	Lenin Delgado	0	12875	12011	0
726	c5a928a44f8a7713e370b2cce1ca5e65	mvergara	171	13795178	MIGUEL ARTURO	VERGARA SANCHEZ	(0426) 756.88.79		miguelvergara@hotmail.es	Urb. Las Tejitas Calle principal con calle de servicio casa 69 Cocorote	13186	168	Miguel Vergara<br type="_moz" />	Miguel Vergara	0	12875	12011	0
712	de88e3e4ab202d87754078cbb2df6063	enorky	171	12083798	Norkys	Espino	(0000) 000.00.00		nespino@hotmail.com	San Felipe	13696	168	<div style="text-align: center;"><u><b>Espino Norky</b></u></div>	nespino	1	12875	12014	0
728	1907d481db04307b5a79b6985f8b3a0e	docanto	171	15389966	Dina	Ocanto	(0412) 692.87.12		dinaocanto@hotmail.com	Av. Yaracuy Edif. Don pancho , piso 2, apto 2.	165	168	Dina Ocanto<br type="_moz" />	dinaocanto	0	12875	12015	0
717	25d55ad283aa400af464c76d713c07ad	mcastillo	171	7510279	Mara	Castillo	(0416) 089.57.24		mescalona7510@yahoo.es	Calle 19 entre 3ra y 4ta Av. #3-22 , Barrio monte oscuro, San Felipe	13186	168	&nbsp;	Mcastillo	0	12875	12011	0
719	0bd9da231f31b88b91c16b08f1746f78	adelvigne	171	13986423	Alejandra	Delvigne	(0424) 506.53.94		alejandradelvigne@hotmail.com	Av. la patria entre calles 13 y 14 edif. cabrera piso 1. apto 2.	13186	168	Alejandra Delvigne<br /><br type="_moz" />	adelvigne	0	12875	12015	0
720	ef3f5fadba059de4cd446e5eb5d3c8bd	ygimenez	171	14709673	Yulenni	Gimenez	(0424) 514.37.61		yjgimenez@hotmail.com	Urb. San miguel, calle 6 5ta. yayuleth	13186	168	Yulenni Gimenez<br type="_moz" />	YGimenez	0	12875	12015	0
727	25d55ad283aa400af464c76d713c07ad	hfalcon	171	13503717	HUMBERTO JOSE	FALCON HERNANDEZ	(0426) 435.37.93		animadepicapica@gmail.com	Calle principal el Guayabo Municipio Veroes	13186	168	HUMBERTO FALCON<br type="_moz" />	HFalcon	0	12875	12011	0
\.


--
-- Data for Name: tblcontactoactividad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcontactoactividad (id_contactoactividad, id_actividad, id_contacto, dtminicio, dtmresolucion, id_estatus_maestro, bolborrado, id_contacto_asigna) FROM stdin;
\.


--
-- Data for Name: tblcontactoexterno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcontactoexterno (id_contacto_externo, strtrato, strcontactoext, strinstitucion, strcargo, strtelefono, stremail, strdireccion, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblcontactoprofile; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcontactoprofile (id_contactoprofile, id_contacto, id_profile_maestro, bolborrado) FROM stdin;
710	713	116	0
705	708	114	0
711	714	285	0
712	715	285	0
713	716	285	0
672	672	112	0
706	709	112	1
708	711	116	1
715	718	118	0
722	725	116	0
723	726	116	0
724	727	116	0
707	710	116	0
725	728	112	0
709	712	285	1
716	719	112	0
717	720	112	0
721	724	112	0
718	721	112	0
719	722	112	0
98	235	112	0
720	723	112	0
714	717	287	0
\.


--
-- Data for Name: tblcorrelativo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcorrelativo (id_correlativo, id_gerencia_maestro, id_coord_maestro, lnganio, id_tipo_maestro, lnginicio, bolborrado) FROM stdin;
1	12896	0	2012	86	1	1
4	12882	0	2012	88	1	1
6	12875	12886	2012	86	1	1
7	12875	12882	2012	86	1	1
8	12875	12888	2012	86	1	1
9	12882	0	2012	86	1	1
2	12886	0	2012	86	1	1
3	12882	0	2012	86	1	1
5	12888	0	2012	86	1	1
44	12875	12013	2012	92	1	1
43	12875	12013	2012	89	1	1
42	12875	12013	2012	87	1	1
41	12875	12013	2012	93	1	1
40	12875	12013	2012	95	1	1
39	12875	12013	2012	88	1	1
38	12875	12013	2012	90	1	1
37	12875	12013	2012	86	1	1
36	12875	12013	2012	91	1	1
34	12875	12882	2012	86	7	1
33	12875	12882	2012	92	1	1
32	12875	12882	2012	89	1	1
31	12875	12882	2012	87	1	1
30	12875	12882	2012	93	1	1
29	12875	12882	2012	88	1	1
28	12875	12882	2012	90	1	1
27	12875	12882	2012	86	8	1
26	12875	12882	2012	91	1	1
25	12875	12888	2012	92	1	1
24	12875	12888	2012	89	1	1
23	12875	12888	2012	87	1	1
22	12875	12888	2012	93	1	1
21	12875	12888	2012	88	1	1
20	12875	12888	2012	90	1	1
19	12875	12888	2012	91	1	1
18	12875	12886	2012	92	1	1
17	12875	12886	2012	89	1	1
16	12875	12886	2012	87	1	1
15	12875	12886	2012	93	1	1
14	12875	12886	2012	88	1	1
13	12875	12886	2012	90	1	1
12	12875	12886	2012	91	1	1
11	12875	12888	2012	86	1	1
10	12875	12886	2012	86	1	1
45	12875	12013	2012	91	1	0
47	12875	12013	2012	90	1	0
48	12875	12013	2012	88	1	0
49	12875	12013	2012	95	1	0
50	12875	12013	2012	93	1	0
51	12875	12013	2012	87	1	0
52	12875	12013	2012	89	1	0
53	12875	12013	2012	92	1	0
54	12875	12012	2012	91	1	0
56	12875	12012	2012	90	1	0
57	12875	12012	2012	88	1	0
58	12875	12012	2012	95	1	0
59	12875	12012	2012	93	1	0
60	12875	12012	2012	87	1	0
61	12875	12012	2012	89	1	0
62	12875	12012	2012	92	1	0
63	12875	12011	2012	91	1	0
64	12875	12011	2012	86	1	0
65	12875	12011	2012	90	1	0
66	12875	12011	2012	88	1	0
67	12875	12011	2012	95	1	0
68	12875	12011	2012	93	1	0
69	12875	12011	2012	87	1	0
70	12875	12011	2012	89	1	0
71	12875	12011	2012	92	1	0
72	12875	12010	2012	91	1	0
73	12875	12010	2012	86	1	0
74	12875	12010	2012	90	1	0
75	12875	12010	2012	88	1	0
76	12875	12010	2012	95	1	0
77	12875	12010	2012	93	1	0
78	12875	12010	2012	87	1	0
79	12875	12010	2012	89	1	0
80	12875	12010	2012	92	1	0
46	12875	12013	2012	86	3	0
55	12875	12012	2012	86	3	0
\.


--
-- Data for Name: tblcorrespondencias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcorrespondencias (id_corresp, id_tipo_maestro, id_tipocorresp_maestro, id_unidad_maestro, dtmfecha, strasunto, strcuerpo, lngenviada, strcorrelativo, id_contacto, id_estatus_maestro, bolborrado, dtmfechaenvio) FROM stdin;
17	84	86	12012	2012-05-07 15:45:39.824376-04:30	Prueba de correo	prueba del correo<br type="_moz" />	0		235	199	0	\N
18	84	86	12013	2012-05-07 16:01:54.078474-04:30	ejemplo	&nbsp;pagina de prueba para el sistema procurando	1	CI/1/2012	672	199	0	2012-05-07 16:02:07.817347-04:30
19	84	86	12012	2012-05-07 16:03:25.30573-04:30	esto es una prueba	prueba<br type="_moz" />	1	DP/1/2012	235	199	0	2012-05-07 16:03:25.694376-04:30
20	84	86	12013	2012-12-17 17:51:14.269238-04:30	kjnjln	k&ntilde;mkmkmkmk<br type="_moz" />	1	CI/2/2012	672	199	0	2012-12-17 17:51:14.812378-04:30
21	84	86	12012	2012-12-17 17:53:28.994451-04:30	b khbkh	kb<br type="_moz" />	1	DP/2/2012	235	199	0	2012-12-17 17:53:29.475698-04:30
\.


--
-- Data for Name: tbldepartamentoactividad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbldepartamentoactividad (id_departamentoactividad, id_actividad, id_departamento_maestro, id_contacto, bolborrado) FROM stdin;
\.


--
-- Data for Name: tbldestinatarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbldestinatarios (id_destinatarios, id_destino_maestro, id_corresp, id_estatus_maestro, bolborrado, id_tipoenvio_maestro) FROM stdin;
20	12013	17	199	0	190
22	12013	19	202	0	190
23	12013	17	200	0	190
21	12012	18	217	0	190
24	12015	20	200	0	190
25	12013	21	202	0	190
\.


--
-- Data for Name: tbldetallecontactoactividad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbldetallecontactoactividad (id_detallecontactoactividad, id_contactoactividad, dtmregistro, menresultado, menobservaciones, bolborrado) FROM stdin;
\.


--
-- Data for Name: tbldictamenes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbldictamenes (id_dictamen, id_usuario, id_materia, id_tipo_materia, id_estado, fecdictamen, strtitulo, strasunto, stranrodictamen, strpersonas, bolborrado, id_tipo_organismo, id_organismo) FROM stdin;
1	672	13715	13746	13769	2012-08-19	vende carros	descripcion dos<br type="_moz" />	32	luis bustillo	0	13016	13436
2	672	13714	13739	13768	2012-09-19	Dictamen 2	Descripcion<br type="_moz" />	2	Juan,Pedro	0	13076	13456
\.


--
-- Data for Name: tbldocumento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbldocumento (id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, id_tipo_organismo, id_organismo, strpersona, id_refiere, visto, id_contacto, date, id_seguimiento, origen, strnumero, strtelefono, strrespuesta, strubicacion, strdirigido, strrecibido) FROM stdin;
\.


--
-- Data for Name: tbldocumento_seguimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbldocumento_seguimiento (id_documento_seguimiento, id_documento, id_remite, id_origen, id_remitente, fecdocumento_movimiento) FROM stdin;
\.


--
-- Data for Name: tblestados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblestados (id_estados, id_meestados_maestros, id_estinicial_maestro, id_estfinal_maestro, bolactivo, bolborrado) FROM stdin;
11	208	194	195	0	1
12	208	194	196	0	1
13	208	194	198	0	1
14	208	196	198	0	1
15	208	198	199	0	1
16	208	196	197	0	1
17	208	195	197	0	1
18	208	195	196	0	1
19	208	196	199	0	1
20	208	194	199	0	1
21	208	194	199	0	0
22	208	196	199	0	0
23	208	196	197	0	0
24	278	194	196	0	0
25	278	197	196	0	0
27	279	197	196	0	0
28	280	194	196	0	0
29	280	197	196	0	0
30	281	194	199	0	0
31	281	196	199	0	0
32	281	196	197	0	0
33	282	194	199	0	0
34	282	194	196	0	0
35	282	195	199	0	0
36	282	195	197	0	0
37	283	194	195	0	0
38	283	197	195	0	0
39	284	194	196	0	0
40	284	197	196	0	0
41	286	194	195	0	0
42	286	197	195	0	0
26	279	194	199	0	0
\.


--
-- Data for Name: tblfirmaautorizada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblfirmaautorizada (id_firma, id_corresp, id_contacto, bolborrado) FROM stdin;
2	20	235	0
3	21	235	0
\.


--
-- Data for Name: tblmaestros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblmaestros (id_maestro, id_origen, stritema, stritemb, stritemc, lngnumero, sngcant, bolborrado, id_sistema) FROM stdin;
84	82	Interna	Correspondencia interna	----	0	0	0	1
86	84	Circular	CIR	--	0	0	0	1
88	84	Memorando	MEM	---	0	0	0	1
98	85	Oficio	OFI	--	0	0	0	1
30	6	Coordinación Técnica	CT		0	0	1	1
31	6	Coordinación Administrativa	CA		0	0	1	1
104	2	Redactar	Documentos (Redactar)		0	0	0	1
299	292	Asignar	\N	\N	0	0	0	1
105	2	Actividades	Documentos (Actividades)		0	0	0	1
106	2	Registro de Maestro	Configuración (Registro de Maestro)		0	0	0	1
108	2	Perfiles de Usuarios	Configuración (Perfiles de Usuarios)		0	0	0	1
109	2	Asuntos Predeterminados	Configuración (Asuntos Predeterminados)		0	0	0	1
110	2	Correlativos	Configuración (Correlativos)		0	0	0	1
111	1	Perfiles de Usuario	Perfiles de Usuario		0	0	0	1
116	111	Analista	Analista	ANL	0	0	0	1
118	111	Secretaria	Secretaria a la Gerencia	SEC	0	0	0	1
120	111	Sin Perfil	Perfil inicial del usuario	SPERF	0	0	0	1
112	111	Administrador	Administrador del sistema	ADM	0	0	0	1
11	3	Oficina de Tecnologías de la Información	OTI		0	0	1	1
20	11	Coordinación de la Gerencia	CG		0	0	1	1
22	10	Coordinación de Formación y Capacitación	CFC		0	0	1	1
23	10	Coordinación de Atención al Campesino	CAC		0	0	1	1
24	10	Coordinación de Redes Socioproductivas	CRS		0	0	1	1
25	5	Coordinación Ejecutiva del Despacho	CED		0	0	1	1
26	12	Unidad de Compras	UDC		0	0	1	1
27	12	Coordinación de Administración	CDA		0	0	1	1
28	4	Coordinación de Gerencia General	CGG		0	0	1	1
32	4	Oficina Regional de Desarrollo Integral Amazonas	ORAM		0	0	1	1
33	4	Oficina Regional de Desarrollo Integral Delta Amacuro	ORDA		0	0	1	1
34	4	Oficina Regional de Desarrollo Integral  Anzoátegui	ORAN		0	0	1	1
35	4	Oficina Regional de Desarrollo Integral  Apure	ORAP		0	0	1	1
36	4	Oficina Regional de Desarrollo Integral  Aragua	ORAR		0	0	1	1
37	12	Coordinación Operativa	CO		0	0	1	1
38	4	Oficina Regional de Desarrollo Integral Barinas	ORBA		0	0	1	1
39	4	Oficina Regional de Desarrollo Integral  Bolívar	ORBO		0	0	1	1
40	4	Oficina Regional de Desarrollo Integral Carabobo	ORC		0	0	1	1
41	4	Oficina Regional de Desarrollo Integral Cojedes	ORCO		0	0	1	1
42	4	Oficina Regional de Desarrollo Integral Falcón	ORF		0	0	1	1
43	4	Oficina Regional de Desarrollo Integral Guárico	ORG		0	0	1	1
44	4	Oficina Regional de Desarrollo Integral Lara	ORL		0	0	1	1
45	4	Oficina Regional de Desarrollo Integral Mérida	ORM		0	0	1	1
46	4	Oficina Regional de Desarrollo Integral Miranda	ORMI		0	0	1	1
47	4	Oficina Regional de Desarrollo Integral Monagas	ORMO		0	0	1	1
48	4	Oficina Regional de Desarrollo Integral Portuguesa	ORP		0	0	1	1
49	4	Oficina Regional de Desarrollo Integral Sucre	ORS		0	0	1	1
51	4	Oficina Regional de Desarrollo Integral Trujillo	ORTR		0	0	1	1
52	4	Oficina Regional de Desarrollo Integral Vargas	ORV		0	0	1	1
53	4	Coordinación de Sala Situacional	CSS		0	0	1	1
54	4	Oficina Regional de Desarrollo Integral Yaracuy	ORY		0	0	1	1
55	4	Oficina Regional de Desarrollo Integral  Zulia	ORZ		0	0	1	1
56	8	Coordinación de Valuaciones	CV		0	0	1	1
57	8	Coordinación de Contratos	CCON		0	0	1	1
58	8	Coordinación de Inspecciones	CINS		0	0	1	1
59	8	Coordinación de Seguimiento y Control	CSC		0	0	1	1
60	8	Unidad de Archivo	UAR		0	0	1	1
61	18	Coordinación de Gestión de Riego	CDGR		0	0	1	1
62	12	Unidad de Bienes Nacionales	UBN		0	0	1	1
63	12	Unidad de Almacen	UDA		0	0	1	1
64	12	Unidad de Contabilidad	UDCT		0	0	1	1
65	12	Unidad de Transporte	UDT		0	0	1	1
66	12	Unidad de Seguridad	UDS		0	0	1	1
67	12	Unidad de Servicios Generales	UDSG		0	0	1	1
68	14	Coordinación de Presupuesto	CPPTO		0	0	1	1
69	14	Coordinación de Planificación	CPLF		0	0	1	1
70	12	Unidad de Tesorería	UDT		0	0	1	1
71	16	Coordinación General	CGC		0	0	1	1
72	14	Coordinación de la Gerencia	CDG		0	0	1	1
73	16	Coordinación de Prensa	CDP		0	0	1	1
74	9	Coordinación de Estudios y Proyectos	CDEP		0	0	1	1
75	18	Coordinación de Grandes Sistemas	CGS		0	0	1	1
76	18	Coordinación de Gestión Agrícola	CDGA		0	0	1	1
78	29	Coordinación Administrativa	CAD		0	0	1	1
79	29	Coordinación Operativa	COP		0	0	1	1
80	29	Coordinación General	COG		0	0	1	1
83	82	Circular	Circular	-----	0	0	1	1
85	82	Externa	Correspondencia externa	-----	0	0	1	1
82	1	Tipos de Correspondencia	Interna, Externa		0	0	0	1
130	103	Ver	Acción que permite leer un correspondencia		0	0	0	1
138	104	Redactar	Acción que permite redactar una correspondencia		0	0	0	1
339	12843	Cerrar	\N	\N	0	0	0	1
141	104	Enviar	Acción que permite enviar una correspondencia		0	0	0	1
117	111	Presidente	Presidente del instituto	PRES	0	0	1	1
140	104	Modificar	Acción que permite modificar una correspondencia redactada		0	0	0	1
139	104	Ver	Acción que permite leer una correspondencia redactada		0	0	0	1
143	104	Imprimir	Acción que permite imprimir una correspondencia		0	0	0	1
144	104	Plantilla	Acción que permite usar como plantilla una correspondencia		0	0	0	1
145	104	Borrar	Acción que permite borrar una correspondencia		0	0	0	1
146	104	Ver Adjunto	Acción que permite ver los archivos adjuntos de una correspondencia		0	0	0	1
147	104	Reenviar	Acción que permite reenviar una correspondencia		0	0	0	1
148	104	Adjuntar	Acción que permite adjuntar uno o varios archivos a una correspondencia		0	0	0	1
150	105	Crear	 \tAcción que permite crear actividades		0	0	0	1
151	105	Asignar Actividades	 \tAcción que permite asignar actividades a una gerencia o coordinación		0	0	0	1
152	105	Asignar Analista	Acción que permite asignar actividades a un analista		0	0	0	1
149	105	Ver todas las actividades	Acción que permite ver las todas las actividades		0	0	0	1
153	105	Ver mis actividades	Acción que permite ver las actividades asignadas a un usuario		0	0	0	1
154	105	Cerrar	Acción que permite cerrar las activiadades finalizadas		0	0	0	1
155	106	Control Total	Acción que permite tener control total sobre el registro de maestro	Agregar, Ver, Actualizar y Eliminar	0	0	0	1
156	107	Control Total	Acción que permite tener control total sobre los usuarios del sistema	Agregar, Ver, Actualizar y Eliminar	0	0	0	1
157	108	Control Total	Acción que permite tener control total sobre los perfiles de usuarios	Agregar, Ver, Actualizar y Eliminar	0	0	0	1
158	109	Crear	Acción que permite crear asuntos predeterminados		0	0	0	1
159	109	Ver	 \tAcción que permite ver asuntos predeterminados		0	0	0	1
160	109	Modificar	 \tAcción que permite modificar asuntos predeterminados		0	0	0	1
161	109	Eliminar	 \tAcción que permite eliminar asuntos predeterminados		0	0	0	1
162	110	Control Total	Acción que permite tener control total sobre los correlativos		0	0	0	1
163	1	Cargos	Cargos del personal INDER		0	0	0	1
167	1	Estatus de Usuario	Estatus de los usuarios del sistema		0	0	0	1
168	167	Activo	Estatus Activo del sistema		0	0	0	1
169	167	Inactivo	Estatus Inactivo del sistema		0	0	0	1
170	1	Tipo de Contacto	Interno, Externo		0	0	0	1
171	170	Interno	Tipo de contacto interno		0	0	0	1
172	170	Externo	Tipo de contacto externo		0	0	0	1
174	1	Asuntos Predeterminados	Asuntos predeterminados por departamento		0	0	0	1
175	174	Solicitud de laptop	asunto predeterminado para solicitar una laptop		11	\N	0	1
97	85	Invitación a Reunión	IARE	--	0	0	1	1
99	85	Nota de Entrega	NDE	--	0	0	1	1
100	85	Fax	FAX	---	0	0	1	1
101	85	Oficio Banco	OFIBAN	--	0	0	1	1
87	84	Punto de Información	PTINFO		0	0	0	1
91	84	Acta de Entrega de Equipo	ACTENT		11	0	0	1
132	103	Editar	Acción que permite Editar una correspondencia		0	0	0	1
93	84	Nota de Entrega	NOTENT		11	0	0	1
89	84	Remisión de Documentos	REMDOC		0	0	0	1
92	84	Salida de Equipo	SALEQUI		11	0	0	1
134	103	Enviar a Gerente	Acción que permite enviar a gerente una correspondencia		0	0	0	1
133	103	Enviar a Coordinador	Acción que permite enviar a coordinador la correspondencia		0	0	0	1
135	103	Enviar	Acción que permite enviar una correspondencia		0	0	0	1
136	103	Reenviar	Acción que permite reenviar una correspondencia		0	0	0	1
137	103	Imprimir	Acción que permite imprimir una correspondencia		0	0	0	1
114	111	Coordinador	Coordinador de un departamento	COORD	\N	\N	0	1
177	174	prueba	prueba		17	\N	0	1
107	2	Usuarios del Sistema	Configuración (Usuarios del Sistema)		0	0	0	1
192	189	CCO	Con Copia Oculta		0	0	0	1
191	189	CC	Con Copia		0	0	0	1
190	189	PR	Para		0	0	0	1
189	1	Tipo Envio de Correspondencia	Tipo del envio		0	0	0	1
193	1	Estatus de la Correspondencia	Maestro que registra los diferentes estatus		0	0	0	1
194	193	Borrador	Estatus Borrador		0	0	0	1
207	1	ME - Modelo de Estados	Modelos de estados		0	0	0	1
210	2	Registro de Contactos Externos	Configuración (Registro de Contactos Externos)		0	0	0	1
211	2	Modelos de Estados	Configuración (Modelos de Estados)		0	0	0	1
212	210	Control Total	Acción que permite tener control total sobre los Contactos Externos		0	0	0	1
213	211	Control Total	Acción que permite tener control total sobre los Modelos de Estados		0	0	0	1
195	193	Enviado a Coordinador	Estatus Enviado a Coordinador		0	0	0	1
196	193	Enviado a Gerente	Estatus Enviado a Gerente		0	0	0	1
197	193	Devuelto a Analista	Estatus Devuelto a Analista		0	0	0	1
304	12834	Seguimiento	\N	\N	0	0	0	1
95	84	Movilización de Equipos	MOVEQU		0	0	0	1
200	193	Interna Recibida No Leida	Estatus Interna Recibida No Leida		0	0	0	1
238	1	Tipo de Nota	Maestro que registra los tipos de notas		0	0	0	1
203	193	Externa Recibida Leida	Estatus Externa Recibida Leida		0	0	0	1
201	193	Externa Recibida No Leida	Estatus Externa Recibida No Leida		0	0	0	1
202	193	Interna Recibida Leida	Estatus Interna Recibida Leida		0	0	0	1
206	163	Director	Director	DIRCT	0	0	0	1
166	163	Coordinador	Coordinador	CDO	0	0	0	1
204	193	Asignada	Estatus Asignada		0	0	0	1
12935	12913	Vargas	\N	\N	0	0	0	2
239	238	Nota de Correspondencia	nota de la correspondencia		0	0	0	1
216	193	Cerrada	Estatus Cerrada		0	0	0	1
217	193	Respondidas	Estatus respondidas		0	0	0	1
214	193	En Proceso	Estatus En Proceso		0	0	1	1
215	193	Finalizada	Estatus Finalizada		0	0	1	1
29	10	Convenio Cuba 	CONVC		0	0	1	1
218	3	Convenio Integral de Cooperación Cuba Venezuela	CONCV		0	0	0	1
219	174	Remisión de facturas			12	\N	0	1
96	85	Informe	INF	--	0	0	1	1
240	238	Nota de Actividad	nota de la actividad		0	0	0	1
241	221	Imprimir	Acción que permite imprimir una correspondencia		0	0	0	1
220	174	Remisión de viáticos y gastos de retribución			12	\N	0	1
221	2	Bandeja de Entrada	Documentos (Bandeja de Entrada)		0	0	0	1
131	103	Seguimiento	Acción que permite hacer seguimiento a una correspondencia		0	0	0	1
223	103	Eliminar	Acción que permite eliminar una correspondencia		0	0	0	1
224	103	Adjunto	 \tAcción que permite ver adjunto de una correspondencia		0	0	0	1
225	103	Plantilla	Acción que permite usar como plantilla una correspondencia		0	0	0	1
222	221	Ver	Acción que permite leer una correspondencia		0	0	0	1
226	221	Seguimiento	Acción que permite hacer seguimiento a una correspondencia		0	0	0	1
227	221	Plantilla	Acción que permite usar la correspondencia como una plantilla		0	0	0	1
228	221	Adjunto	Acción que permite ver adjunto de una correspondencia		0	0	0	1
229	221	Asignar	Acción que permite asignar una correspondencia		0	0	0	1
230	221	Responder	Acción que permite responder una correspondencia		0	0	0	1
231	221	Cerrar	Acción que permite cerrar una correspondencia		0	0	0	1
232	221	Ver Actividades	Acción que permite ver las actividades de una correspondencia		0	0	0	1
233	1	Estatus de la ruta de la correspondencia	Maestro de los estatus de la ruta		0	0	0	1
242	1	Tipos de Prioridad	Maestro que registra los tipos de prioridad		0	0	0	1
246	1	Estatus de la Actividad	Maestro que registra los diferentes estatus de las actividades		0	0	0	1
247	246	No Asignada	Estatus No Asignada		0	0	0	1
248	246	Asignada a Coordinador	Estatus Asignada a Coordinador		0	0	0	1
249	246	Asignada a Analista	Estatus Asignada a Analista		0	0	0	1
250	246	Cerrada Por Coordinador	Estatus Cerrada Por Coordinador		0	0	0	1
251	246	Cerrada Por Analista	Estatus Cerrada Por Analista		0	0	0	1
252	246	Devuelto a Coordinador	Estatus Devuelto a Coordinador		0	0	0	1
253	246	Devuelto a Analista	Estatus Devuelto a Analista		0	0	0	1
254	246	Finalizada	Estatus Finalizada		0	0	0	1
234	233	Creó	Estatus de la creación del documento		0	0	0	1
235	233	Modificó	Estatua de la modificación del documento		0	0	0	1
236	233	Envió	Estatus del envio del documento		0	0	0	1
237	233	Recibió / Leyó	Estatus de recibió / leyó del documento		0	0	0	1
255	233	Cerró	Estatus del cierre del documento		0	0	0	1
257	233	Asignó	Estatus de la asignó de la actividad		0	0	0	1
258	233	Leyó	Estatus de leyó la actividad		0	0	0	1
259	233	Adelantó	Estatus de adelantó la actividad		0	0	0	1
260	233	Cerró por Analista	Estatus de cerró por analista la actividad		0	0	0	1
264	263	Redactar	Acción que permite redactar una correspondencia externa		0	0	0	1
263	2	Externos	Documentos (Externo)		0	0	0	1
205	193	Finalizada	Estatus Finalizada		0	0	0	1
243	242	Alta	Prioridad Alta		0	0	0	1
245	242	Baja	Prioridad Baja		0	0	0	1
209	207	Modelo Estatus Actividad	Modelo Estatus Actividad		\N	\N	1	1
198	193	Por Enviar	Estatus Por Enviar		0	0	1	1
265	246	En Proceso	En Proceso		0	0	0	1
244	242	Media	Prioridad Media		0	0	0	1
266	2	Borradores	Documentos (Borradores)		0	0	0	1
267	266	Ver	Acción que permite leer un correspondencia	\N	0	0	0	1
268	266	Seguimiento	Acción que permite hacer seguimiento a una correspondencia	\N	0	0	0	1
269	266	Editar	Acción que permite Editar una correspondencia	\N	0	0	0	1
300	292	Responder	\N	\N	0	0	0	1
270	266	Enviar a Coordinador	Acción que permite enviar a coordinador la correspondencia	\N	0	0	0	1
271	266	Enviar a Gerente	Acción que permite enviar a gerente una correspondencia	\N	0	0	0	1
272	266	Enviar	Acción que permite enviar una correspondencia	\N	0	0	0	1
273	266	Reenviar	Acción que permite reenviar una correspondencia	\N	0	0	0	1
274	266	Imprimir	Acción que permite imprimir una correspondencia	\N	0	0	0	1
256	233	Creó	Estatus de la creación de la actividad		0	0	0	1
261	233	Quitó	Estatus de quito al analista de la actividad		0	0	0	1
262	233	Finalizó	Estatus de Finalizó la actividad		0	0	0	1
275	266	Eliminar	Acción que permite eliminar una correspondencia	\N	0	0	0	1
277	266	Plantilla	Acción que permite usar como plantilla una correspondencia	\N	0	0	0	1
285	111	Secretaria Coordinación	Secretaria a la Coordinación		\N	\N	0	1
115	111	Asistente	Asistente de un gerente	AST	0	0	1	1
119	111	Analista Integral	Analista que realiza varias actividades	ANLI	0	0	1	1
338	12843	Ver mis Actividades	\N	\N	0	0	0	1
208	207	Modelo Correspondencia Horizontal Gerente	Modelo Correspondencia Horizontal Gerente		0	\N	0	1
12921	12913	Cojedes	\N	\N	0	0	0	2
7	3	Proyecto Sociotecnologico	PS		0	0	1	1
278	207	Modelo Correspondencia Horizontal Coordinador	Modelo Correspondencia Horizontal Coordinador		0	\N	0	1
279	207	Modelo Correspondencia Horizontal Analista	Modelo Correspondencia Horizontal Analista		0	\N	0	1
280	207	Modelo Correspondencia Horizontal Secretaria	Modelo Correspondencia Horizontal Secretaria		0	\N	0	1
281	207	Modelo Correspondencia Vertical Gerente	Modelo Correspondencia Vertical Gerente		1	\N	0	1
282	207	Modelo Correspondencia Vertical Coordinador	Modelo Correspondencia Vertical Coordinador		1	\N	0	1
283	207	Modelo Correspondencia Vertical Analista	Modelo Correspondencia Vertical Analista		1	\N	0	1
284	207	Modelo Correspondencia Vertical Secretaria	Modelo Correspondencia Vertical Secretaria		1	\N	0	1
286	207	Modelo Correspondencia Vertical Secretaria Coordinación	Modelo Correspondencia Vertical Secretaria Coordinación		1	\N	0	1
199	193	Enviada	Estatus Enviada		0	0	0	1
176	174	Apertura de cuenta	Asunto Predeterminado para la solicitud de la apertura de la cuenta nomina		6	\N	0	1
291	0	Formularios	Formularios del sistema	\N	0	0	0	1
290	289	Bandeja de Entrada	bandeja de entrada	Form_bandeja_entradamodelos_estados	292	0	0	1
293	292	Ver	\N	\N	0	0	0	1
292	291	Form_bandeja_entrada	Form_bandeja_entrada	../vista/bandejaVista.php	0	2	0	1
12853	12852	ver	\N	\N	0	0	0	1
12850	12849	ver	\N	\N	0	0	0	1
295	0	Configuracion	Configuracion del Sistema de Correspondencia	\N	0	0	0	1
294	0	Reportes	Reportes del Sistema de Correspondencia	\N	0	0	0	1
12851	294	Reportes	Reportes	Form_reportes	12852	0	0	1
12852	291	Form_reportes	Form_reportes	../vista/reporteVista.php	0	8	0	1
12865	12864	ver	\N	\N	0	0	0	1
12849	291	Form_pendientes	Form_pendientes	../vista/pendientes.php	0	7	0	1
296	292	Seguimiento	\N	\N	0	0	0	1
297	292	Plantilla	\N	\N	0	0	0	1
298	292	Adjunto	\N	\N	0	0	0	1
301	292	Cerrar	\N	\N	0	0	0	1
302	292	Ver Actividades	\N	\N	0	0	0	1
303	292	Imprimir	\N	\N	0	0	0	1
276	266	Adjunto	Acción que permite ver adjunto de una correspondencia	\N	0	0	0	1
2	1	Estructura del Sistema	menú del sistema	---	0	0	0	1
3	1	Departamentos	Departamentos de la Institución	----	0	0	0	1
12893	12875	Gestión y Coordinación  de Ciencias del Deporte	GCCD	\N	0	0	1	1
12894	12875	Gestión y Coordinación de Diseño Integral	GCDI	\N	0	0	1	1
12848	289	Pendientes	Pendientes	Form_pendientes	12849	0	1	1
12895	12875	Gerencia y Coordinación Académica 	GCA	\N	0	0	1	1
12898	1	Departamentos	Departamentos de la Institución	\N	0	0	0	1
12899	12886	Coordinación de Hardware y Software	OIECHS	\N	0	0	0	1
12832	111	Coordinador	\N	\N	0	0	1	1
12835	12834	Ver	\N	\N	0	0	0	1
12836	289	Borradores	Borradores	Form_borradores	12837	0	0	1
12837	291	Form_borradores	Form_borradoes	../vista/borradoresVista.php	0	3	0	1
12838	12837	ver	\N	\N	0	0	0	1
12839	289	Redactar	Redactar	Form_redactar	12840	0	0	1
12840	291	Form_redactar	Form_redactar	../vista/redactarVista.php	0	4	0	1
12841	12840	ver	\N	\N	0	0	0	1
12842	289	Actividades	Actividades	Form_actividades	12843	0	0	1
12843	291	Form_actividades	Form_actividades	../vista/actividadVista.php	0	5	0	1
12844	12843	ver	\N	\N	0	0	0	1
12845	289	Externos	Externos	Form_externos	12846	0	0	1
12846	291	Form_externos	Form_externos	../vista/redactarExternoVista.php	0	6	0	1
12847	12846	ver	\N	\N	0	0	0	1
12854	295	Registro de Maestro	Registro de Maestro	Form_registro_maestro	12855	0	0	5
12834	291	Form_bandeja_revision	Form_bandeja_revision	../vista/leerVista.php	0	1	0	1
12855	291	Form_registro_maestro	Form_registro_maestro	../vista/maestroVista.php	0	9	0	5
12856	12855	ver	\N	\N	0	0	0	5
12857	295	Usuarios del Sistema	Usuarios del Sistema	Form_usuarios_sistema	12858	0	0	5
12859	12858	ver	\N	\N	0	0	0	5
12860	295	Perfiles de Usuarios	Perfiles de Usuarios	Form_perfiles_usuarios	12861	0	0	5
12861	291	Form_perfiles_usuarios	Form_perfiles_usuarios	../vista/perfilesVista.php	0	11	0	5
12862	12861	ver	\N	\N	0	0	0	5
12864	291	Form_asuntos_predeterminados	Form_asuntos_predeterminados	../vista/asuntoVista.php	0	12	0	1
12866	295	Correlativos	Correlativos	Form_correlativos	12867	0	0	5
12863	295	Asuntos Predeterminados	Asuntos Predeterminados	Form_asuntos_predeterminados	12864	0	0	1
12867	291	Form_correlativos	Form_correlativos	../vista/correlativoVista.php	0	13	0	5
12868	12867	ver	\N	\N	0	0	0	5
12869	295	Registro de Contactos Externos	Registro de Contactos Externos	Form_registro_externos	12870	0	0	5
12870	291	Form_registro_externos	Form_registro_externos	../vista/contactoExternoVista.php	0	14	0	5
12871	12870	ver	\N	\N	0	0	0	5
12872	295	Modelos de Estados	Modelos de Estado	Form_modelos_estados	12873	0	0	5
12873	291	Form_modelos_estados	Form_modelos_estados	../vista/modeloVista.php	0	15	0	5
12874	12873	ver	\N	\N	0	0	0	5
1	0	Maestros del Sistema	Todos los maestros		\N	\N	0	1
4	3	Gestión y Coordinacion de Diseño Integral	GCDI		0	0	1	1
5	3	1	DIC		0	0	1	1
6	3	2	GCDI		0	0	1	1
94	84	Nota de Entrega	NOTENT		0	0	0	1
8	3	Gerencia de Infraestructura	GI		1	0	1	1
288	111	Supervisor	Supervisor de un Departamento		\N	\N	1	1
287	111	Abogados	Abogados de la Procuraduria		\N	\N	0	1
9	3	Gerencia de Estudios y Proyectos	GEP		0	0	1	1
10	3	Gerencia de Desarrollo Comunitario	GDC		0	0	1	1
12	3	Oficina de Administración y Servicios	OAS		0	0	1	1
13	3	Oficina de Consultoría Jurídica	CJ		0	0	1	1
14	3	Oficina de Planificación Estratégica Presupuesto y Control de Gestión	OPEPCG		0	0	1	1
15	3	Gerencia de Pueblos Indígenas	GPI		0	0	1	1
16	3	Oficina de Comunicación para el Desarrollo y Relaciones Institucionales	OCDRI		0	0	1	1
17	3	Comité de Contrataciones	CT		0	0	1	1
18	3	Gerencia de Gestión de Sistemas Hidroagrícolas	GGSH		0	0	1	1
19	5	Asuntos Presidenciales	AP		0	0	1	1
21	11	Coordinación de Infraestructura Tecnológica	CIT		0	0	1	1
50	4	Oficina Regional de Desarrollo Integral Táchira	ORT		0	0	1	1
77	11	Coordinación de Análisis y Desarrollo de Sistemas	ADIS		0	0	1	1
81	29	Coordinación Especialista de Proyectos	CEP		0	0	1	1
305	12834	Editar	\N	\N	0	0	0	1
306	12834	Enviar a Coordinador	\N	\N	0	0	0	1
307	12834	Enviar a Gerente	\N	\N	0	0	0	1
308	12834	Enviar	\N	\N	0	0	0	1
309	12834	Reenviar	\N	\N	0	0	0	1
310	12834	Imprimir	\N	\N	0	0	0	1
311	12834	Eliminar	\N	\N	0	0	0	1
312	12834	Adjunto	\N	\N	0	0	0	1
313	12834	Plantilla	\N	\N	0	0	0	1
314	12837	Seguimiento	\N	\N	0	0	0	1
315	12837	Editar	\N	\N	0	0	0	1
316	12837	Enviar a Coordinador	\N	\N	0	0	0	1
317	12837	Enviar a Gerente	\N	\N	0	0	0	1
318	12837	Enviar	\N	\N	0	0	0	1
319	12837	Reenviar	\N	\N	0	0	0	1
320	12837	Imprimir	\N	\N	0	0	0	1
321	12837	Eliminar	\N	\N	0	0	0	1
322	12837	Adjunto	\N	\N	0	0	0	1
323	12837	Plantilla	\N	\N	0	0	0	1
324	12840	Redactar	\N	\N	0	0	0	1
325	12840	Modificar	\N	\N	0	0	0	1
326	12840	Enviar	\N	\N	0	0	0	1
327	12840	Enviar a Revision	\N	\N	0	0	0	1
328	12840	Imprimir	\N	\N	0	0	0	1
329	12840	Plantilla	\N	\N	0	0	0	1
330	12840	Borrar	\N	\N	0	0	0	1
331	12840	Ver Adjunto	\N	\N	0	0	0	1
332	12840	Reenviar	\N	\N	0	0	0	1
333	12840	Adjuntar	\N	\N	0	0	0	1
334	12843	Ver Todas las Actividades	\N	\N	0	0	0	1
335	12843	Crear	\N	\N	0	0	0	1
336	12843	Asignar Actividades	\N	\N	0	0	0	1
337	12843	Asignar Analista	\N	\N	0	0	0	1
12012	12875	Despacho del Procurador	DP	\N	0	0	0	1
12011	12875	Unidad de Atención al Soberano	UAS	\N	0	0	0	1
12896	12875	Gestión y Coordinación Académica de la Investigación	GCAI	\N	0	0	1	1
12897	12875	Grupo Ambientalista	GA	\N	0	0	1	1
12900	12875	Información y Relaciones Públicas	IRP	\N	0	0	1	1
12901	12875	Jubilaciones	JUB	\N	0	0	1	1
12902	12875	Pensiones de Sobrevivientes	PS	\N	0	0	1	1
12903	12875	Planificacion Institucional	PI	\N	0	0	1	1
12904	12875	Planificación y Presupuesto	PP	\N	0	0	1	1
12905	12875	Rectorado Gerencia	RG	\N	0	0	1	1
12906	12875	Recursos Humanos	RRHH	\N	0	0	1	1
12907	12875	Relaciones Interinstitucionales	RI	\N	0	0	1	1
12908	12875	Secretaria Gerencia	SECRG	\N	0	0	1	1
12909	12875	Servicio Comunitario	SC	\N	0	0	1	1
12911	12875	Gestión y Coordinación de la Territorialización y Municipalización de la Educación Universitaria	GCTMEU	\N	0	0	1	1
12013	12875	Coordinacion de Informatíca	CI	\N	0	0	0	1
90	84	Instrucción	IMTRO		0	0	0	1
340	12846	Redactar	\N	\N	0	0	0	1
12914	12913	Amazonas	\N	\N	0	0	0	2
12915	12913	Anzoátegui	\N	\N	0	0	0	2
12916	12913	Apure	\N	\N	0	0	0	2
12917	12913	Aragua	\N	\N	0	0	0	2
12918	12913	Barinas	\N	\N	0	0	0	2
12919	12913	Bolívar	\N	\N	0	0	0	2
12920	12913	Carabobo	\N	\N	0	0	0	2
12922	12913	Delta Amacuro	\N	\N	0	0	0	2
12884	12875	Gestión y Coordinación del Sistema Apoyo al Desarrollo Estudiantil	GCSADE	\N	0	0	1	1
12923	12913	Distrito Capital	\N	\N	0	0	0	2
12924	12913	Falcón	\N	\N	0	0	0	2
12925	12913	Guárico	\N	\N	0	0	0	2
12926	12913	Lara	\N	\N	0	0	0	2
12927	12913	Mérida	\N	\N	0	0	0	2
12928	12913	Miranda	\N	\N	0	0	0	2
12929	12913	Monagas	\N	\N	0	0	0	2
12930	12913	Nueva Esparta	\N	\N	0	0	0	2
12876	12875	Admisión y Control de Estudio	ACE		0	0	1	1
12877	12875	Asesoria Juridica	AJ	\N	0	0	1	1
12882	12875	Ciencia y Cultura de la Alimentación	CCA		0	0	1	1
12883	12875	Ciencias del Deporte	CD	\N	0	0	1	1
12887	12875	Coordinación Operativa	CO	\N	0	0	1	1
12886	12875	Coordinación de Planta Fisica	CPF	\N	0	0	1	1
12888	12875	Diseño Integral Comunitario	DIC	\N	0	0	1	1
12889	12875	Eventos Culturales	EC	\N	0	0	1	1
12890	12875	Eventos Deportivos	ED	\N	0	0	1	1
12891	12875	Fondo Editorial	FD	\N	0	0	1	1
12931	12913	Portuguesa	\N	\N	0	0	0	2
12932	12913	Sucre	\N	\N	0	0	0	2
12933	12913	Tachira	\N	\N	0	0	0	2
12934	12913	Trujillo	\N	\N	0	0	0	2
12936	12913	Yaracuy	\N	\N	0	0	0	2
12937	12913	Zulia	\N	\N	0	0	0	2
12938	12936	Aristides Bastidas	\N	\N	0	0	0	2
12939	12936	Bolivar	\N	\N	0	0	0	2
12940	12936	Bruzual	\N	\N	0	0	0	2
12941	12936	Cocorote	\N	\N	0	0	0	2
12942	12936	Independencia	\N	\N	0	0	0	2
12943	12936	Jose Antonio Paez	\N	\N	0	0	0	2
12944	12936	La Trinidad	\N	\N	0	0	0	2
12945	12936	Manuel Monge	\N	\N	0	0	0	2
12946	12936	Nirgua	\N	\N	0	0	0	2
12947	12936	Peña	\N	\N	0	0	0	2
12948	12936	San Felipe	\N	\N	0	0	0	2
12949	12936	Sucre	\N	\N	0	0	0	2
12950	12936	Urachiche	\N	\N	0	0	0	2
12951	12936	Veroes	\N	\N	0	0	0	2
12953	291	Form_clientes	Form_clientes	../vista/vista_clientes.php	0	0	0	2
12954	12953	Ver	\N	\N	0	0	0	2
12956	12955	Soltero(a)	\N	\N	0	0	0	2
12957	12955	Casado(a)	\N	\N	0	0	0	2
12958	12955	Concubinato	\N	\N	0	0	0	2
12959	12955	Viudo(a)	\N	\N	0	0	0	2
12961	12960	Masculino	\N	\N	0	0	0	2
12962	12960	Femenino	\N	\N	0	0	0	2
12964	291	Form_abogados	Form_abogados	../vista/vista_abogados.php	0	0	0	2
12965	12964	Ver	\N	\N	0	0	0	2
12967	12966	Provincial	\N	\N	0	0	0	2
12968	12966	Casa Propia	\N	\N	0	0	0	2
12969	12966	Banesco	\N	\N	0	0	0	2
12970	12966	Exterior	\N	\N	0	0	0	2
12971	12966	Mercantil	\N	\N	0	0	0	2
12972	12966	Bicentenario	\N	\N	0	0	0	2
12973	12966	Industrial	\N	\N	0	0	0	2
12974	12966	Agricola	\N	\N	0	0	0	2
12975	12966	Sofitasa	\N	\N	0	0	0	2
12976	12966	Confederado	\N	\N	0	0	0	2
12977	12966	Venezuela	\N	\N	0	0	0	2
12978	12966	Caroni	\N	\N	0	0	0	2
12980	291	Form_abogados_contrarios	Form_abogados_contrarios	../vista/vista_abogados_contrarios.php	0	0	0	2
12981	12980	Ver	\N	\N	0	0	0	2
12982	12980	Guardar	\N	\N	0	0	0	2
12983	12980	Editar	\N	\N	0	0	0	2
12984	12980	Eliminar	\N	\N	0	0	0	2
12986	291	Form_honorarios	Form_honorarios	../vista/vista_tblprohonorarios.php	0	0	0	2
12987	12986	Ver	\N	\N	0	0	0	2
12988	12986	Guardar	\N	\N	0	0	0	2
12989	12986	Editar	\N	\N	0	0	0	2
12990	12986	Eliminar	\N	\N	0	0	0	2
12998	12997	Gastos	\N	\N	0	0	0	2
12999	12997	\N	\N	\N	0	0	0	2
13000	12997	\N	\N	\N	0	0	0	2
13001	12997	\N	\N	\N	0	0	0	2
13004	13003	Ver	\N	\N	0	0	0	2
13014	13012	Demandante	\N	\N	0	0	0	2
13007	13006	Ver	\N	\N	0	0	1	2
12992	291	Form_juzgado	For-juzgadom	../vista/vista_tblprojuzgados.php	0	0	1	2
12993	12992	Ver	\N	\N	0	0	1	2
12994	12992	Guardar	\N	\N	0	0	1	2
12995	12992	Editar	\N	\N	0	0	1	2
12996	12992	Eliminar	\N	\N	0	0	1	2
13003	291	Form_oas	Form_oas	../vista/vista_tblproexpediente.php	0	0	0	2
13011	13010	Asesoría	\N	\N	0	0	0	2
13037	13008	Declaración Jurada de no Poseer Vivienda	\N	\N	0	0	0	2
13043	13008	Documentos de Cesión de Derechos	\N	\N	0	0	0	2
13030	13009	Original del Acta de Matrimonio	\N	\N	0	0	0	2
13031	13009	Fotoscopias de la Cédula de los Solicitantes	\N	\N	0	0	0	2
13032	13009	Indicar la Dirección Exacta del Último Domicilio Conyugal	\N	\N	0	0	0	2
12960	0	Combo Tipos de Sexo	Sexo	\N	0	0	0	2
12955	0	Combo Tipos Estados Estado Civil	Estado Civil	\N	0	0	0	2
12997	0	Combo Tipo de Honorarios	\N	\N	0	0	0	2
13012	0	Combo Tipo Actuacion	\N	\N	0	0	0	2
13023	0	Combo Tipo Minuta	\N	\N	0	0	0	2
13008	0	Combo Tipo Tramite	\N	\N	0	0	0	2
13044	13009	Dirección de la Residencia de cada uno de los Solicitantes y la Fecha aproximada de Separación	\N	\N	0	0	0	2
13045	13009	Partida de Nacimiento y si son mayores de Edad cédula de cada uno de los hijos	\N	\N	0	0	0	2
13046	13041	Fotocopia de Cédula de Identidad de los Miembros	\N	\N	0	0	0	2
13047	13041	Indicar Nombre de la Asociación	\N	\N	0	0	0	2
13048	13041	Domicilio Exacto	\N	\N	0	0	0	2
13050	13041	Descripción del Objeto de la Asociación Civil	\N	\N	0	0	0	2
13051	13041	Miembros van a Represantar a la Junta Directiva	\N	\N	0	0	0	2
13053	13037	Fotocopia de Cédula de Identidad	\N	\N	0	0	0	2
13054	13043	Fotocopia de la Cédula de Identidad	\N	\N	0	0	0	2
13055	13043	Fotocopia de la Cédula de Identidad de las Personas quienes se le cedera los derechos	\N	\N	0	0	0	2
13151	13141	Veroes	\N	\N	0	0	0	2
13057	13043	Fotocopia del Documento de Propiedad del Inmueble	\N	\N	0	0	0	2
13058	13035	Original de Partida de Nacimientos Herederos	\N	\N	0	0	0	2
13016	13015	GOBERNACIÓN	\N	\N	0	0	0	2
13059	13035	Original del Acta de Defunción y fotocopia de Cedula de Identidad	\N	\N	0	0	0	2
13161	13144	Independencia	\N	\N	0	0	0	2
13060	13035	Fotocopia de Cédula de Identidad de los Herederos	\N	\N	0	0	0	2
13061	13035	Original de Acta de Matrimonio	\N	\N	0	0	0	2
13062	13035	Fotocopia de Cédula de dos Testigos	\N	\N	0	0	0	2
13063	13034	Fotocopia de Cédula de los Solicitantes	\N	\N	0	0	0	2
13064	13034	Levantamiento planimetrico suscrito por la Oficina de Catastro Municipal	\N	\N	0	0	0	2
13962	13948	Formato	\N	\N	0	0	0	2
13181	13179	Piso 2	\N	\N	0	0	0	2
13018	14059	IHAVEY	\N	\N	0	0	0	2
13019	14059	IAPESEY	\N	\N	0	0	0	2
13020	14059	PROSALUD	\N	\N	0	0	0	2
13021	14059	IADEY	\N	\N	0	0	0	2
13022	14059	INAJUDEY	\N	\N	0	0	0	2
13065	13034	Fotocopia de Cédula de Identidad de dos Testigos	\N	\N	0	0	0	2
13066	13034	Indicar las Caracteristicas de la Vivienda y monto aproximado de lo Invertido	\N	\N	0	0	0	2
13067	13008	Rescate de Tierras	\N	\N	0	0	0	2
13068	13067	Identificación Completa del o la Denunciante	\N	\N	0	0	0	2
13069	13067	Caracter con que Actua el o la Denunciante	\N	\N	0	0	0	2
13071	13067	Ubicación del Inmueble (Caracteristicas y Linderos)	\N	\N	0	0	0	2
13072	13067	Condiciones en la que se Encuentra el o la Ocupante, propietario o propietaria	\N	\N	0	0	0	2
13073	13067	Cualquier otra Información que sirva para ordenar la apertura del Procedimiento	\N	\N	0	0	0	2
13092	13010	Asistencia	\N	\N	0	0	0	2
13084	13082	Ver	Ver	\N	0	0	0	2
13097	13010	Tramite	\N	\N	0	0	1	2
13096	13010	Asesoría	\N	\N	0	0	1	2
13100	13098	Separación de Cuerpos	\N	\N	0	0	0	2
13082	291	Form_contrario	Form_contrario	../vista/vista_contrarios.php	0	0	0	2
13006	291	Form_expediente	Form_expediente	../vista/vista_IngresotblexpedienteLitigio.php	0	0	1	2
13085	13008	Compra Venta	\N	\N	0	0	0	2
13087	13008	Comodatos	\N	\N	0	0	0	2
13090	13008	Constitución de Fundaciones	\N	\N	0	0	0	2
13091	13008	Agresiones a la Mujer	\N	\N	0	0	0	2
13036	13010	Tramite			0	0	0	2
13093	13010	Denuncia	\N	\N	0	0	0	2
13094	13010	Queja	\N	\N	0	0	0	2
13095	13010	Reclamo	\N	\N	0	0	0	2
13099	13098	185-A	\N	\N	0	0	0	2
13102	13101	Abierto	\N	\N	0	0	0	2
13103	13101	Cerrado	\N	\N	0	0	0	2
13034	13008	Titulo Supletorio	\N	\N	0	0	0	2
13078	13075	INVITY	\N	\N	0	0	1	2
13079	13075	INTTT	\N	\N	0	0	1	2
13105	13104	Ir a Juzgado	\N	\N	0	0	0	2
13108	13024	Ir a Tribunales	\N	\N	0	0	0	2
13027	13024	Firmar Documento	\N	\N	0	0	0	2
13111	13110	Generar	\N	\N	0	0	0	2
13113	13110	No Generar	\N	\N	0	0	0	2
12875	12898	PROCURADURÍA	PROCURADURIA DEL ESTADO YARACUY		0	0	0	1
12892	12875	Gestión y Coordinación de Ciencia y Cultura de la Alimentación	GCCCA	\N	0	0	1	1
12910	12875	Gestión y Coordinación del Postgrado	GCP	\N	0	0	1	1
142	104	Enviar a Salida	Acción que permite enviar a revisión una correspondencia		0	0	0	1
103	2	Bandeja de Salida	Documentos (Bandeja de Revisión)		0	0	0	1
13120	13118	Ver	Ver	\N	0	0	0	2
13118	291	Form_casos	Casos	../vista/vista_casos_abogados.php	0	0	0	2
13123	291	Form_asociasiones	Asociasiones	../vista/vista_listaAsociaciones.php	0	0	0	2
13125	13123	Ver	Ver	\N	0	0	0	2
13098	0	Combo Tipos de Divorcios			0	0	0	2
13101	0	Combo Tipo de Regimen	\N	\N	0	0	0	2
13110	0	Combo Tipo Citacion	\N	\N	0	0	0	2
13010	0	Combo Tipo Atencion	\N	\N	0	0	0	2
12912	0	OAS	Configuracion de Procurando	\N	0	0	0	1
13130	13129	Ver	Ver	\N	0	0	1	2
13129	291	Form_combo	Combos	../vista/vista_MaestroCombos.php	0	0	1	2
13026	13024	Sellar Documento			0	0	0	2
12966	0	Combo Tipos de Bancos	Bancos	\N	0	0	0	2
13131	0	Combo Tipo Fase	\N	\N	0	0	0	2
13140	13139	Ver	Ver	\N	0	0	0	2
13141	0	Combo Tipo Municipio	\N	\N	0	0	0	2
13143	13141	San Felipe	\N	\N	0	0	0	2
13144	13141	Independencia	\N	\N	0	0	0	2
13145	13141	Manuel Monge	\N	\N	0	0	0	2
13146	13141	Cocorote	\N	\N	0	0	0	2
13147	13141	Aristides Bastidas	\N	\N	0	0	0	2
13149	13141	Bolivar	\N	\N	0	0	0	2
13150	13141	Bruzual	\N	\N	0	0	0	2
13152	13141	Nirgua	\N	\N	0	0	0	2
13153	13141	Peña	\N	\N	0	0	0	2
13154	13141	Trinidad	\N	\N	0	0	0	2
13155	13141	Jose Antonio Paez	\N	\N	0	0	0	2
13157	13141	Urachiche	\N	\N	0	0	0	2
13158	13141	Sucre	\N	\N	0	0	0	2
13086	13008	Arrendamiento/Desalojo			0	0	0	2
13160	13143	San Felipe	\N	\N	0	0	0	2
13139	291	Form_Actuaciones	Actuaciones	../vista/vista_listaActuaciones.php	0	0	0	2
13041	13008	Constitución de Asociación Civil o Cooperativa			0	0	0	2
13162	0	Combo Tipo Actuaciones Juridicas	\N	\N	0	0	0	2
12952	12912	Solicitantes	Personas	Form_clientes	12953	1	0	2
13115	12912	Estadisticas OAS	Casos	Form_casos	13118	7	0	2
13138	12912	Actuaciones	Actuaciones	Form_actuaciones	13139	6	0	2
13170	0	Combo Tipo Espacios	\N	\N	0	0	0	2
13171	13170	Espacio 1	\N	\N	0	0	0	2
13172	13170	Espacio 2	\N	\N	0	0	0	2
13173	0	Combo Tipo Estado Fisico Exp	\N	\N	0	0	0	2
13174	13173	En Archivador	\N	\N	0	0	0	2
13175	13173	Prestado	\N	\N	0	0	0	2
13176	0	Combo Tipo Archivador	\N	\N	0	0	0	2
13177	13176	Archivador 1	\N	\N	0	0	0	2
13137	13133	Media 2	\N	\N	0	0	1	2
13024	13023	Tribunales	\N	\N	0	0	1	2
13029	13025	No se Asistio porque no hubo Despacho	\N	\N	0	0	0	2
13104	13023	Juzgados	\N	\N	0	0	1	2
13025	13023	Inasistencia	\N	\N	0	0	0	2
13132	13131	En Proceso	\N	\N	0	0	0	2
13133	13131	Incio	\N	\N	0	0	0	2
13178	13176	Archivador 2	\N	\N	0	0	0	2
13179	0	Combo Tipo Piso Archivador	\N	\N	0	0	0	2
13180	13179	Piso 1	\N	\N	0	0	0	2
13182	13179	Piso 3	\N	\N	0	0	0	2
13183	0	Combo Tipo Gaveta Archivador	\N	\N	0	0	0	2
13184	13183	Gaveta 1	\N	\N	0	0	0	2
13185	13183	Gaveta 2	\N	\N	0	0	0	2
164	163	Procurador	Procurador	GTE	0	0	0	1
165	163	Jefe de Unidad	Jefe de Unidad	CDR	0	0	0	1
13206	13204	Media	\N	\N	0	0	0	1
13186	163	Analista	Analista	ANA	0	0	0	1
13187	163	Encargado	Encargado	ENCARG	0	0	0	1
13188	163	Analista	Analista	\N	0	0	1	1
13189	0	Combo Tipo Estado Minuta	\N	\N	0	0	0	2
13190	13189	Activa Situación	\N	\N	0	0	0	2
13191	13189	Atendida Situación	\N	\N	0	0	0	2
13193	13189	Suspendida Situación	\N	\N	0	0	0	2
13228	0	Reportes	\N	\N	0	0	0	3
13197	13196	Ver	\N	\N	0	0	0	3
13198	0	Combo Tipo Agenda	\N	\N	0	0	0	1
13201	0	Combo Tipo Evento Agenda 	\N	\N	0	0	0	1
13226	0	Agenda	Agenda y Documentos	\N	0	0	0	3
13204	0	Combo Tipo Prioridad	\N	\N	0	0	0	1
13207	0	Combo Tipo Recordatorio	\N	\N	0	0	0	1
13210	0	Combo Tipo Estado Agenda	\N	\N	0	0	0	1
13205	13204	Alta	\N	\N	0	0	0	1
13213	13204	Baja	\N	\N	0	0	0	1
13199	13198	Personal	\N	\N	0	0	0	1
13200	13198	Laboral	\N	\N	0	0	0	1
13209	13207	Recordar 2 Semanas Antes	\N	\N	14	0	0	1
13208	13207	Recordar Días Antes	\N	\N	7	0	0	1
13221	13198	Expediente	\N	\N	0	0	0	1
13218	13207	Recordar 1 Mes Antes	\N	\N	30	0	0	1
13229	0	Litigio	\N	\N	0	0	0	4
13222	0	Combo Tipo Refiere Agenda	\N	\N	0	0	0	1
13224	13222	No Refiere	\N	\N	0	0	0	1
13196	291	Form_agenda	Agenda	../vista/vista_tblagenda.php	0	0	0	3
13232	13231	Ver	Ver	\N	0	0	0	4
13234	291	Form_contrario	Form_contrario	../vista/vista_contrarios.php	0	0	0	4
13231	291	Form_contrario	Form_contrario	../vista/vista_abogados_contrarios.php	0	0	0	4
13235	13234	Ver	Ver	\N	0	0	0	4
13238	13237	Ver	\N	\N	0	0	0	4
13225	13222	Refiere Departamento	\N	\N	0	0	0	1
12913	0	Combo Tipos  Estados del Pais			0	0	0	2
13194	13266	Agenda	Agenda	Form_agenda	13196	0	0	3
13257	13267	Buzon de Documentos	Buzon de Documentos	Form_abogados_documentos	13258	0	0	6
13240	291	Form_juzgado	For-juzgadom	../vista/vista_tblprojuzgados.php	0	0	0	4
13241	13240	Ver	\N	\N	0	0	0	4
13266	13265	Ver	\N	\N	0	0	0	3
13243	291	Form_abogados	Form_abogados	../vista/vista_abogados.php	0	0	0	4
13244	13243	Ver	\N	\N	0	0	0	4
13248	13247	Ver	Ver	\N	0	0	0	4
12881	12875	Centro de Investigaciones Gastronomica	CIG	\N	0	0	1	1
12833	289	Bandeja de Salida	Bandeja de Revisión 	Form_bandeja_revision	12834	0	0	1
13289	291	Form_reporte	Reporte	../vista/vista_reporte_documento.php	0	0	0	6
12858	291	Form_usuarios_sistema	Form_usuarios_sistema	../vista/contactoVista.php	0	10	0	5
13265	291	Form_agenda_enviados	Agenda	../vista/vista_tblagenda_creados.php	0	0	0	3
12014	12875	Servicios Generales	TUR	\N	0	0	0	1
13211	13210	Salida	\N	\N	0	0	0	1
13212	13210	Entrada	\N	\N	0	0	0	1
13220	13210	Atendido	\N	\N	0	0	1	1
13202	13201	Acto Protocolar	\N	\N	0	0	0	1
13203	13201	Reunión de Mesas de Trabajo	\N	\N	0	0	0	1
13214	13201	Reunión con entes Públicos	\N	\N	0	0	0	1
13216	13201	Seguimiento de Actuaciones	\N	\N	0	0	0	1
13217	13201	Consejos de Coordinación Juridica	\N	\N	0	0	0	1
13279	291	Form_agenda_anexados	Agenda	../vista/vista_tblagenda_anexadas.php	0	0	0	3
13284	13228	Reportes	Reportes	Form_reporte	13285	0	0	3
13256	0	Reportes	Reportes Agenda	\N	0	0	0	3
13165	13162	Divorcios no Contenciosos 185-A	\N	\N	0	0	0	2
13166	13165	Formato	\N	\N	0	0	0	2
13288	13287	Reportes	Reportes	Form_reporte	13289	0	0	6
13273	13272	ver	\N	\N	0	0	0	6
13260	13222	Refiere Persona	\N	\N	0	0	0	1
13277	13276	ver	\N	\N	0	0	0	6
13263	13262	Ver	\N	\N	0	0	0	3
13262	291	Form_agenda_borrados	Agenda	../vista/vista_tblagenda_borrados.php	0	0	0	3
13268	13267	Documentos Enviados	Enviados	Form_documentos_enviados	13269	0	0	6
13271	13267	Documentos Recibidos	Recibidos	Form_documentos_recibidos	13272	0	0	6
13283	13282	Ver	\N	\N	0	0	0	3
13282	291	Form_agenda	Agenda	../vista/vista_tblagenda.php	0	0	0	3
13275	13267	Documentos Borrados	Borrados	Form_documentos_borrados	13276	0	0	6
13402	13016	CONSULTOR JURIDICO	\N	\N	0	0	0	2
13230	13229	Abogados Demandantes	Abogados Demandantes	Form_abogados_contrarios	13231	2	0	4
13236	13229	Honorarios	Honorarios	Form_honorarios	13237	8	1	4
13242	13229	Abogados Procuraduría	Abogados	Form_abogados	13243	5	0	4
13245	13229	Indice de Casos	Casos	Form_casos	13247	6	0	4
13239	13229	Juzgados	Juzgados	Form_juzgado	13240	7	1	4
13254	13253	Ver	Ver	\N	0	0	0	4
13249	13229	Asociasiones	Asociasiones	Form_asociasiones	13250	3	1	4
13252	13229	Abogados Institutos	Representantes	Form_representantes	13253	0	0	4
13250	291	Form_asociasiones	Asociasiones	../vista/vista_listaAsociaciones.php	0	0	1	4
13251	13250	Ver	Ver	\N	0	0	1	4
13247	291	Form_casos	Casos	../vista/vista_casos_abogados_litigio.php	0	0	0	4
13276	291	Form_documentos_borrados	Borrados	../vista/vista_tblDocumento_Borrados.php	0	0	0	6
13272	291	Form_documentos_recibidos	Recibidos	../vista/vista_tblDocumento_Recibidos.php	0	0	0	6
13269	291	Form_documentos_enviados	Enviados	../vista/vista_tblDocumento_Enviados.php	0	0	0	6
13267	0	Documentos	Documentos	\N	0	0	0	6
13259	13258	ver	\N	\N	0	0	0	6
13258	291	Form_documento	Documentos	../vista/vista_tblDocumento.php	0	0	0	6
13281	13226	Buzón Agenda	Buzón Agenda	Form_agenda	13282	0	0	3
13278	13226	Item Agenda Anexadas	Anexados	Form_agenda_anexados	13279	0	0	3
13270	13269	ver	\N	\N	0	0	0	6
13261	13226	Item Agenda Borradas	Agenda Borradas	Form_agenda_borrados	13262	0	0	3
13264	13226	Item Agenda Creadas	Agenda Creadas	Form_agenda_enviados	13265	0	0	3
13280	13279	Ver	\N	\N	0	0	0	3
13286	13285	Ver	\N	\N	0	0	0	3
13287	0	Reporte	Reporte Documento	\N	0	0	0	6
13291	0	Reporte	Reporte Documento	\N	0	0	0	2
13290	13289	Ver	\N	\N	0	0	0	6
13292	13291	Reportes	Reporte	Form_reporte	13293	0	0	2
13294	13293	Ver	\N	\N	0	0	0	2
12010	12875	Dirección General	DG	\N	0	0	1	1
12878	12875	Audiovisuales	AUD	\N	0	0	1	1
12879	12875	Auditoria Interna	AI	\N	0	0	1	1
12880	12875	Centro de Estudio de la Ecologia	CEE	\N	0	0	1	1
12885	12875	Coordinación de Extensión Universitaria	CEU	\N	0	0	1	1
13295	12964	Editar	Editar		0	0	0	2
13296	12964	Eliminar	Eliminar		0	0	0	2
13297	12964	Guardar	Guardar		0	0	0	2
13298	12964	Nuevo	Nuevo		0	0	0	2
13299	12980	Nuevo	Nuevo		0	0	0	2
13300	13082	Editar	Editar		0	0	0	2
13301	13082	Eliminar	Eliminar		0	0	0	2
13302	13082	Guardar	Guardar		0	0	0	2
13303	12986	Nuevo	Nuevo		0	0	0	2
13304	12953	Editar	Editar		0	0	0	2
13305	12953	Guardar	Guardar		0	0	0	2
13306	12953	Eliminar	Eliminar		0	0	0	2
13307	13082	Nuevo	Nuevo		0	0	0	2
13308	13123	Editar	Editar		0	0	0	2
13309	13123	Eliminar	Eliminar		0	0	0	2
13310	13123	Guardar	Guardar		0	0	0	2
13311	12953	Nuevo	Nuevo		0	0	0	2
13312	13123	Nuevo	Nuevo		0	0	0	2
13313	13139	Eliminar	Eliminar		0	0	0	2
13314	13139	Guardar	Guardar		0	0	0	2
13315	13139	Nuevo	Nuevo		0	0	0	2
13316	13139	Editar	Editar		0	0	0	2
13317	13003	Eliminar	Eliminar		0	0	0	2
13318	13003	Nuevo	Nuevo		0	0	0	2
13319	13003	Agenda	Agenda		0	0	0	2
13320	13231	Guardar	Guardar		0	0	0	4
13321	13231	Editar	Editar		0	0	0	4
13322	13003	Cerrar	Cerrar		0	0	0	2
13323	13003	Guardar	Guardar		0	0	0	2
13324	13003	Editar	Editar		0	0	0	2
13325	13231	Eliminar	Eliminar		0	0	0	4
13326	13237	Guardar	Guardar		0	0	0	4
13327	13237	Editar	Editar		0	0	0	4
13328	13237	Eliminar	Eliminar		0	0	0	4
13329	13237	Nuevo	Nuevo		0	0	0	4
13330	13231	Nuevo	Nuevo		0	0	0	4
13331	13240	Guardar	Guardar		0	0	0	4
13332	13240	Eliminar	Eliminar		0	0	0	4
13333	13240	Nuevo	Nuevo		0	0	0	4
13334	13250	Guardar	Guardar		0	0	0	4
13335	13250	Editar	Editar		0	0	0	4
13336	13250	Eliminar	Eliminar		0	0	0	4
13337	13240	Editar	Editar		0	0	0	4
13338	13250	Nuevo	Nuevo		0	0	0	4
13339	13234	Guardar	Guardar		0	0	0	4
13340	13234	Editar	Editar		0	0	0	4
13341	13234	Eliminar	Eliminar		0	0	0	4
13342	13234	Nuevo	Nuevo		0	0	0	4
13343	13243	Guardar	Guardar		0	0	0	4
13344	13243	Editar	Editar		0	0	0	4
13345	13243	Eliminar	Eliminar		0	0	0	4
13346	13243	Nuevo	Nuevo		0	0	0	4
13285	291	Form_reporte	Reporte	../vista/vista_reporte_agenda.php	0	0	0	3
289	0	Correo	Configuracion de Sistema de Correspondencia	\N	0	0	0	1
13382	13016	ASISTENTES  GOBERNADOR.	\N	\N	0	0	0	2
13383	13016	SECRETARIO GENERAL DE GOBIERNO	\N	\N	0	0	0	2
13384	13016	SECRETARÍO DE SEGURIDAD CIUDADANA 	\N	\N	0	0	0	2
13385	13016	SECRETARIO DEL DESPACHO	\N	\N	0	0	0	2
13387	13016	PRODUCCIÓN PROGRAMA RINDIENDO CUENTAS.	\N	\N	0	0	0	2
13388	13016	JEFE DE PROTOCOLO Y  RELACIONES PÚBLICAS 	\N	\N	0	0	0	2
13389	13016	SERVICIO INTEGRAL DE EMERGENCIA 171	\N	\N	0	0	0	2
13396	13016	JEFE DE LA ZONA EDUCATIVA	\N	\N	0	0	0	2
13400	13016	TESORERO GENERAL DEL ESTADO.	\N	\N	0	0	0	2
13390	13015	SECRETARIA DE FINANZAS Y ADMINISTRACION.	\N	\N	0	0	0	2
13393	13015	SECRETARIA DE INFRAESTRUCTURA	\N	\N	0	0	0	2
13398	13015	SECRETARIA DE EDUCACION	\N	\N	0	0	0	2
13399	13015	SECRETARIA DE DESARROLLO ECONÓMICO	\N	\N	0	0	0	2
13391	13015	DIRECTOR DE FINANZAS.	\N	\N	0	0	0	2
13392	13015	DIRECTOR DE ADMINISTRACIÓN	\N	\N	0	0	0	2
13395	13015	DIRECCIÓN DE ATENCIÓN AL CIUDADANO.	\N	\N	0	0	0	2
13397	13015	DIRECTOR DE EDUCACION.	\N	\N	0	0	0	2
13401	13015	JEFE DE COMPRAS	\N	\N	0	0	0	2
13404	13016	SUPERVISOR DE MANTENIMIENTO DE LAS INSTALACIONES DEL PALACIO DE GOBIERNO	\N	\N	0	0	0	2
13409	13016	UNIDAD DE AUDÍTORIA DE LA GOBERNACIÓN DEL ESTADO YARACUY 	\N	\N	0	0	0	2
13413	13016	DIRECCIÓN DE  CULTURA DEL I.C.E.Y.	\N	\N	0	0	0	2
13421	13016	SERVICIO AUTÓNOMO DE ADMINISTRACIÓN DE LA INFRAESTRUCTURA DEPORTIVA, CULTURAL Y TURÍSTICA DEL EDO. YARACUY. (S.A.I.E.Y)	\N	\N	0	0	0	2
13424	13016	INSTITUTO DE HABITAT Y VIVIENDA DEL ESTADO YARACUY	\N	\N	0	0	0	2
13427	13016	DIRECTOR DEL INSTITUTO AUTÓNOMO DE AYUDA A LOS FUNCIONARIOS DE SEGURIDAD CIUDADANA DEL GOBIERNO BOLIVARIANO DE YARACUY (I.A.A)	\N	\N	0	0	0	2
13428	13016	INAJUDEY. INSTITUTO NACIONAL DE LA JUVENTUD.DEL ESTADO YARACUY	\N	\N	0	0	0	2
13429	13016	JEFE DE LOS SERVICIOS MÉDICOS	\N	\N	0	0	0	2
13430	13016	CAJA DE AHORROS DE LA GOBERNACIÓN DEL ESTADO	\N	\N	0	0	0	2
13431	13016	CORPOTURISMO YARACUY.	\N	\N	0	0	0	2
13432	13016	SOCIEDAD  DE GARANTIAS  RECIPROCAS.	\N	\N	0	0	0	2
13436	13016	BOMBEROS	\N	\N	0	0	0	2
13454	13074	CONTRALOR GENERAL DEL ESTADO	\N	\N	0	0	0	2
13455	13075	DIRECTOR DE REGISTRO	\N	\N	0	0	0	2
13456	13076	PALACIO LEGISLATIVO, DIAGONAL A LA PLAZA BOLÍVAR (CLEY)	\N	\N	0	0	0	2
13458	13077	DEFENSOR DEL PUEBLO ESTADO YARACUY	\N	\N	0	0	0	2
13459	13437	COMANDANTE DE LA GUARNICIÓN MILITAR DE SAN FELIPE Y DIRECTOR DE LA ESCUELA DE LA AVIACIÓN DEL EJÉRCITO	\N	\N	0	0	0	2
13557	13443	MISION BARRIO ADENTRO MEDICO	\N	\N	0	0	0	2
13558	13443	MISIÒN BARRIO ADENTRO DEPORTIVO	\N	\N	0	0	0	2
13460	13437	JEFE DE ESTADO MAYOR DE LAOPERATIVA DE DEFENSA INTEGRAL YARACUYY DIRECTOR DE LA ESCUELA DE AVIACION DEL EJERCITO GENERAL DE BRIGADA JUAN GOMEZ	\N	\N	0	0	0	2
13461	13437	COMANDANTE DEL 411 BATALLON DE INFANTRIA MECANIZADO ANZOATEGUI	\N	\N	0	0	0	2
13463	13437	COMANDANTE DEL GRUPO AÉREO DE APOYO Y ASALTO BATALLÓN DE HELICÓPTEROS 	\N	\N	0	0	0	2
13564	13443	MISIÒN CULTURA	\N	\N	0	0	0	2
13464	13437	JEFE  DE LA CIRCUNSCRIPCIÓN  MILITAR  DE SAN FELIPE.	\N	\N	0	0	0	2
13465	13437	COMANDANTE DEL BATALLON DE MILICIA  BATALLA DE CARABOBO DEL ESTADO YARACUY	\N	\N	0	0	0	2
13466	13437	COMANDANTE DEL DESTACAMENTO Nº 45 DE LA GUARDIA NACIONAL	\N	\N	0	0	0	2
13467	13437	SEGUNDO COMANDANTE DEL DESTACAMENTO Nº 45	\N	\N	0	0	0	2
13468	13437	INSTITUTO AUTÓNOMO  DE BOMBEROS DEL EDO. YARACUY (I.A.B.O.Y.)	\N	\N	0	0	0	2
13469	13437	INSTITUTO DE POLICIA ESTADAL YARACUY	\N	\N	0	0	0	2
13470	13437	JEFE DE OPERACIONES DE LA POLICIA DEL ESTADO YARACUY	\N	\N	0	0	0	2
13471	13437	TRÁNSITO TERRESTRE DEL ESTADO YARACUY	\N	\N	0	0	0	2
13473	13437	DELEGACIÓN DEL   CUERPO DE INVESTIGACIONES CIENTÍFICAS PENALES Y CRIMINALISTICAS DEL ESTADO YARACUY (CICPC)	\N	\N	0	0	0	2
13474	13437	SEBIN	\N	\N	0	0	0	2
13475	13437	COMANDO  REGIONAL UNIFICADO CONTRA LA EXTOSIÓN Y SECUESTRO	\N	\N	0	0	0	2
13476	13437	GRUPO DE ANTIEXTORCION Y SECUESTRO (GAES)	\N	\N	0	0	0	2
13477	13437	INCE MILITAR	\N	\N	0	0	0	2
13478	13437	PREVENCIÓN DEL DELITO	\N	\N	0	0	0	2
13414	14059	INSTITUTO AUTÓNOMO DE DEFENSA CIVIL Y DE APOYO EN CASOS DE EMERGENCIAS Y DESASTRES NATURALES DEL ESTADO YARACUY (IADC)	\N	\N	0	0	0	2
13417	14059	INSTITUTO AUTÓNOMO  PARA EL DEPORTE DEL EDO. YARACUY(FUNDEY)	\N	\N	0	0	0	2
13408	13015	SECRETARIA  PLANIFICACIÓN  Y DESARROLLO	\N	\N	0	0	0	2
13412	14059	INSTITUTO  DE CULTURA DEL ESTADO YARACUY (I.C.E.Y.)	\N	\N	0	0	0	2
13418	14059	INSTITUTO AUTONOMO DE LA SALUD DEL ESTADO YARACUY (PROSALUD)	\N	\N	0	0	0	2
13419	14059	FUNDACION PUEBLO SANO	\N	\N	0	0	0	2
13420	14059	INSTITUTO AUTÓNOMO  DE DESARROLLO ECONÓMICO DEL ESTADO YARACUY (I.A.D.E.Y)	\N	\N	0	0	0	2
13422	14059	INSTITUTO AUTÓNOMO  CONTRA LA POBREZA Y EXCLUSION SOCIAL  DEL ESTADO YARACUY.   (I.A.P.E.S.E.Y.)	\N	\N	0	0	0	2
13423	14059	INSTITUTO AUTÓNOMO DE INFRAESTRUCTURA	\N	\N	0	0	0	2
13426	14059	AGUAS DEL YARACUY	\N	\N	0	0	0	2
13433	14059	EMPRESA SOCIALISTA DE MINERALES NO METALICOS.	\N	\N	0	0	0	2
13434	14059	EMPRESA SOCIALISTA TRANSPORTE YARACUY.	\N	\N	0	0	0	2
13435	14059	FUNDACIÓN YARACUY BONITO.	\N	\N	0	0	0	2
13425	14059	INSTITUTO AUTÓNOMO DE VIALIDAD Y TRANSPORTE DEL ESTADO YARACUY (I.N.V.I.T.Y).	\N	\N	0	0	0	2
13405	13015	JEFE DE BIENES	\N	\N	0	0	0	2
13406	13015	OFICINA DE PRESUPUESTO	\N	\N	0	0	0	2
13407	13015	DIRECTORA (E)  DE LA OFICINA DE RECURSOS HUMANOS	\N	\N	0	0	0	2
13410	13015	OFICINA DE SEGUIMIENTO Y CONTROL.	\N	\N	0	0	0	2
13411	13015	DIRECCIÓN  DE ASUNTOS EDUCACIONALES Y CULTURALES	\N	\N	0	0	0	2
13415	14059	IMPRENTA DEL ESTADO YARACUY	\N	\N	0	0	0	2
13416	14059	FUNDACIÓN REGIONAL EL NIÑO SIMON	\N	\N	0	0	0	2
13479	13437	CUARTA COMPAÑÍA DEL DESTACAMENTO NRO. 49 	\N	\N	0	0	0	2
13480	13438	ALCALDE DEL MUNICIPIO ARÍSTIDES BASTIDAS (SAN PABLO)	\N	\N	0	0	0	2
13481	13438	ALCALDE DEL MUNICIPIO BOLÍVAR (AROA)	\N	\N	0	0	0	2
13482	13438	ALCALDE DEL MUNICIPIO BRUZUAL (CHIVACOA)	\N	\N	0	0	0	2
13483	13438	ALCALDE DEL MUNICIPIO INDEPENDENCIA (INDEPENDENCIA)	\N	\N	0	0	0	2
13484	13438	ALCALDE DEL MUNICIPIO José  ANTONIO PÁEZ (SABANA DE PARRA)	\N	\N	0	0	0	2
13485	13438	ALCALDE DEL MUNICIPIO LA TRINIDAD (BORAURE)	\N	\N	0	0	0	2
13486	13438	ALCALDE DEL MUNICIPIO COCOROTE (COCOROTE)	\N	\N	0	0	0	2
13488	13438	ALCALDE DEL MUNICIPIO MANUEL MONGE (YUMARE)	\N	\N	0	0	0	2
13489	13438	ALCALDE DEL MUNICIPIO NIRGUA (NIRGUA)	\N	\N	0	0	0	2
13490	13438	ALCALDE  DEL MUNICIPIO PEÑA (YARITAGUA)	\N	\N	0	0	0	2
13491	13438	ALCALDE DEL MUNICIPIO SAN FELIPE (SAN FELIPE)	\N	\N	0	0	0	2
13492	13438	ALCALDE DEL MUNICIPIO SUCRE (GUAMA)	\N	\N	0	0	0	2
13493	13438	ALCALDE DEL MUNICIPIO URACHICHE (URACHICHE)	\N	\N	0	0	0	2
13494	13438	ALCALDE  DEL MUNICIPIO VEROES (VEROES)	\N	\N	0	0	0	2
13495	13439	MINISTERIO DE PRODUCCIÓN Y COMERCIO	\N	\N	0	0	0	2
13496	13439	MINISTERIO DE TRANSPORTE Y COMUNICACIONES	\N	\N	0	0	0	2
13497	13439	MINISTERIO DE HACIENDA (SENIAT).	\N	\N	0	0	0	2
13500	13439	MINISTERIO DE RELACIONES INTERIORES OFICINA DE IDENTIFICACION Y EXTRANJERIA.	\N	\N	0	0	0	2
13501	13439	HOSPITAL CENTRAL DE SAN FELIPE	\N	\N	0	0	0	2
13503	13439	UNIDAD SANITARIA	\N	\N	0	0	0	2
13505	13439	MINISTERIO DE SALUD Y DESARROLLO SOCIAL. COORDINADOR REGIONAL DEL FONDO ÚNICO SOCIAL	\N	\N	0	0	0	2
13506	13439	MINISTERIO DEL TRABAJO.	\N	\N	0	0	0	2
13507	13439	MINISTERIO DEL AMBIENTE Y  DE LOS RECURSOS NATURALES RENOVABLES (MARNR)	\N	\N	0	0	0	2
13508	13439	FONDOTURISMO YARACUY.	\N	\N	0	0	0	2
13509	13439	OFICINA NACIONAL ANTIDROGAS (O.N.A)	\N	\N	0	0	0	2
13510	13440	INDEPABIS	\N	\N	0	0	0	2
13511	13440	INSPECTORIA REGIONAL DE TRÁNSITO TERRESTRE	\N	\N	0	0	0	2
13512	13440	COMPAÑÍA ANÓNIMA TELÉFONOS DE VENEZUELA (CANTV)	\N	\N	0	0	0	2
13513	13440	FUNDACOMUNAL	\N	\N	0	0	0	2
13514	13440	FONSTRAPEY	\N	\N	0	0	0	2
13515	13440	INSTITUTO NACIONAL DE CAPACITACIÓN EDUCATIVA SOCIALISTA\n(I.N.C.E.S)	\N	\N	0	0	0	2
13516	13440	INSTITUTO NACIONAL DE GERIATRIA Y GERONTOLOGÍA  (INASS)	\N	\N	0	0	0	2
13517	13440	MINISTERIO DE LA VIVIENDA Y HABITAT DEL ESTADO YARACUY.	\N	\N	0	0	0	2
13518	13440	MINISTERIO DEL PODER POPULAR PARA LA AGRICULTURA Y TIERRAS.	\N	\N	0	0	0	2
13519	13440	MINISTERIO DEL PODER POPULAR PARA LAS COMUNAS Y PROTECCIÓN SOCIAL.	\N	\N	0	0	0	2
13520	13440	INSTITUTO  NACIONAL DEL MENOR (INAM)	\N	\N	0	0	0	2
13521	13440	FUNDACITI	\N	\N	0	0	0	2
13522	13440	INSTITUTO NACIONAL DE NUTRICIÓn (I.N.N)	\N	\N	0	0	0	2
13523	13440	INSTITUTO POSTAL TELEGRÁFICO (IPOSTEL)	\N	\N	0	0	0	2
13524	13440	I.P.A.S.M.E	\N	\N	0	0	0	2
13525	13440	Dirección de saneamiento ambiental y contraloría sanitaria	\N	\N	0	0	0	2
13527	13440	INSTITUTO NACIONAL DE ESTADÍSTICA (I.N.E)	\N	\N	0	0	0	2
13526	13440	SEGURO SOCIAL DEL ESTADO YARACUY	\N	\N	0	0	0	2
13529	13440	INIA	\N	\N	0	0	0	2
13531	13440	FONDOENDOGENO	\N	\N	0	0	0	2
13533	13440	SUNACOOP	\N	\N	0	0	0	2
13534	13440	FONDEMI	\N	\N	0	0	0	2
13535	13440	CONAPDB	\N	\N	0	0	0	2
13538	13440	IDENA	\N	\N	0	0	0	2
13539	13440	CVA- ECISA	\N	\N	0	0	0	2
13540	13440	FONDAS	\N	\N	0	0	0	2
13542	13440	FEDE	\N	\N	0	0	0	2
13543	13440	INTERNADO JUDICIAL	\N	\N	0	0	0	2
13544	13440	INSAI	\N	\N	0	0	0	2
13545	13440	CIARA	\N	\N	0	0	0	2
13548	13440	COMPAÑÍA DE MECANIZADO AGRICOLA Y TRANSPORTE PEDRO CAMEJO S.A 	\N	\N	0	0	0	2
13549	13443	MISIÓN RIVAS	\N	\N	0	0	0	2
13550	13443	MISIÒN ROBINSÒN	\N	\N	0	0	0	2
13551	13443	MISIÒN SUCRE	\N	\N	0	0	0	2
13552	13443	MERCAL	\N	\N	0	0	0	2
13553	13443	PDVAL	\N	\N	0	0	0	2
13554	13443	FUNDAPROAL	\N	\N	0	0	0	2
13555	13443	MISIÒN AGRICULTURA	\N	\N	0	0	0	2
13556	13443	MISIÒN  ÀRBOL	\N	\N	0	0	0	2
13559	13443	MISIÒN MILAGRO	\N	\N	0	0	0	2
13560	13443	MISIÒN JOSÈ  GREGORIO HERNÀNDEZ	\N	\N	0	0	0	2
13561	13443	MISIÒN MADRES DEL BARRIO	\N	\N	0	0	0	2
13562	13443	MISIÒN NEGRA HIPOLITA	\N	\N	0	0	0	2
13563	13443	MISIÒN 13 DE ABRIL	\N	\N	0	0	0	2
13565	13443	MISIÒN MUSICA	\N	\N	0	0	0	2
13567	13443	MISIÒN CHÈ GUEVARA	\N	\N	0	0	0	2
13568	13443	MISIÒN GUAICAIPURO	\N	\N	0	0	0	2
13570	13443	MISIÒN CIENCIA	\N	\N	0	0	0	2
13571	13443	MISIÒN MIRANDA	\N	\N	0	0	0	2
13572	13443	MISIÒN SAIME	\N	\N	0	0	0	2
13573	13443	MISIÒN NIÑOS Y NIÑAS DEL BARRIO	\N	\N	0	0	0	2
13574	13443	COORDINADOR DE MISIONES POR LA PARTE MILITAR	\N	\N	0	0	0	2
13576	13443	MISION BARRIO ADENTRO. COORDINACIÓN DE SALUD	\N	\N	0	0	0	2
13577	13446	JUEZA RECTORA DE CIRCUNSCRIPCIÓN JUDICIAL Y PRESIDENTA DEL CIRCUITO JUDICIAL PENAL	\N	\N	0	0	0	2
13578	13446	Juzgado superior civil, mercantíl, del tránsito y trabajo	\N	\N	0	0	0	2
13581	13446	JUZGADO PRIMERO DE PRIMERA INSTANCIA EN LO CIVIL, MERCANTIL Y TRANSITO	\N	\N	0	0	0	2
13582	13446	JUZGADO SEGUNDO DE PRIMERA INSTANCIA EN LO CIVIL, MERCANTIL Y TRANSITO	\N	\N	0	0	0	2
13584	13446	JUZGADO TERCERO DE PRIMERA INSTANCIA EN LO CIVIL, MERCANTIL Y TRANSITO	\N	\N	0	0	0	2
13586	13446	TRIBUNAL DE PROTECCIÓN DEL NIÑO Y DEL ADOLECENTE	\N	\N	0	0	0	2
13587	13446	JUZGADO PRIMERO DE SUSTANCIACIÓN, MEDIACIÓN Y EJECUCIÓN DEL RÉGIMEN PROCESAL TRANSITORIO DEL CIRCUITO JUDICIAL DEL TRABAJO	\N	\N	0	0	0	2
13588	13446	JUZGADO SEGUNDO DE SUSTANCIACIÓN, MEDIACIÓN Y EJECUCIÓN DEL RÉGIMEN PROCESAL TRANSITORIO DEL CIRCUITO JUDICIAL DEL TRABAJO	\N	\N	0	0	0	2
13590	13446	JUZGADO PRIMERO DE LOS MUNICIPIOS SAN FELIPE, INDEPENDENCIA, COCOROTE Y VEROES	\N	\N	0	0	0	2
13591	13446	JUZGADO SEGUNDO DE LOS MUNICIPIOS SAN FELIPE, INDEPENDENCIA, COCOROTE Y VEROES	\N	\N	0	0	0	2
13592	13446	JUZGADO EJECUTOR DE MEDIDA DE LOS MUNICIPIOS SAN FELIPE, INDEPENDENCIA, COCOROTE, VEROES, BOLIVAR Y MANUEL MONGE	\N	\N	0	0	0	2
13593	13446	JUZGADO EJECUTOR DE MEDIDAS DE LOS MUNICIPIOS SUCRE, LA TRINIDAD, ARÍSTIDES BASTIDAS, BRUZUAL URACHICHE, JOSÉ ANTONIO PÁEZ  Y PEÑA	\N	\N	0	0	0	2
13594	13446	JUZGADO DE LOS  MUNICIPIOS SUCRE, LA TRINIDAD Y ARÍSTIDES BASTIDAS	\N	\N	0	0	0	2
13595	13446	JUZGADO DEL  MUNICIPIO BRUZUAL	\N	\N	0	0	0	2
13596	13446	JUZGADO DE LOS  MUNICIPIOS URACHICHE Y JOSÉ ANTONIO PÁEZ	\N	\N	0	0	0	2
13597	13446	JUZGADO DEL  MUNICIPIO PEÑA	\N	\N	0	0	0	2
13598	13446	JUZGADO DEL  MUNICIPIO NIRGUA	\N	\N	0	0	0	2
13600	13446	JUZGADO EJECUTOR DE MEDIDAS DEL MUNICIPIO NIRGUA	\N	\N	0	0	0	2
13601	13448	FISCAL SUPERIOR DEL ESTADO YARACUY	\N	\N	0	0	0	2
13602	13448	FISCAL AUXILIAR FISCALÍA SUPERIOR	\N	\N	0	0	0	2
13603	13448	SUPERVISOR UNIDAD DE ATENCIÓN A LA VICTIMA	\N	\N	0	0	0	2
13604	13448	FISCAL PRIMERO	\N	\N	0	0	0	2
13605	13448	FISCAL AUXILIAR FISCALÍA PRIMERA	\N	\N	0	0	0	2
13606	13448	FISCAL SEGUNDO	\N	\N	0	0	0	2
13607	13448	FISCAL AUXILIAR FISCALÍA SEGUNDA	\N	\N	0	0	0	2
13608	13448	FISCAL TERCERO	\N	\N	0	0	0	2
13609	13448	FISCAL AUXILIAR FISCALÍA TERCERO	\N	\N	0	0	0	2
13610	13448	FISCAL CUARTO	\N	\N	0	0	0	2
13611	13448	FISCAL AUXILIAR FISCAL CUARTO	\N	\N	0	0	0	2
13612	13448	FISCAL QUINTO	\N	\N	0	0	0	2
13613	13448	FISCAL AUXILIAR FISCALÍA QUINTO	\N	\N	0	0	0	2
13614	13448	FISCAL SEXTO	\N	\N	0	0	0	2
13615	13448	FISCAL SÉPTIMO	\N	\N	0	0	0	2
13616	13448	FISCAL AUXILIAR FISCALÍA SÉPTIMA 	\N	\N	0	0	0	2
13617	13448	FISCAL OCTAVO:	\N	\N	0	0	0	2
13618	13448	FISCAL AUXILIAR FISCALÍA OCTAVA:	\N	\N	0	0	0	2
13620	13448	FISCAL NOVENO	\N	\N	0	0	0	2
13622	13448	FISCAL AUXILIAR FISCALÍA NOVENO	\N	\N	0	0	0	2
13623	13448	FISCAL DÉCIMO	\N	\N	0	0	0	2
13624	13448	FISCAL AUXILIAR FISCALÍA DECIMO	\N	\N	0	0	0	2
13625	13448	FISCAL DÉCIMO PRIMERO	\N	\N	0	0	0	2
13626	13448	FISCAL AUXILIAR FISCALÍA DÉCIMO PRIMERO	\N	\N	0	0	0	2
13627	13448	FISCAL DÉCIMO SEGUNDO	\N	\N	0	0	0	2
13628	13448	FISCAL AUXILIAR FISCALÍA DÉCIMO SEGUNDO	\N	\N	0	0	0	2
13629	13448	FISCAL DÉCIMO TERCERO	\N	\N	0	0	0	2
13630	13448	FISCAL AUXILIAR FISCALÍA DÉCIMO TERCERO	\N	\N	0	0	0	2
13631	13448	UNIDAD ADMINISTRADORA DESCONCENTRADA	\N	\N	0	0	0	2
13632	13449	UNIVERSIDAD NACIONAL EXPERIMENTAL DE YARACUY (UNEY)	\N	\N	0	0	0	2
13633	13449	UNIVERSIDAD NACIONAL EXPERIMENTAL DE LA FUERZA ARMADA (UNEFA)	\N	\N	0	0	0	2
13634	13449	INSTITUTO UNIVERSITARIO DE TECNOLOGÍA DEL YARACUY (I.U.T.Y.)	\N	\N	0	0	0	2
13635	13449	UNIVERSIDAD NACIONAL ABIERTA  (U.N.A.)	\N	\N	0	0	0	2
13636	13449	INSTITUTO UNIVERSITARIO ADVENTISTA DE VENEZUELA	\N	\N	0	0	0	2
13637	13449	INSTITUTO UNIVERSITARIO DE TECNOLOGÍA “ANTONIO JOSÉ DE SUCRE”	\N	\N	0	0	0	2
13638	13449	COLEGIO UNIVERSITARIO DE ADMINISTRACIÓN Y MERCADEO (CUAM)	\N	\N	0	0	0	2
13639	13449	UNIVERSIDAD SIMON RODRIGUEZ	\N	\N	0	0	0	2
13640	13449	RED DE BIBLIOTECAS PÚBLICAS DEL ESTADO	\N	\N	0	0	0	2
13641	13449	INSTITUTO UNIVERSITARIO DE MEJORAMIENTO PROFESIONAL DEL MAGISTERIO	\N	\N	0	0	0	2
13642	13449	UNIVERSIDAD BOLIVARIANA (MISION SUCRE)	\N	\N	0	0	0	2
13643	13449	COORDINADORA DE LA MISION RIVAS	\N	\N	0	0	0	2
13644	13449	CENTRO DE  CULTURA POPULAR “DON TEOFILO DOMÍNGUEZ”	\N	\N	0	0	0	2
13645	13449	CENTRO DE HISTORIA DEL ESTADO YARACUY	\N	\N	0	0	0	2
13646	13449	TEATRO ANDRÉS BELLO	\N	\N	0	0	0	2
13647	13449	ESCUELA DE ARTES PLÁSTICAS "CARMELO FERNANDEZ"	\N	\N	0	0	0	2
13648	13449	MUSEO "CARMELO FERNANDEZ"	\N	\N	0	0	0	2
13649	13449	ESCUELA DE MÚSICA "BLANCA ESTRELLA DE MÉSCOLI"	\N	\N	0	0	0	2
13650	13449	C.I.E.P.E.	\N	\N	0	0	0	2
13651	13449	PARQUE SAN FELIPE "EL FUERTE"	\N	\N	0	0	0	2
13652	13449	DIRECTOR DE INPARQUES	\N	\N	0	0	0	2
13653	13449	CRONISTA DE LA CIUDAD	\N	\N	0	0	0	2
13654	13449	ATENEO DE SAN FELIPE	\N	\N	0	0	0	2
13655	13449	SOCIEDAD BOLIVARIANA	\N	\N	0	0	0	2
13656	13450	ASOCIACIÓN DE GANADEROS DEL ESTADO YARACUY	\N	\N	0	0	0	2
13657	13450	CÁMARA DE COMERCIO E INDUSTRIAS DEL EDO. YARACUY	\N	\N	0	0	0	2
13658	13450	SOCIEDAD DE CAÑICULTORES DEL VALLE DE YARACUY	\N	\N	0	0	0	2
13661	13450	CERÁMICAS CARIBE	\N	\N	0	0	0	2
13662	13450	INDUSTRIAS DEL PLÁSTICO	\N	\N	0	0	0	2
13663	13450	CORPOINDUSTRIAS	\N	\N	0	0	0	2
13664	13450	FEDECÁMARAS YARACUY	\N	\N	0	0	0	2
13665	13450	ELEOCCIDENTE	\N	\N	0	0	0	2
13667	13450	COMPAÑIA ANÓNIMA LUZ ELECTRICA DEL YARACUY C.A.L.E.Y.	\N	\N	0	0	0	2
13668	13451	COLEGIO DE MÉDICOS	\N	\N	0	0	0	2
13669	13451	COLEGIO DE PROFESORES	\N	\N	0	0	0	2
13670	13451	COLEGIO DE INGENIEROS	\N	\N	0	0	0	2
13671	13451	COLEGIO DE BIONALISTAS	\N	\N	0	0	0	2
13672	13451	COLEGIO DE ECONOMISTAS	\N	\N	0	0	0	2
13673	13451	COLEGIO DE TÉCNICOS SUPERIORES UNIVERSITARIOS	\N	\N	0	0	0	2
13674	13451	COLEGIO DE CONTADORES	\N	\N	0	0	0	2
13675	13451	COLEGIO DE FARMACEUTAS	\N	\N	0	0	0	2
13676	13451	COLEGIO DE ABOGADOS	\N	\N	0	0	0	2
13677	13451	COLEGIO DE ADMINISTRADORES	\N	\N	0	0	0	2
13678	13451	COLEGIO DE ODONTÓLOGOS	\N	\N	0	0	0	2
13679	13451	COLEGIO DE MÉDICOS VETERINARIOS	\N	\N	0	0	0	2
13680	13451	COLEGIO DE LICENCIADOS EN RELACIONES INDUSTRIALES	\N	\N	0	0	0	2
13681	13451	COLEGIO DE ENFERMERAS	\N	\N	0	0	0	2
13682	13452	DIARIO YARACUY AL DÍA	\N	\N	0	0	0	2
13683	13452	DIARIO EL YARACUYANO	\N	\N	0	0	0	2
13684	13452	BOLIVARIANA DE INFORMACION	\N	\N	0	0	0	2
13685	13452	VENPRES-YARACUY	\N	\N	0	0	0	2
13686	13452	TELE YARACUY	\N	\N	0	0	0	2
13687	13452	YARACUYANA - T.V	\N	\N	0	0	0	2
13688	13453	RADIO YARACUY 1090 AM	\N	\N	0	0	0	2
13689	13453	RADIO SAN FELIPE "EL FUERTE"	\N	\N	0	0	0	2
13690	13453	RADIO ALEGRÍA 1020	\N	\N	0	0	0	2
13691	13453	RADIO RUMBERA NETWORK FM	\N	\N	0	0	0	2
13692	13453	RADIO HISPANA	\N	\N	0	0	0	2
13693	13453	RADIO SORTE 107.5 FM	\N	\N	0	0	0	2
13694	13453	RADIO PRIMA 96.3 FM.	\N	\N	0	0	0	2
12015	12875	Litigio y Representaciones	VG	\N	0	0	0	1
13727	13713	Accidentes de trabajo	\N	\N	0	0	0	7
113	111	Secretaria	Secretaria de Departamento	GER	0	0	1	1
13696	163	Secretaria	Secretaria	SCR	0	0	0	1
13219	13210	Postergado	\N	\N	0	0	1	1
13697	0	Combo Tipo Evento Documento	\N	\N	0	0	0	6
13698	13697	Pronunciamiento Juridico	\N	\N	0	0	0	6
13699	13697	Invitación a Actos Protocolares	\N	\N	0	0	0	6
13700	13697	Invitacion a Reuniones	\N	\N	0	0	0	6
13701	13697	Notificación de Tribunales	\N	\N	0	0	0	6
13703	13697	Solicitudes de Ayuda Social	\N	\N	0	0	0	6
13704	13697	Informes de Auditoria	\N	\N	0	0	0	6
13702	13697	Notificaciones de Inspectoria del Trabajo	\N	\N	0	0	0	6
13215	13201	Reunión con Particulares	\N	\N	0	0	0	1
13705	13201	Gabinestes Comunales	\N	\N	0	0	0	1
13706	13201	Vencimiento de Lapsos	\N	\N	0	0	0	1
13707	13201	Remisión de Información	\N	\N	0	0	0	1
13712	13708	Ingreso a la Función Pública	\N	\N	0	0	0	7
13713	13708	Situaciones administrativas de los funcionarios y empleados al servicio del Estado	\N	\N	0	0	0	7
13715	13708	Fin de la relación funcionarial	\N	\N	0	0	0	7
13717	13708	Empresas y Fundaciones del Estado	\N	\N	0	0	0	7
13719	13708	Prerrogativas y Privilegios del Estado	|	\N	0	0	0	7
13720	13708	Régimen Presupuestario	\N	\N	0	0	0	7
13721	13708	Reintegros por gastos médicos	\N	\N	0	0	0	7
13722	13712	Designación	\N	\N	0	0	0	7
13723	13712	Situación jurídica del Personal Contratado	\N	\N	0	0	0	7
13724	13712	Situación Jurídica del Personal Obrero	\N	\N	0	0	0	7
13726	13712	Modelo de contratos a tiempo determinado	\N	\N	0	0	0	7
13728	13713	Permisos y licencias	\N	\N	0	0	0	7
13729	13713	Lactancia y Maternidad	\N	\N	0	0	0	7
13730	13713	Procedimientos disciplinarios	\N	\N	0	0	0	7
13731	13713	Comisión de servicio	\N	\N	0	0	0	7
13732	13713	Suplencias	\N	\N	0	0	0	7
13733	13713	Estabilidad	\N	\N	0	0	0	7
13734	13713	Traslados de funcionarios a otros organismos públicos	\N	\N	0	0	0	7
13735	13713	Incompatibilidad entre dos o más cargos públicos	\N	\N	0	0	0	7
13736	13713	Personal sujeto a la Ley Orgánica de Emolumentos, Pensiones  y Jubilaciones	\N	\N	0	0	0	7
13737	13714	Prestaciones sociales. Aplicabilidad de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras	\N	\N	0	0	0	7
13750	13715	Despido injustificado de trabajadores contratados. Procedencia del reenganche y pago de salarios caídos	\N	\N	0	0	0	7
13709	0	Combo Tipo Materia Dictamenes	\N	\N	0	0	0	7
13714	13708	De los conceptos derivados de la relación de empleo público	\N	\N	0	0	0	7
13725	13712	Docentes quienes iniciaron la relación de empleo público por medio de contrato,  y luego de vencer el término del mismo continúan prestando servicios para el Ejecutivo Regional.	\N	\N	0	0	0	7
13738	13714	Carácter salarial de las primas y bonificaciones	\N	\N	0	0	0	7
13739	13714	Bonificación de fin de año	\N	\N	0	0	0	7
13740	13714	Vacaciones	\N	\N	0	0	0	7
13741	13714	Ticket de alimentación	\N	\N	0	0	0	7
13742	13714	Procedencia del pago de pasivos laborales	\N	\N	0	0	0	7
13743	13714	Seguro Social	\N	\N	0	0	0	7
13744	13715	Incapacitación del funcionario. Indemnizaciones que deben pagarse al trabajador	\N	\N	0	0	0	7
13745	13715	Muerte del Trabajador. Cobro de seguro de vida por sus familiares	\N	\N	0	0	0	7
13746	13715	Cobro de pensión de sobreviviente. Cobro de prestaciones sociales	\N	\N	0	0	0	7
13747	13715	Destitución del funcionario	\N	\N	0	0	0	7
13748	13715	Jubilación. Jubilaciones especiales. Jubilación del personal obrero	\N	\N	0	0	0	7
13749	13715	Reajuste de la pensión de jubilación	\N	\N	0	0	0	7
13751	13715	Supresión del Instituto Público en donde laboraba el funcionario	\N	\N	0	0	0	7
13752	13717	Régimen jurídico aplicable a los trabajadores de las Empresas y Fundaciones del Estado	\N	\N	0	0	0	7
13753	13717	Situación Jurídica de los trabajadores de las empresas y fundaciones del Estado en comisión de servicio	\N	\N	0	0	0	7
13754	13719	Procedimiento administrativo previo a las demandas contra el Estado	\N	\N	0	0	0	7
13755	13719	Transacciones judiciales y extrajudiciales	\N	\N	0	0	0	7
13756	13720	Desincorporación de Bienes Muebles	\N	\N	0	0	0	7
13757	13720	Contrato de Obras	\N	\N	0	0	0	7
13758	13720	Contrato de Arrendamiento	\N	\N	0	0	0	7
13759	13720	Contrato de Comodato	\N	\N	0	0	0	7
13760	13720	Contrato de Honorarios Profesionales	\N	\N	0	0	0	7
13761	13720	Anulación de órdenes de pago	\N	\N	0	0	0	7
13762	13720	Procedencia de pago de facturas por la adquisición de bienes o la prestación de servicios	\N	\N	0	0	0	7
13763	13720	Procedencia de pago de crédito cuyo beneficiario esta fallecido	\N	\N	0	0	0	7
13764	13720	Fondos de Pensiones y Jubilaciones	\N	\N	0	0	0	7
13767	0	Combo Tipo Estado Dictamen	\N	\N	0	0	0	7
13768	13767	Activo	\N	\N	0	0	0	7
13769	13767	Inactivo	\N	\N	0	0	0	7
13770	0	Dictamenes	\N	\N	0	0	0	7
13773	13772	ver	\N	\N	0	0	0	7
13771	13770	Dictamenes	Form_dictamenes	Form_dictamenes	13772	0	0	7
13772	291	Form_dictamenes	Dictamenes	../vista/vista_tbldictamen.php	0	0	0	7
13293	291	Form_reporte	Reporte	../vista/vista_reporte_oas.php	0	0	0	2
13237	291	Form_honorarios	Form_honorarios	../vista/vista_tblprohonorariosLitigio.php	0	0	0	4
13782	13781	Atencion 1	\N	\N	0	0	0	4
13783	13781	Atencion 2	\N	\N	0	0	0	4
13784	13781	Atencion 3	\N	\N	0	0	0	4
13787	13786	Ver	\N	\N	0	0	0	4
13788	13786	Guardar	\N	\N	0	0	0	4
13789	13786	Editar	\N	\N	0	0	0	4
13790	13786	Eliminar	\N	\N	0	0	0	4
13786	291	Form_expediente_Litigio	Form_expediente_Litigio	../vista/vista_litigio.php	0	0	0	4
13791	0	Reporte	Reporte Litigio	\N	0	0	0	4
13792	13791	Reportes	Reportes Litigio	Form_reporte_Litigio	13793	0	0	4
13793	291	Form_reporte_Litigio	Form_reporte_Litigio	../vista/vista_reporte_litigio.php	0	0	0	4
13794	13793	Ver	\N	\N	0	0	0	4
13035	13008	Solicitud de Únicos y Universales Herederos			0	0	0	2
13775	13774	Prestaciones Sociales			0	0	0	4
13778	13775	Tipo 1.1			0	0	1	4
13779	13775	Tipo 1.2			0	0	1	4
13780	13775	Tipo 1.3			0	0	1	4
13797	13774	Vacaciones			13774	\N	0	4
13798	13774	Bonificación de Fin de Año			13774	0	0	4
13799	13774	Cesta Tickets			13774	\N	0	4
13800	13774	Antiguedad			13774	\N	0	4
13801	13774	Bono Vacacional			13774	\N	0	4
13777	13774	Accidente Laboral			13774	0	0	4
13802	13774	Enfermedad Ocupacional			13774	0	0	4
13803	13774	Nulidad			13774	0	0	4
13776	13774	Diferencia de Prestaciones Sociales			0	0	1	4
13804	13774	Otros			13774	\N	0	4
13774	0	Combo Motivo Juzgados			0	0	0	4
13806	0	Prestaciones Sociales			13805	\N	1	4
13805	0	Combo Motivo Inspectoria			0	0	0	4
13807	0	Prestaciones Sociales			13805	0	0	4
13781	0	Combo origen de la causa			0	0	0	4
13808	13008	Divorcios no Contenciosos Separación de Cuerpos			\N	\N	0	2
13809	13010	Redacción de Documentos			\N	0	0	2
13009	13008	Divorcios no Contenciosos 185-A			\N	\N	0	2
13810	13008	Divorcios no Contenciosos 185-A sin niños			\N	\N	1	2
13811	13008	Poderes en General			\N	\N	0	2
13812	13008	Sesiones de Derecho			\N	\N	1	2
13827	13813	Juzgado Segundo de Primera Instancia de Juicio del trabajo de la circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
12985	12912	Honorarios	Honorarios	Form_honorarios	12986	8	0	2
13002	12912	Expedientes	Expedientes	Form_osa	13003	5	0	2
13122	12912	Asociaciones	Asociaciones	Form_asociasiones	13123	4	0	2
13822	13813	Juzgado Tercero de Primera Instancia de Sustanciación Mediación y Ejecución del trabajo de la circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
13080	12912	Conyugues	Contrarios	Form_contrarios	13082	2	0	2
13813	0	Combo Tipo Origen	\N	\N	0	0	0	4
13814	13813	Juzgado Primero de Primera Instancia de Sustanciación Mediación y Ejecución del trabajo de la circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
13820	13813	Juzgado Segundo de Primera Instancia de Sustanciación Mediación y Ejecución del trabajo de la circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
13823	13813	Juzgado Cuarto de Primera Instancia de Sustanciación Mediación y Ejecución del trabajo de la circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
13824	13813	Juzgado Primero de Primera Instancia de Juicio del trabajo de la circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
13828	13813	Juzgado Superior Laboral de la Circunscripción Judicial del Estado Yaracuy	\N	\N	0	0	0	4
13829	13813	Inspectoría del Trabajo del Municipio San Felipe del Estado Yaracuy	\N	\N	0	0	0	4
13830	13813	Sub-Inspectoría del Municipio Peña Yaritagua	\N	\N	0	0	0	4
13836	13825	Prestaciones Sociales	\N	\N	0	0	0	4
13837	13826	Prestaciones Sociales	\N	\N	0	0	0	4
13847	13825	Antiguedad	\N	\N	0	0	0	4
13848	13826	Antiguedad	\N	\N	0	0	0	4
13846	13824	Antiguedad	\N	\N	1	0	0	4
13858	13825	Bono Vacacional	\N	\N	0	0	0	4
13859	13826	Bono Vacacional	\N	\N	0	0	0	4
13870	13825	Aguinaldos	\N	\N	0	0	0	4
13871	13826	Aguinaldos	\N	\N	0	0	0	4
13882	13825	Cesta Tickets	\N	\N	0	0	0	4
13883	13826	Cesta Tickets	\N	\N	0	0	0	4
13849	13827	Antiguedad			1	0	0	4
13861	13827	Bono Vacacional			1	0	0	4
13884	13827	Cesta Tickets			1	0	0	4
13872	13827	Aguinaldos			1	0	0	4
13842	13814	Antiguedad			1	0	0	4
13853	13814	Bono Vacacional			1	0	0	4
13865	13814	Aguinaldos			1	0	0	4
13877	13814	Cesta Tickets			1	0	0	4
13832	13820	Prestaciones Sociales			1	0	0	4
13843	13820	Antiguedad			1	0	0	4
13854	13820	Bono Vacacional			1	0	0	4
13866	13820	Aguinaldos			1	0	0	4
13878	13820	Cesta Tickets			1	0	0	4
13833	13822	Prestaciones Sociales			1	0	0	4
13844	13822	Antiguedad			1	0	0	4
13855	13822	Bono Vacacional			1	0	0	4
13867	13822	Aguinaldos			1	0	0	4
13879	13822	Cesta Tickets			1	0	0	4
13834	13823	Prestaciones Sociales			1	0	0	4
13845	13823	Antiguedad			1	0	0	4
13856	13823	Bono Vacacional			1	0	0	4
13868	13823	Aguinaldos			1	0	0	4
13880	13823	Cesta Tickets			1	0	0	4
13839	13828	Prestaciones Sociales			1	0	0	4
13850	13828	Antiguedad			1	0	0	4
13862	13828	Bono Vacacional			1	0	0	4
13874	13828	Aguinaldos			1	0	0	4
13885	13828	Cesta Tickets			1	0	0	4
13840	13829	Prestaciones Sociales			1	0	0	4
13851	13829	Antiguedad			1	0	0	4
13863	13829	Bono Vacacional			1	0	0	4
13875	13829	Aguinaldos			1	0	0	4
13886	13829	Cesta Tickets			1	0	0	4
13841	13830	Prestaciones Sociales			1	0	0	4
13864	13830	Bono Vacacional			1	0	0	4
13852	13830	Antiguedad			1	0	0	4
13876	13830	Aguinaldos			1	0	0	4
13893	13825	Accidente Laboral	\N	\N	0	0	0	4
13894	13826	Accidente Laboral	\N	\N	0	0	0	4
13904	13825	Enfermedad Ocupacional	\N	\N	0	0	0	4
13905	13826	Enfermedad Ocupacional	\N	\N	0	0	0	4
13913	13825	Nulidad	\N	\N	0	0	0	4
13914	13826	Nulidad	\N	\N	0	0	0	4
13930	13825	Otros	\N	\N	0	0	0	4
13931	13826	Otros	\N	\N	0	0	0	4
13938	13162	Titulo Supletorio	\N	\N	0	0	0	2
13939	13162	Solicitud de Únicos y Universales Herederos	\N	\N	0	0	0	2
13941	13162	Declaración Jurada de no Poseer Vivienda	\N	\N	0	0	0	2
13942	13162	Constitución de Asociación Civil o Cooperativa	\N	\N	0	0	0	2
13943	13162	Documentos de Cesión de Derechos	\N	\N	0	0	0	2
13944	13162	Compra Venta	\N	\N	0	0	0	2
13945	13162	Arrendamiento/Desalojo	\N	\N	0	0	0	2
13946	13162	Comodatos	\N	\N	0	0	0	2
13947	13162	Constitución de Fundaciones	\N	\N	0	0	0	2
13948	13162	Agresiones a la Mujer	\N	\N	0	0	0	2
13949	13162	Divorcios no Contenciosos Separación de Cuerpos	\N	\N	0	0	0	2
13950	13162	Poderes en General	\N	\N	0	0	0	2
13951	13938	Formato	\N	\N	0	0	0	2
13953	13939	Formato	\N	\N	0	0	0	2
13954	13940	Formato	\N	\N	0	0	0	2
13955	13941	Formato	\N	\N	0	0	0	2
13957	13943	Formato	\N	\N	0	0	0	2
13958	13944	Formato	\N	\N	0	0	0	2
13959	13945	Formato	\N	\N	0	0	0	2
13961	13947	Formato	\N	\N	0	0	0	2
13963	13949	Formato	\N	\N	0	0	0	2
13964	13950	Formato	\N	\N	0	0	0	2
13960	13946	Formato	\N	\N	0	0	0	2
13956	13942	Formato	\N	\N	0	0	0	2
12979	12912	Abogados Conyugues	Abogados Contrarios	Form_abogados_contrarios	12980	3	0	2
13965	0	Tipo Ramo Asociacion	\N	\N	0	0	0	2
13869	13824	Aguinaldos	\N	\N	1	0	0	4
13881	13824	Cesta Tickets	\N	\N	1	0	0	4
13892	13824	Accidente Laboral	\N	\N	1	0	0	4
13903	13824	Enfermedad Ocupacional	\N	\N	1	0	0	4
13912	13824	Nulidad	\N	\N	1	0	0	4
13929	14064	Otros	\N	\N	0	0	0	4
13966	13965	Agricultura	\N	\N	0	0	0	2
13967	13965	Servicios	\N	\N	0	0	0	2
13968	13965	Vigilancia	\N	\N	0	0	0	2
13969	13808	Original del Acta de Matrimonio	\N	\N	0	0	0	2
13970	13808	Fotoscopias de la Cédula de los Solicitantes	\N	\N	0	0	0	2
13971	13808	Indicar la Dirección Exacta del Último Domicilio Conyugal	\N	\N	0	0	0	2
13972	13808	Dirección de la Residencia de cada uno de los Solicitantes y la Fecha aproximada de Separación	\N	\N	0	0	0	2
13973	13808	Partida de Nacimiento y si son mayores de Edad cédula de cada uno de los hijos	\N	\N	0	0	0	2
13974	13808	Original del Acta de Matrimonio	\N	\N	0	0	0	2
13981	13131	Terminado	\N	\N	0	0	0	2
13983	13981	Concluido con Exito	\N	\N	0	0	0	2
13984	13981	Desistio de la Solicitud	\N	\N	0	0	0	2
13028	13025	No se Asistio porque el Solicitante no fue al Tribunal	\N	\N	0	0	0	2
13107	13025	No se Asistio porque Inasistencia del Abogado Asistente	\N	\N	0	0	0	2
13975	13133	En Espera de Consignación de Documentos	\N	\N	0	0	0	2
13135	13133	En espera de Respuesta	\N	\N	0	0	0	2
13976	13132	A la Espera de Enviar al Tribunal	\N	\N	0	0	0	2
13978	13132	En Espera de LLevar a Notariar Registro	\N	\N	0	0	0	2
13986	13814	Notificación 	\N	\N	2	0	0	4
13988	13814	Contestación	Fase de Contestación		2	0	0	4
13989	13814	Juicio	Fase de Juicio		2	0	0	4
13990	13814	Sentencia	Fase de Sentencia		2	0	0	4
13991	13814	Apelación	Fase de Apelación		2	0	0	4
13992	13814	Audiencia Apelación	Fase de Audiencia Apelación		2	0	0	4
13896	13827	Accidente Laboral			1	0	0	4
13906	13827	Enfermedad Ocupacional			1	0	0	4
13915	13827	Nulidad			1	0	0	4
13932	13827	Otros			1	0	0	4
13888	13814	Accidente Laboral			1	0	0	4
13899	13814	Enfermedad Ocupacional			1	0	0	4
13908	13814	Nulidad			1	0	0	4
13925	13814	Otros			1	0	0	4
13889	13820	Accidente Laboral			1	0	0	4
13900	13820	Enfermedad Ocupacional			1	0	0	4
13909	13820	Nulidad			1	0	0	4
13926	13820	Otros			1	0	0	4
13890	13822	Accidente Laboral			1	0	0	4
13901	13822	Enfermedad Ocupacional			1	0	0	4
13910	13822	Nulidad			1	0	0	4
13927	13822	Otros			1	0	0	4
13891	13823	Accidente Laboral			1	0	0	4
13902	13823	Enfermedad Ocupacional			1	0	0	4
13928	13823	Otros			1	0	0	4
13911	13823	Nulidad			1	0	0	4
13897	13828	Accidente Laboral			1	0	0	4
13916	13828	Nulidad			1	0	0	4
13933	13828	Otros			1	0	0	4
13917	13829	Calificación de Falta			1	0	0	4
13920	13829	Reenganche y Pago de Salarios Caídos			1	0	0	4
13922	13829	Procedimiento por Desmejora			1	0	0	4
13934	13829	Otros			1	0	0	4
13887	13830	Cesta Tickets			1	0	0	4
13919	13830	Calificación de Falta			1	0	0	4
13921	13830	Reenganche y Pago de Salarios Caídos			1	0	0	4
13923	13830	Procedimiento por Desmejora			1	0	0	4
13936	13830	Otros			1	0	0	4
13993	13814	Ejecución Voluntaria	Fase de Ejecución Voluntaria		2	0	0	4
13994	13820	Notificación			2	0	0	4
13995	13820	Conciliatoria			2	0	0	4
13996	13820	Contestación			2	0	0	4
13997	13820	Juicio			2	0	0	4
13998	13820	Sentencia			2	0	0	4
13999	13820	Apelación			2	0	0	4
14000	13820	Audiencia Apelación			2	0	0	4
14001	13820	Ejecución Voluntaria			2	0	0	4
14002	13820	Ejecución Forzosa			2	0	0	4
14003	13814	Ejecución Forzosa			2	0	0	4
14004	13822	Notificación			2	0	0	4
14005	13822	Conciliatoria			2	0	0	4
14006	13822	Contestación			2	0	0	4
14007	13822	Juicio			2	0	0	4
14008	13822	Sentencia			2	0	0	4
14009	13822	Apelación			2	0	0	4
14010	13822	Audiencia Apelación			2	0	0	4
14011	13822	Ejecución Voluntaria			2	0	0	4
14012	13822	Ejecución Forzosa			2	0	0	4
14013	13823	Notificación			2	0	0	4
14014	13823	Conciliatoria			2	0	0	4
14015	13823	Contestación			2	0	0	4
14016	13823	Juicio			2	0	0	4
14017	13823	Sentencia			2	0	0	4
14018	13823	Apelación			2	0	0	4
14019	13823	Audiencia Apelación			2	0	0	4
14020	13823	Ejecución Voluntaria			2	0	0	4
14021	13823	Ejecución Forzosa			2	0	0	4
13796	13012	Demandado	\N	\N	0	0	0	2
14031	13827	Notificación			2	0	0	4
14032	13827	Conciliatoria			2	0	0	4
14033	13827	Contestación			2	0	0	4
14034	13827	Juicio			2	0	0	4
14035	13827	Sentencia			2	0	0	4
14036	13827	Apelación			2	0	0	4
14037	13827	Audiencia Apelación			2	0	0	4
14038	13827	Ejecución Voluntaria			2	0	0	4
14039	13827	Ejecución Forzosa			2	0	0	4
14041	14040	Registro Principal	\N	\N	0	0	0	2
14042	14040	Registro Mercantil			0	0	0	2
14043	14040	Registro Público del Municipio Bolívar			0	0	0	2
14044	14040	Registro Público del Municipio Bruzual			0	0	0	2
14045	14040	Registro Público del Municipio Nirgua			0	0	0	2
14046	14040	Registro Público del Municipio San Felipe			0	0	0	2
14047	14040	Registro Público del Municipio Sucre			0	0	0	2
14048	14040	Registro Público del Municipio Urachiche			0	0	0	2
14049	14040	Registro Público del Municipio Yaritagua			0	0	0	2
14050	14040	Notaría Pública de San Felipe			0	0	0	2
14051	14040	Notaría Pública de Yaritagua			0	0	0	2
14052	14040	Notaría Pública de Nirgua			0	0	0	2
14053	12955	Divorciado			0	0	0	2
13233	13229	Demandantes	Contrarias	Form_contrarios	13234	1	0	4
13785	13229	Expedientes	Expediente Litigio	Form_expediente_Litigio	13786	4	0	4
14057	0	Combo Tipo Organismo	Centralizado/Descentralizado	\N	0	0	0	4
13835	13824	Prestaciones Sociales	\N	\N	1	0	0	4
14059	14057	DESCENTRALIZADOS	\N	\N	0	0	0	2
13015	14057	CENTRALIZADOS	\N	\N	0	0	0	2
13857	13824	Bono Vacacional	\N	\N	1	0	0	4
14022	14064	Notificación			2	0	0	4
14023	14064	Conciliatoria			2	0	0	4
14024	14064	Contestación			2	0	0	4
14025	14064	Juicio			2	0	0	4
14026	14064	Sentencia			2	0	0	4
14027	14064	Apelación			2	0	0	4
14028	14064	Audiencia Apelación			2	0	0	4
14029	14064	Ejecución Voluntaria			2	0	0	4
14030	14064	Ejecución Forzosa			2	0	0	4
13076	13015	SECRETARÍA DE PODER COMUNAL Y PROTECCION SOCIAL			0	0	0	2
13386	13015	SECRETARIA DE COMUNICACIÓN E INFORMACIÓN 	\N	\N	0	0	0	2
13403	13015	JEFE DE ESTADÍSTICA E  INFORMÁTICA	\N	\N	0	0	0	2
14060	14059	CLEY			0	0	0	4
13253	291	Form_representantes	Representantes	../vista/vista_abogados_representantes.php	0	0	0	4
14061	0	Combo Tipo S/N	\N	\N	0	0	0	4
14062	14061	Si	\N	\N	0	0	0	4
14063	14061	No	\N	\N	0	0	0	4
14064	0	Tipo Combo Fases	\N	\N	0	0	0	4
14066	13813	Otros	\N	\N	0	0	0	4
13987	13814	Conciliatoria	Fase concialiatoria		2	0	0	4
14067	14057	SAREN	\N	\N	0	0	0	2
14068	14067	NOTARÍA PÚBLICA DE SAN FELIPE ESTADO YARACUY	\N	\N	0	0	0	2
14069	14067	NOTARÍA PÚBLICA DE YARITAGUA ESTADO YARACUY	\N	\N	0	0	0	2
14070	14067	NOTARÍA PÚBLICA DE NIRGUA ESTADO YARACUY	\N	\N	0	0	0	2
14071	14067	REGISTRO PRINCIPAL DEL ESTADO YARACUY	\N	\N	0	0	0	2
14072	14067	REGISTRO PÚBLICO DEL MUNICIPIO BOLÍVAR ESTADO YARACUY	\N	\N	0	0	0	2
14073	14067	REGISTRO PÚBLICO DEL MUNICIPIO BRUZUAL ESTADO YARACUY	\N	\N	0	0	0	2
14074	14067	REGISTRO PÚBLICO DEL MUNICIPIO NIRGUA ESTADO YARACUY	\N	\N	0	0	0	2
14075	14067	REGISTRO PÚBLICO DE LOS MUNICIPIOS SAN FELIPE, INDEPENDENCIA, COCOROTE Y VEROES ESTADO YARACUY	\N	\N	0	0	0	2
14076	14067	REGISTRO PÚBLICO DE LOS MUNICIPIOS SUCRE, LA TRINIDAD Y ARISTIDES BASTIDAS ESTADO YARACUY	\N	\N	0	0	0	2
14077	14067	REGISTRO PÚBLICO DEL MUNICIPIO URACHICHE ESTADO YARACUY	\N	\N	0	0	0	2
14078	14067	REGISTRO PÚBLICO DEL MUNICIPIO YARITAGUA ESTADO YARACUY	\N	\N	0	0	0	2
14079	14067	REGISTRO MERCANTIL DEL ESTADO YARACUY	\N	\N	0	0	0	2
14081	291	Form_abogados_Procuraduria	Form_abogados_procuraduria	../vista/vista_abogados.php	0	0	0	2
14080	12912	Abogados Procuraduría	Abogados	Form_abogados	14081	0	0	2
14082	14081	Ver	ver	\N	0	0	0	2
13838	13827	Prestaciones Sociales			1	0	0	4
13831	13814	Prestaciones Sociales			1	0	0	4
13907	13828	Enfermedad Ocupacional			1	0	0	4
14084	14064	Audiencia Prolongada	\N	\N	2	0	0	4
14083	14064	Audiencia Preliminar	\N	\N	2	0	0	4
14085	14064	Promoción de Pruebas	\N	\N	2	0	0	4
14086	14064	Audiencia de Instalación	\N	\N	2	0	0	4
14087	14057	TSJ	\N	\N	0	0	0	2
14088	14087	Tribunal de Protección	\N	\N	0	0	0	2
14089	14087	Tribunal Distribuidor	\N	\N	0	0	0	2
14090	14087	Tribunal Agrario	\N	\N	0	0	0	2
14092	14087	Juzgado Municipio Peña	\N	\N	0	0	0	2
14093	14087	Juzgado Municipio Bruzual	\N	\N	0	0	0	2
14094	14087	Juzgado Municipio Urachiche	\N	\N	0	0	0	2
14095	14087	Juzgado Municipio Sucre	\N	\N	0	0	0	2
14100	14087	Juzgado Municipio Bolivar	\N	\N	0	0	0	2
14096	14087	Juzgado  Municipio Trinidad	\N	\N	0	0	0	2
14098	14087	Juzgado Municipio Aristides Bastidas	\N	\N	0	0	0	2
14099	14087	Juzgado Municipio  Jose Antonio Paez	\N	\N	0	0	0	2
14102	14087	Juzgado Municipio Manuel Monge	\N	\N	0	0	0	2
14103	14087	Juzgado Municipio Nirgua	\N	\N	0	0	0	2
\.


--
-- Data for Name: tblmaestros_sistemas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblmaestros_sistemas (id_maestro, id_origen, stritema, stritemb, stritemc, lngnumero, sngcant, bolborrado, id_sistema) FROM stdin;
4	0	Correspondencia	\N	\N	0	0	0	1
12	0	Sugerencias	\N	\N	0	0	0	8
6	0	OAS	\N	\N	0	0	0	2
7	0	Agenda	\N	\N	0	0	0	3
8	0	Litigio	\N	\N	0	0	0	4
9	0	Seguridad	\N	\N	0	0	0	5
10	0	Documentos	\N	\N	0	0	0	6
11	0	Dictamenes	\N	\N	0	0	0	7
\.


--
-- Data for Name: tblnotas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblnotas (id_notas, id_tiponota_maestro, id_actividad, id_corresp, dtmnota, memobsernota, id_contacto, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblproabogadoscasos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproabogadoscasos (id_proabogadoscasos, id_abogado, id_caso, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblproactuaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproactuaciones (id_proactuaciones, id_tipo_actuacion, id_actuacion, strdescripcionactuacion, fecactuacion, bolborrado, strnombreactuacion) FROM stdin;
15	13165	0	usia<br />super<br />	0001-01-01 BC	0	xxx
14	13165	13166	<div style="text-align: justify;">CIUDADANO: <br /><br /><b>JUEZ DE PROTECCI&Oacute;N DEL NI&Ntilde;O Y DEL ADOLESCENTE  DE  LA  CIRCUNSCRIPCI&Oacute;N  JUDICIAL  DEL  ESTADO  YARACUY.</b><br /><br />SU DESPACHO.-</div><div style="text-align: justify;">Nosotros, <b>GONZALO AGUST&Iacute;N GONZ&Aacute;LEZ OCHOA Y ADALIS YANIRIS CORDERO L&Oacute;PEZ</b>, mayores de edad, c&oacute;nyuges, venezolanos, titulares de las C&eacute;dulas de Identidad n&uacute;meros V-5.096.347  y  V-12.282.541 respectivamente, domiciliados en Quebrada Seca, El Rinc&oacute;n, Maiquet&iacute;a Estado Vargas, el primero y en la calle 03 de Las Flores, sector Tacarte, casa N&ordm; 22141 del Municipio Cocorote del Estado Yaracuy, el segundo; asistidos en este acto por la abogado en ejercicio, MARY CARMEN ARAUJO DUR&Aacute;N, venezolana, mayor de edad, inscrita en el Instituto de Previsi&oacute;n Social del Abogado bajo el No 138.517; ante usted respetuosamente ocurrimos para exponer: <br /><br />LOS HECHOS</div><div style="text-align: justify;"><br />En fecha 27 de Febrero del a&ntilde;o 2003, contrajimos matrimonio en el  Registro Civil, Municipio Cocorote  del Estado Yaracuy; en presencia del Jefe del Registro Civil Glenda Josefina Capdevielle Ledezma, y asistido por la secretaria accidental Alicia Helainet P&eacute;rez S&aacute;nchez. Tal como se evidencia en copia certificada del acta de Matrimonio N&ordm; 15, la cual anexamos a este escrito de solicitud marcada con la letra &ldquo;A&rdquo;, para que surta todos sus efectos legales. <br />Posteriormente fijamos nuestro hogar com&uacute;n en la calle 03 de Las Flores, sector Tacarte, casa N&ordm; 22141 del Municipio Cocorote del Estado Yaracuy , donde la armon&iacute;a y el entendimiento se desarrollaron en un clima de normalidad, pero por razones que no es el caso exponer en esta oportunidad, la misma desde hace   cinco (05), a&ntilde;os sufri&oacute; un proceso de deterioro cada vez m&aacute;s agudo, que hizo imposible nuestra vida en com&uacute;n, raz&oacute;n por la cual aproximadamente en el mes de Marzo del a&ntilde;o 2005, de mutuo y amistoso acuerdo nos separamos de hecho fijando nuestros domicilios en lugares separados situaci&oacute;n que ha permanecido en esta condici&oacute;n desde esa fecha hasta hoy, sin que haya existido reconciliaci&oacute;n.<br />En est&aacute; uni&oacute;n matrimonial procreamos dos hijas de nombres YANIRIS AGUSLYMAR GOZ&Aacute;LEZ CORDERO  la cual naci&oacute; el 19 de Marzo del a&ntilde;o 1998, en el Hospital Central de San Felipe Estado Yaracuy; tal como se evidencia de la copia certificada de Acta de nacimiento N&ordm; 189 la cual acompa&ntilde;amos al siguiente escrito marcada con la letra &ldquo;B&rdquo; y GILDRE YOMARA GONZ&Aacute;LEZ CORDERO la cual naci&oacute; el 08 de Julio del a&ntilde;o 2001, en el Hospital Central de San Felipe Estado Yaracuy; tal como se evidencia de la copia certificada de Acta de Nacimiento N&ordm; 476 que acompa&ntilde;amos al presente escrito marcada con la letra &ldquo;C&rdquo;. Durante el tiempo que dur&oacute; nuestra uni&oacute;n matrimonial no adquirimos bienes muebles ni inmuebles por lo cual nada tenemos que liquidar y, as&iacute; lo declaramos para los efectos legales correspondientes.<br />El DERECHO<br />      Es por los argumentos anteriores mencionados y con fundamentos en el Art&iacute;culo 185 letra &ldquo;A&rdquo; del C&oacute;digo Civil Venezolano vigente,  por lo que ocurrimos ante su competente autoridad, a fin que decrete el divorcio y en consecuencia  disuelto el v&iacute;nculo matrimonial que nos une.<br />DISPOSICIONES FINALES<br />PRIMERA: Solicitamos del despacho que usted dirige, que con fundamentos a los hechos narrados y con base a las normativas legales citadas se sirva a declarar el divorcio y disuelto el v&iacute;nculo matrimonial que nos une. <br />SEGUNDA: En cuanto a la patria  potestad y la responsabilidad de crianza ser&aacute; compartida, para mejorar el desarrollo educativo y emocional de nuestras hijas;  y la responsabilidad de custodia ser&aacute; ejercida por la madre. <br />TERCERA: Con  respecto al r&eacute;gimen de convivencia familiar de nuestras hijas, hemos acordado que sea  abierto y a conciencia, teniendo como &uacute;nica limitaci&oacute;n el no afectar el desarrollo emocional y las actividades educativas de las ni&ntilde;as, de conformidad con lo dispuesto en los Art&iacute;culos 385 y 387, de la ley org&aacute;nica para la protecci&oacute;n del ni&ntilde;o, ni&ntilde;a y adolescentes.<br />CUARTA: Dado que de nuestra uni&oacute;n matrimonial no adquirimos ning&uacute;n tipo de bienes, como up supra se&ntilde;alamos, nada tenemos que liquidar de comunidad de gananciales. <br />QUINTA: Acordamos la obligaci&oacute;n de manutenci&oacute;n de CAUTROCIENTOS  CINCUENTA BOL&Iacute;VARES FUERTES (BS.F. 450,00), mensuales, en dinero efectivo, los cuales ser&aacute;n entregado a la madre de las ni&ntilde;as y su ajuste se har&aacute; de forma autom&aacute;tica y  proporcional, sobre la base de un aumento de sus ingresos y de acuerdo a las necesidades de las ni&ntilde;as, por cuanto &eacute;stas estudian y as&iacute; de mutuo acuerdo lo pactamos. A los fines legales consiguientes, rogamos a usted se sirva ordenar lo pertinente para que se libre boleta de notificaci&oacute;n al fiscal del Ministerio P&uacute;blico remiti&eacute;ndole anexo a la misma copias certificada de la presente solicitud.<br />Solicitamos se sirva a expedirnos dos (02) copias certificadas de la sentencia que decrete disuelto el v&iacute;nculo matrimonial.<br />Por ultimo pedimos que la misma sea admitida y substanciada conforme a derecho y, declarada con lugar en la definitiva con todos los pronunciamientos legales. En San Felipe a la fecha de su presentaci&oacute;n.<br /><br /><br /><br />LOS SOLICITANTES.       \t\t                   ABOGADA ASISTENTE.</div>	2012-06-03	0	185A
16	13941	13955	<div style="text-align: center;"><u><b>DECLARACI&Oacute;N JURADA DE NO POSEER VIVIENDA</b></u></div><div style="text-align: justify;">Yo, <b>OMAR JOSE CHAVEZ GUDI&Ntilde;O</b>, Venezolano, mayor de edad, titular de la C&eacute;dula Identidad N&ordm; V-<b>15.482.488</b>, de este domicilio, a los fines de dar cumplimiento a lo establecido en el art&iacute;culo 252 de la Ley de R&eacute;gimen Prestacional de Vivienda y H&aacute;bitat, publicada en la Gaceta Oficial de la Rep&uacute;blica Bolivariana de Venezuela N&ordm; 38.182 de fecha 9 de Mayo de 2005, reimpresa por error material en Gaceta Oficial de la Rep&uacute;blica Bolivariana de Venezuela N&ordm; 38.204 de fecha 08 de Junio de 2005, declaro lo siguiente: <b>Primero</b>: Que actualmente no soy propietario de ninguna vivienda, ni soy beneficiario de asistencia habitacional alguna, ni coparticipante de una cooperativa o asociaci&oacute;n para adquirir vivienda y que si con posterioridad al otorgamiento del cr&eacute;dito para adquisici&oacute;n de vivienda que estoy solicitando se llegare a comprobar que soy propietario de otra vivienda, quedar&eacute; obligado a restituir de inmediato la totalidad del pr&eacute;stamo solicitado. <b>Segundo</b>: Que la vivienda que tengo pactada adquirir (construir &ndash; auto construir) constituir&aacute; mi &uacute;nica vivienda principal, la cual me obligo a habitar. Con el otorgamiento de este documento, juro que lo antes expuesto es cierto. En la Ciudad de San Felipe, a la fecha de su autenticaci&oacute;n.<br />&nbsp;</div><div style="text-align: center;">_______________________________________<br /><b>OMAR JOSE CHAVEZ GUDI&Ntilde;O<br />C.I. N&ordm; V-15.482.488<br /></b></div><br />	2012-12-06	0	Declaracion de no poseer vivienda
\.


--
-- Data for Name: tblproactuaciones_litigio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproactuaciones_litigio (id_litigio_actuaciones, id_proactuacion, stronombreactuacion, fecactuacion, bolborrado, strdescripcionactuacion, strexpedientetribunal, anexa_agenda) FROM stdin;
1	34	prueba buena	2012-12-27	0	n n nkh kjbkj esteeeeeeeeee<br type="_moz" />	2345bb	14062
4	34	otra	2013-01-03	1	mbhhjbh<br type="_moz" />	3456765	14063
3	34	valeris	2012-12-27	1	vgjfvkgtk<br type="_moz" />	65643	14062
2	34	jaime	2012-12-27	0	b bn gb g <br type="_moz" />	2354334	14062
5	34	desrrollo	2013-01-08	0	mb hjbvhb<br type="_moz" />	321456	14062
6	34	otra prueba	2013-01-30	0	bn gjvgv<br type="_moz" />	44564	14062
7	34	otra agenda	2013-01-08	0	nm khbhk<br type="_moz" />	khbv567894	14062
8	34	otra agenda	2013-01-08	1	nm khbhk<br type="_moz" />	khbv567894	14062
9	34	ninoska	2013-01-16	0	&nbsp;n kh&ntilde;kh ninoska	nino12345	14062
10	34	al fin	6792-09-28	0	mbgjvgvgvgvgv<br type="_moz" />	2345rrr	14062
11	35	Prueba Agenda	2013-01-09	0	PRUEBA FINAL<br type="_moz" />	33445	14062
12	35	prueba	2013-01-01	0	<br type="_moz" />	\N	14062
13	33	instalacion de audiencia preliminar	2013-01-23	0	aaaa<br type="_moz" />	\N	14062
14	33	otra	2013-01-01	1	<br type="_moz" />	\N	14063
15	37	audiencia preliminar	2013-01-15	0	&nbsp;zxxcxc	\N	14062
16	37	aas	2013-01-12	0	&nbsp;	\N	14062
17	37	zxcds	2013-01-01	0	&nbsp;	\N	14062
18	33	eee	2013-01-01	0	retery<br type="_moz" />	\N	14062
19	37	prueba	2013-01-16	0	<br type="_moz" />	\N	14062
21	38	a	2013-01-22	1	<br type="_moz" />	\N	14062
20	38	Instalacion de la audiencia preliminar	2013-01-24	1	<br type="_moz" />		14062
22	39	DILIGENCIA	2013-01-21	0	DILIGENCIA REPROGRAMAR&nbsp; AUDIENCIA<br type="_moz" />	\N	14063
23	39	Escrito de Pruebas 	2013-01-22	0	Escrito de Pruebas<br type="_moz" />	\N	14062
24	46	Audiencia de Juicio	2013-02-27	0	Se encuentra fijada audiencia de juicio a las 10 am<br type="_moz" />	\N	14062
25	40	Revision de expediente.	2013-02-12	0	Segun los computos, esta prevista la celebracion de audiencia preliminar para el dia 12 de Febrero 2013, a las 10:00 am.<br type="_moz" />	\N	14062
26	45	Revision de expediente	2012-09-17	0	Ya&nbsp; constan todas las notificaciones debidamentes certificadas y segun los computos de los lapsos, la misma posiblemente se pue instalar el 19-10-2013 a las 11:00 am.<br type="_moz" />	\N	14063
27	45	Instalacion de la audiencia preliminar	2012-10-19	0	Se instala audiencia preliminar, promoviendo amdbas partes escrito de pruebas, siendo prolongada la misma para el 21-11-2012, a las 10:00 am.<br type="_moz" />	\N	14063
29	45	Prolongacion  de audiencia preiliminar	2012-12-12	0	Se prorlonga la audiencia para el 25-01-2013 a las 11:00 am.<br type="_moz" />	\N	14063
30	45	Prolongacion de audiencia preiliminar	2013-01-25	0	Se celebra la audiencia preliminara prolongada, quedando la msima desistida, en vista de la incomparecencia de la parte actora.<br type="_moz" />	\N	14063
28	45	Prolongacion de audiencia preliminar	2012-11-21	0	Se celebra audiencia prolongada, siendo prolongada nuevamente para el 12-12-2012, a las 10:00 am.<br type="_moz" />		14063
\.


--
-- Data for Name: tblproclientecasos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproclientecasos (id_proclientecasos, id_cliente, id_caso, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblproexpediente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente (id_proexpediente, id_proclientecasos, id_proabogadoscasos, id_documentoscasos, id_usuario, id_ano, id_materia, id_estatus, strnroexpediente, strtitulo, strdescripcion, id_refer, fecapertura, feccierre, bolborrado, strletrado, id_actuacion, id_honorario, id_tipo_tramite, id_tipo_atencion, id_tipo_organismo, id_organismo, id_tipo_minuta, id_minuta, strobservacion, fecexpediente, strdireccion_asistido, strdireccion_conyugue, strdireccion_ultimo_domicilio, fecseparacion, intmonto_manutencion, id_regimen, strdias, strhoras, intcuotames1, intcuotames2, cedula_abogado_responsable, cedula_abogado_ejecutor, cedula_cliente, strdocumentos, cedula_conyugue, id_citacion, strobservacion_cerrar, strnroexpedienteauxiliar, strrepresentante, id_estado_fisico_expediente, id_tipo_espacio, id_tipo_archivador, id_tipo_piso_archivador, id_tipo_archivador_gaveta, id_abogado_resp, id_abogado_ejecutor, id_solicitante, id_contrarios) FROM stdin;
22	0	0	0	725	0	0	0	OAS-21012013-21		Se solicito declaracion jurada<br type="_moz" />	0	2013-01-21 00:00:00-04:30	\N	0	\N	0	31	13037	13809	14067	14068	0	0		2013-01-21 00:00:00-04:30				0001-01-01	0	0			0	0	12278774	14919653	17254816		15230592	0			 	0	0	0	0	0	725	17	8	4
21	0	0	0	725	0	0	0	OAS-21012013-20		<br type="_moz" />	0	2013-01-21 00:00:00-04:30	\N	1	\N	0	31	13037	13809	14067	14068	0	0		2013-01-21 00:00:00-04:30				0001-01-01 BC	0	0			0	0	12278774	14919653	17254816			0			 	0	0	0	0	0	725	17	8	0
23	0	0	0	726	0	0	0	OAS-21012013-22		<br type="_moz" />	0	2013-01-21 00:00:00-04:30	\N	0	\N	0	31	13037	13809	14067	14068	0	0		2013-01-21 00:00:00-04:30				0001-01-01 BC	0	0			0	0	13795178	14919653	16483620			0			 	0	0	0	0	0	726	17	9	0
24	0	0	0	710	0	0	0	OAS-21012013-23		<br type="_moz" />	0	2013-01-14 00:00:00-04:30	\N	0	\N	0	16	13009	13092	14067	14068	0	0		2013-01-14 00:00:00-04:30				0001-01-01 BC	0	0			0	0	15910627	14919653	12536225			0		oas-6242	 	0	0	0	0	0	710	17	11	0
25	0	0	0	710	0	0	0	OAS-21012013-24		<br type="_moz" />	0	2013-01-14 00:00:00-04:30	\N	0	\N	0	16	13009	13092	14067	14068	0	0		2013-01-14 00:00:00-04:30				0001-01-01	0	0			0	0	15910627	14919653	12536225	13030,13031,13032,13044,	15230592	0		oas-6242	 	0	0	0	0	0	710	17	11	4
26	0	0	0	710	0	0	0	OAS-21012013-25		<br type="_moz" />	0	2013-01-14 00:00:00-04:30	\N	0	\N	0	16	13009	13092	14067	14068	0	0		2013-01-14 00:00:00-04:30				0001-01-01	0	0			0	0	15910627	14919653	12536225	13030,13031,13032,13044,	15230592	0		oas-6242	 	0	0	0	0	0	710	17	11	4
\.


--
-- Data for Name: tblproexpediente_abogados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_abogados (id_proexpediente_abogados, id_abogados, id_proexpediente, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblproexpediente_abogados_demandantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_abogados_demandantes (id_proexpediente_abogados_demandantes, id_abogados, id_proexpediente, bolborrado) FROM stdin;
13	6	33	0
14	6	34	0
15	7	35	0
16	6	37	0
17	14	38	0
18	15	38	0
19	17	40	0
20	18	39	0
21	19	34	0
22	22	35	0
23	10	42	0
24	36	44	0
25	10	47	0
26	29	46	0
27	10	48	0
28	16	41	0
29	24	52	0
30	24	50	0
31	28	53	0
32	24	51	0
33	23	54	0
34	26	54	0
35	33	55	0
36	50	56	0
37	15	57	0
38	16	59	0
39	7	58	0
40	16	60	0
41	43	62	0
42	52	63	0
43	16	65	0
44	49	67	0
45	15	69	0
46	14	69	0
47	15	70	0
\.


--
-- Data for Name: tblproexpediente_abogados_ejecutores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_abogados_ejecutores (id_proexpediente_abogados_ejecutores, id_abogados, id_proexpediente, bolborrado) FROM stdin;
11	4	33	0
12	5	34	0
13	3	35	0
\.


--
-- Data for Name: tblproexpediente_abogados_representantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_abogados_representantes (id_proexpediente_abogados_representantes, id_abogados, id_proexpediente, bolborrado) FROM stdin;
12	1	33	0
13	1	34	0
14	2	34	0
15	3	33	0
16	2	35	0
17	4	35	0
18	8	38	0
20	10	44	0
21	8	47	0
22	11	46	0
23	12	48	0
24	12	49	0
25	12	41	0
26	3	39	0
27	11	50	0
28	11	53	0
29	11	51	0
30	11	55	0
31	11	54	0
32	11	57	0
33	12	59	0
34	12	60	0
35	8	62	0
36	12	64	0
37	12	65	0
38	13	63	0
39	8	66	0
40	11	67	0
41	8	69	0
42	8	70	0
\.


--
-- Data for Name: tblproexpediente_actuaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_actuaciones (id_proexpediente_actuaciones, id_tipo_actuacion, id_actuacion, id_escrito, strobservacion, id_proexpediente, fecactuacion, bolborrado, strdescripcionactuacion, strexpedientetribunal) FROM stdin;
14	13941	13955	16	A	22	2013-01-21	0	<div style="text-align: center;"><u><b>DECLARACI&Oacute;N JURADA DE NO POSEER VIVIENDA</b></u></div><div style="text-align: justify;">Yo, <b>KELLY MILENA SANDOVAL ROJAS</b>, Venezolano, mayor de edad, titular de la C&eacute;dula Identidad N&ordm; V-<b>17.254.816</b>, de este domicilio, a los fines de dar cumplimiento a lo establecido en el art&iacute;culo 252 de la Ley de R&eacute;gimen Prestacional de Vivienda y H&aacute;bitat, publicada en la Gaceta Oficial de la Rep&uacute;blica Bolivariana de Venezuela N&ordm; 38.182 de fecha 9 de Mayo de 2005, reimpresa por error material en Gaceta Oficial de la Rep&uacute;blica Bolivariana de Venezuela N&ordm; 38.204 de fecha 08 de Junio de 2005, declaro lo siguiente: <b>Primero</b>: Que actualmente no soy propietario de ninguna vivienda, ni soy beneficiario de asistencia habitacional alguna, ni coparticipante de una cooperativa o asociaci&oacute;n para adquirir vivienda y que si con posterioridad al otorgamiento del cr&eacute;dito para adquisici&oacute;n de vivienda que estoy solicitando se llegare a comprobar que soy propietario de otra vivienda, quedar&eacute; obligado a restituir de inmediato la totalidad del pr&eacute;stamo solicitado. <b>Segundo</b>: Que la vivienda que tengo pactada adquirir (construir &ndash; auto construir) constituir&aacute; mi &uacute;nica vivienda principal, la cual me obligo a habitar. Con el otorgamiento de este documento, juro que lo antes expuesto es cierto. En la Ciudad de San Felipe, a la fecha de su autenticaci&oacute;n.<br />&nbsp;</div><div style="text-align: center;">_______________________________________<br /><b>KELLY MILENA SANDOVAL ROJAS<br />C.I. N&ordm;V-17.254.816<br /></b></div><br />	
15	13941	13955	16	a	23	2013-01-21	0	<div style="text-align: center;"><u><b>DECLARACI&Oacute;N JURADA DE NO POSEER VIVIENDA</b></u></div><div style="text-align: justify;">Yo,<b>GABY LYA GARCIA AGUIAR</b>, Venezolana, mayor de edad, titular de la C&eacute;dula Identidad N&ordm; V-<b>16.483.620</b>, de este domicilio, a los fines de dar cumplimiento a lo establecido en el art&iacute;culo 252 de la Ley de R&eacute;gimen Prestacional de Vivienda y H&aacute;bitat, publicada en la Gaceta Oficial de la Rep&uacute;blica Bolivariana de Venezuela N&ordm; 38.182 de fecha 9 de Mayo de 2005, reimpresa por error material en Gaceta Oficial de la Rep&uacute;blica Bolivariana de Venezuela N&ordm; 38.204 de fecha 08 de Junio de 2005, declaro lo siguiente: <b>Primero</b>: Que actualmente no soy propietaria de ninguna vivienda, ni soy beneficiaria de asistencia habitacional alguna, ni coparticipante de una cooperativa o asociaci&oacute;n para adquirir vivienda y que si con posterioridad al otorgamiento del cr&eacute;dito para adquisici&oacute;n de vivienda que estoy solicitando se llegare a comprobar que soy propietaria de otra vivienda, quedar&eacute; obligada a restituir de inmediato la totalidad del pr&eacute;stamo solicitado. <b>Segundo</b>: Que la vivienda que tengo pactada adquirir (construir &ndash; auto construir) constituir&aacute; mi &uacute;nica vivienda principal, la cual me obligo a habitar. Con el otorgamiento de este documento, juro que lo antes expuesto es cierto. En la Ciudad de San Felipe, a la fecha de su autenticaci&oacute;n.<br />&nbsp;</div><div style="text-align: center;">_______________________________________<br /><b>GABY LYA GARCIA AGUIAR<br />C.I. N&ordm; V-16.483.620<br /></b></div><br />	
\.


--
-- Data for Name: tblproexpediente_fases; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_fases (id_proexpediente_fase, id_tipo_fase, id_fase, strobservacion, id_proexpediente, fecfase, bolborrado) FROM stdin;
12	13132	13978	se debe entregar a la notaria	23	2013-01-21	0
\.


--
-- Data for Name: tblproexpediente_hijos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_hijos (id_hijos, id_proexpediente, id_sexo, nombrehijo, cedulahijo, fecnachijo, bolborrado) FROM stdin;
9	10	12961	Santiago Suarez	12345678	2012-11-25	0
10	9	12962	dos	345	2012-11-02	0
11	11	12962	valeria	234	2012-11-25	0
12	16	12962	lore coello	45678	2012-11-06	0
13	16	12961	v,mfv	12344	2012-11-06	0
\.


--
-- Data for Name: tblproexpediente_personas_demandadas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_personas_demandadas (id_proexpediente_personas_demandadas, id_contrarios, id_proexpediente, bolborrado) FROM stdin;
15	4	33	0
16	5	33	0
17	9	33	0
18	4	34	0
19	4	35	0
20	5	35	0
21	4	37	0
22	5	37	0
23	18	38	0
24	19	38	0
25	58	40	0
26	89	39	0
27	63	41	0
28	23	37	0
29	15	34	0
30	15	42	0
31	34	43	0
32	188	45	0
33	185	47	0
34	107	46	0
35	116	48	0
36	183	49	0
37	22	33	0
40	68	41	0
41	70	41	0
42	71	41	0
43	72	41	0
44	73	41	0
45	76	41	0
46	78	41	0
47	81	41	0
48	83	41	0
49	86	41	0
50	84	41	0
51	85	41	0
52	87	41	0
53	66	41	0
54	36	43	0
55	50	43	0
56	52	43	0
57	17	50	0
58	25	50	0
59	26	50	0
60	39	43	0
61	27	50	0
62	29	50	0
63	54	43	0
64	30	50	0
65	55	51	0
66	57	51	0
67	59	51	0
68	60	51	0
69	62	51	0
70	65	51	0
71	37	52	0
72	40	52	0
73	42	52	0
74	44	52	0
75	67	51	0
76	45	52	0
77	46	52	0
78	47	52	0
79	48	52	0
80	69	51	0
81	74	53	0
82	75	53	0
83	77	53	0
84	80	53	0
85	79	54	0
86	252	55	0
87	255	56	0
88	253	57	0
89	256	59	0
90	251	58	0
91	259	60	0
92	264	62	0
93	248	63	0
94	271	64	0
95	273	64	0
96	274	65	0
97	275	66	0
98	220	67	0
99	166	68	0
100	276	69	0
101	175	70	0
\.


--
-- Data for Name: tblproexpediente_situaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproexpediente_situaciones (id_proexpediente_situacion, id_tipo_minuta, id_minuta, strobservacion, id_proexpediente, fecminuta, bolborrado, id_estado_minuta) FROM stdin;
25	0	0	Caso Abierto	21	2013-01-21	0	0
26	0	0	Caso Abierto	22	2013-01-21	0	0
27	0	0	Caso Abierto	23	2013-01-21	0	0
28	0	0	Caso Abierto	24	2013-01-14	0	0
29	0	0	Caso Abierto	25	2013-01-14	0	0
30	0	0	Caso Abierto	26	2013-01-14	0	0
\.


--
-- Data for Name: tblprohonorarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblprohonorarios (id_honorarios, id_tipo, id_tramite, id_unidad, numunidad, modulo) FROM stdin;
12	13775	13782	1	2	LTG
13	13777	13782	1	5	LTG
14	13041	13809	1	10	OAS
15	13034	13809	1	10	OAS
6	13034	13011	1	5	OAS
4	13041	13011	1	5	OAS
7	13009	13011	1	5	OAS
16	13009	13092	1	60	OAS
8	13091	13011	1	5	OAS
9	13086	13011	2	5	OAS
17	13086	13092	1	80	OAS
18	13811	13809	1	10	OAS
19	13808	13011	1	5	OAS
20	13808	13092	1	60	OAS
22	13035	13011	1	5	OAS
23	13035	13092	1	25	OAS
24	13087	13011	1	5	OAS
25	13087	13809	1	10	OAS
26	13085	13011	1	5	OAS
27	13085	13809	1	10	OAS
29	13090	13809	1	5	OAS
30	13043	13809	1	25	OAS
31	13037	13809	2	5	OAS
\.


--
-- Data for Name: tblprohonorarios_litigio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblprohonorarios_litigio (id_honorarios, id_tipo, id_tramite, id_unidad, numunidad) FROM stdin;
\.


--
-- Data for Name: tblprojuzgados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblprojuzgados (id_juzgados, strnombre, strdireccion, strlocalidad, idestado, idmunicipio, strtelefono, strfax, strobservaciones) FROM stdin;
3	2do Juzgado Administrativo	san felipe	niguna	12936	12939	(2345) 678.90.78	(1234) 567.89.08	12939
2	1er Juzgado Administrativo	5ta av con calle caracas	san felipe	12936	12944	(3456) 789.07.88	(1234) 567.89.07	12944
\.


--
-- Data for Name: tblrutaactividad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblrutaactividad (id_ruta, id_actividad, dtmruta, id_estatus_maestro, memruta, id_contacto, bolborrado) FROM stdin;
\.


--
-- Data for Name: tblrutacorresp; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblrutacorresp (id_rutacorresp, id_corresp, dtmrutacorresp, id_estatus_maestro, memrutacorresp, id_contacto, bolborrado) FROM stdin;
36	17	2012-05-07 15:45:40.120586-04:30	234	<b><u>Destinatarios</u></b><br>Coordinacion de Informatíca<br><b><u>CC</u></b><br>Sin CC<br><b><u>CCO</u></b><br>Sin CCO<br>	235	0
37	17	2012-05-07 15:47:49.849874-04:30	237		235	0
38	17	2012-05-07 15:48:09.630325-04:30	237		672	0
39	17	2012-05-07 15:48:40.129038-04:30	237		235	0
40	18	2012-05-07 16:01:54.194081-04:30	234	<b><u>Destinatarios</u></b><br>Despacho del Procurador<br><b><u>CC</u></b><br>Sin CC<br><b><u>CCO</u></b><br>Sin CCO<br>	672	0
41	18	2012-05-07 16:02:07.867637-04:30	236		672	0
42	18	2012-05-07 16:02:17.641483-04:30	237		235	0
43	18	2012-05-07 16:03:04.888305-04:30	237		235	0
44	19	2012-05-07 16:03:25.404839-04:30	234	<b><u>Destinatarios</u></b><br><b><u>CC</u></b><br>Sin CC<br><b><u>CCO</u></b><br>Sin CCO<br>	235	0
45	19	2012-05-07 16:03:25.747789-04:30	236		235	0
46	19	2012-05-07 16:03:42.542012-04:30	237		672	0
47	18	2012-05-07 16:03:55.149007-04:30	237		235	0
48	19	2012-05-07 16:04:25.649206-04:30	237		235	0
49	19	2012-05-07 16:04:35.335383-04:30	237		235	0
50	17	2012-05-07 16:04:38.304272-04:30	237		235	0
51	17	2012-05-07 16:04:54.64985-04:30	237		672	0
52	17	2012-05-07 16:06:41.251087-04:30	237		235	0
53	17	2012-05-07 16:12:19.834695-04:30	237		235	0
54	19	2012-05-07 16:12:32.534408-04:30	237		235	0
55	17	2012-05-07 16:44:41.300234-04:30	237		235	0
56	18	2012-05-07 16:44:45.065209-04:30	237		672	0
57	19	2012-05-07 16:45:10.242526-04:30	237		672	0
58	17	2012-05-07 16:45:36.985174-04:30	237		235	0
59	18	2012-05-07 16:45:50.23336-04:30	237		235	0
60	19	2012-05-15 08:50:35.617615-04:30	237		672	0
61	19	2012-05-15 09:16:57.550226-04:30	237		672	0
62	18	2012-06-26 11:28:01.065204-04:30	237		672	0
63	19	2012-06-26 11:28:27.0458-04:30	237		672	0
64	19	2012-06-26 11:28:50.621745-04:30	256	<b>juegp(Id: 2)</b> del documento: <b>DP/1/2012 (19)</b>	672	0
65	19	2012-06-26 11:29:41.040852-04:30	258	<b>juegp(Id: 2)</b>	672	0
66	20	2012-12-17 17:51:14.448554-04:30	234	<b><u>Destinatarios</u></b><br>Litigio y Representaciones<br><b><u>CC</u></b><br>Sin CC<br><b><u>CCO</u></b><br>Sin CCO<br>	672	0
67	20	2012-12-17 17:51:14.863892-04:30	236		672	0
68	18	2012-12-17 17:51:25.623887-04:30	237		672	0
69	21	2012-12-17 17:53:29.168753-04:30	234	<b><u>Destinatarios</u></b><br>Coordinacion de Informatíca<br><b><u>CC</u></b><br>Sin CC<br><b><u>CCO</u></b><br>Sin CCO<br>	235	0
70	21	2012-12-17 17:53:29.52463-04:30	236		235	0
71	21	2012-12-17 17:54:01.603432-04:30	237		672	0
72	21	2012-12-17 17:54:13.535727-04:30	237		672	0
\.


--
-- Data for Name: tblunidadtributaria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblunidadtributaria (id_unidad, intprecio, ano) FROM stdin;
1	90.00	2012
2	90.00	2013
\.


--
-- Data for Name: tblvalidacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblvalidacion (id_validacion, dtmfecha, codigo_validacion, id_contacto, id_corresp, bolborrado) FROM stdin;
14	2012-05-07	4fa83147e24af	672	18	0
15	2012-05-07	4fa83195c474e	235	19	0
16	2012-12-17	50cf9adae0ea4	672	20	0
17	2012-12-17	50cf9b618d454	235	21	0
\.


--
-- Name: pd_tbl_abogados; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_abogados
    ADD CONSTRAINT pd_tbl_abogados PRIMARY KEY (id_abogado);


--
-- Name: pk_contacto_externo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcontactoexterno
    ADD CONSTRAINT pk_contacto_externo PRIMARY KEY (id_contacto_externo);


--
-- Name: pk_id_agenda; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblagenda
    ADD CONSTRAINT pk_id_agenda PRIMARY KEY (id_agenda);


--
-- Name: pk_id_agenda_litigio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblagenda_litigio
    ADD CONSTRAINT pk_id_agenda_litigio PRIMARY KEY (id_agenda);


--
-- Name: pk_id_dictamen; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbldictamenes
    ADD CONSTRAINT pk_id_dictamen PRIMARY KEY (id_dictamen);


--
-- Name: pk_id_documento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbldocumento
    ADD CONSTRAINT pk_id_documento PRIMARY KEY (id_documento);


--
-- Name: pk_id_documento_seguimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbldocumento_seguimiento
    ADD CONSTRAINT pk_id_documento_seguimiento PRIMARY KEY (id_documento_seguimiento);


--
-- Name: pk_id_hijos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_hijos
    ADD CONSTRAINT pk_id_hijos PRIMARY KEY (id_hijos);


--
-- Name: pk_id_honorarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblprohonorarios
    ADD CONSTRAINT pk_id_honorarios PRIMARY KEY (id_honorarios);


--
-- Name: pk_id_honorarios_litigio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblprohonorarios_litigio
    ADD CONSTRAINT pk_id_honorarios_litigio PRIMARY KEY (id_honorarios);


--
-- Name: pk_id_jusgados; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblprojuzgados
    ADD CONSTRAINT pk_id_jusgados PRIMARY KEY (id_juzgados);


--
-- Name: pk_id_litigio_actuaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproactuaciones_litigio
    ADD CONSTRAINT pk_id_litigio_actuaciones PRIMARY KEY (id_litigio_actuaciones);


--
-- Name: pk_id_proactuacion_fase; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblactuacion_fases
    ADD CONSTRAINT pk_id_proactuacion_fase PRIMARY KEY (id_proactuacion_fase);


--
-- Name: pk_id_proactuacion_situaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblactuacion_situaciones
    ADD CONSTRAINT pk_id_proactuacion_situaciones PRIMARY KEY (id_proactuacion_situacion);


--
-- Name: pk_id_proactuaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproactuaciones
    ADD CONSTRAINT pk_id_proactuaciones PRIMARY KEY (id_proactuaciones);


--
-- Name: pk_id_proexpediente_actuaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_actuaciones
    ADD CONSTRAINT pk_id_proexpediente_actuaciones PRIMARY KEY (id_proexpediente_actuaciones);


--
-- Name: pk_id_proexpediente_fase; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_fases
    ADD CONSTRAINT pk_id_proexpediente_fase PRIMARY KEY (id_proexpediente_fase);


--
-- Name: pk_id_proexpediente_situaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_situaciones
    ADD CONSTRAINT pk_id_proexpediente_situaciones PRIMARY KEY (id_proexpediente_situacion);


--
-- Name: pk_id_unidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblunidadtributaria
    ADD CONSTRAINT pk_id_unidad PRIMARY KEY (id_unidad);


--
-- Name: pk_proabogadoscasos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproabogadoscasos
    ADD CONSTRAINT pk_proabogadoscasos PRIMARY KEY (id_proabogadoscasos);


--
-- Name: pk_proclientes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_clientes
    ADD CONSTRAINT pk_proclientes PRIMARY KEY (id_cliente);


--
-- Name: pk_proexpediente_personas_demandadas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_personas_demandadas
    ADD CONSTRAINT pk_proexpediente_personas_demandadas PRIMARY KEY (id_proexpediente_personas_demandadas);


--
-- Name: pk_tbl_abogados_contrarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_abogados_contrarios
    ADD CONSTRAINT pk_tbl_abogados_contrarios PRIMARY KEY (id_abogadoscon);


--
-- Name: pk_tbl_abogados_representantes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_abogados_representantes
    ADD CONSTRAINT pk_tbl_abogados_representantes PRIMARY KEY (id_abogado);


--
-- Name: pk_tbl_contrarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_contrarios
    ADD CONSTRAINT pk_tbl_contrarios PRIMARY KEY (id_contrarios);


--
-- Name: pk_tblaccesoforma; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblaccesoforma
    ADD CONSTRAINT pk_tblaccesoforma PRIMARY KEY (id_accesoforma);


--
-- Name: pk_tblactividades; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblactividades
    ADD CONSTRAINT pk_tblactividades PRIMARY KEY (id_actividad);


--
-- Name: pk_tbladjunto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbladjunto
    ADD CONSTRAINT pk_tbladjunto PRIMARY KEY (id_adjunto);


--
-- Name: pk_tbladjunto_documento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbladjunto_documento
    ADD CONSTRAINT pk_tbladjunto_documento PRIMARY KEY (id_adjunto);


--
-- Name: pk_tblasociaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblasociaciones
    ADD CONSTRAINT pk_tblasociaciones PRIMARY KEY (lngcodigo_asociacion);


--
-- Name: pk_tblautorizado_est; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblautorizado_est
    ADD CONSTRAINT pk_tblautorizado_est PRIMARY KEY (id_autorizados_est);


--
-- Name: pk_tblcontacto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcontacto
    ADD CONSTRAINT pk_tblcontacto PRIMARY KEY (id_contacto);


--
-- Name: pk_tblcontactoactividad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcontactoactividad
    ADD CONSTRAINT pk_tblcontactoactividad PRIMARY KEY (id_contactoactividad);


--
-- Name: pk_tblcontactoprofile; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcontactoprofile
    ADD CONSTRAINT pk_tblcontactoprofile PRIMARY KEY (id_contactoprofile);


--
-- Name: pk_tblcorrelativo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcorrelativo
    ADD CONSTRAINT pk_tblcorrelativo PRIMARY KEY (id_correlativo);


--
-- Name: pk_tblcorrespondencias; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcorrespondencias
    ADD CONSTRAINT pk_tblcorrespondencias PRIMARY KEY (id_corresp);


--
-- Name: pk_tbldemandantes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_demandantes
    ADD CONSTRAINT pk_tbldemandantes PRIMARY KEY (lngcodigo);


--
-- Name: pk_tbldepartamentoactividad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbldepartamentoactividad
    ADD CONSTRAINT pk_tbldepartamentoactividad PRIMARY KEY (id_departamentoactividad);


--
-- Name: pk_tbldestinatarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbldestinatarios
    ADD CONSTRAINT pk_tbldestinatarios PRIMARY KEY (id_destinatarios);


--
-- Name: pk_tbldetallecontactoactividad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbldetallecontactoactividad
    ADD CONSTRAINT pk_tbldetallecontactoactividad PRIMARY KEY (id_detallecontactoactividad);


--
-- Name: pk_tblestados; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblestados
    ADD CONSTRAINT pk_tblestados PRIMARY KEY (id_estados);


--
-- Name: pk_tblexpediente_referido; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_expediente_referidos
    ADD CONSTRAINT pk_tblexpediente_referido PRIMARY KEY (lngcodigo);


--
-- Name: pk_tblfirmaautorizada; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblfirmaautorizada
    ADD CONSTRAINT pk_tblfirmaautorizada PRIMARY KEY (id_firma);


--
-- Name: pk_tblmaestros; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblmaestros
    ADD CONSTRAINT pk_tblmaestros PRIMARY KEY (id_maestro);


--
-- Name: pk_tblmaestros_sistemas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblmaestros_sistemas
    ADD CONSTRAINT pk_tblmaestros_sistemas PRIMARY KEY (id_maestro);


--
-- Name: pk_tblnotas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblnotas
    ADD CONSTRAINT pk_tblnotas PRIMARY KEY (id_notas);


--
-- Name: pk_tblproactuaciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblactuaciones
    ADD CONSTRAINT pk_tblproactuaciones PRIMARY KEY (id_proactuacion);


--
-- Name: pk_tblproclientecasos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproclientecasos
    ADD CONSTRAINT pk_tblproclientecasos PRIMARY KEY (id_proclientecasos);


--
-- Name: pk_tblproexpediente; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente
    ADD CONSTRAINT pk_tblproexpediente PRIMARY KEY (id_proexpediente);


--
-- Name: pk_tblproexpediente_abogados; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_abogados
    ADD CONSTRAINT pk_tblproexpediente_abogados PRIMARY KEY (id_proexpediente_abogados);


--
-- Name: pk_tblproexpediente_abogados_demandantes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_abogados_demandantes
    ADD CONSTRAINT pk_tblproexpediente_abogados_demandantes PRIMARY KEY (id_proexpediente_abogados_demandantes);


--
-- Name: pk_tblproexpediente_abogados_ejecutores; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_abogados_ejecutores
    ADD CONSTRAINT pk_tblproexpediente_abogados_ejecutores PRIMARY KEY (id_proexpediente_abogados_ejecutores);


--
-- Name: pk_tblproexpediente_abogados_representantes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproexpediente_abogados_representantes
    ADD CONSTRAINT pk_tblproexpediente_abogados_representantes PRIMARY KEY (id_proexpediente_abogados_representantes);


--
-- Name: pk_tblruta; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblrutaactividad
    ADD CONSTRAINT pk_tblruta PRIMARY KEY (id_ruta);


--
-- Name: pk_tblrutacorresp; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblrutacorresp
    ADD CONSTRAINT pk_tblrutacorresp PRIMARY KEY (id_rutacorresp);


--
-- Name: pk_validacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblvalidacion
    ADD CONSTRAINT pk_validacion PRIMARY KEY (id_validacion);


--
-- Name: fk_estfinal_maestros; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblestados
    ADD CONSTRAINT fk_estfinal_maestros FOREIGN KEY (id_estfinal_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_estinicial_maestros; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblestados
    ADD CONSTRAINT fk_estinicial_maestros FOREIGN KEY (id_estinicial_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_id_proactuacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactuacion_fases
    ADD CONSTRAINT fk_id_proactuacion FOREIGN KEY (id_proactuacion) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_id_proactuacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactuacion_situaciones
    ADD CONSTRAINT fk_id_proactuacion FOREIGN KEY (id_proactuacion) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_id_proactuacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproactuaciones_litigio
    ADD CONSTRAINT fk_id_proactuacion FOREIGN KEY (id_proactuacion) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_situaciones
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblproexpediente(id_proexpediente);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_fases
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblproexpediente(id_proexpediente);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_actuaciones
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblproexpediente(id_proexpediente);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblproexpediente(id_proexpediente);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados_demandantes
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados_ejecutores
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_abogados_representantes
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_id_proexpediente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproexpediente_personas_demandadas
    ADD CONSTRAINT fk_id_proexpediente FOREIGN KEY (id_proexpediente) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_meestados_maestros; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblestados
    ADD CONSTRAINT fk_meestados_maestros FOREIGN KEY (id_meestados_maestros) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblactividades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblnotas
    ADD CONSTRAINT fk_tblactividades FOREIGN KEY (id_actividad) REFERENCES tblactividades(id_actividad);


--
-- Name: fk_tblactividades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblrutaactividad
    ADD CONSTRAINT fk_tblactividades FOREIGN KEY (id_actividad) REFERENCES tblactividades(id_actividad);


--
-- Name: fk_tblactividades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontactoactividad
    ADD CONSTRAINT fk_tblactividades FOREIGN KEY (id_actividad) REFERENCES tblactividades(id_actividad);


--
-- Name: fk_tblactividades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladjunto
    ADD CONSTRAINT fk_tblactividades FOREIGN KEY (id_actividad) REFERENCES tblactividades(id_actividad);


--
-- Name: fk_tblactividades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldepartamentoactividad
    ADD CONSTRAINT fk_tblactividades FOREIGN KEY (id_actividad) REFERENCES tblactividades(id_actividad);


--
-- Name: fk_tblactuaciones; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladjunto_documento
    ADD CONSTRAINT fk_tblactuaciones FOREIGN KEY (id_proexpediente) REFERENCES tblactuaciones(id_proactuacion);


--
-- Name: fk_tblautorizado_estados; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblautorizado_est
    ADD CONSTRAINT fk_tblautorizado_estados FOREIGN KEY (id_estados) REFERENCES tblestados(id_estados);


--
-- Name: fk_tblautorizado_perfil_maestro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblautorizado_est
    ADD CONSTRAINT fk_tblautorizado_perfil_maestro FOREIGN KEY (id_perfil_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontactoprofile
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrespondencias
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblfirmaautorizada
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblrutacorresp
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblnotas
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblrutaactividad
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontactoactividad
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblvalidacion
    ADD CONSTRAINT fk_tblcontacto FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontacto_asigna; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontactoactividad
    ADD CONSTRAINT fk_tblcontacto_asigna FOREIGN KEY (id_contacto) REFERENCES tblcontacto(id_contacto);


--
-- Name: fk_tblcontactoactividad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldetallecontactoactividad
    ADD CONSTRAINT fk_tblcontactoactividad FOREIGN KEY (id_contactoactividad) REFERENCES tblcontactoactividad(id_contactoactividad);


--
-- Name: fk_tblcorrespondencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblvalidacion
    ADD CONSTRAINT fk_tblcorrespondencia FOREIGN KEY (id_corresp) REFERENCES tblcorrespondencias(id_corresp);


--
-- Name: fk_tblcorrespondencias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldestinatarios
    ADD CONSTRAINT fk_tblcorrespondencias FOREIGN KEY (id_corresp) REFERENCES tblcorrespondencias(id_corresp);


--
-- Name: fk_tblcorrespondencias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblfirmaautorizada
    ADD CONSTRAINT fk_tblcorrespondencias FOREIGN KEY (id_corresp) REFERENCES tblcorrespondencias(id_corresp);


--
-- Name: fk_tblcorrespondencias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblrutacorresp
    ADD CONSTRAINT fk_tblcorrespondencias FOREIGN KEY (id_corresp) REFERENCES tblcorrespondencias(id_corresp);


--
-- Name: fk_tblcorrespondencias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblnotas
    ADD CONSTRAINT fk_tblcorrespondencias FOREIGN KEY (id_corresp) REFERENCES tblcorrespondencias(id_corresp);


--
-- Name: fk_tblcorrespondencias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladjunto
    ADD CONSTRAINT fk_tblcorrespondencias FOREIGN KEY (id_corresp) REFERENCES tblcorrespondencias(id_corresp);


--
-- Name: fk_tbldestinatarios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactividades
    ADD CONSTRAINT fk_tbldestinatarios FOREIGN KEY (id_destinatarios) REFERENCES tbldestinatarios(id_destinatarios);


--
-- Name: fk_tblmaestro_menu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblaccesoforma
    ADD CONSTRAINT fk_tblmaestro_menu FOREIGN KEY (id_menu_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestro_profile; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblaccesoforma
    ADD CONSTRAINT fk_tblmaestro_profile FOREIGN KEY (id_profile_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldepartamentoactividad
    ADD CONSTRAINT fk_tblmaestros FOREIGN KEY (id_departamento_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_cargo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontacto
    ADD CONSTRAINT fk_tblmaestros_cargo FOREIGN KEY (id_cargo_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_dpto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrespondencias
    ADD CONSTRAINT fk_tblmaestros_dpto FOREIGN KEY (id_unidad_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_estatus; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontacto
    ADD CONSTRAINT fk_tblmaestros_estatus FOREIGN KEY (id_estatus_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_estatus; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrespondencias
    ADD CONSTRAINT fk_tblmaestros_estatus FOREIGN KEY (id_estatus_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_estatus; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldestinatarios
    ADD CONSTRAINT fk_tblmaestros_estatus FOREIGN KEY (id_estatus_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_estatus; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblrutacorresp
    ADD CONSTRAINT fk_tblmaestros_estatus FOREIGN KEY (id_estatus_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_estatus; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactividades
    ADD CONSTRAINT fk_tblmaestros_estatus FOREIGN KEY (id_estatus_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_estatus; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblrutaactividad
    ADD CONSTRAINT fk_tblmaestros_estatus FOREIGN KEY (id_estatus_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_gerencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrelativo
    ADD CONSTRAINT fk_tblmaestros_gerencia FOREIGN KEY (id_gerencia_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_gerencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldestinatarios
    ADD CONSTRAINT fk_tblmaestros_gerencia FOREIGN KEY (id_destino_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_prioridad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblactividades
    ADD CONSTRAINT fk_tblmaestros_prioridad FOREIGN KEY (id_prioridad_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_profile; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontactoprofile
    ADD CONSTRAINT fk_tblmaestros_profile FOREIGN KEY (id_profile_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcontacto
    ADD CONSTRAINT fk_tblmaestros_tipo FOREIGN KEY (id_tipo_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrelativo
    ADD CONSTRAINT fk_tblmaestros_tipo FOREIGN KEY (id_tipo_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrespondencias
    ADD CONSTRAINT fk_tblmaestros_tipo FOREIGN KEY (id_tipo_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_tipocorresp; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcorrespondencias
    ADD CONSTRAINT fk_tblmaestros_tipocorresp FOREIGN KEY (id_tipocorresp_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_tipoenvio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbldestinatarios
    ADD CONSTRAINT fk_tblmaestros_tipoenvio FOREIGN KEY (id_tipoenvio_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: fk_tblmaestros_tiponota; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblnotas
    ADD CONSTRAINT fk_tblmaestros_tiponota FOREIGN KEY (id_tiponota_maestro) REFERENCES tblmaestros(id_maestro);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: tbladjunto; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbladjunto FROM PUBLIC;
REVOKE ALL ON TABLE tbladjunto FROM postgres;
GRANT ALL ON TABLE tbladjunto TO postgres;


--
-- Name: tbladjunto_documento; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbladjunto_documento FROM PUBLIC;
REVOKE ALL ON TABLE tbladjunto_documento FROM postgres;
GRANT ALL ON TABLE tbladjunto_documento TO postgres;


--
-- Name: tblcorrespondencias; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tblcorrespondencias FROM PUBLIC;
REVOKE ALL ON TABLE tblcorrespondencias FROM postgres;
GRANT ALL ON TABLE tblcorrespondencias TO postgres;


--
-- PostgreSQL database dump complete
--

