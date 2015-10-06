<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model
{
    private $_names;

    public function __construct()
    {
        parent::__construct();
        $this->_names = array(
            'taro' => '太郎',
            'hanako' => '花子'
        );
    }

    public function getNameJa($name)
    {
    
        if (isset($this->_names[$name])) {
            return $this->_names[$name];
        }
        return FALSE;
    }
}

