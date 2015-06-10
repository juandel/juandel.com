<?php 
$view_name = uri_string();
$url_title = url_title($view_name);

//Insert header into template
foreach ($head as $he) {
  echo $he;
}


?>

<div class="container-fluid " style=" padding: 20px 0px; background-color:rgb(247, 247, 247)">
  <ol class="breadcrumb">
    <li><a href="<?=base_url()?>">Home</a></li>
    <li><?=$view_name;?></li>
  </ol>

<?php 
if (isset($resize_error)) {
  echo '<div class="alert alert-warning" style="background:none; 
  border:none;" >'.$resize_error.'</div>';
}

if (isset($error)) {
	echo '<div class="alert alert-warning" style="background:none; 
  border:none;" >'.$error.'</div>';
}

if (isset($db)) {
    echo "<p>".$db."</p>";
}

// Form helper Inserted
$data_form = array('style' => 'padding:20px;');
echo form_open_multipart('works/create_work', $data_form);

div("", "form-group");	
echo form_label('Work Title', 'title');
$data_title = array(
              'name'        => 'title',
              'id'          => 'title',
              'maxlength'   => '32',
              'size'        => '50',
              'style'       => 'width:30%',
              'class'		=>"form-control"
            );
echo form_input($data_title);
echo form_error('title');
div_c();

div("", "form-group");	
echo form_label('Work Description', 'description');
$data_description = array(
              'name'        => 'description',
              'id'          => 'description',
              'maxlength'   => '256',
              'size'        => '50',
              'style'       => 'width:30%',
              'class'		=>"form-control"
            );
echo form_textarea($data_description);
echo form_error('description');
div_c();

div("", "form-group");	
echo form_label('Software', 'software');
$data_software = array(
              'name'        => 'software',
              'id'          => 'software',
              'maxlength'   => '64',
              'size'        => '50',
              'style'       => 'width:30%',
              'class'		=>"form-control"
            );
echo form_input($data_software);
echo form_error('software');
div_c();

div("", "form-group");	
echo form_label('Location', 'location');
$data_location = array(
              'name'        => 'location',
              'id'          => 'location',
              'maxlength'   => '64',
              'size'        => '50',
              'style'       => 'width:30%',
              'class'		=>"form-control"
            );
echo form_input($data_location);
echo form_error('location');

div_c();


div("", "form-group");
echo form_label('Choose file', 'upload');
$data_upload = array(
              'name'        => 'images[]',
              'id'          => 'upload',
              'style'       => 'width:50%',
            );
echo form_upload($data_upload,'','multiple');
echo '<p style="color:grey; font-size:0.8em;">Choose all the files you want to upload with CTRL or SHIFT</p>';
div_c();


$data_submit = array(
              'name'        => 'submit',
              'class'          => 'btn btn-default',
              'value'       => 'Create work',
            );
echo form_submit($data_submit);
echo form_close();
?>
<p>Images should be as big as 1024 x 768</p>
<a id="deleteButton" class="btn btn-danger" href="<?=base_url('web')?>">Cancel</a>

	</div>
</div>
<?php 
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}
?>