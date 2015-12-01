<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h3 class="property-detail-title"><?php the_title(); ?>, </h3>
<span class="property-detail-location">
    <?php $location = Realia_Query::get_property_location_name(); ?>
    <?php if ( ! empty ( $location ) ) : ?>
        <?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?>
    <?php endif; ?>
</span>

<div class="entry-content">

    <div class="row">
        <div class="col-sm-8">
            <?php $gallery = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>
            <?php if ( ! empty( $gallery ) ) : ?>
                <div class="property-gallery">
                    <div class="property-gallery-preview">

                        <?php echo wp_get_attachment_link( key( $gallery ) , 'full' );?>

                        <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
                        <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>

                        <?php if ( $is_featured && $is_reduced ) : ?>
                            <div class="property-badge"><?php echo __( 'Featured', 'properta' ); ?> / <?php echo __( 'Reduced', 'properta' ); ?></div>
                        <?php elseif ( $is_featured ) : ?>
                            <div class="property-badge"><?php echo __( 'Featured', 'properta' ); ?></div>
                        <?php elseif ( $is_reduced ) : ?>
                            <div class="property-badge"><?php echo __( 'Reduced', 'properta' ); ?></div>
                        <?php endif; ?>

                        <?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>
                        <?php if ( $is_sticky ) : ?>
                            <div class="property-box-label-top">
                                <span class="property-badge property-badge-sticky"><?php echo __( 'TOP', 'properta' ); ?></span>
                            </div><!-- /.property-box-label-left -->
                        <?php endif; ?>

                    </div>

                    <ul class="property-gallery-index">
                        <?php $index = 0; ?>
                        <?php foreach ( $gallery as $id => $src ) : ?>
                            <li class="property-gallery-list-item <?php echo ( $index == 0 ) ? 'active' : ''; ?>">
                                <a rel="<?php echo esc_url( $src ); ?>">
                                    <?php echo wp_get_attachment_image( $id, 'thumbnail' ); ?>
                                </a>
                                <?php $index++; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- /.property-gallery -->
            <?php endif; ?>

            <!-- DESCRIPTION -->
            <h2 class='section-title property-description-title'><?php echo __('Description', 'properta'); ?></h2>
            <?php the_content(); ?>

        </div><!-- /.col-sm-8 -->


        <div class="col-sm-4">

            <h4 class="property-overview-title"><?php echo __('Property Overview', 'properta'); ?></h4>

            <div class="table-group overview property-overview">
                <table class="table">
                    <?php $id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'id', true ); ?>
                    <?php if ( ! empty( $id ) ) : ?>
                        <tr><td><?php echo __( 'ID', 'properta' ); ?></td><td><?php echo esc_attr( $id ); ?></td></tr>
                    <?php endif; ?>

                    <?php $year_built = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'year_built', true ); ?>
                    <?php if ( ! empty( $year_built ) ) : ?>
                        <tr><td><?php echo __( 'Year built', 'properta' ); ?></td><td><?php echo esc_attr( $year_built ); ?></td></tr>
                    <?php endif; ?>

                    <?php $type = Realia_Query::get_property_type_name(); ?>
                    <?php if ( ! empty ( $type ) ) : ?>
                        <tr><td><?php echo __( 'Type', 'properta' ); ?></td><td><?php echo esc_attr( $type ); ?></td></tr>
                    <?php endif; ?>

                    <?php $sold = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sold', true ); ?>
                        <tr><td><?php echo __( 'Sold', 'properta' ); ?></td>
                            <td>
                                <?php if ( ! empty( $sold ) ) : ?>
                                    <?php echo __( 'Yes', 'properta' ); ?>
                                <?php else : ?>
                                    <?php echo __( 'No', 'properta' ); ?>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>
                    <?php if ( ! empty ( $contract ) ) : ?>
                        <tr><td><?php echo __( 'Contract', 'properta' ); ?></td>
                            <td>
                                <?php if ( $contract == REALIA_CONTRACT_RENT ) : ?>
                                    <?php echo __( 'Rent', 'properta' ); ?>
                                <?php elseif ( REALIA_CONTRACT_SALE == $contract ) : ?>
                                    <?php echo __( 'Sale', 'properta' ); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $status = Realia_Query::get_property_status_name(); ?>
                    <?php if ( ! empty ( $status ) ) : ?>
                        <tr><td><?php echo __( 'Status', 'properta' ); ?></td><td><?php echo esc_attr( $status ); ?></td></tr>
                    <?php endif; ?>

                    <?php $home_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
                    <?php if ( ! empty( $home_area ) ) : ?>
                        <tr><td><?php echo __( 'Home area', 'properta' ); ?></td><td><?php echo esc_attr( $home_area ); ?>
                            <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></td></tr>
                    <?php endif; ?>

                    <?php $lot_dimensions = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_dimensions', true ); ?>
                    <?php if ( ! empty( $lot_dimensions ) ) : ?>
                        <tr><td><?php echo __( 'Lot dimensions', 'properta' ); ?></td><td><?php echo esc_attr( $lot_dimensions ); ?>
                            <?php echo get_theme_mod( 'realia_measurement_distance_unit', 'ft' ); ?></td></tr>
                    <?php endif; ?>

                    <?php $lot_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_area', true ); ?>
                    <?php if ( ! empty( $lot_area ) ) : ?>
                        <tr><td><?php echo __( 'Lot area', 'properta' ); ?></td><td><?php echo esc_attr( $lot_area ); ?>
                            <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></td></tr>
                    <?php endif; ?>

                    <?php $material = Realia_Query::get_property_material_name(); ?>
                    <?php if ( ! empty ( $material ) ) : ?>
                        <tr><td><?php echo __( 'Material', 'properta' ); ?></td><td><?php echo wp_kses( $material, wp_kses_allowed_html( 'post' ) ); ?></td></tr>
                    <?php endif; ?>

                    <?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
                    <?php if ( ! empty( $rooms ) ) : ?>
                        <tr><td><?php echo __( 'Rooms', 'properta' ); ?></td><td><?php echo esc_attr( $rooms ); ?></td></tr>
                    <?php endif; ?>

                    <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
                    <?php if ( ! empty( $beds ) ) : ?>
                        <tr><td><?php echo __( 'Beds', 'properta' ); ?></td><td><?php echo esc_attr( $beds ); ?></td></tr>
                    <?php endif; ?>

                    <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
                    <?php if ( ! empty( $baths ) ) : ?>
                        <tr><td><?php echo __( 'Baths', 'properta' ); ?></td><td><?php echo esc_attr( $baths ); ?></td></tr>
                    <?php endif; ?>

                    <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
                    <?php if ( ! empty( $garages ) ) : ?>
                        <tr><td><?php echo __( 'Garages', 'properta' ); ?></td><td><?php echo esc_attr( $garages ); ?></td></tr>
                    <?php endif; ?>
                </table>
                <div class="show-more pp pp-normal-right-arrow-small"></div><!-- /.show-more -->
            </div><!-- /.property-overview -->

            <!-- MAP LOCATION -->
            <?php $map_location = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'map_location', true ); ?>

            <?php if ( ! empty( $map_location ) && count( $map_location ) == 2) : ?>
                <h2 class='section-title'><?php echo __( 'Position', 'properta' ); ?></h2>

                <!-- MAP -->
                <div class="map-position">
                    <div class="map" id="simple-map" style="height: 270px"
                         data-latitude="<?php echo esc_attr( $map_location['latitude'] ); ?>"
                         data-longitude="<?php echo esc_attr( $map_location['longitude'] ); ?>"
                         data-transparent-marker-image="<?php echo get_template_directory_uri(); ?>/assets/img/transparent-marker-image.png"
                         data-zoom="15"
                        >
                    </div><!-- /.map -->
                </div><!-- /.map-position -->
            <?php endif; ?>

        </div><!-- /.col-sm-4 -->
    </div><!-- /.row -->

    <!-- AMENITIES -->
    <?php $amenities = get_categories( array(
        'taxonomy' 		=> 'amenities',
        'hide_empty' 	=> false,
    ) ) ; ?>

    <?php $hide = get_theme_mod( 'realia_general_hide_unassigned_amenities', false ); ?>
    <?php if ( ! empty( $amenities ) ) : ?>
        <h2 class='section-title'><?php echo __('Amenities', 'properta'); ?></h2>
        <div class="property-detail-amenities">
            <ul>
                <?php foreach ( $amenities as $amenity ) : ?>
                    <?php $has_term = has_term( $amenity->term_id, 'amenities' ); ?>

                    <?php if ( ! $hide || ( $hide  && $has_term ) ) : ?>
                        <li <?php if ( $has_term ): ?>class="yes"<?php else : ?>class="no"<?php endif; ?>><?php echo esc_html( $amenity->name ); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div><!-- /.property-amenities -->
    <?php endif; ?>

    <!-- VALUATION -->
    <?php $valuation = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_group', true ); ?>

    <?php if ( ! empty( $valuation ) && is_array( $valuation ) ) : ?>
        <h2 class='section-title'><?php echo __( 'Valuation', 'properta' ); ?></h2>

        <div class="property-valuation-block">
            <div class="property-valuation-line property-valuation-line-75"></div>
            <div class="property-valuation-line property-valuation-line-50"></div>
            <div class="property-valuation-line property-valuation-line-25"></div>

            <?php $valuation_count = count( $valuation ); ?>
            <?php foreach( $valuation as $group ) : ?>
                <div class="property-valuation-item" style="width: <?php echo 100 / $valuation_count; ?>%">
                    <div class="property-valuation-column" style="height: <?php echo esc_attr( $group[REALIA_PROPERTY_PREFIX . 'valuation_value'] ); ?>%">
                        <div class="percentage-valuation">
                            <div><?php echo esc_attr( $group[REALIA_PROPERTY_PREFIX . 'valuation_value'] ); ?> %</div>
                        </div>
                    </div>
                    <div class="property-valuation-key"><?php echo esc_attr( $group[REALIA_PROPERTY_PREFIX . 'valuation_key'] ); ?></div>
                </div>
            <?php endforeach; ?>
        </div><!-- /.property-valuation -->
    <?php endif; ?>

    <!-- PUBLIC FACILITIES -->
    <?php $facilities = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_group', true ); ?>

    <?php if ( ! empty( $facilities ) && is_array( $facilities ) ) : ?>
        <h2 class='section-title'><?php echo __( 'Public facilities', 'properta' ); ?></h2>

        <div class="row property-public-facilities">
            <?php foreach( $facilities as $facility ) : ?>
                <div class="col-md-4 col-sm-6">
                    <div class="property-public-facility">
                        <div class="property-public-facility-info">
                            <?php echo esc_attr( $facility[REALIA_PROPERTY_PREFIX . 'public_facilities_value'] ); ?>
                        </div><!-- /.property-public-facility-info -->

                        <div class="property-public-facility-arrow">
                            <hr>
                        </div><!-- /.property-public-facility-arrow -->

                        <div class="property-public-facility-title">
                            <span><?php echo esc_attr( $facility[REALIA_PROPERTY_PREFIX . 'public_facilities_key'] ); ?></span>
                        </div><!-- /.property-public-facility-title -->
                    </div><!-- /.property-public-facility -->
                </div><!-- /.col-sm-4 -->
            <?php endforeach; ?>
        </div><!-- /.property-public-facilities -->
    <?php endif; ?>

    <!-- FLOOR PLANS -->
    <?php $images = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'plans', true ); ?>

    <?php if ( ! empty( $images ) ) : ?>
        <h2 class='section-title'><?php echo __('Floor Plans', 'properta'); ?></h2>
        <div class="row property-floor-plans">
            <?php foreach ( $images as $id => $url ) : ?>
                <div class="col-sm-3">
                    <a href="<?php echo esc_url( $url ); ?>" rel="property-plans">
                        <?php echo wp_get_attachment_image( $id, 'post-thumbnail' ); ?>
                    </a>
                </div><!-- /.col-sm-3 -->
            <?php endforeach; ?>
        </div><!-- /.property-floor-plans -->
    <?php endif; ?>

    <!-- SIMILAR PROPERTIES -->
    <?php Realia_Query::loop_properties_similar(); ?>

    <?php if ( have_posts() ) : ?>
        <div class="similar-properties">
            <h2 class="section-title"><?php echo __( 'Similar properties', 'properta' ); ?></h2>

            <div class="row">
                <?php while( have_posts() ) : the_post(); ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="property-box-wrapper">
                            <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
                        </div>
                    </div><!-- /.col-sm-4 -->
                <?php endwhile; ?>
            </div><!-- /.row -->
        </div><!-- /.similar-properties -->

    <?php endif?>

    <?php wp_reset_query(); ?>

    <?php wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'properta' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'properta' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
    ?>

    <?php if ( comments_open() || get_comments_number() ): ?>
        <?php comments_template( '', true ); ?>
    <?php endif; ?>
</div><!-- .entry-content -->

</article><!-- #post-## -->
