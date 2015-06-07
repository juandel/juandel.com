<header>
    <div class="container-fluid slider-div" style="padding:0px;">
        <!-- <div class="intro-text">
            <div class="intro-lead-in" style="visibility:hidden;font-size:5em;font-family: Montserrat,Helvetica Neue,Helvetica,Arial,sans-serif; font-style:normal;"><?=page_title()?></div>
            <div class="intro-heading" style="visibility:hidden;font-size:20px; line-height:1.4em;"><?=sub_page_title()?></div>
        </div> -->
        <div id="slider" class="nivoSlider">
        	<?php
        	foreach ($images as $image) {
        		echo img(base_url('img/uploads/'.$image));
        	}
        	 ?>
		    <!-- <img src="images/slide1.jpg" alt="" /> -->
		</div>

		<!-- <div id="htmlcaption" class="nivo-html-caption">
		    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
		</div> -->
    </div>
</header>