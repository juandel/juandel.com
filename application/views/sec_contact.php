<section id="contact">
  <aside class="promo-outer col-sm-3 col-sm-offset-1 col-md-3 col-md-offset-1">
    <div class="promo" style="">
      <h3>Limited time offer:</h3>
      <h5>For every 3 images you'll get the fourth free of charge!!!</h5>
      <p>Promotion valid online.</p>
    </div>
  </aside>
  
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 text-center">
              <h2 class="section-heading"><?=$sec_contact_title_01?></h2>
              <h3 class="section-subheading text-muted" style="color:white;"><?=$sec_contact_subtitle?></h3>
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
                                            'placeholder' => $sec_contact_name,
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
                                            'placeholder' => $sec_contact_email,
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
                                            'placeholder' => $sec_contact_location,
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
                                            'placeholder' => $sec_contact_comment,
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
                                        'id'          => 'contact_button',
                                        'value'       => $sec_contact_submit,
                                        'type'        => 'submit',
                                        'content'     => '<span class="fa fa-send fa-2x"></span>'
                                      );
                          echo form_button($data_submit_contact);
                      div_c();
                  div_c();   
              echo form_close();
              
              ?>

          </div>
      </div>
      <div class="col-lg-12 text-center">
        <p class="section-subheading text-muted" style="margin-top:60px; color:white;"><?=$sec_contact_footer?></p>
        <h3 class="section-subheading" style="color:white;"><a style="text-decoration:none;" href="mailto:contact@jaddel.com">contact@jaddel.com</a></h3>
      </div>
  </div>
</section>