<?//php var_dump($images);?>
<?php if(!empty($entries)):?>
   <!-- slider -->
   <div class="slider about_iMac_slider">
      <!-- container -->
      <div class="container">
         <!-- #myCarousel -->
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
               <?php foreach($images as $key=>$image):?>
               <!-- Wrapper for slides -->
                     <div class="item<?php if($key==0):?> active<?php endif;?>">
                        <img src="/images/subcategories/<?=$image['image']?>">
                     </div><!-- item end -->
                <!-- Wrapper for slides -->
               <?php endforeach;?>
            </div>
            <?php if(count($images)>1):?>
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
            <?php endif;?>
         </div><!-- #myCarousel end -->
      </div><!-- container end -->
   </div><!-- slider end -->



   <!-- main_pagination -->
   <div class="main_pagination about_iMac_pagination">
      <!-- container -->
      <div class="container">
         <!-- row -->
         <div class="row">
            <?php foreach($entries as $key=>$entry):?>
               <div class="col-md-<?=12/count($entries)?> col-xs-12 main_pagination_item main_pagination_item_<?=$key+1?>">
                  <div class="main_pagination_wrapper">

                     <h5><?=$entry['name']?></h5>
                     <a href="/<?=$catUrl?>/<?=$subCatUrl?>/<?=$entry['url']?>/" class="main_pagination_item_container">
                        <img src="/images/goods/<?=$entry['imageSm']?>" alt="" title="">
                     </a>
                     <h4><a href="/<?=$catUrl?>/<?=$subCatUrl?>/<?=$entry['url']?>/"><?=$entry['price']?>$</a></h4>
                     <a href="/<?=$catUrl?>/<?=$subCatUrl?>/<?=$entry['url']?>/" class="link">Подробнее...</a>

                  </div>
               </div>
               <!-- main_pagination_item
            <?php endforeach;?>
         </div><!-- row end -->
      </div><!-- container end -->
   </div><!-- main_pagination end -->
<?php else:?>
   <div class="no_goods">В данной категории пока нет товаров</div>
<?php endif;?>