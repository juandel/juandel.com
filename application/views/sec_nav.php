        <nav class="navbar navbar-default navbar-fixed-top navbar-shrink" >
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="">
                        <!-- <div class="col-md-6"> -->
                            <a class="brand-link page-scroll" href="<?php 
                                                        if (uri_string() =="web" || uri_string()=="" ){
                                                            echo '#header';
                                                        }else{
                                                            echo base_url();
                                                        }?>" style="padding:0px;">
                        <!-- <img src="<?=base_url();?>img/logos/jaddel_2d.png" style="display:inline-block; width:90px; padding:5px; " >Jaddel -->
                                <div class="jaddel_logo">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426 425.667" >
                                        <path fill="#FCFCFC" d="M213.256 394.833c-100.355 0-182.001-81.647-182.001-182.005c0-100.353 81.646-181.995 182.001-181.995 c100.354 0 182 81.6 182 181.995C395.255 313.2 313.6 394.8 213.3 394.833z"/><path fill="#01457C" d="M213.256 33.833c47.812 0 92.8 18.6 126.6 52.428s52.428 78.8 52.4 126.6 c0 47.815-18.619 92.768-52.428 126.577c-33.808 33.809-78.759 52.428-126.571 52.428c-47.814 0-92.766-18.619-126.574-52.428 s-52.427-78.762-52.427-126.577c0-47.811 18.619-92.759 52.427-126.567C120.491 52.5 165.4 33.8 213.3 33.8 M213.256 27.833c-102.177 0-185.001 82.829-185.001 184.995c0 102.2 82.8 185 185 185 c102.173 0 184.999-82.826 184.999-185.005C398.255 110.7 315.4 27.8 213.3 27.833L213.256 27.833z"/><path fill="#006699" d="M213.256 27.833c102.173 0 185 82.8 185 184.995c0 102.179-82.826 185.005-184.999 185 c-102.177 0-185.001-82.826-185.001-185.005C28.255 110.7 111.1 27.8 213.3 27.8 M213.256 0.8 c-28.609 0-56.376 5.609-82.53 16.671c-25.248 10.679-47.917 25.961-67.378 45.422c-19.46 19.461-34.743 42.129-45.421 67.4 C6.864 156.5 1.3 184.2 1.3 212.829c0 28.6 5.6 56.4 16.7 82.531c10.679 25.2 26 47.9 45.4 67.4 s42.13 34.7 67.4 45.423c26.154 11.1 53.9 16.7 82.5 16.671c28.608 0 56.375-5.609 82.528-16.671 c25.248-10.679 47.917-25.962 67.378-45.423s34.743-42.131 45.422-67.38c11.062-26.154 16.671-53.922 16.671-82.531 c0-28.606-5.608-56.372-16.671-82.524c-10.679-25.248-25.961-47.917-45.422-67.377s-42.13-34.743-67.378-45.422 C269.63 6.4 241.9 0.8 213.3 0.833L213.256 0.833z"/><polygon fill="#3399FF" points="184.3,217.3 92.3,263.3 184.4,171.2"/><polygon fill="#006699" points="184.3,309.3 92.3,263.3 184.4,171.2"/><polyline fill="#01457C" points="92.3,263.3 184.3,284.7 184.3,355.4"/><path fill="#29ABE2" d="M184.356 171.2"/><polygon fill="#006699" points="274.2,70.3 236.5,108 217.7,70.3"/><path fill="#29ABE2" d="M217.662 70.3"/><polygon fill="#3399FF" points="236.5,70.3 236.5,108 198.8,70.3"/><polygon fill="#3399FF" points="193,143.5 334.2,214.1 193,72.8"/><polygon fill="#006699" points="193,284.7 334.2,214.1 193,143.5"/><polyline fill="#01457C" points="334.2,214.1 193,284.7 193,355.3"/><path fill="#29ABE2" d="M192.985 143.5"/><ellipse fill="#A8ACB2" cx="206.5" cy="212.8" rx="3.6" ry="0"/>
                                    </svg>
                                </div>
                            </a>
                            <div id="lang">
                                <a href="<?php echo base_url().'?lang=en';?>">EN</a>
                                <span class="lang_separator">|</span>
                                <a href="<?php echo base_url().'?lang=sp';?>">ES</a>
                            </div>
                            
                        <!-- </div> -->
                        <!-- <div class="col-md-6 lang_id" style="margin-top:1.4em;">
                            
                        </div> -->
                        
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        
                    <?php
                        if (uri_string() =="web" || uri_string()=="" || uri_string()=="web/index/sp" ||uri_string()=="web/index/en" ) {
                    ?>

                            <li>
                                <a class="page-scroll" href="#services" style="background-color:transparent;"><?=$link01;?></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio"><?=$link02;?></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#workflow"><?=$link03;?></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#team"><?=$link04;?></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#contact"><?=$link05;?></a>
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