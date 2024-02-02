<?php  
    if ($status == 'access'){

        // Count All Course
        $selCourse = $conn->query("SELECT COUNT(cou_id) as totCourse FROM course_tbl ")->fetch(PDO::FETCH_ASSOC);

        // Count All Exam
        $selExam = $conn->query("SELECT COUNT(ex_id) as totExam FROM exam_tbl ")->fetch(PDO::FETCH_ASSOC);

        // Count All Students
        $selStudent = $conn->query("SELECT COUNT(stu_id) as totStudents FROM student_tbl ")->fetch(PDO::FETCH_ASSOC);

        // Count All Lectures
        $sellec = $conn->query("SELECT COUNT(lec_id) as totlec FROM lec_tbl ")->fetch(PDO::FETCH_ASSOC);
        
    }else{

    }
?>   

