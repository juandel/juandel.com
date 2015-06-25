<section id="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading text-muted" style="color:white;">Feel free to contact us and access your free 3D model</h3>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-12">

                <?php

                $data_form = array(
                                'style' => 'padding:20px;',
                                'name' =>'contactForm',
                                    );
                echo form_open_multipart('web/email#contact', $data_form);
                    div("", "row");
                        div("", "col-md-6");
                            div("", "form-group");  
                            // echo form_label('Name', 'name');
                                $data_name = array(
                                              'name'        => 'name',
                                              'id'          => 'name',
                                              'maxlength'   => '32',
                                              'placeholder' => 'Your name',
                                              'class'       =>"form-control"
                                            );
                                echo form_input($data_name);
                                echo form_error('name');
                            div_c();

                            div("", "form-group");  
                            // echo form_label('Email', 'email');
                                $data_email = array(
                                              'name'        => 'email',
                                              'id'          => 'email',
                                              'maxlength'   => '64',
                                              'placeholder' => 'Your email',
                                              'class'       =>"form-control"
                                            );
                                echo form_input($data_email);
                                echo form_error('email');
                            div_c();

                            div("", "form-group");  
                            // echo form_label('Location', 'location');
                                $data_location = array(
                                              'name'        => 'location',
                                              'id'          => 'location',
                                              'maxlength'   => '64',
                                              'placeholder' => 'Were are you from?',
                                              'class'       =>"form-control"
                                            );
                                echo form_input($data_location);
                                echo form_error('location');

                            div_c();
                        div_c();

                        div("", "col-md-6");
                            div("", "form-group");  
                            // echo form_label('Your message', 'message');
                                $data_message = array(
                                              'name'        => 'message',
                                              'id'          => 'message',
                                              'maxlength'   => '256',
                                              'placeholder' => 'What can we help you with?',
                                              'class'       =>"form-control"
                                            );
                                echo form_textarea($data_message);
                                echo form_error('message');
                            div_c();
                        div_c();

                        div("", "col-md-12 text-center");
                            $data_submit_contact = array(
                                          'name'        => 'submit_contact',
                                          'class'       => 'btn btn-xl',
                                          'value'       => 'Create work',
                                        );
                            echo form_submit($data_submit_contact);
                        div_c();
                    div_c();   
                echo form_close();
                
                ?>

            </div>
        </div>
        <div class="col-lg-12 text-center">
          <p class="section-subheading text-muted" style="margin-top:60px; color:white; opacity:0.5;">Our form really works and we have people ready to get back to you</p>
        </div>
    </div>
</section>