<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if (!($this->session->userdata('logged_in') == True))
			redirect(base_url());

		$this->load->model([
			'Project_model',
			'Admin_model',
			'Commons_model',
		]);
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
		$data['pid'] 	= $id;
		$data['records'] = $this->Project_model->get_project_details_checklists($id);
		$this->load_view('Project/', 'project_details_v2', $data);
	}

	public function update_project_details($id)
	{
		$data['pageHeading'] 	= 'Detalles del Proyecto';
		$data['project'] = $this->Project_model->details('tbl_projects', $id);
		$data['lists'] = $this->Project_model->get_lists($data['project'][0]->project_size_m2);
		$data['list_count'] = count($data['lists']);
		$data['documents'] = $this->Project_model->get_project_documents($id);
		$this->load_view('Project/', 'project_details', $data);
	}

	public function edit_project($id)
	{
		$data['pageHeading'] 	= 'Editar Proyecto';
		$data['project'] 		=  $this->Commons_model->get_row('tbl_projects', ['id' => $id]);
		$this->load_view('Project/', 'edit_project', $data);
	}

	public function update_project()
	{
		$this->add_update_project($this->input->post(), false);
	}

	public function edit_project_checklists($id)
	{
		$data['records'] = $this->Project_model->get_project_checklists_v2($id);
		$data['pageHeading'] = 'Edit Project Checklists';
		$data['pid'] = $id;
		$this->load_view('Project/', 'new_project_checklists_v2', $data);
	}

	public function new_project()
	{
		if (empty($this->input->post())) {
			$data['pageHeading'] = 'Añadir Nuevo Proyecto';
			$this->load_view('Project/', 'new_project', $data);
		} else {
			$this->add_update_project($this->input->post(), true);
		}
	}

	public function add_update_project($data, $insert)
	{
		$this->form_validation->set_rules([
			['field' => 'project_name',    'label' => 'Project Name',      'rules' => 'required'],
			['field' => 'location',        'label' => 'Location',          'rules' => 'required'],
			['field' => 'project_size_m2', 'label' => 'Project Size',      'rules' => 'required|numeric'],
			['field' => 'company_name',    'label' => 'Company Name',      'rules' => 'required'],
			['field' => 'contact_email',   'label' => 'Email',             'rules' => 'required|valid_email'],
			['field' => 'phone',           'label' => 'Phone',             'rules' => 'required|numeric'],
			['field' => 'labels',          'label' => 'Labels',            'rules' => 'required'],
			['field' => 'owner',           'label' => 'Owner',         	   'rules' => 'required'],
			['field' => 'construction_m2', 'label' => 'Construction Area', 'rules' => 'required|numeric'],
			['field' => 'land_m2',         'label' => 'Land Area',         'rules' => 'required|numeric']
		]);

		if ($this->form_validation->run()) :
			$i_u_data = [
				'owner_id'      	=> $this->session->userdata('id'),
				'additional_emails' => json_encode($data['additional_emails']),
				'project_name' 		=> $data['project_name'],
				'location'			=> $data['location'],
				'project_size_m2' 	=> $data['project_size_m2'],
				'description' 		=> $data['description'],
				'company_name' 		=> $data['company_name'],
				'contact_email' 	=> $data['contact_email'],
				'phone' 			=> $data['phone'],
				'owner' 			=> $data['owner'],
				'construction_m2'   => $data['construction_m2'],
				'land_m2' 			=> $data['land_m2'],
				'labels' 			=> $data['labels'],
				'const_bit' 		=> $data['underConstruction'] == 1 ? 1 : 2,
				'created_at' 		=> date('Y-m-d H:i:s')
			];

			if ($insert) :
				$res = $this->Project_model->insert('tbl_projects', $i_u_data);
				if ($res == true) :
					$check = $this->insert_new_project_records($res);
					if ($check) :
						$this->send_project_create_email($res);
						$this->load_new_checklist_records($res);
						return redirect(base_url('Project/load_new_checklist_records/' . $res));
					// $data['checklists']  = $this->Project_model->get_project_checklists($res);
					// $data['lists']  = $this->Project_model->get_project_lists();
					// $data['pageHeading']  = 'Choose Checklists';
					// $this->load_view('Project/', 'new_project_lists', $data);
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
					redirect(base_url('Project'));
				else :
					$this->session->set_flashdata('msg', 'Project Updation Unsuccessful !!!');
					redirect(base_url('Project'));
				endif;
			endif;
		else :
			if ($insert) :
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

	public function insert_new_project_records($id)
	{
		$checklists = $this->Project_model->get_new_insert_checklists();
		foreach ($checklists as $checklist) {
			$this->db->insert('tbl_project_records', [
				'project_id' => $id,
				'list_id' => $checklist->list_id,
				'process_id' => $checklist->process_id,
				'checklist_id' => $checklist->checklist_id,
				'status' => 0,
				'active_bit' => 0,
				'created_at' => date('Y-m-d H:i:s'),
				'delete_bit' => 0
			]);
		}
		return true;
	}

	public function load_new_checklist_records($id)
	{
		$data['records'] = $this->Project_model->get_project_checklists_v2($id);
		$data['pageHeading'] = 'Select Project Checklists';
		$data['pid'] = $id;
		$this->load_view('Project/', 'new_project_checklists_v2', $data);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////PROJECT FUNCTIONS //////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////AJAX FUNCTIONS /////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function add_checklist_doc()
	{
		$this->load->library('upload', [
			'upload_path' => './Assets/docs/',
			'allowed_types' => 'pdf|doc|docx|jpg|png|jpeg',
			'max_size' => 10000000000,
			'file_name' => time() . "_" . $this->input->post('pid') . "_" . $this->input->post('clid')
		]);

		if (!$this->upload->do_upload('doc')) {
			echo json_encode([
				'res' => false,
				'error' => $this->upload->display_errors('', '')
			]);
		} else {
			$rowData = $this->upload->data();
			if ($rowData['file_name'] != "") {
				echo json_encode([
					'res' => $this->Commons_model->update([
						'status' => 1,
						'document_name' => $rowData['file_name']
					], [
						'project_id'	=> $this->input->post('pid'),
						'checklist_id'	=> $this->input->post('clid'),
					], 'tbl_project_records')
				]);
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

	public function update_date1()
	{
		echo json_encode(['status' => $this->Commons_model->update([
			'date_1' => $this->input->get('date')
		], [
			'project_id' => $this->input->get('pid'),
			'checklist_id' => $this->input->get('clid')
		], 'tbl_project_records')]);
	}

	public function update_date2()
	{
		echo json_encode(['status' => $this->Commons_model->update([
			'date_2' => $this->input->get('date')
		], [
			'project_id' => $this->input->get('pid'),
			'checklist_id' => $this->input->get('clid')
		], 'tbl_project_records')]);
	}

	public function update_comment()
	{
		echo json_encode(['status' => $this->Commons_model->update([
			'comments' => $this->input->get('comment')
		], [
			'project_id' => $this->input->get('pid'),
			'checklist_id' => $this->input->get('clid')
		], 'tbl_project_records')]);
	}

	public function update_project_list_v1()
	{
		echo json_encode(['res' => $this->Commons_model->update(
			[
				'active_bit' => 1
			],
			[
				'project_id' => $this->input->get('pid'),
				'list_id' => $this->input->get('lid')
			],
			'tbl_project_records'
		)]);
	}

	public function update_project_process_v1()
	{
		if ($this->Commons_model->get_row(
			'tbl_project_records',
			[
				'project_id' => $this->input->get('project_id'),
				'process_id' => $this->input->get('process_id')
			]
		)->status == 0) {
			echo json_encode(['res' => $this->Commons_model->update(
				[
					'active_bit' => 1
				],
				[
					'project_id' => $this->input->get('project_id'),
					'process_id' => $this->input->get('process_id')
				],
				'tbl_project_records'
			)]);
		} else {
			echo json_encode(['res' => false]);
		}
	}

	public function update_project_checklist_v1()
	{
		if ($this->Commons_model->get_row(
			'tbl_project_records',
			[
				'project_id' => $this->input->get('project_id'),
				'checklist_id' => $this->input->get('clid')
			]
		)->status == 0) {
			echo json_encode(['res' => $this->Commons_model->update(
				[
					'active_bit' => $this->input->get('status')
				],
				[
					'project_id' => $this->input->get('project_id'),
					'checklist_id' => $this->input->get('clid')
				],
				'tbl_project_records'
			)]);
		} else {
			echo json_encode(['res' => false]);
		}
	}
	
	public function load_dashbaord()
	{
		$count_status_1 = ($this->db->select('COUNT(id) as count')->from('tbl_projects')->where(['status'=> 1,'delete_bit'=>0])->get()->row())->count;
		$count_status_2 = ($this->db->select('COUNT(id) as count')->from('tbl_projects')->where(['status'=> 2,'delete_bit'=>0])->get()->row())->count;
		$count_status_3 = ($this->db->select('COUNT(id) as count')->from('tbl_projects')->where(['status'=> 3,'delete_bit'=>0])->get()->row())->count;
		$uc = $this->db->select('COUNT(id) as count')->from('tbl_projects')->where('const_bit', 1)->get()->row();

		$total = $count_status_1 + $count_status_2 + $count_status_3;
		$completed = ($count_status_1 / $total) * 100;
		$pending = ($count_status_2 / $total) * 100;
		$archived = ($count_status_3 / $total) * 100;
		$under_const = ($uc->count / $total) * 100;

		$categories = ["Complated", "Pending", "Archived", "Under Construction"];
		$values = [
			$count_status_1,
			$count_status_2,
			$count_status_3,
			$uc->count,
		];

		echo json_encode([
			'line' => [
				'categories' => $categories,
				'values' => $values
			],
			'pie' => [
				'colors' => [
					"lightgreen",
					"lightpink",
					"#efa62e",
					"lightblue"
				],
				'categories' => $categories,
				'values' => $values,
			],
			'info' => [
				'Completed' => intval($completed),
				'Pending' => intval($pending),
				'Archived' => intval($archived),
				'Under Construction' => intval($under_const)
			],
			'total' => [
				'total' => $total
			]
		]);
	}


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////PDF  FUNCTIONS /////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function generate_project_pdf($id = null)
	{
		$this->load->library('pdf');
		$project = $this->Commons_model->get_row('tbl_projects', ['id' => $id]);
		$this->pdf->SetCreator('Solution Services');
		$this->pdf->SetAuthor('info@solutionServices.com');
		$this->pdf->SetTitle($project->project_name);
		$this->pdf->SetSubject('Project Completion ' . $project->project_name);
		$this->pdf->AddPage();
		$content = '';
		$this->pdf->writeHTML($content, true, false, true, false, '');
		$this->pdf->Output('my_document.pdf', 'I');
	}

	public function update_list()
	{
		echo json_encode([
			'status' => $this->Commons_model->update([
				'active_bit' => $this->input->post('status') == 1 ? 0 : 1
			], [
				'list_id' => $this->input->post('list_id'),
				'project_id' => $this->input->post('project_id')
			], 'tbl_project_records'),
			'set' => $this->input->post('status') == 1 ? 0 : 1
		]);
	}

	public function upload_list_completion_certificate()
	{
		if ($this->input->method() == 'post') {
			$this->load->library('upload');
			$this->upload->initialize([
				'upload_path' => './Assets/docs/certificates/',
				'allowed_types' => 'pdf',
				'file_name' => 'P_' . $this->input->post('project_id') . '_L_' . $this->input->post('list_id') . '_' . date('dmy')
			]);
			if (!$this->upload->do_upload('file')) {
				echo json_encode(['errors' => $this->upload->display_errors('', '')]);
			} else {
				$upload = $this->upload->data();
				echo json_encode(['status' => $this->Commons_model->insert_with_id([
					'project_id'    => $this->input->post('project_id'),
					'list_id'       => $this->input->post('list_id'),
					'file_name'     => $upload['file_name'],
					'path'          => "./Assets/docs/certificates/"
				], 'tbl_list_certificates')]);
			}
		} else {
			http_response_code(405);
			echo 'Invalid HTTP method.';
		}
	}

	// generate project completion certificate by merging multiple files into one.

	public function gpcc()
	{
		$this->load->library('my_pdf');

		$certificates = $this->Commons_model->get_where_select_orderby(
			'concat(path,"",file_name) as file',
			[
				'project_id' => $this->input->post('pid')
			],
			'tbl_list_certificates as certificate',
			[
				'order_key' => 'list_id',
				'order' => 'ASC'
			]
		);

		echo json_encode([
			'status' => $this->my_pdf->merge_pdf($certificates, $this->input->post('pid'))
		]);
	}

	public function get_list_certificates()
	{
		echo json_encode(['res' => $this->Commons_model->get_where('tbl_list_certificates', [
			'project_id' => $this->input->post('pid')
		])]);
	}

	public function send_project_create_email($pid)
	{
		$project = $this->Commons_model->get_row('tbl_projects', [
			'id' => $pid
		]);

		$template = $this->new_project_email_template($project);

		$this->load->library('phpmailer_lib');
		$res = $this->phpmailer_lib->send_mail(
			$project->contact_email,
			"New Project Creation.",
			$template,
			null,
			json_decode($project->additional_emails),
			null
		);
		return $res;
	}

	public function new_project_email_template($project)
	{
		$temp = '
			<div leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="height:auto !important;width:100% !important; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px;">
				<center>
					<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="max-width:800px; background-color:#ffffff;border:1px solid #e4e2e2;border-collapse:separate !important; border-radius:4px;border-spacing:0;color:#242128; margin:0;padding:40px;" heigth="auto">
						<tbody>
							<tr>
								<td align="left" valign="center" style="padding-bottom:40px;border-top:0;height:100% !important;width:100% !important;">
									<img style="height : 60px; width : 200px;" src="' . base_url('Assets/img/ss-logo.png') . '">
								</td>
								<td align="right" valign="center" style="padding-bottom:40px;border-top:0;height:100% !important;width:100% !important;">
									<span style="color: #8f8f8f; font-weight: normal; line-height: 2; font-size: 14px;">' . date('d.m.y') . '</span>
								</td>
							</tr>
							<tr>
								<td style="padding-top:10px;border-top:1px solid #e4e2e2">
									<p style="color:#8f8f8f; font-size: 14px; padding-bottom: 20px; line-height: 1.4;">
										A Project with Following Details is Created. You can check details by clicking View button Below.
									</p>
									<h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;"> Project Name : ' . ucwords($project->project_name) . '</h3>
									<hr>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>Project Location : </span> <span> ' . ucwords($project->location) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>Project Size M2 : </span> <span> ' . ucwords($project->project_size_m2) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>Company Name : </span> <span> ' . ucwords($project->company_name) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>Company Phone : </span> <span> ' . ucwords($project->phone) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>Company Email : </span> <span> ' . ucwords($project->contact_email) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>Project Owner : </span> <span> ' . ucwords($project->owner) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>M2 of Construction : </span> <span> ' . ucwords($project->construction_m2) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										<span>M2 of land : </span> <span> ' . ucwords($project->land_m2) . '</span>
									</p>
									<p style="background-color:#f1f1f1; padding: 8px 10px; border-radius: 5px; display: flex; justify-content:space-between; margin-bottom:20px; font-size: 20px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">
										Description : <br>
										' . ucwords($project->description) . '
									</p>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse;">
										<tbody>
											<tr>
												<td style="padding:15px 0px;" valign="top" align="center">
													<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate !important;">
														<tbody>
															<tr>
																<td align="center" valign="middle" style="padding:13px;">
																	<a href="' . base_url('State/' . $project->id) . '" title="View" target="_blank" style="font-size: 14px; line-height: 1.5; font-weight: 700; letter-spacing: 1px; padding: 15px 40px; text-align:center; text-decoration:none; color:#FFFFFF; border-radius: 50px; background-color:#145388;">
																		View
																	</a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table style="margin-top:30px; padding-bottom:20px;; margin-bottom: 40px;">
						<tbody>
							<tr>
								<td align="center" valign="center">
									<p style="font-size: 12px; text-decoration: none;line-height: 1; color:#909090; margin-top:0px; ">
										info@solutionServices.com.
									</p>
								</td>
							</tr>
						</tbody>
					</table>
				</center>
			</div>';
		return $temp;
	}
}
