<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if (!($this->session->userdata('logged_in') == True))
			redirect(base_url());

		$this->load->model('Project_model');
		$this->load->model('Admin_model');
		$this->load->model('Commons_model');
		$this->load->library('Form_validation');
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////// Dashboard //////// //////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function load_view($path = null, $module = null, $pgdata = null)
	{
		$data['modules'] = $this->Admin_model->get_modules();
		$this->load->view('Admin/header.php');
		$this->load->view('Admin/navbar');
		$this->load->view('Admin/sidebar.php', $data);
		$this->load->view($path . $module, $pgdata);
		$this->load->view('Admin/footer.php');
	}


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////// MODULE FUNCTIONS //////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function all_projects()
	{
		$data['pageHeading'] 	= 'Todos los Proyectos';
		$data['projects'] 		= $this->Project_model->projects(2);
		$this->load_view('Project/', 'all_projects', $data);
	}

	public function completed_projects()
	{
		$data['pageHeading'] 	= 'Terminado Proyectos';
		$data['projects'] 		= $this->Project_model->projects(1);
		$this->load_view('Project/', 'completed_projects', $data);
	}

	public function pending_projects()
	{
		$data['pageHeading'] 	= 'Pending Projects';
		$data['projects'] 		= $this->Project_model->projects(2);
		$this->load_view('Project/', 'pending_projects', $data);
	}

	public function archived_projects()
	{
		$data['pageHeading'] 			= 'Archivado Proyectos';
		$data['projects'] 		= $this->Project_model->projects(3);
		$this->load_view('Project/', 'archived_projects', $data);
	}

	public function project_details($id)
	{
		$data['pageHeading'] 	= 'Detalles del Proyecto';
		$data['project'] = $this->Project_model->details('tbl_projects', $id);
		$data['lists'] = $this->Project_model->get_lists_with_checklists($id);
		$data['list_count'] = count($data['lists']);
		$data['documents'] = $this->Project_model->get_project_documents($id);
		$this->load_view('Project/', 'project_details', $data);
	}

	public function update_project_details($id)
	{
		$data['pageHeading'] 	= 'Detalles del Proyecto';
		$data['project'] = $this->Project_model->details('tbl_projects', $id);
		$data['lists'] = $this->Project_model->get_lists($data['project'][0]->project_size_m2);
		$data['list_count'] = count($data['lists']);
		$data['documents'] = $this->Project_model->get_project_documents($id);
		// $data['documents'] = $this->Project_model->get_selected_project_checklists($id);
		$this->load_view('Project/', 'project_details', $data);
	}

	public function edit_project($id)
	{
		$data['pageHeading'] 	= 'Editar Proyecto';
		$data['project'] 		=  $this->Project_model->details('tbl_projects', $id);
		$data['additional_emails'] = json_decode($data['project'][0]->additional_emails);
		$this->load_view('Project/', 'edit_project', $data);
	}

	public function update_project()
	{
		$this->add_update_project($this->input->post(), 2);
	}

	public function edit_project_checklists($id)
	{
		$data['checklists']  = $this->Project_model->get_project_checklists($id);
		$data['documents']  = $this->Project_model->get_tbl_records($id);
		$data['lists']       = $this->Project_model->get_project_lists();
		$data['project_id'] = $id;

		$data['pageHeading'] = 'Edit Checklists';
		$this->load_view('Project/', 'new_project_lists', $data);
	}

	public function new_project()
	{
		if (empty($this->input->post())) {
			$data['pageHeading'] = 'Añadir Nuevo Proyecto';
			$this->load_view('Project/', 'new_project', $data);
		} else {
			$this->add_update_project($this->input->post(), 1);
		}
	}

	public function add_update_project($data, $check)
	{
		$this->form_validation->set_rules('project_name', 'Project Name', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('project_size_m2', 'Project Size', 'required|numeric');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('contact_email', 'Contact Email', 'required');
		$this->form_validation->set_rules('phone', 'Company Phone', 'required|numeric');
		$this->form_validation->set_rules('labels', 'Labels', 'required');

		if ($this->form_validation->run()) :
			$i_u_data = [
				'owner_id'      	=> $this->session->userdata('id'),
				'project_name' 		=> $data['project_name'],
				'location'			=> $data['location'],
				'project_size_m2' 	=> $data['project_size_m2'],
				'description' 		=> $data['description'],
				'company_name' 		=> $data['company_name'],
				'contact_email' 	=> $data['contact_email'],
				'additional_emails' => json_encode($data['additional_emails']),
				'phone' 			=> $data['phone'],
				'labels' 			=> $data['labels'],
				'const_bit' 		=> $data['underConstruction'] == 1 ? 1 : 2,
				'created_at' 		=> date('Y-m-d H:i:s')
			];


			if ($check == 1) :
				$res = $this->Project_model->insert('tbl_projects', $i_u_data);
				if ($res == true) :
					$check = $this->Project_model->insert_project_lists($res);
					if ($check) :
						$data['checklists']  = $this->Project_model->get_project_checklists($res);
						$data['lists']  = $this->Project_model->get_project_lists();
						$data['pageHeading']  = 'Choose Checklists';
						$this->load_view('Project/', 'new_project_lists', $data);
					else :
						$this->session->set_flashdata('msg', 'Project Created! Unable to Add checklist !!!');
						redirect(base_url('Projects'));
					endif;
				else :
					$this->session->set_flashdata('msg', 'Project Creation Unsuccessful !!!');
					redirect(base_url('Projects'));
				endif;
			else :
				$res = $this->Project_model->update_record('tbl_projects', 'id', $data['id'], $i_u_data);
				if ($res == true) :

					$this->session->set_flashdata('msg', 'Project Updated SuccessFully !!!');
					redirect(base_url('Projects'));
				else :
					$this->session->set_flashdata('msg', 'Project Updation Unsuccessful !!!');
					redirect(base_url('Projects'));
				endif;
			endif;
		else :
			if ($check == 1) :
				$data['pageHeading'] = 'Add New Project';
				$this->load_view('Project/', 'new_project', $data);
			else :
				$data['pageHeading'] = 'Edit Project';
				$this->load_view('Project/', 'edit_project', $data);
			endif;
		endif;
	}

	public function update_checklists()
	{
		$active_bit = $this->input->get('active_bit');
		$data['active_bit'] = $this->input->get('active_bit1');
		$res = [
			'project_id' => $this->input->get('pid'),
			'list_id' => $this->input->get('lid'),
			'checklist_id' => $this->input->get('clid')
		];
		$callback = $this->Project_model->check_if_file_exist($res);
		if ($callback) {
			echo json_encode(array('status' => 200, 'file_check' => 1, 'msg' => 'Unable To Uncheck, File Already Uploaded'));
		} else {
			$result = $this->Project_model->updating_checklists($data, $res);
			echo $result ? json_encode(array('status' => 200, 'file_check' => 0)) : json_encode(array('status' => 201));
		}
	}

	public function update_project_list()
	{
		$res = $this->Commons_model->update(
			[
				'active_bit' => $this->input->get('status')
			],
			[
				'project_id' => $this->input->get('pid'),
				'list_id' => $this->input->get('lid')
			],
			'tbl_project_records'
		);

		echo json_encode(['res' => $res, "status" => (($this->input->get('status')) == 1 ? 0 : 1)]);
	}

	public function delete_project_record()
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

		$res = $this->Project_model->update_record('tbl_projects', 'id', $id, $data);
		if ($res > 0)
			echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.', 'result' => $data));
		else
			echo json_encode(array('status' => '201', 'msg' => 'Unable to update Project detail!.', 'result' => $res));
	}

	public function disable_project()
	{
		$id = $this->input->get('id');
		$data = array();
		foreach ($this->input->get() as $key => $val) {
			if ($key != 'id')
				$data[$key] = (int)$val;
		}
		if ($id != "" && $id != "0") {
			$res = $this->Project_model->update_record('tbl_projects', 'id', $id, $data);
			if ($res == true)
				echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.', 'res' => $data));
			else
				echo json_encode(array('status' => $res, 'msg' => 'Unable to update Project detail!.'));
		} else {
			echo json_encode(array('status' => '204', 'msg' => 'Unexpected error!, please contact system administrator.'));
		}
	}

	public function complete_projects()
	{
		$data['pageHeading'] 	= 'Pending Projects';
		$data['projects'] 		= $this->Project_model->projects(2);
		$this->load_view('Project/', 'pending_projects', $data);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////PROJECT FUNCTIONS //////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////AJAX FUNCTIONS /////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function add_checklist_doc()
	{
		$file_element_name = 'doc';
		$doc = $_FILES['doc']['name'];
		$config = [
			'upload_path' => './Assets/docs/',
			'allowed_types' => 'pdf|doc|docx|jpg|png|jpeg',
			'max_size' => 10000000000,
			'file_name' => time() . $doc
		];

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($file_element_name)) {
			echo $this->upload->display_errors('', '');
		} else {
			$rowData = $this->upload->data();
			if ($rowData['file_name'] != "") {
				$data = [
					'project_id'			=> $this->input->post('project_id'),
					'file_name' 			=> $rowData['file_name'],
					'list_id'				=> $this->input->post('list_id'),
					'checklist_id'			=> $this->input->post('checklist_id'),
				];
				$res = $this->Project_model->insert_with('tbl_records', $data);
				// $res = $this->Project_model->insert('tbl_records',$data);
				echo ($res > 0) ? json_encode(array(["status" => 200, "name" => $rowData['file_name']])) : json_encode(array("status" => 201));
			} else {
				echo json_encode(array('status' => 203));
			}
		}
	}

	public function update_status()
	{
		if (!empty($this->input->get('id'))) {
			$data['status'] = $this->input->get('status');
			$res = $this->Project_model->update_record('tbl_projects', 'id', $this->input->get('id'), $data);
			if ($res == true)
				echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.'));
			else
				echo json_encode(array('status' => '200', 'msg' => 'Project detail updated successfully.'));
		} else {
			echo json_encode(array('status' => 201));
		}
	}

	// UPDATE 20/10/2022
	public function edit_project_lists($id)
	{
		$data['pageHeading'] 	= 'Project Checklists';
		$data['checklists'] 	= $this->Project_model->get_project_checklists($id);
		$this->load_view('Project/', 'new_project_lists', $data);
	}
}
