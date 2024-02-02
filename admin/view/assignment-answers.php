<?php
$assi_id = $_GET["id"];
$stuid = $_GET["stu"];
$AssiInfo = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$assi_id'")->fetch(PDO::FETCH_ASSOC);
$course_id = $AssiInfo["cou_id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
$selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);

?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-plum-plate">
                            </i>
                        </div>
                        <div>Assignment - <?php echo $AssiInfo['assi_name']; ?> - Course <?php echo $CourseInfo['cou_name']; ?> 
                            <div class="page-title-subheading">
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
                        <li class="breadcrumb-item"><a href="home.php?page=manage-course">Manage Courses</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-setting&id=<?php echo $CourseInfo["cou_id"]; ?>"><?php echo $CourseInfo['cou_name'];  ?></a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-assignment&id=<?php echo $CourseInfo["cou_id"]; ?>">Assignments</a></li>
                        <li class="active breadcrumb-item" aria-current="page"><?php echo $selStudent['stu_fullname'] ?> Answers</li>
                    </ol>
                </nav>

                <div class="mb-3 card">
                    <div align="center" class="card-header">
                    Assignment - <?php echo $AssiInfo['assi_name'] ?> - Correct Answers
                    </div>
                    <div class="col-md-12 card-body">
                    <?php
                    $CheckAssi = $conn->query("SELECT * FROM assi_check WHERE assi_id='$assi_id' AND stu_id='$stuid'");
                    if ($CheckAssi->rowCount() > 0){
                        $CheckAssi2 = $CheckAssi->fetch(PDO::FETCH_ASSOC);
                        echo '<div class="row p-3">
                            <div align="center" class="alert alert-danger col-md-11" role="alert">
                                <h2 class="text-danger">Assignment Description</h2>
                                <h5 class="text-danger mt-3">'.$AssiInfo['assi_description'].'</h5>
                            </div>
                            <div class="row col-md-12" style="margin: auto;">
                                <div align="center" class="alert alert-dark col-md-5" role="alert">
                                    <h2 class="text-dark">Student</h2>
                                    <h5 class="text-dark mt-3">'.$selStudent['stu_fullname'].'</h5>
                                </div>
                                <div align="center" class="alert alert-dark col-md-5" role="alert">
                                    <h2 class="text-dark">Time</h2>
                                    <h5 class="text-dark mt-3">'.$CheckAssi2['created_time'].'</h5>
                                </div>
                            </div>
                            <div align="center" class="col-md-12 mt-3" style="margin: auto;">
                                <h2 class="p-3 grid text-dark col-md-5">Assignment Correct Answers</h2>
                            </div>';

                            $Question_Header = $conn->query("SELECT * FROM assi_question_header WHERE assi_id='$assi_id'");
                            $i = 0;
                            $ii = 0;

                            if ($Question_Header->rowCount() > 0){

                                while($Create_header = $Question_Header->fetch(PDO::FETCH_ASSOC)){
                                    $i++;
                                    echo '<div class="grid col-md-12 mt-3">
                                            <div class="card-body">
                                                <h2>'.$i.') '.$Create_header['title'].'</h2>
                                            </div>
                                        </div>';

                                    if ($Create_header['img'] != ""){
                                        echo '<div align="center" class="col-md-12 mt-3">
                                        <img src="../uploads/imgs/assignments/'.$Create_header['img'].'" class="card-img-bottom col-md-5" alt="...">
                                    </div>';
                                    };

                                    if ($Create_header['que_text'] != ""){
                                        echo '<div align="left" class="alert alert-dark col-md-11 mt-3">
                                        <h4>'.$Create_header['que_text'].'</h4>
                                    </div>';
                                    };

                                    $Question_Header_Id = $Create_header['que_id'];
                                    $selQuest = $conn->query("SELECT * FROM assi_question_tbl eqt INNER JOIN assi_answers ea ON eqt.que_assi_id = ea.question_id WHERE eqt.assi_id='$assi_id' AND ea.assi_id='$assi_id' AND eqt.assi_header = '$Question_Header_Id' AND ea.stu_id = '$stuid' ");
                                    
                                    while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
                                        $ii++;
                                        echo '
                                        <div class="row col-md-12" style="margin: auto;">
                                            <div class="col-md-12">';

                                        if($selQuestRow['assI_qu_asnwer'] == $selQuestRow['question_answer']){
                                            echo  '<h4 class="mt-3 alert alert-success">'.$ii.'. '.$selQuestRow['assi_que'].'</h4>
                                            <h5 class="mt-3 p-2 text-dark" style="width: auto;">Your Answer : <span class="text-success">'.$selQuestRow['question_answer'].'</span></h5>';
                                        }else{
                                            $print_answ = str_replace('Not_Selected' , 'Not Selected' , $selQuestRow['question_answer']);
                                            echo '<h4 class="mt-3 alert alert-danger">'.$ii.'. '.$selQuestRow['assi_que'].'</h4>
                                            <h5 class="mt-3 p-2 text-dark" style="width: auto;">Your Answer :   <span class="text-danger">'.$print_answ.'</span></h5>
                                            <h5 class="mt-3 p-2 text-dark" style="width: auto;">Correct Answer :  <span class="text-success">'.$selQuestRow['assI_qu_asnwer'].'</span></h5>';
                                        };

                                        echo '</div></div>';
                                    };
                                };
                            };
                    }else{
                            echo '<h1 align="center" class="text-center text-danger mt-3">'.$selStudent['stu_fullname'].' have not solved this assignment yet.</h1><br>';
                    };
                    ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>