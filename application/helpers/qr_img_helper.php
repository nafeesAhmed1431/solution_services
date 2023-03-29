<?php
    function generate_qr_img($id = null){
        $CI = get_instance();
        $CI->load->model('Project_model');
        $CI->load->library('ciqrcode');
        $data['project_details'] = $CI->Project_model->get_project_details($id);
        $project_name = $data['project_details'][0]->project_name;
        // header("Content-Type: image/png");
        $params['data'] 		= base_url('State/') . $id;
        $params['level'] 		= 'H';
        $params['savename'] 	= FCPATH . 'qr_code/project_'.str_replace([' ','-','/','|'],'_',$project_name).'.png';
        $CI->ciqrcode->generate($params);
        $arr['qr_img'] 		= 'project_'.str_replace([' ','-','/','|'],'_',$project_name).'.png';
        $check 	= $CI->Project_model->project_qr_img($arr, $id);
        
        return $check ? true : false;
        
    }
?>