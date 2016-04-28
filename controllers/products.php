<?php
class Products extends Controller{
	protected function Index(){
		$viewmodel = new ProductModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function add(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'products');
		}
		$viewmodel = new ProductModel();
		$this->returnView($viewmodel->add(), true);
	}
}