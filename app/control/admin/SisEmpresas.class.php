<?php
/**
 * SisEmpresas Active Record
 * @author  <your-name-here>
 */
class SisEmpresas extends TRecord
{
    const TABLENAME = 'sis_empresas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_empresa');
        parent::addAttribute('emp_chaveacesso');
        parent::addAttribute('emp_nomefantasia');
        parent::addAttribute('emp_razaosocial');
        parent::addAttribute('emp_regcreat');
        parent::addAttribute('emp_regupdated');
        parent::addAttribute('emp_regusuario');
        parent::addAttribute('id_pessoa');
        parent::addAttribute('id_user');
    }

    /**
     * Method set_sis_pessoas
     * Sample of usage: $sis_pessoas->sis_empresas = $object;
     * @param $object Instance of SisPessoas
     */
    public function set_sis_pessoas(SisPessoas $object)
    {
        $this->sis_pessoas = $object;
        $this->sis_pessoas_id = $object->id;
    }
    
    /**
     * Method get_sis_pessoas
     * Sample of usage: $sis_pessoas->sis_pessoas->attribute;
     * @returns SisPessoas instance
     */
    public function get_sis_pessoas()
    {
        // loads the associated object
        if (empty($this->sis_pessoas))
            $this->sis_pessoas = new SisPessoas($this->sis_pessoas_id);
    
        // returns the associated object
        return $this->sis_pessoas;
    }
}
