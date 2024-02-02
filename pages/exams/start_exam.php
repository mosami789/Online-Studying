<?php
$examid = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$ExamInfo = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examid'")->fetch(PDO::FETCH_ASSOC);
$course_id = $ExamInfo["cou_id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
$selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examid' ORDER BY eqt_id desc");
?>
<title><?php  echo $WebTitle. ' | ' .$CourseInfo['cou_name'] . ' - Exam : ' . $ExamInfo['ex_title']; ?></title>
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
                        <div>Course <?php  echo $CourseInfo['cou_name'] . ' - Exam Results : ' . $ExamInfo['ex_title']; ?></div>
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="mb-3 Exam_Card-withouthover">
                    <div align="center" class="Exam_Card-header">
                        Exam - <?php echo $ExamInfo['ex_title'] ?>
                    </div>
                    <div class="col-md-12 Exam_Card-body">
                    <?php
                    $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                    $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $ExamInfo['ex_deadline']);
                    $CheckExamPost = $ExamInfo['posted'];
                    if ($date2 > $date1) {
                        $CheckExam = $conn->query("SELECT * FROM exam_check WHERE exam_id='$examid' AND stu_id='$stuid'");
                        if ($CheckExam->rowCount() > 0){
                            $ExamEndTime = $CheckExam->fetch(PDO::FETCH_ASSOC);
                            $date3 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                            $date4 = DateTime::createFromFormat('Y-m-d H:i:s', $ExamEndTime['end_time']); 
                            if ($date4 > $date3 AND $CheckExamPost == 'yes') {
                                echo '<h3 style="display: none;" id="Exam_EndTime">'.$ExamEndTime['end_time'].'</h3>
                                <h4 align="center" class="text-center alert alert-dark col-md-4" id="Exam_CountDown"></h4>
                                <div class="row">
                                    <form method="POST" id="sumbitAnswer" class="col-md-12 mt-3">
                                        <input type="hidden" name="exam_id" id="exam_id" value="'.$examid.'">';
                                    
                                $Question_Header = $conn->query("SELECT * FROM exam_question_header WHERE exam_id='$examid'");
                                if ($Question_Header->rowCount() > 0){
                                    echo '<div align="center" class="col-md-12" style="margin: auto;">
                                    <h2 class="p-3 grid text-dark" style="width: 300px;">Exam Questions</h2>
                                </div>';
                                    while($create_que_header = $Question_Header->fetch(PDO::FETCH_ASSOC)){
                                        $i++;
                                        echo '
                                        
                                        <div class="grid col-md-12 mt-2">
                                                <div class="card-body">
                                                    <h2>'.$i.') '.$create_que_header['title'].'</h2>
                                                </div>
                                            </div>';

                                        if ($create_que_header['img'] != ""){
                                            echo '<div align="center" class="col-md-12 mt-3">
                                            <img src="uploads/imgs/exams/'.$create_que_header['img'].'" class="card-img-bottom col-md-5" alt="...">
                                        </div>';
                                        };

                                        if ($create_que_header['Que_Text'] != ""){
                                            echo '<div align="left" class="alert alert-dark col-md-12 mt-3">
                                            <h4>'.$create_que_header['Que_Text'].'</h4>
                                        </div>';
                                        };
                                        
                                        $Question_Header_Id = $create_que_header['que_id'];
                                        $Check_que_header = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.question_id WHERE eqt.exam_id='$examid' AND ea.exam_id='$examid' AND eqt.exam_header = '$Question_Header_Id' AND ea.stu_id = '$stuid' ");
                                        if ($Check_que_header->rowCount()){
                                            while($Create_Que = $Check_que_header->fetch(PDO::FETCH_ASSOC)){
                                                $ii++;                                  
                                                $radio1 = bin2hex(random_bytes(3));
                                                $radio2 = bin2hex(random_bytes(3));
                                                $radio3 = bin2hex(random_bytes(3));
                                                $radio4 = bin2hex(random_bytes(3));
                                                echo '<div class=" mt-4 col-md-12">
                                                <h5 class="alert alert-dark">'.$ii.'. '.$Create_Que['exam_question'].'</h5>
                                                    <div class="row mt-4">
                                                        <div class="form-group2 col-md-6">
                                                            <div class="radio ">
                                                            <label class=" radio-label mr-4" for="'.$radio1.'">
                                                                <input id="'.$radio1.'" name="Answer['.$Create_Que['eqt_id'].']" data-id="'.$Create_Que['order_id'].'" value="'.$Create_Que['exam_ch1'].'" required type="radio" '.$exam_ch1.'>'.$Create_Que['exam_ch1'].'<i class="input-frame"></i>
                                                            </label>
                                                            </div>
                                                            <div class="radio">
                                                            <label class="radio-label" for="'.$radio2.'">
                                                            <input id="'.$radio2.'" name="Answer['.$Create_Que['eqt_id'].']" data-id="'.$Create_Que['order_id'].'" value="'.$Create_Que['exam_ch2'].'" required type="radio" '.$exam_ch2.'>'.$Create_Que['exam_ch2'].'<i class="input-frame"></i>
                                                            </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group2 col-md-6" for="'.$radio3.'">
                                                            <div class="radio">
                                                            <label class="radio-label mr-4">
                                                            <input id="'.$radio3.'" name="Answer['.$Create_Que['eqt_id'].']" data-id="'.$Create_Que['order_id'].'" value="'.$Create_Que['exam_ch3'].'" required type="radio" '.$exam_ch3.'>'.$Create_Que['exam_ch3'].'<i class="input-frame"></i>                                                                        </label>
                                                            </div>
                                                            <div class="radio">
                                                            <label class="radio-label" for="'.$radio4.'">
                                                            <input id="'.$radio4.'" name="Answer['.$Create_Que['eqt_id'].']" data-id="'.$Create_Que['order_id'].'" value="'.$Create_Que['exam_ch4'].'" required type="radio" '.$exam_ch4.'>'.$Create_Que['exam_ch4'].'<i class="input-frame"></i>
                                                            </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>';
                                            };
                                        };
                                    };
                                };
                                        echo '
                                            <button style="display: none;" id="Auto_submit_answers"></button>
                                            <input style="float: right;"  name="submit" type="submit" value="Submit Answers" class="btn btn-sm btn-primary float-right" id="submitAnswerFrmBtn">
                                        </form>
                                    </div>';
                            }else{
                                echo '<h1 align="center" class="text-center text-danger" id="Exam_CountDown">You already take this exam.</h1><br>';
                                echo '<div align="center"><a href="home.php?page=examresult&id='.$examid.'" type="button" style="margin: auto; font-size: 20px;" class="btn btn-success col-md-6 btn-rounded">View Exam Results</a></div>';
                            };
                        }elseif ($CheckExamPost == 'yes'){
                            echo '<div align="center" class="row p-3">
                                <div class="alert alert-danger col-md-11" role="alert">
                                    <h2 class="text-danger">Exam Description</h2>
                                    <h5 class="text-danger mt-3">'.$ExamInfo['ex_description'].'</h5>
                                </div>
                                <div class="alert alert-primary col-md-4 mt-1" role="alert">
                                    <h2 class="text-primary">Exam Questions</h2>
                                    <h5 class="text-primary mt-3">'.$selQuest->rowCount().' Questions</h5>
                                </div>
                                <div class="alert alert-info col-md-3 mt-1" role="alert">
                                    <h2 class="text-info">Exam Time</h2>
                                    <h5 class="text-info mt-3">'.$ExamInfo['ex_time_limit'].' Minutes</h5>
                                </div>
                                <div class="alert alert-dark col-md-4 mt-1" role="alert">
                                    <h2 class="text-dark">Exam DeadLine</h2>
                                    <h5 class="text-dark mt-3">'.$ExamInfo['ex_deadline'].'</h5>
                                </div>
                                </div>   ';
                            echo '<div align="center"><button type="button" id="StartExam" data-id="'.$examid.'" data-time="'.$ExamInfo['ex_time_limit'].'" style="margin: auto; font-size: 20px;" class="btn btn-success col-md-4 btn-rounded">Start Exam Now</button></div>';
                        }else{
                            echo '<h1 align="center" class="text-center text-danger mt-3">You do not have access to view this exam.</h1><br>';
                        };
                    }else{
                        $CheckExam2 = $conn->query("SELECT * FROM exam_check WHERE exam_id='$examid' AND stu_id='$stuid'");
                        if ($CheckExam2->rowCount() > 0){
                            echo '<h1 align="center" class="text-center text-danger">You already take this exam.</h1><br>';
                            echo '<div align="center"><a href="home.php?page=examresult&id='.$examid.'" type="button" style="margin: auto; font-size: 20px;" class="btn btn-success col-md-6 btn-rounded">View Exam Results</a></div>';
                        }else{
                            echo '<h1 align="center" class="text-center text-danger">The exam deadline has expired.</h1><br>';
                        };
                    };
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
//Start Exam
$(document).on("click","#StartExam" , function(e){
	e.preventDefault();
	var id = $(this).data("id");
	var time = $(this).data("time");
	$.ajax({
		type : "post",
		url : "libs/StartExam.php",
		dataType : "json",  
		data : {Exam_id:id,timecount:time},
		cache : false,
		success : function(data){
		if(data.status == "success")
		{
			localStorage.clear();
			location.reload();
		}
		},
		error : function(xhr, ErrorStatus, error){
		console.log(status.error);
		}
	});
});

