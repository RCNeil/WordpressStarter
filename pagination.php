<?php if (get_previous_posts_link() || get_next_posts_link()) : ?>
<ul class="pagination alignwide">
    <?php if (get_previous_posts_link()) : ?>
		<li class="prev-link"><?php previous_posts_link('<svg width="12.771" height="12.769" fill="none" version="1.1" viewBox="0 0 12.771 12.769" xmlns="http://www.w3.org/2000/svg"><path d="m6.7854 0 5.9856 6.3848-5.9856 6.3847-0.8208-0.7695 4.737-5.0527h-10.702v-1.125h10.702l-4.737-5.0528z" clip-rule="evenodd" fill="#000000" fill-rule="evenodd"/></svg><span>Newer Posts</span>'); ?></li>
	<?php endif; ?>
	<?php if (get_next_posts_link()) : ?>
		<li class="next-link"><?php next_posts_link('<span>Older posts</span><svg width="12.771" height="12.769" fill="none" version="1.1" viewBox="0 0 12.771 12.769" xmlns="http://www.w3.org/2000/svg"><path d="m6.7854 0 5.9856 6.3848-5.9856 6.3847-0.8208-0.7695 4.737-5.0527h-10.702v-1.125h10.702l-4.737-5.0528z" clip-rule="evenodd" fill="#000000" fill-rule="evenodd"/></svg>'); ?></li>
	<?php endif; ?>
</ul>
<?php endif; ?>
