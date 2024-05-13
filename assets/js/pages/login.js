import { baseURL } from "./url.js";

$(document).ready(function () {
	$("#btnLogin").click(function () {
		var user = $("#username").val();
		var pass = $("#password").val();
		$.ajax({
			url: baseURL + "/Auth/authLogin",
			type: "POST",
			data: {
				user: user,
				pass: pass,
			},
			dataType: "json",
			success: function (data) {
				if (data.status == true) {
					Swal.fire({
						icon: "success",
						title: "Berhasil Login!",
						showConfirmButton: false,
						timer: 1500,
					}).then((result) => {
						window.location.href = baseURL + data.link;
					});
				} else {
					Swal.fire({
						icon: "error",
						title: data.message,
						showConfirmButton: false,
						timer: 1500,
					}).then((result) => {
						location.reload();
					});
				}
			},
		});
	});
});
