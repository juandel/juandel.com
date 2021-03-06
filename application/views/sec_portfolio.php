<section id="portfolio" class="bg-light-gray">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?=$sec_port_title_01?></h2>
                <h3 class="section-subheading text-muted"><?=$sec_port_subtitle?></h3>
            </div>
        </div>
        <div class="row">
        <?php 
        if (isset($works)) {
            
            foreach ($works as $work) {
                $images = $work['images'];
                // foreach work it will show only first image
                if(isset($images[0])){
            ?>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="<?=base_url()?>works/show_work/<?=$work['id']?>" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img src="<?=base_url()?>img/uploads/<?=$images[0]['name']?>" class="img-responsive" >
                        </a>
                        <div class="portfolio-caption">
                            <h4><?=$work['title']?></h4>
                        </div>
                    </div>
            <?php
                }
            }
        }elseif (!isset($_SESSION['user_id'])){
            ?>
            
            <div class="row">
                <h4>No Works! You must log in to create works.</h4>
            </div>

        <?php 
        }
        if (isset($_SESSION['user_id'])) {
        ?>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="<?=base_url()?>works/create_work" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <i class="glyphicon glyphicon-picture" style=" width:100%; text-align:center; font-size:140px; background:grey;"></i>
                    
                </a>
                <div class="portfolio-caption">
                    <h4 style="text-align: center;">Add Work to Website</h4>
                </div>
            </div>
        <?php
        }
        ?>


        </div>
    </div>
</section>