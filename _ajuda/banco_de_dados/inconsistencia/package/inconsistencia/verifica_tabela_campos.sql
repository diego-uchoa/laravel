CREATE OR REPLACE FUNCTION spoa_portal.verifica_tabela_campos()
RETURNS void AS $$
DECLARE
    C_INCONSISTENCIA CURSOR IS
    SELECT COLUMN_NAME,TABLE_NAME,DATA_TYPE,TABLE_SCHEMA FROM information_schema.columns
    WHERE ( (COLUMN_NAME !~* '^(ID|NR|VA|TE|CO|AN|DS|TX|NO|SG|AQ|SN|DT|IN)_\w{2}')
        AND (COLUMN_NAME <> 'created_at') AND (COLUMN_NAME <> 'updated_at') AND (COLUMN_NAME <> 'deleted_at'))
    AND (TABLE_SCHEMA like 'spoa%' OR TABLE_SCHEMA = 'mf');
    
    V_CAMPO text;
       
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
            'CAMPO_INVALIDO',
            R_INCONSISTENCIA.COLUMN_NAME,
            R_INCONSISTENCIA.TABLE_NAME,
            R_INCONSISTENCIA.DATA_TYPE,
            R_INCONSISTENCIA.TABLE_SCHEMA
        );
        
  END LOOP;

    
    
END;
$$ LANGUAGE plpgsql;