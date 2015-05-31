<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Images_model', 'Works_model'));
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
		$data['head']=$this->top_template();
		$data['footer']=$this->bottom_template();
		$data['header']=$this->header();
		$data['services']=$this->services();
		$data['portfolio']=$this->portfolio();
		$data['about']=$this->about();
		$data['team']=$this->team();
		$data['clients']=$this->clients();
		$data['contact']=$this->contact();
	
		$this->load->view('view_main',$data);
	}

	private function header()
	{	
		$this->load->helper('html');
		$images= $this->Images_model->get_image_names();
		$images_names = array();
		$e =0;
		foreach ($images as $value) {
			$images_names[] = $value;	
			$e++;	
		}
			$data['images']= $images_names;
		return $this->load->view('sec_header',$data, TRUE);

	}
	
	private function services()
	{
		return $this->load->view('sec_services',NULL, TRUE);
	}

	private function portfolio()
	{	
		// Get all works
		$data['in_works'] = $this->Works_model->get_works();
		// Get images from DB where work_id equals works id

		foreach ($data['in_works'] as $key) {
			$images = array();
			$images[] = ($this->Images_model->get_image_works($key['id']));
			
			// For each work image brought from DB add to array  
			foreach ($images as $image) {
				$key['images']=$image;
			}
			// add array of images to global array of works ($data )
			$data['works'][]=$key;
		}
		return $this->load->view('sec_portfolio',$data, TRUE);
	}

	private function about()
	{
		return $this->load->view('sec_about',NULL,TRUE);
	}

	private function team()
	{
		return $this->load->view('sec_team',NULL,TRUE);
	}

	private function clients()
	{
		return $this->load->view('sec_clients',NULL,TRUE);
	}


	private function contact()
	{
		return $this->load->view('sec_contact',NULL,TRUE);
	}


}

