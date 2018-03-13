CREATE SEQUENCE spoa_portal.inconsistencia_id_inconsistencia_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;
    
CREATE TABLE spoa_portal.inconsistencia (
    id_inconsistencia integer NOT NULL DEFAULT nextval('spoa_portal.inconsistencia_id_inconsistencia_seq'::regclass),
    tx_inconsistencia character varying(500) COLLATE pg_catalog."default" NOT NULL,
    no_campo character varying(500) COLLATE pg_catalog."default" NOT NULL,
    no_tabela character varying(500) COLLATE pg_catalog."default" NOT NULL,
    tx_tipo_campo character varying(500) COLLATE pg_catalog."default" NOT NULL,
    no_usuario character varying(500) COLLATE pg_catalog."default" NOT NULL    
);