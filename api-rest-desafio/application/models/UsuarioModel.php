<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model {


    public function login($username,$password){



        $query  = $this->db->select('senha,id')->from('usuarios')->where('usuario',$username)->get()->row();

       
        if(empty($query)){

            return array('status' => 204,'message' => 'Username não encontrado.');

        } else {
          

            $hashed_password = $query->senha;
            $id              = $query->id;

            // echo $hashed_password ." ".$password;
        
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {

               $ultimo_login = date('Y-m-d H:i:s');
               $criado_em = date('Y-m-d H:i:s');                              
               $token = crypt(substr( md5(rand()), 0, 7),'$1$desafio$');
             
               $expira_em = date("Y-m-d H:i:s", strtotime('+12 hours'));

               $this->db->trans_start();
               $this->db->where('id',$id)->update('usuarios',array('ultimo_login' => $ultimo_login));
               $this->db->insert('usuarios_autenticados',array('usuario_id' => $id,'token' => $token,'expira_em' => $expira_em,'criado_em'=>$criado_em));

               if ($this->db->trans_status() === FALSE){

                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Erro interno do servidor.');

               } else {

                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Login realizado com sucesso!','id' => $id, 'token' => $token);
               }

            } else {
                echo "Usuário ou senha inválido";
                exit();
               return array('status' => 204,'message' => 'Usuário ou senha inválido.');
            }
        }
    }


    public function logout()    {

        $usuario_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('x-api-key', TRUE);

        if(!empty($usuario_id) && !empty($token)){
       

        $this->db->where('usuario_id',$usuario_id);
        $this->db->where('token',$token);
        $this->db->delete('usuarios_autenticados');

        /*$this->db->where('usuario_id',$usuario_id)->where('token',$token)->delete('usuarios_autenticados');*/
        return array('status' => 200,'message' => 'Logout efetuado com sucesso.');

      }else{

         return array('status' => 400,'message' => 'Verifique se o Header foi preenchido');
      }


    }



    public function aut()  {

        $usuario_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('x-api-key', TRUE);

        

        $query  = $this->db->select('expira_em')->from('usuarios_autenticados')->where('usuario_id',$usuario_id)->where('token',$token)->get()->row();

        if($query == ""){

            return json_output(401,array('status' => 401,'message' => 'Acesso não autorizado.'));

        } else {

            if($query->expira_em < date('Y-m-d H:i:s')){

                return json_output(401,array('status' => 401,'message' => 'Sua sessão está expirada.'));

            } else {

                $alterado_em = date('Y-m-d H:i:s');                

                $this->db->where('usuario_id',$usuario_id)->where('token',$token)->update('usuarios_autenticados',array('alterado_em' => $alterado_em));

                return array('status' => 200,'message' => 'Autorizado.');
            }
        }
    }
}    