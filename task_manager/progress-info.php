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




if(isset($_GET['delete_progress'])){
  $action_id = $_GET['aten_id'];
  
  $sql = "DELETE FROM task_progress WHERE aten_id = :id";
  $sent_po = "progress-info.php";
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
          <div class="row">
            <div class="col-md-8 ">
              <div class="btn-group">
                <?php 
               
                  $sql = "SELECT * FROM task_progress
                          WHERE atn_user_id = $user_id AND end_time IS NULL";
                

                  $info = $obj_admin->manage_all_info($sql);
                  $num_row = $info->rowCount();
                  if($num_row==0){
              ?>

                <div class="btn-group">
                  <form method="post" role="form" action="">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit" name="add_punch_in" class="btn btn-primary btn-lg rounded" >Start Task</button>
                  </form>
                  
                </div>

              <?php } ?>

              </div>
            </div>
            
          </div>

          <center><h3>Manage Task Progress</h3>  </center>
          <div class="gap"></div>

          <div class="gap"></div>

          <div class="table-responsive">
            <table class="table table-codensed table-custom">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Total Duration</th>
                  <th>Status</th>
                  <?php if($user_role == 1){ ?>
                  <th>Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>

              <?php 
                if($user_role == 1){
                  $sql = "SELECT a.*, b.fullname 
                  FROM task_progress a
                  LEFT JOIN tbl_admin b ON(a.atn_user_id = b.user_id)
                  ORDER BY a.aten_id DESC";
                }else{
                  $sql = "SELECT a.*, b.fullname 
                  FROM task_progress a
                  LEFT JOIN tbl_admin b ON(a.atn_user_id = b.user_id)
                  WHERE atn_user_id = $user_id
                  ORDER BY a.aten_id DESC";

                }
                

                  $info = $obj_admin->manage_all_info($sql);
                  $serial  = 1;
                  $num_row = $info->rowCount();
                  if($num_row==0){
                    echo '<tr><td colspan="7">No Data found</td></tr>';
                  }
                      while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
              ?>
                <tr>
                  <td><?php echo $serial; $serial++; ?></td>
                  <td><?php echo $row['fullname']; ?></td>
                  <td><?php echo $row['start_time']; ?></td>
                  <td><?php echo $row['end_time']; ?></td>
                  <td><?php
                    if($row['total_duration'] == null){
                      $date = new DateTime('now', new DateTimeZone('Africa/Nairobi'));
                      $current_time = $date->format('d-m-Y H:i:s');

                      $dteStart = new DateTime($row['start_time']);
                      $dteEnd   = new DateTime($current_time);
                      $dteDiff  = $dteStart->diff($dteEnd);
                      echo $dteDiff->format("%H:%I:%S"); 
                    }else{
                      echo $row['total_duration'];
                    }
                    

                  ?></td>
                  <?php if($row['end_time'] == null){ ?>
                  <td>
                    <form method="post" role="form" action="">
                      <input type="hidden" name="punch_in_time" value="<?php echo $row['start_time']; ?>">
                      <input type="hidden" name="aten_id" value="<?php echo $row['aten_id']; ?>">
                      <button type="submit" name="add_punch_out" class="btn btn-danger btn-xs rounded" >End Task</button>
                    </form>
                  </td>
                <?php } ?>
                <?php if($user_role == 1){ ?>
                 <td>
                  <a title="Delete" href="?delete_progress=delete_progress&aten_id=<?php echo $row['aten_id']; ?>" onclick=" return check_delete();"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
              <?php } ?>
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


<?php

include("include/footer.php");



?>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
