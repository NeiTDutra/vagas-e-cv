<?php
/**
 * Vagas Active Record
 * @author  Willian Wagner
 */
class Vagas extends TRecord
{
    const TABLENAME = 'vagas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    public $nomestatus = array("Especificando","Aberta","Concluída","Cancelada");
    public $nometipo = array("Efetiva","Estágio","Plantão");
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('descricao');
        parent::addAttribute('conhecimento');
        parent::addAttribute('prerequisito');
        parent::addAttribute('salario');
        parent::addAttribute('beneficio');
        parent::addAttribute('datacriacao');
        parent::addAttribute('datafinal');
        parent::addAttribute('status');
        parent::addAttribute('solicitante');
        parent::addAttribute('tipo');
        parent::addAttribute('email');
    }

    public function get_nmstatus () {
        return $this->nomestatus[$this->status];
    }

    public function get_nmtipo () {
        return $this->nometipo[(($this->tipo == null) ? 0 : $this->tipo)];
    }

    public function get_usuarios ($tp = null) {
        try {
            if ( $this->id > 0) {
                $conn = TTransaction::get();
                $sth = $conn->prepare('SELECT u.* from vaga_user as vu, system_user as u ' . 
                                    'WHERE vu.id_user = u.id and ' .
                                    'id_vaga = ' . $this->id);
                $sth->execute();
                $result = $sth->fetchAll();
                
                $retorno = count($result);
                if ($tp !== null) {                    
                    $retorno = "";
                    for ($vi = 0; $vi < count($result); $vi++) {
                        $retorno .= "<b>Nome:</b> " . $result[$vi]['name'] . 
                                    ((!empty($result[$vi]['fone'])) ? " - Fone: " . $result[$vi]['fone'] : "") . 
                                    ((!empty($result[$vi]['celular'])) ? " - Celular: " . $result[$vi]['celular'] : "") . 
                                    ((!empty($result[$vi]['email'])) ? " - E-mail: " . $result[$vi]['email'] : "") . 
                                    '<br>';
                    }
                }
                    
                return $retorno;
            } else {
                return 0;
            }
        }
        catch (Exception $e)
        {
            return 0;
        }
    }

    public function get_users ($id = null) {        
        return $this->get_usuarios($this->id);
    }

    public function getVagasAbertas() {
        $repository = new TRepository('Vagas');
        $criteria = new TCriteria;
        if (empty($param['order'])) {
            $param['order'] = 'id';
            $param['direction'] = 'asc';
        }
        $criteria->add(new TFilter('status', '=', 1));
        $criteria->setProperties($param);
        $objects = $repository->load($criteria, FALSE);
        $retorno = array();        
        $criteria->resetProperties();

        return $objects;
    }
}

/* SQL
CREATE TABLE vagas (
	id INTEGER,
	nome TEXT,
	descricao TEXT,
	conhecimento INTEGER,
	prerequisito TEXT,
	salario NUMERIC,
	beneficio INTEGER,
	datacriacao date,
	datafinal date,
	status INTEGER,
	CONSTRAINT vagas_PK PRIMARY KEY (id)
)
ALTER TABLE vagas ADD solicitante TEXT ;
ALTER TABLE vagas ADD tipo INTEGER ;
*/
