<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends MY_Controller {

	private $head ;
	private $footer;


	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','html'));
		$this->load->model(array('Images_model', 'Works_model'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="background-color:white; border:none">', 
													'</div>');
		$this->head= $this->top_template();
		$this->footer = $this->bottom_template();


	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$this->load->view('create_work',$data);
	}

	public function show_work($id)
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['work'] = $this->Works_model->get_work($id);
		$data['images'] = $this->Images_model->get_image_works($id);
		$this->load->view('show_work', $data);
	}

	public function create_work()
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		if ($this->input->post('submit')) {
			$config['upload_path'] = './img/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']=TRUE;
			$config['max_size']	= '500';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			// send config to upload library which uploads file
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			// Validation Rules
			$config_validation = array(
	               array(
	                     'field'   => 'title', 
	                     'label'   => 'Title', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'description', 
	                     'label'   => 'Description', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'software', 
	                     'label'   => 'Software', 
	                     'rules'   => 'required'
	                  ),   
	               array(
	                     'field'   => 'location', 
	                     'label'   => 'Location', 
	                     'rules'   => 'required'
	                  )
	            );
			$this->form_validation->set_rules($config_validation);
			// echo "<pre>";
			// print_r($_FILES);
			// echo "</pre>";
			// Check to see if validation OR upload failed
			if ($this->form_validation->run() == FALSE){
				
				$this->load->view('create_work', $data);
			}
			else
			{
				// Set title Data
				$data['title']=$this->input->post('title');
				$data['description']=$this->input->post('description');
				$data['software']=$this->input->post('software');
				$data['location']=$this->input->post('location');
				if (!$this->Works_model->check_title_exists($data['title'])) {
					$data['work_id']=$this->Works_model->insert_work($data['title'],$data['description'],$data['software'],$data['location']);
				}

				$files = $_FILES['images'];
				
				foreach ($files['name'] as $key => $value) {
					$_FILES['images']['name'] = $files['name'][$key];
	                $_FILES['images']['type'] = $files['type'][$key];
	                $_FILES['images']['tmp_name'] = $files['tmp_name'][$key];
	                $_FILES['images']['error'] = $files['error'][$key];
	                $_FILES['images']['size'] = $files['size'][$key];
					if (!$this->upload->do_upload('images')) {
						$data['error']= $this->upload->display_errors();
					}else{
						$data['upload_data'] = $this->upload->data();

						// Check to see if image is already in DB. If it's NOT, then Update
						if(!$this->Images_model->check_filename_exists($data['upload_data']['file_name'])){
							$this->Images_model->insert_image($data['upload_data']['file_name'], $data['upload_data']['file_path'],$data['work_id']);
							$data['feedback']['db']= "Image loaded into DB";
						}else{
							$data['error'] = "An image with the same name already exists in DB";
						}
					}	
				}
				// echo "<pre>";
				// print_r($data['upload_data']);
				// echo "</pre>";
				$data['feedback']['submit']="Form submited succesfully";
				$this->load->view('create_work', $data);
			}
		}else{
			$data['feedback']['create']= "Create Work";
			$this->load->view('create_work', $data);
		}
		
		// if (!$this->upload->do_upload())
		// {
		// 	$data['head']=$this->head();
		// 	$data['nav']=$this->nav();
		// 	$data['header']=$this->header();
		// 	$data['footer']=$this->footer();
		// 	$data['scripts']=$this->scripts();
		// 	$data['error']= $this->upload->display_errors();

		// 	$this->load->view('create_work', $data);
		// }
		// else
		// {
			// $data['head']=$this->head();
			// $data['nav']=$this->nav();
			// $data['header']=$this->header();
			// $data['footer']=$this->footer();
			// $data['scripts']=$this->scripts();
			// $data['upload_data'] = $this->upload->data();
			// $data['title']=$this->input->post('title');
			// print_r($data['upload_data']);

			// // Check to see if image is already in DB. If it's NOT, then Update
			// if(!$this->Images_model->check_filename_exists($data['upload_data']['file_name'])){
			// 	$this->Images_model->insert_image($data['upload_data']['file_name'], $data['upload_data']['file_path']);
			// }else{
			// 	$data['error'] = "An image with the same name already exists in DB";
			// }

			// $this->load->view('create_work', $data);
		// }
	}
	function update_work($id=NULL){
		$this->load->helper(array('file'));
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['work_id']=$id;
		
		if ($id) {
			if ($this->input->post('submit')) {
	
				$config['upload_path'] = './img/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite']=TRUE;
				$config['max_size']	= '500';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				// send config to upload library which uploads file
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				// Validation Rules
				$config_validation = array(
	               array(
	                     'field'   => 'title', 
	                     'label'   => 'Title', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'description', 
	                     'label'   => 'Description', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'software', 
	                     'label'   => 'Software', 
	                     'rules'   => 'required'
	                  ),   
	               array(
	                     'field'   => 'location', 
	                     'label'   => 'Location', 
	                     'rules'   => 'required'
	                  )
		        );
				$this->form_validation->set_rules($config_validation);
				// echo "<pre>";
				// print_r($_FILES);
				// echo "</pre>";
				// Check to see if validation OR upload failed
				if ($this->form_validation->run() == FALSE){
					$this->load->view('update_work', $data);
				}else
				{
					// Set title Data
					$data['title']=$this->input->post('title');
					$data['description']=$this->input->post('description');
					$data['software']=$this->input->post('software');
					$data['location']=$this->input->post('location');
					$data['image_radio']=$this->input->post('image_radio[]');
					if (isset($data['image_radio'])) {
						$data['error']['remove_file'] = $this->Images_model->remove_work_id($data['image_radio']);
					}
					
					$this->Works_model->update_work($data['title'],
													$data['description'],
													$data['software'],
													$data['location'],
													$id);
				}
				$files = $_FILES['images'];
				
				foreach ($files['name'] as $key => $value) {
					$_FILES['images']['name'] = $files['name'][$key];
	                $_FILES['images']['type'] = $files['type'][$key];
	                $_FILES['images']['tmp_name'] = $files['tmp_name'][$key];
	                $_FILES['images']['error'] = $files['error'][$key];
	                $_FILES['images']['size'] = $files['size'][$key];
					if (!$this->upload->do_upload('images')) {
						$data['error']['upload_file']= $this->upload->display_errors();
					}else{
						$data['upload_data'] = $this->upload->data();

						// Check to see if image is already in DB. If it's NOT, then Update
						if(!$this->Images_model->check_filename_exists($data['upload_data']['file_name'])){
							$this->Images_model->insert_image($data['upload_data']['file_name'], $data['upload_data']['file_path'],$data['work_id']);
							$data['feedback']['db']= "Image loaded into DB";
						}else{
							$data['error']['db'] = "An image with the same name already exists in DB";
						}
					}	
				}
			}
			$data['work'] = $this->Works_model->get_work($id);
			$data['images'] = $this->Images_model->get_image_works($id);
		}else{
			$data['error']['no_update'] = "<p> No work selected to update</p>";
		}

		$this->load->view('update_work', $data);
	}

	public function delete_work($id=NULL)
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['work_id']=$id;

		if (isset($id)) {
			$data['images'] = $this->Images_model->get_image_works($id);
			print_r($data['images']);
			
			if($this->Works_model->delete_works($id)){
				$data['confirm'] = "Work was Deleted from works table";
				
				if ($this->Images_model->delete_images($id)) {
					$data['confirm'] = "Work was Deleted from images table and works table";
					
					foreach ($data['images'] as $image) {
						$filename = "./img/uploads/".$image['name'];
			            if (is_file($filename)) {
			                @unlink($filename);
			                $data['error']['not_deleted'] = "the file was deleted succesfully";
			            }else{
			                $data['error']['not_deleted'] = "the filename: ".$filename." is not a file. Can't erase";
			            }
					}

				}else{
					$data['confirm'] = "Could not delete images of work from images table but could delete from works.";
				}

			}else{
				$data['confirm'] = "Could not delete work from works table. Something went wrong";
			}
			
		}else{
			$data['error']['no_id'] = "No ID for work to delete";
		}
		

		$this->load->view('delete_work', $data);
	}
}