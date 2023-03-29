<?php 

class Admin_model extends CI_Model{

    public function get_modules()
    {
        $res = $this->db->select('main.*')
                        ->from('tbl_modules as main')
                        ->join('tbl_access as access','access.module_id = main.id')
                        ->where([   'main.delete_bit'=>0,
                                    'main.enable_bit'=>1,
                                    'access.check_bit'=>1,
                                    'access.role_id'=>$this->session->userdata('role_id'),
                                ])
                        ->get();
        return $res ? $res->result() : false;
    }

    // Users Function starts here

    public function register_user($table, $data){
        $query = $this->db->insert($table,$data);
        return ($query) ? $this->db->insert_id() : false ;
	}

    
    public function get_users(){
        return $this->db->where(['delete_bit'=>0])
                        ->get('tbl_users')->result();
    }

    public function get_user_details($id=""){
        return $this->db->where('id',$id)->get('tbl_users')->result();
    }

    public function update_user($data, $id){
        
        $this->db->trans_start();
        $this->db->where('id', $id); 
        $this->db->update('tbl_users',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE)
            return true;
        else
            return false;
    }


    // Common functions starts here

    public function get_user_roles(){
        $check = $this->db->select('id,title')->where(['enable_bit'=>1,'delete_bit'=>0,'title !='=>'Super Admin'])->get('tbl_roles');
        return ($check)? $check->result() : false ;
    }

    public function get_checklists($id){
        $res = $this->db->where(['list_id' => $id, 'delete_bit' => 0])->get('tbl_checklists');
        return ($res == true)? $res->result() : false ;
    }

    public function check_user_exists($id = null){
        $check = $this->db->where('id',$id)->get('tbl_users');
        return ($check)? $check->result() : false ;
    }

    public function get_with_id($table="",$id=""){
        return ($table != "" && $id !="") ? $this->db->where('id',$id)->get($table)->result() : false ;
    }

	public function get_with_where($table="", $where = array(), $order_column = "id", $order = "ASC", $limit = 5){
        $this->db->where($where);
		$this->db->order_by($order_column, $order);
		$this->db->limit($limit);
		return $this->db->get($table)->result();
    }

    public function get_data_by_id($id)
    {
        $res = $this->db->where('id',$id)->get('tbl_users');
        return ($res == true)? $res->result(): false;
    }

    public function all_data($table = null){
        $res = $this->db->where(['delete_bit'=>0])->get($table);
        return ($res == true)? $res->result() : false ;
    }

    public function all_data_by_enable_bit($table = null){
        $res = $this->db->where(['enable_bit' => 1])->get($table);
        return ($res == true)? $res->result() : false ;
    }

    
    public function get_records_by_id($table, $id){
        $query = $this->db->where(["id" => $id, "delete_bit" => 0])->get($table);
        return ($query) ? $query->result() : false;
    }

    public function add_record_with_data($table = "", $data = ""){
        $this->db->trans_start();
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return ($this->db->trans_status()) ? $this->get_records_by_id($table, $insert_id) : false;
    }

    public function update_list($data, $id){
        
        $this->db->trans_start();
        $this->db->where('id', $id); 
        $this->db->update('tbl_lists',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE)
            return true;
        else
            return false;
    }

    
    public function details($table,$id){
        $res = $this->db->where('id',$id)->get($table);
        return ($res)? $res->result() : false ;
    }


}
