<?php
if (!defined('WPINC')) {
  exit;
}

class MT_Hotel extends MT_Base_Type {

  public static function init() {

    add_action('init', function () {
      register_post_type('mt_hotels', [
        'labels' => [
          'name' => _x('MT Hotels', 'post type general name', 'montenegro-traveling'),
          'singular_name' => _x('Hotel', 'post type singular name', 'montenegro-traveling'),
          'menu_name' => __('MT Hotels', 'montenegro-traveling'),
          'parent_item_colon' => __('Parent Item:', 'montenegro-traveling'),
          'all_items' => __('Hotels', 'montenegro-traveling'),
          'view_item' => __('View Hotel', 'montenegro-traveling'),
          'add_new_item' => __('Add New Hotel', 'montenegro-traveling'),
          'add_new' => __('Add New Hotel', 'montenegro-traveling'),
          'edit_item' => __('Edit Hotel', 'montenegro-traveling'),
          'update_item' => __('Update Hotel', 'montenegro-traveling'),
          'search_items' => __('Search Hotel', 'montenegro-traveling'),
          'not_found' => __('No room found', 'montenegro-traveling'),
          'not_found_in_trash' => __('No room found in Trash', 'montenegro-traveling'),
        ],
        'description' => 'Post type or hotels',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-building',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => [
          'title',
          'editor',
          'author',
          'thumbnail',
          'excerpt',
          'custom-fields',
          'comments',
          'revisions',
          'post-formats'],
      ]);

      register_taxonomy('hotels-cat', 'mt_hotels', ['public' => true, 'hierarchical' => true,]);

      register_taxonomy('hotels-tag', 'mt_hotels', ['public' => true, 'hierarchical' => false,]);
    });

