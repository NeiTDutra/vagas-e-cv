<?php
/**
 * CadCurriculo01 Conhecimentos
 * @author  Willian Wagner
 */
class CadCurriculo02 extends TPage
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
        
        $this->form = new BootstrapFormBuilder('form_02');
        $this->form->setFormTitle('<b>Cadastro de Currículo</b>');
        
        $id = new THidden('id');
        $this->form->addFields( [$id] );

        $breadcrumb = new TBreadCrumb;
        $breadcrumb->addItem('Dados Pessoais');
        $breadcrumb->addItem('Conhecimentos');
        $breadcrumb->addItem('Formação');
        $breadcrumb->addItem('Experiências');
        $breadcrumb->select('Conhecimentos');

        // create the form fields
        $conhecimentos = new TDBCheckGroup('tecs', 'permission', 'Tipos', 'id', 'descricao');
        $conhecimentos->setLayout('horizontal');
        
        if ($conhecimentos->getLabels()) {
            foreach ($conhecimentos->getLabels() as $label) {
                $label->setSize(200);
            }
        }

        $this->form->addFields( [new TFormSeparator('<h4><b>Conhecimentos</b></h4>')] );
        $this->form->addFields( [$conhecimentos] );

        /*=== Idiomas - INI ===*/
            $id_idi = new THidden('id_idi');
            $id_idi->setValue(0);
            $lingua = new TCombo('lingua');
            $lingua->addItems(['Português' => 'Português'
                              ,'Inglês' => 'Inglês'
                              ,'Espanhol' => 'Espanhol'
                              ,'Italiano' => 'Italiano'
                              ,'Alemão' => 'Alemão']);
            $lingua->addValidation( 'Idioma', new TRequiredValidator );
            $compreensao = new TCombo('compreensao');
            $compreensao->addValidation( 'Compreensão', new TRequiredValidator );
            $compreensao->addItems(['Básico' => 'Básico'
                                   ,'Intermediário' => 'Intermediário'                                   
                                   ,'Avançado' => 'Avançado']);
            $escrita     = new TCombo('escrita');
            $escrita->addValidation( 'Escrita', new TRequiredValidator );
            $escrita->addItems(['Básico' => 'Básico'
                               ,'Intermediário' => 'Intermediário'                                   
                               ,'Avançado' => 'Avançado']);                
            $fala        = new TCombo('fala');
            $fala->addValidation( 'Fala', new TRequiredValidator );
            $fala->addItems(['Básico' => 'Básico'
                            ,'Intermediário' => 'Intermediário'                                   
                            ,'Avançado' => 'Avançado']);
            $leitura     = new TCombo('leitura');
            $leitura->addValidation( 'Leitura', new TRequiredValidator );
            $leitura->addItems(['Básico' => 'Básico'
                               ,'Intermediário' => 'Intermediário'                                   
                               ,'Avançado' => 'Avançado']);            

            $add_idi = TButton::create('add_idi', [$this, 'onIdiAdd'], 'Salvar', 'fa:save');

            $label_lingua      = new TLabel('* Idioma:');
            $label_compreensao = new TLabel('* Compreensão:');
            $label_escrita     = new TLabel('* Escrita:');
            $label_fala        = new TLabel('* Fala:');
            $label_leitura     = new TLabel('* Leitura:');            
            
            $this->form->addContent( ['<hr><h4><b>Idiomas</b></h4><hr>'] );        
            $this->form->addFields( [$label_lingua], [$lingua], [$label_compreensao], [$compreensao]);
            $this->form->addFields( [$label_escrita], [$escrita], [$label_fala], [$fala], [$label_leitura], [$leitura] );
            $this->form->addFields( [$id_idi], [$add_idi] )->style = 'background: whitesmoke; padding: 2px; margin: 1px;';

            $this->idi_list = new BootstrapDatagridWrapper(new TDataGrid);
            $this->idi_list->setId('idi_list');
            $this->idi_list->style = "min-width: 700px; width:100%;margin-bottom: 10px";

            $col_id          = new TDataGridColumn( 'id', 'Código', 'center', '5%');
            $col_lingua      = new TDataGridColumn( 'lingua', 'Idioma', 'center', '19%');
            $col_compreensao = new TDataGridColumn( 'compreensao', 'Compreensão', 'center', '19%');
            $col_escrita     = new TDataGridColumn( 'escrita', 'Escrita', 'center', '19%');
            $col_fala        = new TDataGridColumn( 'fala', 'Fala', 'center', '19%');
            $col_leitura     = new TDataGridColumn( 'leitura', 'Leitura', 'center', '19%');
            
            $this->idi_list->addColumn($col_id);
            $this->idi_list->addColumn($col_lingua);
            $this->idi_list->addColumn($col_compreensao);
            $this->idi_list->addColumn($col_escrita);
            $this->idi_list->addColumn($col_fala);
            $this->idi_list->addColumn($col_leitura);
            
            //=== Cria ações para a grid de idiomas ===
            $actioni1 = new TDataGridAction([$this, 'onEditIdi']);
            $actioni1->setLabel('Editar');
            $actioni1->setImage('fa:edit blue');
            $actioni1->setField('id');
            $actioni2 = new TDataGridAction([$this, 'onDeleteIdi']);
            $actioni2->setLabel('Excluir');
            $actioni2->setImage('fa:trash red');
            $actioni2->setField('id_idi');
            
            //=== Adiciona as ações a grid ===
            $this->idi_list->addAction($actioni1);
            $this->idi_list->addAction($actioni2);
            $this->idi_list->createModel();
            
            $panel = new TPanelGroup;
            $panel->add($this->idi_list);
            $panel->getBody()->style = 'overflow-x:auto';
            $this->form->addContent( [$panel] );
        //=== Idiomas - FIM ===
         
        // create the form actions
        $this->form->addAction("Voltar",  new TAction([$this, 'onVoltar']), 'fa:arrow-circle-o-left');
        $btn = $this->form->addAction("Salvar e Próxima", new TAction([$this, 'onSave']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        //$this->form->addAction(_t('New'),  new TAction([$this, 'onEdit']), 'fa:eraser red');
        
        $this->form->add($breadcrumb);
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add($this->form);
        
        parent::add($container);

        $this->onEditLogado($param);
    }

    public function onVoltar() {
        TSession::setValue('pagecv', 'CadCurriculo01');
        AdiantiCoreApplication::loadPage('CadCurriculo01');
    }

    public function onIdiAdd( $param ) {        
        try {
            TTransaction::open('permission');

            $this->form->validate(); // validate form data
            $data = $this->form->getData();
            
            /*if( (! $data->lingua) || (! $data->compreensao) || (! $data->fala) )
                throw new Exception('Campos idioma devem serem todos informados.');*/
            
            $idi = new Idiomas();
            if ($data->id_idi > 0) {
                $idi->id = $data->id_idi;
            }
            $idi->lingua = $data->lingua;
            $idi->compreensao = $data->compreensao;
            $idi->escrita = $data->escrita;
            $idi->fala = $data->fala;
            $idi->leitura = $data->leitura;
            $idi->id_user = $this->id_user;
            $idi->store();
            
            // clear product form fields after add
            $data->id_idi = '';
            $data->lingua = '';
            $data->compreensao = '';
            $data->escrita = '';
            $data->fala = '';
            $data->leitura = '';
            TTransaction::close();
            $this->form->setData($data);
            
            $this->onReloadIdi( $param );
        } catch (Exception $e) {
            $this->form->setData( $this->form->getData());
            new TMessage('error', $e->getMessage());
        }
    }

    public function onReloadIdi($param) {
        TTransaction::open('permission');
        $repository = new TRepository('Idiomas');
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
        $this->idi_list->clear();
        if ($objects)
        {
            // iterate the collection of active records
            foreach ($objects as $object)
            {
                // add the object inside the datagrid
                $object->id_idi = $object->id;
                $this->idi_list->addItem($object);
            }
        }
        
        // reset the criteria for record count
        $criteria->resetProperties();
        
        // close the transaction
        TTransaction::close();
        
        $this->loaded = TRUE;
    }

    public static function onEditIdi( $param ) {
        TTransaction::open('permission');

        // get the session item
        $idi = new Idiomas($param['id']);        
        $data = new stdClass;
        $data->id_idi      = $param['id'];
        $data->lingua = $idi->lingua;
        $data->compreensao = $idi->compreensao;
        $data->escrita = $idi->escrita;
        $data->fala = $idi->fala;
        $data->leitura = $idi->leitura;        
        TTransaction::close();

        TForm::sendData( 'form_02', $data );
    }
    
    public static function DeleteIdi($param) {
        try {
            $key = $param['key']; // get the parameter $key
            TTransaction::open('permission'); // open a transaction with database
            $object = new Idiomas($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onEditLogado']);
            new TMessage('info', 'Idioma removida com sucesso!', $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public static function onDeleteIdi( $param ) {
        $action = new TAction([__CLASS__, 'DeleteIdi']);
        $action->setParameters($param); // pass the key parameter ahead
        new TQuestion('Confirma a exclusão do Idioma?', $action);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param ) {
        try {
            TTransaction::open('permission'); // open a transaction
            $data = $this->form->getData();
            $login = SystemUser::newFromLogin( TSession::getValue('login') );            
            $object = new SystemUser($login->id);
            $object->fromArray( (array) $data);

            $object->clearTecs();
            if( !empty($data->tecs) ) {
                foreach( $data->tecs as $tec_id ) {
                    $object->addUserTecs( new Tipos($tec_id) );
                }
            }

            if (isset($tec_id) === false) {
                throw new Exception('Conhecimentos deve ser informado.');
            }
            
            if ($this->idi_list->rowcount === 0) {
                throw new Exception('Idioma deve ser informado.');
            }
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TSession::setValue('pagecv', 'CadCurriculo03');
            AdiantiCoreApplication::loadPage('CadCurriculo03');
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
            $tecs = array();
            if( $tecs_db = $object->getUserTipos() ) {
                foreach( $tecs_db as $tipo ) {
                    $tecs[] = $tipo->id;
                }
            }
            $login->tecs = $tecs;

            $this->form->setData($login);            
            TTransaction::close();
            $this->onReloadIdi($param);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}
