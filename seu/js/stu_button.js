//我的主页 修改／保存按钮的设置
$("#btn-change").bind("click", function (){
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


