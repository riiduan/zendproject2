<?php

class Application_Form_Promotion extends Zend_Form
{

    public function init()
    {


      $this->setName('promotion');

      $promoid = new Zend_Form_Element_Hidden('promoid');
      $promoid->addFilter('Int');

      $company = new Zend_Form_Element_Text('company');
      $company->setLabel('company')
      ->setRequired(true)
      ->addFilter('StripTags')
      ->addFilter('StringTrim')
      ->addValidator('NotEmpty');

      $datebegin = new Zend_Form_Element_Text('datebegin');
      $datebegin->setLabel('datebegin')
      ->setRequired(true)
      //S->addFilter('DateTime')
      ->addValidator('NotEmpty');

      $datefine = new Zend_Form_Element_Text('datefine');
      $datefine->setLabel('datefine')
      ->setRequired(true)
      //    ->addFilter('DateInterval')
      ->addValidator('NotEmpty');

      $category  = new Zend_Form_Element_Text('category ');
      $category->setLabel('category ')
      ->setRequired(true)
      ->addFilter('StripTags')
      ->addFilter('StringTrim')
      ->addValidator('NotEmpty');

      $description= new Zend_Form_Element_Text('description');
      $description->setLabel('description')
      ->setRequired(true)
      ->addFilter('StripTags')
      ->addFilter('StringTrim')
      ->addValidator('NotEmpty');
      $price= new Zend_Form_Element_Text('price');
      $price->setLabel('price')
      ->setRequired(true)
      ->addFilter('Int')
      ->addValidator('NotEmpty');

      $submit = new Zend_Form_Element_Submit('submit');
      $submit->setAttrib('promoid', 'submitbutton');
      $this->addElements(array($promoid,$company, $datebegin, $datefine, $category, $description, $price, $submit));
    }


}
