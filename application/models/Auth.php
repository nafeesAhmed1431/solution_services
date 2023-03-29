<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')){
			redirect(base_url('Dashboard'));
		} 
		else{
			$this->load->view('Auth/login_view');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[50]');

		if ($this->form_validation->run() == TRUE) 
		{
			$user = $this->Auth_model->validate_login($this->input->post('username'), $this->input->post('password'));
			if (!empty($user)) 
			{
				if ($user[0]['enable_bit'] == 0) 
				{
					$this->session->set_flashdata('msg', 'Your account is disabled by Admin !!!');
					redirect(base_url());
				} 
				else
				{
					$this->session->set_userdata('id', $user[0]['id']);
					$this->session->set_userdata('username', $user[0]['full_name']);
					$this->session->set_userdata('role_id', $user[0]['role_id']);
					$this->session->set_userdata('img', $user[0]['img']);
					$this->session->set_userdata('bg', $user[0]['bg_img']);
					$this->session->set_userdata('logged_in', TRUE);
					$this->Auth_model->update_last_login($user[0]['id']);
					redirect('Admin');
				}
			} 
			else 
			{
				$this->session->set_flashdata('msg', 'Either Username or Password is Wrong!!!');
				redirect(base_url());
			}
		} 
		else
		{
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
		if(empty($this->input->post())):
			$data['success'] = false;
			$this->load->view('Auth/auth_header');
			$this->load->view('Auth/change_password',$data);
			$this->load->view('Auth/auth_footer');
		else:
			$this->form_validation->set_rules('password','PassWord','required');
			$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run()):
				if($this->input->post('password') != $this->input->post('oldPassword')):
					$res = $this->Auth_model->authenticate_password($this->session->userdata('id'),$this->input->post('oldPassword'));
					if($res):
						$data['password'] = $this->input->post('password');
						$confirm = $this->Auth_model->update_password($this->session->userdata('id'),$data);
						if($confirm):
							$this->session->set_flashdata(['msg'=>'Your Password has been Updated !!!','alert'=>'success']);
							$data['success'] = true;
							$this->load->view('Auth/auth_header');
							$this->load->view('Auth/change_password',$data);
							$this->load->view('Auth/auth_footer');
						else:
							$this->session->set_flashdata(['msg'=>'Password Update Failed Try again later !!!','alert'=>'danger']);
							redirect(base_url('Dashboard'));
						endif;
					else:
						$this->session->set_flashdata('msg','Invalid Old Password !!!');
						$data['success'] = false;
						$this->load->view('Auth/auth_header');
						$this->load->view('Auth/change_password',$data);
						$this->load->view('Auth/auth_footer');
					endif;
				else:
					$this->session->set_flashdata('msg','  Cannot change to same Password !!!');
					$data['success'] = false;
					$this->load->view('Auth/auth_header');
					$this->load->view('Auth/change_password',$data);
					$this->load->view('Auth/auth_footer');
				endif;
			else:
				$data['success'] = false;
				$this->load->view('Auth/auth_header');
				$this->load->view('Auth/change_password',$data);
				$this->load->view('Auth/auth_footer');
			endif;
		endif;
	}

	public function notify_email()
	{
		$pid = $this->Auth_model->details($this->input->get('pid'),'tbl_projects');
		$lid = $this->Auth_model->details($this->input->get('lid'),'tbl_lists');
		$clid = $this->Auth_model->details($this->input->get('clid'),'tbl_checklists');

		$html = "A document with the following details is missing.</br>";
		$html .= "<p><b>Project : </b>".$pid[0]->project_name."</p>";
		$html .= "<p><b>List : </b>".$lid[0]->title."</p>";
		$html .= "<p><b>CheckList: </b>".$clid[0]->title."</p>";

		$em = $this->send_mail($pid[0]->contact_email, "Pending Checklist", $html, "info@solutionServices.com", "Solution Services");

		echo ($em == true)? json_encode(array('status'=>200)) : false ;

	}
	
	public function send_mail($to, $subject, $body, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL, $bcc = NULL) 
	{
		$set = $this->Auth_model->details(1,'tbl_settings')[0];
        $mail = new PHPMailer;
        // $mail->SMTPDebug = 4;
        $mail->CharSet = 'UTF-8';
        try {
            if ($set->protocol == 'mail') {
                $mail->isMail();
            } elseif ($set->protocol == 'sendmail') {
                $mail->isSendmail();
            } elseif ($set->protocol == 'smtp') {
                $mail->isSMTP();
                $mail->Host = $set->smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = $set->smtp_user;
                $mail->Password = $set->smtp_password;
                $mail->SMTPSecure = !empty($set->smtp_crypto) ? $set->smtp_crypto : false;
                $mail->Port = $set->smtp_port;
                // $mail->SMTPDebug = 2;
            } else {
                $mail->isMail();
            }

            if ($from && $from_name) {
                $mail->setFrom($from, $from_name);
                $mail->addReplyTo($from, $from_name);
            } elseif ($from) {
                $mail->setFrom($from, $set->site_name);
                $mail->addReplyTo($from, $set->site_name);
            } else {
                $mail->setFrom($set->default_email, $set->site_name);
                $mail->addReplyTo($set->default_email, $set->site_name);
            }
            $mail->addAddress($to);
            if ($cc) { $mail->addCC($cc); }
            if ($bcc) { $mail->addBCC($bcc); }
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $body;
            if ($attachment) 
			{
                if (is_array($attachment)) {
                    foreach ($attachment as $attach) {
                        $mail->addAttachment($attach);
                    }
                } else {
                    $mail->addAttachment($attachment);
                }
            }

            if ($mail->send()) {
				return TRUE;
            }else{
				// throw new Exception($mail->ErrorInfo);
                return FALSE;
			}
        } catch (Exception $e) {
            throw new \Exception($e->errorMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

?>
