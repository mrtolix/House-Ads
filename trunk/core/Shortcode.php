<?
// create shortcode to call all in house ads matching the category
add_shortcode( 'house-ads', 'hAds_list' );
function hAds_list( $atts ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'keyword' => '',
			'size' => 'inline_rectangle',
			'url' => 'https://www.wordpress.org/',
			'target' => '_blank',
			'rel' => 'nofollow',
		),
		$atts
	);
    ob_start();
	// Query
    $shortcodeKeys = $atts['keyword'];
    if (!empty($shortcodeKeys)){
        $query = new WP_Query( array(
            'post_type' => 'house_ads',
            'posts_per_page' => 1,
            'order' => 'ASC',
            'orderby' => 'rand',
            'tax_query' => array (
                array (
                    'taxonomy' => 'ads_keywords',
                    'field' => 'name',
                    'terms' => explode(",",$shortcodeKeys),
                )
            ),
        ) );
    } else {
        $query = new WP_Query( array(
            'post_type' => 'house_ads',
            'posts_per_page' => 1,
            'order' => 'ASC',
            'orderby' => 'rand',
        ) );
    };
    if ( $query->have_posts() ) { ?>        
            <?php while ( $query->have_posts() ) : $query->the_post();
            	$adtype = $atts['size'];
            	$url = $atts['url'];
        		$target = $atts['target'];
        		$rel = $atts['rel'];
            	$imgSrc = get_field($adtype);
            	if(!empty($imgSrc['url'])){ ?>
        		<div class="in-house-ad-container">
            		<a href="<?php echo $url; ?>" target="<?php echo $target; ?>" rel="<?php echo $rel; ?>">
            			<img src="<?php echo $imgSrc['url']; ?>" alt="<?php echo $imgSrc['alt']; ?>" class="ad-img">
            		</a>
        		</div>
                <?php } ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}