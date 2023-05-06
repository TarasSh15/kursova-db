<?php
abstract class Operation {
	protected $result;
    public function __construct($result) {
    	$this->result = $result;
  	}
    public function set_data($result){
    	$this->result = $result;
    }
	function __destruct() {
	}
    public function get_data($result){
    	return $this->result;
    }
    abstract public function operate();
}

class Data_comp extends Operation {
	public function operate(){
        $result = $this->result;
        $operation_options="";
        if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
	    	    $operation_options.="<option value='".$row['comp_id']."'>".$row['comp_name']."</option>";
	        }
        }
        return $operation_options;
    }
}

class Data_resol extends Operation {
	public function operate(){
        $result = $this->result;
        $resol_edit_options="";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resol_edit_options.="<option value='".$row['resol_id']."'>".$row['resol']."</option>";
            }
        }
        return $resol_edit_options;
    }
}

class Data_tech extends Operation {
	public function operate(){
        $result = $this->result;
        $edit_options="";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $edit_options.="<option value='".$row['tech_id']."'>".$row['tech_type']."</option>";
            }
        }
        return $edit_options;
    }
}

class SwData_show extends Operation {
	public function operate(){
        $result = $this->result;
        $operation_options="";
        if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $operation_options.="<td width='500' rowspan='2' valign='top'>".$row['tech_type']."<td width='500' rowspan='2' valign='top'>".$row['resol']."</td><td width='500' rowspan='2' valign='top'>".$row['disp_diag']."</td><td width='500' rowspan='2' valign='top'>".$row['view_angle']."</td><td width='500' rowspan='2' valign='top'>".$row['brightness']."</td><td width='500' rowspan='2' valign='top'>".$row['contrast']."</td><td width='500' rowspan='2' valign='top'>".$row['respon_time']."</td><td width='500' rowspan='2' valign='top'>".$row['power_cons']."</td><td width='500' rowspan='2' valign='top'>".$row['comp_name']."</td>";
                }
            }
        return $operation_options;
    }
}
?>