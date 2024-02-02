<?php 

$selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC "); 
$selStudent = $conn->query("SELECT COUNT(stu_id) as totStudents FROM student_tbl ")->fetch(PDO::FETCH_ASSOC);
$selExam = $conn->query("SELECT COUNT(ex_id) as totExam FROM exam_tbl ")->fetch(PDO::FETCH_ASSOC);
$selAssi = $conn->query("SELECT COUNT(assi_id) as totAssi FROM assi_tbl ")->fetch(PDO::FETCH_ASSOC);
$sellec = $conn->query("SELECT COUNT(lec_id) as totlec FROM lec_tbl ")->fetch(PDO::FETCH_ASSOC);
$selStu_Questions = $conn->query("SELECT COUNT(order_id) as totque FROM stu_questions ")->fetch(PDO::FETCH_ASSOC);
$CountRequests = $conn->query("SELECT * FROM student_tbl WHERE stu_status='pending' ORDER BY stu_id desc");
?>
<title><?php  echo $WebTitle. ' | Home'; ?></title>
<link href="css/main.css" rel="stylesheet">
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="col-md-12" style="margin: auto; top: 10px">
                <div class="card filup">
                    <div  class="card-body">
                        <div class="row">
                          <h2 align="center" class="col-md-12 mt-3 mb-4 filup">Welcome to QUIZLET website</h2>
                          <div class="divider col-md-12 filup"></div>
                          <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6 card p-2 filup" style="margin:auto;">
                              <div id="carouselExampleControls2" class="carousel slide carousel-fade" data-ride="carousel">
                                  <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://via.placeholder.com/800x400" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>First Slide</h5>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://via.placeholder.com/800x400" alt="Second slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Second Slide</h5>
                                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://via.placeholder.com/800x400" alt="Third slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Third Slide</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                  </div>
                                  <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                  </a>
                              </div>
                            </div>
                            </div>
                            <div align="center" class="row mt-3">
                                  <div class="Exam_Card text-white bg-danger mb-3 filup" style="width: 290px;">
                                      <div class="Exam_Card-header"><p class="p-2">Students</p></div>
                                          <div class="Exam_Card-body">
                                              <h5 class="text-white">
                                              <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" >    
                                              <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $selStudent['totStudents']; ?></span>
                                              </div>
                                              </h5>
                                          </div>
                                  </div>
                                  <div class="Exam_Card text-white bg-info mb-3 filup" style="width: 290px;">
                                      <div class="Exam_Card-header"><p class="p-2">Courses</p></div>
                                          <div class="Exam_Card-body">
                                              <h5 class="text-white">
                                              <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" >    
                                              <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $selCourse->rowCount(); ?></span>
                                              </div>
                                              </h5>
                                          </div>
                                  </div>
                                  <div class="Exam_Card text-white bg-warning mb-3 filup" style="width: 290px;">
                                      <div class="Exam_Card-header"><p class="p-2">Lectures</p></div>
                                          <div class="Exam_Card-body">
                                              <h5 class="text-white">
                                              <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" >    
                                              <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $sellec['totlec'] ?></span>
                                              </div>
                                              </h5>
                                          </div>
                                  </div>
                                  <div class="Exam_Card text-white bg-primary mb-3 filup" style="width: 290px;">
                                      <div class="Exam_Card-header"><p class="p-2">Exams</p></div>
                                          <div class="Exam_Card-body">
                                              <h5 class="text-white">
                                              <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" >    
                                              <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $selExam['totExam'] ?></span>
                                              </div>
                                              </h5>
                                          </div>
                                  </div>
                                  <div class="Exam_Card text-white bg-dark mb-3 filup" style="width: 290px;">
                                      <div class="Exam_Card-header"><p class="p-2">Assignments</p></div>
                                          <div class="Exam_Card-body">
                                              <h5 class="text-white">
                                              <div class="col-md-6 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="300ms" >    
                                              <span class="timer counter alt-font appear Exam_Card-text" data-to="1500" data-speed="7000"><?php echo $selAssi['totAssi'] ?></span>
                                              </div>
                                              </h5>
                                          </div>
                                  </div>   
                              </div>                          
                          </div>
                        </div>
                    </div>
                </div><br>
            </div>
            <div class="col-md-12">
              <div class="card filup">
                <div  class="card-body">
                    <div class="row">
                      <h2 align="center" class="col-md-12 mt-3 mb-4 filup">Total Courses</h2>
                      <div class="divider col-md-12 filup"></div>
                      <div class="col-md-12">
                      <?php
                      if($selCourse->rowCount() > 0){
                          echo '<div class="Exam_Card-body row filup">';
                          while($Cou_Create = $selCourse->fetch(PDO::FETCH_ASSOC)){
                              $CouStu_ID = $Cou_Create['cou_id'];
                              $selStudentCourse = $conn->query("SELECT * FROM course_check WHERE course_id='$CouStu_ID'");
                              $selStudentCourseReq = $conn->query("SELECT * FROM course_req WHERE cou_id='$CouStu_ID'");
                              echo '<div align="center" class="Exam_Card bg-dark" style="width: 270px">
                              <img class="Exam_Card-img-top" src="uploads/imgs/courses/'.$Cou_Create['img'].'" style="height: 210px" alt="'.$Cou_Create['cou_name'].'">
                              <div class="Exam_Card-body">
                              <h5 class="Exam_Card-title text-white">'.$Cou_Create['cou_name'].'</h5>
                              <a href="home.php?page=details&id='.$CouStu_ID.'" class="btn btn-success">Details</a>';
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
                </div>
              </div>
            </div><br>
        </div>
    </div>
</div>
</div>