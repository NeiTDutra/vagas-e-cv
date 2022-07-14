<?php
/**
 * Experiencias Active Record
 * @author  <your-name-here>
 */
class Experiencias extends TRecord
{
    const TABLENAME = 'experiencias';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    public $id_exp = 0;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('empresa');
        parent::addAttribute('cargo');
        parent::addAttribute('dtini');
        parent::addAttribute('dtfim');
        parent::addAttribute('atividade');
        parent::addAttribute('id_user');
        parent::addAttribute('atual');
    }


}
