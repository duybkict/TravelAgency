<?php

include_once 'DataContext.php';

class HtmlHelper {
	
	public static function getPaginationForDestinations($currentPage, $params = array()) {
		$db = new DataContext();
		
		$url = 'destinations.php?anchor=anchor-main&';
		foreach ($params as $k => $v) {
			$url .= "$k=$v&";
		}
		
		$hasNext = true;
		$hasPrev = true;
		$currentPage = empty($currentPage) ? 1 : $currentPage;
		if ($currentPage <= 1) {
			$hasPrev = false;
		}
		if ($currentPage >= $db->getPageCountDestinations()) {
			$hasNext = false;
		}
		
		$return = '<ul class="pagination pull-right">';
		if ($hasPrev) {
			$return .= '<li>';
			$return .= '<a href="' . $url . 'page=' . ($currentPage - 1) .'">&laquo; Prev</a>';
			$return .= '</li>';
		} else {
			$return .= '<li class="disabled">';
			$return .= '<a>&laquo; Prev</a>';
			$return .= '</li>';
		}
		if ($hasNext) {
			$return .= '<li>';
			$return .= '<a href="' . $url . 'page=' . ($currentPage + 1) .'">Next &raquo;</a>';
			$return .= '</li>';
		} else {
			$return .= '<li class="disabled">';
			$return .= '<a>Next &raquo;</a>';
			$return .= '</li>';
		}
		$return .= '</ul>';
		
		return $return;
	}
	
}
