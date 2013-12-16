<?php
namespace ZendBase\Form;

use Zend\Db\Metadata\Metadata;
use Zend\Db\Adapter\Adapter;

class GenerateForm extends Metadata
{
    protected $schema;

    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);

        $this->schema = $this->adapter->getDriver()->getConnection()->getCurrentSchema();

        $metadata = new Metadata($adapter);

        var_dump($metadata->getColumn('valor_unitario', 'produto', $this->schema));

    }
} 