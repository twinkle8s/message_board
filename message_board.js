$(function() {

	$("form").submit(function(e) {
		e.preventDefault();

		$.ajax({

			url: "newMessage.php",
			type: "POST",
			data: {username: $("#username").val(),
				title: $("#title").val(),
				content: $("#content").val()},
			dataType: "json",

			success: function(msg) {
				console.log(msg);
				if ( msg.error!="" )
				{
					$("#error").text(msg.error);
				}
				else
				{
					$(".table").append("<tr><td>"+msg.name+
						"</td><td>"+msg.title+
						"</td><td>"+msg.time+
						"</td><td><a class='ahref' href='Message.php?title="+msg.title+"'>Show</a>"+
						"</td><td><a class='ahref' href='editMessage.php?title="+msg.title+"'>Edit</a>"+
						"</td><td><a class='ahref' href='deleteMessage.php?title="+msg.title+"'>Delete</a>"+
						"</td></tr>");
				}
			},

			error: function(msg) {
				alert("fail to post");
			}
		});
	});
});