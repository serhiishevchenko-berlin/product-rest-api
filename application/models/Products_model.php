<?php
/**
 * REST API  model 
 *
 * Description: REST API  model for products
 *
 * @author	Serhii Shevchenko 
 * @email	ssh.vlad@gmail.com
 * @since	Version 0.0.1
 * @filesource Prod_model.php
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_Model extends CI_Model {

    private $products;
    private $product_prices;

    public function __construct() 
    {
        $params = array('path_products' => $this->config->item('products_data'), 'path_prices' => $this->config->item('prices_data'));
        $this->load->library('productloader',$params);
        $this->products = $this->productloader->load_products();
        $this->product_prices = $this->productloader->load_prices();
    }

    public function get_price($data, $id) 
    {
        $prices = [];
        $result = [];

        $imax = count($data);
        $n = 0;
        for($i=0; $i<$imax; $i++){
            if($id == $data[$i]->id){
                $prices['value'] = $data[$i]->price->value;
                $prices['currency'] = $data[$i]->price->currency;
                $prices['unit'] = $data[$i]->unit;
                $result[$n] = $prices;
                $n++;
            }
        }
        return $result;
    }

    public function get_all_products() 
    {
        $products = [];
        $i = 0;
        foreach($this->products as $product){
            $products[$i] = $product;
            $i++;
        }
        return $products;
    }

    public function get_product($id) 
    {
        if (!isset($this->products[$id])) {
            return null;
        }
        $product =  $this->products[$id];
        $prices = $this->get_prices_for_product_with_filter($product);

        $product['prices'] = $prices;

        return $product;
    }

    public function get_product_prices($id, $unit=null) 
    {
        $product = $this->get_product($id);
        
        return $this->get_prices_for_product_with_filter($product, $unit);
    }

    private function get_prices_for_product_with_filter($product, $unit=null)
    {
        $prices = [];

        foreach ($this->product_prices as $product_price) {
            if ($product['sku'] == $product_price['id']) {
              if ($unit == $product_price['unit']) {
                 $prices[] = $product_price;
                 break;
              } else if($unit == null) {
                 $prices[] = $product_price;
              }
            } 
         }

         return $prices;
    }
    
}