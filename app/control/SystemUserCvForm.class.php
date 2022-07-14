<?php
/**
 * SystemUserCvForm Form
 * @author  <your name here>
 */
class SystemUserCvForm extends TPage
{
    protected $form; // form
    private $id_user;
    private $msgsalva = true;
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param ) {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder('form_cv');
        $this->form->setFormTitle('Cadastro de Currículo');

        // create the form fields
        $id = new THidden('id');
        $name = new TEntry('name');        
        $email = new TEntry('email');
        $cpf = new TEntry('cpf');
        $cpf->setMask('999.999.999-99');
        $rg = new TEntry('rg');        
        $fone = new TEntry('fone');
        $fone->setMask('(99)9999-9999');
        $celular = new TEntry('celular');
        $celular->setMask('(99)99999-9999');
        $sexo = new TCombo('sexo');
        $sexo->addItems( ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'] );
        $dtnasc = new TDate('dtnasc');
        $dtnasc->setMask('dd/mm/yyyy');
        $estcivil = new TCombo('estcivil');
        $estcivil->addItems( ['Solteiro' => 'Solteiro', 'Casado' => 'Casado', 'Separado' => 'Separado'] );
        $endereco = new TEntry('endereco');
        $bairro = new TEntry('bairro');
        $cep = new TEntry('cep');
        $cidade = new TEntry('cidade');
        $estado = new TCombo('estado');
        $estado->addItems( ['AC' => 'ACRE'
                           ,'AL' => 'ALAGOAS'
                           ,'AM' => 'AMAZONAS'
                           ,'AP' => 'AMAPA'
                           ,'BA' => 'BAHIA'
                           ,'CE' => 'CEARA'
                           ,'DF' => 'DISTRITO FEDERAL'
                           ,'ES' => 'ESPIRITO SANTO'
                           ,'GO' => 'GOIAS'
                           ,'IC' => 'ILHAS CAYMAN'
                           ,'IT' => 'ITALIA'
                           ,'MA' => 'MARANHAO'
                           ,'MG' => 'MINAS GERAIS'
                           ,'MS' => 'MATO GROSSO DO SUL'
                           ,'MT' => 'MATO GROSSO'
                           ,'PA' => 'PARA'
                           ,'PB' => 'PARAIBA'
                           ,'PE' => 'PERNAMBUCO'
                           ,'PI' => 'PIAUI'
                           ,'PR' => 'PARANA'
                           ,'RJ' => 'RIO DE JANEIRO'
                           ,'RN' => 'RIO GRANDE DO NORTE'
                           ,'RO' => 'RONDONIA'
                           ,'RR' => 'RORAIMA'
                           ,'RS' => 'RIO GRANDE DO SUL'
                           ,'SC' => 'SANTA CATARINA'
                           ,'SE' => 'SERGIPE'
                           ,'SP' => 'SAO PAULO'
                           ,'TO' => 'TOCANTINS'] );
        $pais = new TEntry('pais');
        $dispvia = new TCombo('dispvia');
        $dispvia->addItems(['SIM' => 'SIM', 'NÃO' => 'NÃO']);
        $dispmud = new TCombo('dispmud');
        $dispmud->addItems(['SIM' => 'SIM', 'NÃO' => 'NÃO']);
        $estaempregado = new TCombo('estaempregado');
        $estaempregado->addItems(['SIM' => 'SIM', 'NÃO' => 'NÃO']);
        $cnh = new TCombo('cnh');
        $cnh->addItems(['AB' => 'AB', 'A' => 'A', 'B' => 'B']);
        $necespecial = new TCombo('necespecial');
        $necespecial->addItems(['SIM' => 'SIM', 'NÃO' => 'NÃO']);
        $necespecial->setValue("NÃO");
        $qualnecespecial = new TEntry('qualnecespecial');
        $cargopretende = new TEntry('cargopretende');
        $objetivo = new TText('objetivo');
        //$pretsalarial = new TEntry('pretsalarial');
        $conhecimentos = new TDBCheckGroup('tecs', 'permission', 'Tipos', 'id', 'descricao');
        $conhecimentos->setLayout('horizontal');
        
        if ($conhecimentos->getLabels()) {
            foreach ($conhecimentos->getLabels() as $label) {
                $label->setSize(200);
            }
        }

        $lbnome = new TLabel('* Nome Completo:');
        $lbnome->setFontColor('#FF0000');
        $lbemail = new TLabel('* E-mail:');
        $lbemail->setFontColor('#FF0000');
        $lbcpf = new TLabel('* CPF:');
        $lbcpf->setFontColor('#FF0000');
        $lbfone = new TLabel('* Fone:');
        $lbfone->setFontColor('#FF0000');
        $lbcelular = new TLabel('* Celular:');
        $lbcelular->setFontColor('#FF0000');

        // add the fields        
        $this->form->addFields( [ $lbnome ], [$id, $name ] );
        $this->form->addFields( [ $lbemail ], [ $email ] );
        $this->form->addFields( [ $lbcpf ], [ $cpf ], [ new TLabel('RG:') ], [ $rg ] );
        $this->form->addFields( [ $lbfone ], [ $fone ], [ $lbcelular ], [ $celular ] );
        $this->form->addFields( [ new TLabel('CNH:') ], [ $cnh ], [ new TLabel('Estado Civil:') ], [ $estcivil ] );
        $this->form->addFields( [ new TLabel('Sexo:') ], [ $sexo ], [ new TLabel('Data Nascimento:') ], [ $dtnasc ] );
        $this->form->addFields( [ new TLabel('Endereço:') ], [ $endereco ] );
        $this->form->addFields( [ new TLabel('Bairro:') ], [ $bairro ] );
        $this->form->addFields( [ new TLabel('CEP:') ], [ $cep ] );
        $this->form->addFields( [ new TLabel('Cidade:') ], [ $cidade ] );
        $this->form->addFields( [ new TLabel('Estado:') ], [ $estado ] );
        $this->form->addFields( [ new TLabel('País:') ], [ $pais ] );
        $this->form->addFields( [ new TLabel('Dispon. Viagens:') ], [ $dispvia ], [ new TLabel('Dispon. Mudança:') ], [ $dispmud ], [ new TLabel('Está Empregado:') ], [ $estaempregado ] );
        $this->form->addFields( [ new TLabel('Necessidades Especiais:') ], [ $necespecial ], [ new TLabel('Qual?') ], [ $qualnecespecial ] );
        $this->form->addFields( [ new TLabel('Cargo Pretendido:') ], [ $cargopretende ] );
        $this->form->addFields( [ new TLabel('Objetivos:') ], [ $objetivo ] );        
        $this->form->addFields( [new TFormSeparator('<h4>Conhecimentos em Informática</h4>')] );
        $this->form->addFields( [$conhecimentos] );

        // set sizes
        //$id->setSize('5%');
        $name->setSize('100%');        
        $email->setSize('100%');
        $cpf->setSize('100%');
        $rg->setSize('100%');
        $fone->setSize('100%');
        $celular->setSize('100%');
        $sexo->setSize('100%');
        $dtnasc->setSize('100%');
        $estcivil->setSize('100%');
        $endereco->setSize('100%');
        $bairro->setSize('100%');
        $cep->setSize('100%');
        $cidade->setSize('100%');
        $estado->setSize('100%');
        $pais->setSize('100%');
        $dispvia->setSize('100%');
        $dispmud->setSize('100%');
        $estaempregado->setSize('100%');
        $cnh->setSize('100%');
        $objetivo->setSize('100%',50);
        $necespecial->setSize('100%');
        $qualnecespecial->setSize('100%');
        $cargopretende->setSize('100%');

        if (!empty($id))
        {
            $id->setEditable(FALSE);
        }
        
        /** samples
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( '100%' ); // set size
         **/

        //=== Idiomas - INI ===        
            $id_idi = new THidden('id_idi');
            $id_idi->setValue(0);
            $lingua = new TCombo('lingua');
            $lingua->addItems(['Português' => 'Português'
                              ,'Inglês' => 'Inglês'
                              ,'Espanhol' => 'Espanhol'
                              ,'Italiano' => 'Italiano'
                              ,'Alemão' => 'Alemão']);
            $compreensao = new TCombo('compreensao');
            $compreensao->addItems(['Básico' => 'Básico'
                                   ,'Intermediário' => 'Intermediário'                                   
                                   ,'Avançado' => 'Avançado']);
            $escrita     = new TCombo('escrita');
            $escrita->addItems(['Básico' => 'Básico'
                               ,'Intermediário' => 'Intermediário'                                   
                               ,'Avançado' => 'Avançado']);
            $fala        = new TCombo('fala');
            $fala->addItems(['Básico' => 'Básico'
                            ,'Intermediário' => 'Intermediário'                                   
                            ,'Avançado' => 'Avançado']);
            $leitura     = new TCombo('leitura');
            $leitura->addItems(['Básico' => 'Básico'
                               ,'Intermediário' => 'Intermediário'                                   
                               ,'Avançado' => 'Avançado']);            

            $add_idi = TButton::create('add_idi', [$this, 'onIdiAdd'], 'Adicionar', 'fa:save');

            $label_lingua      = new TLabel('Idioma:');
            $label_compreensao = new TLabel('Compreensão:');
            $label_escrita     = new TLabel('Escrita:');
            $label_fala        = new TLabel('Fala:');
            $label_leitura     = new TLabel('Leitura:');            
            
            $this->form->addContent( ['<hr><h4>Idiomas</h4><hr>'] );        
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
            $actioni1->setLabel('Edit');
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

        //=== Formação - INI ===        
            $id_for = new THidden('id_for');
            $id_for->setValue(0);
            $instituicao = new TEntry('instituicao');
            $curso       = new TEntry('curso');
            $tipo        = new TCombo('tipo');
            $tipo->addItems(['Graduação' => 'Graduação'                            
                            ,'Pós-Graduação' => 'Pós-Graduação'
                            ,'Curso Técnico' => 'Curso Técnico'
                            ,'Curso On-line' => 'Curso On-line'
                            ,'Cursos Complementares' => 'Cursos Complementares'
                            ,'Outros' => 'Outros']);
            $status      = new TCombo('status');
            $status->addItems(['Completo' => 'Completo'
                              ,'Cursando' => 'Cursando'
                              ,'Parado' => 'Parado']);
            $dtini       = new TDate('dtinif');
            $dtini->setMask('dd/mm/yyyy');
            $dtfim       = new TDate('dtfimf');
            $dtfim->setMask('dd/mm/yyyy');

            $add_for = TButton::create('add_for', [$this, 'onForAdd'], 'Adicionar', 'fa:save');

            $label_instituicao = new TLabel('(*) Instituição:');
            $label_curso       = new TLabel('(*) Curso:');
            $label_tipo        = new TLabel('(*) Tipo:');
            $label_status      = new TLabel('Status:');
            $label_dtini       = new TLabel('Data Início:');
            $label_dtfim       = new TLabel('Data Final:');
            
            $label_instituicao->setFontColor('#FF0000');
            $label_curso->setFontColor('#FF0000');
            $label_tipo->setFontColor('#FF0000');
            
            $this->form->addContent( ['<hr><h4>Formação</h4><hr>'] );        
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

        //=== Experiencias - INI ===        
            $id_exp = new THidden('id_exp');
            $id_exp->setValue(0);
            $empresa   = new TEntry('empresa');
            $cargo     = new TEntry('cargo');
            $atividade = new TText('atividade');
            $dtini  = new TDate('dtini');
            $dtini->setMask('dd/mm/yyyy');
            $dtfim  = new TDate('dtfim');
            $dtfim->setMask('dd/mm/yyyy');
            $atual      = new TCombo('atual');
            $atual->addItems(['SIM' => 'SIM'
                              ,'NÃO' => 'NÃO']);
            $atual->setValue("NÃO");

            $add_exp = TButton::create('add_exp', [$this, 'onExpAdd'], 'Adicionar', 'fa:save');

            $label_empresa   = new TLabel('(*) Empresa:');
            $label_cargo     = new TLabel('(*) Cargo:');
            $label_atividade = new TLabel('(*) Atividades:');
            $label_dtini     = new TLabel('Data Entrada:');
            $label_dtfim     = new TLabel('Data Saída:');
            $label_atual     = new TLabel('Emprego Atual:');
            
            $label_empresa->setFontColor('#FF0000');
            $label_atividade->setFontColor('#FF0000');
            $label_cargo->setFontColor('#FF0000');
            
            $this->form->addContent( ['<hr><h4>Experiências</h4><hr>'] );        
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
        //=== Experiencias - FIM ===        
         
        // create the form actions
        $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        //$this->form->addAction(_t('New'),  new TAction([$this, 'onEdit']), 'fa:eraser red');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);

        $this->onEditLogado($param);
    }

    public function onIdiAdd( $param ) {
        $this->msgsalva = false;
        if ($this->onSave($param)) {
            $this->msgsalva = true;
            try {
                TTransaction::open('permission');
                $data = $this->form->getData();
                
                if( (! $data->lingua) || (! $data->compreensao) || (! $data->fala) )
                    throw new Exception('Campos idioma devem serem todos informados.');
                
                $idi = new Idiomas();
                if ($data->id_idi > 0) {
                    $idi->id = $data->id_idi;
                }
                $idi->lingua = $data->lingua;
                $idi->compreensao = $data->compreensao;
                $idi->escrita = $data->escrita;
                $idi->fala = $data->fala;
                $idi->leitura = $data->leitura;
                $idi->id_user = $data->id;
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
                $this->onReloadFor( $param );
                $this->onReloadExp( $param );
            } catch (Exception $e) {
                $this->form->setData( $this->form->getData());
                new TMessage('error', $e->getMessage());
            }
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

        TForm::sendData( 'form_cv', $data );
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

    public function onForAdd( $param ) {
        $this->msgsalva = false;
        if ($this->onSave($param)) {
            $this->msgsalva = true;
            try
            {
                TTransaction::open('permission');
                $data = $this->form->getData();
                
                if( (! $data->instituicao) || (! $data->curso) || (! $data->tipo) )
                    throw new Exception('Campos formação devem serem todos informados.');
                
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
                $for->id_user = $data->id;
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
                
                $this->onReloadIdi( $param );
                $this->onReloadFor( $param );
                $this->onReloadExp( $param );
            }
            catch (Exception $e)
            {
                $this->form->setData( $this->form->getData());
                new TMessage('error', $e->getMessage());
            }
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

        TForm::sendData( 'form_cv', $data );
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

    public function onExpAdd( $param ) {
        $this->msgsalva = false;
        if ($this->onSave($param)) {
            $this->msgsalva = true;
            try
            {
                TTransaction::open('permission');
                $data = $this->form->getData();
                
                if( (! $data->empresa) || (! $data->cargo) || (! $data->atividade) )
                    throw new Exception('Campos experiências devem serem todos informados.');
                
                $exp = new Experiencias();
                if ($data->id_exp > 0) {
                    $exp->id = $data->id_exp;
                }
                $exp->empresa = $data->empresa;
                $exp->cargo = $data->cargo;
                $exp->atividade = $data->atividade;
                $exp->dtini = $data->dtini;
                $exp->dtfim = $data->dtfim;
                $exp->id_user = $data->id;
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
                
                $this->onReloadIdi( $param );
                $this->onReloadFor( $param );
                $this->onReloadExp( $param );
            }
            catch (Exception $e)
            {
                $this->form->setData( $this->form->getData());
                new TMessage('error', $e->getMessage());
            }
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

        TForm::sendData( 'form_cv', $data );
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
            
            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/
            
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array

            if (! $data->name) {
                throw new Exception('Campo nome completo deve ser informado.');
                return false;
            }

            if (! $data->email) {
                throw new Exception('Campo e-mail deve ser informado.');
                return false;
            }

            if (! $data->cpf) {
                throw new Exception('Campo CPF deve ser informado.');
                return false;
            }

            if (!$data->fone && !$data->celular) {
                throw new Exception('Campo Fone ou Celular deve ser informado.');
                return false;
            }
            
            $object = new SystemUser;  // create an empty object
            //$object->dtnasc = TDate::date2us($object->dtnasc);
            $object->fromArray( (array) $data); // load the object with data
            if ($object->id > 0) {
                $object->dtatualiza = date("Y-m-d H:i:s");
            }
            $object->store(); // save the object

            $object->clearTecs();
            if( !empty($data->tecs) ) {
                foreach( $data->tecs as $tec_id ) {
                    $object->addUserTecs( new Tipos($tec_id) );
                }
            }
            
            // get the generated id
            $data->id = $object->id;
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            if ($this->msgsalva) {
                new TMessage('info', 'Currículo salvo com sucesso!');
            } else {
                return true;
            }
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
            $this->onReloadFor($param);
            $this->onReloadExp($param);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}
