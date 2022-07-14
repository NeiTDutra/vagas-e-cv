<?php
/**
 * FormItem Active Record
 * @author  <your-name-here>
 */
class FormItem extends TRecord
{
    const TABLENAME = 'form_item';
    const PRIMARYKEY= 'id_formitem';
    const IDPOLICY =  'max'; // {max, serial}
    
    public static $nmtipo = array('Agrupador','Combobox','Radiobox','Checkbox','Texto','Data','Hora','Numérico');
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_form');
        parent::addAttribute('fit_descricao');
        parent::addAttribute('fit_sigla');
        parent::addAttribute('fit_obs');
        parent::addAttribute('fit_obriga');
        parent::addAttribute('fit_tipo');
        parent::addAttribute('id_formitem_ori');
        parent::addAttribute('fit_status');
        parent::addAttribute('id_formitem_pai');
        parent::addAttribute('fit_pontos');
        parent::addAttribute('fit_vlmin');
        parent::addAttribute('fit_vlmax');
        parent::addAttribute('fit_seq');
        parent::addAttribute('fit_mascara');
    }

    public static function getTipos () {
        return Self::$nmtipo;
    }

    public function get_nmtipo() {
        return Self::$nmtipo[$this->fit_tipo];
    }

    public function delFilhos() {
        FormItem::where('id_formitem_pai', '=', $this->id_formitem)->delete();
        $this->delOps();
    }

    public function delOps() {
        FormItemops::where('id_formitem', '=', $this->id_formitem)->delete();
    }

    public function getOpcoes()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id_formitem', '=', $this->id_formitem));  // aqui você define seu critério
        $repository = new TRepository('FormItemops');
        $ops = $repository->load($criteria);
        return $ops;
    }
}
