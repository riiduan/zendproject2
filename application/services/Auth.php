<?php

class Application_Service_Auth
{
    protected $_adminModel;
    protected $_auth;

    public function __construct()
    {
       $this->_adminModel = new Application_Model_DbTable_User;
    }

    public function authenticate($credentials)
    {
        $adapter = $this->getAuthAdapter($credentials);
        $auth    = $this->getAuth();
        $result  = $auth->authenticate($adapter);

        if (!$result->isValid()) {
            return false;
        }
        $user = $this->_adminModel->getUserByName($credentials['username']);
        $auth->getStorage()->write($user);
        return true;
    }

    public function getAuth()
    {
        if (null === $this->_auth) {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }

    public function getIdentity($values)
    {
        $auth = $this->getAuth();
        if ($auth->hasIdentity()) {
            return $auth->getIdentity($values);
        }
        return false;
    }

    public function clear()
    {
        $this->getAuth()->clearIdentity();
    }

  public function getAuthAdapter($values)
    {
		$authAdapter = new Zend_Auth_Adapter_DbTable(
			Zend_Db_Table_Abstract::getDefaultAdapter(),
			'user',
			'username',
			'password'
		);
		$authAdapter->setIdentity($values['username']);
		$authAdapter->setCredential($values['password']);
        return $authAdapter;
    }
}
