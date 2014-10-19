<?php
/**
 * Theme custom metaboxes
 **/

// Custom metabox for pages title
function pages_settings_box() {

    $screens = array( 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'pages_settings_box',
            __( 'Page settings', 'flatmarket' ),
            'pages_settings_inner_box',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'pages_settings_box' );

function pages_settings_inner_box( $post ) {

  wp_enqueue_script('wp-color-picker');
  wp_enqueue_style( 'wp-color-picker' );

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'pages_settings_inner_box', 'pages_settings_inner_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value_page_class = get_post_meta( $post->ID, '_page_class_value', true );
  $value_page_bgcolor = get_post_meta( $post->ID, '_page_bgcolor_value', true );

  $value_page_fullwidth = get_post_meta( $post->ID, '_page_fullwidth_value', true );
  $value_page_notdisplaytitle = get_post_meta( $post->ID, '_page_notdisplaytitle_value', true );

  $value_page_sidebarposition = get_post_meta( $post->ID, '_page_sidebarposition_value', true );

  echo '<label for="page_class" style="width: 130px; display:inline-block;">';
       _e( "Page CSS class: ", 'flatmarket' );
  echo '</label> ';
  echo '<input type="text" id="page_class" name="page_class" value="' . esc_attr( $value_page_class ) . '" style="width: 100%" />';
  
  $checked = '';
  if( $value_page_fullwidth == true ) { 
    $checked = 'checked = "checked"';
  }
  echo '<p><input type="checkbox" id="page_fullwidth" name="page_fullwidth" '.$checked.' /> <label for="page_fullwidth">'.__( "Display this page content fullwidth", 'flatmarket' ).'</label></p>';

  $checked = '';
  if( $value_page_notdisplaytitle == true ) { 
    $checked = 'checked = "checked"';
  }
  echo '<p><input type="checkbox" id="page_notdisplaytitle" name="page_notdisplaytitle" '.$checked.' /> <label for="page_notdisplaytitle">'.__( "Don't display this page title (only show page content)", 'flatmarket' ).'</label></p>';

  $selected_1 = '';
  $selected_2 = '';
  $selected_3 = '';
  $selected_4 = '';

  if($value_page_sidebarposition == 0) {
    $selected_1 = ' selected';
  }
  if($value_page_sidebarposition == "left") {
    $selected_2 = ' selected';
  }
  if($value_page_sidebarposition == "right") {
    $selected_3 = ' selected';
  }
  if($value_page_sidebarposition == "disable") {
    $selected_4 = ' selected';
  }
  
  echo '<p><label for="page_sidebarposition" style="display: inline-block; width: 150px;">'.__( "Page sidebar position: ", 'flatmarket' ).'</label>';
  echo '<select name="page_sidebarposition" id="page_sidebarposition">
        <option value="0"'.$selected_1.'>'.__( "Use theme control panel settings", 'flatmarket' ).'</option>
        <option value="left"'.$selected_2.'>'.__( "Left", 'flatmarket' ).'</option>
        <option value="right"'.$selected_3.'>'.__( "Right", 'flatmarket' ).'</option>
        <option value="disable"'.$selected_4.'>'.__( "Disable sidebar", 'flatmarket' ).'</option>
    </select></p>';

  echo '<label for="page_bgcolor" style="display: inline-block; height: 40px;">'.__( "Page background color: ", 'flatmarket' ).'</label> &nbsp;';
  echo '<input type="text" id="page_bgcolor" name="page_bgcolor" value="' . esc_attr( $value_page_bgcolor ) . '" style="width: auto; height:25px;" />';
 
  echo "<script type=\"text/javascript\">    jQuery(document).ready(function($) {    $('#page_bgcolor').wpColorPicker(); }); </script>";

}

function page_settings_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['pages_settings_inner_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['pages_settings_inner_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'pages_settings_inner_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['page_class'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_page_class_value', $mydata );

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['page_bgcolor'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_page_bgcolor_value', $mydata );

  // Sanitize user input.
  if(!isset($_POST['page_fullwidth'])) $_POST['page_fullwidth'] = false;
  
  $mydata = sanitize_text_field( $_POST['page_fullwidth'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_page_fullwidth_value', $mydata );

  // Sanitize user input.
  if(!isset($_POST['page_notdisplaytitle'])) $_POST['page_notdisplaytitle'] = false;
  
  $mydata = sanitize_text_field( $_POST['page_notdisplaytitle'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_page_notdisplaytitle_value', $mydata );

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['page_sidebarposition'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_page_sidebarposition_value', $mydata );

}
add_action( 'save_post', 'page_settings_save_postdata' );

// BLOG POST META BOX
function post_settings_box() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'post_settings_box',
            __( 'Post settings', 'flatmarket' ),
            'post_settings_inner_box',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'post_settings_box' );

function post_settings_inner_box( $post ) {

  wp_enqueue_script('wp-color-picker');
  wp_enqueue_style( 'wp-color-picker' );

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'post_settings_inner_box', 'post_settings_inner_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value_post_bgcolor = get_post_meta( $post->ID, '_post_bgcolor_value', true );
  $value_post_fullwidth = get_post_meta( $post->ID, '_post_fullwidth_value', true );
  $value_post_sidebarposition = get_post_meta( $post->ID, '_post_sidebarposition_value', true );

  $checked = '';
  if( $value_post_fullwidth == true ) { 
    $checked = 'checked = "checked"';
  }
  echo '<p><input type="checkbox" id="post_fullwidth" name="post_fullwidth" '.$checked.' /> <label for="post_fullwidth">'.__( "Display this post content fullwidth", 'flatmarket' ).'</label></p>';

  $value_post_socialshare_disable = get_post_meta( $post->ID, '_post_socialshare_disable_value', true );

  $checked = '';
  if( $value_post_socialshare_disable == true ) { 
    $checked = 'checked = "checked"';
  }

  echo '<p><input type="checkbox" id="post_socialshare_disable" name="post_socialshare_disable" '.$checked.' /> <label for="post_socialshare_disable">'.__( "Disable social share counters and buttons on this post", 'flatmarket' ).'</label></p>';

  $selected_1 = '';
  $selected_2 = '';
  $selected_3 = '';
  $selected_4 = '';

  if($value_post_sidebarposition == 0) {
    $selected_1 = ' selected';
  }
  if($value_post_sidebarposition == "left") {
    $selected_2 = ' selected';
  }
  if($value_post_sidebarposition == "right") {
    $selected_3 = ' selected';
  }
  if($value_post_sidebarposition == "disable") {
    $selected_4 = ' selected';
  }
  
  echo '<p><label for="post_sidebarposition" style="display: inline-block; width: 150px;">'.__( "Post sidebar position: ", 'flatmarket' ).'</label>';
  echo '<select name="post_sidebarposition" id="post_sidebarposition">
        <option value="0"'.$selected_1.'>'.__( "Use theme control panel settings", 'flatmarket' ).'</option>
        <option value="left"'.$selected_2.'>'.__( "Left", 'flatmarket' ).'</option>
        <option value="right"'.$selected_3.'>'.__( "Right", 'flatmarket' ).'</option>
        <option value="disable"'.$selected_4.'>'.__( "Disable sidebar", 'flatmarket' ).'</option>
    </select></p>';

  echo '<label for="post_bgcolor" style="display: inline-block; height: 40px;">'.__( "Post background color: ", 'flatmarket' ).'</label> &nbsp;';
  echo '<input type="text" id="post_bgcolor" name="post_bgcolor" value="' . esc_attr( $value_post_bgcolor ) . '" style="width: auto; height:25px;" />';
 
  echo "<script type=\"text/javascript\">    jQuery(document).ready(function($) {    $('#post_bgcolor').wpColorPicker(); }); </script>";

}

function post_settings_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['post_settings_inner_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['post_settings_inner_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'post_settings_inner_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['post_bgcolor'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_post_bgcolor_value', $mydata );

  // Sanitize user input.
  if(!isset($_POST['post_fullwidth'])) $_POST['post_fullwidth'] = false;
  
  $mydata = sanitize_text_field( $_POST['post_fullwidth'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_post_fullwidth_value', $mydata );

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['post_sidebarposition'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_post_sidebarposition_value', $mydata );

  if(!isset($_POST['post_socialshare_disable'])) $_POST['post_socialshare_disable'] = false;
  
   // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['post_socialshare_disable'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_post_socialshare_disable_value', $mydata );

}
add_action( 'save_post', 'post_settings_save_postdata' );


