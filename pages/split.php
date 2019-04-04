<!DOCTYPE html>
<html>
<body>

<?php
$str = 'G i f t E m m a n u e l';

// zero limit
// print_r(explode(',',$str,1));
// print "<br>";
$data = array();

// positive limit
$data = (explode(' ',$str,3));
echo sizeof($data).'<br>';
echo sizeof('200').'<br>';
for($i= 0;$i<sizeof($data);$i++){
	echo $data[2].'<br>';
}


print "<br>";
echo $data[0];
print "<br>";
echo $data[1];
// negative limit
// print_r(explode(',',$str,-1));
?>  

</body>
</html>