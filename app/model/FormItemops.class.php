<?php
/**
 * FormItemops Active Record
 * @author  <your-name-here>
 */
class FormItemops extends TRecord
{
    const TABLENAME = 'form_itemops';
    const PRIMARYKEY= 'id_formitemops';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_formitem');
        parent::addAttribute('fio_descricao');
        parent::addAttribute('fio_sigla');
        parent::addAttribute('fio_status');
        parent::addAttribute('id_formitemops_ori');
        parent::addAttribute('fio_ponto');
        parent::addAttribute('fio_seq');
    }


}
