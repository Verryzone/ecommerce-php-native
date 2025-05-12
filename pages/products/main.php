<?php 
if(isset($_GET["section"])) {
      $section = $_GET["section"];
      include("$section.php");
} else {
      include("list.php");
}
?>
