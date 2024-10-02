<?php 
function random_color_from_three_colors(){
	// Three colors to choose from
	$colors = array("#3c2bff", "#fe5e3a", "#ffc121", "#080808", "#080", "#5DADE2", "#A569BD", "#AED6F1", "#9B59B6", "#1700ff", "#36a51b");
	
	// Get the post ID to use as a seed
	$post_id = get_the_ID();
	
	// Use the post ID to pick a consistent color
	$random_index = $post_id % count($colors);
	
	// Get the color based on the index
	$background_color = $colors[$random_index];
	
	// Echo the style attribute to apply the background color
	echo 'style="background-color:' . $background_color . ';"';
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?> 
	<div class="my-barheader">
 <div class="progress-container">
    <div class="progress-bar" id="myBar" <?php random_color_from_three_colors(); ?>></div>
  </div> 
  </div>  
</head>
	
<body>
	<section class="single-post-body-custom custom-blog-layout">
		<div class="random-color premium design" <?php random_color_from_three_colors(); ?>>
			 <?php include(get_stylesheet_directory() . '/header-blog.php'); ?>
			<div class="blog-entry header">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<!-- Post category and published date -->
					<div class="post-meta">
						<div class="badge">
							<img src="https://cdn.prod.website-files.com/65d75e7422bf6a8f3b424121/65d79522edd391cf658d0d36_news-icon-subscription-x-webflow-template.svg" alt="" class="image-size _24px">
							<span class="post-category"><?php the_category(', '); ?></span> 
						</div>
						<span class="post-date"><?php echo get_the_date(); ?></span>
					</div>
					
					<!-- Post title -->
					<h1 class="post-title"><?php the_title(); ?></h1>
					
					<!-- Excerpt within 20 words -->
					<div class="post-excerpt">
						<?php echo wp_trim_words(get_the_excerpt(), 20); ?>
					</div>
					
					<!-- Featured image -->
					<div class="post-featured-image">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail(); ?>
						<?php endif; ?>
					</div>
				<?php endwhile; endif; ?>
			</div>				
		</div>
		<main>
			<!-- Blog post content and sidebar -->
			<div class="post-content">
				<?php the_content(); ?>
				<div class="post-tags">
					<h5>
						Tags:-
					</h5>
		<?php 
			the_tags('<ul><li>', '</li><li>', '</li></ul>'); // Display the tags of the post within an unordered list
		?>
	</div>
				<div class="author-profile">
    <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); // Display author's avatar ?>
    </div>
    <div class="author-info">
        <h4><?php the_author(); // Display author's name ?></h4>
        <p><?php the_author_meta( 'description' ); // Display author's bio ?></p>
        <p><?php 
            $author_id = get_the_author_meta( 'ID' ); 
            $post_count = count_user_posts( $author_id ); 
            echo 'Articles: ' . $post_count . ' ' . ( $post_count > 1 ? '' : '' ); 
        ?></p>
        <a href="<?php echo get_author_posts_url( $author_id ); ?>">View all posts</a>
    </div>
</div>

			</div>
			<div class="post-sidebar  sticky-sidebar">
				<?php get_sidebar(); ?>
			</div>
		</main>
		<!-- Include the newsletter section -->
	<?php get_template_part( 'newsletter-section' ); ?>
	<!-- Alternatively, you can use: -->
	<!-- <?php include( get_template_directory() . '/newsletter-section.php' ); ?> -->
		<!-- Include the related posts section -->
	<?php get_template_part( 'related-posts' ); ?>
		<section class="Comments-section"> 
		<?php
// Display comments if they are open or if there are comments to show
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
?>
</section>
		<?php get_footer(); ?>
	</section>
	<script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}
</script>
</body>
</html>
