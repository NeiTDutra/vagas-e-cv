<?php
/**
 * ListaDeVagas Listing
 * @author  <your name here>
 */
class ListaDeVagas extends TPage
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    protected $formgrid;
    protected $saveButton;
    
    use Adianti\base\AdiantiStandardListTrait;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('permission');            // defines the database
        $this->setActiveRecord('Vagas');   // defines the active record
        $this->setDefaultOrder('id', 'asc');         // defines the default order
        // $this->setCriteria($criteria) // define a standard filter

        $this->addFilterField('id', '=', 'id'); // filterField, operator, formField
        $this->addFilterField('nome', 'like', 'nome'); // filterField, operator, formField
        $this->addFilterField('descricao', 'like', 'descricao'); // filterField, operator, formField
        
        // creates the form
        $this->form = new BootstrapFormBuilder('Lista_de_Vagas');
        $this->form->setFormTitle('Lista de Vagas');
        
        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        //$descricao = new TEntry('descricao');

        // add the fields
        $this->form->addFields( [ new TLabel('Código:') ], [ $id ], [ new TLabel('Nome:') ], [ $nome ] ); /*, [ new TLabel('Descrição:') ], [ $descricao ] );*/

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        //$descricao->setSize('100%');
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('Vagas_filter_data') );
        
        $btn = $this->form->addAction(_t('Find'), new TAction([$this, 'onSearch']), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addAction(_t('New'),  new TAction(array('CadVagasForm', 'onEdit')), 'bs:plus-sign green');
        
        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->datatable = 'true';

        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Código', 'center');
        $column_nome = new TDataGridColumn('nome', 'Vaga', 'left');
        $column_tipo = new TDataGridColumn('nmtipo', 'Tipo', 'left');
        $column_salario = new TDataGridColumn('salario', 'Salário', 'center');
        $column_datacriacao = new TDataGridColumn('datacriacao', 'Criação', 'center');
        $column_datacriacao->setTransformer(array($this, 'formatDate'));
        $column_datafinal = new TDataGridColumn('datafinal', 'Final', 'center');
        $column_datafinal->setTransformer(array($this, 'formatDate'));
        $column_status = new TDataGridColumn('nmstatus', 'Status', 'center');
        $column_user = new TDataGridColumn('usuarios', 'N Cand.', 'center');

        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_tipo);
        $this->datagrid->addColumn($column_salario);
        $this->datagrid->addColumn($column_datacriacao);
        $this->datagrid->addColumn($column_datafinal);
        $this->datagrid->addColumn($column_status);
        $this->datagrid->addColumn($column_user);

        $this->datagrid->enablePopover('<b>Candidatos</b>', '{users}');

        $action1 = new TDataGridAction(['CadVagasForm', 'onEdit']);
        $action1->setLabel(_t('Edit'));
        $action1->setImage('fa:pencil-square-o blue fa-lg');
        $action1->setField('id');
        //$action1->setDisplayCondition( array($this, 'MostraEditExc') );
        
        $action2 = new TDataGridAction([$this, 'onDelete']);
        $action2->setLabel(_t('Delete'));
        $action2->setImage('fa:trash-o red fa-lg');
        $action2->setField('id');
        //$action2->setDisplayCondition( array($this, 'MostraEditExc') );

        $action3 = new TDataGridAction(array('VisualizaCandidatos','onReload'));
        $action3->setLabel('Visualizar');
        $action3->setImage('fa:file fa-lg');
        $action3->setField('id');
        $action3->setDisplayCondition( array($this, 'MostraView') );

        $action4 = new TDataGridAction(array($this,'onEvMail'));
        $action4->setLabel('Enviar vaga para o e-mail dos currículos cadastrados');
        $action4->setImage('fa:envelope fa-lg');
        $action4->setField('id');
        $action4->setDisplayCondition( array($this, 'MostraEnvEmail') );

        // add the actions to the datagrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        $this->datagrid->addAction($action3);
        $this->datagrid->addAction($action4);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        $this->datagrid->disableDefaultClick();
        
        // put datagrid inside a form
        $this->formgrid = new TForm;
        $this->formgrid->add($this->datagrid);
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        //$container->add($this->datagrid);
        //$container->add(TPanelGroup::pack('', $gridpack, $this->pageNavigation));
        $container->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        parent::add($container);
    }

    public function formatDate($data, $object)
    {
        $date = new DateTime($data);
        return $date->format('d/m/Y');
    }

    public function MostraEditExc ( $param ) {
        if ($param->usuarios > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function MostraView ( $param ) {
        if ($param->usuarios > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function MostraEnvEmail ( $param ) {
        if (TSession::getValue("login") == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function onEvMail( $param ) {
        $action = new TAction([__CLASS__, 'onEnvEmail']);
        $action->setParameters($param); // pass the key parameter ahead
        new TQuestion('Confirma o envio da vaga para os e-mails cadastrados?', $action);
    }

    public function onEnvEmail ($param) {
        try {
            $login = $param['id'];
            $referer = $_SERVER['HTTP_REFERER'];
            $url = substr($referer, 0, strpos($referer, 'index.php'));
            $url .= 'index.php';

            TTransaction::open('permission');
            $prefs  = SystemPreference::getAllPreferences();
            $vaga = new Vagas($_REQUEST['id']);

            $repository = new TRepository('SystemUser');        
            $criteria = new TCriteria;
            $criteria->add(new TFilter('active', '=', 'Y'));
            $criteria->add(new TFilter('(select count(ug.system_user_id) from system_user_group as ug where ug.system_user_id = system_user.id and ug.system_group_id = 2)', '>', 0));
            //$criteria->setProperties($param);
            $objects = $repository->load($criteria, FALSE);
            
            if ($objects) {            
                foreach ($objects as $object) {                    
                    $replaces = [];            
                    $replaces['name']  = $object->name;
                    $replaces['nome']  = $vaga->nome;
                    $replaces['descricao'] = nl2br($vaga->descricao);
                    $replaces['conhecimento'] = nl2br($vaga->conhecimento);
                    $replaces['prerequisito'] = nl2br($vaga->prerequisito);
                    $replaces['beneficio'] = nl2br($vaga->beneficio);
                    $replaces['link']  = $url;
                    $html = new THtmlRenderer('app/resources/vaga_disponivel.html');
                    $html->enableSection('main', $replaces);

                    try {
                        $mail = new TMail;
                        $mail->setFrom($prefs['mail_from'], APPLICATION_NAME);
                        $mail->addAddress($object->email, $object->name);
                        $mail->setSubject("Vaga de Emprego Disponível");
                        $mail->setHtmlBody($html->getContents());
                        $mail->SetUseSmtp();
                        $mail->SetSmtpHost($prefs['smtp_host'], $prefs['smtp_port']);
                        $mail->SetSmtpUser($prefs['smtp_user'], $prefs['smtp_pass']);            
                        $mail->send();
                    } catch (Exception $e) {
                        new TMessage('error',$e->getMessage());
                    }
                    //MailService::send( $object->email, "AgroTalentos Vaga Disponível", $html->getContents(), 'html' );
                }
            }
            $criteria->resetProperties();
            TTransaction::close();
            new TMessage('info', "E-mails enviados com sucesso.");
        }
        catch (Exception $e)
        {
            new TMessage('error',$e->getMessage());
            TTransaction::rollback();
        }
    }
    
    public static function onDelete($param) {
        $action = new TAction([__CLASS__, 'Delete']);
        $action->setParameters($param);
        new TQuestion('Confirma a exclusão ?', $action);
    }
    
    /**
     * Delete a record
     */
    public static function Delete($param)
    {
        try
        {
            $key = $param['key'];
            TTransaction::open('permission');
            $object = new Vagas($key, FALSE);
            $object->delete();
            TTransaction::close();
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', TAdiantiCoreTranslator::translate('Record deleted'), $pos_action);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }

}
