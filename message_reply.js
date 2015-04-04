$(function() {

	$("form").submit(function(e) {
		e.preventDefault();

		$.ajax({

			url: "newReply.php",
			type: "POST",
			data: {username: $("#username").val(),
				title: $("#title").val(),
				userReply: $("#userReply").val()},
			dataType: "json",

			success: function(msg) {
				console.log(msg);
				if ( msg.error!="" )
				{
					$("#error").text(msg.error);
				}
				else
				{
					$("#reply").append("<tr><td>"+msg.name+
						"</td><td>"+msg.userReply+
						"</td><td>"+msg.time+"</td></tr>");
				}
			},

			error: function(msg) {
				alert("fial to reply");
			}
		});
	});
});