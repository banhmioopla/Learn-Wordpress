<?php

class Widget_PremiumPress_Logo extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'logo';
	}
 
	public function get_title() {
		return __( '{ Logo }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'layout-logo';
	} 
	public function get_categories() {
		return [ 'premiumpress-header' ];
	} 
	protected function _register_controls() {
 		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();		
		
		?>
         <div class="logo" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
            <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
            <?php if(isset($settings['transparent']) && $settings['transparent'] == 1){  echo hook_logo(array(0,1)); }else{ echo hook_logo(0); } ?>
            </a>
         </div>
        <?php
		
	}

}