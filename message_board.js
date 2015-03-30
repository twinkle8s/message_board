$(function() {

	$("#post").on("click", function() {

		$.ajax({

			url: "newMessage.php",
			type: "POST",
			data: {username: $("#username").val(),
				title: $("#title").val(),
				content: $("#content").val()},
			

			success: function(msg) {
				console.log(msg);
				//$("#error1").text(function(error) {
				//	return error;
				//})

				$("#table1").append("<tr>"+msg+"</td>");
			}

			error: function
		});
	});
});