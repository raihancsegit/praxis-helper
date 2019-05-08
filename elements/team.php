<?php
add_shortcode('team','team_section_func');
function team_section_func($jekono){
    $result = shortcode_atts(array(
            'image' => '',
            'title' => '',
            'dsg'   => '',
            'fb'    => '',
            'tw'    => '',
    ),$jekono);
    extract($result);
    ob_start();
    ?>


                        <div class="team-member">
                            <?php
                            $src = wp_get_attachment_url($image);
                            ?>
                            <img src="<?php echo esc_url($src);?>" alt="MICHAEL DJONSON">
                            <div class="member-social-icon">
                                <a href="<?php echo esc_url($fb);?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="<?php echo esc_url($tw);?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                            </div>
                            <div class="member-details">
                                <h3><?php echo esc_html($title);?></h3>
                                <h4><?php echo  esc_html($dsg);?></h4>
                            </div>
                        </div>
            
    <?php
    return ob_get_clean();
}

add_action( 'vc_before_init', 'team_section_el' );
function team_section_el() {
 vc_map( array(
  "name" => __( "Team", "praxis" ),
  "base" => "team",
  "category" => __( "Praxis", "praxis"),
  "params" => array(
        array(
            "type" => "attach_image",
            "heading" => __( "Image", "praxis" ),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Title", "praxis" ),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Designation", "praxis" ),
            "param_name" => "dsg",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Facebook Url", "praxis" ),
            "param_name" => "fb",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Twitter Url", "praxis" ),
            "param_name" => "tw",
        ),
       
  )
 ) );
}


?>