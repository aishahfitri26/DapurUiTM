<?php
if(!empty($_GET["action"])) 
{
$productId = isset($_GET['menu_id']) ? htmlspecialchars($_GET['menu_id']) : '';
$quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

switch($_GET["action"])
 {
	case "add":
		if(!empty($quantity)) {
								$stmt = $db->prepare("SELECT * FROM menu where menu_id= ?");
								$stmt->bind_param('i',$productId);
								$stmt->execute();
								$productDetails = $stmt->get_result()->fetch_object();
                                $itemArray = array($productDetails->menu_id=>array('menu_name'=>$productDetails->menu_name, 'menu_id'=>$productDetails->menu_id, 'quantity'=>$quantity, 'price'=>$productDetails->price));
					if(!empty($_SESSION["cart-item"])) 
					{
						if(in_array($productDetails->menu_id,array_keys($_SESSION["cart-item"]))) 
						{
							foreach($_SESSION["cart-item"] as $k => $v) 
							{
								if($productDetails->menu_id == $k) 
								{
									if(empty($_SESSION["cart-item"][$k]["quantity"])) 
									{
									$_SESSION["cart-item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart-item"][$k]["quantity"] += $quantity;
								}
							}
						}
						else 
						{
								$_SESSION["cart-item"] = $_SESSION["cart-item"] + $itemArray;
						}
					} 
					else 
					{
						$_SESSION["cart-item"] = $itemArray;
					}
			}
			break;
			
	case "remove":
		if(!empty($_SESSION["cart-item"]))
			{
				foreach($_SESSION["cart-item"] as $k => $v) 
				{
					if($productId == $v['menu_id'])
						unset($_SESSION["cart-item"][$k]);
				}
			}
			break;
			
	case "empty":
			unset($_SESSION["cart-item"]);
			break;
			
	case "check":
			header("location:check_out.php");
			break;
	}
}