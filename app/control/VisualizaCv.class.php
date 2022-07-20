<?php
class VisualizaCv extends TPage {
    private $login;
    private $emaillogado;
    public $classe;
    private $nmpdf;
    public function __construct($vtipo = '') {
        parent::__construct();
        
        // create the HTML Renderer
        if (LANG == 'pt_pt') { 
            $this->html = new THtmlRenderer('app/resources/visualiza_cvpt_pt.html');
        } else {
            $this->html = new THtmlRenderer('app/resources/visualiza_cv.html');
        }

        try {
            $replace = array();            
            
            TTransaction::open('permission');
            
            $this->login = SystemUser::newFromLogin( TSession::getValue('login') );
            $this->emaillogado = $this->login->email;
            if ($_GET['id'] > 0 && $vtipo == '') {
                $this->login = new SystemUser( $_GET['id'] );
            }

            $this->nmpdf = $this->login->login . '.pdf';
            $replace['dttime'] = date('ymdhmss');
            
            if ($this->classe == '') {
                $this->classe = __CLASS__;
            }
            $this->login->objetivo = nl2br($this->login->objetivo);
            $replace['classe'] = $this->classe;
            $replace['foto'] = $this->login->get_foto();
            $replace['object'] = $this->login;

            $con = $this->getConhecimentos($this->login->id);
            if (count($con) > 0) {
                $replace['conhecimentos'] = [ [ 'details' => $con ] ];
            }
            $idi = $this->getIdiomas($this->login->id);
            if (count($idi) > 0) {
                $replace['idiomas'] = [ [ 'details' => $idi ] ];
            }
            $for = $this->getFormacao($this->login->id);
            if (count($for) > 0) {
                $replace['formacao']      = [ [ 'details' => $for ] ];
            }
            $exp = $this->getExper($this->login->id);
            if (count($exp) > 0) {
                $replace['experiencias']  = [ [ 'details' => $exp ] ];
            }
            TTransaction::close();
                                                      
            // replace the main section variables
            $this->html->enableSection('main', $replace);
            
            // wrap the page content using vertical box
            $vbox = new TVBox;
            $vbox->style = 'width: 100%';
            //$xmlmenu = new TXMLBreadCrumb('menu.xml', __CLASS__);
//            print_r(__CLASS__);
            //$vbox->add($xmlmenu);
            $vbox->add($this->html);
            parent::add($vbox);
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEnvEmail ($param) {
        try {
            TTransaction::open('permission');            
            $prefs  = SystemPreference::getAllPreferences();
            TTransaction::close();

            $this->geraCv();
            $mail = new TMail;
            $mail->setFrom($prefs['mail_from'], APPLICATION_NAME);
            $mail->setSubject("Currículo ");
            $mail->setHtmlBody("Segue anexo Currículo .");

            if ($param['class'] == 'CadCurriculo04') {
                $mail->addAddress($prefs['mail_from'], $prefs['mail_from']);
                //$mail->addAddress('willian.wagner@.com.br', 'willian.wagner@.com.br');
                $mail->setSubject("Currículo Concluído - " . $this->login->name);
                $mail->setHtmlBody("Segue anexo Currículo.");
            } else {
                $mail->addAddress($this->emaillogado, $this->login->name);
            }

            $mail->addAttach('tmp/'.$this->nmpdf);
            $mail->SetUseSmtp();
            $mail->SetSmtpHost($prefs['smtp_host'], $prefs['smtp_port']);
            $mail->SetSmtpUser($prefs['smtp_user'], $prefs['smtp_pass']);
            $mail->send();

            if ($param['class'] != 'CadCurriculo04') {
                new TMessage('info', "E-mail enviado corretamente.");
            }
        } catch (Exception $e) // in case of exception
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage() );
        }
    }

    public function onPrint ($param) {
        try {
            // open window to show pdf
            $window = TWindow::create("Impressão do Currículo", 0.9, 0.9);
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

            return './tmp/'.$this->nmpdf;
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }

    public function getIdiomas($iduser) {
        $repository = new TRepository('Idiomas');
        
        $criteria = new TCriteria;
        if (empty($param['order'])) {
            $param['order'] = 'id';
            $param['direction'] = 'asc';
        }
        $criteria->add(new TFilter('id_user', '=', $iduser));
        $criteria->setProperties($param);
        $objects = $repository->load($criteria, FALSE);
        $retorno = array();
        if ($objects) {            
            foreach ($objects as $object) {
                $retorno[] = ["lingua" => $object->lingua,
                              "compreensao" => $object->compreensao,
                              "escrita" => $object->escrita,
                              "fala" => $object->fala,
                              "leitura" => $object->leitura];                
            }
        }
        $criteria->resetProperties();
        
        return $retorno;
    }

    public function getConhecimentos($iduser) {
        $object = new SystemUser($iduser);
        if( $tecs_db = $object->getUserTipos() ) {
            $vi = 0;
            $tecs[] = ["tec0"=>"&nbsp;","tec1"=>"&nbsp;","tec2"=>"&nbsp;","tec3"=>"&nbsp;"];
            $vnr = 0;
            foreach( $tecs_db as $tipo ) {
                $tecs[$vi]["tec".$vnr] = $tipo->descricao;
                $vnr++;
                if ($vnr % 4 == 0) {
                    $vi++;
                    $tecs[] = ["tec0"=>"&nbsp;","tec1"=>"&nbsp;","tec2"=>"&nbsp;","tec3"=>"&nbsp;"];
                    $vnr = 0;
                }
            }
            $tecs[] = ["tec0"=>"&nbsp;","tec1"=>"&nbsp;","tec2"=>"&nbsp;","tec3"=>"&nbsp;"];
        }
        return $tecs;
    }

    public function getFormacao($iduser) {
        $repository = new TRepository('Formacao');
        $criteria = new TCriteria;
        if (empty($param['order'])) {
            $param['order'] = 'id';
            $param['direction'] = 'asc';
        }
        $criteria->add(new TFilter('id_user', '=', $iduser));
        $criteria->setProperties($param);
        $objects = $repository->load($criteria, FALSE);
        $retorno = array();
        if ($objects) {
            foreach ($objects as $object) {
                $retorno[] = ["curso" => $object->curso,
                              "instituicao" => $object->instituicao,
                              "status" => $object->status,
                              "tipo" => $object->tipo,
                              "dtini" => $object->dtini,
                              "dtfim" => $object->dtfim];
            }
        }
        $criteria->resetProperties();

        return $retorno;
    }

    public function getExper($iduser) {
        $repository = new TRepository('Experiencias');
        $criteria = new TCriteria;
        if (empty($param['order'])) {
            $param['order'] = 'id';
            $param['direction'] = 'asc';
        }
        $criteria->add(new TFilter('id_user', '=', $iduser));
        $criteria->setProperties($param);
        $objects = $repository->load($criteria, FALSE);
        $retorno = array();
        if ($objects) {
            foreach ($objects as $object) {
                $object->atividade = nl2br($object->atividade);
                $retorno[] = ["empresa" => $object->empresa,
                              "cargo" => $object->cargo,
                              "atividade" => $object->atividade,
                              "dtini" => $object->dtini,
                              "dtfim" => $object->dtfim,
                              "atual" => $object->atual];
            }
        }
        $criteria->resetProperties();
        return $retorno;
    }

    public function onReload ($param) {
    }
}
