<?php

add_action('admin_menu', 'ga_campaign_admin_menu');

function ga_campaign_admin_menu() {
    $page_title = 'Google Analytics Campaign Settings';
    $menu_title = 'GA Campaign';
    $capability = 'manage_options';
    $menu_slug = 'options-ga-campaign';
    $function = 'ga_campaign_settings';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}

// Insert into DB
function ga_campaign_insert($data) {
  global $wpdb;
  $table = $wpdb->prefix . 'ga_campaigns';

  $wpdb->insert(
    $table,
    array(
      'source' => $data['source'],
      'medium' => $data['medium'],
      'icon_url' => $data['icon_url']
    )
  );
}

// Delete from DB
function ga_campaign_delete($data) {
  global $wpdb;
  $table = $wpdb->prefix . 'ga_campaigns';

  $wpdb->delete(
    $table,
    array(
      'id' => $data['id'],
    )
  );
}

function ga_campaign_settings() {
  if (!current_user_can('manage_options')) {
      wp_die('You do not have sufficient permissions to access this page.');
  }

  global $wpdb;
  $table = $wpdb->prefix . 'ga_campaigns';
  $form_data = $_REQUEST['ga-campaign'];
  switch($_REQUEST['ga-campaign']['action']) {
    
    case 'create':
      ga_campaign_insert($form_data);
    break;

    case 'delete':
      ga_campaign_delete($form_data);
    break;
  }

// Get all campaigns
$campaigns = $wpdb->get_results( "SELECT * FROM $table" );

?>
<div class="wrap">
  <div id="icon-options-general" class="icon32"><br></div>
  <h2>Google Analtyics Campaign Settings</h2>

  <h3>Campaign Sources</h3>
  <table class="wp-list-table widefat plugins">
    <thead>
      <tr>
        <th>Icon</th>
        <th>Name</th>
        <th>Medium</th>
        <th>&nbsp;</th>
      </tr>
    </thead>

    <tfoot>
      <tr>
        <th>Icon</th>
        <th>Name</th>
        <th>Medium</th>
        <th>&nbsp;</th>
      </tr>
    </tfoot>

    <tbody id="the-list">

<?php foreach($campaigns as $campaign) {
echo <<<HEREDOC
      <tr>
        <td><img src="{$campaign->icon_url}" width="25" /></td>
        <td>{$campaign->source}</td>
        <td>{$campaign->medium}</td>
        <td><a href="options-general.php?page=options-ga-campaign&ga-campaign[action]=delete&ga-campaign[id]={$campaign->id}">Delete</a></td>
      </tr>
HEREDOC;
}
?>
    </tbody>
  </table>

</div>

<h3>Add New Campaign Source</h3>
<form action="options-general.php?page=options-ga-campaign" method="post">
  <input type="hidden" name="ga-campaign[action]" value="create" />

<table class="form-table">
  <tbody>
  <tr>
    <th><label>Source</label></th>
    <td><input type="text" name="ga-campaign[source]" placeholder="Facebook" /></td>
  </tr>

  <tr>
    <th><label>Medium</label></th>
    <td><input type="text" name="ga-campaign[medium]" placeholder="social" /></td>
  </tr>

  <tr>
    <th><label>Icon URL</label></th>
    <td><input type="text" name="ga-campaign[icon_url]" /></td>
  </tr>  

</tbody></table>

  <?php submit_button('Create') ?>
</form>

<?php
print_r($_POST['ga-campaign']);
}
?>