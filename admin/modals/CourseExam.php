<?php 
    $id = $_GET["id"]; 
    $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
    $CountExams = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$id' ORDER BY ex_id desc");
?>

<!-- Modal For Add Exam -->
<div class="modal fade" id="modalForExam2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addexamfrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam - <?php echo $selCourse['cou_name'];  ?> Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Exam Name</label>
            <input name="examTitle"class="mb-2 form-control form-control" placeholder="Input Exam Name" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Course</label>
            <input disabled name="name_course" class="mb-2 form-control form-control" placeholder="Input Exam Name" required="" value="<?php echo $selCourse['cou_name'];  ?>" autocomplete="off">
            <input type="hidden" name="id_course" value="<?php echo $selCourse['cou_id'];  ?>" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Show Results</label>
            <select class="mb-2 form-control form-control" required="" name="ResultsStatus">
              <option value="yes">Enable</option>
              <option value="no">Disable</option>
            </select>
          </div>
          <div class="form-group">
            <label>DeadLine</label>
            <input type="date" name="deadlinedate" class="form-control" required="" placeholder="Input Birhdate" autocomplete="off" >
          </div>
          <div class="form-group">
            <label>Exam Time Limit (Minutes)</label>
            <input name="timeLimit" type="number" class="mb-2 form-control form-control" placeholder="Input Exam Time Limit" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="examDesc" class="form-control form-control " placeholder="Input Exam Description" required="" autocomplete="off" style="height: 80px;"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Close_modalForAddExam" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>