//我的主页页面初始加载信息
$(function(){
	// 加载个人信息，加载用户名
	$.post(
	"./php/stuInfro.php",
	{},function(a){
		var data= JSON.parse(a);
		var year = data.year;//入学年份
			$("#select_term,#add_data_grade_term").append("<option value=1 selected='selected'>"+parseInt(year)
			+"年秋季</option><option value=2>"+(++year)
			+"年春季</option><option value=3>"+(year)
			+"年秋季</option><option value=4>"+(++year)
			+"年春季</option><option value=5>"+(year)
			+"年秋季</option><option value=6>"+(++year)
			+"年春季</option><option value=7>"+(year)
			+"年秋季</option><option value=8>"+(++year)
			+"年春季</option>");//个人成绩页面的年级检索下拉框

		$('#username').append(data.name +"<span class='caret'></span>");

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
	// 加载个人照片
	$.post(
	"./php/stuPhoto.php",
	{},function(a){
		var data= JSON.parse(a);
		var link= "./images/"+data.url;
		$("#stu-photo").attr("src",link);
	});
	// 加载成绩
	$.post(
	"./php/stuGrade.php",
	{},function(a){
		var data = JSON.parse(a);
		for (i in data) {
			var j=parseInt(i)+1;
			$("#content_mypage tbody").append("<tr><td>"+j
					+"</td><td>"+data[i]['term']
					+"</td><td>"+data[i]['grade']
					+"</td><td>"+data[i]['tech']
					+"</td><td>"+data[i]['prac']
					+"</td><td>"+data[i]['total']
				+"</td></tr>"
				);
		};
	});
});


//个人成绩 页面初始加载信息
$(function(){
	//加成学科
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

	// 加载个人成绩
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
		$(".del_data_grade").on("click",function(){
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
	});
});
//选择学期时，加载学科
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


//改变select value时返回新数据
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
		//加载删除按钮
		$(".del_data_grade").on("click",function(){
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

	});
});




//社会实践页面初始加载信息
$(function(){

	// 加载社会实践
	$.post(
	"./php/stuSocial.php",
	{},function(a){
		var data = JSON.parse(a);

		for (i in data) {
			var j=parseInt(i)+1;
			$("#content_prac tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['time']
					+"</td><td>"+data[i]['place']
					+"</td><td>"+data[i]['content']
					+"</td><td>"+data[i]['grade']
					+'</td><td><a href="#" class="change_data_prac pull-right" data-toggle="modal" data-target="#change_prac" style="margin-right: 5px;">修改</a><a href="#" class="del_data_prac pull-right" style="margin-right: 5px;">删除</a></td></tr>'
				);
			
		};
		//修改社会实践
		//加载社会实践修改框内容
		$(".change_data_prac").on("click",function(){
			var _this=$(this);
			$(".change_data_prac_save").attr("data-id",$(_this.parent().parent()).attr("data-id"));
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
		})
		//修改社会实践内容
		$("#change_data_prac_save").on("click",function(){
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
									$("#content_prac tbody").append("<tr data-id="+data[i]['id']+"><td>"+data[i]['date']
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
		$(".del_data_prac").on("click",function(){
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
	});
});

//科技竞赛 页面初始加载信息
$(function(){

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
		//科技竞赛修改
		//加载科技竞赛修改框内容
		$(".change_data_tech").on("click",function(){
			var _this=$(this);
			$(".change_data_tech_save").attr("data-id",$(_this.parent().parent()).attr("data-id"));
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
		})

		//修改科技竞赛内容
		$("#change_data_tech_save").on("click",function(){
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
		//科技竞赛删除按钮
		$(".del_data_tech").on("click",function(){
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
		
	});
});



//选择左侧边栏，显示页面
	$("#tab_mypage").on("click",function(){
		$("#sidebar-left li").attr("class","");
		$("#tab_mypage").attr("class", "item_active");
		$(".main").css("display","none");
		$("#content_mypage").css("display", "block");
	});
	$("#tab_grade").on("click",function(){
		$("#sidebar-left li").attr("class","");
		$("#tab_grade").attr("class", "item_active");
		$(".main").css("display","none");
		$("#content_grade").css("display", "block");
	});
	$("#tab_tech").on("click",function(){
		$("#sidebar-left li").attr("class","");
		$("#tab_tech").attr("class", "item_active");
		$(".main").css("display","none");
		$("#content_tech").css("display", "block");
	});
	$("#tab_prac").on("click",function(){
		$("#sidebar-left li").attr("class","");
		$("#tab_prac").attr("class", "item_active");
		$(".main").css("display","none");
		$("#content_prac").css("display", "block");
	});



//登出
$(".logout").on("click",function(){
	if (confirm("确定要退出账号吗？")) {
	$(".logout").attr("href", './login/login.php');
	};
})

//修改密码
$(".change_psw_btn").on("click",function(){
	$('#change_psw').modal('show')
})
















