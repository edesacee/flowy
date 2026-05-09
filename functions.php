<?php

include_once('core/main.php');
include_once('core/ajax.php');

include_once('includes/main.php');
include_once('includes/customizer.php');

define('DEF_HEADER_BG', '#fff');
define('DEF_FOOTER_BG', '#fff');

define('FLOWY_DEFAULT_PARAGRAPH', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris justo massa, scelerisque nec dui sed, egestas pharetra ligula. Sed quam nisi, placerat ultricies ornare nec, interdum vel lacus. Vestibulum magna dui, faucibus ut dolor vitae, fermentum facilisis libero.');
define('FLOWY_DEFAULT_TITLE', 'Lorem ipsum dolor sit amet, consectetur');
define('FLOWY_DEFAULT_SUBTITLE', 'Sed quam nisi, placerat ultricies ornare nec');

new Flowyth_Main(__FILE__);
new Flowyth_Customizer();

function flowythGetPagination($base_url, $total_items, $per_page, $cur_page) {
	if ($total_items == 0) {
		return '';
	}

	$base_url = rtrim($base_url, '/');

	$total_pages = ceil($total_items/$per_page);

	$prev_page = $cur_page - 1 > 0 ? $cur_page - 1 : '';
	$next_page = $cur_page + 1 < $total_pages+1 ? $cur_page + 1 : '';

	$pagination = '<div id="pagination" class="paging" style="text-align: right"><span class="total">Total ' . $total_items . ' records. ' . $cur_page . ' of ' . $total_pages . ' pages.</span>';
	$pagination .= '<span class="page">';
	if ($total_pages > 1) {
		if ($prev_page) {
			$link_prev = $base_url . '/page/'. $prev_page;
			$pagination .= '<a href="' . $link_prev . '" data-val="' . $prev_page . '" class="previous">&laquo;</a>';
		}

		for ($i=1; $i <= $total_pages ; $i++) {
			$link = $base_url . '/page/' . $i;

			if ($total_pages > 17) {
				$pg_grp = ceil($cur_page/15);

				$end = 15 * $pg_grp;
				$start = $end - 14;

				if ($i >= $start && $i <= $end) {
					// title="Group ' . $pg_grp . ' : ' . $start . ' - ' . $end . '" 
					$pagination .= '<a href="' . $link . '" class="' . ($i == $cur_page ? 'current' : '') . '" data-val="' . $i . '">' . $i . '</a>';
				}
			}
			else {
				$pagination .= '<a href="' . $link . '" class="' . ($i == $cur_page ? 'current' : '') . '" data-val="' . $i . '">' . $i . '</a>';	
			}
		}

		if ($next_page) {
			$link_next = $base_url . '/page/' . $next_page;
			$pagination .= '<a href="' . $link_next . '" data-val="' . $next_page . '" class="next">&raquo;</a></div>';
		}

		$pagination .= '</div>';
	}

	$pagination .= '</div>';
	return $pagination;
}
