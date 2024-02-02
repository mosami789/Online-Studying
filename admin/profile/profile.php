<?php 
   $Studentid = $_GET['id'];
   $selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$Studentid' "); $selStudentRow = $selStudent->fetch(PDO::FETCH_ASSOC);
   $selCourse = $conn->query("SELECT * FROM course_check WHERE student_id='$Studentid' ");
   $selAssi = $conn->query("SELECT * FROM assi_check WHERE stu_id='$Studentid' ");
   $selExam = $conn->query("SELECT * FROM exam_check WHERE stu_id='$Studentid' ");
 ?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-user icon-gradient bg-plum-plate">
                            </i>
                        </div>
                        <div>Student Profile  -  <?php echo $selStudentRow['stu_fullname']; ?></div>
                    </div> 
                </div>
            </div>

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=manage-student">Manage Students</a></li>
                        <li class="active breadcrumb-item" aria-current="page"><?php echo $selStudentRow['stu_fullname']; ?></li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">  
                        <div class="row" >
                            <div align="center" class="col-md-12">Student Profile</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ml-1 col-md-12">
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <h4 class="alert alert-dark">Profile Photo</h4>
                                    <img class="rounded-circle mt-2" height="150px" width="150px" id="imagePreview" src="../uploads/imgs/profiles/<?php echo $selStudentRow['stu_profile']; ?>">
                                    <span class="font-weight-bold mt-4"><?php echo $selStudentRow['stu_fullname']; ?></span>
                                    <span class="text-black-50"><?php echo $selStudentRow['stu_email']; ?></span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div  class="p-3 py-5">
                                    <div class="d-flex flex-column align-items-center text-center mb-3">
                                        <h4 class="alert alert-dark">Profile Settings</h4>
                                    </div>
                                        <form id="updatestudentprofile" method="POST">
                                            <div class="row">
                                                <input type="hidden" name="stu_id" value="<?php echo $selStudentRow['stu_id']; ?>">
                                                <div class="col-md-6 mb-2"><legend class="labels">Fullname</legend><input name="fullname" type="text" class="form-control" placeholder="Input Fullname" value="<?php echo $selStudentRow['stu_fullname']; ?>"></div>
                                                <div class="col-md-6 mb-2"><legend class="labels">Email</legend><input name="email" type="email" class="form-control"  placeholder="Input Email"  value="<?php echo $selStudentRow['stu_email']; ?>"></div>
                                                <div class="col-md-6 mb-2"><legend class="labels">Password</legend><input name="pass" type="password" class="form-control" placeholder="Input Password" value="<?php echo $selStudentRow['stu_password']; ?>"></div>
                                                <div class="col-md-6 mb-2"><legend class="labels">Phone</legend><input name="phone" type="texr" class="form-control" placeholder="Input Phone Number" value="<?php echo $selStudentRow['stu_phone']; ?>"></div>
                                                <div class="form-group col-md-6 mb-2">
                                                <legend>Gender</legend>
                                                    <select class="form-control" name="gender">
                                                    <?php
                                                        $setGender = $selStudentRow['stu_gender'];
                                                        if ($setGender == 'Male' or $setGender == 'Male'){
                                                            echo '
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>';
                                                        }else{
                                                            echo '
                                                            <option value="Female">Female</option>
                                                            <option value="Male">Male</option>';
                                                        };
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 mb-2">
                                                    <legend>Birhdate</legend>
                                                    <input type="date" name="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off" value="<?php echo $selStudentRow['stu_birthdate']; ?>">
                                                </div>                
                                            </div>
                                            <div class="mt-3 text-center"><button type="submit" class="btn btn-primary btn-rounded" type="button">Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4 mb-4">
                <div class="main-card card">
                    <div class="card-header">  
                        <div class="row" >
                            <div align="center" class="col-md-12">Student Details</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="main-card mb-3 mt-3 card">
                                    <div class="card-header">
                                        <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Student Courses
                                        <span class="badge badge-pill badge-primary ml-2">
                                        <?php echo $selCourse->rowCount();?>
                                        </span>
                                        <div class="btn-actions-pane-right ">
                                            <input type="text" id="searchInput_1" class="form-control form-control-sm" onkeyup="SearchTabel(1)" placeholder="Search...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="scroll-area-sm" style="min-height: 100px;">
                                            <div class="scrollbar-container">
                                                <table class="mb-0 table table-borderless" id="tableList_1">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left pl-2">#</th>
                                                            <th class="text-left pl-5">Course</th>
                                                            <th class="text-left pl-5" width="35%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        if($selCourse->rowCount() > 0){
                                                            while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)){
                                                                $id = $selCourseRow['course_id'];
                                                                $selCourse2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
                                                                $i++;
                                                                echo '
                                                                <tr>
                                                                <th class="text-left pl-2" scope="row">#'.$i.'</th>
                                                                <td class="text-left pl-5"><a href="home.php?page=course-setting&id='.$id.'">'.$selCourse2['cou_name'].'</a></td>
                                                                <td class="text-left pl-5"><button class="btn btn-sm btn-danger" id="deletestudentcourse" data-id="'.$selCourseRow['coustu_id'].'">Delete</button></td></tr>';
                                                            };
                                                        }else{
                                                            echo ' <tr>
                                                            <td colspan="5">
                                                            <h3 class="p-6">No Course Found</h3>
                                                            </td>
                                                        </tr>';
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <div id="notFound_1"  class="text-primary" style="display: none;"><legend>No Results Found...</legend></div>
                                            </div>
                                        </div>
                                        <div align="right" class="btn-actions-pane-right mt-4">
                                            <button class="btn btn-sm btn-primary" onclick="ClearAddFrm()" id="btnclearstudentcourse" data-toggle="modal" data-target="#modalForCourseToStudent">Add Course</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 mt-3 card">
                                    <div class="card-header">
                                        <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Student Exams
                                        <span class="badge badge-pill badge-primary ml-2">
                                        <?php echo $selExam->rowCount();?>
                                        </span>
                                        <div class="btn-actions-pane-right ">
                                            <input type="text" id="searchInput_2" class="form-control form-control-sm" onkeyup="SearchTabel(2)" placeholder="Search...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="scroll-area-sm" style="height: 254px;">
                                            <div class="scrollbar-container">
                                                <table class="mb-0 table table-borderless" id="tableList_2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left pl-2">#</th>
                                                            <th class="text-left pl-5">Exam</th>
                                                            <th class="text-left pl-5">Course</th>
                                                            <th class="text-left pl-5" width="25%">Results</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i = 0;
                                                    if($selExam->rowCount() > 0){
                                                        while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)){
                                                            $id = $selExamRow['exam_id'];
                                                            $selCourse2 = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$id' ")->fetch(PDO::FETCH_ASSOC);
                                                            $id2 = $selCourse2['cou_id'];
                                                            $selCourse3 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id2' ")->fetch(PDO::FETCH_ASSOC);
                                                            $i++;
                                                            echo '
                                                            <tr>
                                                            <th class="text-left pl-2" scope="row">#'.$i.'</th>
                                                            <td class="text-left pl-5"><a href="home.php?page=exam-setting&id='.$id.'">'.$selCourse2['ex_title'].'</a></td>
                                                            <td class="text-left pl-5"><a href="home.php?page=course-setting&id='.$id2.'">'.$selCourse3['cou_name'].'</a></td>
                                                            <td class="text-left pl-5"><a type="button" href="home.php?page=exam-results&id='.$id.'&stu='.$_GET["id"].'" class="btn btn-success btn-sm mb-1">View Results</a></td>';
                                                        };
                                                    }else{
                                                        echo ' <tr>
                                                        <td colspan="5">
                                                        <h3 class="p-6">No Exam Found</h3>
                                                        </td>
                                                    </tr>';
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <div id="notFound_2"  class="text-primary" style="display: none;"><legend>No Results Found...</legend></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                           
                            </div>

                            <div class="col-md-6" style="margin: auto;">
                                <div class="main-card card">
                                    <div class="card-header">
                                        <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Student Assignments
                                        <span class="badge badge-pill badge-primary ml-2">
                                        <?php echo $selAssi->rowCount();?>
                                        </span>
                                        <div class="btn-actions-pane-right ">
                                            <input type="text" id="searchInput_3" class="form-control form-control-sm" onkeyup="SearchTabel(3)" placeholder="Search...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="scroll-area-sm" style="height: 254px;">
                                            <div class="scrollbar-container">
                                                <table class="mb-0 table table-borderless" id="tableList_3">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left pl-2">#</th>
                                                            <th class="text-left pl-5">Assignment</th>
                                                            <th class="text-left pl-5">Course</th>
                                                            <th class="text-left pl-5" width="20%">Answers</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i = 0;
                                                    if($selAssi->rowCount() > 0){
                                                        while ($selAssiRow = $selAssi->fetch(PDO::FETCH_ASSOC)){
                                                            $id = $selAssiRow['assi_id'];
                                                            $selassi = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$id' ")->fetch(PDO::FETCH_ASSOC);
                                                            $id2 = $selassi['cou_id'];
                                                            $selassi2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id2' ")->fetch(PDO::FETCH_ASSOC);
                                                            $i++;
                                                            echo '
                                                            <tr>
                                                            <th class="text-left pl-2" scope="row">#'.$i.'</th>
                                                            <td class="text-left pl-5"><a href="home.php?page=assignment-setting&id='.$id.'">'.$selassi['assi_name'].'</a></td>
                                                            <td class="text-left pl-5"><a href="home.php?page=course-setting&id='.$id2.'">'.$selassi2['cou_name'].'</a></td>
                                                            <td class="text-left pl-5"><a type="button" href="home.php?page=assignment-answers&id='.$id.'&stu='.$_GET["id"].'" class="btn btn-success btn-sm mb-1">View Answers</a></td>';
                                                        };
                                                    }else{
                                                        echo ' <tr>
                                                        <td colspan="5">
                                                        <h3 class="p-6">No Assignment Found</h3>
                                                        </td>
                                                    </tr>';
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <div id="notFound_3"  class="text-primary" style="display: none;"><legend>No Results Found...</legend></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                           
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
