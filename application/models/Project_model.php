<?php

class Project_model extends CI_Model
{
    public function index()
    {
        echo "this is model of project";
    }

    public function c($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }


    // GENERIC FUNCTIONS

    public function insert($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return ($query) ? $this->db->insert_id() : false;
    }

    public function search($table, $column, $name)
    {
        $res = $this->db->like($column, $name)->get($table);
        return ($res == true) ? $res->result() : false;
    }

    public function update($table, $data, $column, $id)
    {
        $this->db->where($column, $id)
            ->update($table, $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function all_data($table = null)
    {
        $res = $this->db->where(['delete_bit' => 0])->get($table);
        return ($res == true) ? $res->result() : false;
    }

    public function get_with_condition($table, $condition)
    {
        $res = $this->db->where($condition)->get($table);
        return $res ? $res->result() : false;
    }

    public function get_with_select_condition($table, $select, $condition)
    {
        $res = $this->db->select($select)
            ->where($condition)
            ->from($table)
            ->get();
        return $res ? $res->result() : false;
    }

    // COUNT FUNCTIONS
    public function count($table = null, $delete_bit = null, $enable_bit = null, $status_bit = null)
    {
        if ($this->session->userdata('role_id') == 1) {
            $res = $this->db->where([
                'delete_bit' => $delete_bit,
                'enable_bit' => $enable_bit,
                'status' => $status_bit
            ])->get($table);
            return ($res == true) ? count($res->result()) : false;
        } else if ($this->session->userdata('role_id') == 2) {
            $res = $this->db->where([
                'delete_bit' => $delete_bit,
                'enable_bit' => $enable_bit,
                'status' => $status_bit,
                'owner_id' => $this->session->userdata('id')
            ])->get($table);
            return ($res == true) ? count($res->result()) : false;
        } else {
            return false;
        }
    }

    public function count_all($table = null, $delete_bit = null, $enable_bit = null)
    {
        if ($this->session->userdata('role_id') == 1) {
            $res = $this->db->where([
                'delete_bit' => $delete_bit,
                'enable_bit' => $enable_bit
            ])->get($table);
            return ($res == true) ? count($res->result()) : false;
        } else if ($this->session->userdata('role_id') == 2) {
            $res = $this->db->where([
                'delete_bit' => $delete_bit,
                'enable_bit' => $enable_bit,
                'owner_id' => $this->session->userdata('id')
            ])->get($table);
            return ($res == true) ? count($res->result()) : false;
        } else {
            return false;
        }
    }


    public function dashCount()
    {
        $res = $this->db->select(
            'count(*) from `tbl_projects` as total,
            count(*) from `tbl_projects` as pending where `status` = 1,
            count(*) from `tbl_projects` as archived where `status` = 2'
        )->get('tbl_projects');
        return ($res == true) ? $res->result() : false;
    }

    public function count_underConstruction()
    {
        if ($this->session->userdata('role_id') == 1) :
            $res = $this->db->select('count(const_bit) as underConstruction')
                ->where(['const_bit' => 1, 'delete_bit' => 0])
                ->get('tbl_projects');
        else :
            $res = $this->db->select('count(const_bit) as underConstruction')
                ->where(['const_bit' => 1, 'delete_bit' => 0, 'owner_id' => $this->session->userdata('id')])
                ->get('tbl_projects');
        endif;
        return ($res == true) ? $res->row() : false;
    }

    // COUNT FUNCTIONS END

    // Project Functions Start
    public function projects($status)
    {
        if ($this->session->userdata('role_id') == 1) :
            $res = $this->db->where([
                'delete_bit' => 0,
                'status' => $status,
            ])
                ->get('tbl_projects');

            return ($res == true) ? $res->result() : false;

        elseif ($this->session->userdata('role_id') == 2) :

            $res = $this->db->where([
                'delete_bit' => 0,
                'status' => $status,
                'owner_id' => $this->session->userdata('id'),
            ])
                ->get('tbl_projects');

            return ($res == true) ? $res->result() : false;
        else :
            return false;
        endif;
    }

    public function get_project_details($id = "")
    {
        return $this->db->where('id', $id)->get('tbl_projects')->result();
    }



    public function search_where($table, $column, $name)
    {
        $res = $this->db->where($column, $name)->get($table);
        return ($res == true) ? $res->result() : false;
    }

    public function update_record($table, $column, $id, $data)
    {
        $this->db->where($column, $id);
        $this->db->update($table, $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_record_list($table, $column, $id, $data)
    {
        $res = $this->db->where($column, $id)
            ->update($table, $data);
        return  $res == true ? $this->db->where($column, $id)->get($table)->result() : false;
    }



    public function insert_with($table, $data)
    {

        $project_id = $data['project_id'];
        $list_id = $data['list_id'];
        $checklist_id = $data['checklist_id'];

        $res = $this->db->like(['project_id' => $project_id, 'list_id' => $list_id, 'checklist_id' => $checklist_id])->get($table)->result();

        if ($res == true) {
            $id = $res[0]->id;
            $data = [
                'project_id'            => $data['project_id'],
                'file_name'             => $data['file_name'],
                'list_id'                => $data['list_id'],
                'checklist_id'            => $data['checklist_id'],
            ];

            $query = $this->update_record($table, 'id', $id, $data);
            return ($this->db->affected_rows() > 0) ? true : false;
        }
        $query = $this->db->insert($table, $data);
        return ($this->db->insert_id()) ? $this->db->insert_id() : false;
    }

    public function check_existing($data)
    {
        $res = $this->db->like($data)->get('tbl_records')->result();
        return ($res == true) ? $res->result() : false;
    }

    public function details($table, $id)
    {
        $res = $this->db->where('id', $id)->get($table);
        return ($res) ? $res->result() : false;
    }

    public function get_lists($m2)
    {
        if ($m2 > 10000) {
            $this->db->where(['enable_bit' => 1, 'mk_status' => 1])->or_where(['mk_status' => 0]);
        } else {
            $this->db->where(['enable_bit' => 1, 'mk_status' => 0]);
        }
        $res = $this->db->order_by('index')->get('tbl_lists');
        return ($res == true) ? $res->result() : false;
    }

    // public function get_lists_with_checklists($id){
    //     $query = $this->db->query(
    //         "SELECT 
    //             tbl_lists.*, 
    //             tbl_project_records.active_bit  
    //         FROM 
    //             tbl_project_records 
    //         INNER JOIN 
    //             tbl_lists ON tbl_lists.id = tbl_project_records.list_id AND tbl_project_records.project_id = '".$id."' 
    //         WHERE 
    //             tbl_lists.delete_bit = 0
    //         AND    
    //             tbl_project_records.active_bit = 1
    //             group by tbl_project_records.list_id
    //             order by tbl_project_records.id ASC 
    //         " 
    //     );
    //     return $query->result();
    // }

    public function get_lists_with_checklists($id)
    {
        $this->db->select('tbl_lists.*, pr.active_bit');
        $this->db->from('tbl_project_records pr');
        $this->db->join('tbl_lists', 'tbl_lists.id = pr.list_id AND pr.project_id = ' . $id);
        $this->db->where('tbl_lists.delete_bit', 0);
        $this->db->where('pr.active_bit', 1);
        $this->db->group_by('pr.list_id');
        $this->db->order_by('pr.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_checklists($id)
    {
        $res = $this->db->where('list_id', $id)->get('tbl_checklists');
        return ($res == true) ? $res->result() : false;
    }

    // public function get_project_documents($id)
    // {

    //     $query = $this->db->query(
    //         "SELECT 
    //             tbl_checklists.*, tbl_checklists.list_id AS checklists_list_id, 
    //             tbl_records.list_id AS record_list_id, tbl_records.file_name, tbl_project_records.active_bit 
    //         FROM 
    //             tbl_checklists 
    //         LEFT OUTER JOIN 
    //             tbl_records ON tbl_checklists.id = tbl_records.checklist_id AND tbl_records.project_id = '" . $id . "' 
    //         INNER JOIN 
    //             tbl_project_records ON tbl_checklists.id = tbl_project_records.checklist_id AND tbl_project_records.project_id = '" . $id . "' 
    //         WHERE 
    //             tbl_checklists.delete_bit = 0
    //         AND    
    //             tbl_project_records.active_bit = 1
    //         "
    //     );

    //     return $query->result();
    // }

    public function get_project_documents($id)
    {
        $this->db->select('
            tbl_checklists.*,
            tbl_checklists.list_id AS checklists_list_id,
            tbl_records.list_id AS record_list_id,
            tbl_records.file_name,
            tbl_project_records.date_1,
            tbl_project_records.date_2,
            tbl_project_records.comments,
            tbl_project_records.active_bit');
        $this->db->from('tbl_checklists');
        $this->db->join('tbl_records', 'tbl_checklists.id = tbl_records.checklist_id AND tbl_records.project_id = ' . $id, 'left outer');
        $this->db->join('tbl_project_records', 'tbl_checklists.id = tbl_project_records.checklist_id AND tbl_project_records.project_id = ' . $id, 'inner');
        $this->db->where('tbl_checklists.delete_bit', 0);
        $this->db->where('tbl_project_records.active_bit', 1);
        $query = $this->db->get();
        return $query->result();
    }


    public function current_progress($pid)
    {
        $res = $this->db->select('count(id) as current')->where('project_id', $pid)->get('tbl_records');
        return ($res == true) ? $res->result() : 0;
    }

    public function max_progress_old($m2)
    {

        $m_stat = ($m2 <= 10000) ? 0 : 1;

        $this->db->select('*')
            ->from('tbl_checklists as checklists')
            ->join('tbl_lists as projectlists ', 'projectlists.id = checklists.list_id');

        if ($m_stat == 0) {
            $this->db->WHERE('mk_status', 0);
        } else {
            $this->db->WHERE('mk_status', 0);
            $this->db->OR_WHERE('mk_status', 1);
        }

        $res = $this->db->get();
        return ($res == true) ? $res->result() : 0;
    }

    public function max_progress($id)
    {
        $res = $this->db->select('count(active_bit) as max')->where(['project_id' => $id, 'active_bit' => 1])->get('tbl_project_records')->result();
        return ($res == true) ? $res : false;
    }

    public function get_all_users()
    {
        // $res = $this->db->where(['role_id != ' => 1, 'enable_bit ' => 1, 'delete_bit' => 0])->get('tbl_users');
        // return ($res == true) ? $res->result() : false;

        $res = $this->db->select('main.*, role.title as role_title')
            ->from('tbl_users as main')
            ->join('tbl_roles as role', 'main.role_id = role.id')
            ->where([
                'main.role_id !=' => 1,
                'main.enable_bit ' => 1,
                'main.delete_bit' => 0
            ])
            ->get();
        return ($res == true) ? $res->result() : false;
    }

    // UPDATE 20/10/2022
    public function insert_project_lists($id)
    {
        $lists = $this->db->where('enable_bit', 1)->get('tbl_lists')->result();
        $getLists = [];
        foreach ($lists as $list) {
            $getLists[$list->title] = $this->db->where(['list_id' => $list->id])->get('tbl_checklists')->result();
        }

        foreach ($getLists as $list) {
            foreach ($list as $checkList) {
                $data = [
                    'project_id' => $id,
                    'list_id' => $checkList->list_id,
                    'checklist_id' => $checkList->id,
                    'active_bit' => 0,
                    'created_at' => date('Y-m-d'),
                    'delete_bit' => 0
                ];
                $res = $this->db->insert('tbl_project_records', $data);
            }
        }
        return true;
    }

    public function get_project_checklists($id)
    {
        $res = $this->db->select([
            'main.project_id',
            'main.list_id',
            'main.checklist_id',
            'list.title as list_title',
            'checklist.title as checklist_title',
            'main.active_bit'
        ])
            ->from('tbl_project_records as main')
            ->join('tbl_lists as list', 'list.id = main.list_id')
            ->join('tbl_checklists as checklist', 'checklist.id = main.checklist_id')
            ->where([
                'main.project_id' => $id,
                'main.delete_bit' => 0,
                'checklist.delete_bit' => 0
            ])
            ->order_by('main.list_id')
            ->get();

        return $res ? $res->result() : false;
    }

    public function get_project_lists()
    {
        $res = $this->db->where(['enable_bit' => 1])->get('tbl_lists');
        return ($res == true) ? $res->result() : false;
    }

    public function updating_checklists($data, $where)
    {
        $this->db->where($where)
            ->update('tbl_project_records', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_selected_project_checklists($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_project_records WHERE project_id = '" . $id . "' AND active_bit = 1");
        return $query->result();
    }

    public function get_tbl_records($id)
    {
        $res = $this->db->select('*')->where(['project_id' => $id])->get('tbl_records')->result();
        return $res;
    }

    public function check_if_file_exist($res)
    {
        $res = $this->db->where($res)->get('tbl_records')->result();
        return $res ? true : false;
    }

    public function project_qr_img($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_projects', $data);
        // $galID = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE)
            return true;
        else
            return false;
    }

    // UPDATE 27/10/22
    public function get_all_projects()
    {
        $res = $this->db->select('
                                    main.id as project_id,
                                    main.project_name,
                                    main.location,
                                    main.project_size_m2,
                                    main.company_name,
                                    main.contact_email as company_email,
                                    main.phone as company_phone,
                                    main.status as project_status,
                                    main.const_bit,
                                    user.full_name,
                                    user.email as user_email,
                                ')
            ->from('tbl_projects as main')
            ->join('tbl_users as user', 'user.id = main.owner_id')
            ->where(['main.delete_bit' => 0])
            ->get();
        return $res ? $res->result() : false;
    }

    // UPDATE 31/10/22
    public function generate_dash_salesChart()
    {
        if ($this->session->userdata('role_id') == 1) :
            $res = $this->db->select("count(created_at) as count, created_at as date")
                ->where(['delete_bit' => 0])
                ->group_by('created_at')
                ->from('tbl_projects')
                ->get();
        elseif ($this->session->userdata('role_id') == 2) :
            $res = $this->db->select("count(created_at) as count, created_at as date")
                ->where(['delete_bit' => 0, 'owner_id' => $this->session->userdata('id')])
                ->group_by('created_at')
                ->from('tbl_projects')
                ->get();
        endif;
        return $res ? $res->result() : false;
    }

    public function get_notification_list_items($data)
    {
        $res = $this->db->select('checklist.title as checklist_title')
            ->from('tbl_project_records as main')
            ->join('tbl_checklists as checklist', 'main.checklist_id = checklist.id')
            ->where([
                'main.list_id' => $data['lid'],
                'main.project_id' => $data['pid'],
                'main.active_bit' => 1,
                'main.status' => 0,
            ])
            ->get();
        return $res ? $res->result() : false;
    }
}
