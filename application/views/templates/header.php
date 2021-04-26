<html>
    <head>
        <title>CodeIgniterWeb2</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/css/tempusdominus-bootstrap-4.min.css" crossorigin="anonymous" />
    </head>
    <body class="layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                        <a class="navbar-brand" href="<?php echo base_url();?>">CodeIgniterWeb2</a>
                    <div id="navbarCollapse" class="collapse navbar-collapse order-3">
                        <ul class="navbar-nav">
                        <?php if($this->session->userdata('user_type') == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="<?php  echo base_url();?>admin">Admin Panel</a></li>              
                        <?php endif; ?>
                        </ul>
                        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                            
                            <li class="nav-item"><a class="nav-link" href="<?php  echo base_url();?>">Home</a></li>
                            
                            <?php if(!$this->session->userdata('logged_in')): ?>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>users/register">Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>users/login">Log-in</a></li>
                            <?php endif; ?>
                            
                            <?php if($this->session->userdata('logged_in')): ?>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>posts/create">Create Post</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>users/logout">Logout</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
            </nav>
                
            <div class="content-wrapper" >
                <div class="content-header">
                    <div class="container">
                        <div class="row <?= $title == 'Manage Users' ? '' : 'd-flex justify-content-center' ?>">
                            <div class="col-md-6 ">
                                <?php if($this->session->flashdata('post_success')):?>
                                    <?= '<p class="alert alert-success">'.$this->session->flashdata('post_success').'</p>'?>
                                <?php endif ?>

                                <?php if($this->session->flashdata('user_error')):?>
                                    <?= '<p class="alert alert-danger">'.$this->session->flashdata('user_error').'</p>'?>
                                <?php endif ?>

                                <?php if($this->session->flashdata('user_success')):?>
                                    <?= '<p class="alert alert-success">'.$this->session->flashdata('user_success').'</p>'?>
                                <?php endif ?>

                                <h1 class="m-0 text-dark"><?= $title ?></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container">
                        <div class="row <?= $title == 'Manage Users' ? '' : 'd-flex justify-content-center' ?>">
                            <div class="col-md-6">
