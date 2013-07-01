copy cedulas from '/home/informatica/Escritorio/data.csv' DELIMITER AS ';' NULL as '';

drop function cruce();

CREATE OR REPLACE FUNCTION cruce() RETURNS setof record AS $$ 
DECLARE 
rec RECORD;
rec1 record;
existe boolean;
BEGIN 
         for rec in SELECT cedula FROM cedulas  loop
		for rec1 in select p.cedula cedula,p.strnombre,p.strapellido,( SELECT a1.stritema
				FROM dblink('dbname=scsd port=5432 host=172.16.1.7 user=postgres password=dbadmin$yara$2010','select stritema,id_maestro from scsd.tblmaestros') as a1(stritema character varying,id_maestro integer) 
				WHERE a1.id_maestro = p.id_municipio) as municipio,( SELECT a1.stritema
				FROM dblink('dbname=scsd port=5432 host=172.16.1.7 user=postgres password=dbadmin$yara$2010','select stritema,id_maestro from scsd.tblmaestros') as a1(stritema character varying,id_maestro integer) 
				WHERE a1.id_maestro = a.id_organismo) as organismo, ( SELECT a1.stritema
				FROM dblink('dbname=scsd port=5432 host=172.16.1.7 user=postgres password=dbadmin$yara$2010','select stritema,id_maestro from scsd.tblmaestros') as a1(stritema character varying,id_maestro integer) 
				WHERE a1.id_maestro = a.id_ayuda) as tipo_ayuda,a.strcontenido as ayuda, ( SELECT stritema
				FROM dblink('dbname=scsd port=5432 host=172.16.1.7 user=postgres password=dbadmin$yara$2010','select stritema,id_maestro from scsd.tblmaestros') as a1(stritema character varying,id_maestro integer) 
				WHERE a1.id_maestro = a.id_estatus) as estatus from 
				dblink('dbname=scsd port=5432 host=172.16.1.7 user=postgres password=dbadmin$yara$2010','select lngcodigo,cedula, strnombre, strapellido,id_municipio from scsd.tblpersona') as p(lngcodigo integer,cedula character varying,strnombre character varying,strapellido character varying,id_municipio integer) , 
				dblink('dbname=scsd port=5432 host=172.16.1.7 user=postgres password=dbadmin$yara$2010','select lngcodigo,id_organismo,id_ayuda,id_estatus,strcontenido from scsd.tblayuda') as a(lngcodigo integer,id_organismo integer,id_ayuda integer,id_estatus integer,strcontenido text) 
				where cedula =rec.cedula and a.lngcodigo=p.lngcodigo loop
					if(rec1.cedula <>'') then 
						update cedulas set ayuda='SI' where cedula=rec1.cedula ;
					else 
						update cedulas set ayuda='no' ;
					end if;
					RETURN  next rec1;
		end loop;
         end loop;              
END;
$$ LANGUAGE plpgsql;

select * from cruce() as (cedula character varying,nombre character varying, apellido character varying,municipio character varying,organismo character varying,tipo_ayuda character varying, ayuda text,estatus character varying);
