<!-- Modal For Add Question -->
<div class="modal fade" id="addquestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addquestionfrm" method="post" enctype="multipart/form-data">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ask a question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">       
          <div class="form-group">
            <label>Question</label>
            <textarea name="Question" id="Que_place" class="form-control form-control " placeholder="Input Your Question" required="" autocomplete="off" style="height: 150px;"></textarea>
          </div>
          <div align="center" class="form-group">
              <input style="display: none;" type="file" name="fileToUpload" id="imageInput">
              <label for="imageInput" class="btn btn-dark mt-1" style="cursor: pointer; ">Upload Photo</label>
              <input type="hidden" id="CheckUploadPhoto" name="CheckPhoto" value="NoPhoto">
              <h6 style="margin: auto;" id="fileNameLabel" class="ml-3">No Photo Chosen...</h6>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_AskQuestion" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="submit" class="btn btn-primary">Ask Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<script>
//Sumbit Question
$(document).on("submit", "#addquestionfrm", function(event){
	event.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: 'libs/SumbitQue.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
				Swal.fire({
					title: 'Success',
					text: "Your question successfully submitted!",
					icon: 'success',
					allowOutsideClick: false,
					confirmButtonColor: '#223C61',
					confirmButtonText: 'OK!'
				}).then((result) => {
					if (result.value) {
						document.getElementById("Close_AskQuestion").click();
						document.getElementById("Que_place").value = "";
					};
				});
				refreshDiv();
			}else{
				Swal.fire({
					title: 'Error',
					text: "Try Again",
					icon: 'error',
					allowOutsideClick: false,
					confirmButtonColor: '#223C61',
					confirmButtonText: 'OK!'
				}).then((result) => {
					if (result.value) {
						document.getElementById("Que_place").value = "";
					};
				});
				
			};
		},
	});
	return false;
});

var uploadBtn = document.getElementById("imageInput");
var fileNameLabel = document.getElementById("fileNameLabel");
uploadBtn.addEventListener("change", function() {
  var selectedFile = uploadBtn.files[0];
  document.getElementById("CheckUploadPhoto").value="PhotoFound"
  fileNameLabel.textContent = selectedFile.name;
});

//Remove Question
$(document).on("click", "#RemoveQuestion", function(e){
	e.preventDefault();
   	Swal.fire({
		title: 'Are you sure?',
		text: "you want to remove your question ?",
		icon: 'warning',
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, remove now!'
		}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			$.ajax({
				type : "post",
				url : "libs/RemoveQuestion.php",
				dataType : "json",  
				data : {id:id},
				cache : false,
				success : function(data){
					if(data.status == "success"){
						Swal.fire({
							title: 'Success',
							text: "Your question successfully removed!",
							icon: 'success',
							allowOutsideClick: false,
							confirmButtonColor: '#223C61',
							confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								refreshDiv();
							};
						});
					}else{
						Swal.fire({
							title: 'Error',
							text: "Try Again",
							icon: 'error',
							allowOutsideClick: false,
							confirmButtonColor: '#d33',
							confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								refreshDiv();
							};
						});
					};
				}});
			};
		});
	return false;
});
</script>