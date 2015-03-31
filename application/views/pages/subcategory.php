
<?php if(!empty($entry)):?>
<!-- iMac -->
<div class="iMac">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">

         <div class="col-md-7 col-xs-12 iMac_img">
            <a href="#"><img src="/images/categories/<?=$entry['image']?>" alt="" title=""></a>
         </div>

         <div class="col-md-5 col-xs-12 description">
            <div class="description_inner">
               <h2><?=$entry['text']?></h2>
               <p><?=$entry['desc']?></p>
               <a href="#">Подробнее...</a>
            </div>
         </div>

      </div><!-- row end -->
   </div><!-- container end -->
</div><!-- iMac end -->


<!-- iMac_pagination -->
<div class="iMac_pagination">
   <!-- container -->
   <div class="container">
      <!-- row -->

      <div class="row">
         <div class="col-md-1"></div>
         <?php foreach($entry['sub'] as $key=>$sub):?>
            <div class="col-md-2 col-xs-6 pagination_item <?php if(count($entry['sub']) == $key):?>last_item<?php endif;?>"><a href="/<?=$sub['category_url']?>/<?=$sub['url']?>/"><img src="/images/subcategories/<?=$sub['image']?>" alt="" title=""><span><?=$sub['text']?></span></a></div><!-- pagination_item -->
         <?php endforeach;?>
         <div class="col-md-1"></div>

      </div>
      

      <!-- <div class="row">
      
         <div class="col-md-1"></div>
      
         <div class="col-md-2 col-xs-6 pagination_item"><a href="#"><img src="/img/jpg/img7.jpg" alt="" title=""><span>MacBookAir</span></a></div>pagination_item
         <div class="col-md-2 col-xs-6 pagination_item"><a href="#"><img src="/img/jpg/img8.jpg" alt="" title=""><span>MacBookPro</span></a></div>pagination_item
         <div class="col-md-2 col-xs-6 pagination_item"><a href="#"><img src="/img/jpg/img9.jpg" alt="" title=""><span>iMac</span></a></div>pagination_item
         <div class="col-md-2 col-xs-6 pagination_item"><a href="#"><img src="/img/jpg/img10.jpg" alt="" title=""><span>MacPro</span></a></div>pagination_item
         <div class="col-md-2 col-xs-6 pagination_item last_item"><a href="#"><img src="/img/jpg/img10.jpg" alt="" title=""><span>MacPro</span></a></div>pagination_item
         <div class="col-md-1"></div>
      
      </div> -->
      <!-- row end -->
   </div>
   <!-- container end -->
</div>
<!-- iMac_pagination end -->
<?php endif;?>