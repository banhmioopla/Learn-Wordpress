<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 

ob_start(); 
?>
                                      
                                        <optgroup label="Common Language"> 
                                            <option value="en_US" <?php if(!is_array(_ppt('languages'))){ echo "selected=selected"; } ?> data-icon="lang lang-en region region-us">English (United States)</option> 
                                         <option value="es_ES" data-icon="lang lang-es region region-es">Spanish</option> 
                                            <option value="fr_FR" data-icon="lang lang-fr region region-fr">French</option> 
                                            
                                             <option value="zh_CN" data-icon="lang lang-zh region region-cn">Chinese</option> 
                                              <option value="de_DE" data-icon="lang lang-de region region-de">German</option> 
                                              <option value="ru_RU" data-icon="lang lang-ru region region-ru">Russian</option> 
                                                <option value="ar" data-icon="lang lang-ar">Arabic</option> 
                                                <option value="ja" data-icon="lang lang-ja">Japanese</option> 
                                        </optgroup>
                                        <optgroup label="Available languages"> 
                                            <option value="ary" data-icon="lang lang-ary">Moroccan Arabic</option> 
                                          
                                            <option value="az" data-icon="lang lang-az">Azerbaijani</option> 
                                            <option value="azb" data-icon="lang lang-azb">South Azerbaijani</option> 
                                            <option value="bg_BG" data-icon="lang lang-bg region region-bg">Bulgarian</option> 
                                            <option value="bn_BD" data-icon="lang lang-bn region region-bd">Bengali</option> 
                                            <option value="bo" data-icon="lang lang-bo">Tibetan</option> 
                                            <option value="bs_BA" data-icon="lang lang-bs region region-ba">Bosnian</option> 
                                            <option value="ca" data-icon="lang lang-ca">Catalan</option> 
                                            <option value="ceb" data-icon="lang lang-ceb">Cebuano</option> 
                                            <option value="cs_CZ" data-icon="lang lang-cs region region-cz">Czech</option> 
                                            <option value="cy" data-icon="lang lang-cy">Welsh</option> 
                                            <option value="da_DK" data-icon="lang lang-da region region-dk">Danish</option> 
                                            <option value="de_CH_informal" data-icon="lang lang-de region region-ch variant variant-informal">German (Switzerland, Informal)</option> 
                                            <option value="de_DE_formal" data-icon="lang lang-de region region-de variant variant-formal">German (Formal)</option> 
                                           
                                            <option value="de_CH" data-icon="lang lang-de region region-ch">German (Switzerland)</option> 
                                            <option value="el" data-icon="lang lang-el">Greek</option> 
                                            <option value="en_CA" data-icon="lang lang-en region region-ca">English (Canada)</option> 
                                            <option value="en_NZ" data-icon="lang lang-en region region-nz">English (New Zealand)</option> 
                                            <option value="en_AU" data-icon="lang lang-en region region-au">English (Australia)</option> 
                                            <option value="en_GB" data-icon="lang lang-en region region-gb">English (UK)</option> 
                                            <option value="en_ZA" data-icon="lang lang-en region region-za">English (South Africa)</option> 
                                            <option value="eo" data-icon="lang lang-eo">Esperanto</option> 
                                            <option value="es_MX" data-icon="lang lang-es region region-mx">Spanish (Mexico)</option> 
                                            <option value="es_AR" data-icon="lang lang-es region region-ar">Spanish (Argentina)</option> 
                                            <option value="es_CL" data-icon="lang lang-es region region-cl">Spanish (Chile)</option> 
                                            <option value="es_GT" data-icon="lang lang-es region region-gt">Spanish (Guatemala)</option> 
                                            <option value="es_CO" data-icon="lang lang-es region region-co">Spanish (Colombia)</option> 
                                            <option value="es_VE" data-icon="lang lang-es region region-ve">Spanish (Venezuela)</option> 
                                            <option value="es_PE" data-icon="lang lang-es region region-pe">Spanish (Peru)</option> 
                                           
                                            <option value="et" data-icon="lang lang-et">Estonian</option> 
                                            <option value="eu" data-icon="lang lang-eu">Basque</option> 
                                            <option value="fa_IR" data-icon="lang lang-fa region region-ir">Persian</option> 
                                            <option value="fi" data-icon="lang lang-fi">Finnish</option> 
                                            <option value="fr_BE" data-icon="lang lang-fr region region-be">French (Belgium)</option> 
                                            <option value="fr_CA" data-icon="lang lang-fr region region-ca">French (Canada)</option> 
                                         
                                            <option value="gd" data-icon="lang lang-gd">Scottish Gaelic</option> 
                                            <option value="gl_ES" data-icon="lang lang-gl region region-es">Galician</option> 
                                            <option value="gu" data-icon="lang lang-gu">Gujarati</option> 
                                            <option value="haz" data-icon="lang lang-haz">Hazaragi</option> 
                                            <option value="he_IL" data-icon="lang lang-he region region-il">Hebrew</option> 
                                            <option value="hi_IN" data-icon="lang lang-hi region region-in">Hindi</option> 
                                            <option value="hr" data-icon="lang lang-hr">Croatian</option> 
                                            <option value="hu_HU" data-icon="lang lang-hu region region-hu">Hungarian</option> 
                                            <option value="hy" data-icon="lang lang-hy">Armenian</option> 
                                            <option value="id_ID" data-icon="lang lang-id region region-id">Indonesian</option> 
                                            <option value="is_IS" data-icon="lang lang-is region region-is">Icelandic</option> 
                                            <option value="it_IT" data-icon="lang lang-it region region-it">Italian</option> 
                                            
                                            <option value="ka_GE" data-icon="lang lang-ka region region-ge">Georgian</option> 
                                            <option value="ko_KR" data-icon="lang lang-ko region region-kr">Korean</option> 
                                            <option value="lt_LT" data-icon="lang lang-lt region region-lt">Lithuanian</option> 
                                            <option value="lv" data-icon="lang lang-lv">Latvian</option> 
                                            <option value="mk_MK" data-icon="lang lang-mk region region-mk">Macedonian</option> 
                                            <option value="mr" data-icon="lang lang-mr">Marathi</option> 
                                            <option value="ms_MY" data-icon="lang lang-ms region region-my">Malay</option> 
                                            <option value="my_MM" data-icon="lang lang-my region region-mm">Myanmar (Burmese)</option> 
                                            <option value="nb_NO" data-icon="lang lang-nb region region-no">Norwegian (Bokmal)</option> 
                                            <option value="nl_NL_formal" data-icon="lang lang-nl region region-nl variant variant-formal">Dutch (Formal)</option> 
                                            <option value="nl_NL" data-icon="lang lang-nl region region-nl">Dutch</option> 
                                            <option value="nn_NO" data-icon="lang lang-nn region region-no">Norwegian (Nynorsk)</option> 
                                            <option value="oci" data-icon="lang lang-oci">Occitan</option> 
                                            <option value="pl_PL" data-icon="lang lang-pl region region-pl">Polish</option> 
                                            <option value="ps" data-icon="lang lang-ps">Pashto</option> 
                                            <option value="pt_PT" data-icon="lang lang-pt region region-pt">Portuguese (Portugal)</option> 
                                            <option value="pt_BR" data-icon="lang lang-pt region region-br">Portuguese (Brazil)</option> 
                                            <option value="ro_RO" data-icon="lang lang-ro region region-ro">Romanian</option> 
                                            
                                            <option value="sk_SK" data-icon="lang lang-sk region region-sk">Slovak</option> 
                                            <option value="sl_SI" data-icon="lang lang-sl region region-si">Slovenian</option> 
                                            <option value="sq" data-icon="lang lang-sq">Albanian</option> 
                                            <option value="sr_RS" data-icon="lang lang-sr region region-rs">Serbian</option> 
                                            <option value="sv_SE" data-icon="lang lang-sv region region-se">Swedish</option> 
                                            <option value="szl" data-icon="lang lang-szl">Silesian</option> 
                                            <option value="th" data-icon="lang lang-th">Thai</option> 
                                            <option value="tl" data-icon="lang lang-tl">Tagalog</option> 
                                            <option value="tr_TR" data-icon="lang lang-tr region region-tr">Turkish</option> 
                                            <option value="ug_CN" data-icon="lang lang-ug region region-cn">Uighur</option> 
                                            <option value="uk" data-icon="lang lang-uk">Ukrainian</option> 
                                            <option value="vi" data-icon="lang lang-vi">Vietnamese</option> 
                                            <option value="zh_HK" data-icon="lang lang-zh region region-hk">Chinese (Hong Kong)</option> 
                                            <option value="zh_TW" data-icon="lang lang-zh region region-tw">Chinese (Taiwan)</option> 
                                           
                                        </optgroup>
