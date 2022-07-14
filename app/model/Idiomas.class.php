<?php
/**
 * Idiomas Active Record
 * @author  <your-name-here>
 */
class Idiomas extends TRecord
{
    const TABLENAME = 'idiomas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE) {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('lingua');
        parent::addAttribute('compreensao');
        parent::addAttribute('escrita');
        parent::addAttribute('fala');
        parent::addAttribute('leitura');
        parent::addAttribute('id_user');
    }


}
