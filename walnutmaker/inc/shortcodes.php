<?php

add_shortcode( 'city', 'get_city_name' );
add_shortcode( 'city-postfix', function () {
  return add_city_postfix(false);
});
