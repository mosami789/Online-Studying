<?php 
   $assi_id = $_GET['id'];
   $selAssi = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$assi_id' ");
   $selAssiRow = $selAssi->fetch(PDO::FETCH_ASSOC);
   $selQuest = $conn->query("SELECT * FROM assi_question_tbl WHERE assi_id='$assi_id' ORDER BY que_assi_id desc");
   $id = $selAssiRow['cou_id'];
   $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
 ?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon"><i class="pe-7s-config icon-gradient bg-plum-plate"></i></div>
                        <div>Manage Assignment  -  <?php echo $selAssiRow['assi_name'];  ?> Questions</div>
                    </div>
                    <div class="page-title-actions">
                    <?php
                        if ($selAssiRow['post'] == 'no' or $selAssiRow['post'] = ''){
                            echo '<div data-id="'.$assi_id.'" data-status="yes" id="AssiStatus" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-primary">Show Assignment</div>';
                        }else{
                            echo '<div data-id="'.$assi_id.'" data-status="no" id="AssiStatus" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-danger">Hide Assignment</div>';
                        };
                    ?>
                    </div>
                </div>
                <div class="scrollbar-container"></div>      
            </div>        
           
            <div class="row">
            <?php 
                ?>
                <div class="col-md-12">
                    <nav class="" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="home.php?page=manage-course">Manage Courses</a></li>
                            <li class="breadcrumb-item"><a href="home.php?page=course-setting&id=<?php echo $selCourse["cou_id"]; ?>"><?php echo $selCourse['cou_name'];  ?></a></li>
                            <li class="breadcrumb-item"><a href="home.php?page=course-assignment&id=<?php echo $selCourse["cou_id"]; ?>">Assignments</a></li>
                            <li class="active breadcrumb-item" aria-current="page"><?php echo $selAssiRow['assi_name'] ?> Questions</li>
                        </ol>
                    </nav>
                    <div class="card">
                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Assignment Question's 
                        <span class="badge badge-pill badge-primary ml-2">
                            <?php echo $selQuest->rowCount(); ?>
                        </span>
                            <div class="btn-actions-pane-right">
                            <button class="btn btn btn-primary " onclick="CleanCreateHeaderFrm()" data-toggle="modal" data-target="#modalForAddHeaderQuestion">Add Header Question</button>
                            </div>
                        </div>
                        <div class="card-body"> 
                        <?php
                        $Question_Header = $conn->query("SELECT * FROM assi_question_header WHERE assi_id='$assi_id'");
                        if ($Question_Header->rowCount() > 0){
                            while($create_que_header = $Question_Header->fetch(PDO::FETCH_ASSOC)){
                            $i++;
                            $display = "none;";
                            if ($create_que_header['img'] != ""){
                                $display = "block;";
                            };

                            echo '<div class="grid col-md-12 mt-2">
                                    <div class="card-body row">              
                                        <h4 class="col-md-9 mt-1">'.$i.') '.$create_que_header['title'].'</h4> 
                                        <div class="col-md-3" align="center">
                                        <div onclick="GetHeaderInfo('.$create_que_header['que_id'].')" data-id="'.$create_que_header['que_id'].'" data-toggle="modal" data-target="#modalForUpdateHeaderQuestion" class="btn btn-primary mt-1">Update</div>
                                        <div id="DeleteQuestionHeader" data-id="'.$create_que_header['que_id'].'" class="btn btn-danger mt-1">Remove</div>
                                        <div onclick="CreateQue('.$create_que_header['que_id'].')" class="btn btn-info mt-1" data-toggle="modal" data-target="#modalForAddQuestion">Add Question</div>
                                        </div>
                                    </div>
                                    </div>
                                    <div align="center" class="col-md-12 mt-3 image-container">
                                    <img style="display: '.$display.'" id="imagePreview_'.$create_que_header['que_id'].'" src="../uploads/imgs/assignments/'.$create_que_header['img'].'" class="col-md-5" alt="..."> ';


                            echo '<form id="UpdatePhotoHeader" method="post" enctype="multipart/form-data">
                                    <div class="buttons row">
                                        <input type="hidden" name="id" value="'.$create_que_header['que_id'].'">
                                        <input type="hidden" name="CheckPhoto" value="Update_PhotoFound">
                                        <input onclick="TestFunction(1)" style="display: none;" data-id="'.$create_que_header['que_id'].'" type="file" name="fileToUpload" id="imageInput_'.$create_que_header['que_id'].'">
                                        <label for="imageInput_'.$create_que_header['que_id'].'" class="btn btn-primary">Update Photo</label>
                                        <label id="DeletePhotoHeader" data-id="'.$create_que_header['que_id'].'" class="btn btn-danger ml-2">Remove</label>
                                        <button id="Sumbit_UpdatePhotoHeader_'.$create_que_header['que_id'].'" style="display: none;" type="submit" class="btn btn-primary"></button>
                                    </div>
                                </form> 
                            </div>';

                            if ($create_que_header['que_text'] != ""){
                                echo '<div align="left" class=" alert alert-dark col-md-12 mt-3">
                                <h4>'.$create_que_header['que_text'].'</h4>
                            </div>';
                            };

                            $Question_Header_Id = $create_que_header['que_id'];
                            $Check_que_header = $conn->query("SELECT * FROM assi_question_tbl WHERE assi_id='$assi_id' AND assi_header = '$Question_Header_Id' ");
                            if ($Check_que_header->rowCount()){
                                while($Create_Que = $Check_que_header->fetch(PDO::FETCH_ASSOC)){
                                    $ii++;           
                                    $ch1 = '';
                                    $ch2 = '';
                                    $ch3 = '';
                                    $ch4 = '';
                                    if ($Create_Que['assi_ch1'] == $Create_Que['assI_qu_asnwer']){
                                        $ch1 = 'alert-success';
                                    }elseif ($Create_Que['assi_ch2'] == $Create_Que['assI_qu_asnwer']){
                                        $ch2 = 'alert-success';
                                    }elseif ($Create_Que['assi_ch3'] == $Create_Que['assI_qu_asnwer']){
                                        $ch3 = 'alert-success';
                                    }elseif ($Create_Que['assi_ch4'] == $Create_Que['assI_qu_asnwer']){
                                        $ch4 = 'alert-success';
                                    };
                                    echo '<div class=" mt-4 col-md-12">
                                    <div class="alert alert-dark row">
                                    <h5 class="col-md-9 mt-2">'.$ii.'. '.$Create_Que['assi_que'].'</h5>
                                        <div align="center" class="col-md-3">
                                            <div onclick="GetQuestionInfo('.$Create_Que['que_assi_id'].')" data-toggle="modal" data-target="#modalForUpdateQuestion" class="btn btn-primary mt-1">Update</div>
                                            <div id="deleteQuestion" data-id="'.$Create_Que['que_assi_id'].'" class="btn btn-danger mt-1">Remove</div>
                                        </div>
                                    </div>
                                        <div class="row mt-4">
                                            <div class="form-group2 col-md-6">
                                                <div class="alert '.$ch1.' p-2">
                                                    <h5 style="margin: auto;" class="ml-1">A -  '.$Create_Que['assi_ch1'].'</h5>
                                                </div>
                                                <div class="alert '.$ch2.' p-2">
                                                    <h5 style="margin: auto;" class="ml-1">B - '.$Create_Que['assi_ch2'].'</h5>
                                                </div>
                                            </div>
                                            <div class="form-group2 col-md-6">
                                                <div class="alert '.$ch3.' p-2">
                                                    <h5 style="margin: auto;" class="ml-1">C - '.$Create_Que['assi_ch3'].'</h5>
                                                </div>
                                                <div class="alert '.$ch4.' p-2">
                                                    <h5 style="margin: auto;" class="ml-1">D - '.$Create_Que['assi_ch4'].'</h5>
                                                </div>
                                            </div>
                                        </div>
                                </div>';
                                };
                            };
                            };
                        }else{
                            echo '<br> <h1 align="center" class="text-center text-danger" id="Exam_CountDown">There is no question yet.</h1><br>';
                        };
                        ?>    
                </div>
            </div>  
        </div> 
    </div>
</div>  
</div>  
 
    <br> 
        
    