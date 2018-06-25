<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class CidadeModel extends CI_Model
{

	function __construct()
    {

        parent::__construct();
    }
  

   public function salvar($params){
     
    
        $dados = array('nome' =>$params["nome"] ,
   	    	           'idestado'=>$params["idestado"],
   	    	           'data_criacao'=>date("Y-m-d-H:i:s"),
   	    	           'data_ult_alteracao'=>date("Y-m-d-H:i:s")
   	     );

   	   

        $query = $this->db->insert('cidade', $dados);
        return array('status' => 201,'message' => 'Dados inseridos com sucesso!');
   }


    public function getCidade(){
    
    $this->db->select('id,nome,idestado,data_criacao,data_ult_alteracao');
    $query = $this->db->get('cidade');
    return $query->result();

   }

    public function filterCidade($filter){

      
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
   
    
    
    $this->db->select('id,nome,idestado,data_criacao,data_ult_alteracao');

    foreach ($filter as $indice=>$valor) {

    	if($indice!="orderField" && $indice!="sortType" ){

          if($indice=="idestado"){

             $this->db->where($indice,$valor);
          }

    		 $this->db->like($indice,$valor);
    		
    		}      
    	
    }
    
    $this->db->order_by($field,$order);   
    $query = $this->db->get('cidade');
    $result = $query->result();
  
    //	echo var_dump($result);
  
    if($result){
        return $result;
    	
    }else{

    	return array('status' => 400,'message' => 'Nenhum valor encontrado!');

    }

    

   }

   public function getDetailCidade($id){
      $this->db->select('id,nome,idestado,data_criacao,data_ult_alteracao');
      $this->db->where('id',$id);
      $query = $this->db->get('cidade');
      return $query->result();

   }

   public function delete($id){

   	 $this->db->where('id',$id);
   	 $this->db->delete('cidade');
     return array('status' => 200,'message' => 'Cidade excluída com sucesso!');

   }

   public function update($id,$params){

   	foreach ($params as $indice => $valor) {
   		$dados = array($indice=>$valor,
   		              'data_ult_alteracao'=>date("Y-m-d-H:i:s")    	    	              	    	           
   	    	           
   	    );
   	    
   	    $this->db->where('id',$id);
        $this->db->update('cidade',$dados);	

   		
   	}   

    return array('status' => 200,'message' => 'Dados atualizados com sucesso!');

   }

}