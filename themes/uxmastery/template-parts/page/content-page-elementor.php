<?php
while ( have_posts() ) : the_post() ;
    the_content();
    
    uxmastery_link_page();
endwhile;