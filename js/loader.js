function refreshDiv()
{
  $('#tableList').load(document.URL +  ' #tableList');
  $('#refreshData').load(document.URL +  ' #refreshData');
  $('#refreshFrm').load(document.URL +  ' #refreshFrm');

    // setTimeout(function() {
  //   location.reload();
  // }, 1900);
}
  
$(document).ready(function() {

	$('.counter').each(function () {
$(this).prop('Counter',0).animate({
	Counter: $(this).text()
}, {
	duration: 1000,
	easing: 'swing',
	step: function (now) {
		$(this).text(Math.ceil(now));
	}
});
}); 

});


function getUrlVars() {
	var vars2 = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value2) {
	vars2[key] = value2;
	});
	return vars2;
}
var page =  getUrlVars()["page"] ;
var id =  getUrlVars()["id"] ;
var Cou_id =  getUrlVars()["cou_id"] ;

if (page == "profile"){
	document.getElementById("MyProfile").classList.add("mm-active");
	document.getElementById("MyProfile2").classList.add("mm-active");
}else if (page == "myquestions"){
	document.getElementById("MyQuestionFrm").classList.add("mm-active");
	document.getElementById("MyQuestionFrm2").classList.add("mm-active");
}else if(page == "courses" || page == "details"){
	document.getElementById("AllCoursesFrm").classList.add("mm-active");
	document.getElementById("AllCoursesFrm2").classList.add("mm-active");
}else if (page == "pending"){
	document.getElementById("AllCoursesFrm").classList.add("mm-active");
	document.getElementById("AllCoursesFrm3").classList.add("mm-active");
}else if (page == "lectures"){
	document.getElementById("cou_"+id).classList.add("mm-active");
	document.getElementById("lec_"+id).classList.add("mm-active");
}else if (page == "exams"){
	document.getElementById("cou_"+id).classList.add("mm-active");
	document.getElementById("exam_"+id).classList.add("mm-active");
}else if (page == "assignments"){
	document.getElementById("cou_"+id).classList.add("mm-active");
	document.getElementById("assi_"+id).classList.add("mm-active");
}else if (page == "solving" || page == "assiresult"){
	document.getElementById("cou_"+Cou_id).classList.add("mm-active");
	document.getElementById("assi_"+Cou_id).classList.add("mm-active");
}else if (page == "examining" || page == "examresult"){
	document.getElementById("cou_"+Cou_id).classList.add("mm-active");
	document.getElementById("exam_"+Cou_id).classList.add("mm-active");
}else if (page == "watch"){
	document.getElementById("cou_"+Cou_id).classList.add("mm-active");
	document.getElementById("lec_"+Cou_id).classList.add("mm-active");
}else{
	 document.getElementById("myCoursesHome").classList.add("mm-active");
	 document.getElementById("myCoursesHome2").classList.add("mm-active");
};