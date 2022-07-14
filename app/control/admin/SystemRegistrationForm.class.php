<?php
/**
 * SystemRegistrationForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemRegistrationForm extends TPage
{
    protected $form; // form
    protected $program_list;
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_registration');
        $this->form->setFormTitle( _t('User registration') );
        
        // create the form fields
        $login      = new TEntry('login');
        $name       = new TEntry('name');
        $email      = new TEntry('email');
        $password   = new TPassword('password');
        $repassword = new TPassword('repassword');
        $fone = new TEntry('fone');
        $celular = new TEntry('celular');
        $cpf = new TEntry('cpf');
        if (LANG == 'pt') {
            $cpf->setMask('999.999.999-99');
            $fone->setMask('(99)9999-9999');
            $celular->setMask('(99)99999-9999');
        } else if (LANG == 'pt_pt') {
            $cpf->setMask('999999999');
            $fone->setMask('99999999');
            $celular->setMask('999999999');
        }
        
        $this->form->addAction( _t('Save'),  new TAction([$this, 'onSave']), 'fa:floppy-o')->{'class'} = 'btn btn-sm btn-primary';
        $this->form->addAction( _t('Clear'), new TAction([$this, 'onClear']), 'fa:eraser red' );
        //$this->form->addActionLink( _t('Back'),  new TAction(['LoginForm','onReload']), 'fa:arrow-circle-o-left blue' );
        
        // define the sizes
        $name->setSize('100%');
        $login->setSize('100%');
        $password->setSize('100%');
        $repassword->setSize('100%');
        $email->setSize('100%');
        
        $this->form->addFields( [new TLabel(_t('Login'), 'red')],    [$login] );
        $this->form->addFields( [new TLabel(_t('Name'), 'red')],     [$name] );
        $this->form->addFields( [new TLabel(_t('Email'), 'red')],    [$email], [new TLabel(_t('CPF'), 'red')],  [$cpf] );
        $this->form->addFields( [new TLabel('Fone', 'red')],    [$fone], [new TLabel(_t('Cell Phone'), 'red')],  [$celular] );
        $this->form->addFields( [new TLabel(_t('Password'), 'red')], [$password] );
        $this->form->addFields( [new TLabel(_t('Password confirmation'), 'red')], [$repassword] );

        //$cpf->addValidation( _t('CPF'), new TCPFValidator );
        
        $this->style = 'width: 70%;'.
                       'align-items: center;'.
                       'display: flex;'.
                       'flex-direction: row;'.
                       'flex-wrap: wrap;'.
                       'justify-content: center;';

        // add the container to the page
        parent::add($this->form);
    }
    
    /**
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear( true );
    }
    
    public function onLoad($param){
    }

    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    public function onSave($param)
    {
        try
        {
            $this->form->validate(); // validate form data
            
            $ini = AdiantiApplicationConfig::get();
            if ($ini['permission']['user_register'] != '1')
            {
                throw new Exception( _t('The user registration is disabled') );
            }
            
            // open a transaction with database 'permission'
            TTransaction::open('permission');
            
            if( empty($param['login']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('Login')));
                return;
            }
            
            if( empty($param['name']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('Name')));
                return;
            }
            
            if( empty($param['email']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('Email')));
                return;
            }

            if( empty($param['cpf']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('CPF')));
                return;
            }

            if( empty($param['fone']) && empty($param['celular']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('Cell Phone')));
                return;
            }
            
            if( empty($param['password']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('Password')));
                return;
            }
            
            if( empty($param['repassword']) )
            {
                throw new Exception(_t('The field ^1 is required', _t('Password confirmation')));
                return;
            }
            
            if (SystemUser::newFromLogin($param['login']) instanceof SystemUser)
            {
                throw new Exception(_t('An user with this login is already registered'));
                return;
            }
            
            if (SystemUser::newFromEmail($param['email']) instanceof SystemUser)
            {
                throw new Exception(_t('An user with this e-mail is already registered'));
                return;
            }

            if (SystemUser::newFromCpf($param['cpf']) instanceof SystemUser)
            {
                throw new Exception(_t('Já existe um usuário cadastrado com o CPF informado.'));
                return;
            }
            
            if( $param['password'] !== $param['repassword'] )
            {
                throw new Exception(_t('The passwords do not match'));
                return;
            }
            
            $object = new SystemUser;
            $object->active     = 'Y';
            $object->dtcriacao  = date("Y-m-d H:i:s");
            $object->dtatualiza = date("Y-m-d H:i:s");
            $object->fromArray( $param );
            $object->password = md5($object->password);
            $object->frontpage_id = $ini['permission']['default_screen'];
            $object->clearParts();
            $object->store();
            
            $default_groups = explode(',', $ini['permission']['default_groups']);
            
            if( count($default_groups) > 0 )
            {
                foreach( $default_groups as $group_id )
                {
                    $object->addSystemUserGroup( new SystemGroup($group_id) );
                }
            }
            TTransaction::close(); // close the transaction

            $this->onEnvEmail($param);

            $pos_action = new TAction(['LoginForm', 'onLoad']);
            new TMessage('info', _t('Account created') . ". Acesse o sistema para continuar o cadastro.", $pos_action); // shows the success message
        }
        catch (Exception $e)
        {   
            //print_r($e);
            $this->form->setData( $this->form->getData() ); // keep form data
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }

    public function onEnvEmail($param)
    {
        try
        {
            $login = $param['login'];            
            $referer = $_SERVER['HTTP_REFERER'];
            $url = substr($referer, 0, strpos($referer, 'index.php'));
            $url .= 'index.php?class=LoginForm';
            
            $replaces = [];
            $replaces['name']  = $param['name'];
            $replaces['login'] = $param['login'];
            $replaces['senha'] = $param['password'];
            $replaces['link']  = $url;
            $html = new THtmlRenderer('app/resources/system_register.html');
            $html->enableSection('main', $replaces);
            
            MailService::send( $param['email'], "Registro AgroTalentos", $html->getContents(), 'html' );
            //new TMessage('info', '');
            
        }
        catch (Exception $e)
        {
            new TMessage('error',$e->getMessage());
            TTransaction::rollback();
        }
    }
}