    add_action('add_meta_boxes', function () {
      add_meta_box('mt_hotel_box', 'Hotel information', function ($post, $meta) {
        $mthm = get_post_meta($post->ID, '_mt_hotels_meta', true);
        wp_nonce_field(plugin_basename(__FILE__), 'mtn_hotels' );
        ?>
        <div class="inbox-wraper">
          <fieldset class="block">
            <legend>Main information:</legend>
            <label class="n1d2">Hotel address <input name="mthm[hotel_address]" type="text" value="<?php echo (isset($mthm['hotel_address'])) ? $mthm['hotel_address'] : ''; ?>"></label>
            <label class="n3d10">City <input name="mthm[city]" type="text" value="<?php echo (isset($mthm['city'])) ? $mthm['city'] : ''; ?>"></label>
            <label class="n2d10">Postcode <input name="mthm[postcode]" type="text" value="<?php echo (isset($mthm['postcode'])) ? $mthm['postcode'] : ''; ?>"></label>
            <label class="n2d4">Responsible person <input name="mthm[responsible_person]" type="text" value="<?php echo (isset($mthm['responsible_person'])) ? $mthm['responsible_person'] : ''; ?>"></label>
            <label class="n2d4">Email <input name="mthm[email]" type="text" value="<?php echo (isset($mthm['email'])) ? $mthm['email'] : ''; ?>"></label>
            <label class="n1d3">Fax <input name="mthm[fax]" type="text" value="<?php echo (isset($mthm['fax'])) ? $mthm['fax'] : ''; ?>"></label>
            <label class="n1d3">Landline phone <input name="mthm[landline_phone]" type="text" value="<?php echo (isset($mthm['landline_phone'])) ? $mthm['landline_phone'] : ''; ?>"></label>
            <label class="n1d3">Mobile phone <input name="mthm[mobile_phone]" type="text" value="<?php echo (isset($mthm['mobile_phone'])) ? $mthm['mobile_phone'] : ''; ?>"></label>
            <span class="break"></span>
          </fieldset>
          <fieldset>
            <legend>Facilities:</legend>
            <label class="n1d5"><input name="mthm[lift]" type="checkbox" <?php echo (isset($mthm['lift'])) ? 'checked="checked"' : ''; ?> value="Lift">Lift</label>
            <label class="n1d5"><input name="mthm[spa_services]" type="checkbox" <?php echo (isset($mthm['spa_services'])) ? 'checked="checked"' : ''; ?> value="SPA services">SPA services</label>
            <label class="n1d5"><input name="mthm[sauna]" type="checkbox" <?php echo (isset($mthm['sauna'])) ? 'checked="checked"' : ''; ?> value="Sauna">Sauna</label>
            <label class="n1d5"><input name="mthm[snack_bar]" type="checkbox" <?php echo (isset($mthm['snack_bar'])) ? 'checked="checked"' : ''; ?> value="Snack bar">Snack bar</label>
            <label class="n1d5"><input name="mthm[rent_a_bike]" type="checkbox" <?php echo (isset($mthm['rent_a_bike'])) ? 'checked="checked"' : ''; ?> value="Rent-a-bike">Rent-a-bike</label>
            <label class="n1d5"><input name="mthm[storage_room]" type="checkbox" <?php echo (isset($mthm['storage_room'])) ? 'checked="checked"' : ''; ?> value="Storage room">Storage room</label>
            <label class="n1d5"><input name="mthm[adapted_for_disabilities]" type="checkbox" <?php echo (isset($mthm['adapted_for_disabilities'])) ? 'checked="checked"' : ''; ?> value="Adapted for disabilities">Adapted for disabilities</label>
            <label class="n1d5"><input name="mthm[outdoor_pool]" type="checkbox" <?php echo (isset($mthm['outdoor_pool'])) ? 'checked="checked"' : ''; ?> value="Outdoor pool">Outdoor pool</label>
            <label class="n1d5"><input name="mthm[grill]" type="checkbox" <?php echo (isset($mthm['grill'])) ? 'checked="checked"' : ''; ?> value="Grill">Grill</label>
            <label class="n1d5"><input name="mthm[atm]" type="checkbox" <?php echo (isset($mthm['atm'])) ? 'checked="checked"' : ''; ?> value="">ATM</label>
            <label class="n1d5"><input name="mthm[currency_exchange]" type="checkbox" <?php echo (isset($mthm['currency_exchange'])) ? 'checked="checked"' : ''; ?> value="Currency exchange">Currency exchange</label>
            <label class="n1d5"><input name="mthm[private_parking]" type="checkbox" <?php echo (isset($mthm['private_parking'])) ? 'checked="checked"' : ''; ?> value="Private parking">Private_parking</label>
            <label class="n1d5"><input name="mthm[indoor_pool]" type="checkbox" <?php echo (isset($mthm['indoor_pool'])) ? 'checked="checked"' : ''; ?> value="Indoor pool">Indoor pool</label>
            <label class="n1d5"><input name="mthm[shared_kitchen]" type="checkbox" <?php echo (isset($mthm['shared_kitchen'])) ? 'checked="checked"' : ''; ?> value="Shared kitchen">Shared kitchen</label>
            <label class="n1d5"><input name="mthm[walking_routes]" type="checkbox" <?php echo (isset($mthm['walking_routes'])) ? 'checked="checked"' : ''; ?> value="Walking routes">Walking routes</label>
            <label class="n1d5"><input name="mthm[public_parking]" type="checkbox" <?php echo (isset($mthm['public_parking'])) ? 'checked="checked"' : ''; ?> value="Public parking">Public parking</label>
            <label class="n1d5"><input name="mthm[private_beach]" type="checkbox" <?php echo (isset($mthm['private_beach'])) ? 'checked="checked"' : ''; ?> value="Private beach">Private beach</label>
            <label class="n1d5"><input name="mthm[common_terrace]" type="checkbox" <?php echo (isset($mthm['common_terrace'])) ? 'checked="checked"' : ''; ?> value="Common terrace">Common terrace</label>
            <label class="n1d5"><input name="mthm[night_club]" type="checkbox" <?php echo (isset($mthm['night_club'])) ? 'checked="checked"' : ''; ?> value="Night club">Night club</label>
            <label class="n1d5"><input name="mthm[water_sports]" type="checkbox" <?php echo (isset($mthm['water_sports'])) ? 'checked="checked"' : ''; ?> value="Water sports">Water sports</label>
            <label class="n1d5"><input name="mthm[garage]" type="checkbox" <?php echo (isset($mthm['garage'])) ? 'checked="checked"' : ''; ?> value="Garage">Garage</label>
            <label class="n1d5"><input name="mthm[reception]" type="checkbox" <?php echo (isset($mthm['reception'])) ? 'checked="checked"' : ''; ?> value="Reception">Reception</label>
            <label class="n1d5"><input name="mthm[restaurant]" type="checkbox" <?php echo (isset($mthm['restaurant'])) ? 'checked="checked"' : ''; ?> value="Restaurant">Restaurant</label>
            <label class="n1d5"><input name="mthm[beach_bar]" type="checkbox" <?php echo (isset($mthm['beach_bar'])) ? 'checked="checked"' : ''; ?> value="Beach Bar">Beach Bar</label>
            <label class="n1d5"><input name="mthm[playground]" type="checkbox" <?php echo (isset($mthm['playground'])) ? 'checked="checked"' : ''; ?> value="Playground">Playground</label>
            <label class="n1d5"><input name="mthm[conference_hall]" type="checkbox" <?php echo (isset($mthm['conference_hall'])) ? 'checked="checked"' : ''; ?> value="Conference hall">Conference hall</label>
            <label class="n1d5"><input name="mthm[laundry]" type="checkbox" <?php echo (isset($mthm['laundry'])) ? 'checked="checked"' : ''; ?> value="Laundry">Laundry</label>
            <label class="n1d5"><input name="mthm[a_la_carte]" type="checkbox" <?php echo (isset($mthm['a_la_carte'])) ? 'checked="checked"' : ''; ?> value="A la carte">A la carte</label>
            <label class="n1d5"><input name="mthm[golf]" type="checkbox" <?php echo (isset($mthm['golf'])) ? 'checked="checked"' : ''; ?> value="Golf">Golf</label>
            <label class="n1d5"><input name="mthm[excursions]" type="checkbox" <?php echo (isset($mthm['excursions'])) ? 'checked="checked"' : ''; ?> value="Excursions">Excursions</label>
            <label class="n1d5"><input name="mthm[internet]" type="checkbox" <?php echo (isset($mthm['internet'])) ? 'checked="checked"' : ''; ?> value="Internet">Internet</label>
            <label class="n1d5"><input name="mthm[casino]" type="checkbox" <?php echo (isset($mthm['casino'])) ? 'checked="checked"' : ''; ?> value="Casino">Casino</label>
            <label class="n1d5"><input name="mthm[national_restaurant]" type="checkbox" <?php echo (isset($mthm['national_restaurant'])) ? 'checked="checked"' : ''; ?> value="National restaurant">National restaurant</label>
            <label class="n1d5"><input name="mthm[housekeeping]" type="checkbox" <?php echo (isset($mthm['housekeeping'])) ? 'checked="checked"' : ''; ?> value="Housekeeping">Housekeeping</label>
            <label class="n1d5"><input name="mthm[pets_allowed]" type="checkbox" <?php echo (isset($mthm['pets_allowed'])) ? 'checked="checked"' : ''; ?> value="Pets allowed">Pets allowed</label>
          </fieldset>
          <fieldset class="block">
            <legend>Payment information:</legend>
            <label class="n1d2">Bank name <input name="mthm[bank_name]" type="text" value="<?php echo (isset($mthm['bank_name'])) ? $mthm['bank_name'] : ''; ?>"></label>
            <label class="n1d2">Bank branch <input name="mthm[bank_branch]" type="text" value="<?php echo (isset($mthm['bank_branch'])) ? $mthm['bank_branch'] : ''; ?>"></label>
            <label class="n1d2">SWIFT <input name="mthm[swift]" type="text" value="<?php echo (isset($mthm['swift'])) ? $mthm['swift'] : ''; ?>"></label>
            <label class="n1d2">Bank account <input name="mthm[bank_account]" type="text" value="<?php echo (isset($mthm['bank_account'])) ? $mthm['bank_account'] : ''; ?>"></label>
            <label class="n1d2">IBAN <input name="mthm[iban]" type="text" value="<?php echo (isset($mthm['iban'])) ? $mthm['iban'] : ''; ?>"></label>
            <label class="n1d2">Account owner <input name="mthm[account_owner]" type="text" value="<?php echo (isset($mthm['account_owner'])) ? $mthm['account_owner'] : ''; ?>"></label>
          </fieldset>
          <fieldset class>
            <legend>Terms of sale:</legend>
            <div class="n1d2">
              <label>Stay tax <input name="mthm[stay_tax]" type="text" size="2" value="<?php echo (isset($mthm['stay_tax'])) ? $mthm['stay_tax'] : ''; ?>"></label>
              <label class="hl">included in price <input name="mthm[stay_tax_included]" type="checkbox" <?php echo (isset($mthm['stay_tax_included'])) ? 'checked="checked"' : ''; ?> value="1"></label>               
            </div>
            <div class="n1d2">
              <label>Check in from <input name="mthm[check_in_from]" type="text" size="2" value="<?php echo (isset($mthm['check_in_from'])) ? $mthm['check_in_from'] : ''; ?>"></label>
              <label>to <input name="mthm[Check_in_to]" type="text" size="2" value="<?php echo (isset($mthm['Check_in_to'])) ? $mthm['Check_in_to'] : ''; ?>"></label>
            </div>
            <div class="n1d2">
              <label> Value added tax <input name="mthm[value_added_tax]" type="text" size="2" value="<?php echo (isset($mthm['value_added_tax'])) ? $mthm['value_added_tax'] : ''; ?>"> %</label>
              <label class="hl">included in price <input name="mthm[vat_included]" type="checkbox" <?php echo (isset($mthm['vat_included'])) ? 'checked="checked"' : ''; ?> value="1"></label><span class="break"></span>              
            </div>
            <div class="n1d2">
              <label>Check out from <input name="mthm[check_out_from]" type="text" size="2" value="<?php echo (isset($mthm['check_out_from'])) ? $mthm['check_out_from'] : ''; ?>"></label>
              <label>to <input name="mthm[check_out_to]" type="text" size="2" value="<?php echo (isset($mthm['check_out_to'])) ? $mthm['check_out_to'] : ''; ?>"></label>              
            </div>
            <div class="n2d4">
              <label>Children age<input name="mthm[children_age]" type="text" size="2" value="<?php echo (isset($mthm['children_age'])) ? $mthm['children_age'] : ''; ?>"></label>
            </div>
            <div class="n2d4">
              <label>Prepayment <input name="mthm[prepayment]" type="text" size="2" value="<?php echo (isset($mthm['prepayment'])) ? $mthm['prepayment'] : ''; ?>"></label>
            </div>
            <div class="n2d4">
              <label>Non-arrival penalty <input name="mthm[non_arrival_penalty]" type="text" size="2" value="<?php echo (isset($mthm['non_arrival_penalty'])) ? $mthm['non_arrival_penalty'] : ''; ?>"></label>
            </div>
            <div class="n2d4">
              <label>Cancelling reservation <input name="mthm[cancelling_reservation]" type="text" size="2" value="<?php echo (isset($mthm['cancelling_reservation'])) ? $mthm['cancelling_reservation'] : ''; ?>"></label>
            </div>
          </fieldset>
          <fieldset>
            <legend>Additional information:</legend>
            <label class="n10d10"><textarea class="n1d1" rows="4" name="mthm[bed_types]"><?php echo (isset($mthm['bed_types'])) ? $mthm['bed_types'] : ''; ?></textarea></label>
          </fieldset>
        </div>
        <?php
      }, ['mt_hotels'], 'normal', 'high');
    });

    add_action('save_post', function ($post_id) {     
      if (!isset($_POST['mthm'])) { return; }

      if (!wp_verify_nonce($_POST['mtn_hotels'], plugin_basename(__FILE__))) { return; }

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }

      if (!current_user_can('edit_post', $post_id)) { return; }

      $mthm = ($_POST['mthm']);
      
      if (!empty($mthm)) {
        update_post_meta($post_id, '_mt_hotels_meta', $mthm);        
      }
    });

  }

}