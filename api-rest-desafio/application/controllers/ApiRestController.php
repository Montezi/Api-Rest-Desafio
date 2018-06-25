<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ApiRestController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}


/* Inserir Estado
*/


	public function insertEstado (){

		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

          $response = $this->UsuarioModel->aut();

          if($response['status'] == 200){    

              $json =file_get_contents('php://input');
              $params = json_decode($json,TRUE);

              if(empty($params)){ 

                $status=400;
                $resp=array('status' => 400,'message' => 'Informe os dados do Estado!');
                return json_output($status,$resp);

              }

               $verifica=$this->EstadoModel->filterEstado($params);
               echo var_dump($verifica['message']);

               if($verifica['message'] != "Nenhum valor encontrado!"){

                   $status=400;
                   $resp=array('status' => 409,'message' => 'Este estado já consta na base de dados!');
                   return json_output($status,$resp);

               } 

                try{
                  $resp = $this->EstadoModel->salvar($params);
                  $status = 200;
                  return json_output($status,$resp);

                }catch(Exception $e){
                  $status=500;
                  $resp=array('status' => 500,'message' => $e.'Erro interno!');
                  return json_output($status,$resp);

                }   
                       
            }
        }  
             
     }
          
           		
       	

      

    


/* Inserção de Cidade
*/

    public function insertCidade (){

		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

          $response = $this->UsuarioModel->aut();

          if($response['status'] == 200){    


              $json =file_get_contents('php://input');
              $params = json_decode($json,TRUE);

             if(empty($params)){ 

                $status=400;
                $resp=array('status' => 400,'message' => 'Informe os dados da Cidade!');
                return json_output($status,$resp);

              }

               $verifica=$this->EstadoModel->filterEstado($params);
               echo var_dump($verifica['message']);

               if($verifica['message'] != "Nenhum valor encontrado!"){

                   $status=400;
                   $resp=array('status' => 409,'message' => 'Esta cidade já consta na base de dados!');  
                   return json_output($status,$resp);

               } 


               try{

              	$resp = $this->CidadeModel->salvar($params);
              	$status = 200;
                return json_output($status,$resp);

              }catch(Exception $e){
          			$status=500;
          	   	$resp=array('status' => 500,'message' => $e.'Erro interno!');
                return json_output($status,$resp);  

              } 
            }
                   
                   
        }   
                 
    }
          
       	 
    


    
    public function listaEstado(){

      $method = $_SERVER['REQUEST_METHOD'];

      if($method != 'GET'){

        json_output(400,array('status' => 400,'message' => 'Bad request.'));

      } else {        
    

      $response = $this->UsuarioModel->aut();

      if($response['status'] == 200){    

           $filter = $this->input->get();
  			
           if (!empty($filter)) {

             $resp = $this->EstadoModel->filterEstado($filter); 
             json_output($response['status'],$resp);            
                
           }else{

            $resp = $this->EstadoModel->getEstado();
            json_output($response['status'],$resp);
            
          }
      }
       
      }  	
  } 



    public function detalheEstado($id){

      $method = $_SERVER['REQUEST_METHOD'];
		  if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			   json_output(400,array('status' => 400,'message' => 'Bad request.'));

		  } else {          

            $response = $this->UsuarioModel->aut();

             if($response['status'] == 200){    

              $resp= $this->EstadoModel->getDetailEstado($id);
              
             json_output($response['status'],$resp);

            }   
                   
	    }
      
    }

  public function listaCidade(){

    $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

      $response = $this->UsuarioModel->aut();

      if($response['status'] == 200){  
			
			$filter = $this->input->get();

			   if (!empty($filter)) {

            $resp = $this->CidadeModel->filterCidade($filter);       
           
			   }else{

           $resp = $this->CidadeModel->getCidade();			    	   
			   }
      }

      json_output($response['status'],$resp);

		 
   }	
 } 



     public function detalheCidade($id){

      $method = $_SERVER['REQUEST_METHOD'];
		  if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

			   json_output(400,array('status' => 400,'message' => 'Bad request.'));

	   	} else {        

           $response = $this->UsuarioModel->aut();

           if($response['status'] == 200){  

			        $resp= $this->CidadeModel->getDetailCidade($id);			       
			        json_output($response['status'],$resp);

           } 
     
	   	}
      
    }



    public function deleteEstado($id){

    	$method = $_SERVER['REQUEST_METHOD'];
		  if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

			   json_output(400,array('status' => 400,'message' => 'Bad request.'));

		  } else {

           $response = $this->UsuarioModel->aut();

           if($response['status'] == 200){  

      		  	if(!empty($id)){          

                		try{
                			$resp = $this->EstadoModel->delete($id);
      					       $status =200;

                		}catch(Exception $e){
                		  	$status=500;
                	   		$resp=array('status' => 500,'message' => $e.'Erro interno!');

                		}         	

              }else{
                	$status=400;
                	$resp=array('status' => 400,'message' => 'Informe o id do Estado que deseja excluir!');
              }
            }
              
			
			   json_output($status,$resp);
      }		

	}	

		 

    public function deleteCidade($id){

    	$method = $_SERVER['REQUEST_METHOD'];
	   	if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			
		    	json_output(400,array('status' => 400,'message' => 'Bad request.'));

		  } else {        

           $response = $this->UsuarioModel->aut();

           if($response['status'] == 200){    

      			   if(!empty($id)){

                		try{

                			$resp = $this->CidadeModel->delete($id);
      					      $status =200;

                		}catch(Exception $e){
                			$status=500;
                	   		$resp=array('status' => 500,'message' => $e.'Erro interno!');
                		}         	

                }else{
                	$status=400;
                	$resp=array('status' => 400,'message' => 'Informe o id da Cidade que deseja excluir!');
                }
            }
          
        }      
			
		    json_output($status,$resp);		

		}	

		 
    
    public function updateEstado($id){

    	$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

			   json_output(400,array('status' => 400,'message' => 'Bad request.'));

		  } else {

           $response = $this->UsuarioModel->aut();

           if($response['status'] == 200){    

  		  	     $json =file_get_contents('php://input');
               $params = json_decode($json,TRUE);

              if(!empty($params) && !empty($id)){
              		try{
              			$resp =$this->EstadoModel->update($id,$params);
                   		$status = 200;

              		}catch(Exception $e){
              			$status=500;
              	   		$resp=array('status' => 500,'message' => $e.'Erro interno!');
              		}         	

              }else{

            	$status=400;
            	$resp=array('status' => 400,'message' => 'Informe os dados a serem alterados  e o id do estado.');

              }
            }
             			
			
			json_output($status,$resp);
		}
  }


    
     public function updateCidade($id){

    	$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

			   json_output(400,array('status' => 400,'message' => 'Bad request.'));

		  } else {

             $response = $this->UsuarioModel->aut();

             if($response['status'] == 200){    

    			      $json =file_get_contents('php://input');
                $params = json_decode($json,TRUE);

                if(!empty($params)&& !empty($id)){

              		try{
              			$resp =$this->CidadeModel->update($id,$params);
    					       $status=200;

              		}catch(Exception $e){

              			$status=500;
              	   		$resp=array('status' => 500,'message' => $e.'Erro interno!');

              		}         	

                }else{

              	$status=400;
              	$resp=array('status' => 400,'message' => 'Informe os dados a serem alterados e o id da cidade.');
               }  
              }
                        
			
			 json_output($status,$resp);
		  }
   }



}