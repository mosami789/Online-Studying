<?php $PendingCourses = $conn->query("SELECT * FROM course_req WHERE stu_id='$stuid' ORDER BY order_id desc"); ?>
<title><?php  echo $WebTitle. ' | Pending Courses '; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-bookmarks icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Your Pending Courses
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="Exam_Card-withouthover">
                    <p align="center" class="Exam_Card-header">Pending Courses<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $PendingCourses->rowCount();?></span></p>      
                    <?php
                        if($PendingCourses->rowCount() > 0){
                            echo '<div class="Exam_Card-body row">';
                            while($Cou_Create = $PendingCourses->fetch(PDO::FETCH_ASSOC)){
                                $CouStu_ID = $Cou_Create['cou_id'];
                                $Cours_iNFO = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$CouStu_ID'")->fetch(PDO::FETCH_ASSOC);
                                echo '<div align="center" class="Exam_Card bg-dark" style="width: 270px">
                                <img class="Exam_Card-img-top" src="uploads/imgs/courses/'.$Cours_iNFO['img'].'" style="height: 210px" alt="'.$Cours_iNFO['cou_name'].'">
                                <div class="Exam_Card-body">
                                <h5 class="Exam_Card-title text-white">'.$Cours_iNFO['cou_name'].'</h5>
                                <a href="home.php?page=details&id='.$CouStu_ID.'" class="btn btn-secondary btn-rounded">Details</a>
                                <div class="btn btn-warning ml-2 btn-rounded">Pending</div>
                                <div id="CancelRequest" data-id='.$Cou_Create['order_id'].'" data-name="'.$Cours_iNFO['cou_name'].'" class="btn btn-danger btn-rounded mt-2">Cancel</div>';
                                echo '</div>
                                <div class="Exam_Card-footer text-muted">
                                '.$Cours_iNFO['cou_created'].'
                                </div>
                                </div>';
                            };
                            echo '</div>';
                        }else{
                            echo '<br><h3 align="center" class="p-3">You have not any requests now.</h3><br>';
                        };
                    ?>   
                </div>
            </div>
        </div>
    </div>


<script>
//Cancel Pending
$(document).on("click", "#CancelRequest", function(e){
	e.preventDefault();
	var id = $(this).data("id");
	var cou_name = $(this).data("name");
	Swal.fire({
			  title: 'You want to cancel '+ cou_name +' pending request ?',
			  icon: 'warning',
			  showCancelButton: true,
			  allowOutsideClick: false,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!',  
			  cancelButtonText : 'No'
		  }).then((result) => {
		if (result.value) {
		  $.ajax({
		  type : "post",
		  url : "libs/CancelRequest.php",
		  dataType : "json",  
		  data : {id:id},
		  cache : false,
		  success : function(data){
			if(data.status == "success"){
			  Swal.fire(
				'Success',
				"Your request has been successfully canceled.",
				'success'
				);
			  refreshDiv();
			};
		  },
		  error : function(xhr, ErrorStatus, error){
			console.log(status.error);
		  }
		});
		};
	  });
	return false;
});

</script>