<?php

global $settings;

 
?> 

<style>
.category-2.cat2style-1 .vertical-middle-box { height:100%;  }
.category-2.cat2style-1 .grid-item {  border: 1px solid #dbdbdb; }
.category-2.cat2style-1 .grid-item a { text-decoration:none;    }
.category-2.cat2style-1 .grid-item a:after { position: absolute;    left: 0;    top: 0;    width: 100%;    height: 100%;    background: rgba(255, 255, 255, 0.7);    content: "";}
.category-2.cat2style-1 .grid-item:hover a:after { background: rgba(255, 255, 255, 0); color:#333333;  }
.category-2.cat2style-1 .grid-item:hover .vertical-middle { color:#333333; border: 1px solid #333333;  }
.category-2.cat2style-1 .vertical-middle {
    position: absolute;
    z-index: 100;
    width: 93%;
    border: 1px solid #dbdbdb;
    margin: 10px;
    height: 92%;
    padding: 20px;
    color: #666666;
}
</style>
 
<div class="category-2 cat2style-<?php echo $settings['style']; ?>">
<div class="grid-wrapper">
<?php
 
	$i = 1; $n = 1; $cat=1; $offset = 0; $sampledata = array();
		
		if(isset($settings['offset'])){ $offset = $settings['offset']; }
		if(isset($settings['sampledata'])){ $sampledata = $settings['sampledata']; }
		
		$args = array(
			'taxonomy'     => THEME_TAXONOMY,
			'orderby' 		=> $settings['orderby'], 
			'order' 		=> $settings['order'], 
			'show_count'   => 0,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'title_li'     => '',
			'hide_empty'   => 0,
			 
		);
$cats = get_categories($args);

$i=0; $shown=1;
foreach ($cats as $category) { 
 
		// HIDE PARENT
		if($category->parent != 0){ continue; }
		
		// SHOW
		if($shown > $settings['show'] ){ $i++;continue; }
		
		// CHECK FOR OFFSET
		if($i < $offset){ $i++; continue; }	 
		
		$shown++;
 
		// LINK 
		$link = get_term_link($category);
		
		// IMAGE
		
		// NAME
		
		
		// NAME
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){
		
		$name = $sampledata[$i]['name'];
		$desc = $sampledata[$i]['desc'];
		$image = $sampledata[$i]['image'];
		
		}else{		
		$name = $category->name;
		$desc = $category->description;
		$image = _ppt('category_icon_'.$category->term_id);		
		}
?>

<?php if($settings['style'] == 1){ ?>

							<div class="grid-item location-image-bg-item " 
                             
                            data-colspan="5" data-rowspan="5"
                           
                            <?php if($image != ""){ ?>style="background-image:url('<?php echo $image; ?>');"<?php } ?>>
								<a href="<?php echo $link; ?>">
									<div class="vertical-middle-box">
										<div class="vertical-middle">
											<h4><?php echo $name; ?></h4>
                                            <?php if(strlen($desc) > 1){ ?>
                                            <p><?php echo $desc; ?></p>
                                            <?php } ?>
										</div>
									</div>
								</a> 
                                

<?php } ?> 
                                

</div>
<?php $i++; } ?>

</div>
</div>
 

<script>
!function(t){var i={defaults:{column:6,gutter:"10px",itemHeight:"100%",itemSelector:".grid-item"},options:{gridWidth:null,gridHeight:null,gridGutter:null,gridItemWidth:null,gridItemHeight:null,gridMap:[],breakpoints:[],rangeValues:[],currentbreakpoint:{},resizeDelay:180,resizeTimeout:null},functions:{isPx:function(t){return t=t.toLowerCase(),~t.indexOf("px")?!0:!1},isPercent:function(t){return t=t.toLowerCase(),~t.indexOf("%")?!0:!1},getPxValue:function(t,o){return size_=parseInt(t),isNaN(size_)&&(size_=0),i.functions.isPercent(t)?Math.floor(o*size_/100):i.functions.isPx(t)?Math.floor(size_):0}}};Grid=function(i,o){this.options={},this.options.grid=t(i),this.init(o)},Grid.prototype={init:function(o){var n=this;t.extend(!0,this.options,i.options),t.extend(!0,this.options,i.defaults),t.extend(!0,this.options,o),t.each(this.options.breakpoints,function(t,i){i.condition=n.parseBreakpoint(t,i.range)}),this.resize(),t(window).resize(function(){null!==n.options.resizeTimeout&&clearTimeout(n.options.resizeTimeout),n.options.resizeTimeout=setTimeout(function(){n.resize()},n.options.resizeDelay)})},resize:function(){var o=this;this.options.resizeTimeout=null,t.each(this.options.breakpoints,function(i,n){n.condition(window.innerWidth)&&n.range!=o.options.currentbreakpoint.range&&(o.options.currentbreakpoint=n,t.extend(!0,o.options,n.options))}),this.options.grid.css({position:"relative"}),this.options.gridWidth=this.options.grid.width(),this.options.gridGutter=i.functions.getPxValue(this.options.gutter,this.options.gridWidth),this.options.gridItemWidth=Math.floor((this.options.gridWidth-(this.options.column-1)*this.options.gridGutter)/this.options.column),this.options.gridItemHeight=i.functions.getPxValue(this.options.itemHeight,this.options.gridItemWidth),this.initMap(),this.calculateMap(),this.renderGrid()},calculateMap:function(){var i=this;this.options.grid.children(this.options.itemSelector).css({position:"absolute"}).each(function(o){var n=t(this).data("colspan")||1,e=t(this).data("rowspan")||1;n=Math.min(n,i.options.column);var s,r,a=!1;for(s=0;s<i.options.gridMap.length;++s){for(r=0;r<i.options.gridMap[s].length;++r)if(i.isFreeMap(s,r,n,e)){i.addBlockToMap(s,r,n,e,{block:this,colspan:n,rowspan:e}),a=!0;break}if(a)break}})},renderGrid:function(){this.removeEmptyRows(),this.options.grid.css({height:this.calculateItemHeight(this.options.gridMap.length)}),document.body.clientWidth<this.options.gridWidth&&this.resize();var i,o;for(i=0;i<this.options.gridMap.length;++i)for(o=0;o<this.options.gridMap[i].length;++o)"object"==typeof this.options.gridMap[i][o]&&t(this.options.gridMap[i][o].block).css({top:this.calculateItemTop(i),left:this.calculateItemLeft(o),width:this.calculateItemWidth(this.options.gridMap[i][o].colspan),height:this.calculateItemHeight(this.options.gridMap[i][o].rowspan)})},initMap:function(){var i=0;this.options.grid.children(this.options.itemSelector).each(function(){i+=t(this).data("rowspan")||1}),this.options.gridMap=new Array(i);var o;for(o=0;o<this.options.gridMap.length;++o)this.options.gridMap[o]=new Array(this.options.column)},removeEmptyRows:function(){var t,i,o=null;for(t=0;t<this.options.gridMap.length;++t){for(o=!0,i=0;i<this.options.gridMap[t].length;++i)if(void 0!==this.options.gridMap[t][i]){o=!1;break}if(o)break}if(o)for(var n=this.options.gridMap.length-1,e=n;e>=t;--e)this.options.gridMap.pop()},isFreeMap:function(t,i,o,n){var e,s,r=!0;if(o>this.options.column-i)r=!1;else for(e=t;t+n>e;++e){for(s=i;i+o>s;++s)if(void 0!==this.options.gridMap[e][s]){r=!1;break}if(!r)break}return r},addBlockToMap:function(t,i,o,n,e){this.options.gridMap[t][i]=e;var s,r;for(s=t;t+n>s;++s)for(r=i;i+o>r;++r)(s!=t||r!=i)&&(this.options.gridMap[s][r]=0)},calculateItemWidth:function(t){return this.options.gridItemWidth*t+this.options.gridGutter*(t-1)},calculateItemHeight:function(t){return this.options.gridItemHeight*t+this.options.gridGutter*(t-1)},calculateItemTop:function(t){return 0===t?0:this.calculateItemHeight(t)+this.options.gridGutter},calculateItemLeft:function(t){return 0===t?0:this.calculateItemWidth(t)+this.options.gridGutter},parseBreakpoint:function(t,i){var o=this;return"string"!=typeof i&&(condition=function(t){return!1}),"*"==i?condition=function(t){return!0}:"-"==i.charAt(0)?(this.options.rangeValues[t]=parseInt(i.substring(1)),condition=function(i){return i<=o.options.rangeValues[t]}):"-"==i.charAt(i.length-1)?(this.options.rangeValues[t]=parseInt(i.substring(0,i.length-1)),condition=function(i){return i>=o.options.rangeValues[t]}):~i.indexOf(i,"-")?(i=i.split("-"),this.options.rangeValues[t]=[parseInt(i[0]),parseInt(i[1])],condition=function(i){return i>=o.options.rangeValues[t][0]&&i<=o.options.rangeValues[t][1]}):(this.options.rangeValues[t]=parseInt(i),condition=function(i){return i==o.options.rangeValues[t]}),condition}},t.fn.responsivegrid=function(t){return"object"==typeof t&&this.each(function(){new Grid(this,t)}),this}}(jQuery); 

jQuery(document).ready(function() {

initResponsiveGrid();

});
function initResponsiveGrid(){
	
	 jQuery('.grid-wrapper').responsivegrid({
			itemSelector : '.grid-item',
			'breakpoints': {
				'desktop' : {
					'range' : '1200-',
					'options' : {
						'column' : 20,
						'gutter' : '20px',
					}
				},
				'tablet-landscape' : {
					'range' : '1000-1200',
					'options' : {
						'column' : 20,
						'gutter' : '20px',
					}
				},
				'tablet-portrate' : {
					'range' : '767-1000',
					'options' : {
						'column' : 20,
						'gutter' : '5px',
					}
				},
				'mobile' : {
					'range' : '-767',
					'options' : {
						'column' : 10,
						'itemHeight' : '40px',
						'gutter' : '15px',
					}
				},
			}
		});
}
</script>