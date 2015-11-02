//我的主页 修改／保存按钮的设置
$("#btn-change").bind("click", function (){
	var _this=$(this);
	if($("#btn-change").html() == "修改"){
		$("#btn-change").html("保存");
		$(".personal-infro-input").removeAttr("disabled");
		$("#btn-change").attr("data-target","");
	}
	else if($("#btn-change").html() == "保存"){
		
		$("#btn-change").attr("data-target","#myModal");
		
		//点击关闭，取消，页面，不上传数据并把修改了的数据还原
		$(".btn-personal-infro-change-dismiss,.btn-personal-infro-change-close").one("click",function(){
			$.post(
				"./php/stuInfro.php",
				{},function(a){
					var data= JSON.parse(a); 

					$("#infro-name").val(data.name);
					$("#infro-stuid").val(data.stuid);
					$("#infro-college").val(data.college);
					$("#infro-major").val(data.major);
					$("#infro-nation").val(data.nation);
					$("#infro-gender").val(data.gender);
					$("#infro-birthday").val(data.birthday);
					$("#infro-bloodType").val(data.bloodType);
					$("#infro-placeOfOrigin").val(data.placeOfOrigin);
					$("#infro-religion").val(data.religion);
					$("#infro-nationality").val(data.nationality);
				});		

		});
		$("#btn-change").html("修改");
		$(".personal-infro-input").attr("disabled","true");
		//点击确定按钮保存数据
		$(".btn-personal-infro-change-confirm").one("click",function(){
			var _this=$(this);
			var student_infro = new Array();
			$(".personal-infro-input").each(function(index,e){
				student_infro[_this.attr('data-value')]=_this.val();
			});
			$.post(
				"./php/changeElement.php",
				{
					name:$("#infro-name").val(),
					stuid:$("#infro-stuid").val(),
					college:$("#infro-college").val(),
					major:$("#infro-major").val(),
					nation:$("#infro-nation").val(),
					gender:$("#infro-gender").val(),
					birthday:$("#infro-birthday").val(),
					bloodType:$("#infro-bloodType").val(),
					placeOfOrigin:$("#infro-placeOfOrigin").val(),
					religion:$("#infro-religion").val(),
					nationality:$("#infro-nationality").val(),
				},function(a){
					var data=JSON.parse(a);
					if (data.success) {alert("数据保存成功")}
						else{alert("数据保存失败")};
				});
		});
	};
});

/**************************************************************************************/
/**************************************************************************************/
/**************************************************************************************/

//加载个人页面所有按钮
//个人页面删除按钮
$("#content_grade").on("click",".del_data_grade",function(){
	if (confirm('确定要删除本条数据嘛？'))
	{ 
		var _this=$(this);
		$.post("./php/delScore.php", 
		{
			id:$(_this.parent().parent()).attr("data-id"),
			name:$(_this.parent().parent().children().eq(0)).text(),
		}, 
		function(a){
			var data=JSON.parse(a);

			if (data.success) {
				alert("数据删除成功");
				$(_this.parent().parent()).remove();
			}
			else{alert("数据删除失败")};
		});
	};
});
//添加成绩时，点击添加按钮，选择学期&课程类型，加载学科（过程中）
$("#add_data_grade_term,#add_data_grade_kind").change(function(){
	$.post(
	"./php/returnClass.php",
	{
		term:$("#add_data_grade_term option:selected").val(),
		kind:$("#add_data_grade_kind option:selected").val()
	},function(a){
		var data = JSON.parse(a);
		$("#add_data_grade_course").empty();//清空course下拉框
		for (i in data) {
			$("#add_data_grade_course").append("<option><a href='#'>"+
				data[i]+"</a></option>"); 
		};
	});
});
//个人成绩添加按钮
$("#add_data_grade_save").on("click",function(){
	
	var _this=$(this);
	if (confirm('确定要添加本条数据嘛？')){
		$.post("./php/addScore.php", 
		{
			term:$("#add_data_grade_term option:selected").val(),
			kind:$("#add_data_grade_kind option:selected").val(),
			course:$("#add_data_grade_course option:selected").val(),
			grade:$("#add_data_grade_grade").val()
		}, 
		function(a){
			var data=JSON.parse(a);

			if (data.success) {
				alert("数据添加成功");
				$("#content_grade tbody").empty();


				//个人页面重载信息
				$.post(
					"./php/stuScore.php",
					{
						term:$("#select_term option:selected").val(),
						kind:$("#select_kind option:selected").val()
					},function(a){
						var data = JSON.parse(a);

						for (i in data) {
							$("#content_grade tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['course']
								+"</td><td>"+data[i]['credit']
								+"</td><td>"+data[i]['grade']
								+"</td><td>"+data[i]['kind']
								+"<td><a  class='pull-right del_data_grade' style='margin-right: 5px;'>删除</a></td></tr>"
								);
						};
						

					});
			}
			else{alert("数据添加失败")};
		});
	};
});
//个人页面改变学期&课程种类，返回新数据
$("#select_term,#select_kind").change(function(){
	$.post(
	"./php/stuScore.php",
	{
		term:$("#select_term option:selected").val(),
		kind:$("#select_kind option:selected").val()
	},function(a){
		$("#content_grade tbody").empty();
		var data = JSON.parse(a);
		//重新加载信息
		for (i in data) {
			$("#content_grade tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['course']
				+"</td><td>"+data[i]['credit']
				+"</td><td>"+data[i]['grade']
				+"</td><td>"+data[i]['kind']
				+"<td><a  class='pull-right del_data_grade' style='margin-right: 5px;'>删除</a></td></tr>"
				);
		};
	});
});

