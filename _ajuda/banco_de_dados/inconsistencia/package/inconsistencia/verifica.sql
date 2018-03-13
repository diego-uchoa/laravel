CREATE OR REPLACE FUNCTION spoa_portal.verifica()
RETURNS void AS $$
BEGIN

  DELETE FROM spoa_portal.inconsistencia; 
  
  PERFORM spoa_portal.verifica_tabela_campos(); 
  PERFORM spoa_portal.verifica_tabela_pk(); 
  PERFORM spoa_portal.verifica_view();
  PERFORM spoa_portal.verifica_sq();
  PERFORM spoa_portal.verifica_trigger();
  PERFORM spoa_portal.verifica_fk();
  PERFORM spoa_portal.verifica_uk();
  PERFORM spoa_portal.verifica_ck();
    
END;
$$ LANGUAGE plpgsql;