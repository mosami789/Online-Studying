<?php
$selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC "); 
$selCourse2 = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC "); 
$StudentCourse = $conn->query("SELECT * FROM course_check WHERE student_id='$stuid' ORDER BY coustu_id desc");
$PendingCourses = $conn->query("SELECT * FROM course_req WHERE stu_id='$stuid' ORDER BY order_id desc");

$unsubscribed = ($selCourse->rowCount() - $StudentCourse->rowCount());
$unpending = ($unsubscribed - $PendingCourses->rowCount());
?>
<title><?php  echo $WebTitle. ' | Courses'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-bookmarks icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Available Courses
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>  
            <div class="col-md-12">
                                      
            
            <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                <li class="nav-item">
                    <a role="tab" class="nav-link active show" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0" aria-selected="false">
                        <span class="nav-text">All</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1" aria-selected="false">
                        <span class="nav-text">Subscribed</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a role="tab" class="nav-link" id="tab-c1-2" data-toggle="tab" href="#tab-animated1-2" aria-selected="true">
                        <span class="nav-text">UnSubscribed</span>
                    </a>
                </li>
            </ul>
        
            <div class="tab-content">
                <div class="tab-pane active" id="tab-animated1-0" role="tabpanel">
                    <div class="Exam_Card-withouthover">
                        <p align="center" class="Exam_Card-header">All Courses<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $selCourse->rowCount();?></span></p>      
                        <?php
                            if($selCourse->rowCount() > 0){
                                echo '<div class="Exam_Card-body row">';
                                while($Cou_Create = $selCourse->fetch(PDO::FETCH_ASSOC)){
                                    $CouStu_ID = $Cou_Create['cou_id'];
                                    $selStudentCourse = $conn->query("SELECT * FROM course_check WHERE student_id='$stuid' AND course_id='$CouStu_ID'");
                                    $selStudentCourseReq = $conn->query("SELECT * FROM course_req WHERE stu_id='$stuid' AND cou_id='$CouStu_ID'");
                                    echo '<div align="center" class="Exam_Card bg-dark" style="width: 270px">
                                    <img class="Exam_Card-img-top" src="uploads/imgs/courses/'.$Cou_Create['img'].'" style="height: 210px" alt="'.$Cou_Create['cou_name'].'">
                                    <div class="Exam_Card-body">
                                    <h5 class="Exam_Card-title text-white">'.$Cou_Create['cou_name'].'</h5>
                                    <a href="home.php?page=details&id='.$CouStu_ID.'" class="btn btn-secondary btn-rounded mr-3">Details</a>';
                                    if($selStudentCourse->rowCount() > 0){
                                        echo '<button data-id="'.$CouStu_ID.'" class="btn btn-danger btn-rounded">Subscribed</button>';
                                    }elseif ($selStudentCourseReq->rowCount() > 0){
                                        echo '<button data-id="'.$CouStu_ID.'" class="btn btn-warning btn-rounded">Pending</button>';
                                    }else{
                                        
                                        echo '<button type="button" id="Cou_Subscribe" data-id="'.$CouStu_ID.'" class="btn btn-success btn-rounded">Subscribe</button>';
                                    }
                                    echo '</div>
                                    <div class="Exam_Card-footer text-muted">
                                    '.$Cou_Create['cou_created'].'
                                    </div>
                                    </div>';
                                };
                                echo '</div>';
                            }else{
                                echo '<h1 align="center" class="p-4">There are no courses currently..</h1>';
                            };
                        ?>   
                    </div>
                </div>
                <div class="tab-pane" id="tab-animated1-1" role="tabpanel">
                    <div class="Exam_Card-withouthover">
                        <p align="center" class="Exam_Card-header">Subscribed Courses<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $StudentCourse->rowCount();?></span></p> 
                        <div class="Exam_Card-body">     
                        <?php
                            if($StudentCourse->rowCount() > 0){
                                echo '<div class="row">';
                                while($Cou_Create = $StudentCourse->fetch(PDO::FETCH_ASSOC)){
                                    $CouStu_ID = $Cou_Create['course_id'];
                                    $Cours_iNFO = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$CouStu_ID'")->fetch(PDO::FETCH_ASSOC);
                                    echo '<div align="center" class="Exam_Card bg-dark" style="width: 280px">
                                    <img class="Exam_Card-img-top" src="uploads/imgs/courses/'.$Cours_iNFO['img'].'" style="height: 210px" alt="'.$Cours_iNFO['cou_name'].'">
                                    <div class="Exam_Card-body">
                                    <h5 class="Exam_Card-title text-white">'.$Cours_iNFO['cou_name'].'</h5>
                                    <a href="home.php?page=view&id='.$Cours_iNFO['cou_id'].'" class="btn-success btn btn-rounded mt-2">View Details</a>
                                    <button class="btn btn-danger btn-rounded mt-2 mr-2">Subscribed</button>
                                    </div>
                                    <div class="Exam_Card-footer text-muted">
                                    '.$Cours_iNFO['cou_created'].'
                                    </div>
                                </div>
                                    ';
                                }
                                echo '</div>';
                            }else{
                                echo '<h1 align="center" class="">You are not participating in any courses.</h1>';
                            };
                        ?>   
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-animated1-2" role="tabpanel">
                    <div class="Exam_Card-withouthover">
                        <p align="center" class="Exam_Card-header">UnSubscribed Courses<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $unpending;?></span></p> 
                        <div class="Exam_Card-body">     
                        <?php
                            if($selCourse2->rowCount() > 0){
                                echo '<div class="Exam_Card-body row">';
                                while($Cou_Create2 = $selCourse2->fetch(PDO::FETCH_ASSOC)){
                                    $CouStu_ID2 = $Cou_Create2['cou_id'];
                                    $selStudentCourse2 = $conn->query("SELECT * FROM course_check WHERE student_id='$stuid' AND course_id='$CouStu_ID2'");
                                    $selStudentCourseReq2 = $conn->query("SELECT * FROM course_req WHERE stu_id='$stuid' AND cou_id='$CouStu_ID2'");
                                    
                                    if($selStudentCourse2->rowCount() > 0){
                                    }elseif ($selStudentCourseReq2->rowCount() > 0){
                                    }else{
                                        echo '<div align="center" class="Exam_Card bg-dark" style="width: 280px">
                                        <img class="Exam_Card-img-top" src="uploads/imgs/courses/'.$Cou_Create2['img'].'" style="height: 210px" alt="'.$Cou_Create2['cou_name'].'">
                                        <div class="Exam_Card-body">
                                        <h5 class="Exam_Card-title text-white">'.$Cou_Create2['cou_name'].'</h5>
                                        <a href="home.php?page=details&id='.$CouStu_ID2.'" class="btn btn-secondary btn-rounded mr-3">Details</a>
                                        <button type="button" id="Cou_Subscribe" data-id="'.$CouStu_ID2.'" class="btn btn-success btn-rounded">Subscribe</button>
                                        </div>
                                        <div class="Exam_Card-footer text-muted">
                                        '.$Cou_Create2['cou_created'].'
                                        </div>
                                        </div>
                                        ';
                                    };
                                };
                                echo '</div>';
                                if ($unpending == 0){
                                    echo '<h1 align="center" class="">There are no courses currently..</h1><br>';
                                };
                            }else{
                                echo '<h1 align="center" class="p-4">There are no courses currently..</h1>';
                            };
                        ?>   
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
    </div>

<script>
//Course Subscribe
$(document).on("click","#Cou_Subscribe" , function(e){
	e.preventDefault();
	var id = $(this).data("id");
	$.ajax({
		type : "post",
		url : "libs/CourseRequest.php",
		dataType : "json",  
		data : {Cou_Id:id},
		cache : false,
		success : function(data){
		if(data.status == "success")
		{
			Swal.fire(
				'Success',
				"You have been successfully send order to subscribe.",
				'success'
			);
			refreshDiv();
		}
		},
		error : function(xhr, ErrorStatus, error){
		console.log(status.error);
		}
	});
});
</script>