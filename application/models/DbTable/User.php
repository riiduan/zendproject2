<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    public function getUser($username)
    {
    $row = $this->fetchRow('username = ' . $username);
    if (!$row) {
    throw new Exception("Could not find row $username");
    }
    return $row->toArray();
    }


    public function addUser($username,$password,$level,$name,$surname,$email )
    {
    $data = array(
    'username' => $username,
    'password' => $password,
    'level'=> $level,
    'name' => $name,
    'surname' =>$surname,
    'email' => $email,);
    $this->insert($data);
    }


    public function updateUser($username,$password,$level,$name,$surname,$email){
      $data = array(
      'password' => $password,
      'level'=> $level,
      'name' => $name,
      'surname' =>$surname,
      'email' => $email,);
      $where['username = ?']  = (string)$username;
    $this->update($data,$where);
    }


    public function deleteUser($username)
    {
    $this->delete($username);
    }


    public function getUserByName($usrName)
    {
      $row =$this->fetchRow($this->select()->where('username = ?', $usrName));
        return $row->toArray();
    }

}
