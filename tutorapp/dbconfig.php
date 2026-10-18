<?php

require_once __DIR__ . '/../config/config.php';

$db = app_careerpath_db();
$db_host = $db['host'];
$db_username = $db['username'];
$db_password = $db['password'];
$db_name = $db['database'];

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('Not connected: ' . mysqli_connect_error());

function getSqlQuery($query)
{
	global $conn;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	return $result;
}

function getSqlFetch($rs)
{
	$res = mysqli_fetch_assoc($rs);

	return $res;
}

function getSqlRow($query)
{
	global $conn;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	$row = mysqli_fetch_array($result);

	mysqli_free_result($result);

	return $row;
}

function getSqlNumber($sqlQuery)
{
	global $conn;
	$query = @mysqli_query($conn, $sqlQuery);

	$result = @mysqli_num_rows($query);

	@mysqli_free_result($query);

	return $result;
}

function getSqlField($sqlQuery, $field)
{
	$isQuery = getSqlNumber($sqlQuery);

	global $conn;
	$query = @mysqli_query($conn, $sqlQuery) or die(mysqli_error($conn) . '<br>INVALID QUERY: ' . $sqlQuery);

	if ($isQuery > 0) {
		$row = mysqli_fetch_array($query);
		$result = $row[$field];
	} else {
		$result = 'n/a';
	}

	@mysqli_free_result($query);

	return $result;
}

function deleteFile($filepath, $filename)
{
	$success = false;

	if (file_exists($filepath . $filename) && $filename != '' && $filename != 'n/a') {
		unlink($filepath . $filename);

		$success = true;
	}

	return $success;
}

function uploadFile($file, $destDir)
{
	$success = false;

	if (move_uploaded_file($file, $destDir)) {
		$success = true;
	}

	return $success;
}

function paginate($start, $limit, $total, $filePath, $otherParams)
{
	global $lang;

	$allPages = ceil($total / $limit);

	$currentPage = floor($start / $limit) + 1;

	$pagination = '';
	if ($allPages > 10) {
		$maxPages = ($allPages > 9) ? 9 : $allPages;

		if ($allPages > 9) {
			if ($currentPage >= 1 && $currentPage <= $allPages) {
				$pagination .= ($currentPage > 4) ? ' ... ' : ' ';

				$minPages = ($currentPage > 4) ? $currentPage : 5;

				$maxPages = ($currentPage < $allPages - 4) ? $currentPage : $allPages - 4;

				for ($i = $minPages - 4; $i < $maxPages + 5; $i++) {
					$pagination .= ($i == $currentPage) ? '[' . $i . '] ' : '<a href="' . $filePath . '?start=' . (($i - 1) * $limit) . $otherParams . '">' . $i . '</a> ';
				}

				$pagination .= ($currentPage < $allPages - 4) ? ' ... ' : ' ';
			} else {
				$pagination .= ' ... ';
			}
		}
	} else {
		for ($i = 1; $i < $allPages + 1; $i++) {
			$pagination .= ($i == $currentPage) ? '[' . $i . '] ' : '<a href="' . $filePath . '?start=' . (($i - 1) * $limit) . $otherParams . '">' . $i . '</a> ';
		}
	}

	if ($currentPage > 1) {
		$pagination = '[<a href="' . $filePath . '?start=0' . $otherParams . '">&lt;&lt;</a>] [<a href="' . $filePath . '?start=' . (($currentPage - 2) * $limit) . $otherParams . '">&lt;</a>] ' . $pagination;
	}

	if ($currentPage < $allPages) {
		$pagination .= ' [<a href="' . $filePath . '?start=' . ($currentPage * $limit) . $otherParams . '">&gt;</a>] [<a href="' . $filePath . '?start=' . (($allPages - 1) * $limit) . $otherParams . '">&gt;&gt;</a>]';
	}

	echo $pagination;
}
