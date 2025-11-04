<?php

function get_saved_city_id () {
  return !empty($_COOKIE['city_id']) ? $_COOKIE['city_id'] : get_main_site_id();
}

function is_cur_city ($city = []) {
  $city_id = is_array($city) ? $city['id'] : $city;
  $saved_id = get_saved_city_id();

  return $saved_id == $city_id;
}

function get_city_field ($field = 'blogname') {
  $blog = get_blog_details( array( 'blog_id' => get_saved_city_id() ) );

  return $blog->{ $field };
}

function get_city_name () {
  return get_city_field();
}

function the_city_name() {
  echo get_city_field();
}

function add_city_postfix ($echo = true) {
  $res = Declension(get_city_field());

  if ($echo) {
    echo $res;
    return;
  }

  return $res;
}
