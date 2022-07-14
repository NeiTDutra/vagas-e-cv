<?php
/**
 * VisualizaVaga Form
 * @author  <your name here>
 */
class VisualizaVaga extends TPage
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        $html = new THtmlRenderer('app/resources/visualizavaga.html');
        $replaces = array();
        
        try
        {
            TTransaction::open('permission');
            
            $vaga = new Vagas($_REQUEST['id']);
            $replaces = $vaga->toArray();
            $replaces['id'] = $vaga->id;
            $replaces['nmtipo'] = $vaga->nmtipo;
            $replaces['nome'] = $vaga->nome;
            $replaces['descricao'] = nl2br($vaga->descricao);
            $replaces['conhecimento'] = nl2br($vaga->conhecimento);
            $replaces['prerequisito'] = nl2br($vaga->prerequisito);
            $replaces['beneficio'] = nl2br($vaga->beneficio);
            $replaces['css'] = "";
            if ($vaga->status != 1) {
                $replaces['css'] = "display: none;";
            }

            $replaces['icobt'] = 'fa-hand-o-up';
            if ( TSession::getValue('logged') ) {
                $login = SystemUser::newFromLogin( TSession::getValue('login') );
                $replaces['classe'] = 'ListaVagasDisponiveis';
                $replaces['classert'] = 'ListaVagasDisponiveis';
                $replaces['method'] = 'onCandidatar';
                $replaces['nmbtn'] = 'Candidatar-se';
                $object = new VagaUser;
                $idcan = $object->validaVagaUser($login->id, $_REQUEST['id'], false);                    
                if ($idcan > 0) {                    
                    $replaces['nmbtn'] = 'Já se Candidatou';
                    $replaces['icobt'] = 'fa-check';
                }
            } else {
                $replaces['classert'] = 'VagasListPublica';
                $replaces['classe'] = 'LoginForm';
                $replaces['method'] = 'onLoad';
                $replaces['nmbtn'] = 'Candidatar-se';
            }
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
        
        $html->enableSection('main', $replaces);
        $html->enableTranslation();
        
        $container = TVBox::pack($html);
        $container->style = 'width:80%';
        parent::add($container);
    }

    public function onLoad() {

    }
}
