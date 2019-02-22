<?php

function virtuoso_portfolio_register_settings_options_page() {
  add_options_page('Virtuoso Portfolios', 'Virtuoso Portfolios', 'manage_options', 'virtuoso-portfolio', 'virtuoso_portfolio_options_page');
}
add_action('admin_menu', 'virtuoso_portfolio_register_settings_options_page');

function virtuoso_portfolio_register_settings() {
  add_option( 'virtuoso_portfolio_cpt_name_singular', 'Portfolio');
  register_setting( 'virtuoso_portfolio_options_group', 'virtuoso_portfolio_cpt_name_singular', 'virtuoso-portfolio' );
  add_option( 'virtuoso_portfolio_cpt_name_plural', 'Portfolio');
  register_setting( 'virtuoso_portfolio_options_group', 'virtuoso_portfolio_cpt_name_plural', 'virtuoso-portfolio' );
  add_option( 'virtuoso_portfolio_taxonomy_name_singular', 'Style');
  register_setting( 'virtuoso_portfolio_options_group', 'virtuoso_portfolio_taxonomy_name_singular', 'virtuoso-portfolio' );
  add_option( 'virtuoso_portfolio_taxonomy_name_plural', 'Styles');
  register_setting( 'virtuoso_portfolio_options_group', 'virtuoso_portfolio_taxonomy_name_plural', 'virtuoso-portfolio' );
}
add_action( 'admin_init', 'virtuoso_portfolio_register_settings' );

function virtuoso_portfolio_options_page() {

  ?>
  <div>
    <?php screen_icon(); ?>
    <h2>Virtuoso Portfolios</h2>
    <form method="post" action="options.php">
      <?php settings_fields( 'virtuoso_portfolio_options_group' ); ?>
      <h3>Settings</h3>
<!--      <p>Some text here.</p>-->
      <table>
        <tr valign="top">
          <th scope="row"><label for="virtuoso_portfolio_cpt_name_singular">Virtuoso Portfolio CPT Name (Singular):</label></th>
          <td><input type="text" id="virtuoso_portfolio_cpt_name_singular" name="virtuoso_portfolio_cpt_name_singular" value="<?php echo get_option('virtuoso_portfolio_cpt_name_singular'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="virtuoso_portfolio_cpt_name_plural">Virtuoso Portfolio CPT Name (Plural):</label></th>
          <td><input type="text" id="virtuoso_portfolio_cpt_name_plural" name="virtuoso_portfolio_cpt_name_plural" value="<?php echo get_option('virtuoso_portfolio_cpt_name_plural'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="virtuoso_portfolio_taxonomy_name_singular">Virtuoso Portfolio Taxonomy Name (Singular):</label></th>
          <td><input type="text" id="virtuoso_portfolio_taxonomy_name_singular" name="virtuoso_portfolio_taxonomy_name_singular" value="<?php echo get_option('virtuoso_portfolio_taxonomy_name_singular'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="virtuoso_portfolio_taxonomy_name_plural">Virtuoso Portfolio Taxonomy Name (Plural):</label></th>
          <td><input type="text" id="virtuoso_portfolio_taxonomy_name_plural" name="virtuoso_portfolio_taxonomy_name_plural" value="<?php echo get_option('virtuoso_portfolio_taxonomy_name_plural'); ?>" /></td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php

}