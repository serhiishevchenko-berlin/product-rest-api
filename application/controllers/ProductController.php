<?php
/**
 * REST API
 *
 * Description: REST API for products
 *
 * @author	Serhii Shevchenko
 * @email	ssh.vlad@gmail.com
 * @since	Version 0.0.1
 * @filesource ProductController.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// load config files
		$this->config->load('app_config');

		// load  model
		$this->load->model('products_model', 'pm');

	}

    public function get_all_products() {
        $res = $this->pm->get_all_products();
        $response = json_encode($res);
        $this->send_response($response);
    }

    public function get_one_product($id){
        $res = $this->pm->get_product($id);
        $response = json_encode($res);
        $this->send_response($response);
    }

    public function get_product_prices($id){
        $unit = $this->input->get('unit');
        $res = $this->pm->get_product_prices($id, $unit);
        $response = json_encode($res);
        $this->send_response($response);
    }

    private function send_response($response){
        $this->output->set_header('HTTP/1.1 200 OK');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
}
