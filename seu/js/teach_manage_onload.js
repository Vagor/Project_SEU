//显示专业

$("#select_college").change(function(){
	$.post("./php/returnMajor.php", {
		college:$("#select_college option:selected").text(),
	}, function(a){
		var data = JSON.parse(a);
		$("#select_major").empty();//清空course下拉框
		$("#select_major").append("<option><a href='#'>专业</a></option>"); 
		for (i in data) {
			$("#select_major").append("<option><a href='#'>"+data[i]+"</a></option>"); 
		};
	});
});


//搜索学生
$('#stu_search').click(function(){
	$.post("./php/returnStu.php", {
		year:$("#select_year option:selected").text(),
		college:$("#select_college option:selected").text(),
		major:$("#select_major option:selected").text(),
		class:$("#select_class option:selected").val(),
	}, function(a){
		// alert(a);
		var data = JSON.parse(a);

		$("tbody").empty();
		for (var i = 0; i < data.length; i++) {
			$("tbody").append("<tr>");
			for (var j = 0; j < 5; j++) {
				$("tbody").append("<td><a href=teach_index.php?uid="+data[5*i+j]["uid"]+">"+data[5*i+j]["name"]+"</a></td>");
			};
			$("tbody").append("</tr>");
		};
	});
});

$(".logout").on("click",function(){
	if (confirm("确定要退出账号吗？")) {
	$(".logout").attr("href", './login/login.php');
	};
})
