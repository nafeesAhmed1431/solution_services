<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		$this->load->model('Auth_model');
		$this->load->model('Admin_model');
		$this->load->model('Project_model');
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

	public function notify_email()
	{
		$pid = $this->Auth_model->details($this->input->get('pid'), 'tbl_projects');
		$lid = $this->Auth_model->details($this->input->get('lid'), 'tbl_lists');
		$clid = $this->Auth_model->details($this->input->get('clid'), 'tbl_checklists');

		$html = "Usted tiene un documento pendiente de entrega con la siguiente informacion:.</br>";
		$html .= "<p><b>Proyecto : </b>" . $pid[0]->project_name . "</p>";
		$html .= "<p><b>Entidad : </b>" . $lid[0]->title . "</p>";
		$html .= "<p><b>Documento: </b>" . $clid[0]->title . "</p>";
		$html .= "Favor remitir dicho documento a la mayor brevedad posible.";

		$em = $this->send_mail(
			$pid[0]->contact_email,
			"Documento Pendiente",
			$html,
			"info@dtss.miapprd.com",
			"Solution Services",
			null,
			json_decode($pid[0]->additional_emails)
		);
		echo ($em == true) ? json_encode(array('status' => 200)) : false;
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
		$em = $this->send_mail($pro[0]->contact_email, $Subject, $html, "info@solutionServices.com", "Solution Services");
		return  $em ? redirect(base_url('Projects')) : redirect(base_url('Dashboard'));
	}

	// public function send_mail($to, $subject, $body, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL, $bcc = NULL) {
	//     $this->load->library('phpmailer_lib');
	//     $mail = $this->phpmailer_lib->load();
	// 	$set = $this->Auth_model->details(1,'tbl_settings')[0];
	//     $mail->CharSet = 'UTF-8';
	//     try {
	//         if ($set->protocol == 'mail') {
	//             $mail->isMail();
	//         } elseif ($set->protocol == 'sendmail') {
	//             $mail->isSendmail();
	//         } elseif ($set->protocol == 'smtp') {
	//             $mail->isSMTP();
	//             $mail->Host = $set->smtp_host;
	//             $mail->SMTPAuth = true;
	//             $mail->Username = $set->smtp_user;
	//             $mail->Password = $set->smtp_password;
	//             $mail->SMTPSecure = !empty($set->smtp_crypto) ? $set->smtp_crypto : false;
	//             $mail->Port = $set->smtp_port;
	//         } else {
	//             $mail->isMail();
	//         }

	//         if ($from && $from_name) {
	//             $mail->setFrom($from, $from_name);
	//             $mail->addReplyTo($from, $from_name);
	//         } elseif ($from) {
	//             $mail->setFrom($from, $set->site_name);
	//             $mail->addReplyTo($from, $set->site_name);
	//         } else {
	//             $mail->setFrom($set->default_email, $set->site_name);
	//             $mail->addReplyTo($set->default_email, $set->site_name);
	//         }
	//         $mail->addAddress($to);
	//         if ($cc !== NULL) { 
	// 			foreach ($cc as $email) {
	// 				$mail->addCC($email);
	// 			}
	// 		}
	// 		if ($bcc !== NULL) { 
	// 			foreach ($bcc as $email) {
	// 				$mail->addBCC($email);
	// 			}
	// 		}
	//         $mail->Subject = $subject;
	//         $mail->isHTML(true);
	//         $mail->Body = $body;
	//         if ($attachment) {
	//             if (is_array($attachment)) {
	//                 foreach ($attachment as $attach) {
	//                     $mail->addAttachment($attach);
	//                 }
	//             } else {
	//                 $mail->addAttachment($attachment);
	//             }
	//         }

	// 		return $mail->send();

	//     } catch (Exception $e) {
	// 		throw new \Exception($e->getMessage());
	//     } catch (\Exception $e) {
	//         throw new \Exception($e->getMessage());
	//     }
	// }

	public function send_mail(
		$to,
		$subject,
		$body,
		$from = NULL,
		$from_name = NULL,
		$attachment = NULL,
		$cc = [],
		$bcc = []
	) {
		$this->load->library('phpmailer_lib');
		$mail = $this->phpmailer_lib->load();
		$set = $this->Auth_model->details(1, 'tbl_settings')[0];
		$mail->CharSet = 'UTF-8';
		if ($set->protocol == 'smtp') {
			$mail->isSMTP();
			$mail->Host = $set->smtp_host;
			$mail->SMTPAuth = true;
			$mail->Username = $set->smtp_user;
			$mail->Password = $set->smtp_password;
			$mail->SMTPSecure = $set->smtp_crypto ?? false;
			$mail->Port = $set->smtp_port;
		} else {
			$mail->isMail();
		}
		$from = $from ?? $set->default_email;
		$from_name = $from_name ?? $set->site_name;
		$mail->setFrom($from, $from_name);
		$mail->addReplyTo($from, $from_name);
		$mail->addAddress($to);

		foreach ($cc as $email) {
			$mail->addCC($email);
		}
		foreach ($bcc as $email) {
			$mail->addBCC($email);
		}

		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $body;
		if ($attachment) {
			if (is_array($attachment)) {
				foreach ($attachment as $attach) {
					$mail->addAttachment($attach);
				}
			} else {
				$mail->addAttachment($attachment);
			}
		}

		return $mail->send();
	}
}
