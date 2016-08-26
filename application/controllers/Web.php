<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Images_model', 'Works_model', 'Team_model'));
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
		// Core - MY_Controller-Father Class
		
		$lang=$this->session->set_userdata($this->input->get(NULL, TRUE));
		// print_r($this->session->userdata('lang'));
		if ($this->session->userdata('lang') == 'sp') {
			$this->lang->load('main_lang', 'spanish');
		}else{
			$this->lang->load('main_lang', 'english');
		}
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
			$this->load->library('form_validation');
			// Validation Rules
			$config_validation = array(
	               array(
	                     'field'   => 'email', 
	                     'label'   => 'Email', 
	                     'rules'   => 'trim|required|valid_email'
	                  ),
	               array(
	                     'field'   => 'name', 
	                     'label'   => 'Name', 
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'location', 
	                     'label'   => 'Location', 
	                     'rules'   => 'trim|required'
	                  ),   
	               array(
	                     'field'   => 'message', 
	                     'label'   => 'Message', 
	                     'rules'   => 'required'
	                  )
	        );

			$this->form_validation->set_rules($config_validation);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="background:none; border:none" >', '</div>');
			// Check to see if validation OR upload failed
			if ($this->form_validation->run() == FALSE){
				
				$this->index();
			}
			else{
				// Fix for date and time
				date_default_timezone_set('America/Argentina/Buenos_Aires');
				// Get data from Form
				$data['email']=$this->input->post('email');
				$data['name']=$this->input->post('name');
				$data['location']=$this->input->post('location');
				$data['message']=$this->input->post('message');
				// Update client data to DB
				$this->load->model('Clients_model');
				$this->Clients_model->set_client($data['email'],$data['name'], $data['location']);
				
				// Email config

				    // $this->load->library('email');
				    
				// Mandrill

				    $this->load->config('mandrill');

					$this->load->library('mandrill');

					$mandrill_ready = NULL;

				try {

					$this->mandrill->init( $this->config->item('mandrill_api_key') );
					$mandrill_ready = TRUE;
					
				} catch(Mandrill_Exception $e) {

					$mandrill_ready = FALSE;
					
				}

				if( $mandrill_ready ) {

					//Send us some email!
					$email = array(
						'html' => '<h2>Message:</h2><p>'.$data['message']."</p><br><h4>Customer's location: ". $data['location'].'<h5>'."<br><h4>Customer's email: ". $data['email'].'<h5>', //Consider using a view file
						'text' => $data['message']."Customer's location: ". $data['location']." Customer's email: ".$data['email'],
						'subject' => 'Jaddel.com - Contact form',
						'from_email' => 'contact@jaddel.com',
						'from_name' => $data['name'],
						'to' => array(array('email' => 'juandel@gmail.com' )) //Check documentation for more details on this one
						//'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
						);

					$result = $this->mandrill->messages_send($email);
					
				}
				   
				    if($result){
					$data['sent'] = "Your email was sent correctly";		
					}else{
					$data['fail'] = "there was a problem sending the email: ".show_error($this->email->print_debugger());
					}	
			
				
				// email config params
				// $config = array('protocol' => 'smtp',
				// 			'smtp_host' => 'smtp.mandrillapp.com',
				// 			'smtp_port' => 2525,
				// 			'smtp_user' => 'social@jaddel.com',
				// 			'smtp_pass' => 'GVNAGR1NFAzbReB3M9Pjlw'
				// 			);
				
				// call email library and pass config
				// $this->load->library('email', $config);
				// fix for starting an email
				// $this->email->set_newline("\r\n");
				// Filling out headers of email and message
				// $this->email->from($data['email']);
				// $this->email->to('juandel@gmail.com');
				// $this->email->subject('jaddel.com- contact form');
				// $this->email->message($data['message']."\nCustomer's location: ". $data['location']);

				// Send email and check if it was send 
				// if($this->email->send()){
				// 	$data['sent'] = "Your email was sent correctly";		
				// }else{
				// 	$data['fail'] = "there was a problem sending the email: ".show_error($this->email->print_debugger());
				// }	
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
		// print_r(count($images));
		$images_names = array();
		
		foreach ($images as $value) {
			$images_names[] = $value['name'];		
		}

		$data['images']= $images_names;
		return $this->load->view('sec_header',$data, TRUE);
	}
	
	private function services()
	{
		// Get language text
		$data['sec_serv_title_01'] = $this->lang->line('sec_serv_title_01');
		$data['sec_serv_subtitle'] = $this->lang->line('sec_serv_subtitle');
		$data['descr_serv_subtitle_01'] = $this->lang->line('descr_serv_subtitle_01');
		$data['descr_serv_01'] = $this->lang->line('descr_serv_01');
		$data['descr_serv_subtitle_02'] = $this->lang->line('descr_serv_subtitle_02');
		$data['descr_serv_02'] = $this->lang->line('descr_serv_02');
		$data['descr_serv_subtitle_03'] = $this->lang->line('descr_serv_subtitle_03');
		$data['descr_serv_03'] = $this->lang->line('descr_serv_03');

		return $this->load->view('sec_services',$data, TRUE);
	}

	private function portfolio()
	{	
		// Get language text
		$data['sec_port_title_01'] = $this->lang->line('sec_port_title_01');
		$data['sec_port_subtitle'] = $this->lang->line('sec_port_subtitle');

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
		$data['sec_wf_title_01'] = $this->lang->line('sec_wf_title_01');
		$data['sec_wf_subtitle'] = $this->lang->line('sec_wf_subtitle');
		$data['descr_wf_heading_01'] = $this->lang->line('descr_wf_heading_01');
		$data['descr_wf_01'] = $this->lang->line('descr_wf_01');
		$data['descr_wf_heading_02'] = $this->lang->line('descr_wf_heading_02');
		$data['descr_wf_02'] = $this->lang->line('descr_wf_02');
		$data['descr_wf_heading_03'] = $this->lang->line('descr_wf_heading_02');
		$data['descr_wf_03'] = $this->lang->line('descr_wf_03');
		$data['descr_wf_heading_04'] = $this->lang->line('descr_wf_heading_02');
		$data['descr_wf_04'] = $this->lang->line('descr_wf_04');
		$data['footer_wf'] = $this->lang->line('footer_wf');

		return $this->load->view('sec_about',$data,TRUE);
	}

	private function team()
	{
		$data['sec_team_title_01'] = $this->lang->line('sec_team_title_01');
		$data['sec_team_subtitle'] = $this->lang->line('sec_team_subtitle');

		$data['team_members'] = $this->Team_model->get_team_members();
		return $this->load->view('sec_team',$data,TRUE);
	}

	public function add_team_member(){
		$data['head']=$this->top_template();
		$data['footer']=$this->bottom_template();
		
		if (isset($_POST['submit_team_member'])){
			// Get data from Form
			$data['name']=$this->input->post('name');
			$data['position']=$this->input->post('position');
			$data['facebook']=$this->input->post('facebook');
			$data['linkedin']=$this->input->post('linkedin');

			
			$this->load->library('image_lib');

			// Set config for file upload
			$config['upload_path'] = './img/team/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']=TRUE;
			$config['max_size']	= '800';
			$config['max_width']  = '225';
			$config['max_height']  = '225';

			// Load upload Library
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image_path'))
                {
                        $data['error'] = $this->upload->display_errors();

                        $this->load->view('add_team_member', $data);                }
                else
                {
                        $data['upload_data'] = $this->upload->data();
                        $data['image_path'] = $data['upload_data']['file_name'];  
                }

                $this->Team_model->add_team_member($data['name'], $data['position'], $data['facebook'], $data['linkedin'], $data['image_path']);

                $this->load->view('add_team_member', $data);
		}else{
			$this->load->view('add_team_member', $data);
		}
	}

	public function update_member($id){
		$data['head']=$this->top_template();
		$data['footer']=$this->bottom_template();

		$data['team_member'] = $this->Team_model->get_team_member($id);

		if (isset($_POST['submit_team_member_edit'])){
			// Get data from Form
			$data['name']=$this->input->post('name');
			$data['position']=$this->input->post('position');
			$data['facebook']=$this->input->post('facebook');
			$data['linkedin']=$this->input->post('linkedin');

			
			$this->load->library('image_lib');

			// Set config for file upload
			$config['upload_path'] = './img/team/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']=TRUE;
			$config['max_size']	= '800';
			$config['max_width']  = '225';
			$config['max_height']  = '225';

			// Load upload Library
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image_path')){
                        $data['error'] = $this->upload->display_errors();
                        $data['image_path'] = $data['team_member']['image_path'];
                        $this->load->view('update_team_member', $data);                }
            else
            {
                    $data['upload_data'] = $this->upload->data();
                    $data['image_path'] = $data['upload_data']['file_name'];  
            }

            $this->Team_model->update_team_member($data['name'], $data['position'], $data['facebook'], $data['linkedin'], $data['image_path'], $id );
            
            $this->load->view('update_team_member', $data);
		}else{
			$this->load->view('update_team_member', $data);
		}
	}

	private function clients()
	{
		return $this->load->view('sec_clients',NULL,TRUE);
	}


	private function contact()
	{
		
		$data['sec_contact_title_01'] = $this->lang->line('sec_contact_title_01');
		$data['sec_contact_subtitle'] = $this->lang->line('sec_contact_subtitle');
		$data['sec_contact_name'] = $this->lang->line('sec_contact_name');
		$data['sec_contact_email'] = $this->lang->line('sec_contact_email');
		$data['sec_contact_location'] = $this->lang->line('sec_contact_location');
		$data['sec_contact_comment'] = $this->lang->line('sec_contact_comment');
		$data['sec_contact_submit'] = $this->lang->line('sec_contact_submit');		
		$data['sec_contact_footer'] = $this->lang->line('sec_contact_footer');

		return $this->load->view('sec_contact',$data,TRUE);
	}


}

