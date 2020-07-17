<?php global $settings, $CORE; ?>
<div class="sbox1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <form action="<?php echo home_url(); ?>/" method="get" name="searchform" id="searchform">
      <div class="input-group">
         <button type="submit"><i class="fa fa-search"></i> </button>
         <input type="text" name="s" placeholder="<?php echo __("I'm looking for...","premiumpress") ?>" class="form-control">   
         <div class="input-group-prepend" style="position:relative;">
            <select class="form-control"  name="catid">
               <option><?php echo __("All Categories","premiumpress") ?></option>
               <?php  echo $CORE->CategoryList(array(0,false,0,'listing')); ?>
            </select>
         </div>
      </div>
   </form>
</div>