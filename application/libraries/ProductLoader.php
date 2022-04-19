<?php
/**
 * Data loader
 *
 * Description: Loads data for model
 *
 * @author	Serhii Shevchenko 
 * @email	ssh.vlad@gmail.com
 * @since	Version 0.0.1
 * @filesource ProductLoader.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductLoader {

	private $path_products;
	private $path_prices;

	public function __construct($params)
        {
            $this->path_products = $params['path_products'];
			$this->path_prices = $params['path_prices'];
        }

	public function load_products()
	{
		$products = new DOMDocument;
		$products->load($this->path_products);
		return $this->get_products_data($products);
	}

	public function load_prices() 
	{
		$json_str = file_get_contents($this->path_prices);
		$product_prices = json_decode($json_str,true);
		return $product_prices;
	}

	private function get_products_data($dom) 
    {
        $result = [];
        $one_product = [];
        $products = $dom->getElementsByTagName('Product');
        foreach ($products as $product) {
            $one_product['name'] = $product->getElementsByTagName('Name')->item(0)->nodeValue;
            $one_product['description'] = $product->getElementsByTagName('Description')->item(0)->nodeValue;
            $one_product['sku'] = $product->getElementsByTagName('sku')->item(0)->nodeValue;
            $one_product['id'] = $product->getAttribute('id');
            $result[$product->getAttribute('id')] = $one_product;
        }
        return $result;
    }
}