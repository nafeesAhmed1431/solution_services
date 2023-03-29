<?php defined('BASEPATH') or exit('No direct script access allowed');

class Commons_model extends CI_Model
{

    public function get_row($table, $where)
    {
        $res = $this->db->where($where)->get($table);
        return $res ? $res->row() : false;
    }

    public function count($count, $table, $where)
    {
        $res = $this->db->select($count)->from($table)->where($where)->get();
        return $res ? $res->result() : false;
    }

    public function get_row_select($select, $table, $where)
    {
        $res = $this->db->select($select)->where($where)->get($table);
        return $res ? $res->row() : false;
    }

    public function get_array_select($select, $table, $where)
    {
        $res = $this->db->select($select)->where($where)->get($table);
        return $res ? $res->result_array() : false;
    }

    public function get_array($where, $table)
    {
        $res = $this->db->where($where)->get($table);
        return $res ? $res->result_array() : false;
    }

    public function get_all($table)
    {
        $res = $this->db->get($table);
        return $res ? $res->result() : false;
    }

    public function get_where($table, $where)
    {
        $res = $this->db->where($where)->get($table);
        return $res ? $res->result() : false;
    }

    public function get_with_select($select, $table)
    {
        $res = $this->db->select($select)->get($table);
        return $res ? $res->result() : false;
    }

    public function get_where_select($select, $where, $table)
    {
        $res = $this->db->select($select)->where($where)->get($table);
        return $res ? $res->result() : false;
    }

    public function get_where_select_orderby($select, $where, $table,$orderby)
    {
        $res = $this->db->select($select)
                        ->where($where)
                        ->order_by($orderby['order_key'],$orderby['order'])
                        ->get($table);
        return $res ? $res->result() : false;
    }

    public function update($data, $where, $table)
    {
        return $this->db->where($where)->update($table, $data);
    }

    public function insert_with_id($data = [], $table = "")
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id() ?? false;
    }

    public function insert($data, $table)
    {
        $res = $this->db->insert($table, $data);
        return $res ? true : false;
    }

    public function check_if_exists($table, $where)
    {
        $res = $this->db->from($table)->where($where)->get();
        return ($res->num_rows() > 0) ? true : false;
    }

    public function delete_where($table, $where)
    {
        return $this->db->where($where)->delete($table) ?? false;
    }

    public function select_where_join($select, $table, $where, $joins = null)
    {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from($table);
        if($joins){
            foreach ($joins as $join)
                $this->db->join($join['table'], $join['condition'], $join['type']);
        }
        $res = $this->db->get();
        return $res ? $res->result() : false;
    }

    public function generic_select($table, $select = '*', $where = null, $joins = null, $order_by = null, $limit = null, $offset = null)
    {
        $select ? $this->db->select($select): null;
        $this->db->from($table);
        $where and $this->db->where($where);
        $order_by and $this->db->order_by($order_by);
        $limit and $this->db->limit($limit, $offset);
        if ($joins) {
            foreach ($joins as $join)
                $this->db->join($join['table'], $join['condition'], $join['type']);
        }
        $query = $this->db->get();
        return $query ? $query->result() : false;
    }

    public function all($data)
    {

        switch ($data['operation']) {

            case "get":
                $res = $this->db->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return $res ? $res->result() : false;
                break;

            case "get_select":
                $res = $this->db->select($data['select'])
                    ->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return $res ? $res->result() : false;
                break;

            case "get_row":
                $res = $this->db->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return $res ? $res->row() : false;
                break;

            case "get_row_select":
                $res = $this->db->select($data['select'])
                    ->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return $res ? $res->row() : false;
                break;

            case "get_array":
                $res = $this->db->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return $res ? $res->result_array() : false;
                break;

            case "get_array_select":
                $res = $this->db->select($data['select'])
                    ->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return $res ? $res->result_array() : false;
                break;

            case "check_if_true":
                $res = $this->db->from($data['table'])
                    ->where($data['where'])
                    ->get();
                return ($res->num_rows() > 0) ? true : false;
                break;

            case "insert":
                return $this->db->insert($data['table'], $data['data']) ? $this->db->insert_id() : false;
                break;

            case "update":
                return $this->db->where($data['where'])->update($data['table'], $data['data']) ? true : false;
                break;

            case "delete":
                return $this->db->where($data['where'])->delete($data['table']) ? true : false;
                break;

            case "check":
                return $data['return_msg'];
                break;
        }
    }
}
