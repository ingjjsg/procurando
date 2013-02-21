<?php

/**
 * This file is part of php-agenda.
 * 
 * php-agenda is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * php-agenda is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with php-agenda; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * Copyright 2006-2009, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */
?>
<?php

function printmonthtable($offset, $db, $firstday) {
	//$now=time();
	$today = mktime(0, 0, 0, date("m", $firstday), date('d', $firstday), date("y", $firstday));
	$month = mktime(0, 0, 0, date("m", $today) + $offset, 1, date("y", $today));

	$startpos = date("w", $month);
	if ($startpos == 0) {
		$startpos = 7;
	}
	$tmpnextmonth = mktime(0, 0, 0, date("m", $month) + 1, 0, date("y", $month));
	$tmpmonth = $month;
	echo '<table width="100%">';
	echo '<tr><td colspan="7" align="center"><b><a href="?page=overview&amp;type=month&amp;offset=' . $offset . '">' . date("F - Y", $month) . '</a></b></td></tr>';
	for ($i = 1;(date("m", $month) == date("m", $tmpmonth)); $i++) {
		echo '<tr>';
		for ($j = 1; $j <= 7; $j++) {
			if (($i == 1 and $j < $startpos) or (date("m", $month) != date("m", $tmpmonth))) {
				echo '<td>&nbsp;</td>';
			} else {
				$backcolor = '#ffffff';
//				if (hasAppointments($db, $tmpmonth)) {
//					$backcolor = '#ff0000';
//				}
				if (date("Y-m-d", $tmpmonth) == date("Y-m-d", $today)) {
					$daymark = 'blue';
				} else {
					$daymark = 'white';
				}
				if ($j >= 6) {
					echo '<td bgcolor=' . $daymark . '><span 
					style="background: ' . $backcolor . ';"><b><a 
					href="engine/changedate.php?date=' . date("Y-m-
					d", $tmpmonth) . '">' . date("d", $tmpmonth) . '</a></b></span></td>';
				} else {
					echo '<td bgcolor=' . $daymark . '><span 
					style="background: ' . $backcolor . ';"><a 
					href="engine/changedate.php?date=' . date("Y-m-
					d", $tmpmonth) . '">' . date("d", $tmpmonth) . '</a></span></td>';
				}
			}
			if ($i != 1 or $j >= $startpos) {
				$tmpmonth = mktime(0, 0, 0, date("m", $tmpmonth), date("d", $tmpmonth) + 1, date("y", $tmpmonth));
			}
		}
		echo '</tr>';

	}
	echo '</table>';
}
function hasAppointments($database, $date) {
	global $session;
	global $singleAgenda;
	$tmp = $date;
	$tmp1 = mktime(0, 0, 0, date("m", $date), date("d", $date) + 1, date("Y", $date));
	if ($session->logged_in && !$singleAgenda) {
		$sql = "select * from events where status!=1 and date>=$tmp and date<$tmp1 and user_id=" . $session->id . " order by date asc";
	} else {
		$sql = "select * from events where status!=1 and date>=$tmp and date<$tmp1 order by date asc";
	}
	//echo $sql."<br>";
	$recordYSet = & $database->Execute($sql);
	$count = 0;

	while (!$recordYSet->EOF) {
		$count++;
		$recordYSet->MoveNext();

	}
	return $count > 0;
}