/**************************************************************************************/
/**************************************************************************************/
/**************************************************************************************/

//加载所有科技竞赛页面按钮
//科技竞赛修改－保存按钮
$("#content_tech").on("click","#change_data_tech_save",function(){
	var _this=$(this);
	if (confirm('确定要修改本条数据嘛？')){
		$.post("./php/updateSci.php", 
		{
			id:$(_this).attr("data-id"),
			time:$("#change_data_tech_time").val(),
			kind:$("#change_data_tech_kind option:selected").val(),
			grade:$("#change_data_tech_grade").val(),
			name:$("#change_data_tech_name").val(),
			result:$("#change_data_tech_result").val(),
		}, 
		function(a){
			var data=JSON.parse(a);
			if (data.success) {
				alert("数据添加成功");
				$("#content_tech tbody").empty();
				// 加载科技竞赛
				$.post(
					"./php/stuSci.php",
					{},function(a){
						var data = JSON.parse(a);

						for (i in data) {
							$("#content_tech tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['name']
								+"</td><td>"+data[i]['time']
								+"</td><td>"+data[i]['result']
								+"</td><td>"+data[i]['grade']
								+"</td><td><a href='#' class='change_data_tech pull-right' data-toggle='modal' data-target='#change_tech' style='margin-right: 5px;'>修改</a><a href='#' class='pull-right del_data_tech' style='margin-right: 5px;'>删除</a></td></tr>"
								);
						};
						
					});
			}
			else{alert("数据修改失败")};
		});
	};
});
//科技竞赛添加-保存按钮
$("#add_data_tech_save").on("click",function(){
	var _this=$(this);
	if (confirm('确定要添加本条数据嘛？')){
		$.post("./php/addSci.php", 
		{

			time:$("#add_data_tech_time").val(),
			kind:$("#add_data_tech_kind option:selected").val(),
			grade:$("#add_data_tech_grade").val(),
			name:$("#add_data_tech_name").val(),
			result:$("#add_data_tech_result").val(),
		}, 
		function(a){
			var data=JSON.parse(a);
			if (data.success) {
				alert("数据添加成功");
				$("#content_tech tbody").empty();
				// 加载科技竞赛
				$.post(
					"./php/stuSci.php",
					{},function(a){
						var data = JSON.parse(a);

						for (i in data) {
							$("#content_tech tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['name']
								+"</td><td>"+data[i]['time']
								+"</td><td>"+data[i]['result']
								+"</td><td>"+data[i]['grade']
								+"</td><td><a href='#' class='add_data_tech pull-right' data-toggle='modal' data-target='#change_tech' style='margin-right: 5px;'>修改</a><a href='#' class='pull-right del_data_tech' style='margin-right: 5px;'>删除</a></td></tr>"
								);
						};	
					});
			}
			else{alert("数据添加失败")};
		});
	};
});
//加载科技竞赛修改框内容
$("#content_tech").on("click",".change_data_tech",function(){
	var _this=$(this);
	$("#change_data_tech_save").attr("data-id",$(_this.parent().parent()).attr("data-id"));
	$.post("./php/reloadSci.php", 
		{id:$(_this.parent().parent()).attr("data-id")},
		function(a){
			var data=JSON.parse(a);
			$("#change_data_tech_time").val(data.time);
			switch(data.kind){
				case 1:
				$("#change_data_tech_kind option:eq(0)").attr("selected","selected");
				break;
				case 2:
				$("#change_data_tech_kind option:eq(1)").attr("selected","selected");
				break;
				case 3:
				$("#change_data_tech_kind option:eq(2)").attr("selected","selected");
				break;
				case 4:
				$("#change_data_tech_kind option:eq(3)").attr("selected","selected");
				break;
				case 5:
				$("#change_data_tech_kind option:eq(4)").attr("selected","selected");
				break;
				case 6:
				$("#change_data_tech_kind option:eq(5)").attr("selected","selected");
				break;
			}
			$("#change_data_tech_grade").val(data.grade);
			$("#change_data_tech_name").val(data.name);
			$("#change_data_tech_result").val(data.result);
		})
});	
//科技竞赛删除按钮
$("#content_tech").on("click",".del_data_tech",function(){
	var _this=$(this);
	if (confirm("确定要删除本条数据嘛？"))
	{
		$(_this.parent().parent()).remove();
		$.post("./php/delSci.php", {id:$(_this.parent().parent()).attr("data-id")}, 
			function(a){
				var data=JSON.parse(a);

				if (data.success) {
					alert("数据删除成功");
					$(_this.parent().parent()).remove();
				}
				else{alert("数据删除失败")};
			});
	};
});

