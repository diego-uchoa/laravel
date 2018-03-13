CREATE OR REPLACE FUNCTION spoa_portal.verifica_tabela_pk()
RETURNS void AS $$
DECLARE
    C_INCONSISTENCIA CURSOR IS
    select TABLE_NAME, TABLE_SCHEMA from information_schema.tables tabs where table_name NOT IN 
    (SELECT distinct cons.table_name FROM information_schema.table_constraints cons, information_schema.columns cols
    where constraint_type = 'PRIMARY KEY'
    and cons.table_name = cols.table_name
    and cons.constraint_schema = cols.table_schema
    and (cols.table_schema like 'spoa%' or cols.table_schema = 'mf'))
    and (tabs.table_schema like 'spoa%' or tabs.table_schema = 'mf');
           
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
            'TABELA SEM CHAVE PRIMARIA',
            '',
            R_INCONSISTENCIA.TABLE_NAME,
            '',
            R_INCONSISTENCIA.TABLE_SCHEMA
        );
       
  END LOOP;
  
    
END;
$$ LANGUAGE plpgsql;