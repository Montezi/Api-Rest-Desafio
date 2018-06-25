<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutorizaController extends CI_Controller {



	public function login()	{

		

		$method = $_SERVER['REQUEST_METHOD'];	

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
				$json =file_get_contents('php://input');
                $params = json_decode($json,TRUE);					        
		        $username = $params['username'];
		        $password = $params['password'];
		        	
		        $response = $this->UsuarioModel->login($username,$password);
				
				json_output($response['status'],$response);
			
		}
	}

	public function logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
		        $response = $this->UsuarioModel->logout();
				json_output($response['status'],$response);
			
		}
	}
	
}