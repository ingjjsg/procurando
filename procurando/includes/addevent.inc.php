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
<div class="box">
<h3><?php echo $lang["index-addevent"];?></h3>
[<a href="repeating_event.php"><?php echo $lang['link-repeatingevent'];?></a>]
<form action="engine/new_event.php" method="post" >
<fieldset>
<label for="date2"><?php echo $lang["date"];?> (yyyy-mm-dd):</label>
<input id="date2" name="date" onfocus="showCalendarControl(this);" type="text" />
<br/>
<label for="time"><?php echo $lang["time"];?> (HH:MM):</label>
<input id="time" name="time" onfocus="showTimeControl(this);" type="text" />
<br/>
<input type="checkbox" id="deadline" name="deadline" value="deadline" />
<label for="deadline"><?php echo $lang['add-deadline'];?></label>
<br/>
<?php

if ($enableReminders) {
?>
<input type="checkbox" id="x1day" name="x1day" value="x1day" />
<label for="x1day"><?php echo $lang['add-1day'];?></label>
<input type="checkbox" id="x3hour" name="x3hour" value="x3hour" />
<label for="x3hour"><?php echo $lang['add-3hour'];?></label>
<br/>
<input type="checkbox" id="x1hour" name="1xhour" value="x1hour" />
<label for="x1hour"><?php echo $lang['add-1hour'];?></label>
<input type="checkbox" id="x15min" name="x15min" value="x15min" />
<label for="x15min"><?php echo $lang['add-15min'];?></label>
<br/>
<?php

}
?>


<label for="title"><?php echo $lang['add-title'];?></label>
<input id="title" type="text" name="title" size="50" /><br/>
<label for="description"><?php echo $lang['add-description'];?></label>
<input id="description" type="text" name="description" size="50" />
<input type="submit" value="<?php echo $lang['add-button'];?>" name="newEvent"/>
</fieldset>
</form>
</div>
