<?php
add_shortcode('testimonial','testimonial_section_func');
function testimonial_section_func($jekono){
    $result = shortcode_atts(array(
            'testi_group'    => '',
    ),$jekono);
    extract($result);
    ob_start();
    ?>

<!-- Start Testimonial Section -->
<section class="testimonial-wrap ">
            <div class="container">
                <div class="testimonial owl-carousel">

                <?php 
                $testimonials = vc_param_group_parse_atts($testi_group);
                foreach($testimonials as $item):
                    $image_src = wp_get_attachment_url($item['image']);
                ?>
                    <div class="single-testimonial">
                        <div class="testimonial-img">
                            <img src="<?php echo $image_src;?>" alt="">
                            <h3><?php echo $item['name']?></h3>
                        </div>
                        <div class="testimonial-text">“<?php echo $item['content']?>”</div>
                    </div><!-- .single-testimonial -->
                <?php endforeach;?>
                   
                </div>
            </div>
        </section>
        <!-- End Testimonial Section -->
            
    <?php
    return ob_get_clean();
}

add_action( 'vc_before_init', 'testimonial_section_el' );
function testimonial_section_el() {
 vc_map( array(
  "name" => __( "Testimonial", "praxis" ),
  "base" => "testimonial",
  "category" => __( "Praxis", "praxis"),
  "params" => array(
        
    array(
        'type' => 'param_group',
        'param_name' => 'testi_group',
        // Note params is mapped inside param-group:
        'params' => array(
                array(
                'type' => 'textfield',
                'heading' => 'Name',
                'param_name' => 'name',
                ),
                array(
                'type' => 'textarea',
                'heading' => 'Content',
                'param_name' => 'content',
                ),
                array(
                'type' => 'attach_image',
                'heading' => 'Image',
                'param_name' => 'image',
                ),
        )
     )
  )   
  
 ) );
}


?>