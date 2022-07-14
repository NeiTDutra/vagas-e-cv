<?php
/**
 * FormItemFormList Form List
 * @author  <your name here>
 */
class FormItemForm extends TPage
{
    protected $form; // form
    protected $datagrid; // datagrid
    protected $pageNavigation;
    protected $loaded;
    protected $opcoes;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder('form_FormItem');
        $this->form->setFormTitle('Itens da Ficha');
        
        // create the form fields
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id_form', '=', TSession::getValue('id_form')));
        $id_form = new TDBUniqueSearch('id_form', 'permission', 'Form', 'id_form', 'for_descricao',null,$criteria);
        $id_form->setEditable(FALSE);
        $id_form->setValue(TSession::getValue('id_form'));

        $id_formitem = new TEntry('id_formitem');
        $fit_descricao = new TEntry('fit_descricao');
        $fit_sigla = new TEntry('fit_sigla');
        $fit_mascara = new TEntry('fit_mascara');
        $fit_obs = new TText('fit_obs');
        $fit_obriga = new TEntry('fit_obriga');
        $fit_tipo = new TCombo('fit_tipo');
        $fit_tipo->addItems(FormItem::getTipos());
        $fit_tipo->setChangeAction(new TAction(array($this ,'carregaCampos')));
        
        //$id_formitem_ori = new TEntry('id_formitem_ori');
        $fit_status = new TCombo('fit_status');
        $fit_status->addItems(['Criado','Cancelado']);
        $fit_status->setValue(0);
        $criteria = new TCriteria;
        $criteria->add(new TFilter('fit_tipo', '=', "0"));
        $id_formitem_pai = new TDBUniqueSearch('id_formitem_pai', 'permission', 'FormItem', 'id_formitem', 'fit_descricao',null, $criteria);
        $id_formitem_pai->setMinLength(1);
        $fit_pontos = new TEntry('fit_pontos');
        $fit_vlmin = new TEntry('fit_vlmin');
        $fit_vlmin->setNumericMask(2,',','.', true);
        $fit_vlmax = new TEntry('fit_vlmax');
        $fit_vlmax->setNumericMask(2,',','.', true);
        $fit_seq = new TEntry('fit_seq');

        // add the fields
        $this->form->addFields( [ new TLabel('Ficha:') ], [ $id_form ], [ new TLabel('Código Item:') ], [ $id_formitem ] );
        $this->form->addFields( [ new TLabel('Tipo') ], [ $fit_tipo ], [ new TLabel('Sequencia:') ], [ $fit_seq ] );
        $this->form->addFields( [ new TLabel('Grupo:') ], [ $id_formitem_pai ] );

        $this->form->addFields( [ new TLabel('Descrição Item:') ], [ $fit_descricao ]);
        $this->form->addFields( [ new TLabel('Sigla:') ], [ $fit_sigla ] );
        $this->form->addFields( [ new TLabel('Peso:') ], [ $fit_pontos ], [ new TLabel('Obrigatório:') ], [ $fit_obriga ], [ new TLabel('Status') ], [ $fit_status ] );
        $this->form->addFields( [ new TLabel('Mínimo:') ], [ $fit_vlmin ], [ new TLabel('Máximo:') ], [ $fit_vlmax ], [ new TLabel('Mascara:') ], [ $fit_mascara ] );
        $this->form->addFields( [ new TLabel('Observação: ') ], [ $fit_obs ] );

        $id_formitemops = new THidden('id_formitemops[]');

        $fio_descricao = new TEntry('fio_descricao[]');
        $fio_descricao->setSize('100%');
        
        $fio_sigla = new TEntry('fio_sigla[]');
        $fio_sigla->setSize('100%');
        
        $fio_seq = new TEntry('fio_seq[]');
        $fio_seq->setNumericMask(0,',','.', true);
        $fio_seq->setSize('100%');
        $fio_seq->style = 'text-align: right';
        
        $fio_ponto = new TEntry('fio_ponto[]');
        $fio_ponto->setNumericMask(2,',','.', true);
        $fio_ponto->setSize('100%');
        $fio_ponto->style = 'text-align: right';
        
        $this->form->addField($id_formitemops);
        $this->form->addField($fio_descricao);
        $this->form->addField($fio_sigla);
        $this->form->addField($fio_seq);
        $this->form->addField($fio_ponto);
        
        // detail
        $this->opcoes = new TFieldList('opcoes');
        $this->opcoes->setId("opcoes");
        $this->opcoes->addField( '<b>Descrição</b>', $fio_descricao,     ['width' => '40%']);
        $this->opcoes->addField( '<b>Sigla</b>',   $fio_sigla,  ['width' => '20%']);
        $this->opcoes->addField( '<b>Sequencia</b>',  $fio_seq, ['width' => '20%']);
        $this->opcoes->addField( '<b>Peso</b>',   $fio_ponto,  ['width' => '20%', 'sum' => true]);
        $this->opcoes-> width = '100%';
        $this->opcoes->enableSorting();
        
        $separetor = new TFormSeparator('Opções','dvsp');
        $this->form->addFields( [$separetor] );
        $this->form->addFields( [$this->opcoes] );

        // default value
        //$fit_tipo->setValue(0);
        
        // fire change event
        //self::carregaCampos( ['fit_tipo' => 0] );

        // set sizes
        $id_formitem->setSize('100%');
        $id_form->setSize('100%');
        $fit_descricao->setSize('100%');
        $fit_sigla->setSize('100%');
        $fit_obs->setSize('100%');
        $fit_obriga->setSize('100%');
        $fit_tipo->setSize('100%');
        //$id_formitem_ori->setSize('100%');
        $fit_status->setSize('100%');
        $id_formitem_pai->setSize('100%');
        $fit_pontos->setSize('100%');
        $fit_vlmin->setSize('100%');
        $fit_vlmax->setSize('100%');
        $fit_seq->setSize('100%');

