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
 * Copyright 2006, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */
?>
<?php
header('Content-Type: text/css');
header('Pragma: no-cache');

$page_color='#000000';

$side_column_background='#ffffff';
$central_column_background='#ffffff';

//$frame_border='#000000';

$box_background='#ffffff';
$box_border='#ccc';


?>

.box {
  margin: 0.6em 0.6em 0.3em 0.6em;
  padding: 0.6em 0.6em 0.6em 0.6em;
  background-color: <?php echo $box_background;?>;
  border: solid 1px <?php echo $box_border;?>;
  -moz-border-radius: 8px 8px 8px 8px;
  width: 733px;
  
}

a img {
    border: 0;
}


body{
 margin: 0;
 padding:0; 
 color: <?php echo $page_color?> ;
 }	 
	 
#lh-col{
	text-align: center;
 position:absolute;
 top: 62px;
 left:0;
 width:200px;
 z-index:3;
 background:<?php echo $side_column_background;?>;
 color: <?php echo $page_color?>;}

#rh-col{
 position:absolute;
 top: 62px;
 right:0;
 width:300px;
 z-index:2;
 background:<?php echo $side_column_background;?>;
 color: <?php echo $page_color?>;}

#c-block {
 width:100%;
 
 z-index:1;
 background:<?php echo $central_column_background;?>;
 color: <?php echo $page_color?>;
 height:80%;}

#hdr{
 height:62px; 
 width:100%; 
 background: <?php echo $side_column_background;?>;
 color: <?php echo $page_color?>; 
 margin:0;
 text-align:center;
  }

#c-col{
 margin:0 302px 0 202px;
 position:relative;
 background:<?php echo $central_column_background?>;
 color: <?php echo $page_color?>;
 z-index:5;
 border-width:0 1px;
 }

#ftr {
 width:100%;
 text-align:center;
 border-width:1px 0;
 background: <?php echo $side_column_background;?>;
 color: <?php echo $page_color?>;
 margin:0;
 }


/* Presentation Stylesheet */ 
p {
 padding: 0 15px;
 }

h4, h3 {
 margin:0; 
 padding: 5px 0;
 }
p>input#loginsubmit {
background: #f0f0f0 url(img/lock_break.png) 2px 3px no-repeat;
padding: 3px 5px 3px 22px;
text-align: left;
margin-right: 25px;
margin-top: 5px;
width: 100px;
text-align: center;
}
#loginbox{
	text-align: center;
margin-top: 20%;
margin-left: 25%; 
margin-right:25%; 
padding: 10px; 
border: 1px solid <?php echo $box_border;?>;
-moz-border-radius: 12px 12px 12px 12px;
}
#editbox{
margin-top: 20%;
margin-left: 25%; 
margin-right:25%; 
padding: 10px; 
border: 1px solid <?php echo $box_border;?>;
-moz-border-radius: 12px 12px 12px 12px;
}
