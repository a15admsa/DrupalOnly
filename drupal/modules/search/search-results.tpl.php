<?php

/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 *
 *
 * @see template_preprocess_search_results()
 *
 * @ingroup themeable
 */
?>
<h1 id="results-search">You got <b id="value-of-result"></b> hits for the search of <b id="words-in-seach-box"></b></h1>
<?php if ($search_results): ?>
  <script>
    (function() {
      document.getElementById("value-of-result").innerHTML=<?php print $GLOBALS['pager_total_items'][0]?>;
      document.getElementById("words-in-seach-box").innerHTML=document.getElementById("edit-keys").value;
    })();
  </script>
  <ol class="search-results <?php print $module; ?>-results">
    <?php print $search_results; ?>
  </ol>
  <?php print $pager; ?>
<?php else : ?>
  <script>
    (function() {
      document.getElementById("value-of-result").innerHTML="0";
      document.getElementById("words-in-seach-box").innerHTML=document.getElementById("edit-keys").value;
    })();
  </script>
  <?php print search_help('search#noresults', drupal_help_arg()); ?>
<?php endif; ?>
