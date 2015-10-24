<?php
class Config {
  public $prefix;
  public $sessionName;
  public $page_title;

  public function __construct(){
		$this->prefix = "dsw1_";
    $this->sessionName = 'sDMIS_';
    $this->page_title = 'DMIS: A Prototype of Disaster Data Management System in the U-Tapao Cathment using Google Map';
	}

  public function getPrefix(){
		return $this->prefix;
	}

  public function getSessionname(){
    return $this->sessionName;
  }

  public function getTitle(){
    return $this->page_title;
  }
}
?>
