import { baseURL } from "./url.js";

$(document).ready(function () {
	$("#btnRegis").click(function () {
		var name = $("#name").val();
		var no_telp = $("#no_telp").val();
		var email = $("#email").val();
		var user = $("#username").val();
		var pass = $("#password").val();
		$.ajax({
			url: baseURL + "/Auth/authRegis",
			type: "POST",
			data: {
				name: name,
				no_telp: no_telp,
				email: email,
				user: user,
				pass: pass,
			},
			dataType: "json",
			success: function (data) {
				if (data.status == true) {
					Swal.fire({
						icon: "success",
						title: "Daftar Berhasil!",
						showConfirmButton: false,
						timer: 1500,
					}).then((result) => {
						window.location.href = baseURL + "/Auth";
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
