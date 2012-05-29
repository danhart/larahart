<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );
add_action( 'admin_enqueue_scripts', 'theme_options_add_scripts' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
  register_setting( 'changeme_options', 'changeme_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
  add_theme_page( __( 'Theme Options', 'changeme' ), __( 'Theme Options', 'changeme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Add our JS to the WP Admin
 */
function theme_options_add_scripts() {
  wp_enqueue_script('changeme-theme-options-js', get_template_directory_uri() . '/js/category_theme_options.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'));
}

/**
 * Create the options page
 */
function theme_options_do_page() {
  if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;

  ?>
  <div class="wrap">
    <?php screen_icon(); echo "<h2>" . __( ' Theme Options', 'changeme' ) . "</h2>"; ?>

    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
    <div class="updated fade"><p><strong><?php _e( 'Options saved', 'changeme' ); ?></strong></p></div>
    <?php endif; ?>

    <form method="post" action="options.php">
      <?php settings_fields( 'changeme_options' ); ?>
      <?php $options = get_option( 'changeme_theme_options' ); ?>

      <table class="form-table">

        <?php
        /**
         * A changeme text input option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Latest Post Categories', 'changeme' ); ?></th>
          <td>
            <?php 
              // Get WP Categories and convert to our theme option array format
              // By default this orders by Category Name ASC
              $getCategories = get_categories( array(
                'hide_empty'  => false
              ) ); 
              $count = 0;
              foreach ($getCategories as $category) {
                $wpCategories['cat-' . $category->term_id] = array (
                  'category_id' => $category->term_id,
                  'order'       => $count
                );
                $count++;
              } 

              // Get Saved Categories
              $savedCategories = (isset($options['latestpostcats'])) ? $options['latestpostcats'] : array();

              // Combine WP Categories with Saved Categories
              $categories = array_merge($wpCategories, $savedCategories);

              // Sort the Categories by categoryOrder ASC
              foreach ($categories as $key => $category) {
                $categoryOrder[$key] = $category['order'];
              }
              array_multisort($categoryOrder, SORT_ASC, $categories);
            ?>
            <div class="categorydiv" style="width: 280px;">
              <div class="tabs-panel">
                <ul id="latestpostcategorylist" class="list:category categorychecklist form-no-clear">
                  <?php foreach ($categories as $category): ?>
                  <?php $categoryDetails = get_term_by('id', $category['category_id'], 'category'); ?>
                  <li id="category-<?php echo $category['category_id']; ?>">
                    <label class="selectit">
                      <input value="checked" type="checkbox" name="changeme_theme_options[latestpostcats][cat-<?php echo $category['category_id'] ?>][checked]" <?php if (isset($category['checked'])) echo 'checked="checked"' ?> /><?php echo $categoryDetails->name . ' (' . $categoryDetails->count . ')'; ?>
                      <input class="category-order" value="<?php echo $category['order']; ?>" type="hidden" name="changeme_theme_options[latestpostcats][cat-<?php echo $category['category_id'] ?>][order]" />
                      <input value="<?php echo $category['category_id']; ?>" type="hidden" name="changeme_theme_options[latestpostcats][cat-<?php echo $category['category_id'] ?>][category_id]" />
                    </label>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </td>
        </tr>

        <?php
        /**
         * A changeme text input option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Featured Video Width', 'changeme' ); ?></th>
          <td>
            <input id="changeme_theme_options[featuredvideowidth]" class="regular-text" type="text" name="changeme_theme_options[featuredvideowidth]" value="<?php esc_attr_e( $options['featuredvideowidth'] ); ?>" />
            <label class="description" for="changeme_theme_options[featuredvideowidth]"><?php _e( 'Width of the featured video displayed at the top of posts', 'changeme' ); ?></label>
          </td>
        </tr>

        <?php
        /**
         * A changeme text input option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Featured Video Height', 'changeme' ); ?></th>
          <td>
            <input id="changeme_theme_options[featuredvideoheight]" class="regular-text" type="text" name="changeme_theme_options[featuredvideoheight]" value="<?php esc_attr_e( $options['featuredvideoheight'] ); ?>" />
            <label class="description" for="changeme_theme_options[featuredvideoheight]"><?php _e( 'Height of the featured video displayed at the top of posts', 'changeme' ); ?></label>
          </td>
        </tr>

        <?php
        /**
         * A changeme checkbox option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Display Featured Posts Section On The Home Page?', 'changeme' ); ?></th>
          <td>
            <input id="changeme_theme_options[featuredpostsenabled]" name="changeme_theme_options[featuredpostsenabled]" type="checkbox" value="1" <?php checked( '1', $options['featuredpostsenabled'] ); ?> />
            <label class="description" for="changeme_theme_options[featuredpostsenabled]"><?php _e( '(this refers to the block that appears between the blog navigation and post list)', 'changeme' ); ?></label>
          </td>
        </tr>

        <?php
        /**
         * A changeme checkbox option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Display Latest Posts Section On the Home Page?', 'changeme' ); ?></th>
          <td>
            <input id="changeme_theme_options[latestpostsenabled]" name="changeme_theme_options[latestpostsenabled]" type="checkbox" value="1" <?php checked( '1', $options['latestpostsenabled'] ); ?> />
            <label class="description" for="changeme_theme_options[latestpostsenabled]"><?php _e( '(this refers to the block that appears between the blog navigation and post list)', 'changeme' ); ?></label>
          </td>
        </tr>

        <?php
        /**
         * A changeme checkbox option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Display Social Media Buttons?', 'changeme' ); ?></th>
          <td>
            <input id="changeme_theme_options[socialmediaenabled]" name="changeme_theme_options[socialmediaenabled]" type="checkbox" value="1" <?php checked( '1', $options['socialmediaenabled'] ); ?> />
            <label class="description" for="changeme_theme_options[socialmediaenabled]"><?php _e( 'Whether to show the facebook/twitter/pinterest/google+ buttons for each post', 'changeme' ); ?></label>
          </td>
        </tr>

        <?php
        /**
         * A changeme checkbox option
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Enable Google Analytics?', 'changeme' ); ?></th>
          <td>
            <input id="changeme_theme_options[googleanalyticsenabled]" name="changeme_theme_options[googleanalyticsenabled]" type="checkbox" value="1" <?php checked( '1', $options['googleanalyticsenabled'] ); ?> />
          </td>
        </tr>
      </table>

      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'changeme' ); ?>" />
      </p>
    </form>
  </div>
  <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
  // Say our text option must be safe text with no HTML tags
  $input['featuredvideowidth'] = wp_filter_nohtml_kses( $input['featuredvideowidth'] );
  $input['featuredvideoheight'] = wp_filter_nohtml_kses( $input['featuredvideoheight'] );
  
  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['featuredpostsenabled'] ) ) $input['featuredpostsenabled'] = null;
  $input['featuredpostsenabled'] = ( $input['featuredpostsenabled'] == 1 ? 1 : 0 );
  
  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['latestpostsenabled'] ) ) $input['latestpostsenabled'] = null;
  $input['latestpostsenabled'] = ( $input['latestpostsenabled'] == 1 ? 1 : 0 );

  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['socialmediaenabled'] ) ) $input['socialmediaenabled'] = null;
  $input['socialmediaenabled'] = ( $input['socialmediaenabled'] == 1 ? 1 : 0 );

  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['googleanalyticsenabled'] ) ) $input['googleanalyticsenabled'] = null;
  $input['googleanalyticsenabled'] = ( $input['googleanalyticsenabled'] == 1 ? 1 : 0 );

  return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
