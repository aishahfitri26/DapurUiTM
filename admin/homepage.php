<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: "Lato", sans-serif;
  margin: 0;
  padding: 0;
}

/* Style the header */
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 60px;
  background-color: #111;
  color: white;
  display: flex;
  align-items: center;
  padding: 0 20px;
  box-sizing: border-box;
}

/* Add a logout button in the header */
.header .logout-button {
  margin-left: auto;
  padding: 6px 8px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  text-align: left;
  cursor: pointer;
  outline: none;
  box-sizing: border-box;
}

/* On mouse-over */
.header .logout-button:hover {
  color: #f1f1f1;
}

/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 60px; /* Move the sidenav down to accommodate the header */
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
  box-sizing: border-box;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  box-sizing: border-box;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 60px 10px 10px 10px; /* Add padding to accommodate the header */
  box-sizing: border-box;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="header">
  <span>Admin Panel</span>
  <a href="logout.php" class="logout-button">Logout</a>
</div>

<div class="sidenav">
  <a href="adminpage.php">Home</a>
  <a href="all_user.php">Users</a>
  <button class="dropdown-btn">Restaurant
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="all_restaurants.php">All Restaurants</a>
    <a href="add_restaurants.php">Add Restaurants</a>
  </div><button class="dropdown-btn">Menu
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="all_menu.php">All Menu</a>
    <a href="add_menu.php">Add Menu</a>
  </div>
  <a href="all_orders.php">Orders</a>
</div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>

</body>
</html>