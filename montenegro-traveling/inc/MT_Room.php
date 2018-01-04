<?php
if (!defined('WPINC')) {
  exit;
}

class MT_Room extends MT_Base_Type {

  public static function init() {

    add_action('init', function () {
      register_post_type('mt_rooms', [
        'labels' => [
          'name' => _x('MT Rooms', 'post type general name', 'montenegro-traveling'),
          'singular_name' => _x('Room', 'post type singular name', 'montenegro-traveling'),
          'menu_name' => __('MT Rooms', 'montenegro-traveling'),
          'parent_item_colon' => __('Parent Item:', 'montenegro-traveling'),
          'all_items' => __('Rooms', 'montenegro-traveling'),
          'view_item' => __('View Room', 'montenegro-traveling'),
          'add_new_item' => __('Add New Room', 'montenegro-traveling'),
          'add_new' => __('Add New Room', 'montenegro-traveling'),
          'edit_item' => __('Edit Room', 'montenegro-traveling'),
          'update_item' => __('Update Room', 'montenegro-traveling'),
          'search_items' => __('Search Room', 'montenegro-traveling'),
          'not_found' => __('No room found', 'montenegro-traveling'),
          'not_found_in_trash' => __('No room found in Trash', 'montenegro-traveling'),
        ],
        'description' => 'Post type or hotels',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-admin-network', // dashicons-admin-post dashicons-building
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

      register_taxonomy('rooms-cat', 'mt_rooms', ['public' => true, 'hierarchical' => true,]);

      register_taxonomy('rooms-tag', 'mt_rooms', ['public' => true, 'hierarchical' => false,]);
    });

    add_action('add_meta_boxes', function () {
      add_meta_box('mt_room_box', 'Room properties', function ($post, $meta) {
        $mtrm = get_post_meta($post->ID, '_mt_rooms_meta', true);
        wp_nonce_field(plugin_basename(__FILE__), 'mtn_rooms' );
        ?>
        <div class="inbox-wraper">
          <fieldset class="curtail">
            <legend>Main property:</legend>
            <label class="n1d4">Standard capacity <input name="mtrm[standard_capacity]" type="text" size= "2" value="<?php echo (isset($mtrm['standard_capacity'])) ? $mtrm['standard_capacity'] : ''; ?>"></label>
            <label class="n1d4">Max capacity <input name="mtrm[max_capacity]" type="text" size= "2" value="<?php echo (isset($mtrm['max_capacity'])) ? $mtrm['max_capacity'] : ''; ?>"></label>
            <label class="n1d4">Number of bedroom <input name="mtrm[number_of_bedroom]" size= "2" type="text" value="<?php echo (isset($mtrm['number_of_bedroom'])) ? $mtrm['number_of_bedroom'] : ''; ?>"></label>
            <label class="n1d4">Room number <input name="mtrm[room_number]" type="text" size= "2" value="<?php echo (isset($mtrm['room_number'])) ? $mtrm['room_number'] : ''; ?>"></label>
          </fieldset>
          <fieldset class="block">
            <label class="n1d1">Bed types<textarea class="" rows="4" name="mtrm[bed_types]" value=""><?php echo (isset($mtrm['bed_types'])) ? $mtrm['bed_types'] : ''; ?></textarea></label>
          </fieldset>  
          <fieldset class="block">
            <legend>Price:</legend>
            <label class="n1d3">Season 1<input name="mtrm[season_1]" type="text" value="<?php echo (isset($mtrm['season_1'])) ? $mtrm['season_1'] : ''; ?>"></label>      
            <label class="n1d3">Season 2<input name="mtrm[season_2]" type="text" value="<?php echo (isset($mtrm['season_2'])) ? $mtrm['season_2'] : ''; ?>"></label>      
            <label class="n1d3">Season 3<input name="mtrm[season_3]" type="text" value="<?php echo (isset($mtrm['season_3'])) ? $mtrm['season_3'] : ''; ?>"></label>      
            <label class="n1d3">Season 4<input name="mtrm[season_4]" type="text" value="<?php echo (isset($mtrm['season_4'])) ? $mtrm['season_4'] : ''; ?>"></label>      
            <label class="n1d3">Season 5<input name="mtrm[season_5]" type="text" value="<?php echo (isset($mtrm['season_5'])) ? $mtrm['season_5'] : ''; ?>"></label>      
            <label class="n1d3">Season 6<input name="mtrm[season_6]" type="text" value="<?php echo (isset($mtrm['season_6'])) ? $mtrm['season_6'] : ''; ?>"></label>
          </fieldset>
          <fieldset>
            <legend>Facilities:</legend>
            <label class="n1d4"><input name="mtrm[terrace]" type="checkbox" <?php echo (isset($mtrm['terrace'])) ? 'checked="checked"' : ''; ?> value="Terrace">Terrace</label>
            <label class="n1d4"><input name="mtrm[balcony]" type="checkbox" <?php echo (isset($mtrm['balcony'])) ? 'checked="checked"' : ''; ?> value="Balcony">Balcony</label>
            <label class="n1d4"><input name="mtrm[sea_view]" type="checkbox" <?php echo (isset($mtrm['sea_view'])) ? 'checked="checked"' : ''; ?> value="Sea view">Sea view</label>
            <label class="n1d4"><input name="mtrm[gargen_view]" type="checkbox" <?php echo (isset($mtrm['gargen_view'])) ? 'checked="checked"' : ''; ?> value="Gargen view">Gargen view</label>
            <label class="n1d4"><input name="mtrm[city_view]" type="checkbox" <?php echo (isset($mtrm['city_view'])) ? 'checked="checked"' : ''; ?> value="City view">City view</label>
            <label class="n1d4"><input name="mtrm[mountain_view]" type="checkbox" <?php echo (isset($mtrm['mountain_view'])) ? 'checked="checked"' : ''; ?> value="Mountain view">Mountain view</label>
            <label class="n1d4"><input name="mtrm[swim_pool_view]" type="checkbox" <?php echo (isset($mtrm['swim_pool_view'])) ? 'checked="checked"' : ''; ?> value="Swim pool view">Swim pool view</label>
            <label class="n1d4"><input name="mtrm[laundry_and_ironing_services]" type="checkbox" <?php echo (isset($mtrm['laundry_and_ironing_services'])) ? 'checked="checked"' : ''; ?> value="Laundry and ironing services">Laundry and ironing services</label>
            <label class="n1d4"><input name="mtrm[ironing_board_and_iron]" type="checkbox" <?php echo (isset($mtrm['ironing_board_and_iron'])) ? 'checked="checked"' : ''; ?> value="Ironing board and iron">Ironing board and iron</label>
            <label class="n1d4"><input name="mtrm[flat_screen_tv]" type="checkbox" <?php echo (isset($mtrm['flat_screen_tv'])) ? 'checked="checked"' : ''; ?> value="Flat Screen TV">Flat Screen TV</label>
            <label class="n1d4"><input name="mtrm[cable_tv_or_sat_tv]" type="checkbox" <?php echo (isset($mtrm['cable_tv_or_sat_tv'])) ? 'checked="checked"' : ''; ?> value="Cable TV or Sat TV">Cable TV or Sat TV</label>
            <label class="n1d4"><input name="mtrm[safe_in_room]" type="checkbox" <?php echo (isset($mtrm['safe_in_room'])) ? 'checked="checked"' : ''; ?> value="Safe in room">Safe in room</label>
            <label class="n1d4"><input name="mtrm[wi_fi_or_internet]" type="checkbox" <?php echo (isset($mtrm['wi_fi_or_internet'])) ? 'checked="checked"' : ''; ?> value="Wi-Fi or internet">Wi-Fi or internet</label>
            <label class="n1d4"><input name="mtrm[sofa]" type="checkbox" <?php echo (isset($mtrm['sofa'])) ? 'checked="checked"' : ''; ?> value="Sofa">Sofa</label>
            <label class="n1d4"><input name="mtrm[stove]" type="checkbox" <?php echo (isset($mtrm['stove'])) ? 'checked="checked"' : ''; ?> value="Stove">Stove</label>
            <label class="n1d4"><input name="mtrm[rarquet]" type="checkbox" <?php echo (isset($mtrm['rarquet'])) ? 'checked="checked"' : ''; ?> value="Parquet">Parquet</label>
            <label class="n1d4"><input name="mtrm[dining_table_and_chairs]" type="checkbox" <?php echo (isset($mtrm['dining_table_and_chairs'])) ? 'checked="checked"' : ''; ?> value="Dining table and chairs">Dining table and chairs</label>
            <label class="n1d4"><input name="mtrm[kitchen]" type="checkbox" <?php echo (isset($mtrm['kitchen'])) ? 'checked="checked"' : ''; ?> value="Kitchen">Kitchen</label>
            <label class="n1d4"><input name="mtrm[mini_kitchen]" type="checkbox" <?php echo (isset($mtrm['mini_kitchen'])) ? 'checked="checked"' : ''; ?> value="Mini Kitchen">Mini Kitchen</label>
            <label class="n1d4"><input name="mtrm[mini_bar]" type="checkbox" <?php echo (isset($mtrm['mini_bar'])) ? 'checked="checked"' : ''; ?> value="Mini bar">Mini bar</label>
            <label class="n1d4"><input name="mtrm[fridge]" type="checkbox" <?php echo (isset($mtrm['fridge'])) ? 'checked="checked"' : ''; ?>value="Fridge">Fridge</label>
            <label class="n1d4"><input name="mtrm[microwave_oven]" type="checkbox" <?php echo (isset($mtrm['microwave_oven'])) ? 'checked="checked"' : ''; ?> value="Microwave oven">Microwave oven</label>
            <label class="n1d4"><input name="mtrm[oven]" type="checkbox" <?php echo (isset($mtrm['oven'])) ? 'checked="checked"' : ''; ?> value="Oven">Oven</label>
            <label class="n1d4"><input name="mtrm[stove_for_cooking]" type="checkbox" <?php echo (isset($mtrm['stove_for_cooking'])) ? 'checked="checked"' : ''; ?> value="Stove for cooking">Stove for cooking</label>
            <label class="n1d4"><input name="mtrm[kettle]" type="checkbox" <?php echo (isset($mtrm['kettle'])) ? 'checked="checked"' : ''; ?> value="Kettle">Kettle</label>
            <label class="n1d4"><input name="mtrm[toster]" type="checkbox" <?php echo (isset($mtrm['toster'])) ? 'checked="checked"' : ''; ?> value="Toster">Toster</label>
            <label class="n1d4"><input name="mtrm[dishwasher]" type="checkbox" <?php echo (isset($mtrm['dishwasher'])) ? 'checked="checked"' : ''; ?> value="Dishwasher">Dishwasher</label>
            <label class="n1d4"><input name="mtrm[private_bath]" type="checkbox" <?php echo (isset($mtrm['private_bath'])) ? 'checked="checked"' : ''; ?> value="Private bath">Private bath</label>
            <label class="n1d4"><input name="mtrm[hair_dryer]" type="checkbox" <?php echo (isset($mtrm['hair_dryer'])) ? 'checked="checked"' : ''; ?> value="Hair dryer">Hair dryer</label>
            <label class="n1d4"><input name="mtrm[washing_machine]" type="checkbox" <?php echo (isset($mtrm['washing_machine'])) ? 'checked="checked"' : ''; ?> value="Washing machine">Washing machine</label>
            <label class="n1d4"><input name="mtrm[shower_cabin]" type="checkbox" <?php echo (isset($mtrm['shower_cabin'])) ? 'checked="checked"' : ''; ?> value="Shower cabin">Shower cabin</label>
            <label class="n1d4"><input name="mtrm[hydromassage_cabin]" type="checkbox" <?php echo (isset($mtrm['hydromassage_cabin'])) ? 'checked="checked"' : ''; ?> value="Hydromassage cabin">Hydromassage cabin</label>
            <label class="n1d4"><input name="mtrm[bathtub]" type="checkbox" <?php echo (isset($mtrm['bathtub'])) ? 'checked="checked"' : ''; ?> value="Bathtub">Bathtub</label>
            <label class="n1d4"><input name="mtrm[Shampoo_soap_toilet_paper]" type="checkbox" <?php echo (isset($mtrm['Shampoo_soap_toilet_paper'])) ? 'checked="checked"' : ''; ?> value="Shampoo, soap, toilet paper">Shampoo, soap, toilet paper</label>
            <label class="n1d4"><input name="mtrm[bathrobe]" type="checkbox" <?php echo (isset($mtrm['bathrobe'])) ? 'checked="checked"' : ''; ?> value="Bathrobe">Bathrobe</label>
            <label class="n1d4"><input name="mtrm[slippers]" type="checkbox" <?php echo (isset($mtrm['slippers'])) ? 'checked="checked"' : ''; ?> value="Slippers">Slippers</label>
            <label class="n1d4"><input name="mtrm[additional_bath]" type="checkbox" <?php echo (isset($mtrm['additional_bath'])) ? 'checked="checked"' : ''; ?> value="Additional bath">Additional bath</label>
            <label class="n1d4"><input name="mtrm[towels_and_bedclothes]" type="checkbox" <?php echo (isset($mtrm['towels_and_bedclothes'])) ? 'checked="checked"' : ''; ?> value="Towels and bedclothes">Towels and bedclothes</label>
            <label class="n1d4"><input name="mtrm[childrens_bed]" type="checkbox" <?php echo (isset($mtrm['childrens_bed'])) ? 'checked="checked"' : ''; ?> value="Children's bed">Children's bed</label>
            <label class="n1d4"><input name="mtrm[bottle_of_water]" type="checkbox" <?php echo (isset($mtrm['bottle_of_water'])) ? 'checked="checked"' : ''; ?> value="Bottle of water">Bottle of water</label>
            <label class="n1d4"><input name="mtrm[vip_content]" type="checkbox" <?php echo (isset($mtrm['vip_content'])) ? 'checked="checked"' : ''; ?> value="Vip content">Vip content</label>
          </fieldset>
        </div>
        <?php
      }, ['mt_rooms'], 'normal', 'high');
    });
    
    add_action('save_post', function ($post_id) {     
      if (!isset($_POST['mtrm'])) { return; }

      if (!wp_verify_nonce($_POST['mtn_rooms'], plugin_basename(__FILE__))) { return; }

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }

      if (!current_user_can('edit_post', $post_id)) { return; }

      $mtrm = ($_POST['mtrm']);
      
      if (!empty($mtrm)) {
        update_post_meta($post_id, '_mt_rooms_meta', $mtrm);        
      }
    });
  }

}