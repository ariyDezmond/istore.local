<?php if($entries):?>
<!-- slider -->
<div class="slider">
   <!-- container -->
   <div class="container">
      <!-- #myCarousel -->
      <div id="myCarousel" class="carousel slide" data-ride="carousel">

         <!-- Wrapper for slides -->
         <div class="carousel-inner" role="listbox">
         <?php foreach($entries as $key=>$entry):?>
            <div class="item<?php if($key==0):?> active<?php endif;?>">
               <a href="#"><img src="/images/slider/<?=$entry['image']?>" alt="<?=$entry['text']?>"></a>
               <div class="carousel-caption">
                  <h3><a href="#"><?=$entry['text']?></a></h3>
               </div>
            </div><!-- item end -->
         <?php endforeach;?>

         </div>
          <!-- Wrapper for slides -->

         <!-- Left and right controls -->
         <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
         <!-- Left and right controls end -->

      </div><!-- #myCarousel end -->
   </div><!-- container end -->
</div><!-- slider end -->
<?php endif;?>