        if (!empty($id_formitem))
        {
            $id_formitem->setEditable(FALSE);
        }

        /** samples
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( '100%' ); // set size
         **/
        
        // create the form actions
        $this->form->addAction("Voltar",  new TAction(['FormItemList', 'onReload']), 'fa:arrow-circle-o-left');
        $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave']), 'fa:save');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addActionLink(_t('New'),  new TAction([$this, 'onEdit']), 'fa:eraser red');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        //$container->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        parent::add($container);
    }

    public function onLimpaOpcoes($param)
    {
        $this->opcoes->addHeader();
        $this->opcoes->addDetail( new stdClass );
        $this->opcoes->addCloneAction();
    }

    static function carregaCampos($param)
    {
        TQuickForm::hideField('form_FormItem', 'id_formitem_pai');
        TQuickForm::hideField('form_FormItem', 'fit_vlmin');
        TQuickForm::hideField('form_FormItem', 'fit_vlmax');
        TQuickForm::hideField('form_FormItem', 'fit_mascara');
        TQuickForm::hideField('form_FormItem', 'fio_descricao[]');
        TQuickForm::hideField('form_FormItem', 'fit_pontos');
        TQuickForm::hideField('form_FormItem', 'fit_sigla');
        TQuickForm::hideField('form_FormItem', 'fit_obriga');
        TQuickForm::hideField('form_FormItem', 'fit_status');
        TQuickForm::hideField('form_FormItem', 'fit_obs');
        TScript::create("$('#dvsp').hide();");

        if ($param['fit_tipo'] > 0)
        {
            TQuickForm::showField('form_FormItem', 'id_formitem_pai');
            TQuickForm::showField('form_FormItem', 'fit_pontos');
            TQuickForm::showField('form_FormItem', 'fit_sigla');
            TQuickForm::showField('form_FormItem', 'fit_obriga');
            TQuickForm::showField('form_FormItem', 'fit_status');
            TQuickForm::showField('form_FormItem', 'fit_obs');

            if ($param['fit_tipo'] > 0 and $param['fit_tipo'] < 4) {
                TQuickForm::showField('form_FormItem', 'fio_descricao[]');
                TScript::create("$('#dvsp').show();");
            } else if ($param['fit_tipo'] == 7) {
                TQuickForm::showField('form_FormItem', 'fit_vlmin');
                TQuickForm::showField('form_FormItem', 'fit_vlmax');
                TQuickForm::showField('form_FormItem', 'fit_mascara');
            }
        }
    }
    
    /**
     * Load the datagrid with data
    */
    public function onReload($param = NULL)
    {
        try
        {
            if ($param['id_formitem'] > 0) { 
                $object = new stdClass;
                $object->id_formitem_pai = $param['id_formitem'];
                $object->fit_tipo = 1;
                self::carregaCampos( ['fit_tipo' => 1] );
                $this->form->setData($object); // fill the form
            }
            //$this->onLimpaOpcoes($param);
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * Ask before deletion
     */
    public static function onDelete($param)
    {
        // define the delete action
        $action = new TAction([__CLASS__, 'Delete']);
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    /**
     * Delete a record
     */
    public static function Delete($param)
    {
        try
        {
            $key = $param['key']; // get the parameter $key
            TTransaction::open('permission'); // open a transaction with database
            $object = new FormItem($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param )
    {
        try
        {
            TTransaction::open('permission'); // open a transaction
            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/
            
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array
            $data->id_form = TSession::getValue('id_form');

            $object = new FormItem;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $object->store(); // save the object
            
            // get the generated id_formitem
            $data->id_formitem = $object->id_formitem;
            $object->delOps();
            if( !empty($param['fio_descricao']) )
            {
                foreach( $param['fio_descricao'] as $row => $fio_descricao)
                {
                    if ($fio_descricao)
                    {
                        $ops = new FormItemops;
                        $ops->id_formitemops = $param['id_formitemops'][$row];
                        $ops->fio_descricao = $fio_descricao;
                        $ops->fio_sigla = $param['fio_sigla'][$row];
                        $ops->fio_seq = $param['fio_seq'][$row];
                        $ops->fio_ponto = $param['fio_ponto'][$row];
                        $ops->id_formitem = $data->id_formitem;
                        $ops->store();
                    }
                }
            }
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            $action = new TAction(array('FormItemList', 'onReload'));
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'),$action); // success message
            $this->onReload(); // reload the listing
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(TRUE);
    }
    
    /**
     * Load object to form data
     * @param $param Request
     */
    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('permission'); // open a transaction
                $object = new FormItem($key); // instantiates the Active Record
                $this->form->setData($object); // fill the form
                self::carregaCampos( ['fit_tipo' => $object->fit_tipo] );
                // load the contacts (composition)
                $opcoes = $object->getOpcoes();
                
                if ($opcoes)
                {
                    $this->opcoes->addHeader();
                    foreach ($opcoes as $ops)
                    {   
                        $ops_detail = new stdClass;
                        $ops_detail->id_formitemops  = $ops->id_formitemops;
                        $ops_detail->fio_descricao = $ops->fio_descricao;
                        $ops_detail->fio_sigla = $ops->fio_sigla;
                        $ops_detail->fio_seq = $ops->fio_seq;
                        $ops_detail->fio_ponto = $ops->fio_ponto;
                        
                        $this->opcoes->addDetail($ops_detail);
                    }
                    
                    $this->opcoes->addCloneAction();
                }
                else
                {
                    $this->onLimpaOpcoes($param);
                }
                TTransaction::close(); // close the transaction
            }
            else
            {
                $this->form->clear(TRUE);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') )
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}
