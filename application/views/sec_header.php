<header id="header">
    <div class="container-fluid slider-div theme-showcase" style="padding:0px;">
        <!-- <div class="intro-text">
            <div class="intro-lead-in" style="visibility:hidden;font-size:5em;font-family: Montserrat,Helvetica Neue,Helvetica,Arial,sans-serif; font-style:normal;"><?=page_title()?></div>
            <div class="intro-heading" style="visibility:hidden;font-size:20px; line-height:1.4em;"><?=sub_page_title()?></div>
        </div> -->
        <div class="jumbotron">
            <h1>Jaddel</h1>
            <p>Architectural Visualization</p>
        </div>
        <div id="slider" class="nivoSlider">
        	<?php
            $images_rand_key = array_rand($images, 4);
            // print_r($images_rand_key);
            // print_r($images);
            $images_rand = array();
            foreach ($images_rand_key as $key) {
                $images_rand[] = $images[$key];
            }
            // print_r($images_rand);
        	foreach ($images_rand as $image) {
                $ext = explode('.', $image);
        		echo img(base_url('img/uploads/'.$ext[0]."_thumb.".$ext[1]));
        	}
        	 ?>
		    <!-- <img src="images/slide1.jpg" alt="" /> -->
		</div>

		<!-- <div id="htmlcaption" class="nivo-html-caption">
		    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
		</div> -->
    </div>
</header>