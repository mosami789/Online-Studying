<?php
   $id = $_GET["id"];
   $selQueReq = $conn->query("SELECT * FROM stu_questions WHERE order_id='$id'")->fetch(PDO::FETCH_ASSOC);
   $adminlecid = $selQueReq['lecturer_id'];
   $StuId = $selQueReq['stu_id'];
   $GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
   $GetStuInfo = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$StuId'")->fetch(PDO::FETCH_ASSOC);

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
                        <div>View Question ID : <?php  echo $id; ?> - Student : <?php echo $GetStuInfo['stu_fullname']; ?>    
                        </div>
                    </div>
                </div>   
            </div>
            <div class="scrollbar-container"></div>

        </div>

        <div class="col-md-12">
            <nav class="" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="home.php?page=student-questions">Student Questions</a></li>
                    <li class="active breadcrumb-item" aria-current="page">Question ID : <?php  echo $id; ?> - Student : <?php echo $GetStuInfo['stu_fullname']; ?></li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="main-card mb-3 card">
                        <div class="no-gutters row">
                            <div class="col-md-6">
                                <div class="pt-0 pb-0 card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left ">
                                                            <div class="widget-heading">Student</div>
                                                        </div>
                                                        <div class="widget-content-right row">
                                                            <img width="40" height="40" class="rounded-circle" src="../uploads/imgs/profiles/<?php echo $GetStuInfo['stu_profile']; ?>" alt="">
                                                        <div class="widget-numbers ml-3"><?php echo $GetStuInfo['stu_fullname']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Time</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-primary"><?php echo $selQueReq['created_time']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pt-0 pb-0 card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Admin</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-danger"><?php echo $GetAdminInfo['admin_name']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Replied Time</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-warning"><?php echo $selQueReq['replied_time']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <?php
                    if ($selQueReq['question'] != ''){
                        echo '<div class="alert-primary alert col-md-11 p-3 mt-2">
                        <h5 id="QuestionText">'.$selQueReq['question'].'</h5>
                        </div>';
                    };
                    if ($selQueReq['img'] != ''){
                        echo '<div align="center" class="col-md-12 mt-4">
                        <img src="../uploads/imgs/questions/'.$selQueReq['img'].'" class="card-img-bottom col-md-6" alt="...">
                        </div>';
                    };
                    ?>
                    <form id="SendReply" method="post">
                        <div class="form-group mt-4">
                            <legend>Reply</legend>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <textarea name="ReplyText" class="form-control form-control " placeholder="Input Your Reply" required="" autocomplete="off" style="height: 132px;"><?php echo $selQueReq['answer']; ?></textarea>
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-primary mt-1 btn">Update Reply</button>
                        </div>
                    </form>

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
		url: 'libs/Student/ReplyQuestion.php?key=2',
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
</script>