<?php

function cucidata($nilai)
{
$nilai=stripslashes($nilai);
$nilai=htmlspecialchars($nilai);
$nilai=addslashes($nilai);
return $nilai;

	
	
}

?>