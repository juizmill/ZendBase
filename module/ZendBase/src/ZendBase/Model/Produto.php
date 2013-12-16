<?php
namespace ZendBase\Model;

use Zend\Stdlib\Hydrator;

class Produto {

    protected $id;
    protected $nome;
    protected $quantidade;
    protected $valor_unitário;

    public function __construct(Array $data = array())
    {
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $valor_unitário
     */
    public function setValorUnitário($valor_unitário)
    {
        $this->valor_unitário = $valor_unitário;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorUnitário()
    {
        return $this->valor_unitário;
    }

    public function toArray()
    {
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->extract($this);
    }

} 