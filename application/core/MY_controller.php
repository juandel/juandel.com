<?php 

class MY_Controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
        }

    public function top_template()
    {
    	$data['head'] = $this->head();
    	$data['nav'] = $this->nav();
    	return $data;	
    }
     public function bottom_template()
    {
    	$data['footer'] = $this->footer();
    	$data['scripts'] = $this->scripts();
    	return $data;	
    }

    private function head()
	{
		return $this->load->view('sec_head',NULL,TRUE);
	}

	private function nav()
	{  
        $data['link01']=$this->lang->line('link_01');
        $data['link02']=$this->lang->line('link_02');
        $data['link03']=$this->lang->line('link_03');
        $data['link04']=$this->lang->line('link_04');
        $data['link05']=$this->lang->line('link_05');

		return $this->load->view('sec_nav',$data, TRUE);
	}

	private function footer()
	{
		return $this->load->view('sec_footer',NULL,TRUE);
	}

	private function scripts()
	{
		return $this->load->view('sec_scripts',NULL,TRUE);
	}

}

?>