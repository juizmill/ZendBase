<?php
namespace ZendBase\Service;

use Zend\Db\Metadata\Metadata;
use Zend\Db\Adapter\Adapter as AdapterDb;

/**
 * Class Adapter
 * @package ZendBase\Service
 */
class Adapter extends Metadata
{
    protected $schema;
    protected $tableObject;

    /**
     * @param AdapterDb $adapter
     * @param $tableName
     */
    public function __construct(AdapterDb $adapter, $tableName)
    {
        parent::__construct($adapter);

        $this->schema = $this->adapter->getDriver()->getConnection()->getCurrentSchema();
        $this->tableObject = $this->getTable($tableName, $this->schema);
    }

    /**
     * @return \Zend\Db\Metadata\Object\TableObject
     */
    public function getTableObject()
    {
        return $this->tableObject;
    }


} 