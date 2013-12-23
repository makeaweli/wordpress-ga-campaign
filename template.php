<?php
global $metabox;
    function get_campaign_url($post_url, $source, $medium, $campaign) {
      $timestamp = get_the_date('Ymd');
      $slug = basename(get_permalink());
      global $post;
      $slug = $post->post_name;

      switch($campaign) {
        case '':
            return sprintf('%s?utm_source=%s&utm_medium=%s&utm_campaign=%s-%s', $post_url, $source, $medium, $timestamp, $slug);
        break; 

        default: 
            return sprintf('%s?utm_source=%s&utm_medium=%s&utm_campaign=%s', $post_url, $source, $medium, $campaign);
        break;  
      }
      
    }
?>
<div class="my_meta_control">
    <?php $metabox->the_field('campaign_name'); ?>
    <img src="<?php echo MYPLUGIN_PLUGIN_URL . '/images/facebook.png'; ?>" width="25"/>
    <input type="text" name="facebook-campaign" value="<?php echo get_campaign_url(get_permalink( $post->ID ), 'facebook', 'social', $metabox->get_the_value() ); ?>" />

    <br />
    <img src="<?php echo MYPLUGIN_PLUGIN_URL . '/images/twitter.png'; ?>" width="25"/>
    <input type="text" name="facebook-campaign" value="<?php echo get_campaign_url(get_permalink( $post->ID ), 'twitter', 'social', $metabox->get_the_value() ); ?>" />

    <br />
    <img src="<?php echo MYPLUGIN_PLUGIN_URL . '/images/pinterest.png'; ?>" width="25"/>
    <input type="text" name="facebook-campaign" value="<?php echo get_campaign_url(get_permalink( $post->ID ), 'pinterest', 'social', $metabox->get_the_value() ); ?>"  />
 
    <p><a href="#" id="view-custom-campaign-name">Custom Campaign Name</a></p>
        <?php $metabox->the_field('campaign_name'); ?>
        <input type="text" id="custom-campaign-name" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="<?php echo ($metabox->the_value() == '') ?'hidden' : ''  ?>" />

</div>

<script type="text/javascript">
    jQuery( document ).ready(function() {
        jQuery('#view-custom-campaign-name').click(function() {

            jQuery('#custom-campaign-name').toggle();
            return false;
        });
    });
</script>