<?php get_header(); ?>

	<!-- Content -->
	<main class="pf">
		<div class="container">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article>
					<?php the_content(); ?>
				</article>
			<?php endwhile; else : ?>
				<p>Geen resultaten</p>
			<?php endif; ?>
		</div>
	</main>
	<!-- /Content -->

<?php get_footer(); ?>
