<?php
/**
 * CadCurriculo01 Dados pessoais
 * @author  Willian Wagner
 */
class CadCurriculo01 extends TPage
{
    protected $form; // form
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param ) {
        parent::__construct();
        $page = TSession::getValue('pagecv');
        if ($page === '' or isset($page) === false ) {
            TSession::setValue('pagecv', 'CadCurriculo01');
        } else if (TSession::getValue('pagecv') !== __CLASS__) {
            AdiantiCoreApplication::loadPage(TSession::getValue('pagecv'));
        }

        $this->form = new BootstrapFormBuilder('form_01');
        $this->form->setFormTitle('<b>Cadastro de Currículo</b>');

        $breadcrumb = new TBreadCrumb;
        $breadcrumb->addItem('Dados Pessoais');
        $breadcrumb->addItem('Conhecimentos');
        $breadcrumb->addItem('Formação');
        $breadcrumb->addItem('Experiências');
        $breadcrumb->select('Dados Pessoais');

        TScript::create('buscaCep = function(valor) {
            $.ajaxSetup({            
                beforeSend: function(xhr) {},
                success: function (vdata) { 
                    console.log(vdata);
                    if (vdata.message !== undefined) {
                        alert(vdata.message);
                    } else {
                        if (document.form_01 != undefined) {
                            document.form_01.endereco.value = vdata.logradouro;
                            document.form_01.cidade.value   = vdata.localidade;
                            document.form_01.bairro.value   = vdata.bairro;
                            document.form_01.estado.value   = vdata.uf;
                        }
                    }
                },
                complete: function (vdata,str) {
                },
                error: function (vdata) {
                    console.log(vdata);
                }
            });
            var vetor = valor.split("-");
            if (vetor.length > 1) {
                valor = vetor[0] + vetor[1];
            }
            if (valor !== undefined && valor !== "") {
                $.ajax({
                    type: "GET",
                    crossDomain: true,
                    url: "https://viacep.com.br/ws/"+valor+"/json/",
                    timeout: 60000,
                    cache: false,
                    data: "",
                    dataType: "json"
                });
            }
        };');

        // create the form fields
        $id = new THidden('id');
        $photo = new TFile('photo');
        $photo->setAllowedExtensions( ['jpeg','jpg','png'] );
        $name = new TEntry('name');        
        $email = new TEntry('email');
        $email->setEditable(false);
        $cpf = new TEntry('cpf');
        $cpf->setEditable(true);
        $rg = new TEntry('rg');        
        $fone = new TEntry('fone');        
        $celular = new TEntry('celular');
        $sexo = new TCombo('sexo');
        $sexo->addItems( ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'] );
        $dtnasc = new TDate('dtnasc');
        $dtnasc->setMask('dd/mm/yyyy');
        $estcivil = new TCombo('estcivil');
        $estcivil->addItems( ['Solteiro' => 'Solteiro', 'Casado' => 'Casado', 'Separado' => 'Separado', 'Viúvo(a)' => 'Viúvo(a)', 'União Estável' => 'União Estável'] );
        $endereco = new TEntry('endereco');
        $bairro = new TEntry('bairro');
        $cep = new TEntry('cep');
        $cep->onBlur = "buscaCep(this.value)";
        $cidade = new TEntry('cidade');
        $estado = new TCombo('estado');
        $pais = new TEntry('pais');

        if (LANG == 'pt') { // Estados do brasil
            $fone->setMask('(99)9999-9999');
            $cpf->setMask('999.999.999-99');
            $celular->setMask('(99)99999-9999');
            $cep->setMask('99999-999');
            $estado->addItems( ['AC' => 'ACRE'
                            ,'AL' => 'ALAGOAS'
                            ,'AM' => 'AMAZONAS'
                            ,'AP' => 'AMAPA'
                            ,'BA' => 'BAHIA'
                            ,'CE' => 'CEARA'
                            ,'DF' => 'DISTRITO FEDERAL'
                            ,'ES' => 'ESPIRITO SANTO'
                            ,'GO' => 'GOIAS'
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
            $pais->setValue("Brasil");
        } else if (LANG == 'pt_pt') { // Estados de portual
            $fone->setMask('999999999');
            $cpf->setMask('999999999');
            $celular->setMask('999999999');
            $cep->setMask('9999-999');
            $estado->addItems( ["Lisboa"=>"Lisboa",
                                "Braga"=>"Braga",
                                "Bragança"=>"Bragança",
                                "Aveiro"=>"Aveiro",
                                "Porto"=>"Porto",
                                "Viana do Castelo"=>"Viana do Castelo",
                                "Vila Real"=>"Vila Real",
                                "Viseu"=>"Viseu",
                                "Coimbra"=>"Coimbra",
                                "Castelo Branco"=>"Castelo Branco",
                                "Guarda"=>"Guarda",
                                "Leiria"=>"Leiria",
                                "Santarém"=>"Santarém",
                                "Faro"=>"Faro",
                                "Portalegre"=>"Portalegre",
                                "Beja"=>"Beja",
                                "Setúbal"=>"Setúbal",
                                "Évora"=>"Évora"] );
            $pais->setValue("Brasil");
        }
        $cnh = new TCombo('cnh');
        $cnh->addItems(['AB' => 'AB', 'A' => 'A', 'B' => 'B', 'Não Habilitado' => 'Não Habilitado']);

        $dispvia = new TCombo('dispvia');
        $dispvia->addItems([_t('Yes') => _t('Yes'), _t('No') => _t('No')]);
        $dispmud = new TCombo('dispmud');
        $dispmud->addItems([_t('Yes') => _t('Yes'), _t('No') => _t('No')]);
        $estaempregado = new TCombo('estaempregado');
        $estaempregado->addItems([_t('Yes') => _t('Yes'), _t('No') => _t('No')]);

        // Modificado por nei.thomass@gmail.com
        $diasdisponivel = new TCheckGroup('diasdisponivel');
        // $diasdisponivel->setLayout('horizontal');
        $diasdisponivel->addItems( ['Domingo'=>'Domingo',
                                    'Segunda-Feira'=>'Segunda-Feira',
                                    'Terça-Feira'=>'Terça-Feira',
                                    'Quarta-Feira'=>'Quarta-Feira',
                                    'Quinta-Feira'=>'Quinta-Feira',
                                    'Sexta-Feira'=>'Sexta-Feira',
                                    'Sábado'=>'Sábado'] );

        $turnosdisponivel = new TCheckGroup('turnosdisponivel');
        // $turnosdisponivel->setLayout('horizontal');
        $turnosdisponivel->addItems( ['Primeiro Turno'=>'Primeiro Turno',
                                      'Segundo Turno'=>'Segundo Turno',
                                      'Terceiro Turno'=>'Terceiro Turno',
                                      'Normal'=>'Normal',
                                      'Indiferente'=>'Indiferente'] );
        // Fim da modificação por nei.thomass@gmail.com
        
        $necespecial = new TCombo('necespecial');
        $necespecial->addItems([_t('Yes') => _t('Yes'), _t('No') => _t('No')]);
        $necespecial->setValue(_t('No'));
        $qualnecespecial = new TEntry('qualnecespecial');
        $cargopretende = new TEntry('cargopretende');
        $objetivo = new TText('objetivo');

        $lbnome = new TLabel('* '._t('Name').':');
        $lbemail = new TLabel('* '._t('Email').':');
        $lbcpf = new TLabel('* '._t('CPF').':');
        $lbfone = new TLabel('* '._t('Phone').':');
        $lbcelular = new TLabel('* '._t('Cell Phone').':');

        // add the fields        
        $this->form->addFields( [ new TLabel(_t('Photo').':') ], [$photo ] );
        $this->form->addFields( [ $lbnome ], [$id, $name ], [ $lbemail ], [ $email ] );
        $this->form->addFields( [ $lbcpf ], [ $cpf ], [ new TLabel(_t('RG').':') ], [ $rg ], [ new TLabel('* '._t('CNH').':') ], [ $cnh ] );
        $this->form->addFields( [ $lbfone ], [ $fone ], [ $lbcelular ], [ $celular ] );
        $this->form->addFields( [ new TLabel(_t('Civil status'). ':') ], [ $estcivil ], [ new TLabel('* '._t('Genre').':') ], [ $sexo ], [ new TLabel('* '._t('Nascimento Data').':') ], [ $dtnasc ] );
        $this->form->addFields( [ new TLabel(_t('Postal Code').':') ], [ $cep ], [ new TLabel('* '._t('Address').':') ], [ $endereco ] );
        $this->form->addFields( [ new TLabel('* '._t('District').':') ], [ $bairro ], [ new TLabel('* '._t('City').':') ], [ $cidade ] );
        $this->form->addFields( [ new TLabel('* '._t('State').':') ], [ $estado ], [ new TLabel('* '._t('Country').':') ], [ $pais ] );
        $this->form->addFields( [ new TLabel('* '._t('Travel Availability').':') ], [ $dispvia ], [ new TLabel('* '._t('Availability Changes').':') ], [ $dispmud ], [ new TLabel('* '._t('Is employed').':') ], [ $estaempregado ] );
        // Modificado por nei.thomass@gmail.com
        $this->form->addFields( [ new TLabel('* Dispon. Dias:') ], [ $diasdisponivel ], [ new TLabel('* Dispon. Turnos:') ], [ $turnosdisponivel ] );
        // Fim da modificação por nei.thomass@gmail.com
        $this->form->addFields( [ new TLabel('* '._t('Special needs').':') ], [ $necespecial ], [ new TLabel(_t('What').'?') ], [ $qualnecespecial ] );
        $this->form->addFields( [ new TLabel(_t('Intended position')) ], [ $cargopretende ] );
        $this->form->addFields( [ new TLabel(_t('Objectives')) ], [ $objetivo ] );

        // set sizes
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
        $diasdisponivel->setSize('100%');
        $turnosdisponivel->setSize('100%');
        $estaempregado->setSize('100%');
        $cnh->setSize('100%');
        $objetivo->setSize('100%',50);
        $necespecial->setSize('100%');
        $qualnecespecial->setSize('100%');
        $cargopretende->setSize('100%');
        
        $name->addValidation( _t('Name'), new TRequiredValidator );
        $email->addValidation( _t('Email'), new TRequiredValidator );
        $cpf->addValidation( _t('CPF'), new TRequiredValidator );
        //$cpf->addValidation( 'CPF', new TCPFValidator );
        $cnh->addValidation( _t('CNH'), new TRequiredValidator );
        $celular->addValidation( _t('Cell Phone'), new TRequiredValidator );
        $sexo->addValidation( _t('Genre'), new TRequiredValidator );
        $dtnasc->addValidation( _t('Nascimento Data'), new TRequiredValidator );
        $estcivil->addValidation( _t('Civil status'), new TRequiredValidator );
        $endereco->addValidation( _t('Address'), new TRequiredValidator );
        $bairro->addValidation( _t('District'), new TRequiredValidator );
        $cidade->addValidation( _t('City'), new TRequiredValidator );
        $estado->addValidation( _t('State'), new TRequiredValidator );
        $pais->addValidation( _t('Country'), new TRequiredValidator );
        $necespecial->addValidation( _t('Special needs'), new TRequiredValidator );
        $dispvia->addValidation( _t('Travel Availability'), new TRequiredValidator );
        $dispmud->addValidation( _t('Availability Changes'), new TRequiredValidator );
        // Adicionado por nei.thomass@gmail.com
        $diasdisponivel->addValidation( '* Dispon. Dias:', new TRequiredValidator );
        $turnosdisponivel->addValidation( '* Dispon. Turnos:', new TRequiredValidator );
        // Fim da adição
        $estaempregado->addValidation( _t('Is employed'), new TRequiredValidator );
         
        // create the form actions
        $btn = $this->form->addAction(_t('Save and Next'), new TAction([$this, 'onSave']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        
        $this->form->add($breadcrumb);
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add($this->form);
        
        parent::add($container);

        $this->onEditLogado($param);
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
            
            $object = new SystemUser;
            $object->fromArray( (array) $data); // load the object with data
            // Adicionando por nei.thomass@gmail.com
            $object->diasdisponivel = implode('|',$data->diasdisponivel);
            $object->turnosdisponivel = implode('|',$data->turnosdisponivel);
            // Fim adição
            if ($object->id > 0) {
                $object->dtatualiza = date("Y-m-d H:i:s");
            }
            
            if ($data->photo) {
                /*$source_file = 'tmp/'.$data->photo;                
                //$finfo       = new finfo(FILEINFO_MIME_TYPE);
                $path_parts = pathinfo($source_file);
                
                if (file_exists($source_file) AND (strtolower($path_parts['extension'] == 'jpeg') or strtolower($path_parts['extension']) == 'jpg'))
                {
                    $target_file   = 'app/images/photos/' . TSession::getValue('login') . '.jpg';
                    // move to the target directory
                    rename($source_file, $target_file);
                }
                /*$path_parts = pathinfo($source_file);
                if (file_exists($source_file) AND (strtolower($path_parts['extension'] == 'jpeg') or strtolower($path_parts['extension']) == 'jpg'))
                {
                    $target_file   = 'app/images/photos/' . TSession::getValue('login') . '.png';
                    // move to the target directory
                    rename($source_file, $target_file);
                }*
                */

                $files = glob('app/images/photos/' . TSession::getValue('login') . '*'); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file))
                        unlink($file); // delete file
                }
                $source_file   = 'tmp/'.$data->photo;
                $expl          = explode('.',$source_file);
                $target_file   = 'app/images/photos/' . TSession::getValue('login') .'.'. $expl[1];
                //$finfo         = new finfo(FILEINFO_MIME_TYPE);
                $path_parts = pathinfo($source_file);
                
                if (file_exists($source_file)) //AND (strtolower($path_parts['extension'] == 'jpeg') or strtolower($path_parts['extension']) == 'jpg'))
                {
                    // move to the target directory
                    rename($source_file, $target_file);
                }
                $object->arquivo = $target_file;
            }

            
            $object->store();
            $data->id = $object->id;
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TSession::setValue('pagecv', 'CadCurriculo02');
            AdiantiCoreApplication::loadPage('CadCurriculo02');
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
            $this->form->setData($login);            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}
