
<?php

require 'authentication.php'; // admin authentication check 

// auth check
$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['name'];
$security_key = $_SESSION['security_key'];
$user_role = $_SESSION['user_role'];
if ($user_id == NULL || $security_key == NULL) {
    header('Location: index.php');
}




if(isset($_GET['delete_attendance'])){
  $action_id = $_GET['aten_id'];
  
  $sql = "DELETE FROM task_progress WHERE aten_id = :id";
  $sent_po = "attendance-info.php";
  $obj_admin->delete_data_by_this_method($sql,$action_id,$sent_po);
}


if(isset($_POST['add_punch_in'])){
   $info = $obj_admin->add_punch_in($_POST);
}

if(isset($_POST['add_punch_out'])){
    $obj_admin->add_punch_out($_POST);
}


$page_name="Task Progress";
include("include/sidebar.php");

//$info = "Hello World";
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



    <div class="row">
      <div class="col-md-12">
        <div class="well well-custom">

 <!--start of snippet that displays image on web page  -->
<?php
$string =array();
$filePath='../My_Emotion/images/';
        $dir = opendir($filePath);
while ($file = readdir($dir)) { 
   if (preg_match("/.png/",$file) || preg_match("/.jpg/",$file) || preg_match("/.gif/",$file) ) { 
   $string[] = $file;
   }
}
while (sizeof($string) != 0){
  $img = array_pop($string);
  echo "<img src='$filePath$img' >";
}
?>

<script>
  //var folder = "E:\New folder";
  //C:\wamp\www\MAIN_PROJECT\My_Emotion\images
  var folder = "../My_Emotion/images/";

$.ajax({
    url : folder,
    success: function (data) {
        $(data).find("a").attr("href", function (i, val) {
            if( val.match(/\.(jpe?g|png|gif)$/) ) { 
                $("body").append( "<img src='"+ folder + val +"'>" );
            } 
        });
    }
});  
</script>

        </div>
      </div>
    </div>


<?php
//  end of snippet that displays image on web page


include("include/footer.php");



?>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
