<?php
namespace ZendBase\Controller;

use Zend\Form\Element\Submit;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZendBase\Form\GenerateForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $db = $this->getServiceLocator()->get('ZendBase.Form');

        $form = new GenerateForm($db, 'form_teste');
        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send'
            )
        ));

        return new ViewModel(array('form' => $form));
    }
}
