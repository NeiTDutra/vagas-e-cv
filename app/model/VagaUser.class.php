<?php
/**
 * VagaUser Active Record
 * @author  <your-name-here>
 */
class VagaUser extends TRecord
{
    const TABLENAME = 'vaga_user';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $vagas;
    private $system_user;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_user');
        parent::addAttribute('id_vaga');
        parent::addAttribute('datacan');
    }

    /**
     * Method set_vagas
     * Sample of usage: $vaga_user->vagas = $object;
     * @param $object Instance of Vagas
     */
    public function set_vagas(Vagas $object)
    {
        $this->vagas = $object;
        $this->id_vaga = $object->id;
    }
    
    /**
     * Method get_vagas
     * Sample of usage: $vaga_user->vagas->attribute;
     * @returns Vagas instance
     */
    public function get_vagas()
    {
        // loads the associated object
        if (empty($this->vagas))
            $this->vagas = new Vagas($this->id_vaga);
    
        // returns the associated object
        return $this->vagas;
    }
    
    
    /**
     * Method set_system_user
     * Sample of usage: $vaga_user->system_user = $object;
     * @param $object Instance of SystemUser
     */
    public function set_system_user(SystemUser $object)
    {
        $this->system_user = $object;
        $this->id_user = $object->id;
    }
    
    /**
     * Method get_system_user
     * Sample of usage: $vaga_user->system_user->attribute;
     * @returns SystemUser instance
     */
    public function get_system_user()
    {
        // loads the associated object
        if (empty($this->system_user))
            $this->system_user = new SystemUser($this->id_user);
    
        // returns the associated object
        return $this->system_user;
    }

    public function validaVagaUser ($iduser, $idvaga, $conn) {
        try {
            if ( $iduser > 0 and $idvaga > 0 ) {
                if ($conn === false) {
                    $conn = TTransaction::get();
                }
                $sth = $conn->prepare('SELECT * from vaga_user ' . 
                                    'WHERE id_user = ' . $iduser . ' and ' .
                                    'id_vaga = ' . $idvaga);
                $sth->execute();
                $result = $sth->fetchAll();
                if ($close) {
                    TTransaction::close();
                }

                if (count($result) > 0) {                    
                    return $result[0]['id'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}

/* sql
drop table vaga_user;
CREATE TABLE vaga_user (
	id INTEGER,
	id_user INTEGER,
	id_vaga INTEGER,
	datacan TEXT,
	CONSTRAINT vaga_user_PK PRIMARY KEY (id),
	CONSTRAINT vaga_user_system_user_FK FOREIGN KEY (id_user) REFERENCES "system_user"(id),
	CONSTRAINT vaga_user_vagas_FK FOREIGN KEY (id_vaga) REFERENCES vagas(id)
)
*/