<?php


$languagelist = ob_get_clean(); 
$flaglist = $languagelist;
if(_ppt('languages') != "" && is_array(_ppt('languages')) ){
	foreach(_ppt('languages') as $lang){
 
		$languagelist  = str_replace(''.$lang.'"', ''.$lang.'" selected=selected',$languagelist );
	}
}

?> 
 
<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

        <?php if(!function_exists('loco_plugin_version')){ ?>
<a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=loco-translate&amp;TB_iframe=true&amp;width=772&amp;height=513" class="btn btn-primary btn-sm float-right">Install Language Editor</a>


<?php } ?>
         <h4><span>Languages</span></h4>
      </div>

 
 
 
<div class="container px-0">
<div class="row py-2">

    <div class="col-6">
    
        <label class="txt500">Language Switcher</label>
        
        <p class="text-muted">Turn on/off the display of the language switching button.</p>
        

        
    </div>
    
    <div class="col-6">
    
    
 
                                <div class="mt-4">
 
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('language_dropdown').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('language_dropdown').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('language_dropdown') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
  
  
   <input type="hidden" id="language_dropdown" name="admin_values[language_dropdown]" value="<?php echo _ppt('language_dropdown'); ?>">
    </div> 
    
</div>
</div>




 
<!-- ------------------------- -->
 
