<?php
class User
{
	public $id, $username, $password, $email;
	
	public function __construct() 
	{
	    $this->id = '';
	    $this->username = '';
	    $this->password = '';
	    $this->email = '';
	}
}
?>