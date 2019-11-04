<?php

	class dbcon{
		var $conn;
		var $today;
		function __construct(){
			
			$this->conn = new mysqli('localhost', 'root', '', 'boat');
			// $this->connect = new mysqli($servername,$username,$password,$dbname);
			if ($this->conn->connect_error) {
				die("Connection Failed.");
			}
		}
		
		function add_boat_info($tmp_title, $tmp_price,$tmp_post_id,$tmp_class,$tmp_category,$tmp_year,$tmp_make,$tmp_length,$tmp_propulsion,$tmp_hull,$tmp_fuel,$tmp_location,$tmp_description)
		{
			$sql='select * from boat_info where fullname ="'.$tmp_title.'" and price="'.$tmp_price.'" and post_id="'.$tmp_post_id.'"';
			$result = $this->conn->query($sql);
			if($result->num_rows<=0)
			{
			
				$sql='INSERT INTO boat_info (fullname, price, post_id, class,category,year,make,length,propulsion_type, hull_material, fuel_type, location,description)VALUES ("'.$tmp_title.'","'.$tmp_price.'","'.$tmp_post_id.'","'.$tmp_class.'","'.$tmp_category.'","'.$tmp_year.'","'.$tmp_make.'","'.$tmp_length.'","'.$tmp_propulsion.'","'.$tmp_hull.'","'.$tmp_fuel.'","'.$tmp_location.'","'.htmlspecialchars($tmp_description).'")';

				echo $sql;
				$result = $this->conn->query($sql);
				$data['success']=1;
			}
			
		}
		function update_attribute($tmp_feild, $tmp_value, $tmp_title, $tmp_price,$tmp_post_id){
			$sql="ALTER TABLE boat_info ADD ".$tmp_feild." varchar(500)";
			$result = $this->conn->query($sql);
			$sql="update boat_info set ".$tmp_feild." ='".htmlspecialchars($tmp_value)."' where fullname='".$tmp_title."' and post_id = '".$tmp_post_id."'";
			echo $sql;
			$result = $this->conn->query($sql);
			echo $result;
		}
		function end(){
			$this->conn->close();
		}
		
	}
?>