<div class="container px-0">
<div class="row py-2">

    <div class="col-6">
    
        <label class="txt500">Default Language Icon</label>
        
        <p class="text-muted">Here you can choose the flag icon for the default language.</p>
        
    </div>
    
    <div class="col-6">
    
    <select name="admin_values[flagicon]" class="form-control"><?php

	if( _ppt('flagicon') != ""){
		$flaglist  = str_replace(''._ppt('flagicon').'"', ''._ppt('flagicon').'" selected=selected', $flaglist );		
	}
	
	echo $flaglist;
	
	 ?></select>

  
    
	</div>
    
</div>
</div>
 
<!-- ------------------------- -->







 
<!-- ------------------------- -->
 
<div class="container px-0">
<div class="row py-2">

    <div class="col-6">
    
        <label class="txt500">Display Languages</label>
        
        <p class="text-muted">Press and hold CTRL to select multiple values.</p>
        
    </div>
    
    <div class="col-6">
    
    <select name="admin_values[languages][]" class="chzn-select11" multiple="multiple" style="width:300px; height:500px;"><?php echo $languagelist; ?></select>

  
    
	</div>
    
</div>
</div>
 
<!-- ------------------------- -->

  
 




<?php /*
 
if(_ppt('languages') != "" && is_array(_ppt('languages')) ){

?>

    <div class="card">
    <div class="card-header">
    
    	<span>Home Page Links</span>
    
    </div>
    <div class="card-body">
    <?php foreach(_ppt('languages') as $lang){ $lang = strtolower($lang); ?>
    <div class="row mb-1">
        <div class="col-md-4">
        <label>Home Page (<?php echo $lang ?>)</label>
        </div>
        <div class="col-md-8">
        <input type="text" class="form-control" value="<?php echo _ppt('home_link_'.$lang); ?>" name="admin_values[home_link_<?php echo $lang; ?>]" />
        </div>
    </div>
    <?php } ?>
    </div></div>

<?php } */ ?> 
 





</div></div>

<div class="col-lg-4">



        <div class="bg-white shadow" style="border-radius: 7px;">
        	
            <div class="p-5 text-center">
            
            <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/icon3.png" class="img-fluid mb-4" />
            
        	<h5 class="mb-3">Language Setup</h5>
            
            <p style="font-size:16px;" class="text-muted">Learn how to setup pages in this quick video tutorial.</p>
            </div>
        
            <div class="btnbox bg-light text-center p-3 py-4" style="border-radius: 7px;">
            
            <a href="https://www.youtube.com/watch?v=G68QcvQ1U40" class="btn btn-dark">Watch Tutorial</a>
            
            </div>
        
        </div>


</div>


</div>

<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 