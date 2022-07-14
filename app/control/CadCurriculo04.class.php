<?php
/**
 * CadCurriculo01 Dados pessoais
 * @author  Willian Wagner
 */
class CadCurriculo04 extends TPage
{
    protected $form; // form
    private $id_user;
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param ) {
        parent::__construct();
        $page = TSession::getValue('pagecv');
        if ( isset($page) === false ) {
            AdiantiCoreApplication::loadPage('CadCurriculo01');
        } else if (TSession::getValue('pagecv') !== __CLASS__) {
            AdiantiCoreApplication::loadPage(TSession::getValue('pagecv'));
        }

        $this->form = new BootstrapFormBuilder('form_04');
        $this->form->setFormTitle('<b>Cadastro de Currículo</b>');

        $breadcrumb = new TBreadCrumb;
        $breadcrumb->addItem('Dados Pessoais');
        $breadcrumb->addItem('Conhecimentos');
        $breadcrumb->addItem('Formação');
        $breadcrumb->addItem('Experiências');
        $breadcrumb->select('Experiências');

        //=== Experiencias - INI ===        
            $id_exp = new THidden('id_exp');
            $id_exp->setValue(0);
            $empresa   = new TEntry('empresa');
            $empresa->addValidation( 'Empresa', new TRequiredValidator );
            $cargo     = new TEntry('cargo');
            $cargo->addValidation( 'Cargo', new TRequiredValidator );
            $atividade = new TText('atividade');
            $atividade->addValidation( 'Atividades', new TRequiredValidator );
            $dtini  = new TDate('dtini');
            $dtini->setMask('dd/mm/yyyy');
            $dtfim  = new TDate('dtfim');
            $dtfim->setMask('dd/mm/yyyy');
            $atual      = new TCombo('atual');
            $atual->addValidation( 'Emprego Atual', new TRequiredValidator );
            $atual->addItems(['SIM' => 'SIM'
                              ,'NÃO' => 'NÃO']);
            $atual->setValue("NÃO");

            $add_exp = TButton::create('add_exp', [$this, 'onExpAdd'], 'Salvar', 'fa:save');

            $label_empresa   = new TLabel('* Empresa:');
            $label_cargo     = new TLabel('* Cargo:');
            $label_atividade = new TLabel('* Atividades:');
            $label_dtini     = new TLabel('Data Entrada:');
            $label_dtfim     = new TLabel('Data Saída:');
            $label_atual     = new TLabel('* Emprego Atual:');
            
            $this->form->addContent( ['<hr><h4><b>Experiências</b></h4><hr>'] );        
            $this->form->addFields( [$label_empresa], [$empresa], [$label_cargo], [$cargo]);            
            $this->form->addFields( [$label_atividade], [$atividade] );        
            $this->form->addFields( [$label_dtini], [$dtini], [$label_dtfim], [$dtfim], [$label_atual], [$atual] );
            $this->form->addFields( [$id_exp], [$add_exp] )->style = 'background: whitesmoke; padding: 2px; margin: 1px;';

            $this->exp_list = new BootstrapDatagridWrapper(new TDataGrid);
            $this->exp_list->setId('exp_list');
            $this->exp_list->style = "min-width: 700px; width:100%;margin-bottom: 10px";

            $col_id      = new TDataGridColumn( 'id', 'Código', 'center', '10%');
            $col_empresa = new TDataGridColumn( 'empresa', 'Empresa', 'left', '40%');
            $col_cargo   = new TDataGridColumn( 'cargo', 'Cargo', 'left', '30%');
            $col_dini    = new TDataGridColumn( 'dtini', 'Entrada', 'left', '10%');
            $col_dtfim   = new TDataGridColumn( 'dtfim', 'Saída', 'right', '10%');
            $col_atual   = new TDataGridColumn( 'atual', 'Emp.Atual', 'left', '10%');
            
            $this->exp_list->addColumn($col_id);
            $this->exp_list->addColumn($col_empresa);
            $this->exp_list->addColumn($col_cargo);
            $this->exp_list->addColumn($col_dini);
            $this->exp_list->addColumn($col_dtfim);
            $this->exp_list->addColumn($col_atual);
            
            //=== Cria ações para a grid de experiencias ===
            $action1 = new TDataGridAction([$this, 'onEditExp']);
            $action1->setLabel('Edit');
            $action1->setImage('fa:edit blue');
            $action1->setField('id');
            $action2 = new TDataGridAction([$this, 'onDeleteExp']);
            $action2->setLabel('Delete');
            $action2->setImage('fa:trash red');
            $action2->setField('id_exp');
            
            //=== Adiciona as ações a grid ===
            $this->exp_list->addAction($action1);
            $this->exp_list->addAction($action2);
            $this->exp_list->createModel();
            
            $panel = new TPanelGroup;
            $panel->add($this->exp_list);
            $panel->getBody()->style = 'overflow-x:auto';
            $this->form->addContent( [$panel] );
        //=== Experiencias - FIM ===*/
         
        // create the form actions
        $this->form->addAction("Voltar",  new TAction([$this, 'onVoltar']), 'fa:arrow-circle-o-left');
        $btn = $this->form->addAction("Salvar e Finalizar", new TAction([$this, 'onSave']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        
        $this->form->add($breadcrumb);
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add($this->form);
        
        parent::add($container);

        $this->onEditLogado($param);
    }

    public function onVoltar() {
        TSession::setValue('pagecv', 'CadCurriculo03');
        AdiantiCoreApplication::loadPage('CadCurriculo03');
    }

    public function onExpAdd( $param ) {
        try
        {
            TTransaction::open('permission');
            $this->form->validate(); // validate form data
            $data = $this->form->getData();
            
            $exp = new Experiencias();
            if ($data->id_exp > 0) {
                $exp->id = $data->id_exp;
            }
            $exp->empresa = $data->empresa;
            $exp->cargo = $data->cargo;
            $exp->atividade = $data->atividade;
            $exp->dtini = $data->dtini;
            $exp->dtfim = $data->dtfim;
            $exp->id_user = $this->id_user;
            $exp->atual = $data->atual;
            $exp->store();
            
            // clear product form fields after add
            $data->id_exp = '';
            $data->empresa = '';
            $data->cargo = '';
            $data->atividade = '';
            $data->dtini = '';
            $data->dtfim = '';
            TTransaction::close();
            $this->form->setData($data);
            $this->onReloadExp( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            new TMessage('error', $e->getMessage());
        }
    }

    public function onReloadExp($param) {
        TTransaction::open('permission');
        $repository = new TRepository('Experiencias');
        $limit = 5;
        $criteria = new TCriteria;
        if (empty($param['order']))
        {
            $param['order'] = 'id';
            $param['direction'] = 'asc';
        }
        $login = SystemUser::newFromLogin( TSession::getValue('login') );        
        $criteria->add(new TFilter('id_user', '=', $login->id));

        $criteria->setProperties($param); // order, offset
        $criteria->setProperty('limit', $limit);
        
        // load the objects according to criteria
        $objects = $repository->load($criteria, FALSE);
        $this->exp_list->clear();
        if ($objects)
        {
            // iterate the collection of active records
            foreach ($objects as $object)
            {
                // add the object inside the datagrid
                $object->id_exp = $object->id;
                //$object->dtini = TDate::date2br($object->dtini);
                //$object->dtfim = TDate::date2br($object->dtfim);
                $this->exp_list->addItem($object);
            }
        }
        
        // reset the criteria for record count
        $criteria->resetProperties();
        
        // close the transaction
        TTransaction::close();
        
        $this->loaded = TRUE;
    }

    public static function onEditExp( $param ) {
        TTransaction::open('permission');

        // get the session item
        $experiencias = new Experiencias($param['id']);        
        $data = new stdClass;
        $data->id_exp    = $param['id'];
        $data->empresa   = $experiencias->empresa;
        $data->cargo     = $experiencias->cargo;
        $data->atividade = $experiencias->atividade;
        $data->dtini     = $experiencias->dtini;
        $data->dtfim     = $experiencias->dtfim;
        TTransaction::close();

        TForm::sendData( 'form_04', $data );
    }
    
    public static function DeleteExp($param) {
        try {
            $key = $param['key']; // get the parameter $key
            TTransaction::open('permission'); // open a transaction with database
            $object = new Experiencias($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onEditLogado']);
            new TMessage('info', 'Experiência removida com sucesso!', $pos_action); // success message
        } catch (Exception $e) { // in case of exception
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public static function onDeleteExp( $param ) {
        $action = new TAction([__CLASS__, 'DeleteExp']);
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Confirma a exclusão da Experiência?', $action);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param ) {
        try {
            TTransaction::open('permission'); // open a transaction
            $data = $this->form->getData(); // get form data as array            
            
            if ($this->exp_list->rowcount === 0) {
                throw new Exception('Deve ser informado pelo menos uma experiência.');
            }

            $login = SystemUser::newFromLogin( TSession::getValue('login') );
            $login->dtatualiza = date("Y-m-d H:i:s");
            $login->status = "F";
            $login->store(); // save the object

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /*=== Envia o currículo para o e-mail da  ===*/
            if (TSession::getValue('login') != 'admin') {
                $vw = new VisualizaCv ();
                $vw->onEnvEmail($param);
            }
            
            TSession::delValue('pagecv');
            new TMessage('info', 'Currículo salvo com sucesso!', new TAction(['VisualizaCv', 'onReload']));
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
    public function onClear( $param ) {
        $this->form->clear(TRUE);
    }
    
    /**
     * Load object to form data
     * @param $param Request
     */
    public function onEdit( $param ) {
        try {
            if (isset($param['key'])) {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('permission'); // open a transaction
                $object = new SystemUser($key); // instantiates the Active Record
                $this->form->setData($object); // fill the form
                TTransaction::close(); // close the transaction
            } else {
                $this->onEditLogado($param);
            }
        } catch (Exception $e) { // in case of exception 
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEditLogado($param) {
        try {
            TTransaction::open('permission');
            $login = SystemUser::newFromLogin( TSession::getValue('login') );
            $this->id_user = $login->id;
            $this->form->setData($login);
            TTransaction::close();
            $this->onReloadExp($param);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}
