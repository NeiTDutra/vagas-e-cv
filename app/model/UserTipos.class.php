<?php
/**
 * UserTipos Active Record
 * @author  <your-name-here>
 */
class UserTipos extends TRecord
{
    const TABLENAME = 'user_tipos';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_user');
        parent::addAttribute('id_tipo');
    }


}
