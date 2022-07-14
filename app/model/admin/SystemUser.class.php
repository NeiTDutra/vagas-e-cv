<?php
/**
 * SystemUser
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemUser extends TRecord
{
    const TABLENAME = 'system_user';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $frontpage;
    private $unit;
    private $system_user_groups = array();
    private $system_user_programs = array();
    private $system_user_units = array();

    /**
     * Constructor method
     */
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        parent::addAttribute('name');
        parent::addAttribute('login');
        parent::addAttribute('password');
        parent::addAttribute('email');
        parent::addAttribute('frontpage_id');
        parent::addAttribute('system_unit_id');
        parent::addAttribute('active');
        parent::addAttribute('cpf');
        parent::addAttribute('rg');
        parent::addAttribute('fone');
        parent::addAttribute('celular');
        parent::addAttribute('sexo');
        parent::addAttribute('dtnasc');
        parent::addAttribute('estcivil');
        parent::addAttribute('endereco');
        parent::addAttribute('bairro');
        parent::addAttribute('cep');
        parent::addAttribute('cidade');
        parent::addAttribute('estado');
        parent::addAttribute('pais');
        parent::addAttribute('dispvia');
        parent::addAttribute('dispmud');
        parent::addAttribute('estaempregado');
        parent::addAttribute('cnh');
        parent::addAttribute('objetivo');
        parent::addAttribute('pretsalarial');
        parent::addAttribute('arquivo');
        parent::addAttribute('status');
        parent::addAttribute('necespecial');
        parent::addAttribute('qualnecespecial');
        parent::addAttribute('cargopretende');
        parent::addAttribute('dtcriacao');
        parent::addAttribute('dtatualiza');
    }

    public function get_nmsta () {
        if ($this->status === 'F') {
            return "Concluído";
        } else {
            return "Registrado";
        }
    }

    public function get_foto () {
        if (file_exists($this->arquivo)) {
            return $this->arquivo;
        } else {
            return "app/templates/theme3/img/avatar5.png";
        }
    }

    public function get_criacao () {
        return date("d/m/Y", strtotime($this->dtcriacao));
    }

    public function get_atualiza () {
        return date("d/m/Y", strtotime($this->dtatualiza));
    }

    /**
     * Returns the frontpage name
     */
    public function get_frontpage_name()
    {
        // loads the associated object
        if (empty($this->frontpage))
            $this->frontpage = new SystemProgram($this->frontpage_id);
    
        // returns the associated object
        return $this->frontpage->name;
    }
    
    /**
     * Returns the frontpage
     */
    public function get_frontpage()
    {
        // loads the associated object
        if (empty($this->frontpage))
            $this->frontpage = new SystemProgram($this->frontpage_id);
    
        // returns the associated object
        return $this->frontpage;
    }
    
   /**
     * Returns the unit
     */
    public function get_unit()
    {
        // loads the associated object
        if (empty($this->unit))
            $this->unit = new SystemUnit($this->system_unit_id);
    
        // returns the associated object
        return $this->unit;
    }
    
    /**
     * Add a Group to the user
     * @param $object Instance of SystemGroup
     */
    public function addSystemUserGroup(SystemGroup $systemgroup)
    {
        $object = new SystemUserGroup;
        $object->system_group_id = $systemgroup->id;
        $object->system_user_id = $this->id;
        $object->store();
    }
    
    /**
     * Add a Unit to the user
     * @param $object Instance of SystemUnit
     */
    public function addSystemUserUnit(SystemUnit $systemunit)
    {
        $object = new SystemUserUnit;
        $object->system_unit_id = $systemunit->id;
        $object->system_user_id = $this->id;
        $object->store();
    }

    public function addUserTecs(Tipos $tipo)
    {
        $object = new UserTipos;
        $object->id_tipo = $tipo->id;
        $object->id_user = $this->id;
        $object->store();
    }

    public function getUserTipos()
    {
        return parent::loadAggregate('Tipos', 'UserTipos', 'id_user', 'id_tipo', $this->id);
    }
    
    /**
     * Return the user' group's
     * @return Collection of SystemGroup
     */
    public function getSystemUserGroups()
    {
        return parent::loadAggregate('SystemGroup', 'SystemUserGroup', 'system_user_id', 'system_group_id', $this->id);
    }
    
    /**
     * Return the user' unit's
     * @return Collection of SystemUnit
     */
    public function getSystemUserUnits()
    {
        return parent::loadAggregate('SystemUnit', 'SystemUserUnit', 'system_user_id', 'system_unit_id', $this->id);
    }
    
    /**
     * Add a program to the user
     * @param $object Instance of SystemProgram
     */
    public function addSystemUserProgram(SystemProgram $systemprogram)
    {
        $object = new SystemUserProgram;
        $object->system_program_id = $systemprogram->id;
        $object->system_user_id = $this->id;
        $object->store();
    }
    
    /**
     * Return the user' program's
     * @return Collection of SystemProgram
     */
    public function getSystemUserPrograms()
    {
        return parent::loadAggregate('SystemProgram', 'SystemUserProgram', 'system_user_id', 'system_program_id', $this->id);
    }
    
    /**
     * Get user group ids
     */
    public function getSystemUserGroupIds( $as_string = false )
    {
        $groupids = array();
        $groups = $this->getSystemUserGroups();
        if ($groups)
        {
            foreach ($groups as $group)
            {
                $groupids[] = $group->id;
            }
        }
        
        if ($as_string)
        {
            return implode(',', $groupids);
        }
        
        return $groupids;
    }
    
    /**
     * Get user unit ids
     */
    public function getSystemUserUnitIds( $as_string = false )
    {
        $unitids = array();
        $units = $this->getSystemUserUnits();
        if ($units)
        {
            foreach ($units as $unit)
            {
                $unitids[] = $unit->id;
            }
        }
        
        if ($as_string)
        {
            return implode(',', $unitids);
        }
        
        return $unitids;
    }
    
    /**
     * Get user group names
     */
    public function getSystemUserGroupNames()
    {
        $groupnames = array();
        $groups = $this->getSystemUserGroups();
        if ($groups)
        {
            foreach ($groups as $group)
            {
                $groupnames[] = $group->name;
            }
        }
        
        return implode(',', $groupnames);
    }
    
    /**
     * Reset aggregates
     */
    public function clearParts()
    {
        SystemUserGroup::where('system_user_id', '=', $this->id)->delete();
        SystemUserUnit::where('system_user_id', '=', $this->id)->delete();
        SystemUserProgram::where('system_user_id', '=', $this->id)->delete();        
    }

    public function clearTecs () {
        UserTipos::where('id_user', '=', $this->id)->delete();
    }
    
    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        // delete the related System_userSystem_user_group objects
        $id = isset($id) ? $id : $this->id;
        
        SystemUserGroup::where('system_user_id', '=', $id)->delete();
        SystemUserUnit::where('system_user_id', '=', $id)->delete();
        SystemUserProgram::where('system_user_id', '=', $id)->delete();
        
        // delete the object itself
        parent::delete($id);
    }
    
    /**
     * Validate user login
     * @param $login String with user login
     */
    public static function validate($login)
    {
        if (strpos($login,"@")) {
            $user = self::newFromEmail($login);
        } else {
            $user = self::newFromLogin($login);
        }

        if (!$user instanceof SystemUser) {
            $user = self::newFromCpf($login);
        }
        
        if ($user instanceof SystemUser)
        {
            if ($user->active == 'N')
            {
                throw new Exception(_t('Inactive user'));
            }
        }
        else
        {
            throw new Exception(_t('User not found'));
        }
        
        return $user;
    }
    
    /**
     * Authenticate the user
     * @param $login String with user login
     * @param $password String with user password
     * @returns TRUE if the password matches, otherwise throw Exception
     */
    public static function authenticate($login, $password)
    {
        if (strpos($login,"@")) {
            $user = self::newFromEmail($login);
        } else {
            $user = self::newFromLogin($login);
        }

        if (!$user instanceof SystemUser) {
            $user = self::newFromCpf($login);
        }
        
        if ($user->password !== md5($password))
        {
            throw new Exception(_t('Wrong password'));
        }
        
        return $user;
    }

    
    
    /**
     * Returns a SystemUser object based on its login
     * @param $login String with user login
     */
    static public function newFromLogin($login)
    {
        return SystemUser::where('login', '=', $login)->first();
    }

    static public function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
    
    /**
     * Returns a SystemUser object based on its e-mail
     * @param $email String with user email
     */
    static public function newFromEmail($email)
    {
        return SystemUser::where('email', '=', $email)->first();
    }

    static public function newFromCpf($cpf)
    {
        $cpf = SystemUser::mask($cpf,'###.###.###-##');
        return SystemUser::where('cpf', '=', $cpf)->first();
    }
    
    /**
     * Return the programs the user has permission to run
     */
    public function getPrograms()
    {
        $programs = array();
        
        foreach( $this->getSystemUserGroups() as $group )
        {
            foreach( $group->getSystemPrograms() as $prog )
            {
                $programs[$prog->controller] = true;
            }
        }
                
        foreach( $this->getSystemUserPrograms() as $prog )
        {
            $programs[$prog->controller] = true;
        }
        
        return $programs;
    }
    
    /**
     * Return the programs the user has permission to run
     */
    public function getProgramsList()
    {
        $programs = array();
        
        foreach( $this->getSystemUserGroups() as $group )
        {
            foreach( $group->getSystemPrograms() as $prog )
            {
                $programs[$prog->controller] = $prog->name;
            }
        }
                
        foreach( $this->getSystemUserPrograms() as $prog )
        {
            $programs[$prog->controller] = $prog->name;
        }
        
        asort($programs);
        return $programs;
    }
    
    /**
     * Check if the user is within a group
     */
    public function checkInGroup( SystemGroup $group )
    {
        $user_groups = array();
        foreach( $this->getSystemUserGroups() as $user_group )
        {
            $user_groups[] = $user_group->id;
        }
    
        return in_array($group->id, $user_groups);
    }
    
    /**
     *
     */
    public static function getInGroups( $groups )
    {
        $collection = [];
        $users = self::all();
        if ($users)
        {
            foreach ($users as $user)
            {
                foreach ($groups as $group)
                {
                    if ($user->checkInGroup($group))
                    {
                        $collection[] = $user;
                    }
                }
            }
        }
        return $collection;
    }
}

/* sql
CREATE TABLE system_user (
    id INTEGER PRIMARY KEY NOT NULL,
    name varchar(100),
    login varchar(100),
    password varchar(100),
    email varchar(100),
    frontpage_id int, 
    system_unit_id int references system_unit(id), 
    active char(1), 
    cpf TEXT, 
    rg TEXT, 
    fone TEXT, 
    celular TEXT, 
    sexo TEXT, 
    dtnasc TEXT, 
    estcivil TEXT, 
    endereco TEXT, 
    bairro TEXT, 
    cep TEXT, 
    cidade TEXT, 
    estado TEXT, 
    pais TEXT, 
    dispvia TEXT, 
    dispmud TEXT, 
    estaempregado TEXT, 
    cnh TEXT, 
    objetivo TEXT, 
    pretsalarial NUMERIC, 
    arquivo BLOB, 
    status TEXT, 
    necespecial TEXT, 
    qualnecespecial TEXT, 
    cargopretende TEXT,
    FOREIGN KEY(frontpage_id) REFERENCES system_program(id))

ALTER TABLE "system_user" ADD dtcriacao TEXT ;
ALTER TABLE "system_user" ADD dtatualiza TEXT ;
*/