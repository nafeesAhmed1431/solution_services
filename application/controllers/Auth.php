<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library([
			'form_validation',
			'phpmailer_lib'
		]);
		$this->load->model([
			'Auth_model',
			'Admin_model',
			'Project_model',
			'Commons_model'
		]);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect(base_url('Dashboard'));
		} else {
			$this->load->view('Auth/login_view');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[50]');

		if ($this->form_validation->run() == TRUE) {
			$user = $this->Auth_model->validate_login($this->input->post('username'), $this->input->post('password'));
			if (!empty($user)) {
				if ($user[0]['enable_bit'] == 0) {
					$this->session->set_flashdata('msg', 'Your account is disabled by Admin !!!');
					redirect(base_url());
				} else {
					$this->session->set_userdata('id', $user[0]['id']);
					$this->session->set_userdata('username', $user[0]['full_name']);
					$this->session->set_userdata('role_id', $user[0]['role_id']);
					$this->session->set_userdata('img', $user[0]['img']);
					$this->session->set_userdata('bg', $user[0]['bg_img']);
					$this->session->set_userdata('logged_in', TRUE);
					$this->session->set_userdata('theme', $user[0]['user_theme']);
					$this->Auth_model->update_last_login($user[0]['id']);
					redirect('Admin');
				}
			} else {
				$this->session->set_flashdata('msg', 'Either Username or Password is Wrong!!!');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('msg', 'Form Validation error!!!');
			redirect(base_url());
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('logged_in');
		redirect(base_url());
	}

	public function change_password()
	{
		if (empty($this->input->post())) :
			$data['success'] = false;
			$this->load->view('Auth/auth_header');
			$this->load->view('Auth/change_password', $data);
			$this->load->view('Auth/auth_footer');
		else :
			$this->form_validation->set_rules('password', 'PassWord', 'required');
			$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');
			if ($this->form_validation->run()) :
				if ($this->input->post('password') != $this->input->post('oldPassword')) :
					$res = $this->Auth_model->authenticate_password($this->session->userdata('id'), $this->input->post('oldPassword'));
					if ($res) :
						$data['password'] = $this->input->post('password');
						$confirm = $this->Auth_model->update_password($this->session->userdata('id'), $data);
						if ($confirm) :
							$this->session->set_flashdata(['msg' => 'Your Password has been Updated !!!', 'alert' => 'success']);
							$data['success'] = true;
							$this->load->view('Auth/auth_header');
							$this->load->view('Auth/change_password', $data);
							$this->load->view('Auth/auth_footer');
						else :
							$this->session->set_flashdata(['msg' => 'Password Update Failed Try again later !!!', 'alert' => 'danger']);
							redirect(base_url('Dashboard'));
						endif;
					else :
						$this->session->set_flashdata('msg', 'Invalid Old Password !!!');
						$data['success'] = false;
						$this->load->view('Auth/auth_header');
						$this->load->view('Auth/change_password', $data);
						$this->load->view('Auth/auth_footer');
					endif;
				else :
					$this->session->set_flashdata('msg', '  Cannot change to same Password !!!');
					$data['success'] = false;
					$this->load->view('Auth/auth_header');
					$this->load->view('Auth/change_password', $data);
					$this->load->view('Auth/auth_footer');
				endif;
			else :
				$data['success'] = false;
				$this->load->view('Auth/auth_header');
				$this->load->view('Auth/change_password', $data);
				$this->load->view('Auth/auth_footer');
			endif;
		endif;
	}

	public function checklist_notify_email()
	{
		$project = $this->Commons_model->get_row('tbl_projects',['id' => $this->input->get('pid') ]);
		$checklist = $this->Commons_model->get_row('tbl_checklists',['id' => $this->input->get('clid') ]);
		$process = $this->Commons_model->get_row('tbl_process',['id' => $checklist->process_id ]);
		$list = $this->Commons_model->get_row('tbl_lists',['id' => $process->list_id ]);

		$html = "Usted tiene un documento pendiente de entrega con la siguiente informacion:.</br>";
		$html .= "<p><b>Proyecto : </b>" . $project->project_name . "</p>";
		$html .= "<p><b>Entidad : </b>" . $list->title . "</p>";
		$html .= "<p><b>Processo : </b>" . $process->title . "</p>";
		$html .= "<p><b>Documento: </b>" . $checklist->title . "</p>";
		$html .= "Favor remitir dicho documento a la mayor brevedad posible.";

		$em = $this->phpmailer_lib->send_mail($project->contact_email, "Documento Pendiente", $html, null, json_decode($project->additional_emails), $bcc = null);
		echo $em ? json_encode(array('status' => 200)) : false;
	}

	public function new_project_email($id)
	{
		$this->load->helper('qr_img');
		$res = generate_qr_img($id);
		$Subject = "Nuevo proyecto";
		$pro = $this->Project_model->get_project_details($id);
		$html = "<h3>Solution Services</h3></br>Su nuevo proyecto ha sido creado con exito!</br>";
		$html .= "<p>Puede dar seguimiento en el siguiente enlace <a style='color:red;' href=" . base_url('State/') . $id . ">VER AVANCES</a></p>";
		$html .= "<p>-------------------O-------------------</p>";
		$html .= "<p>Escanee el QR que se muestra en la imagen:</p>";
		$html .= "<img src=" . base_url('qr_code/') . $pro[0]->qr_img . ">";
		$em = $this->phpmailer_lib->send_mail($pro[0]->contact_email, $Subject, $html, null, null, null);
		return  $em ? redirect(base_url('Projects')) : redirect(base_url('Dashboard'));
	}

	public function notify_list()
	{
		$project = $this->Commons_model->get_row('tbl_projects', [
			'id' => $this->input->get('pid')
		]);

		$em = $this->phpmailer_lib->send_mail(
			$project->contact_email,
			"Documento Pendiente",
			$this->email_pending_list_template($project, $this->Project_model->get_notification_list_items($this->input->get())),
			null,
			json_decode($project->additional_emails),
			null
		);

		echo $em ? json_encode(array('status' => 200)) : false;
	}

	public function email_pending_list_template($project, $data)
	{
		$temp = '
				<div leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="height:auto !important;width:100% !important; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px;">
					<center>
						<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="max-width:600px; background-color:#ffffff;border:1px solid #e4e2e2;border-collapse:separate !important; border-radius:4px;border-spacing:0;color:#242128; margin:0;padding:40px;" heigth="auto">
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
									<td colspan="2" style="padding-top:10px;border-top:1px solid #e4e2e2">
										<h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;">' . ucwords($project->project_name) . '</h3>
										<p style="color:#8f8f8f; font-size: 14px; padding-bottom: 20px; line-height: 1.4;">
											Following Documents of Project are Pending. Kindly make it sure to Submit ASAP.
										</p>
										<h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;">Pending Documents</h3>';
		foreach ($data as $key => $list) {
			$temp .= '<p style="background-color:#f1f1f1; padding: 8px 15px; border-radius: 50px; display: inline-block; margin-bottom:20px; font-size: 14px;  line-height: 1.4; font-family: Courier New, Courier, monospace; margin-top:0">' . ($key + 1) . ' : ' . $list->checklist_title . '</p><br>';
		}
		$temp .= '</td>
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
																		<a href="' . base_url('State/' . $project->id) . '" title="View" target="_blank" style="font-size: 14px; line-height: 1.5; font-weight: 700; letter-spacing: 1px; padding: 15px 40px; text-align:center; text-decoration:none; color:#FFFFFF; border-radius: 50px; background-color:#145388;">View List</a>
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
