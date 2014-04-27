<?php
if (!isset($title_for_layout))
	$title_for_layout = 'Bon Voyage | Travel Agency';
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $title_for_layout; ?></title>

	<link rel="icon" type="image/png" href="favicon.png" />

	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap-glyphicon.min.css" type="text/css" />	
	<link rel='stylesheet' href='css/font-lobster.css' type='text/css'>
	<link rel='stylesheet' href='css/font-myriadpro.css' type='text/css'>
	<link rel='stylesheet' href='css/font-kreon.css' type='text/css'>
	<link rel='stylesheet' href='css/font-cookie.css' type='text/css'>
	<link rel='stylesheet' href='css/font-spinnaker.css' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!--	<script type="text/javascript">
		$.noConflict();
	</script>-->
</head>

<?php

function getPagination($currentPage, $pageCount, $params = array())
{
	$url = $_SERVER['PHP_SELF'] . '?';
	foreach ($params as $k => $v) {
		$url .= "$k=$v&";
	}

	$hasNext = true;
	$hasPrev = true;
	$currentPage = empty($currentPage) ? 1 : $currentPage;
	if ($currentPage <= 1) {
		$hasPrev = false;
	}
	if ($currentPage >= $pageCount) {
		$hasNext = false;
	}

	$return = '<ul class="pagination pull-right">';
	if ($hasPrev) {
		$return .= '<li>';
		$return .= '<a href="' . $url . 'page=' . ($currentPage - 1) . '">&laquo; Prev</a>';
		$return .= '</li>';
	} else {
		$return .= '<li class="disabled">';
		$return .= '<a>&laquo; Prev</a>';
		$return .= '</li>';
	}
	if ($hasNext) {
		$return .= '<li>';
		$return .= '<a href="' . $url . 'page=' . ($currentPage + 1) . '">Next &raquo;</a>';
		$return .= '</li>';
	} else {
		$return .= '<li class="disabled">';
		$return .= '<a>Next &raquo;</a>';
		$return .= '</li>';
	}
	$return .= '</ul>';

	return $return;
}
?>