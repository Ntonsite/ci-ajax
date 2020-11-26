<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->load->model('data');
	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function insert(){
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if ($this->form_validation->run() == FALSE)
			{
				$data = array(
					'response'=>'error',
					'message'=>validation_errors()
				);
			}
			else
			{
				$ajax_data = $this->input->post();

				if($this->data->insert_entry($ajax_data)){
					$data = array(
						'response'=>'success',
						'message'=> 'Data Submitted successfully'
					);
				}else{
					$data = array(
						'response'=>'error',
						'message'=> 'Failed'
					);
				}
			}

			echo json_encode($data);
		}
		else{
			echo "No direct script access allowed";
		}
	}
}
