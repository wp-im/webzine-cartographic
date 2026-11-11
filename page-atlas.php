<?php
/** Template Name: 编辑地图与地点索引 */
namespace Webzine\Cartographic;
get_header();
while(have_posts()): the_post(); ?>
<header class="wz-page-heading"><span class="wz-eyebrow">FIELD ATLAS / EDITORIAL MAP</span><h1><?php the_title(); ?></h1></header>
<div class="ca-map-intro"><?php the_content(); ?></div>
<?php if(shortcode_exists('field_atlas')): $district=sanitize_title(option('atlas_district')); ?><div class="ca-map-embed <?php echo option('map_index_density')==='compact'?'ca-map-compact':''; ?>"><?php echo do_shortcode('[field_atlas embedded="yes" district="'.esc_attr($district).'" height="85vh"]'); ?></div><?php else: ?><p class="wz-empty"><?php esc_html_e('地图组件目前未启用。可以从普通文章继续阅读；启用插件后恢复地点档案与地图。','webzine-cartographic'); ?></p><?php endif; ?>
<section class="ca-static-index"><?php if(post_type_exists('fa_place')): section_heading(__('可直接阅读的地点档案','webzine-cartographic')); $places=get_posts(array('post_type'=>'fa_place','post_status'=>'publish','has_password'=>false,'posts_per_page'=>100)); ?><ul><?php foreach($places as $place): ?><li><a href="<?php echo esc_url(get_permalink($place)); ?>"><?php echo esc_html(get_the_title($place)); ?></a> — <?php echo esc_html(get_post_meta($place->ID,'_fa_strap',true)); ?></li><?php endforeach; ?></ul><?php else: section_heading(__('继续阅读普通文章','webzine-cartographic'),posts_url()); feed(array('posts_per_page'=>6),'wz-feed-index'); endif; ?></section>
<?php widget_area('page-bottom'); endwhile; get_footer(); ?>
