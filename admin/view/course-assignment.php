<?php 
    $id = $_GET["id"]; 
    $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
    $selAssi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$id' ORDER BY assi_id desc");
?>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-config icon-gradient bg-plum-plate">
                            </i>
                        </div>
                        <div>Manage Course <?php echo $selCourse['cou_name'];  ?> Assignments
                            <div class="page-title-subheading">
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="scrollbar-container"></div>   

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                      <li class="breadcrumb-item"><a href="home.php?page=manage-course">Manage Courses</a></li>
                      <li class="breadcrumb-item"><a href="home.php?page=course-setting&id=<?php echo $_GET["id"]; ?>"><?php echo $selCourse['cou_name'];  ?></a></li>
                      <li class="active breadcrumb-item" aria-current="page">Assignments</li>
                  </ol>
                </nav>
                <div class="main-card mb-3 card">
                    <div class="card-header">Assignment LIST
                        <span class="badge badge-pill badge-primary ml-2">
                              <?php echo $selAssi->rowCount();?>
                        </span>
                        <div class="btn-actions-pane-right">
                             <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                        </div>
                        <button class="btn btn btn-primary ml-4" id="btnaddAssi2" data-toggle="modal" data-target="#modalForAssi2">Add Assignment</button>

                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                            <thead>
                            <tr>
                                <th class="text-left pl-3">#</th>
                                <th class="text-left pl-4">Assignment Title</th>
                                <th class="text-left ">Course</th>
                                <th class="text-left ">Created Time</th>
                                <th class="text-left ">DeadLine</th>
                                <th class="text-center" >Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($selAssi->rowCount() > 0)
                                {
                                    while ($selAssiRow = $selAssi->fetch(PDO::FETCH_ASSOC)) { $i++; ?>
                                        <tr>
                                            <th class="pl-3"scope="row">#<?php echo $i; ?></th>    
                                            <td class="pl-4"><?php echo $selAssiRow['assi_name']; ?></td>
                                            <td><a href="home.php?page=course-setting&id= <?php echo $selCourse['cou_id']; ?>">
                                            <?php 
                                            echo $selCourse['cou_name'];
                                             ?>
                                            </td>
                                            <td><?php echo $selAssiRow['assi_created']; ?></td>
                                            <td><?php echo $selAssiRow['assi_deadline']; ?></td>
                                            <td class="text-center">
                                                <a href="home.php?page=assignment-setting&id=<?php echo $selAssiRow['assi_id']; ?>&course=<?php echo $_GET["id"]; ?>" type="button" class="mr-2 btn btn-primary mb-1">Manage</a>
                                                <a href="home.php?page=assignment-questions&id=<?php echo $selAssiRow['assi_id']; ?>&course=<?php echo $_GET["id"]; ?>" type="button" class="mr-2 btn btn-info mb-1">Questions</a>
                                                <button type="button" id="DeleteAssi" data-id='<?php echo $selAssiRow['assi_id']; ?>'  class="mr-2 btn btn-danger mb-1">Delete</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="6">
                                        <h3 class="p-3">No Assignment Found...</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                        <div id="notFound_1"  class="pl-3 text-primary" style="display: none;"><legend>No Assignment found...</legend></div>
                    </div>
                </div>
            </div>  

        </div>
    </div>

<script>
//Delete Assignment
$(document).on("click", "#DeleteAssi", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this assignment?",
			icon: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete  now!'
		}).then((result) => {
      if (result.value) {
        $.ajax({
        type : "post",
        url : "libs/Assignments/deleteassi.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            toastr.success('Assignment has been successfully deleted.','Success');
            refreshDiv();
          };
        },
        error : function(xhr, ErrorStatus, error){
          console.log(status.error);
        }
      });
      };
    });
  return false;
});

//Clear Model Add Assignment
$(document).on("click","#btnaddAssi2" , function(){
  document.getElementById("addassifrm").reset();
});
</script>