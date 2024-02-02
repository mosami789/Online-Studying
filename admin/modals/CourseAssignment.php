<?php 
    $id = $_GET["id"]; 
    $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
    $selAssi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$id' ORDER BY assi_id desc");
?>

<!-- Modal For Add Assignment -->
<div class="modal fade" id="modalForAssi2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addassifrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Assignment Name</label>
            <input name="assi_name" class="mb-2 form-control form-control" placeholder="Input Assignment Name" required="" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Course</label>
            <input disabled name="cou_name" class="mb-2 form-control form-control" required="" value="<?php echo $selCourse['cou_name'];  ?>" autocomplete="off">
            <input type="hidden" name="id_course" value="<?php echo $selCourse['cou_id'];  ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label>DeadLine</label>
            <input type="date" name="deadlinedate" class="form-control" required="" placeholder="Input Birhdate" autocomplete="off" >
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="assi_description" class="form-control form-control-lg " placeholder="Input Exam Description" required="" required="" autocomplete="off" style="height: 132px;"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForAddAssi" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>