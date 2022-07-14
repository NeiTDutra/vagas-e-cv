<?php
/**
 * Tipos Active Record
 * @author  <your-name-here>
 */
class Tipos extends TRecord
{
    const TABLENAME = 'tipos';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao');
        parent::addAttribute('sigla');
    }


}
