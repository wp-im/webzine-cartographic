<?php namespace Webzine\Cartographic; get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class( 'wz-document' ); ?>>
<header class="wz-document-heading"><div class="wz-eyebrow"><?php $kinds=array('fa_place'=>__('地点档案','webzine-cartographic'),'fa_route'=>__('编辑路线','webzine-cartographic'),'fa_collection'=>__('编辑清单','webzine-cartographic'));if(isset($kinds[get_post_type()]))echo esc_html($kinds[get_post_type()]);else the_category(' / '); ?></div><h1><?php the_title(); ?></h1><div class="wz-meta"><?php metadata(); ?><?php save_button(); ?><button class="wz-icon-button" type="button" data-share aria-label="<?php esc_attr_e( '分享文章', 'webzine-cartographic' ); ?>"><?php echo icon( 'share' ); ?></button></div><?php if ( has_excerpt() && ! post_password_required() ) : ?><p class="wz-standfirst"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?></header>
<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?><figure class="wz-document-cover"><?php the_post_thumbnail( 'wz-cover' ); ?><?php if ( get_the_post_thumbnail_caption() ) : ?><figcaption><?php echo esc_html( get_the_post_thumbnail_caption() ); ?></figcaption><?php endif; ?></figure><?php endif; ?>
<div class="wz-reading-layout">
<div class="wz-reading-main">
<?php if ( ! post_password_required() ) : ?>
<div class="wz-reader-tools"><span><?php esc_html_e( '阅读设置', 'webzine-cartographic' ); ?></span><button type="button" data-font="-1" aria-label="<?php esc_attr_e( '减小正文字号', 'webzine-cartographic' ); ?>">A−</button><button type="button" data-font="0"><?php esc_html_e( '默认', 'webzine-cartographic' ); ?></button><button type="button" data-font="1" aria-label="<?php esc_attr_e( '增大正文字号', 'webzine-cartographic' ); ?>">A+</button></div>
<?php if ( option( 'show_toc', true ) ) : ?><details class="wz-toc" id="wz-toc" hidden><summary><?php esc_html_e( '本文目录', 'webzine-cartographic' ); ?></summary><nav aria-label="<?php esc_attr_e( '本文章节', 'webzine-cartographic' ); ?>"></nav></details><?php endif; ?>
<?php endif; ?>
<?php do_action( 'webzine-cartographic_before_content' ); ?><div class="entry-content wz-prose" id="wz-prose"><?php the_content(); ?></div><?php wp_link_pages( array( 'before' => '<nav class="wz-page-links" aria-label="' . esc_attr__( '文章分页', 'webzine-cartographic' ) . '">', 'after' => '</nav>' ) ); do_action( 'webzine-cartographic_after_content' ); ?>
<?php if(!post_password_required()) get_template_part('parts/place-data'); ?>
<?php the_tags( '<div class="wz-tags">', ' ', '</div>' ); ?>
</div><aside class="wz-article-aside" aria-label="<?php esc_attr_e( '延伸资料', 'webzine-cartographic' ); ?>"><?php widget_area( 'article-aside' ); ?></aside></div>
<?php widget_area( 'article-bottom' ); ?>
<?php the_post_navigation( array( 'prev_text' => '<span>' . __( '上一篇', 'webzine-cartographic' ) . '</span> %title', 'next_text' => '<span>' . __( '下一篇', 'webzine-cartographic' ) . '</span> %title' ) ); ?>
<?php if ( option( 'show_related', true ) && ! post_password_required() ) : ?><section class="wz-related"><?php section_heading( __( '继续阅读', 'webzine-cartographic' ) ); feed( array( 'category__in' => wp_get_post_categories( get_the_ID() ), 'post__not_in' => array( get_the_ID() ), 'posts_per_page' => 3 ), 'wz-feed-list' ); ?></section><?php endif; ?>
</article>
<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
<?php if ( option( 'show_progress', true ) && ! post_password_required() ) : ?><progress class="wz-reading-progress" id="wz-progress" max="100" value="0" aria-label="<?php esc_attr_e( '阅读进度', 'webzine-cartographic' ); ?>"></progress><?php endif; ?>
<?php endwhile; get_footer(); ?>
