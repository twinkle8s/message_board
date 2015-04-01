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
					$("#reply").append("<span>"+msg.name+
						"</span><span> : "+msg.userReply+
						"</span><span>"+msg.time+"</span><br>");
				}
			},

			error: function(msg) {
				alert("fial to reply");
			}
		});
	});
});