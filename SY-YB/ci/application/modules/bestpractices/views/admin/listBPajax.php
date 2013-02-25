<?php
foreach($list as $row)
{
    //echo $row['statement'].' -'. '<a href="updateBP/'.$row['id'].'" class="jqupdate" id="'.$row['id'].'">Update</a><br />';
    echo '<div class="adminItem">'. $row['statement'].' <div  class="jqupdate" data-uid="'.$row['id'].'">Update</div></div>'."\n";
}
