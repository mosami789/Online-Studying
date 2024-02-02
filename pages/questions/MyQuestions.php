<?php
$stuid = $_SESSION['Student_ID'];
$Stu_Questions = $conn->query("SELECT * FROM stu_questions WHERE stu_id='$stuid' ORDER BY order_id desc");
?>
<title><?php  echo $WebTitle. ' | Questions'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-help1 icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Your Questions<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $Stu_Questions->rowCount();?></span>
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <?php
                $i = 0;
                if ($Stu_Questions->rowCount () > 0){
                    while($CreateQueFrm = $Stu_Questions->fetch(PDO::FETCH_ASSOC)){
                        $adminlecid = $CreateQueFrm['lecturer_id'];
                        $GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);

                        echo '<div class="Exam_Card-withouthover">
                        <div class="Exam_Card-body">
          
                        <div align="center" class="alert alert-dark col-md-5">
                            <h4 class="text-dark mt-2">'.$CreateQueFrm['created_time'].'</h4>
                        </div>

                        <div class="grid col-md-12 p-3 mt-2">
                            <h5>'.$CreateQueFrm['question'].'</h5>
                        </div>';

                        if ($CreateQueFrm['img'] !=''){
                            echo '<div align="center" class="col-md-12 mt-4">
                                <img src="uploads/imgs/questions/'.$CreateQueFrm['img'].'" class="card-img-bottom col-md-5" alt="...">
                            </div>';
                        };

                        if ($CreateQueFrm['answer'] != ''){
                            echo '<div class="row alert alert-success mt-4">
                            <h2 class="mt-3">'.$GetAdminInfo['admin_name'].' : </h2><h4 class="mt-3 col">'.$CreateQueFrm['answer'].'</h4>
                            </div>';
                        }else{
                            echo '<div class="alert alert-danger mt-4">
                            <h4 align="center" class="mt-1">Wait for a reply.</h4>
                            </div>';
                        };
                        echo '
                        
                        <div align="right">
                            <div type="button" id="RemoveQuestion" data-id="'.$CreateQueFrm['order_id'].'" class="btn btn-danger mt-1 btn">Remove</div>
                        </div>
                        
                        
                        </div>
                        </div>';
                    };
                }else{
                    echo '
                    <div class="Exam_Card-withouthover p-3">
                        <h2 align="center" class="mt-1 text-danger">There is no question yet.</h2>
                    </div>';
                };
                ?>
            </div>
        </div>
    </div>
