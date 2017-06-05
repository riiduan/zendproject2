<?php

class StaffController extends Zend_Controller_Action
{

    private $_authService = null;

    public function init()
    {
      $this->_authService = new Application_Service_Auth();
        $this->_helper->layout->setLayout('staff');
    }

    public function indexAction()
    {
        // action body
    }

    public function editAction()
    {
      $form = new Application_Form_Registra();
      $form->submit->setLabel('Salva');
      $this->view->form = $form;

          if ($this->getRequest()->isPost()){

            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

              $username= $form->getValue('username');
              $password= $form->getValue('password');
              $level=2;
              $name=$form->getValue('name');
              $surname=$form->getValue('surname');
              $email=$form->getValue('email');
              $user = new Application_Model_DbTable_User();
              $user->updateUser($username,$password,$level,$name,$surname,$email);
              $this->_helper->redirector('index');
            } else {
            $form->populate($formData);
            }
      }
      else {

      $userx= $this->_authService->getIdentity();
      $nome=$userx['username'];

          $users = new Application_Model_DbTable_User();
         $form->populate($users->getUserByName($nome));



      }
    }

    public function logoutAction()
    {
      $this->_authService->clear();
  		return $this->_helper->redirector('index','public');
    }

    public function addAction()
    {
      $form = new Application_Form_Promotion();
      $form->submit->setLabel('Add');
      $this->view->form = $form;

      if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {


          $promoid = $form->getValue('promoid');
          $company = $form->getValue('company');
          $datebegin = $form->getValue('datebegin');
          $datefine = $form->getValue('datefine');
          $category = $form->getValue('category');
          $description= $form->getValue('description');
          $price = $form->getValue('price');
          $promotion = new Application_Model_DbTable_Promotion();
          $promotion->addPromo($company,$datebegin,$datefine,$category,$description,$price);
          $this->_helper->redirector('index');
        } else {
          $form->populate($formData);
        }
      }
    }

    public function editPromAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function promotionAction()
    {
      $Promotion = new Application_Model_DbTable_Promotion();
      $this->view->promotion = $Promotion->fetchAll();
    }


}
