<?php /** Template Name: Вакансии */ ?>
<?php get_header(); ?>
	
	<div class="wt-page-head">
		<div class="container">
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
			<div class="wt-page-title">
				<h1><?php the_title(); ?><?php echo Declension(get_blog_details( array( 'blog_id' => $blog_id ) )->blogname); ?></h1>
			</div>
		</div>
	</div>
	
	<div class="container clearfix">
		
		<div class="wt-vacancies">
			<?php the_post(); ?>
			
			<div class="page-content">
				<?php the_content(); ?>
				
				<?php if( have_rows( 'vacancies' ) ) { ?>
					<ul class="wt-vacancies-list">
						<?php while( have_rows( 'vacancies' ) ) { ?>
							<?php the_row(); ?>
							<li class="wt-vacancies-item">
								<a href="#" class="wt-vacancies-head"><?php the_sub_field( 'title' ); ?></a>
								<div class="wt-vacancies-content">
									<div class="wt-styles"><?php the_sub_field( 'content' ); ?></div>
								</div>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>
			<?php wm_content_blocks(); ?>
		</div>
	
	</div>

<?php get_footer(); ?>