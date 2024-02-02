<?php
$course_id = $_GET["id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
$CountCou_Exam = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$course_id' ORDER BY ex_id desc"); 
$CountCou_Lec = $conn->query("SELECT * FROM lec_tbl WHERE cou_id='$course_id' ORDER BY lec_id desc"); 
$CountCou_Assi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$course_id' ORDER BY assi_id desc");
$CountCou_Stu = $conn->query("SELECT * FROM course_check WHERE course_id='$course_id' ORDER BY coustu_id desc"); 
$adminlecid = $CourseInfo['admin_created'];
$GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
?>
<title><?php  echo $WebTitle. ' | Course : '. $CourseInfo['cou_name']; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-12">
               
                        
                        <div class="row" >
                            <h3 class="col-md-7">Course - <?php echo $CourseInfo['cou_name'] ?> - Details</h3>
                            <div class="col-md-5">
                                <div class="row">   
                                <?php
                                        echo '<h3 class="alert alert-danger p-1 text-center" style="margin: auto; border: 2px solid #DB504A;">You should login to subscribe.</h3>';
                                ?>      
                                </div>                        
                            </div>
                        </div>

                        <div class="divider"></div>
                        <div class="Exam_Card-body">
                            <div align="center" class="row">
                                <div class="Exam_Card text-white bg-danger mb-3" style="width: 210px;">
                                    <div class="Exam_Card-header"><p class="p-2">Students</p></div>
                                        <div class="Exam_Card-body">
                                            <h5 class="text-white">
                                            <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">    
                                            <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $CountCou_Stu->rowCount() ?></span>
                                            </div>
                                            </h5>
                                        </div>
                                </div>
                                <div class="Exam_Card text-white bg-warning mb-3" style="width: 210px;">
                                    <div class="Exam_Card-header"><p class="p-2">Lectures</p></div>
                                        <div class="Exam_Card-body">
                                            <h5 class="text-white">
                                            <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">    
                                            <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $CountCou_Lec->rowCount() ?></span>
                                            </div>
                                            </h5>
                                        </div>
                                </div>
                                <div class="Exam_Card text-white bg-primary mb-3" style="width: 210px;">
                                    <div class="Exam_Card-header"><p class="p-2">Exams</p></div>
                                        <div class="Exam_Card-body">
                                            <h5 class="text-white">
                                            <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">    
                                            <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $CountCou_Exam->rowCount() ?></span>
                                            </div>
                                            </h5>
                                        </div>
                                </div>
                                <div class="Exam_Card text-white bg-dark mb-3" style="width: 210px;">
                                    <div class="Exam_Card-header"><p class="p-2">Assignments</p></div>
                                        <div class="Exam_Card-body">
                                            <h5 class="text-white">
                                            <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">    
                                            <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $CountCou_Assi->rowCount() ?></span>
                                            </div>
                                            </h5>
                                        </div>
                                </div>   
                            </div>

                            <div class="row">
                            <div class="col-md-12">
                                <div align="center" class="Exam_Card-withouthover text-white bg-info mb-3" style="width: auto;">
                                    <div class="Exam_Card-header"><p class="p-2">Course Description</p></div>
                                        <div class="Exam_Card-body">
                                            <h5 class="text-white"> <?php echo $CourseInfo['cou_description'] ?></h5>
                                        </div> 
                                </div>
                            </div>
                          
                            
                                <div class="col-md-4 mt-1">
                                    <div align="center" class="Exam_Card-withouthover text-white bg-info">
                                        <div class="Exam_Card-header"><p class="p-2">Course Lecturer</p></div>
                                            <div class="Exam_Card-body">
                                                <h5 class="text-white"> <?php echo $GetAdminInfo['admin_name']; ?></h5>
                                            </div> 
                                    </div>
                                </div>
                 
                                <div class="col-md-4 mt-1">
                                    <div align="center" class="Exam_Card-withouthover text-white bg-info">
                                        <div class="Exam_Card-header"><p class="p-2">Course Date</p></div>
                                            <div class="Exam_Card-body">
                                                <h5 class="text-white"> <?php echo $CourseInfo['cou_created'] ?></h5>
                                            </div> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div><br>
            </div>
        </div><br>
    </div>
</div>
</div>   
