<?php
namespace Kalaweit\Model;

/**
 *
 * @author jeromeklam
 *
 */
class Crm_client_category
{

    /**
     * Identifiant du type
     * @var integer
     */
    protected $id = null;

    /**
     * Nom francais du type
     * @var string
     */
    protected $name = null;


    /**
     * Constructeur
     */
    public function __construct($p_id = null, $p_name = null)
    {
        $this->id   = $p_id;
        $this->name = $p_name;
    }

    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
