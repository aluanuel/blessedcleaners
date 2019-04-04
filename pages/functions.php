<?php
/***=======================This class manages information about subjects in the system===============================***/
	class Subject{
		public $conn;
		public $result;
		public function __construct($result){
			$this ->result = $result;
		}
		public function __toString(){
			try{
				return (string) $this->result;
			}
			catch(Exception $e){
				return 'Could not be converted';
			}

		}

		/*=============function to add subject*================*/
		function addSubject($conn,$subject_name,$id_stream){
			$result=mysqli_query($conn,"INSERT INTO subject(subjectname,idstream) VALUES('$subject_name','$id_stream')") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to edit subject*================*/
		function editSubject($conn,$id_subject,$subject_name){
			$result=mysqli_query($conn,"UPDATE TABLE subject SET subjectname = '$subject_name' WHERE idsubject = $id_subject") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to select subject*================*/
		function selectSubject($conn,$id_subject){
			$result=mysqli_query($conn,"SELECT * FROM subject WHERE idsubject = $id_subject") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to select subjects of a class *================*/
		function selectStreamSubjects($conn,$id_stream){
			$result=mysqli_query($conn,"SELECT * FROM subject WHERE idsubject = $id_stream") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to select all subjects*================*/
		function selectAllSubjects($conn,$id_subject,$subject_name){
			$result=mysqli_query($conn,"SELECT * FROM subject ORDER BY idstream ASC") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to delete subject*================*/
		function deleteSubject($conn,$id_subject,$subject_name){
			$result=mysqli_query($conn,"DELETE FROM subject WHERE idsubject = $id_subject AND subjectname = '$subject_name'") OR die(mysqli_error($conn));
			return $result;
		}
	}
/*==============================End of class Subject=========================================*/

/***=======================This class manages information on users of the system====================================***/

	class Users{
		// public $conn;
		public $result;
		public function __construct($result){
			$this ->result = $result;
		}
		public function __toString(){
			try{
				return (string) $this->result;
			}
			catch(Exception $e){
				return 'Could not be converted';
			}

		}
		/*=============function to add new user*================*/
		function addUser($conn,$fname,$lname,$phone,$email,$type){
			$result=mysqli_query($conn,"INSERT INTO users(fname,lname,phone,email,usertype,password) VALUES('$fname','$lname','$phone','$email','$type','null')") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to select a user================*/
		function selectOneUser($conn,$username){
			$result=mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select users================*/
		function selectAllUsers($conn){
			$result=mysqli_query($conn,"SELECT * FROM users ORDER BY fname ASC") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to set user password*================*/
		function resetPassword($conn,$id_user,$fname,$lname,$password){
			$result=mysqli_query($conn,"UPDATE TABLE users SET password = '$password' WHERE iduser = $id_user AND fname='$fname' AND lname='$lname'") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to edit user*================*/
		function editUser($conn,$id_user,$fname,$lname,$phone,$email){
			$result=mysqli_query($conn,"UPDATE TABLE subject SET fname = '$fname',lname = '$lname',phone = '$phone',email = '$email' WHERE iduser = $id_user") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to delete user*================*/
		function deleteUser($conn,$id_user,$fname,$lname){
			$result=mysqli_query($conn,"DELETE FROM users WHERE iduser = $id_user AND fname = '$fname' AND lname='$lname'") OR die(mysqli_error($conn));
			return  $result;
		}
	}

	/*==============================End of class Users=========================================*/

/***======================This class manages information on Classes or Streams of the school======================***/
		class Stream{
		// public $conn;
		public $result;
		public function __construct($result){
			$this ->result = $result;
		}
		public function __toString(){
			try{
				return (string) $this->result;
			}
			catch(Exception $e){
				return 'Could not be converted';
			}

		}


		/*=============function to add a stream *================*/
		function addStream($conn,$stream_name){
			$result=mysqli_query($conn,"INSERT INTO stream(streamname) VALUES('$stream_name')") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to edit stream*================*/
		function editStream($conn,$id_stream,$stream_name){
			$result=mysqli_query($conn,"UPDATE TABLE stream SET streamname = '$stream_name' WHERE idstream = $id_stream") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select stream*================*/
		function selectStream($conn,$id_stream){
			$result=mysqli_query($conn,"SELECT idstream,streamname FROM stream WHERE idstream = $id_stream") OR die(mysqli_error($conn));
			return $result;
		}
		/*=============function to delete stream*================*/
		function deleteStream($conn,$id_stream,$stream_name){
			$result=mysqli_query($conn,"DELETE FROM stream WHERE idstream = $id_stream AND streamname = '$stream_name'") OR die(mysqli_error($conn));
			return  $result;
		}
	}

		/*==============================End of class Stream=========================================*/

/***======================This class manages information on grading system of the school======================***/

	class Grade{
		// public $conn;
		public $result;
		public function __construct($result){
			$this ->result = $result;
		}
		public function __toString(){
			try{
				return (string) $this->result;
			}
			catch(Exception $e){
				return 'Could not be converted';
			}

		}


		/*=============function to add new grade*================*/
		function addGrade($conn,$grade_mark,$grade_label){
			$result=mysqli_query($conn,"INSERT INTO grade(grademark,gradelabel) VALUES('$grade_mark','$grade_label')") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select a grade================*/
		function selectOneGrade($conn,$id_grade){
			$result=mysqli_query($conn,"SELECT * FROM grade WHERE idgrade = $id_grade") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select grades================*/
		function selectAllGrades($conn){
			$result=mysqli_query($conn,"SELECT * FROM grade") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to edit grade*================*/
		function editGrade($conn,$id_grade,$grade_mark){
			$result=mysqli_query($conn,"UPDATE TABLE grade SET grademark = '$grade_mark' WHERE idgrade = $id_grade") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to delete grade*================*/
		function deleteGrade($conn,$id_grade,$grade_label){
			$result=mysqli_query($conn,"DELETE FROM grade WHERE idgrade = $id_grade AND gradelabel = '$grade_label'") OR die(mysqli_error($conn));
			return  $result;
		}
	}

		/*==============================End of class Grade=========================================*/

/***======================This class manages information on students========================================***/
	class Student{
		// public $conn;
		public $result;
		public function __construct($result){
			$this ->result = $result;
		}
		public function __toString(){
			try{
				return (string) $this->result;
			}
			catch(Exception $e){
				return 'Could not be converted';
			}

		}

		/*=============function to add new student*================*/
		function newStudent($conn,$fname,$lname,$gender,$dob,$stream,$gurdian_name,$phone){
			$result=mysqli_query($conn,"INSERT INTO student(fname,lname,gender,dob,idstream,guardian,guardianphone) VALUES('$fname','$lname','$gender','$dob',$stream,'$gurdian_name','$phone')") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select a user================*/
		function selectOneStudent($conn,$fname,$lname){
			$result=mysqli_query($conn,"SELECT * FROM student WHERE fname='$fname' AND lname='$lname'") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select users================*/
		function selectStudentByClass($conn,$id_stream){
			$result=mysqli_query($conn,"SELECT * FROM student where idstream = $id_stream ORDER BY fname ASC") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to edit student information*================*/
		function editStudent($conn,$id_student,$fname,$lname,$gender,$dob,$stream,$gurdian_name,$phone){
			$result=mysqli_query($conn,"UPDATE TABLE student SET fname = '$fname',lname = '$lname', dob = '$dob', idstream = $stream, phone = '$phone' WHERE idstudent = $id_student") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to edit user*================*/
		// function editUser($conn,$id_user,$fname,$lname,$phone,$email){
		// 	$result=mysqli_query($conn,"UPDATE TABLE subject SET fname = '$fname',lname = '$fname',phone = '$phone',email = '$email' WHERE iduser = $id_user") OR die(mysqli_error($conn));
		// 	return $result;
		// }
		/*=============function to delete student*================*/
		function deleteStudent($conn,$id_student,$fname,$lname){
			$result=mysqli_query($conn,"DELETE FROM student WHERE idstudent = $id_student AND fname = '$fname' AND lname='$lname'") OR die(mysqli_error($conn));
			return  $result;
		}
	}

		/*==============================End of class Student=========================================*/

/***======================This class manages information on Classes or Streams of the school======================***/
class ExaminationResult{
	public $result;

		public function __construct($result){
			$this ->result = $result;
		}

		public function __toString(){
			try{
				return (string) $this->result;
			}
			catch(Exception $e){
				return 'Could not be converted';
			}

		}
		/*=============function to enter student marks ================*/
		function enterMarks($conn,$score,$exam_type,$term,$id_stream,$id_subject,$id_student){
			$result=mysqli_query($conn,"INSERT INTO marks(score,examType,term,year,idstream,idsubject,idstudent) VALUES($score,'$exam_type',$term,DATE(NOW()),$id_stream,$id_subject,$id_student)") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select marks for one student================*/
		function selectStudentMarks($conn,$fname,$lname,$id_stream){
			$result=mysqli_query($conn,"SELECT DISTINCT m.score,m.examType,m.term,m.year,s.fname,s.lname,st.streamname,su.subjectname FROM marks m, student s, stream st, subject su WHERE s.fname = '$fname' AND s.lname ='$lname' AND st.idstream = $id_stream AND m.idstudent = s.idstudent AND su.idstream = m.idstream AND su.idstream = st.idstream") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select marks by teacher================*/
		function selectClassTeacherMarks($conn,$id_stream,$id_user){
			$result=mysqli_query($conn,"SELECT m.idmarks,m.score,m.examType,m.term,m.year,s.fname,s.lname FROM marks m, student s, staff t, subject p, users u WHERE (m.idstudent = s.idstudent AND m.idstream = $id_stream) AND t.idsubject = p.idsubject AND u.iduser='$iduser'") OR die(mysqli_error($conn));
			return  $result;
		}
		/*=============function to select all marks================*/
		// function selectMarks($conn,$id_stream,$term){
		// 	$result=mysqli_query($conn,"SELECT m.idmarks,m.score,m.examType,m.term,m.year,s.fname,s.lname FROM marks m, student s, staff t, subject p, users u WHERE (m.idstudent = s.idstudent AND m.idstream = $id_stream) AND t.idsubject = p.idsubject AND u.iduser='$iduser'") OR die(mysqli_error($conn));
		// 	return  $result;
		// }
}

?>