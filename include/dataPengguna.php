<?php 
/*###############[DASHGUM BASIC TEMPLATE BY ALVAREZ - POWERED BY ADAM SMITH @ 2020]########################################
#                                                                                                                       #
#																														#
#																														#
#            All right reserved to the respective owners. Full template can be downloaded from the developer website	#
#            PHP Codes modified and developed by Adam Smith 2020. Contact me for more details							#
#            jasc.studio66@gmail.com																					#
#																														#
#########################################################################################################################*/

//Dapatkan rekod pengguna yang sedang login
$data=mysqli_query($conn,"SELECT * from users where username='$_SESSION[username]'") or die (mysqli_error($con));	
$showdata=mysqli_fetch_array($data)or die (mysqli_error($con));	
$Bil_DataSQL=mysqli_num_rows($data)or die (mysqli_error($con));	


?>