<?php
/**
 * CadCurriculo01 Dados pessoais
 * @author  Willian Wagner
 */
class CadCurriculo03 extends TPage
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

        $this->form = new BootstrapFormBuilder('form_03');
        $this->form->setFormTitle('<b>Cadastro de Currículo</b>');

        $breadcrumb = new TBreadCrumb;
        $breadcrumb->addItem('Dados Pessoais');
        $breadcrumb->addItem('Conhecimentos');
        $breadcrumb->addItem('Formação');
        $breadcrumb->addItem('Experiências');
        $breadcrumb->select('Formação');        

        //=== Formação - INI ===        
            $id_for = new THidden('id_for');
            $id_for->setValue(0);
            $instituicao = new TEntry('instituicao');
            $instituicao->addValidation( 'Instituição', new TRequiredValidator );
            $curso       = new TEntry('curso');
            $curso->addValidation( 'Curso', new TRequiredValidator );
            $tipo        = new TCombo('tipo');
            $tipo->addValidation( 'Tipo', new TRequiredValidator );
            $tipo->addItems(['Graduação' => 'Graduação'                            
                            ,'Pós-Graduação' => 'Pós-Graduação'
                            ,'Curso Técnico' => 'Curso Técnico'
                            ,'Curso On-line' => 'Curso On-line'
                            ,'Cursos Complementares' => 'Cursos Complementares'
                            ,'Outros' => 'Outros']);
            $status      = new TCombo('status');
            $status->addValidation( 'Status', new TRequiredValidator );
            $status->addItems(['Completo' => 'Completo'
                              ,'Cursando' => 'Cursando'
                              ,'Parado' => 'Parado']);
            $dtini       = new TDate('dtinif');
            $dtini->setMask('dd/mm/yyyy');
            $dtfim       = new TDate('dtfimf');
            $dtfim->setMask('dd/mm/yyyy');

            $add_for = TButton::create('add_for', [$this, 'onForAdd'], 'Salvar', 'fa:save');

            $label_instituicao = new TLabel('* Instituição:');
            $label_curso       = new TLabel('* Curso:');
            $label_tipo        = new TLabel('* Tipo:');
            $label_status      = new TLabel('* Status:');
            $label_dtini       = new TLabel('Data Início:');
            $label_dtfim       = new TLabel('Data Final:');
            
            $this->form->addContent( ['<hr><h4><b>Formação</b></h4><hr>'] );        
            $this->form->addFields( [$label_instituicao], [$instituicao], [$label_curso], [$curso]);
            $this->form->addFields( [$label_tipo], [$tipo], [$label_status], [$status] );        
            $this->form->addFields( [$label_dtini], [$dtini], [$label_dtfim], [$dtfim] );
            $this->form->addFields( [$id_for], [$add_for] )->style = 'background: whitesmoke; padding: 2px; margin: 1px;';

            $this->for_list = new BootstrapDatagridWrapper(new TDataGrid);
            $this->for_list->setId('for_list');
            $this->for_list->style = "min-width: 700px; width:100%;margin-bottom: 10px";

            $col_id          = new TDataGridColumn( 'id', 'Código', 'center', '5%');
            $col_instituicao = new TDataGridColumn( 'instituicao', 'Instituição', 'left', '35%');
            $col_curso       = new TDataGridColumn( 'curso', 'Curso', 'left', '35%');            
            $col_status      = new TDataGridColumn( 'status', 'Status', 'left', '10%');
            $col_dini        = new TDataGridColumn( 'dtini', 'Início', 'left', '8%');
            $col_dtfim       = new TDataGridColumn( 'dtfim', 'Fim', 'right', '8%');
            
            $this->for_list->addColumn($col_id);
            $this->for_list->addColumn($col_instituicao);
            $this->for_list->addColumn($col_curso);
            $this->for_list->addColumn($col_status);
            $this->for_list->addColumn($col_dini);
            $this->for_list->addColumn($col_dtfim);
            
            //=== Cria ações para a grid de formação ===
            $actionf1 = new TDataGridAction([$this, 'onEditFor']);
            $actionf1->setLabel('Edit');
            $actionf1->setImage('fa:edit blue');
            $actionf1->setField('id');
            $actionf2 = new TDataGridAction([$this, 'onDeleteFor']);
            $actionf2->setLabel('Excluir');
            $actionf2->setImage('fa:trash red');
            $actionf2->setField('id_for');
            
            //=== Adiciona as ações a grid ===
            $this->for_list->addAction($actionf1);
            $this->for_list->addAction($actionf2);
            $this->for_list->createModel();
            
            $panel = new TPanelGroup;
            $panel->add($this->for_list);
            $panel->getBody()->style = 'overflow-x:auto';
            $this->form->addContent( [$panel] );
        //=== Formação - FIM ===
         
        // create the form actions
        $this->form->addAction("Voltar",  new TAction([$this, 'onVoltar']), 'fa:arrow-circle-o-left');
        $btn = $this->form->addAction("Salvar e Próxima", new TAction([$this, 'onSave']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        
        $this->form->add($breadcrumb);
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add($this->form);
        
        parent::add($container);

        $this->onEditLogado($param);
    }

    public function onVoltar() {
        TSession::setValue('pagecv', 'CadCurriculo02');
        AdiantiCoreApplication::loadPage('CadCurriculo02');
    }

    public function onForAdd( $param ) {
        try
        {
            TTransaction::open('permission');

            $this->form->validate(); // validate form data
            $data = $this->form->getData();
            
            $for = new Formacao();
            if ($data->id_for > 0) {
                $for->id = $data->id_for;
            }
            $for->instituicao = $data->instituicao;
            $for->curso = $data->curso;
            $for->status = $data->status;
            $for->tipo = $data->tipo;
            $for->dtini = $data->dtinif;
            $for->dtfim = $data->dtfimf;
            $for->id_user = $this->id_user;
            $for->store();
            
            // clear product form fields after add
            $data->id_for = '';
            $data->instituicao = '';
            $data->curso = '';
            $data->status = '';
            $data->tipo = '';
            $data->dtinif = '';
            $data->dtfimf = '';
            TTransaction::close();
            $this->form->setData($data);
            
            //$this->onReloadIdi( $param );
            $this->onReloadFor( $param );
            //$this->onReloadExp( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            new TMessage('error', $e->getMessage());
        }
    }

    public function onReloadFor($param) {
        TTransaction::open('permission');
        $repository = new TRepository('Formacao');
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
        $this->for_list->clear();
        if ($objects)
        {
            // iterate the collection of active records
            foreach ($objects as $object)
            {
                // add the object inside the datagrid
                $object->id_for = $object->id;                
                $this->for_list->addItem($object);
            }
        }
        
        // reset the criteria for record count
        $criteria->resetProperties();
        
        // close the transaction
        TTransaction::close();
        
        $this->loaded = TRUE;
    }

    public static function onEditFor( $param ) {
        TTransaction::open('permission');

        // get the session item
        $for = new Formacao($param['id']);        
        $data = new stdClass;
        $data->id_for      = $param['id'];
        $data->instituicao = $for->instituicao;
        $data->curso       = $for->curso;
        $data->status      = $for->status;
        $data->tipo        = $for->tipo;
        $data->dtinif      = $for->dtini;
        $data->dtfimf      = $for->dtfim;
        TTransaction::close();

        TForm::sendData( 'form_03', $data );
    }
    
    public static function DeleteFor($param) {
        try
        {
            $key = $param['key']; // get the parameter $key
            TTransaction::open('permission'); // open a transaction with database
            $object = new Formacao($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onEditLogado']);
            new TMessage('info', 'Formação removida com sucesso!', $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public static function onDeleteFor( $param ) {
        $action = new TAction([__CLASS__, 'DeleteFor']);
        $action->setParameters($param); // pass the key parameter ahead
        new TQuestion('Confirma a exclusão da formação?', $action);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param ) {
        try {
            TTransaction::open('permission'); // open a transaction

            $data = $this->form->getData(); // get form data as array            
            $this->form->setData($data); // fill form data

            if ($this->for_list->rowcount === 0) {
                throw new Exception('Deve ser informada pelo menos uma formação.');
            }

            TTransaction::close(); // close the transaction
            TSession::setValue('pagecv', 'CadCurriculo04');
            AdiantiCoreApplication::loadPage('CadCurriculo04');
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
            $object = new SystemUser($login->id);
            $this->form->setData($login);            
            TTransaction::close();
            $this->onReloadFor($param);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}
