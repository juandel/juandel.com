
    <?php 
      //Insert header into template
      foreach ($head as $he) {
        echo $he;
      }
    ?>

<section id="update_work" class="bg-light-gray">
  <div class="container-fluid" style="padding:0px;">
  	<div class="col-md-12">
  <?php 

  if (isset($feedback)) {
    foreach ($feedback as $key => $value) {
      echo "<p>".$value."</p>";
    }
  }

  if (isset($error)) {
    foreach ($error as $er =>$err) {
      echo '<div class="alert alert-danger" style="background-color:white; border:none">'.$err.'</div>';
    }
  }

  // if the variable Work Exists print form
  if (isset($work)) {
    // Form helper Inserted
    $data_form = array('style' => 'padding:20px;');
    echo form_open_multipart('works/update_work/'.$work_id, $data_form);
    
    div("", "col-md-6"); 
      
      div("", "form-group");  
      echo form_label('Work Title', 'title');
      $data_title = array(
                    'name'        => 'title',
                    'id'          => 'title',
                    'value'       => $work[0]['title'],
                    'maxlength'   => '32',
                    'size'        => '50',
                    'style'       => 'width:30%',
                    'class'   =>"form-control"
                  );
      echo form_input($data_title);
      echo form_error('title');
      div_c();

      div("", "form-group");  
      echo form_label('Work Description', 'description');
      $data_description = array(
                    'name'        => 'description',
                    'id'          => 'description',
                    'value'       => $work[0]['description'],
                    'maxlength'   => '256',
                    'size'        => '50',
                    'style'       => 'width:30%',
                    'class'   =>"form-control"
                  );
      echo form_textarea($data_description);
      echo form_error('description');
      div_c();

      div("", "form-group");  
      echo form_label('Software', 'software');
      $data_software = array(
                    'name'        => 'software',
                    'id'          => 'software',
                    'value'       => $work[0]['software'],
                    'maxlength'   => '64',
                    'size'        => '50',
                    'style'       => 'width:30%',
                    'class'   =>"form-control"
                  );
      echo form_input($data_software);
      echo form_error('software');
      div_c();

      div("", "form-group");  
      echo form_label('Location', 'location');
      $data_location = array(
                    'name'        => 'location',
                    'id'          => 'location',
                    'value'       => $work[0]['location'],
                    'maxlength'   => '64',
                    'size'        => '50',
                    'style'       => 'width:30%',
                    'class'   =>"form-control"
                  );
      echo form_input($data_location);
      echo form_error('location');

      div_c();

    div_c();

    div("", "col-md-6"); 
      
      if (count($images)) {
        foreach ($images as $image) {
        ?>
          <div class="col-md-4 portfolio-item" style="padding: 0; margin:0;">
                <a href="<?=base_url()?>img/uploads/<?=$image['name']?>" class="portfolio-link" data-toggle="modal" data-lightbox="images_works">
                    <img src="<?=base_url()?>img/uploads/<?=$image['name']?>" class="img-responsive" alt="">
                </a>

            <?php
              echo form_label($image['name'], 'image_radio[]');
              $data_radio = array(
                  'name'        => 'image_radio[]',
                  'value'       => $image['name'],
                  'checked'     => FALSE,
                  'style'       => 'margin:10px',
                  );

              echo form_checkbox($data_radio);
            ?>
          </div>

        <?php
        }
      }else{
        echo "<p>No images for this work</p>";
      }
          
      div("", "col-md-12","border-top: solid thin black;margin-top:20px;");
        div("", "form-group","padding-top:10px;");
          echo form_label('Choose file', 'upload');
          $data_upload = array(
                        'name'        => 'images[]',
                        'id'          => 'upload',
                        'style'       => 'width:50%',
                      );
          echo form_upload($data_upload,'','multiple');
          echo '<p style="color:grey; font-size:0.8em;">Choose all the files you want to upload with CTRL or SHIFT</p>';
        div_c();
      div_c(); 
    div_c();

    $data_submit = array(
                  'name'        => 'submit',
                  'class'       => 'btn btn-default',
                  'value'       => 'Update work',
                  'style'       => 'margin:20px 0px;'
                );
    echo form_submit($data_submit);
    echo form_close();
  }

  ?>


  	</div>
  </div>
</section>
  <?php 
  //Insert footer into template
  foreach ($footer as $foot) {
    echo $foot;
  }
  ?>
