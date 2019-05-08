<?php
add_shortcode('works-section','works_section_func');
function works_section_func($jekono){
    $result = shortcode_atts(array(
            'count'      => '',
            'has_even'   => '',
            'has_gutter' => '',
    ),$jekono);
    extract($result);
    ob_start();
    ?>

 <!-- Start Portfolio Section -->
 <section class="portfolio-wrap section">
            <div class="container">
                <div class="portfolio-filter text-center">
                
                    <ul>
                        
                      <li class="active"><a href="#" data-filter="*">ALL</a></li>
                      
                      <?php 
                        $category = get_terms( 'works_cat', array( 'hide_empty' => true ));
                            foreach ( $category as $w_cat ) :
                                echo '<li><a href="#" data-filter=".'.$w_cat->slug.'">'.$w_cat->name.'</a></li>';
                            endforeach;
                        ?>
                   
                    </ul>
                </div><!-- .portfolio-filter-area -->
                <?php  
                    $even_class = '';
                    $even = $has_even;
                    if(true == $even){
                        $even_class = 'portfolio-even';
                    }
                    $guttr_class = '';
                    $has_gutter = $has_gutter;
                    if(true == $has_gutter){
                        $guttr_class = 'gutter-less';
                    }
                ?>
                <div class="portfolio  <?php echo $even_class;?> <?php echo $guttr_class;?>">
                    <div class="grid-sizer"></div>

                <?php
               
               $qq = new WP_Query(array(
                    'post_type' => 'works',
                    'posts_per_page'=> $count
                ));
             
                while($qq->have_posts()):$qq->the_post(); 

                $works_terms = get_the_terms( get_the_ID(), 'works_cat' );

                $works_cat_slug = array();
                foreach ( $works_terms as $term ):
                    $works_cat_slug[] = $term->slug;
                endforeach;

		        $works_cat_class = join( ',', $works_cat_slug );
                ?>
                <div class="portfolio-item <?php echo $works_cat_class;?>">
                      <a href="#" class="inner-portfolio">
                        <?php the_post_thumbnail();?>
                        <div class="portfolio-hover text-center">
                         	<h3><?php echo $works_cat_class;?></h3>
                         	<h4><?php the_title();?></h4>
                        </div><!-- .portfolio-hover -->
                      </a>
                </div><!-- .portfolio-item -->
             <?php endwhile;?>   
              </div><!-- .portfolio -->
            </div><!-- .container -->
        </section>
        <!-- End Portfolio Section -->
    <?php
    return ob_get_clean();
}

add_action( 'vc_before_init', 'works_section_el' );
function works_section_el() {
 vc_map( array(
  "name" => __( "Works", "praxis" ),
  "base" => "works-section",
  "category" => __( "Praxis", "praxis"),
  "params" => array(
        array(
            "type" => "textfield",
            "heading" => __( "Works Count", "praxis" ),
            "param_name" => "count",
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => esc_html__( 'Even View', 'praxis' ),
            'param_name'  => 'has_even',
            'description' => esc_html__( 'Check the box to display masonry view', 'praxis' ),
            ),
        array(
            'type'        => 'checkbox',
            'heading'     => esc_html__( 'Gutter Less', 'praxis' ),
            'param_name'  => 'has_gutter',
            ),
        
  )
 ) );
}


?>