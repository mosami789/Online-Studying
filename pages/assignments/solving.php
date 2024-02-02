<?php
$assi_id = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$AssiInfo = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$assi_id'")->fetch(PDO::FETCH_ASSOC);
$course_id = $AssiInfo["cou_id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
?>
<title><?php  echo $WebTitle. ' | ' . $CourseInfo['cou_name'] . ' - Assignment : ' . $AssiInfo['assi_name']; ?></title>
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
                        <div>Course <?php  echo $CourseInfo['cou_name'] . ' - Assignment : ' . $AssiInfo['assi_name']; ?></div>
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="">
                <div class="mb-3 Exam_Card-withouthover">
                    <div align="center" class="Exam_Card-header">
                    Assignment - <?php echo $AssiInfo['assi_name'] ?>
                    </div>
                    <div class="Exam_Card-body">
                    <?php
                    $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                    $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $AssiInfo['assi_deadline']);
                    $CheckAssi = $conn->query("SELECT * FROM assi_check WHERE assi_id='$assi_id' AND stu_id='$stuid'");
                    $CheckAssiPost = $AssiInfo['post'];

                    if ($date2 > $date1 AND $CheckAssiPost == 'yes') {
                        if ($CheckAssi->rowCount() > 0){
                            echo '<h1 align="center" class="text-center text-danger">You already solve this assignment.</h1><br>';
                            echo '<div align="center"><a href="home.php?page=assiresult&id='.$assi_id.'" type="button" style="margin: auto; font-size: 20px;" class="btn btn-success col-md-6 btn-rounded">View Correct Answers</a></div>';
                        }else{
                            echo '<div class="row p-3">
                            <div align="center" class="alert alert-danger col-md-11" role="alert">
                                <h2 class="text-danger">Assignment Description</h2>
                                <h5 class="text-danger mt-3">'.$AssiInfo['assi_description'].'</h5>
                            </div>
                            <div align="center"  class="alert alert-dark col-md-5 mt-1" role="alert">
                                <h2 class="text-dark">Assignment DeadLine</h2>
                                <h5 class="text-dark mt-3">'.$AssiInfo['assi_deadline'].'</h5>
                            </div>
                            
                            <div align="center" class="col-md-12 mt-3" style="margin: auto;">
                                <h2 class="p-3 grid text-dark col-md-5">Assignment Questions</h2>
                            </div>
                            
                            <form method="POST" id="sumbitAnswer_Assi" class="col-md-12 mt-3">
                                <input type="hidden" name="assi_id" id="assi_id" value="'.$assi_id.'">';
                            
                            $Question_Header = $conn->query("SELECT * FROM assi_question_header WHERE assi_id='$assi_id'");
              
                            $i = 0;
                            $ii = 0;
                            if ($Question_Header->rowCount() > 0){
                                while($Create_header = $Question_Header->fetch(PDO::FETCH_ASSOC)){
                                    $i++;
                                    echo '<div class="grid col-md-12">
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
                                    $Check_que_header = $conn->query("SELECT * FROM assi_question_tbl WHERE assi_id='$assi_id' and assi_header='$Question_Header_Id'");
                                    
                                    if ($Check_que_header->rowCount() > 0){
                                        while($Create_Que = $Check_que_header->fetch(PDO::FETCH_ASSOC)){
                                            $ii++;
                                            $radio1 = bin2hex(random_bytes(3));
                                            $radio2 = bin2hex(random_bytes(3));
                                            $radio3 = bin2hex(random_bytes(3));
                                            $radio4 = bin2hex(random_bytes(3));
                                            echo '<div class=" mt-4">
                                            <h5 class="alert alert-dark">'.$ii.'. '.$Create_Que['assi_que'].'</h5>
                                                <div class="row mt-4">
                                                    <div class="form-group2 col-md-6">
                                                        <div class="radio ">
                                                        <label class=" radio-label mr-4" for="'.$radio1.'">
                                                            <input id="'.$radio1.'" name="Answer['.$Create_Que['que_assi_id'].']" value="'.$Create_Que['assi_ch1'].'" required type="radio">'.$Create_Que['assi_ch1'].'<i class="input-frame"></i>
                                                        </label>
                                                        </div>
                                                        <div class="radio">
                                                        <label class="radio-label" for="'.$radio2.'">
                                                        <input id="'.$radio2.'" name="Answer['.$Create_Que['que_assi_id'].']" value="'.$Create_Que['assi_ch2'].'" required type="radio">'.$Create_Que['assi_ch2'].'<i class="input-frame"></i>
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group2 col-md-6" for="'.$radio3.'">
                                                        <div class="radio">
                                                        <label class="radio-label mr-4">
                                                        <input id="'.$radio3.'" name="Answer['.$Create_Que['que_assi_id'].']" value="'.$Create_Que['assi_ch3'].'" required type="radio">'.$Create_Que['assi_ch3'].'<i class="input-frame"></i>                                                                        </label>
                                                        </div>
                                                        <div class="radio">
                                                        <label class="radio-label" for="'.$radio4.'">
                                                        <input id="'.$radio4.'" name="Answer['.$Create_Que['que_assi_id'].']" value="'.$Create_Que['assi_ch4'].'" required type="radio">'.$Create_Que['assi_ch4'].'<i class="input-frame"></i>
                                                        </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>';
                                        };
                                    };
                                };
                            };
                            echo '<input style="float: right;"  name="submit" type="submit" value="Submit Answers" class="btn btn btn-primary float-right">
                                    </form>
                                </div>';
                        };
                    }elseif ($CheckAssiPost == 'no'){
                        echo '<h1 align="center" class="text-center text-danger mt-3">You do not have access to view this assignment.</h1><br>';
                    }else{
                        if ($CheckAssi->rowCount() > 0){
                            echo '<h1 align="center" class="text-center text-danger">You already solve this assignment.</h1><br>';
                            echo '<div align="center"><a href="home.php?page=assiresult&id='.$assi_id.'" type="button" style="margin: auto; font-size: 20px;" class="btn btn-success col-md-6 btn-rounded">View Correct Answers</a></div>';
                        }else{
                            echo '<h1 align="center" class="text-center text-danger mt-3">The assignment deadline has expired.</h1><br>';
                        };
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
//Sumbit Assignment Aswers
$(document).on("submit", "#sumbitAnswer_Assi", function(){
		Swal.fire({
			title: 'Are you sure?',
			text: "you want to submit your answer now?",
			icon: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, submit now!'
		}).then((result) => {
			if (result.value) {
				$.post("libs/SumbitAnswer_Assignment.php", $(this).serialize() , function(data){
					if(data.status == "success"){
						Swal.fire({
						title: 'Success',
						text: "your answer successfully submitted!",
						icon: 'success',
						allowOutsideClick: false,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								var assi_id = document.getElementById('assi_id').value;
								window.location.href='home.php?page=assiresult&id=' + assi_id;
							};
						});
					}else if (data.status == 'failed_insert'){
						  Swal.fire({
							title: 'Already Take',
							text: "you already take this assignment!",
							icon: 'error',
							allowOutsideClick: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'OK!'
							}).then((result) => {
								if (result.value) {
									var assi_id = document.getElementById('assi_id').value;
									window.location.href='home.php?page=assiresult&id=' + assi_id;
								};
							});
					};
				 }
				 ,'json');
			};
		});
	
	return false;
});
</script>