<?php
add_shortcode('small-title','small_title_section_func');
function small_title_section_func($jekono){
    $result = shortcode_atts(array(
            'sm_title' => '',
    ),$jekono);
    extract($result);
    ob_start();
    ?>

    <h3 class="about-section-title"><?php echo esc_html($sm_title);?></h3></h3>
    <?php
    return ob_get_clean();
}

add_action( 'vc_before_init', 'title_small_section_el' );
function title_small_section_el() {
 vc_map( array(
  "name" => __( "Small Title", "praxis" ),
  "base" => "small-title",
  "category" => __( "Praxis", "praxis"),
  "params" => array(
        array(
        "type" => "textfield",
        "heading" => __( "Small Title", "praxis" ),
        "param_name" => "sm_title",
        "value" => __( "Default param value", "praxis" ),
        "description" => __( "Description for foo param.", "praxis" )
        ),
       
  )
 ) );
}


?>