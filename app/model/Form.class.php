<?php
/**
 * Form Active Record
 * @author  <your-name-here>
 */
class Form extends TRecord
{
    const TABLENAME = 'form';
    const PRIMARYKEY= 'id_form';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $nmstatus = array('Criado','Aprovada','Inativado','Cancelado');
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('for_descricao');
        parent::addAttribute('for_sigla');
        parent::addAttribute('for_obs');
        parent::addAttribute('for_pontos');
        parent::addAttribute('id_tipo');
        parent::addAttribute('id_form_ori');
        parent::addAttribute('for_status');
    }

    public function get_for_status_nm() {
        return $this->nmstatus[$this->for_status];
    }

    public function get_tipos () {
        return new Tipos($this->id_tipo);
    }

}
