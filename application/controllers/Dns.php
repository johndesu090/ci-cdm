<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dns extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		require_once APPPATH . 'third_party/CloudFlare/Autoloader.php';
	}

	public function index()
	{
		if (!empty($this->input->get('name')) and !empty($this->input->get('content'))) {
				$name=$this->input->get('name');
				$content=$this->input->get('content');
				$zoneid = "d32277ecaaddc0da420885a0f85908c9";
				$dns = new Cloudflare\Zone\Dns('exodia090@gmail.com', '60a16923235a0556c48b037fcd33b39a0d0dfy');
				$response=$dns->create($zoneid, 'A', $this->input->get('name') . ".dnsford.ml", $this->input->get('content'), 1);
			if ($response) {
					echo "<div class='alert alert-success alert-dismissable'>Your hostname <b> $name.dnsford.ml</b> is now online!</div>";
				}else{
					echo "<div class='alert alert-danger alert-dismissable'>Your hostname <b>  $name.dnsford.ml</b> could not be created!</div>";
			}
		} 
		$this->load->view('dns');
	}


}
