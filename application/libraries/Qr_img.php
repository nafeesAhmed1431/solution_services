<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_img_cls extends CI_Controller {
    public function __construct(){
        parent ::__construct();
        // $this->load->library('session');
        // $this->load->model('Project_model');

    }

    public function generate_qr_img($id = null){
        // print_r('sdfadf');
        // $this->load->library('ciqrcode');
        // $data['project_details'] = $this->Project_model->get_project_details($id);
        // $project_name = $data['project_details'][0]->project_name;
        // header("Content-Type: image/png");
        // $params['data'] 		= base_url('State/') . $id;
        // $params['level'] 		= 'H';
        // $params['savename'] 	= FCPATH . 'qr_code/project_' . $project_name . '.png';
        // // print_r($params/);die;
        // $this->ciqrcode->generate($params);
        // $data['qr_img'] 		= 'project_' . $project_name . '.png';
        // $check 	= $this->Project_model->project_qr_img($data, $id);
        // if ($check) {
        // 	$this->session->set_flashdata('msg', 'User has been Added Successfully !!!');
        // 	redirect(base_url('Users'));
        // }
    }
}