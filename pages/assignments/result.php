<?php
$assi_id = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$AssiInfo = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$assi_id'")->fetch(PDO::FETCH_ASSOC);
$course_id = $AssiInfo["cou_id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
?>
<title><?php  echo $WebTitle. ' | ' . $CourseInfo['cou_name'] . ' - Assignment Results : ' . $AssiInfo['assi_name']; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Course <?php  echo $CourseInfo['cou_name'] . ' - Assignment Results : ' . $AssiInfo['assi_name']; ?></div>
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="mb-3 Exam_Card-withouthover">
                    <div align="center" class="Exam_Card-header">
                    Assignment - <?php echo $AssiInfo['assi_name'] ?> - Correct Answers
                    </div>
                    <div class="col-md-12 Exam_Card-body">
                    <?php
                    $CheckAssi = $conn->query("SELECT * FROM assi_check WHERE assi_id='$assi_id' AND stu_id='$stuid'");
                    $CheckAssiPost = $AssiInfo['post'];
                    if ($CheckAssi->rowCount() > 0 AND $CheckAssiPost == 'yes'){

                        echo '<div class="row p-3">
                            <div align="center" class="alert alert-danger col-md-11" role="alert">
                                <h2 class="text-danger">Assignment Description</h2>
                                <h5 class="text-danger mt-3">'.$AssiInfo['assi_description'].'</h5>
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
                                        <img src="uploads/imgs/assignments/'.$Create_header['img'].'" class="card-img-bottom col-md-5" alt="...">
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
                            echo '<h1 align="center" class="text-center text-danger mt-3">You have not solved this assignment yet.</h1><br>';
                    };
                ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>