//Exam CountDown
var one_submit = 'no';
var ExamCountDowwn = setInterval(function() {
	var divElement = document.getElementById("Exam_EndTime");
	if (divElement) {
		var lecTime = document.getElementById("Exam_EndTime").innerHTML;
		var countDownDate = new Date(lecTime).getTime();
		var now = new Date().getTime();
		var distance = countDownDate - now;
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		document.getElementById("Exam_CountDown").innerHTML = "Time left : " + hours + "h "
			+ minutes + "m " + seconds + "s ";
		if (distance < 0) {
			document.getElementById("Exam_CountDown").innerHTML = "EXPIRED";
			if (one_submit == 'no'){
				var divElement2 = document.getElementById('Auto_submit_answers');
				if (divElement2){
					document.getElementById('Auto_submit_answers').innerText = 'auto';
					$('#submitAnswerFrmBtn').submit();
				   one_submit = 'yes';
				};
			};
		};
	} else {
	};
}, 1000);

//Sumbit Exam Answers
$(document).on("submit", "#sumbitAnswer", function(){
	var status = document.getElementById('Auto_submit_answers').innerText;
	if (status == 'auto'){
		$.post("libs/SumbitAnswer.php", $(this).serialize() , function(data){
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
						var exam_id = document.getElementById('exam_id').value;
						window.location.href='home.php?page=examresult&id=' + exam_id;
					};
				});
			}else if (data.status == 'failed_insert'){
				Swal.fire({
				  title: 'Already Take',
				  text: "you already take this exam",
				  icon: 'error',
				  allowOutsideClick: false,
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK!'
				  }).then((result) => {
					  if (result.value) {
						  var exam_id = document.getElementById('exam_id').value;
						  window.location.href='home.php?page=examresult&id=' + exam_id;
					  };
				  });
		  };
		 }
		 ,'json');
	}else {
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
				$.post("libs/SumbitAnswer.php", $(this).serialize() , function(data){
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
								var exam_id = document.getElementById('exam_id').value;
								window.location.href='home.php?page=examresult&id=' + exam_id;
							};
						});
					}else if (data.status == 'failed_insert'){
						  Swal.fire({
							title: 'Already Take',
							text: "you already take this exam!",
							icon: 'error',
							allowOutsideClick: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'OK!'
							}).then((result) => {
								if (result.value) {
									var exam_id = document.getElementById('exam_id').value;
									window.location.href='home.php?page=examresult&id=' + exam_id;
								};
							});
					};
				 }
				 ,'json');
			};
		});
	};
	return false;
});

ClickerListner()
function ClickerListner(){
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('click', (event) => {
        var que_answer = event.target.value;
        var order_id = event.target.dataset.id;

        localStorage.setItem(order_id , que_answer);
    });
    });
};

for (let i = 0; i < localStorage.length; i++) {
    const key = localStorage.key(i);
    const value = localStorage.getItem(key);
    const radioToCheck = document.querySelector(`input[type="radio"][data-id="${key}"][value="${value}"]`);
    if (radioToCheck) {
        radioToCheck.checked = true;
    }
};
</script>