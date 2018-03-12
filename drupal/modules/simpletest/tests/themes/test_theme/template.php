<?php

/**
 * Tests a theme overriding a suggestion of a base theme hook.
 */
function test_theme_theme_test__suggestion($variables) {
  return 'Theme hook implementor=test_theme_theme_test__suggestion(). Foo=' . $variables['foo'];
}

/**
 * Tests a theme implementing an alter hook.
 *
 * The confusing function name here is due to this being an implementation of
 * the alter hook invoked when the 'theme_test' module calls
 * drupal_alter('theme_test_alter').
 */
function test_theme_theme_test_alter_alter(&$data) {
  $data = 'test_theme_theme_test_alter_alter was invoked';
}

function stark_preprocess_search_results(&$vars) {
  // search.module shows 10 items per page (this isn't customizable)
  $itemsPerPage = 10;

  // Determine which page is being viewed
  // If $_REQUEST['page'] is not set, we are on page 1
  $currentPage = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 0) + 1;

  // Get the total number of results from the global pager
  $total = $GLOBALS['pager_total_items'][0];

  // Determine which results are being shown ("Showing results x through y")
  $start = (10 * $currentPage) - 9;
  // If on the last page, only go up to $total, not the total that COULD be
  // shown on the page. This prevents things like "Displaying 11-20 of 17".
  $end = (($itemsPerPage * $currentPage) >= $total) ? $total : ($itemsPerPage * $currentPage);

  // If there is more than one page of results:
  if ($total > $itemsPerPage) {
    $vars['search_totals'] = t('Displaying !start - !end of !total results', array(
      '!start' => $start,
      '!end' => $end,
      '!total' => $total,
    ));
  }
  else {
    // Only one page of results, so make it simpler
    $vars['search_totals'] = t('Displaying !total !results_label', array(
      '!total' => $total,
      // Be smart about labels: show "result" for one, "results" for multiple
      '!results_label' => format_plural($total, 'result', 'results'),
    ));
  }
}
