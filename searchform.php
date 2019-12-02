<form action="/" method="get">
    <label for="search" class="sr-only">Search in <?php echo home_url( '/' ); ?></label>
    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="SEARCH" />
    <button class="sr-only">Search</button>
</form>
