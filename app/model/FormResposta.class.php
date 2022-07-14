<?php
/**
 * FormResposta Active Record
 * @author  <your-name-here>
 */
class FormResposta extends TRecord
{
    const TABLENAME = 'form_resposta';
    const PRIMARYKEY= 'id_formresp';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_formitem');
        parent::addAttribute('id_form');
        parent::addAttribute('id_formitemops');
        parent::addAttribute('id_user');
        parent::addAttribute('frp_descricao');
        parent::addAttribute('frp_sigla');
        parent::addAttribute('frp_obs');
        parent::addAttribute('frp_data');
    }


}
