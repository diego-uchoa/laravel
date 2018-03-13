CREATE OR REPLACE FUNCTION spoa_portal.verifica_fk()
RETURNS void AS $$
DECLARE
    C_INCONSISTENCIA CURSOR IS
    SELECT cons.table_name, cons.constraint_name, cons.constraint_schema FROM information_schema.table_constraints cons
    where cons.constraint_type = 'FOREIGN KEY'
    and  constraint_name !~* '^\w+_foreign$'  /* '^(FK)_.+_\d+$' */
    and (cons.table_schema like 'spoa%' or cons.table_schema = 'mf');
           
BEGIN

  FOR R_INCONSISTENCIA IN C_INCONSISTENCIA LOOP
        
        insert into spoa_portal.inconsistencia
        ( TX_INCONSISTENCIA,
          NO_CAMPO,
          NO_TABELA,
          TX_TIPO_CAMPO,
          NO_USUARIO
        )
        values ( 
           'FK_INVALIDO',
           R_INCONSISTENCIA.CONSTRAINT_NAME,
           R_INCONSISTENCIA.TABLE_NAME,
           '',
           R_INCONSISTENCIA.CONSTRAINT_SCHEMA
        );
       
  END LOOP;
      
    
END;
$$ LANGUAGE plpgsql;