<?php 
//Insert header into template
foreach ($head as $he) {
  echo $he;
}
if (isset($work[0])) {
?>

	<div class="container" style="margin-top: 70px; padding:0;">
		<div class="row container-fluid bg-light-gray" style="">
			<h2><?=$work[0]['title']?></h2>

			<p><?=$work[0]['description']?></p>
		</div>
		<div class="row container-fluid " style="padding:0;">

			<?php 

			foreach ($images as $value) {
			?>

			 <div class="row col-md-4 col-sm-6 portfolio-item" style="padding: 0; margin:0;">
			    <div>
			        <a href="<?=base_url()?>img/uploads/<?=$value['name']?>" class="portfolio-link" data-toggle="modal" data-lightbox="images_works">
			            <img src="<?=base_url()?>img/uploads/<?=$value['name']?>" class="img-responsive" alt="">
			        </a>
			    </div>
			</div>

			<?php
			}

			?>
		</div>
		<?php if (isset($_SESSION['user_id'])){ ?>
			
			<div class="row container-fluid bg-light-gray" style="padding:0px;">
				<h3 class="container" style="margin:20px auto;">
					<a class="btn btn-info" href="<?=base_url('works/update_work/'.$work[0]['id'])?>">Edit Work</a>

					<a id="deleteButton" class="btn btn-danger" href="<?=base_url('works/delete_work/'.$work[0]['id'])?>">Delete Work</a>
				</h3>
			</div>

		<?php } ?>
		
	</div>
<?php 
}
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}

?>