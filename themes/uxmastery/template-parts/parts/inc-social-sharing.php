<div class="social-sharing">
    <p class="text"><?php esc_html_e('Chia sẻ trên', 'uxmastery'); ?></p>

    <div class="list">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>&quote=<?php echo urlencode( get_the_title() ); ?>"
           target="_blank"
           rel="noopener noreferrer"
           class="btn-share btn-share-facebook">
            <i class="ic-mask ic-mask-facebook"></i>
        </a>

        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>"
           target="_blank"
           rel="noopener noreferrer"
           class="btn-share btn-share-linkedin">
            <i class="ic-mask ic-mask-linkedin"></i>
        </a>
    </div>
</div>