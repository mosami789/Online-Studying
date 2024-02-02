//Refresh Div  
function refreshDiv(){
  $('#tableList').load(document.URL +  ' #tableList');
  $('#refreshData').load(document.URL +  ' #refreshData');
  $('#refreshFrm').load(document.URL +  ' #refreshFrm');
  
  // setTimeout(function() {
    //   location.reload();
    // }, 1900);
}
  
//Notification
function Notification(msg, title) {
    toastr.options = {
      "closeButton": true,
      "debug": true,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "showDuration": 300,
      "hideDuration": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000,
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
      
    };
    // Command: toastr["success"]("Selected Course has been successfully updated!", "Update Course")
    toastr.success(msg, title);
    return false;
}
  
function NotificationError(msg, title) {
  toastr.options = {
    "closeButton": true,
    "debug": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "showDuration": 300,
    "hideDuration": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    
  };
  // Command: toastr["success"]("Selected Course has been successfully updated!", "Update Course")
  toastr.error(msg, title);
  return false;
}

//Search In tables
function SearchTabel(id) {
  var input, filter, table, tr, td, i, txtValue , found;
  input = document.getElementById("searchInput_"+ id);
  filter = input.value.toUpperCase();
  table = document.getElementById("tableList_" + id);
  tr = table.getElementsByTagName("tr");
  found = false;
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      txtValue = td[j].textContent || td[j].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        break;
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  if (table.querySelectorAll('tr[style="display: none;"]').length === tr.length - 1) {
    document.getElementById("notFound_" + id).style.display = "block";
  } else {
    document.getElementById("notFound_" + id).style.display = "none";
  };
}

//Foramt Data
function DataFormat(data){
  const date = new Date(data);
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const day = String(date.getDate()).padStart(2, "0");          
  const formattedDate = `${year}-${month}-${day}`;
  return formattedDate;
};

//SideBar Select Function
function getUrlVars() {
	var vars2 = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value2) {
	vars2[key] = value2;
	});
	return vars2;
}

var page =  getUrlVars()["page"] ;
var id =  getUrlVars()["id"] ;
var id2 =  getUrlVars()["course"] ;

if (page == "manage-course"){
	document.getElementById("managecourse1").classList.add("mm-active");
	document.getElementById("managecourse2").classList.add("mm-active");
}else if (page == "manage-exam"){
  document.getElementById("manageexam1").classList.add("mm-active");
	document.getElementById("manageexam2").classList.add("mm-active");
}else if (page == "manage-assignment"){
  document.getElementById("assignment1").classList.add("mm-active");
	document.getElementById("assignment2").classList.add("mm-active");
}else if (page == "manage-student" || page == 'student-setting'){
  document.getElementById("student1").classList.add("mm-active");
	document.getElementById("student2").classList.add("mm-active");
}else if (page == "course-requests"){
  document.getElementById("Cou_" + id).classList.add("mm-active");
	document.getElementById("Req_" + id).classList.add("mm-active");
}else if (page == "course-setting"){
  document.getElementById("Cou_" + id).classList.add("mm-active");
	document.getElementById("Lec_" + id).classList.add("mm-active");
}else if (page == "course-exam"){
  document.getElementById("Cou_" + id).classList.add("mm-active");
	document.getElementById("Exam_" + id).classList.add("mm-active");
}else if (page == 'exam-setting' || page == 'exam-questions' || page == 'exam-results'){
  document.getElementById("Cou_" + id2).classList.add("mm-active");
	document.getElementById("Exam_" + id2).classList.add("mm-active");
}else if (page == "course-assignment"){
  document.getElementById("Cou_" + id).classList.add("mm-active");
	document.getElementById("Assi_" + id).classList.add("mm-active");
}else if (page == "assignment-setting" || page == 'assignment-questions' || page == 'assignment-answers'){
  document.getElementById("Cou_" + id2).classList.add("mm-active");
	document.getElementById("Assi_" + id2).classList.add("mm-active");
}else if (page == 'user-setting'){
  document.getElementById("MyProfile").classList.add("mm-active");
	document.getElementById("MyProfile2").classList.add("mm-active");
}else if (page == 'web-setting'){
  document.getElementById("WebSetting").classList.add("mm-active");
	document.getElementById("WebSetting2").classList.add("mm-active");
}else if (page == 'student-questions' || page == 'view-questions'){
  document.getElementById("Stu_Que").classList.add("mm-active");
	document.getElementById("Stu_Que2").classList.add("mm-active");
}else{
  document.getElementById("AdminDashboard").classList.add("mm-active");
	document.getElementById("AdminDashboard2").classList.add("mm-active");
};