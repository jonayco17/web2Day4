<?php
	class Posts extends CI_Controller{
		public function index($page = 'home'){
			$data['title'] = 'Latest Posts';
            $data['posts'] = $this->post_model->get_posts();

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($slug = NULL){
			$data['post'] = $this->post_model->get_posts($slug);

			if(empty($data['post'])){
				show_404();
			}

			$data['title'] = $data['post']['title'];
			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		}

		public function create(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'Create Post';
            
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('posts/create', $data);
				$this->load->view('templates/footer');
			}else{
				$this->post_model->create_post();

				$this->session->set_flashdata('post_created', 'Posted Successfully');

				redirect('/');
			}
		}

		public function delete($id){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->post_model->delete_post($id);

			$this->session->set_flashdata('post_deleted', 'Post Deleted Successfully');

			redirect('/');
		}

		public function edit($slug){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['post'] = $this->post_model->get_posts($slug);

			if($this->session->userdata('user_id') != $data['post']['user_id']){
				redirect('/');
			}

			if(empty($data['post'])){
				show_404();
			}

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			$data['title'] = 'Edit Post';
			$this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->post_model->update_post();

			$this->session->set_flashdata('post_updated', 'Post Updated Successfully');

			redirect('/');
		}
	}