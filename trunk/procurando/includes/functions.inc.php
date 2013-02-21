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
function printTODOlist($db, $backgroundColors, $limit) {
	global $lang;
	global $allowGuestAccess;
	global $session;
	global $singleAgenda;
	$sql = "";
	if ($session->logged_in&&!$singleAgenda) {
		$sql = "select * from todo where status=0 and user_id=" . $session->id . " order by priority desc limit 0," . $limit;
	} else
		$sql = "select * from todo where status=0 order by priority desc limit 0," . $limit;
	if ($sql != "") {
		$recordSet = & $db->Execute($sql);
		while (!$recordSet->EOF) {
			echo '<div class="todo">';
			$todoid = $recordSet->fields["id"];

			$priority = $recordSet->fields["priority"];

			$color[] = "#cceedd";
			$color[] = "#c8c8ff";
			$color[] = "#ffffb0";
			$color[] = "#ffd850";
			$color[] = "#ff50a8";
			$color[] = "#ff0000";

			echo '<div style="';
			if ($backgroundColors) {
				echo 'background-color:' . $color[$priority] . ';';
			}
			echo 'width: 100%;">';
			if ($priority < 5)
				$upprior = $priority +1;
			else
				$upprior = $priority;

			if ($priority > 0)
				$downprior = $priority -1;
			else
				$downprior = $priority;

			echo "<a onclick=\"javascript:return confirm('" . $lang['certainfinish'] . "')\" href=\"?finishTODO=$todoid\"><img height='100%' src=\"img/finished.png\" alt=\"finish\" /></a>";
			echo "<a onclick=\"javascript:return confirm('" . $lang['certainremove'] . "')\" href=\"?deleteTODO=$todoid\"><img height='100%' src=\"img/deleteTODO.png\" alt=\"delete\" /></a>";
			echo "<a href=\"?newprior=$upprior&amp;eventid=$todoid\"><img height='100%' src=\"img/uparrow.png\" alt=\"up\" /></a>";
			echo "<a href=\"?newprior=$downprior&amp;eventid=$todoid\"><img height='100%' src=\"img/downarrow.png\" alt=\"down\" /></a>";

			echo " " . $recordSet->fields["text"];

			echo "</div>";
			echo '</div>';
			$recordSet->MoveNext();
		}
	}
}