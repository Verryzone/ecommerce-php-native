<?php 
include_once("config.php");

function pageIsAktif($page_aktif= [''], $isDropDown = false) {
      if(isset($_GET["page"])) {
            foreach($page_aktif as $page) {
                  if($_GET["page"] == $page) {
                        if($isDropDown) {
                              echo "open active";
                        } else {
                              echo "active";
                        }
                  } else {
                        echo "";
                  }
            }
      } else {
            if($page_aktif[0] == 'dashboard') {
                  echo "active";
            } else {
                  echo "";
            }
      }
}

function rupiah($angka) {
      return "Rp " . number_format($angka, 0, ",", ".");
}

function randomCategoryCode($categoryCode = '') {
      global $dbconnect;
      $sql = "SELECT code FROM categories WHERE code = '$categoryCode'";
      $query = mysqli_query($dbconnect, $sql);
      if (mysqli_num_rows($query) > 0) {
            $categoryCode = randomCategoryCode($categoryCode);
      } else {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $kode = 'CAT';
            for ($i = 0; $i < 6; $i++) {
                  $kode .= $characters[random_int(0, strlen($characters) - 1)];
            }

            $categoryCode = $kode;
      }
      return $categoryCode;
}

// auto select
function autoselect($sumber, $value) {
   if($sumber == $value) {
      echo "selected";
   } else {
      echo "";
   }
}

// name of category
function categoryName($id) {
      global $dbconnect;
      $args = "SELECT * FROM categories WHERE id = '$id'";
      $query = mysqli_query($dbconnect, $args);
      if(mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_array($query);
            return $data['name'];
      } else {
            return "";
      }
   
}
?>