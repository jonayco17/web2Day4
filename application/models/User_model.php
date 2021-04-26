<?php
    class User_model extends CI_Model{
        //User

        public function register($enc_password){
            $data= array(
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
            );

            return $this->db->insert('users', $data);
        }

        public function login($username, $password){
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            
            $result = $this->db->get('users');

            if($result->num_rows() == 1){
                $user_data = array(
                    'id' => $result->row(0)->id,
                    'status' => $result->row(0)->status,
                );
                                
                return $user_data;
            }else{
                return array('status' => 'failed');
            }
        }

        //Admin
        public function get_users($id = FALSE){
            if($id === FALSE){
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('users');                
                return $query->result_array();
            }

            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }

        public function delete_user($id){
            $this->db->where('id', $id);
            $this->db->delete('users');
            return true;
        }

        public function toggle_user_status($id){
            $status = $this->db->get_where('users', array('id' => $id, ))->row(0)->status;

            $data = array(
                'status' => $status === 'pending' ? ('approved') : ('pending'),
            );

            $this->db->where('id', $id);
            return $this->db->update('users', $data);

        }

        public function check_user_is_admin($id){
            $this->db->where('id', $id);
            $this->db->where('type', 'admin');

            $result = $this->db->get('users');

            if($result->num_rows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function update_user(){
            $data= array(
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'type' => $this->input->post('type'),
                'status' => $this->input->post('status'),
            );

            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('users', $data);

        }

        //Helpers

        public function check_username_exists($username){
            $query = $this->db->get_where('users', array('username' => $username, ));

            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }

        public function check_email_exists($email){
            $query = $this->db->get_where('users', array('email' => $email, ));

            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }
    }