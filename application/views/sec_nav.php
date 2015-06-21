        <nav class="navbar navbar-default navbar-fixed-top navbar-shrink" style="">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="<?=base_url()?>" style="padding:0px;"><img src="<?=base_url();?>img/logos/jaddel.png" style="display:inline-block; width:50px; padding:5px; " >   Jaddel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        
                    <?php
                        if (uri_string() =="web" || uri_string()=="" || uri_string()=="web/email") {
                    ?>

                            <li>
                                <a class="page-scroll" href="#services">Services</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio">Portfolio</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#workflow">Workflow</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#team">Team</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#contact">Contact</a>
                            </li>
                    <?php
                        }else{
                    ?>

                        <li>
                            <a class="page-scroll" href="<?=base_url()?>">Home</a>
                        </li>
                       

                    <?php
                        }
                        if (isset($_SESSION['user_id'])){
                        ?>
                            <li style="font-size:10px;">
                                <a class="page-scroll" href="<?=base_url('users/logout')?>">Log Out</a>
                            </li>  
                    <?php 
                        }else{
                    ?>
                            <li style="font-size:10px;">
                                <a class="page-scroll" href="<?=base_url('users/login')?>">Log in</a>
                            </li>
                    <?php 
                        }
                    ?> 

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
                <!-- /.container-fluid -->
        </nav>
        <div class= "container nav-fix-height"></div>