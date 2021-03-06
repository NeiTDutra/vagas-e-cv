<?php
/**
 * SystemProfileForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemProfileForm extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormWrapper(new TQuickForm);
        $this->form->setFormTitle(_t('Profile'));
        
        $name  = new TEntry('name');
        $login = new TEntry('login');
        $email = new TEntry('email');
        $photo = new TFile('photo');
        $password1 = new TPassword('password1');
        $password2 = new TPassword('password2');
        $login->setEditable(FALSE);
        $photo->setAllowedExtensions( ['jpeg','jpg','png'] );
        
        $this->form->addQuickField( _t('Name'), $name, '80%', new TRequiredValidator );
        $this->form->addQuickField( _t('Login'), $login, '80%', new TRequiredValidator );
        $this->form->addQuickField( _t('Email'), $email, '80%', new TRequiredValidator );
        $this->form->addQuickField( _t('Photo'), $photo, '80%' );
        $this->form->addQuickField( _t('Password'), $password1, '80%' );
        $this->form->addQuickField( _t('Password confirmation'), $password2, '80%' );
        
        $btn = $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:save');
        $btn->class = 'btn btn-sm btn-primary';
        
        $panel = new TPanelGroup(_t('Profile'));
        $panel->add($this->form);
        
        $container = TVBox::pack($panel);
        $container->style = 'width:90%';
        parent::add($container);
    }
    
    public function onEdit($param)
    {
        try
        {
            TTransaction::open('permission');
            $login = SystemUser::newFromLogin( TSession::getValue('login') );
            $this->form->setData($login);
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    public function onSave($param)
    {
        try
        {
            $this->form->validate();
            
            $object = $this->form->getData();
            
            TTransaction::open('permission');
            $user = SystemUser::newFromLogin( TSession::getValue('login') );
            $user->name = $object->name;
            $user->email = $object->email;
            
            if( $object->password1 )
            {
                if( $object->password1 != $object->password2 )
                {
                    throw new Exception(_t('The passwords do not match'));
                }
                
                $user->password = md5($object->password1);
            }
            else
            {
                unset($user->password);
            }
            
            if ($object->photo)
            {
                $files = glob('app/images/photos/' . TSession::getValue('login') . '*'); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file))
                        unlink($file); // delete file
                }
                $source_file   = 'tmp/'.$object->photo;
                $expl          = explode('.',$source_file);
                $target_file   = 'app/images/photos/' . TSession::getValue('login') .'.'. $expl[1];
                //$finfo         = new finfo(FILEINFO_MIME_TYPE);
                $path_parts = pathinfo($source_file);
                
                if (file_exists($source_file)) //AND (strtolower($path_parts['extension'] == 'jpeg') or strtolower($path_parts['extension']) == 'jpg'))
                {
                    // move to the target directory
                    rename($source_file, $target_file);
                }
                $user->arquivo = $target_file;
            }
            $user->store();
            
            $this->form->setData($object);
            
            new TMessage('info', _t('Record saved'));
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}