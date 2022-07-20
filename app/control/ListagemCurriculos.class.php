<?php
/**
 * Listagem  Listing
 * @author  <your name here>
 */
class ListagemCurriculos  extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $formgrid;
    private $loaded;
    private $deleteButton;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_SystemUser');
        $this->form->setFormTitle('Listagem de Currículos');
        
        // create the form fields
        $plchave = new TEntry('palavra_chave');
        $id = new TEntry('id');
        $name = new TEntry('name');
        $fone = new TEntry('fone');
        $celular = new TEntry('celular');
        $cpf = new TEntry('cpf');

        if (LANG == 'pt') { // Estados do brasil
            $fone->setMask('(99)9999-9999');
            $celular->setMask('(99)99999-9999');
            $cpf->setMask('999.999.999-99');
        } else if (LANG == 'pt_pt') { // Estados de portual
            $fone->setMask('999999999');
            $cpf->setMask('999999999');
            $celular->setMask('999999999');
        }

        $sexo = new TCombo('sexo');
        $sexo->addItems( ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'] );
        $cnh = new TCombo('cnh');
        $cnh->addItems(['AB' => 'AB', 'A' => 'A', 'B' => 'B']);
        $bairro = new TEntry('bairro');
        $cidade = new TEntry('cidade');
        $cargopretende = new TEntry('cargopretende');
        $idade = new TEntry('idade');
        $idade->setMask('99');

        // Adicionado por nei.thomass@gmail.com
        $diasdisponivel = new TCombo('diasdisponivel');
        $diasdisponivel->addItems( ['Domingo' => 'Domingo',
                                    'Segunda-Feira' => 'Segunda-Feira',
                                    'Terça-Feira' => 'Terça-Feira',
                                    'Quarta-Feira' => 'Quarta-Feira',
                                    'Quinta-Feira' => 'Quinta-Feira',
                                    'Sexta-Feira' => 'Sexta-Feira',
                                    'Sábado' => 'Sábado'] );

        $turnosdisponivel = new TCombo('turnosdisponivel');
        $turnosdisponivel->addItems( ['Primeiro Turno' => 'Primeiro Turno',
                                      'Segundo Turno'=>'Segundo Turno',
                                      'Terceiro Turno'=>'Terceiro Turno',
                                      'Normal'=>'Normal',
                                      'Indiferente'=>'Indiferente'] );
        // Fim da adição

        // add the fields
        $this->form->addFields( [ new TLabel('Conhecimento:') ], [ $plchave ], [ new TLabel('Código:') ], [ $id ] , [ new TLabel('Nome:') ], [ $name ] );
        $this->form->addFields( [ new TLabel(_t('Phone').':') ], [ $fone ], [ new TLabel(_t('Cell Phone').':') ], [ $celular ], [ new TLabel(_t('CPF').':') ], [ $cpf ] );
        $this->form->addFields( [ new TLabel(_t('Genre').':') ], [ $sexo ], [ new TLabel(_t('CNH').':') ], [ $cnh ], [ new TLabel(_t('City').':') ], [ $cidade ] );
        $this->form->addFields( [ new TLabel(_t('District').':') ], [ $bairro ], [ new TLabel('Cargo Pret.:') ], [ $cargopretende ], [new TLabel('Idade:')], [$idade] );
        // Adicionado por nei.thomass@gmail.com
        $this->form->addFields( [ new TLabel('Dispon. Dias:') ], [ $diasdisponivel ], [ new TLabel('Dispon. Turnos:') ], [ $turnosdisponivel ] );
        // Fim da adição

        // set sizes
        $plchave->setSize('100%');
        $id->setSize('100%');
        $name->setSize('100%');
        $fone->setSize('100%');
        $celular->setSize('100%');
        $cpf->setSize('100%');
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('SystemUser_filter_data') );
        
        // add the search form actions
        $btn = $this->form->addAction("Pesquisar", new TAction([$this, 'onSearch']), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';
        //$this->form->addActionLink(_t('New'), new TAction(['', 'onEdit']), 'fa:plus green');
        
        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->datatable = 'true';
        
        $this->datagrid->enablePopover('{name}', "<img src='{foto}?_ch=".date('dmyhis')."' style='width:100px; height: auto;border-radius:10%' alt='Sem Foto' />");
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Código', 'center');
        $column_name = new TDataGridColumn('name', _t('Name'), 'left');
        $column_email = new TDataGridColumn('email', _t('Email'), 'left');
        $column_fone = new TDataGridColumn('fone', _t('Phone'), 'center');
        $column_celular = new TDataGridColumn('celular', _t('Cell Phone'), 'center');
        /*$column_cpf = new TDataGridColumn('cpf', 'CPF', 'center');
        $column_cidade = new TDataGridColumn('cidade', 'Cidade', 'left');*/
        $column_dtcria = new TDataGridColumn('criacao', 'Criação', 'center');
        $column_dtatua = new TDataGridColumn('atualiza', 'Atualizado', 'center');
        $column_status = new TDataGridColumn('nmsta', 'Status', 'center');

        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_name);
        $this->datagrid->addColumn($column_email);
        $this->datagrid->addColumn($column_fone);
        $this->datagrid->addColumn($column_celular);
        /*$this->datagrid->addColumn($column_cpf);
        $this->datagrid->addColumn($column_cidade);*/
        $this->datagrid->addColumn($column_dtcria);
        $this->datagrid->addColumn($column_dtatua);
        $this->datagrid->addColumn($column_status);

        // creates the datagrid column actions
        $column_id->setAction(new TAction([$this, 'onReload']), ['order' => 'id']);
        $column_name->setAction(new TAction([$this, 'onReload']), ['order' => 'name']);

        $action_vw = new TDataGridAction(array('ViewCurriculo','onReload'));        
        $action_vw->setLabel('Visualizar');
        $action_vw->setImage('fa:file fa-lg');
        $action_vw->setField('id');
        $this->datagrid->addAction($action_vw);

        // cria botão deletar
        $action_vw = new TDataGridAction(array('ListagemCurriculos','onDelete'));        
        $action_vw->setLabel('Excluir');
        $action_vw->setImage('fa:trash-o red fa-lg');
        $action_vw->setField('id');
        $this->datagrid->addAction($action_vw);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        parent::add($container);
    }
    
    /**
     * Inline record editing
     * @param $param Array containing:
     *              key: object ID value
     *              field name: object attribute to be updated
     *              value: new attribute content 
     */
    public function onInlineEdit($param)
    {
        try
        {
            // get the parameter $key
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];
            
            TTransaction::open('permission'); // open a transaction with database
            $object = new SystemUser($key); // instantiates the Active Record
            $object->{$field} = $value;
            $object->store(); // update the object in the database
            TTransaction::close(); // close the transaction
            
            $this->onReload($param); // reload the listing
            new TMessage('info', "Record Updated");
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        // clear session filters
        TSession::setValue('Listagem _filter_id',   NULL);
        TSession::setValue('Listagem _filter_name',   NULL);
        TSession::setValue('Listagem _filter_fone',   NULL);
        TSession::setValue('Listagem _filter_celular',   NULL);
        TSession::setValue('Listagem _filter_cpf',   NULL);
        TSession::setValue('Listagem _filter_palavra_chave',   NULL);
        TSession::setValue('Listagem _filter_sexo',   NULL);
        TSession::setValue('Listagem _filter_cnh',   NULL);
        TSession::setValue('Listagem _filter_cidade',   NULL);
        TSession::setValue('Listagem _filter_bairro',   NULL);
        TSession::setValue('Listagem _filter_cargopretende',   NULL);
        TSession::setValue('Listagem _filter_idade',   NULL);
        // Adicionado por nei.thomass@gmail.com
        TSession::setValue('Listagem _filter_diasdisponivel', NULL);
        TSession::setValue('Listagem _filter_turnosdisponivel', NULL);

        if (isset($data->id) AND ($data->id)) {
            $filter = new TFilter('id', '=', "$data->id"); // create the filter
            TSession::setValue('Listagem _filter_id',   $filter); // stores the filter in the session
        }


        if (isset($data->name) AND ($data->name)) {
            $filter = new TFilter('name', 'like', "%{$data->name}%"); // create the filter
            TSession::setValue('Listagem _filter_name',   $filter); // stores the filter in the session
        }


        if (isset($data->fone) AND ($data->fone)) {
            $filter = new TFilter('fone', 'like', "%{$data->fone}%"); // create the filter
            TSession::setValue('Listagem _filter_fone',   $filter); // stores the filter in the session
        }


        if (isset($data->celular) AND ($data->celular)) {
            $filter = new TFilter('celular', 'like', "%{$data->celular}%"); // create the filter
            TSession::setValue('Listagem _filter_celular',   $filter); // stores the filter in the session
        }


        if (isset($data->cpf) AND ($data->cpf)) {
            $filter = new TFilter('cpf', 'like', "%{$data->cpf}%"); // create the filter
            TSession::setValue('Listagem _filter_cpf',   $filter); // stores the filter in the session
        }

        if (isset($data->palavra_chave) AND ($data->palavra_chave)) {
            $filter = new TFilter('(SELECT group_concat(tp.descricao) '.
                                  ' from user_tipos utp'.
                                  ' join tipos tp on (utp.id_tipo = tp.id)'.
                                  ' where utp.id_user = system_user.id)', 'like', "%{$data->palavra_chave}%"); // create the filter
            TSession::setValue('Listagem _filter_palavra_chave',   $filter); // stores the filter in the session
        }

        if (isset($data->sexo) AND ($data->sexo)) {
            $filter = new TFilter('sexo', 'like', "%{$data->sexo}%"); // create the filter
            TSession::setValue('Listagem _filter_sexo',   $filter); // stores the filter in the session
        }
        if (isset($data->cnh) AND ($data->cnh)) {
            $filter = new TFilter('cnh', 'like', "%{$data->cnh}%"); // create the filter
            TSession::setValue('Listagem _filter_cnh',   $filter); // stores the filter in the session
        }
        if (isset($data->bairro) AND ($data->bairro)) {
            $filter = new TFilter('bairro', 'like', "%{$data->bairro}%"); // create the filter
            TSession::setValue('Listagem _filter_bairro',   $filter); // stores the filter in the session
        }
        if (isset($data->cidade) AND ($data->cidade)) {
            $filter = new TFilter('cidade', 'like', "%{$data->cidade}%"); // create the filter
            TSession::setValue('Listagem _filter_cidade',   $filter); // stores the filter in the session
        }
        if (isset($data->cargopretende) AND ($data->cargopretende)) {
            $filter = new TFilter('cargopretende', 'like', "%{$data->cargopretende}%"); // create the filter
            TSession::setValue('Listagem _filter_cargopretende',   $filter); // stores the filter in the session
        }
        
        if (isset($data->idade) AND ($data->idade)) {
            $filter = new TFilter('(Select Cast (('.
                                  '    (JulianDay(\'now\') - JulianDay(SUBSTR(dtnasc, 7, 4)||\'-\'||SUBSTR(dtnasc, 4,2)||\'-\'||SUBSTR(dtnasc, 1,2))) / 365'.
                                  ') As Integer))', '=', "{$data->idade}"); // create the filter
            TSession::setValue('Listagem _filter_idade',   $filter); // stores the filter in the session
        }

        // Adicionado por nei.thomass@gmail.com
        if (isset($data->diasdisponivel) AND ($data->diasdisponivel)) {
            $filter = new TFilter('diasdisponivel', 'like', "%{$data->diasdisponivel}%");
            TSession::setValue('Listagem _filter_diasdisponivel',   $filter); 
        }

        if (isset($data->turnosdisponivel) AND ($data->turnosdisponivel)) {
            $filter = new TFilter('turnosdisponivel', 'like', "%{$data->turnosdisponivel}%");
            TSession::setValue('Listagem _filter_turnosdisponivel',   $filter); 
        }
        // Fim da adição

        // fill the form with data again
        $this->form->setData($data);
        
        // keep the search data in the session
        TSession::setValue('SystemUser_filter_data', $data);
        
        $param = array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try {
            // open a transaction with database 'permission'
            TTransaction::open('permission');
            
            // creates a repository for SystemUser
            $repository = new TRepository('SystemUser');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            
            // default order
            if (empty($param['order']))
            {
                $param['order'] = 'dtatualiza';
                $param['direction'] = 'desc';
            }
            
            $criteria->add(new TFilter('(select count(id) from system_user_group where system_user_id = system_user.id and system_group_id = 2)', '>', 0));
            $criteria->add(new TFilter('active', '=', 'Y'));
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if (TSession::getValue('Listagem _filter_id')) {
                $criteria->add(TSession::getValue('Listagem _filter_id')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_name')) {
                $criteria->add(TSession::getValue('Listagem _filter_name')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_fone')) {
                $criteria->add(TSession::getValue('Listagem _filter_fone')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_celular')) {
                $criteria->add(TSession::getValue('Listagem _filter_celular')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_cpf')) {
                $criteria->add(TSession::getValue('Listagem _filter_cpf')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_palavra_chave')) {
                $criteria->add(TSession::getValue('Listagem _filter_palavra_chave')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_sexo')) {
                $criteria->add(TSession::getValue('Listagem _filter_sexo')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_cnh')) {
                $criteria->add(TSession::getValue('Listagem _filter_cnh')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_bairro')) {
                $criteria->add(TSession::getValue('Listagem _filter_bairro')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_cidade')) {
                $criteria->add(TSession::getValue('Listagem _filter_cidade')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_cargopretende')) {
                $criteria->add(TSession::getValue('Listagem _filter_cargopretende')); // add the session filter
            }

            if (TSession::getValue('Listagem _filter_idade')) {
                $criteria->add(TSession::getValue('Listagem _filter_idade')); // add the session filter
            }

            // Adicinado por nei.thomass@gmail.com
            if (TSession::getValue('Listagem _filter_diasdisponivel')) {
                $criteria->add(TSession::getValue('Listagem _filter_diasdisponivel'));
            }

            if (TSession::getValue('Listagem _filter_turnosdisponivel')) {
                $criteria->add(TSession::getValue('Listagem _filter_turnosdisponivel'));
            }
            // Fim da adição

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);
            
            if (is_callable($this->transformCallback))
            {
                call_user_func($this->transformCallback, $objects, $param);
            }
            
            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($object);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
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
        new TQuestion(TAdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    /**
     * Delete a record
     */
    public static function Delete($param)
    {
        try
        {
            $key=$param['key']; // get the parameter $key
            TTransaction::open('permission'); // open a transaction with database
            $object = new SystemUser($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', TAdiantiCoreTranslator::translate('Record deleted'), $pos_action); // success message
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
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  array('onReload', 'onSearch')))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }
}
