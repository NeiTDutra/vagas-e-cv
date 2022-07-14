<?php
class VisualizaCandidatos extends TPage {
    private $login;
    private $emaillogado;
    public $classe;
    private $nmpdf;
    public function __construct() {
        parent::__construct();
        
        // create the HTML Renderer
        $this->html = new THtmlRenderer('app/resources/visualiza_candidatos.html');

        try {
            $replace = array();            
            
            TTransaction::open('permission');
            $object = new Vagas($_REQUEST['id']);            

            $this->nmpdf = 'candidatos.pdf';
            $replace['dttime'] = date('ymdhmss');
            
            if ($this->classe == '') {
                $this->classe = __CLASS__;
            }

            $replace['classe'] = $this->classe;
            $replace['object'] = $object;            

            $replace['candidatos'] = [ [ 'details' =>  $this->getCandidatos($object->id) ] ];

            TTransaction::close();
                                                      
            // replace the main section variables
            $this->html->enableSection('main', $replace);
            
            // wrap the page content using vertical box
            $vbox = new TVBox;
            $vbox->style = 'width: 100%';

            $vbox->add($this->html);
            parent::add($vbox);
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }

    public function onPrint ($param) {
        try {
            // open window to show pdf
            $window = TWindow::create("Impressão do Candidatos", 0.9, 0.9);
            $object = new TElement('object');
            $object->data  = $this->geraCv () . '?_ch='.date('ymdhms');
            $object->type  = 'application/pdf';
            $object->style = "width: 100%; height:calc(100% - 10px)";
            $window->add($object);
            $window->show();
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }

    public function geraCv () {
        try {
            $contents = $this->html->getContents();
            
            // converts the HTML template into PDF
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($contents);
            $dompdf->setPaper('A4', 'portrait'); //landscape or portrait
            $dompdf->render();
            
            // write and open file
            file_put_contents('tmp/'.$this->nmpdf, $dompdf->output());

            return 'tmp/'.$this->nmpdf;
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }

    public function getCandidatos($idvaga) {
        $repository = new TRepository('VagaUser');
        $criteria = new TCriteria;
        if (empty($param['order'])) {
            $param['order'] = 'id';
            $param['direction'] = 'asc';
        }
        $criteria->add(new TFilter('id_vaga', '=', $idvaga));
        $criteria->setProperties($param);
        $objects = $repository->load($criteria, FALSE);
        $retorno = array();
        if ($objects) {
            foreach ($objects as $object) {
                $user = new SystemUser($object->id_user);
                $retorno[] = ["id" => $user->id,
                              "name" => $user->name,
                              "cidade" => $user->cidade,
                              "fone" => $user->fone,
                              "celular" => $user->celular,
                              "email" => $user->email];
            }
        }
        $criteria->resetProperties();

        return $retorno;
    }

    public function onReload ($param) {
    }
}
