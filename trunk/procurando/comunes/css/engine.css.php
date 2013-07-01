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
header('Content-Type: text/css');
header('Pragma: no-cache');

/* Color scheme */
$page_color='#000000';
$box_background='#fff';
$box_border='#ccc';


?>

a img {
    border: 0;
}


body{
 margin: 0;
 padding:0; 
 color: <?php echo $page_color?> ;
 }	 
	 

#box{
text-align: center;
margin-top: 10%;
margin-left: 25%; 
margin-right:25%; 
padding: 10px; 
border: 1px solid <?php echo $box_border;?>;
-moz-border-radius: 12px 12px 12px 12px;
}
