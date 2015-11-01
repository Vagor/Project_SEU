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
	$.post("url", {
		year:$("#select_year option:selected").text(),
		college:$("#select_college option:selected").text(),
		major:$("#select_major option:selected").text(),
		class:$("#select_class option:selected").val(),
	}, function(a){
		var data = JSON.parse(a);
		var row = data.length/5;
		var rowcontent = newArray();
		for (var i = 0; i < row; i++) {
			var j = i+1;
			rowcontent[i] = "<tr><td>"+data[5*i+0]+"</td><td>"+data[5*i+1]+"</td><td>"+data[5*i+2]+"</td><td>"+data[5*i+3]+"</td><td>"+data[5*i+4]+"</td></tr>"
		};




	});
});


