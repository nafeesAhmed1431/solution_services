<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Project_model');
		$this->load->model('Commons_model');

		if (!($this->session->userdata('logged_in') == True)) :
			redirect(base_url());
		endif;
	}

	function index()
	{
		redirect(base_url('Admin/dashboard'));
	}

	public function dashboard()
	{
		$data['projects'] = $this->Project_model->count_all('tbl_projects', 0, 1);
		$data['archived'] = $this->Project_model->count('tbl_projects', 0, 1, 3);
		$data['completed'] = $this->Project_model->count('tbl_projects', 0, 1, 1);
		$data['underConstruction'] = $this->Project_model->count_underConstruction();
		$this->load_view("Admin/", "dashboard", $data);
	}

	public function load_view($path_module = null, $name_module = "", $pgdata = "")
	{
		$data['modules'] = $this->Admin_model->get_modules();
		$this->load->view('Admin/header.php');
		$this->load->view('Admin/navbar');
		$this->load->view('Admin/sidebar.php', $data);
		$this->load->view($path_module . $name_module, $pgdata);
		$this->load->view('Admin/footer.php');
	}


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// USER FUNCTIONS ////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function users()
	{
		$data['pageHeading'] = 'Users';
		$data['users'] = $this->Project_model->get_all_users();
		$this->load_view('Project/', 'users', $data);
	}

	public function new_user()
	{
		$data['pageHeading'] = 'Add New User';
		$data['users'] = $this->Project_model->get_all_users();
		$this->load_view('Project/', 'new_user', $data);
	}

	public function add_new_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('full_name', 			'Full Name', 		'required');
		$this->form_validation->set_rules('user_name', 			'User Name', 		'required|is_unique[tbl_users.user_name]|alpha');
		$this->form_validation->set_rules('email', 				'Email', 			'required|is_unique[tbl_users.email]');
		$this->form_validation->set_rules('contact', 			'Contact No', 		'required|is_unique[tbl_users.contact]');
		$this->form_validation->set_rules('password', 			'Password', 		'required');
		$this->form_validation->set_rules('confirm_password', 	'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == true) {
			$status = "";

			if ($status != "error") {
				if (empty($file)) {
					$data = [
						'full_name' 		=> $this->input->post('full_name'),
						'user_name' 		=> $this->input->post('user_name'),
						'email' 			=> $this->input->post('email'),
						'gender' 			=> $this->input->post('gender'),
						'user_theme' 		=> $this->input->post('theme'),
						'cnic' 				=> $this->input->post('cnic'),
						'contact' 			=> $this->input->post('contact'),
						'address' 			=> $this->input->post('address'),
						'password' 			=> $this->input->post('password'),
						'created_at' 		=> date('Y-m-d H:i:s'),
						'role_id' 		    => 2,
						'enable_bit' 		=> 1,
						'delete_bit' 		=> 0
					];
					$res = $this->Admin_model->register_user('tbl_users', $data);
					if ($res == true) :
						$this->session->set_flashdata('msg', 'User Updated SuccessFully !!!');
						redirect(base_url('Users'));
					else :
						$this->session->set_flashdata('msg', 'User Updation Unsuccessful !!!');
						redirect(base_url('Users'));
					endif;
				}
			}
		} else {
			$this->load_view('Admin/new_user');
		}
	}

	public function disable_user()
	{
		$id = $this->input->get('id');
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			if ($key != 'id')
				$data[$key] = (int)$val;
		}
		if ($id != "" && $id != "0") {
			$res = $this->Project_model->update_record('tbl_users', 'id', $id, $data);
			if ($res == true)
				echo json_encode(array('status' => '200', 'msg' => 'User updated successfully.', 'res' => $data));
			else
				echo json_encode(array('status' => $res, 'msg' => 'Unable to update User!.'));
		} else {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error!, please contact system administrator.'));
		}
	}

	public function delete_user()
	{
		$id = $this->input->get('id');
		if ($id == "" && $id == 0) {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error, please contact system administrator!'));
		}

		$res = 0;
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			if ($key != 'id')
				$data[$key] = (int)$val;
		}

		$res = $this->Project_model->update_record('tbl_users', 'id', $id, $data);
		if ($res > 0)
			echo json_encode(array('status' => '200', 'msg' => 'User Deleted successfully.', 'result' => $data));
		else
			echo json_encode(array('status' => '201', 'msg' => 'Unable to Delete User!.', 'result' => $res));
	}

	public function edit_user($id)
	{
		$data['pageHeading'] 	= 'Edit User';
		$data['user'] 		=  $this->Admin_model->details('tbl_users', $id);
		$this->load_view('Project/', 'edit_user', $data);
	}

	public function update_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('full_name', 			'Full Name', 		'required');
		$this->form_validation->set_rules('email', 				'Email', 			'required');
		$this->form_validation->set_rules('contact', 			'Contact No', 		'required');

		if ($this->form_validation->run()) :
			$i_u_data = [
				'full_name' 		=> $this->input->post('full_name'),
				'email' 			=> $this->input->post('email'),
				'gender' 			=> $this->input->post('gender'),
				'user_theme' 		=> $this->input->post('theme'),
				'cnic' 				=> $this->input->post('cnic'),
				'contact' 			=> $this->input->post('contact'),
				'address' 			=> $this->input->post('address'),
				'password' 			=> $this->input->post('password'),
				'created_at' 		=> date('Y-m-d H:i:s'),
				'enable_bit' 		=> 1,
				'delete_bit' 		=> 0
			];
			$res = $this->Project_model->update_record('tbl_users', 'id', $this->input->post('id'), $i_u_data);
			if ($res == true) :
				$this->session->set_flashdata('msg', 'User Updated SuccessFully !!!');
				redirect(base_url('Users'));
			else :
				$this->session->set_flashdata('msg', 'User Updation Unsuccessful !!!');
				redirect(base_url('Users'));
			endif;
			$data['pageHeading'] = 'Edit Project';
			$this->load_view('Project/', 'edit_user', $data);
		else :
			$data['pageHeading'] = 'Edit Project';
			$data['user'] 		 =  $this->Admin_model->details('tbl_users', $this->input->post('id'));
			$this->load_view('Project/', 'edit_user', $data);
		endif;
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// USER FUNCTIONS ////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// LISTS FUNCTIONS ///////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function lists()
	{
		$data['pageHeading'] = 'Lists';
		$data['lists'] = $this->Admin_model->all_data_by_enable_bit('tbl_lists');
		$this->load_view('Project/', 'lists', $data);
	}

	public function new_lists()
	{
		$data['pageHeading'] = 'Add New User';
		$data['users'] = $this->Project_model->get_all_users();
		$this->load_view('Project/', 'new_user', $data);
	}

	public function add_new_lists()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('full_name', 			'Full Name', 		'required');
		$this->form_validation->set_rules('user_name', 			'User Name', 		'required|is_unique[tbl_users.user_name]|alpha');
		$this->form_validation->set_rules('email', 				'Email', 			'required|is_unique[tbl_users.email]');
		$this->form_validation->set_rules('contact', 			'Contact No', 		'required|is_unique[tbl_users.contact]');
		$this->form_validation->set_rules('password', 			'Password', 		'required');
		$this->form_validation->set_rules('confirm_password', 	'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == true) {
			$status = "";

			if ($status != "error") {
				if (empty($file)) {
					$data = [
						'full_name' 		=> $this->input->post('full_name'),
						'user_name' 		=> $this->input->post('user_name'),
						'email' 			=> $this->input->post('email'),
						'gender' 			=> $this->input->post('gender'),
						'cnic' 				=> $this->input->post('cnic'),
						'contact' 			=> $this->input->post('contact'),
						'address' 			=> $this->input->post('address'),
						'password' 			=> $this->input->post('password'),
						'created_at' 		=> date('Y-m-d H:i:s'),
						'role_id' 		    => 2,
						'enable_bit' 		=> 1,
						'delete_bit' 		=> 0
					];
					$res = $this->Admin_model->register_user('tbl_users', $data);
					if ($res == true) :
						$this->session->set_flashdata('msg', 'User Updated SuccessFully !!!');
						redirect(base_url('Users'));
					else :
						$this->session->set_flashdata('msg', 'User Updation Unsuccessful !!!');
						redirect(base_url('Users'));
					endif;
				}
			}
		} else {
			$this->load_view('Admin/new_user');
		}
	}

	public function edit_lists($id)
	{
		$data['pageHeading'] 	= 'Edit User';
		$data['user'] 		=  $this->Admin_model->details('tbl_users', $id);
		$this->load_view('Project/', 'edit_user', $data);
	}

	public function delete_list_record()
	{
		$id = $this->input->get('id');
		if ($id == "" && $id == 0) {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error, please contact system administrator!'));
		}

		$res = 0;
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			if ($key != 'id')
				$data[$key] = (int)$val;
		}

		$res = $this->Project_model->update_record('tbl_lists', 'id', $id, $data);
		if ($res > 0)
			echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.', 'result' => $data));
		else
			echo json_encode(array('status' => '201', 'msg' => 'Unable to update Project detail!.', 'result' => $res));
	}

	public function disable_list()
	{
		$id = $this->input->get('id');
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			if ($key != 'id')
				$data[$key] = (int)$val;
		}
		if ($id != "" && $id != "0") {
			$res = $this->Project_model->update_record('tbl_lists', 'id', $id, $data);
			if ($res == true)
				echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.', 'res' => $data));
			else
				echo json_encode(array('status' => $res, 'msg' => 'Unable to update Project detail!.'));
		} else {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error!, please contact system administrator.'));
		}
	}

	public function add_new_list()
	{
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			$data[$key] = $val;
		}
		$data["created_at"] = date('Y-m-d H:i:s');
		$res = $this->Admin_model->add_record_with_data('tbl_lists', $data);
		if ($res) {
			echo json_encode(array('status' => '200', 'msg' => 'State detail added successfully.', 'result' => $res));
		} else {
			echo json_encode(array('status' => '201', 'msg' => 'Unexpexted error, please try again..'));
		}
	}

	public function update_list_details()
	{
		$id = $this->input->get('id');
		$data['title'] = $this->input->get('title');
		if ($id != "" && $id != "0") {
			$res = $this->Project_model->update_record_list('tbl_lists', 'id', $id, $data);
			if ($res == true)
				echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.', 'result' => $res));
			else
				echo json_encode(array('status' => $res, 'msg' => 'Unable to update Project detail!.'));
		} else {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error!, please contact system administrator.'));
		}
	}


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// LISTS FUNCTIONS ///////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// CHECKLISTS FUNCTIONS //////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function checklist_details($id)
	{
		$data['pageHeading'] = 'CheckLists';
		$data['lists'] = $this->Admin_model->get_checklists($id);
		$data['list_id'] = $id;
		$this->load_view('Project/', 'checklists', $data);
	}

	public function delete_checklistlist()
	{
		echo json_encode([
			'res' => $this->Commons_model->update(
				['delete_bit' => 1],
				['id' => $this->input->get('id')],
				'tbl_checklists'
			)
		]);
	}

	public function disable_checklist()
	{
		$id = $this->input->get('id');
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			if ($key != 'id')
				$data[$key] = (int)$val;
		}
		if ($id != "" && $id != "0") {
			$res = $this->Project_model->update_record('tbl_checklists', 'id', $id, $data);
			if ($res == true)
				echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.', 'res' => $data));
			else
				echo json_encode(array('status' => $res, 'msg' => 'Unable to update Project detail!.'));
		} else {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error!, please contact system administrator.'));
		}
	}

	public function add_new_checklist()
	{
		echo  json_encode(['res' => $this->Commons_model->insert([
			'title' => $this->input->get('title'),
			'list_id' => $this->input->get('list_id'),
			'process_id' => $this->input->get('process_id'),
			'enable_bit' => '1',
			'delete_bit' => '0'
		], 'tbl_checklists')]);
	}

	public function udpate_checklist()
	{
		echo json_encode([
			'res' => $this->Commons_model->update(
				[
					'title' => $this->input->get('title'),
					'process_id' => $this->input->get('process_id'),
				],
				['id' => $this->input->get('clid')],
				'tbl_checklists'
			)
		]);
	}

	public function update_checklist_status()
	{
		echo json_encode([
			'res' => $this->Commons_model->update(
				['enable_bit' => $this->input->get('status') == 1 ? 0 : 1],
				['id' => $this->input->get('clid')],
				'tbl_checklists'
			),
			'status' => $this->input->get('status') == 1 ? 0 : 1
		]);
	}

	public function pre_edit_checklist()
	{
		echo json_encode([
			'data' => $this->Commons_model->get_where_select(
				['id','title'],
				['delete_bit' => 0,'enable_bit' => 1],
				'tbl_process'
			),
			'pid' => $this->Commons_model->get_row_select('process_id','tbl_checklists',['id' => $this->input->get('clid')])->process_id
		]);
	}


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// CHECKLISTS FUNCTIONS //////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////PROCESS FUNCTIONS //////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function process()
	{
		$data['pageHeading'] 	= 'Processes';
		$data['processes'] 		= $this->Commons_model->get_where_select('*', ['delete_bit' => 0], 'tbl_process');
		$this->load_view('Project/', 'all_processes', $data);
	}

	public function update_process_status()
	{
		echo json_encode([
			'res' => $this->Commons_model->update(
				['enable_bit' => $this->input->get('status') == 1 ? 0 : 1],
				['id' => $this->input->get('process_id')],
				'tbl_process'
			),
			'status' => $this->input->get('status') == 1 ? 0 : 1
		]);
	}

	public function udpate_process()
	{
		echo json_encode([
			'res' => $this->Commons_model->update(
				['title' => $this->input->get('title')],
				['id' => $this->input->get('process_id')],
				'tbl_process'
			)
		]);
	}

	public function add_new_process()
	{
		echo  json_encode(['res' => $this->Commons_model->insert([
			'title' => $this->input->get('title'),
			'enable_bit' => '1',
			'delete_bit' => '0'
		], 'tbl_process')]);
	}

	public function delete_process()
	{
		echo json_encode([
			'res' => $this->Commons_model->update(
				['delete_bit' => 1],
				['id' => $this->input->get('process_id')],
				'tbl_process'
			)
		]);
	}

	public function get_process()
	{
		echo json_encode([
			'data' => $this->Commons_model->get_where_select(
				[
					'id',
					'title'
				],
				[
					'delete_bit' => 0,
					'enable_bit' => 1
				],
				'tbl_process'
			)
		]);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////PROCESS FUNCTIONS //////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
