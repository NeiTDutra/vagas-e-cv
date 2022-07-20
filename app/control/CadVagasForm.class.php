<?php
/**
 * CadVagasForm Form
 * @author  <your name here>
 */
class CadVagasForm extends TPage
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Vagas');
        $this->form->setFormTitle('Cadastro de Vaga');
        
        // create the form fields
        $id = new THidden('id');
        $nome = new TEntry('nome');
        $descricao = new TText('descricao');
        $conhecimento = new TText('conhecimento');
        $prerequisito = new TText('prerequisito');
        $salario = new TEntry('salario');
        $beneficio = new TText('beneficio');
        $datacriacao = new TDate('datacriacao');
        $datacriacao->setValue(date('d/m/Y'));
        $datacriacao->setEditable(false);
        $datacriacao->setMask('dd/mm/yyyy');
        $datafinal = new TDate('datafinal');
        $datafinal->setMask('dd/mm/yyyy');
        $maissetedias = date('d/m/Y',strtotime("+30 days"));
        $datafinal->setValue($maissetedias);
        $status = new TCombo('status');
        $status->addItems(["Especificando","Aberta","Concluída","Cancelada"]);
        $status->setValue(0);
        $solicitante = new TEntry('solicitante');
        $email = new TEntry('email');
        $tipo = new TCombo('tipo');
        $tipo->addItems(["Efetiva","Estágio","Plantão"]);
        $tipo->setValue(0);

        $nome->addValidation('Nome Vaga', new TRequiredValidator);
        $descricao->addValidation('Atividades', new TRequiredValidator);
        $conhecimento->addValidation('Conhecimento', new TRequiredValidator);
        $prerequisito->addValidation('Pré-requisitos', new TRequiredValidator);
        $beneficio->addValidation('Benefícios', new TRequiredValidator);
        $status->addValidation('Status', new TRequiredValidator);
        $tipo->addValidation('Tipo da Vaga', new TRequiredValidator);
        $datafinal->addValidation('Data Final', new TRequiredValidator);
        $solicitante->addValidation( 'Solicitante', new TRequiredValidator );
        $email->addValidation( 'E-mail', new TEmailValidator );

        $lbs = [new TLabel('* Nome Vaga:')
               ,new TLabel('* Atividades:')
               ,new TLabel('* Conhecimentos:')
               ,new TLabel('* Pré-requisito:')
               ,new TLabel('* Benefícios:')
               ,new TLabel('Salário:')
               ,new TLabel('* Tipo Vaga:')
               ,new TLabel('* Status:')
               ,new TLabel('* Solicitante:')
               ,new TLabel('Criação:')
               ,new TLabel('* Final:')
               ,new TLabel('E-mail Solicitante:')];

        // add the fields
        $this->form->addFields( [], [ $id ] );
        $this->form->addFields( [ $lbs[0] ], [ $nome ] );
        $this->form->addFields( [ $lbs[1] ], [ $descricao ] );
        $this->form->addFields( [ $lbs[2] ], [ $conhecimento ] );
        $this->form->addFields( [ $lbs[3] ], [ $prerequisito ] );        
        $this->form->addFields( [ $lbs[4] ], [ $beneficio ] );        
        $this->form->addFields( [ $lbs[5] ], [ $salario ], [ $lbs[6] ], [ $tipo ] );
        $this->form->addFields( [ $lbs[7] ], [ $status ], [ $lbs[8] ], [ $solicitante ] );
        $this->form->addFields( [ $lbs[11] ], [ $email ] );
        $this->form->addFields( [ $lbs[9] ], [ $datacriacao ], [ $lbs[10] ], [ $datafinal ] );        

        // set sizes        
        $nome->setSize('80%');
        $descricao->setSize('90%');
        $conhecimento->setSize('90%');
        $prerequisito->setSize('90%');        
        $beneficio->setSize('90%');
        $salario->setSize('100%');
        $datacriacao->setSize('100%');
        $datafinal->setSize('100%');
        $status->setSize('100%');
        
        /** samples
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( '100%' ); // set size
         **/
         
        // create the form actions
        $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave']), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addAction(_t('New'),  new TAction([$this, 'onEdit']), 'fa:eraser red');
        $this->form->addAction("Voltar",  new TAction(["ListaDeVagas", 'onReload']), 'fa:arrow-circle-o-left');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param ) {
        try
        {
            TTransaction::open('permission'); // open a transaction
            
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array
            
            $object = new Vagas;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $object->datacriacao = TDate::date2us($object->datacriacao );
            $object->datafinal = TDate::date2us($object->datafinal );
            $object->store(); // save the object
            
            // get the generated id
            $data->id = $object->id;
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            new TMessage('info', TAdiantiCoreTranslator::translate('Record saved'), new TAction(array('ListaDeVagas','onReload')));
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
    public function onClear( $param )
    {
        $this->form->clear(TRUE);
    }
    
    /**
     * Load object to form data
     * @param $param Request
     */
    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('permission'); // open a transaction
                $object = new Vagas($key); // instantiates the Active Record
                $object->datacriacao = TDate::date2br($object->datacriacao);
                $object->datafinal = TDate::date2br($object->datafinal);
                $this->form->setData($object); // fill the form
                TTransaction::close(); // close the transaction
            }
            else
            {
                $this->form->clear(TRUE);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
}
