<?php
/**
 * FormItemFormList Form List
 * @author  <your name here>
 */
class FormItemList extends TPage
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
        
        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        // $this->datagrid->datatable = 'true';
        // $this->datagrid->enablePopover('Popover', 'Hi <b> {name} </b>');
        
        // creates the datagrid columns
        $column_id_formitem = new TDataGridColumn('id_formitem', 'Id Formitem', 'left');
        $column_id_form = new TDataGridColumn('id_form', 'Id Form', 'left');
        $column_fit_descricao = new TDataGridColumn('fit_descricao', 'Fit Descricao', 'left');
        $column_fit_sigla = new TDataGridColumn('fit_sigla', 'Fit Sigla', 'left');
        $column_fit_obs = new TDataGridColumn('fit_obs', 'Fit Obs', 'left');
        $column_fit_obriga = new TDataGridColumn('fit_obriga', 'Fit Obriga', 'left');
        $column_fit_tipo = new TDataGridColumn('fit_tipo', 'Fit Tipo', 'left');
        $column_id_formitem_ori = new TDataGridColumn('id_formitem_ori', 'Id Formitem Ori', 'left');
        $column_fit_status = new TDataGridColumn('fit_status', 'Fit Status', 'left');
        $column_id_formitem_pai = new TDataGridColumn('id_formitem_pai', 'Id Formitem Pai', 'left');
        $column_fit_pontos = new TDataGridColumn('fit_pontos', 'Fit Pontos', 'left');
        $column_fit_vlmin = new TDataGridColumn('fit_vlmin', 'Fit Vlmin', 'left');
        $column_fit_vlmax = new TDataGridColumn('fit_vlmax', 'Fit Vlmax', 'left');
        $column_fit_seq = new TDataGridColumn('fit_seq', 'Fit Seq', 'left');

        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id_formitem);
        $this->datagrid->addColumn($column_id_form);
        $this->datagrid->addColumn($column_fit_descricao);
        $this->datagrid->addColumn($column_fit_sigla);
        $this->datagrid->addColumn($column_fit_obs);
        $this->datagrid->addColumn($column_fit_obriga);
        $this->datagrid->addColumn($column_fit_tipo);
        $this->datagrid->addColumn($column_id_formitem_ori);
        $this->datagrid->addColumn($column_fit_status);
        $this->datagrid->addColumn($column_id_formitem_pai);
        $this->datagrid->addColumn($column_fit_pontos);
        $this->datagrid->addColumn($column_fit_vlmin);
        $this->datagrid->addColumn($column_fit_vlmax);
        $this->datagrid->addColumn($column_fit_seq);

        // creates two datagrid actions
        $action1 = new TDataGridAction(['FormItemForm', 'onEdit']);
        //$action1->setUseButton(TRUE);
        //$action1->setButtonClass('btn btn-default');
        $action1->setLabel(_t('Edit'));
        $action1->setImage('fa:edit blue');
        $action1->setField('id_formitem');
        
        $action2 = new TDataGridAction([$this, 'onDelete']);
        //$action2->setUseButton(TRUE);
        //$action2->setButtonClass('btn btn-default');
        $action2->setLabel(_t('Delete'));
        $action2->setImage('fa:trash red');
        $action2->setField('id_formitem');
        
        // add the actions to the datagrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);

        $action3 = new TDataGridAction(['FormItemForm', 'onReload']);
        //$action2->setUseButton(TRUE);
        $action3->setButtonClass('btn btn-default');
        $action3->setLabel('Itens da Ficha');
        $action3->setImage('fa:share blue');
        $action3->setField('id_formitem');
        $action3->setDisplayCondition( array($this, 'MostraView') );
        $this->datagrid->addAction($action3);
        
        // create the datagrid model
        $this->datagrid->createModel();

        $this->form->addAction("Voltar",  new TAction(['FormFormList', 'onReload']), 'fa:arrow-circle-o-left');
        $btn = $this->form->addAction("Novo", new TAction(['FormItemForm', 'onReload']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        
        // creates the page navigation
        //$this->pageNavigation = new TPageNavigation;
        //$this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        //$this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $this->form->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        $container->add($this->form);
        //$container->add();
        
        parent::add($container);
    }

    public function MostraView ( $param ) {
        if ($param->fit_tipo == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'permission'
            TTransaction::open('permission');
            if (!empty($param['id_form'])) {
                TSession::setValue('id_form', $param['id_form']);
            }
            $conn = TTransaction::get();

            $sql = "WITH Niveis AS ( ".
                "SELECT i.*, i.fit_descricao as fit_descricao2, ".
                "0 AS Nivel ".
                "FROM form_item i ".
                "WHERE i.id_form = ". TSession::getValue('id_form') ." and ".
                "i.id_formitem_pai IS NULL or i.id_formitem_pai = 0 ".
                "UNION ALL ".
                "SELECT fi.* , Niveis.fit_descricao || ' - ' || fi.fit_descricao as fit_descricao2, ".
                "Nivel+1 ".
                "FROM form_item fi ".
                "INNER JOIN Niveis ON Niveis.id_formitem = fi.id_formitem_pai ".
                "order by id_formitem_pai desc ".
                ") ".
                "SELECT * ".
                "FROM Niveis";
            $objects = $conn->query($sql);
            
            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem((object)$object);
                }
            }
            
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
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
            $object->delFilhos();
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
            
            $object = new FormItem;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $object->store(); // save the object
            
            // get the generated id_formitem
            $data->id_formitem = $object->id_formitem;
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved')); // success message
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
