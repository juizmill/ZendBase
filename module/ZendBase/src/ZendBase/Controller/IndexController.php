<?php
namespace ZendBase\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZendBase\Form\GenerateForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $db = $this->getServiceLocator()->get('ZendBase.Db');

        $form = new GenerateForm($db);

        var_dump($form);die;

        return new ViewModel();
    }
}
