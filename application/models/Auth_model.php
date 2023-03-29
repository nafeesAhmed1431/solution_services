<?php 

class Auth_model extends CI_Model{

    function validate_login($username="",$password="")
    {
        
        return $this->db->where(['user_name'=>$username,'password'=>$password])
                 ->get('tbl_users')->result_array();
    }

    function update_last_login($id = "")
    {
        $this->db->set('last_login', date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $check = $this->db->update('tbl_users');
        if($check == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function authenticate_password($id=null,$password=null)
    {
        $check = $this->db->select('password')->where('id',$id)->get('tbl_users')->result_array();
        if($check[0]['password'] === $password)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function update_password($id=null,$data=null)
    {
            $this->db->trans_start();
            $this->db->where('id',$id);
            $this->db->update('tbl_users',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE)
                return true;
            else
                return false;
    }

    public function details($id,$table)
    {
        $res = $this->db->where('id',$id)->get($table);
        return ($res)? $res->result() : false ;
    }
}
?>