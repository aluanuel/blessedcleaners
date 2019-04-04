$(document).ready(function(){
	$("#sub_student").click(function(){
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		var gender = $("#gender").val();
		var dob = $("#dob").val();
		var stream = $("#stream").val();
		var parent = $("#parent").val();
		var phone = $("#phone").val();
		if(fname == '' || lname =='' || gender == '' || dob == '' || stream =='' || parent =='' || phone ==''){
			alert("Fill the empty fields");
		}else{
			$.post("functions.php",{
				name1: fname,
				name2: lname,
				sex: gender,
				birthday: dob,
				st_class: stream,
				st_parent: parent,
				tel: phone
			},function(data) {
alert(data);
$('#studentform')[0].reset(); // To reset form fields
});
		}
	})
});