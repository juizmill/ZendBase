<?php
namespace ZendBase\Form;

use Zend\Db\ResultSet\ResultSet;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use ZendBase\Service\Adapter as AdapterZendBase;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

use Zend\Db\Sql\Sql;

/**
 * Class GenerateForm
 * @package ZendBase\Form
 */
class GenerateForm extends Form
{
    protected $adapter;
    protected $adapterDb;
    protected $foreignTable;

    public function __construct(Adapter $adapter, $tableName)
    {
        $this->adapter = $adapter;
        $this->adapterDb = new AdapterZendBase($adapter, $tableName);
        parent::__construct($tableName);

        $this->generate();
    }

    /**
     * generate
     */
    public function generate()
    {
        /**
         * @var $column \Zend\Db\Metadata\Object\ColumnObject
         */
        $columns = $this->adapterDb->getTableObject()->getColumns();

        /**
         * @var $constraint \Zend\Db\Metadata\Object\ConstraintObject
         */
        $constraints = $this->adapterDb->getTableObject()->getConstraints();

        $primaryKey = array();
        $foreignKey = array();
        $foreignTable = array();

        foreach($constraints as $constraint){

            if ($constraint->getType() == 'PRIMARY KEY')
                $primaryKey[] = $constraint->getColumns()[0];

            if ($constraint->getType() == 'FOREIGN KEY'){
                $foreignTable[$constraint->getColumns()[0]] = $constraint->getReferencedTableName();
                $foreignKey[] = $constraint->getColumns()[0];
            }

        }

        foreach($columns as $column){

            switch($column->getDataType()){
                case 'text':
                    $element = new Textarea($column->getName());
                    $element->setAttribute('maslength', $column->getCharacterMaximumLength());
                    $element->setLabel($column->getName());

                    if(! $column->isNullable())
                        $element->setAttribute('required', 'required');

                    break;
                case 'tinyint':
                    $element = new Checkbox($column->getName());
                    $element->setLabel($column->getName());
                    break;
                case in_array($column->getName(), $primaryKey):
                    $element = new Hidden($column->getName());
                    break;
                case in_array($column->getName(), $foreignKey):

                    $this->foreignTable = $foreignTable[$column->getName()];

                    $element = new Select($column->getName());
                    $element->setLabel($column->getName())
                        ->setOptions(array('value_options' => $this->selectValues() ));
                    if(! $column->isNullable())
                        $element->setAttribute('required', 'required');

                    break;

                default:

                    $element = new Text($column->getName());
                    $element->setAttribute('maxlength', $column->getCharacterMaximumLength());
                    $element->setLabel($column->getName());

                    if(! $column->isNullable())
                        $element->setAttribute('required', 'required');
            }

            $this->add($element);
        }
    }

    /**
     * @return array
     */
    protected function selectValues()
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from($this->foreignTable);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $array = array();
        $resultSet = new ResultSet();
        foreach($resultSet->initialize($result)->toArray() as $value){
            $array[] = array_values($value)[1];
        }

        return $array;
    }

} 