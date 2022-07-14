<?php
/**
 * VagasListPublica Listing
 * @author  <your name here>
 */
class VagasListPublica extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $formgrid;
    private $loaded;
    private $deleteButton;
    private $login;
    public $classe;
    private $nmpdf;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->getLogin();
        
        if ($this->classe == '') {
            $this->classe = __CLASS__;
        }

        // creates the form
        $this->form = new BootstrapFormBuilder('ListadeVagasDisponiveis');
        $this->form->setFormTitle('Lista de Vagas Disponíveis');
        
        TSession::setValue('idvaga', '');

        // create the form fields
        /*$id = new TEntry('id');
        $nome = new TEntry('nome');
        $descricao = new TEntry('descricao');

        // add the fields
        $this->form->addFields( [ new TLabel('Código:') ], [ $id ] 
                               ,[ new TLabel('Nome:') ], [ $nome ]
                               ,[ new TLabel('Descrição:') ], [ $descricao ]
                               );

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        $descricao->setSize('100%');
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('Vagas_filter_data') );
        
        // add the search form actions
        $btn = $this->form->addAction(_t('Find'), new TAction([$this, 'onSearch']), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';*/
        
        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->datatable = 'true';
        
        /*$this->datagrid->enablePopover('<b>Detalhes</b>'
                                      ,'<p><b>Atividades:</b></p>'.
                                       '<p>{descricao}</p>'.
                                       '<p><b>Conhecimentos:</b></p>'.
                                       '<p>{conhecimento}</p>'.
                                       '<p><b>Pré-requisitos:</b></p>'.
                                       '<p>{prerequisito}</p>'.
                                       '<p><b>Benefícios:</b></p>'.
                                       '<p>{beneficio}</p>','click');*/
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', '', 'center');
        $column_nome = new TDataGridColumn('nome', 'Vaga', 'left');
        $column_tipo = new TDataGridColumn('nmtipo', 'Tipo', 'left');
        //$column_descricao = new TDataGridColumn('descricao', 'Atividades', 'left');
        //$column_salario = new TDataGridColumn('salario', 'Salário', 'right');
        //$column_datafinal = new TDataGridColumn('datafinal', 'Disponível até', 'center');

        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_tipo);
        //$this->datagrid->addColumn($column_descricao);
        //$this->datagrid->addColumn($column_salario);
        //$this->datagrid->addColumn($column_datafinal);

        $column_id->setTransformer(function($value, $object, $row){
                $actionclass = array('LoginForm', 'onLoad');
                $icon = 'fa:hand-o-up';
                $title = 'Candidatar-se';
                if ( TSession::getValue('logged') ) {
                    $actionclass = array($this->classe, 'onCandidatar');
                    $object = new VagaUser;
                    $idcan = $object->validaVagaUser($this->login->id, $value, false);                    
                    if ($idcan > 0) {
                        $icon = 'fa:check';
                        $title = 'Já se Candidatou';
                    }
                }
                $link = new THyperLink($title
                                      ,'index.php?class=' . $actionclass[0] . '&method=' . $actionclass[1] . "&key=" . $value
                                      ,''
                                      ,12
                                      ,''
                                      ,$icon
                                      ,''
                                      ,$title
                                      ,'btn btn-default');
                return $link;
            }
        );

        $action_view = new TDataGridAction(array('VisualizaVaga', 'onLoad'));
        $action_view->setLabel('Visualizar Vaga');
        $action_view->setImage('fa:file fa-lg');
        $action_view->setField('id');
        $this->datagrid->addAction($action_view);

        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $this->form->add($this->datagrid);
        //$this->form->add($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 95%';
        $container->add($this->form);
        //$container->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        parent::add($container);
    }
    
    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        // clear session filters
        TSession::setValue('VagasListPublica_filter_id',   NULL);
        TSession::setValue('VagasListPublica_filter_nome',   NULL);
        TSession::setValue('VagasListPublica_filter_descricao',   NULL);

        if (isset($data->id) AND ($data->id)) {
            $filter = new TFilter('id', '=', "$data->id"); // create the filter
            TSession::setValue('VagasListPublica_filter_id',   $filter); // stores the filter in the session
        }

        if (isset($data->nome) AND ($data->nome)) {
            $filter = new TFilter('nome', 'like', "%{$data->nome}%"); // create the filter
            TSession::setValue('VagasListPublica_filter_nome',   $filter); // stores the filter in the session
        }


        if (isset($data->descricao) AND ($data->descricao)) {
            $filter = new TFilter('descricao', 'like', "%{$data->descricao}%"); // create the filter
            TSession::setValue('VagasListPublica_filter_descricao',   $filter); // stores the filter in the session
        }
        
        // fill the form with data again
        $this->form->setData($data);
        
        // keep the search data in the session
        TSession::setValue('Vagas_filter_data', $data);
        
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
        try
        {
            // open a transaction with database 'permission'
            TTransaction::open('permission');
            
            // creates a repository for Vagas
            $repository = new TRepository('Vagas');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            
            $criteria->add(new TFilter('status', '=', '1'));

            // default order
            if (empty($param['order']))
            {
                $param['order'] = 'datacriacao';
                $param['direction'] = 'desc';
            }
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);            

            if (TSession::getValue('VagasListPublica_filter_id')) {
                $criteria->add(TSession::getValue('VagasListPublica_filter_id')); // add the session filter
            }

            if (TSession::getValue('VagasListPublica_filter_nome')) {
                $criteria->add(TSession::getValue('VagasListPublica_filter_nome')); // add the session filter
            }

            if (TSession::getValue('VagasListPublica_filter_descricao')) {
                $criteria->add(TSession::getValue('VagasListPublica_filter_descricao')); // add the session filter
            }

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

    public function onCandidatar ( $param ) {
        if ( TSession::getValue('logged') ) {
            if ($this->login->status === 'F') {
                TTransaction::open('permission');
                $object = new VagaUser();

                $idcan = $object->validaVagaUser($this->login->id, $_REQUEST['key'], TTransaction::get());

                if ($idcan === false) {
                    $object->id_user = $this->login->id;
                    $object->id_vaga = $_REQUEST['key'];
                    $object->datacan = date("Y-m-d H:i:s");
                    $object->store();

                    $vaga = new Vagas($_REQUEST['key']);
                    if ($vaga->email != '') {
                        $this->onEnvEmail($vaga);
                    }

                    $pos_action = new TAction([$this->classe, 'onReload']);
                    new TMessage('info', 'Candidatura efetuada com sucesso!', $pos_action); // success message
                } else {
                    $param['id'] = $idcan;
                    $this->onDeleteCan( $param );
                }
                TTransaction::close();
            } else {
                new TMessage('Erro', 'Para se candidatar-se, deve finalizar seu currículo!');
            }
        } else {
            new TMessage('Erro', 'Para se candidatar-se, deve estar logado!');
        }
    }

    public function onDeleteCan( $param ) {
        $action = new TAction([$this->classe, 'onDelete']);
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Confirma a exclusão da Candidatura?', $action);
    }

    public function onDelete( $param ) {
        TTransaction::open('permission');
        $object = new VagaUser($param['id'], false);
        $object->delete();
        TTransaction::close(); // close the transaction
            
        $pos_action = new TAction([$this->classe, 'onReload']);
        new TMessage('info', 'Candidatura removida com sucesso!', $pos_action); // success message
    }

    private function getLogin() {
        if ( TSession::getValue('logged') ) {
            TTransaction::open('permission');
            $this->login = SystemUser::newFromLogin( TSession::getValue('login') );
            $this->nmpdf = $this->login->login . '.pdf';
            TTransaction::close();
        }
    }

    public function onEnvEmail ($vaga) {
        try {
            //TTransaction::open('permission');            
            $prefs  = SystemPreference::getAllPreferences();
            //TTransaction::close();

            $cv = new VisualizaCv('G');
            $cv->geraCv();

            $mail = new TMail;
            $mail->setFrom($prefs['mail_from'], APPLICATION_NAME);
            $mail->setSubject("Candidatura para a Vaga ". $vaga->nome);
            $mail->setHtmlBody("Segue anexo Currículo do candidato " . $this->login->name);
            $mail->addAddress($vaga->email, $vaga->email);
            $mail->addAttach('tmp/'.$this->nmpdf);
            $mail->SetUseSmtp();
            $mail->SetSmtpHost($prefs['smtp_host'], $prefs['smtp_port']);
            $mail->SetSmtpUser($prefs['smtp_user'], $prefs['smtp_pass']);
            $mail->send();
        } catch (Exception $e) // in case of exception
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage() );
        }
    }
}
