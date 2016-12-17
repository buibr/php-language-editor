<?php

/* -- * DB CLASS    * -- */
class Database {
    
    #   DB Array
    private $db = array();
    
    #   PRIVATE OBJECTS
	private $conn;
    private $result;
    
    
    #=== LETS START CODING ===#
	function __construct(){
		
		$this->db = array(
			'host' =>'localhost', 
			'user' => 'root1', 
			'pass' => '',
			'db' => 'ramibr_testlang'
		);
        
		$this->open_conn();
		
	}
	
	protected function open_conn(){
		
        #   Setting db settings
        $this->conn = @new mysqli($this->db['host'], $this->db['user'], $this->db['pass'], $this->db['db']);
        
        if($this->conn->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " ; #. @$this->conn->connect_error;
        }
		else
		{
			mysqli_set_charset($this->conn,"utf8");
		}
        
	}
	
	protected function close_conn(){
        $this->conn->close();
	}
	
	protected function query($sql){
		$this->result = @$this->conn->query($sql);
		$this->confirm_result($this->result);
		return $this->result;
	}
	
	///	to controll if is sql ok
	protected function confirm_result($result_conf){
		if(!$result_conf)
		{
			return false;
		}
	}
	
	//	Siguria e mysql_real_escape _ string
	protected function mysql_prep($value) {
        
		return @$this->conn->real_escape_string($value);
	}
	
	// "database-neutral" methods
  	protected function fetch_array(){
		return $this->result->fetch_assoc();
  	}
  
 	protected function num_rows() {
		return 	$this->result->num_rows;
  	}
  
  	protected function insert_id() {
    	// get the last id inserted over the current db connection
		return $this->conn->insert_id;
  	}
  
 	protected function affected_rows() {
    	return $this->conn->affected_rows;
  	}
}


class Baza extends Database {
	
    public function db($sql){
		if($r = parent::query($sql)){
			return $r;
		}
        return false;
	}
    
	public function mprp($val){
		$vl 			= parent::mysql_prep($val);
		return 			$vl;
	}
	
	public function farr($val){
		$ar 			= parent::fetch_array();
		return 			$ar;
	}
	
	public function nrow($val){
		$ar 			= parent::num_rows();
		return 			$ar;
	}
	
	public function insert_id(){
		return 			parent::insert_id();
	}
    
    public function q2arr($val, $base_ident = ''){
        $aa = array();
		
        $i= 0;
		
		
        while($r = parent::fetch_array($val)){

            foreach($r as $key=>$val){
				if($base_ident != ''){
                	if(gettype($key) != 'integer')
                    	$aa[$r[$base_ident]][$key] = $val;
					
				}else{
					
                   	$aa[$i][$key] = $val;
				
				}
            }
            $i++;
        }
        return $aa;
	}
	
	public function db_arr($val){
        $aa = array();
        $i= 0;
        while($r = parent::fetch_array($val)){
            foreach($r as $key=>$val){
               $aa[$key] = $val;
            }
            $i++;
        }
        return $aa;
	}
	
	
	public function q2grouparr($q, $base_row='ord_unid', $group_col= 'items', $group_pref='op_'){
		
		$r = array();
		$iid = 0;
		while($a = $this->farr($q))
		{
			#vdp($a);
			foreach($a as $k=>$v)
			{
				#print($k);
				
				if(checkChar4String($group_pref, $k))
				{
					#print " - FOUND".br.br;
					if($v != null)
						$r[$a[$base_row]][$group_col][$iid][$k] = $v;
					else
						$r[$a[$base_row]][$group_col][$iid][$k] = null;
				}
				else
				{
					$r[$a[$base_row]][$k] = $v;
				}
				
				
			}
			$iid++;
		}
		#vdp($r);
		return $r;
	}
	
	public function row2grouparr($q, $group_col= 'items', $group_pref='op_')
	{
		$r = array();
		$iid = 0;
		while($a = $this->farr($q))
		{
			foreach($a as $k=>$v)
			{
				if(checkChar4String($group_pref, $k))
				{
					if($v != null)
						$r[$group_col][$iid][$k] = $v;
					else
						$r[$group_col][$iid][$k] = null;
				}
				else
				{
					$r[$k] = $v;
				}
			}
			$iid++;
		}
		return $r;
	}
	
}


?>