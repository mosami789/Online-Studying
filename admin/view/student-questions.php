<?php
$stuid = '23';
$Stu_Questions = $conn->query("SELECT * FROM stu_questions ORDER BY order_id desc");
$Stu_Questions3 = $conn->query("SELECT * FROM stu_questions ORDER BY order_id desc");
$Stu_Questions2 = $conn->query("SELECT * FROM stu_questions WHERE answer = '' ORDER BY order_id desc");
?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-help1 icon-gradient bg-plum-plate">
                            </i>
                        </div>
                        <div>Manage Student Questions
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="scrollbar-container"></div>

            <div class="col-md-12">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
                            Total Questions <span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $Stu_Questions->rowCount();?></span>
                        </div>
                        <ul class="nav">
                            <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-0" class="active nav-link">Student Questions<span class="badge badge-pill badge-danger p-1 ml-2"><?php echo $Stu_Questions2->rowCount();?></span></a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-1" class="nav-link">Replied<span class="badge badge-pill badge-info p-1 ml-2"><?php echo ($Stu_Questions->rowCount() - $Stu_Questions2->rowCount());?></span></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-eg5-0" role="tabpanel">
                            <?php
                            $i = 0;
                            if ($Stu_Questions->rowCount () > 0){
                                while($CreateQueFrm = $Stu_Questions->fetch(PDO::FETCH_ASSOC)){
                                    $adminlecid = $CreateQueFrm['lecturer_id'];
                                    $StuId = $CreateQueFrm['stu_id'];
                                    $GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
                                    $GetStuInfo = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$StuId'")->fetch(PDO::FETCH_ASSOC);
                                    if ($CreateQueFrm['answer'] == ''){
                                        $i++;
                                        echo '<div class="Exam_Card-withouthover">
                                        <div class="Exam_Card-body">
                                        <div class="row">
                                            <div align="center" class="alert alert-dark col-md-3">
                                                <h3 class="text-dark mt-2">Student ID</h3>
                                                <h5 class="text-dark mt-2">'.$CreateQueFrm['stu_id'].'</h5>
                                            </div>
                                            <div align="center" class="alert alert-dark col-md-3">
                                                <h3 class="text-dark mt-2">Student Name</h3>
                                                <a href="home.php?page=student-setting&id='.$CreateQueFrm['stu_id'].'"><h5 class="text-dark mt-2">'.$GetStuInfo['stu_fullname'].'</h5></a>
                                            </div>
                                            <div align="center" class="alert alert-dark col-md-3">
                                                <h3 class="text-dark mt-2">Time</h3>
                                                <h5 class="text-dark mt-2">'.$CreateQueFrm['created_time'].'</h5>
                                            </div>
                                        </div>
                
                                        <div class="alert-primary alert col-md-12 p-3 mt-2">
                                            <h5>'.$CreateQueFrm['question'].'</h5>
                                        </div>';
                
                                        if ($CreateQueFrm['img'] !=''){
                                            echo '<div align="center" class="col-md-12 mt-4">
                                                <img src="../uploads/imgs/questions/'.$CreateQueFrm['img'].'" class="card-img-bottom col-md-5" alt="...">
                                            </div>';
                                        };                        
                                            echo '
                                            <form id="SendReply" method="post">
                                                <div class="form-group mt-4">
                                                    <legend>Reply</legend>
                                                    <input type="hidden" name="id" value="'.$CreateQueFrm['order_id'].'">
                                                    <textarea name="ReplyText" class="form-control form-control " placeholder="Input Your Reply" required="" autocomplete="off" style="height: 132px;"></textarea>
                                                </div>
                                                <div align="right">
                                                    <button type="submit" class="btn btn-primary mt-1 btn">Send Reply</button>
                                                    <div type="button" id="RemoveQuestion" data-id="'.$CreateQueFrm['order_id'].'" class="btn btn-danger mt-1 btn">Remove</div>
                                                </div>
                                            </form>
                                        
                                        </div>
                                        </div>';
                                    }else{
                                        if ($i < 1){
                                            echo '<h2 align="center" class="mt-1 text-danger">There is no questions yet.</h2>';
                                            break;
                                        };
                                    };  
                                };
                            }else{
                                echo '<div class="Exam_Card-withouthover p-3">
                                    <h2 align="center" class="mt-1 text-danger">There is no questions yet.</h2>
                                </div>';
                            };
                            ?>
                            
                            </div>
                            <div class="tab-pane" id="tab-eg5-1" role="tabpanel">
                                <div class="btn-actions-pane-right">
                                    <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                                        <thead>
                                        <tr>
                                            <th class="text-left pl-4">#</th>
                                            <th class="text-center pl-4">Question ID</th>
                                            <th class="text-center">Student</th>
                                            <th class="text-center">Admin</th>
                                            <th class="text-center"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if($Stu_Questions3->rowCount() > 0){
                                                while ($selCourseRow = $Stu_Questions3->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($selCourseRow['lecturer_id'] != '0'){
                                                        $ii++; 
                                                        $adminlecid = $selCourseRow['lecturer_id'];
                                                        $StuId = $selCourseRow['stu_id'];
                                                        $GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
                                                        $GetStuInfo = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$StuId'")->fetch(PDO::FETCH_ASSOC);

                                                        echo '
                                                        <tr>
                                                            <th class="pl-4"scope="row">#'.$ii.'</th>    
                                                            <td class="text-center">'.$selCourseRow['order_id'].'</td>
                                                            <td class="text-center"><a href="home.php?page=student-setting&id='.$GetStuInfo['stu_id'].'">'.$GetStuInfo['stu_fullname'].'</td>
                                                            <td class="text-center">'.$GetAdminInfo['admin_name'].'</td>
                                                            <td class="text-center"><a href="home.php?page=view-questions&id='.$selCourseRow['order_id'].'" class="mr-1 btn btn-success mb-1">View</a></td>
                                                        </tr>';

                                                    };
                                                
                                               };
                                            }else{ ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <h3 class="p-6">No Questions Found...</h3>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="notFound_1" class="pl-3 text-primary" style="display: none;"><legend>No Results found...</legend></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
//Reply
$(document).on("submit","#SendReply" , function(e){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/Student/ReplyQuestion.php?key=1',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
				Notification("Your reply successfully send.","Success");        
                refreshDiv();
			}else{
                NotificationError("There's an error please try again.","Error!");
			};
		},
	});
});

//Remove Question
$(document).on("click", "#RemoveQuestion", function(e){
	e.preventDefault();
   	Swal.fire({
		title: 'Are you sure?',
		text: "you want to remove your question ?",
		icon: 'warning',
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, remove now!'
		}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			$.ajax({
				type : "post",
				url : "libs/Student/RemoveQuestion.php",
				dataType : "json",  
				data : {id:id},
				cache : false,
				success : function(data){
					if(data.status == "success"){
						Swal.fire({
							title: 'Success',
							text: "Your question successfully removed!",
							icon: 'success',
							allowOutsideClick: false,
							confirmButtonColor: '#223C61',
							confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								refreshDiv();
							};
						});
					}else{
						Swal.fire({
							title: 'Error',
							text: "Try Again",
							icon: 'error',
							allowOutsideClick: false,
							confirmButtonColor: '#d33',
							confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								refreshDiv();
							};
						});
					};
				}});
			};
		});
	return false;
});
</script>