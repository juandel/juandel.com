<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Images_model', 'Works_model'));
		$this->load->helper(array('form','html'));
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

	public function email(){

		if ($_POST['submit_contact']) {
			// Fix for date and time
			date_default_timezone_set('America/Argentina/Buenos_Aires');
			// email config params
			$data['email']=$this->input->post('email');
			$data['name']=$this->input->post('name');
			$data['location']=$this->input->post('location');
			$data['message']=$this->input->post('message');
			$config = array('protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'pixnel11@gmail.com',
						'smtp_pass' => 'gutentag2#'
						);
			// call email library and pass config
			$this->load->library('email', $config);
			// fix for starting an email
			$this->email->set_newline("\r\n");
			// Filling out headers of email and message
			$this->email->from($data['email']);
			$this->email->to('juandel@gmail.com');
			$this->email->subject('jaddel.com- contact form');
			$this->email->message($data['message']."\nCustomer's location: ". $data['location']);

			// Send email and check if it was send 
			if($this->email->send()){
				$data['sent'] = "Your email was sent correctly";		
			}else{
				$data['fail'] = "there was a problem sending the email: ".show_error($this->email->print_debugger());
			}
			$data['head']=$this->top_template();
			$data['footer']=$this->bottom_template();
			$this->load->view('email_confirm', $data);
		}
		
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

