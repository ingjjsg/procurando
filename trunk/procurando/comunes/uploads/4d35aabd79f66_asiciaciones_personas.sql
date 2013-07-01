-- View: procomunal.tblasociaciones_personas_view

-- DROP VIEW procomunal.tblasociaciones_personas_view;

CREATE OR REPLACE VIEW procomunal.tblasociaciones_personas_view AS 
 SELECT tblasociaciones_personas.lngcodigo AS id_persona, tblasociaciones_personas.lngcodigo_asociacion AS id_asociacion
   FROM procomunal.tblasociaciones_personas;

ALTER TABLE procomunal.tblasociaciones_personas_view OWNER TO postgres;

