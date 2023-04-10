<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Project_model');
	}

	public function index()
	{
		$this->load->view('Front/project_info');
	}

	public function load_front($data)
	{
		$this->load->view('Front/front_header');
		$this->load->view('Front/front_navbar');
		// $this->load->view('Front/project_info',$data);
		$this->load->view('Front/project_info_v2',$data);
		$this->load->view('Front/front_footer');
	}

	public function project_info($id = "")
	{
		if(empty($id))
		{
			$data['load_data'] = false ;
			$data['page_text'] = "Los detalles de su proyecto se mostrarán aquí";
			$this->load_front($data);
		}
		else
		{
			$id = preg_replace('/[^0-9]/', '', $id);
			$this->load_project_info($id);
		}
	}

	public function load_project_info($id)
	{
		$data['project'] = $this->Project_model->search_where('tbl_projects','id',$id);

		if(!empty($data['project']))
		{
			$data['load_data'] = true ;
			$data['pageHeading'] 	= 'Detalles del proyecto';
			$data['lists'] = $this->Project_model->get_lists_with_checklists($id);
			$data['list_count'] = count($data['lists']);
			$data['documents'] = $this->Project_model->get_project_documents($data['project'][0]->id);
			$this->load_front($data);
		}
		else
		{
			$data['load_data'] = false ;
			$data['page_text'] = "No se encontró ningún proyecto contra [ ID:".$id." ]. Prueba con otro ID de proyecto";
			$this->load_front($data);
		}
	}
}

?>