/**************************************************************************************/
/**************************************************************************************/
/**************************************************************************************/


//加载所有社会实践按钮

//社会实践修改－保存按钮
$("#content_prac").on("click","#change_data_prac_save",function(){
	var _this=$(this);
	if (confirm('确定要修改本条数据嘛？')){
		$.post("./php/updateSocial.php", 
		{
			id:$(_this).attr("data-id"),
			date:$("#change_data_prac_date").val(),
			kind:$("#change_data_prac_kind option:selected").val(),
			grade:$("#change_data_prac_grade").val(),
			place:$("#change_data_prac_place").val(),
			content:$("#change_data_prac_content").val(),
		}, 
		function(a){
			var data=JSON.parse(a);
			if (data.success) {
				alert("数据添加成功");
				$("#content_prac tbody").empty();
				// 加载社会实践
				$.post(
					"./php/stuSocial.php",
					{},function(a){
						var data = JSON.parse(a);

						for (i in data) {
							$("#content_prac tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['time']
								+"</td><td>"+data[i]['place']
								+"</td><td>"+data[i]['content']
								+"</td><td>"+data[i]['grade']
								+'</td><td><a href="#" class="change_data_prac pull-right" data-toggle="modal" data-target="#change_prac" style="margin-right: 5px;">修改</a><a href="#" class="del_data_prac pull-right" style="margin-right: 5px;">删除</a></td></tr>'
								);
						};
						
					});
			}
			else{alert("数据添加失败")};
		});
	};
});
//社会实践删除按钮
$("#content_prac").on("click",".del_data_prac",function(){
	if (confirm('确定要删除本条数据嘛？'))
	{ 
		var _this=$(this);
		$(_this.parent().parent()).remove();
		$.post("./php/delSocial.php", 
		{
			id:$(_this.parent().parent()).attr("data-id")
		}, 
		function(a){
			var data=JSON.parse(a);

			if (data.success) {
				alert("数据删除成功");
				$(_this.parent().parent()).remove();
			}
			else{alert("数据删除失败")};
		});
	};
});
//社会实践添加－保存按钮
$("#add_data_prac_save").on("click",function(){
	var _this=$(this);
	if (confirm('确定要添加本条数据嘛？')){
		$.post("./php/addSocial.php", 
		{
			date:$("#add_data_prac_date").val(),
			kind:$("#add_data_prac_kind option:selected").val(),
			grade:$("#add_data_prac_grade").val(),
			place:$("#add_data_prac_place").val(),
			content:$("#add_data_prac_content").val(),
		}, 
		function(a){
			var data=JSON.parse(a);
			if (data.success) {
				alert("数据添加成功");
				$("#content_prac tbody").empty();
				// 加载社会实践
				$.post(
					"./php/stuSocial.php",
					{},function(a){
						var data = JSON.parse(a);

						for (i in data) {
							$("#content_prac tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['time']
								+"</td><td>"+data[i]['place']
								+"</td><td>"+data[i]['content']
								+"</td><td>"+data[i]['grade']
								+"</td><td><a href='#' class='add_data_prac pull-right' data-toggle='modal' data-target='#change_prac' style='margin-right: 5px;'>修改</a><a href='#' class='del_data_prac pull-right' style='margin-right: 5px;'>删除</a></td></tr>"
								);
						};
						//修改社会实践


					});
			}
			else{alert("数据添加失败")};
		});
	};
});
//加载社会实践修改框内容，以及修改－保存按钮的data－id
$("#content_prac").on("click",".change_data_prac",function(){
	var _this=$(this);
	$("#change_data_prac_save").attr("data-id",$(_this.parent().parent()).attr("data-id"));
	$.post("./php/reloadSocial.php", 
		{id:$(_this.parent().parent()).attr("data-id")},
		function(a){
			var data=JSON.parse(a);
			$("#change_data_prac_date").val(data.date);
			switch(data.kind){
				case 1:
				$("#change_data_prac_kind option:eq(0)").attr("selected","selected");
				break;
				case 2:
				$("#change_data_prac_kind option:eq(1)").attr("selected","selected");
				break;
				case 3:
				$("#change_data_prac_kind option:eq(2)").attr("selected","selected");
				break;
			}
			$("#change_data_prac_grade").val(data.grade);
			$("#change_data_prac_place").val(data.place);
			$("#change_data_prac_content").val(data.content);
		})
});
//社会实践删除按钮
$("#content_prac").on("click",".del_data_prac",function(){
	if (confirm('确定要删除本条数据嘛？'))
	{ 
		var _this=$(this);
		$(_this.parent().parent()).remove();
		$.post("./php/delSocial.php", 
		{
			id:$(_this.parent().parent()).attr("data-id")
		}, 
		function(a){
			var data=JSON.parse(a);

			if (data.success) {
				alert("数据删除成功");
				$(_this.parent().parent()).remove();
			}
			else{alert("数据删除失败")};
		});
	};
});

/**************************************************************************************/
/**************************************************************************************/
/**************************************************************************************/

