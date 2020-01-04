$(document).ready(function(){
	$("#save").click(saveData);
	$("[name='add']").click(function(){
		mode = "insert";
		$("#save").attr("value", "add");
	})
	$("body").on("click", ".edit", function(){
		mode = "update";
		$("#save").attr("value", "Edit");
		idTarget = $(this).attr("data-id");
		getData(idTarget);
	});
	$("body").on("click", ".delete", function(){
		idTarget = $(this).attr("data-id");
		var temp = confirm("Are you sure?");
		if(!temp){
			return false;
		}else{
			deleteData(idTarget);
		}
	});
	loadData();

	var mode = "insert";
	var idTarget = -1;

	var data;
	var tuneTitle;
	var tuneComposer;
	var category;
	var tuneImg;

	function getValue(){
		data = new FormData();

		tuneTitle = $("[name='name']").val();
		tuneComposer = $("[name='desk']").val();
		category = $("[name='kategori']").val();
		tuneImg = $("[name='tune_img']").prop("files")[0];

		if(tuneImg==undefined){
			tuneImg = null;
		}

		data.append("mode", mode);
		data.append("id", idTarget);
		data.append("tuneTitle", tuneTitle);
		data.append("tuneComposer", tuneComposer);
		data.append("category", category);
		data.append("tuneImg", tuneImg);
	}

	function saveData(){
		getValue();
		if(tuneTitle == ""){
			alert("name is invalid");
		}else if(tuneComposer==""){
			alert("deskripsi is missing");
		}else if(category==-1){
			alert("vælg kategori!");
		}else{
			if(mode=="insert"){
				insertData();
			}else if(mode=="update"){
				updateData();
			}
		}
	};

	function insertData(){
		$('#loading').show();
		getValue();
		$.post({
			url : "rest/tunes.php",
			data : data,
			contentType : false, 
			processData: false, 
			success : function(){
				loadData();
			},
			complete : function(){
				$('#loading').hide();
			}
		});
	}

	function getData($id){
		$.get({
			url : "rest/tunes.php",
			data : {mode:'loadOne', id:idTarget},
			success : function(data){
				var temp = JSON.parse(data);
				$("[name='name']").val(temp.TuneTitle);
				$("[name='desk']").val(temp.TuneComposer);
			}
		});

		//getcategory
		$.get({
			url : "rest/kategori.php",
			data : {mode:"loadOne", id:idTarget},
			success : function(data){
				$("[name='kategori']").html(data);
				//alert(data);
			}
		});
	}

	function updateData(){
		$('#loading').show();
		getValue();
		$.post({
			url : "rest/tunes.php",
			data : data,
			contentType : false, 
			processData: false, 
			success : function(){
				loadData();
				clearForm();
			},
			complete : function(){
				$('#loading').hide();
			}
		});
	}

	function loadData(){
		$.get({
			url : "rest/tunes.php",
			data : {mode:'load'},
			success : function(data){
				$("body table tbody").html(data);
			}
		});

		//getcategory
		$.get({
			url : "rest/kategori.php",
			data : {mode:"loadAll"},
			success : function(data){
				$("[name='kategori']").html(data);
				//alert(data);
			}
		});

		clearForm();
	};

	function deleteData(id){
		$('#loading').show();
		$.get({
			url : "rest/tunes.php",
			data : {mode:"delete", id:idTarget},
			success : function(){
				loadData();
				clearForm();
			},
			complete : function(){
				$('#loading').hide();
			}
		});
	}

	function clearForm(){
		$("[name='name']").val("");
		$("[name='desk']").val("");
		$("[name='kategori']").val("");
		$("[name='tune_img']").val("");

		data = new FormData();

		mode = "insert";
		$("#save").attr("value", "add");
		idTarget = -1;
	}
})