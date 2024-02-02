<?php
$lec_id = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$LecInfo = $conn->query("SELECT * FROM lec_tbl WHERE lec_id='$lec_id'")->fetch(PDO::FETCH_ASSOC);
$Cou_id = $LecInfo['cou_id'];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$Cou_id'")->fetch(PDO::FETCH_ASSOC);
$adminlecid = $LecInfo['admin_created'];
$GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
?>
<title><?php  echo  $WebTitle. ' | ' .$CourseInfo['cou_name'] . ' - Lecture : ' . $LecInfo['lec_name']; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-play icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Course <?php echo $CourseInfo['cou_name']; ?> - Lecture : <?php echo $LecInfo['lec_name']; ?>
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>
        <div class="col-md-12"> 
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3 grid">
                        <div align="center" class="Exam_Card-header">
                            <?php echo $LecInfo['lec_name']; ?>
                        </div>
                        <div class="Exam_Card-body">
                        <?php
                            $lec_time = $LecInfo['lec_time'];
                            if ($lec_time == 0){
                                $video_url = $LecInfo['video_link'];
                                if (strstr($video_url,'Youtube/')){
                                    $video_url = str_replace('Youtube/','',$video_url);
                                    echo '<iframe height="336px" align="center" style="width: 100%; max-width: 100%; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" src="https://www.youtube.com/embed/'.$video_url.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                }else{
                                    echo '<iframe height="336px" align="center" style="width: 100%; max-width: 100%; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" src="'.Iframe($video_url).'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                };
                            }else{
                                $StudentCheck_Lecture = $conn->query("SELECT * FROM lec_timecount WHERE stu_id='$stuid' AND lec_id = '$lec_id' ORDER BY order_id desc");
                                $GetLecCheckInfo = $StudentCheck_Lecture->fetch(PDO::FETCH_ASSOC);
                                if ($StudentCheck_Lecture->rowCount()){
                                    $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                    $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $GetLecCheckInfo['end_time']); 
                                    if ($date2 > $date1) {
                                        $video_url = $LecInfo['video_link'];
                                        if (strstr($video_url,'Youtube/')){
                                            $video_url = str_replace('Youtube/','',$video_url);
                                            echo '<iframe height="336px" align="center" style="width: 100%; max-width: 100%; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" src="https://www.youtube.com/embed/'.$video_url.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                        }else{
                                            echo '<iframe height="336px" align="center" style="width: 100%; max-width: 100%; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" src="'.Iframe($video_url).'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                        };
                                    }else{
                                        echo '<h1 align="center" class="text-danger">The specified time has expired.</h1>';
                                    };
                                }else{
                                        echo '<div align="center"><button type="button" id="Lec_watch" data-id="'.$lec_id.'" data-time="'.$LecInfo['lec_time'].'"  style="margin: auto; font-size: 20px;" class="btn btn-success col-md-6 btn-rounded mt-3">Start Watching Now</button></div><br>';
                                };
                            };
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3 grid">
                        <div class="Exam_Card-header text-center">
                            <div class="" >Lecturer</div>
                        </div>
                        <div class="Exam_Card-body">
                            <h5 class="text-dark text-center"><?php echo $GetAdminInfo['admin_name']; ?></h5>
                        </div>
                    </div>

                    <div class="mb-3 grid">
                        <div class="Exam_Card-header text-center">
                            <div class="" >Lecture Date</div>
                        </div>
                        <div class="Exam_Card-body">
                            <h5 class="text-dark text-center"><?php echo $LecInfo['lec_created']; ?></h5>
                        </div>
                    </div>

                    <div class="mb-3 grid">
                        <div class="Exam_Card-header text-center">
                            <div class="" >Lecture DeadLine</div>
                        </div>
                        <div class="Exam_Card-body">
                            <h5 style="display: none;" id="Lec_EndTime"><?php echo $GetLecCheckInfo['end_time'] ?></h5>
                            <h5 id="countdown" class="text-dark text-center"></h5>
                        </div>  
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3 grid">
                        <div class="Exam_Card-header text-center">
                            <div class="" >Lecture Description</div>
                        </div>
                        <div class="Exam_Card-body">
                            <h5 class="text-dark text-center"><?php echo $LecInfo['lec_description']; ?></h5>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>


<script>
// Watch Lecture (CountDown)
$(document).on("click","#Lec_watch" , function(e){
	e.preventDefault();
	var id = $(this).data("id");
	var time = $(this).data("time");
	$.ajax({
		type : "post",
		url : "libs/Lecture.php",
		dataType : "json",  
		data : {Lec_Id:id,timecount:time},
		cache : false,
		success : function(data){
		if(data.status == "success")
		{
			 lecTime = document.getElementById("countdown").innerHTML;
			 countDownDate = new Date(lecTime).getTime();
			 refreshDiv();
		}
		},
		error : function(xhr, ErrorStatus, error){
		console.log(status.error);
		}
	});
});

//Lecture Count Down
var x = setInterval(function() {
	var divElement = document.getElementById("Lec_EndTime");
	if (divElement) {
		var lecTime = document.getElementById("Lec_EndTime").innerHTML;
		var countDownDate = new Date(lecTime).getTime();
		var now = new Date().getTime();
		var distance = countDownDate - now;
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		if (lecTime != ''){
			document.getElementById("countdown").innerHTML = "" + days + "d " + hours + "h "
			+ minutes + "m " + seconds + "s ";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("countdown").innerHTML = "EXPIRED";
				refreshDiv();
			  };
		}else{
			document.getElementById("countdown").innerHTML = "None";
		};
	} else {

	};
}, 1000);

</script>