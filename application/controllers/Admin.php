<?php
    class Admin extends CI_Controller{
        public function index(){
            if($this->check_admin_permission()){
                $data['title'] = 'Manage Users';

                //Get Users
                $data['users'] = $this->user_model->get_users();

                $this->load->view('templates/header');
                $this->load->view('admin/index', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('/');
            }
            
        }

        public function toggleStatus($id){
			if($this->check_admin_permission()){

			$this->user_model->toggle_user_status($id);

			$this->session->set_flashdata('user_status', 'User Status Updated Successfully');

			redirect('admin');

            }else{
                redirect('/');
            }
		}

        public function delete($id){
			if($this->check_admin_permission()){

                $this->user_model->delete_user($id);

                $this->session->set_flashdata('user_deleted', 'User Deleted Successfully');

                redirect('admin');
            }else{
                redirect('/');
            }
		}

		public function edit($id){
			if($this->check_admin_permission()){
                $data['user'] = $this->user_model->get_users($id);

                if(empty($data['user'])){
                    show_404();
                }

                $data['title'] = 'Edit User';
                $this->load->view('templates/header');
                $this->load->view('admin/edit', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('/');
            }
		}

		public function update(){
			if($this->check_admin_permission()){

                $this->post_model->update_user();

                $this->session->set_flashdata('user_updated', 'User Updated Successfully');

                redirect('admin');
            }else{
                redirect('/');
            }
		}

        //Helper

        private function check_admin_permission(){
            if(!$this->session->userdata('logged_in')){
                return false;
            }

            $id = $this->session->userdata('user_id');
            if($this->user_model->check_user_is_admin($id)){
                return true;
            }else{
                return false;
            }
        }
    }