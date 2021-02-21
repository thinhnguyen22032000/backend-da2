<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../helpers/format.php');
  require_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class user
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }
    
  







}

?>