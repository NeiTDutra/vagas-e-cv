<?php
/**
 * Formacao Active Record
 * @author  <your-name-here>
 */
class Formacao extends TRecord
{
    const TABLENAME = 'formacao';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('curso');
        parent::addAttribute('instituicao');
        parent::addAttribute('status');
        parent::addAttribute('tipo');
        parent::addAttribute('dtini');
        parent::addAttribute('dtfim');
        parent::addAttribute('id_user');
    }


}
