<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class EstadoModel extends CI_Model
{
	
	function __construct()
    {

        parent::__construct();
    }


   public function salvar($params){ 
       
        $dados = array('nome' =>$params["nome"] ,
   	    	           'abreviacao'=>$params["abreviacao"],
   	    	           'data_criacao'=>date("Y-m-d-H:i:s"),
   	    	           'data_ult_atualizacao'=>date("Y-m-d-H:i:s")
   	     );
   	   
  	       

        $this->db->insert('estado', $dados);
        return array('status' => 201,'message' => 'Dados inseridos com sucesso!');

   }

   public function getEstado(){
    
    $this->db->select('id,nome,abreviacao,data_criacao,data_ult_atualizacao');
    $query = $this->db->get('estado');
    return $query->result();

   }

   public function filterEstado($filter){

      $field = 'id';
      $order ='asc';

      foreach ($filter as $indice => $valor) {
       
         if($indice=="orderField" ){
             
             $field = $valor;

          }

          if($indice=="sortType")  {

            $order =$valor;
          } 

      }         
    
    	$this->db->select('id,nome,abreviacao,data_criacao,data_ult_atualizacao');

    	
    	foreach ($filter as $indice=>$valor) {  	


    		if($indice!="orderField" && $indice!="sortType" ){
    			$this->db->like($indice,$valor);
    		
    		}  
    
    	      	
  		}
  		$this->db->order_by($field,$order);
   
   		$query = $this->db->get('estado');
       $result = $query->result();


    	if($result){
       	  return $result;
    	
  		}else{

          return array('status' => 400,'message' => 'Nenhum valor encontrado!');

        } 
   

   }

   public function getDetailEstado($id){
   	
    $this->db->select('id,nome,abreviacao,data_criacao,data_ult_atualizacao');
    $this->db->where('id',$id);
    $query = $this->db->get('estado');
    return $query->result();

   }

   public function delete($id){

   	 $this->db->where('id',$id);
   	 $this->db->delete('estado');
     return array('status' => 200,'message' => 'Estado excluído com sucesso!');
   }


   public function update($id,$params){
   

   	foreach ($params as $indice => $valor) {
   		$dados = array($indice=>$valor,
   		              'data_ult_atualizacao'=>date("Y-m-d-H:i:s")    	    	              	    	           
   	    	           
   	    );
   	    
   	    $this->db->where('id',$id);
        $this->db->update('estado',$dados);	//echo var_dump($dados);

   		
   	}    
        	
    return array('status' => 200,'message' => 'Dados atualizados com sucesso!');

   }

}