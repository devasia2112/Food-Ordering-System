$(function() {
	$("#submit").click(function() {
		var category 	= $("select#category").val();
		var code 		= $("input#code").val();
		var name 		= $("input#name").val();
		var desc 		= $("textarea#desc").val();
		var spicy 		= $("select#spicy").val();
		var chef 		= $("checkbox#chef").val();
		var size 		= $("select#size").val();
		var price 		= $("input#price").val();
		var coupom 		= $("input#coupom").val();
		//var photo		= $("input#photo").val();

		// Builds the string with posted values
		var dataString = 'category=' + category + '&code=' + code + '&name=' + name + '&desc=' + desc + '&spicy=' + spicy + '&chef=' + chef + '&size=' + size + '&price=' + price + '&coupom=' + coupom + '&photoimg=' + photoimg;

		$.ajax({
			type: "POST",
			url: "../model/products-insert.php",
			data: dataString,
			cache: false, // Do not cache the page
			success: function(msg) {
				alert("success");
				$("#alert").html(msg); // Display messages (php echo)
			},
			// If there is an Ajax error or cannot connect to actions.php, display the error message
			error: function(msg) {
				alert("error");
				document.getElementById("alert").innerHTML="Your request could not be processed.";
				$("#alert").slideDown("fast");
			}
		});
		return false;
	});
});
