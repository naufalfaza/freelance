import { baseURL } from "./url.js";

$(document).ready(function () {
	var id_user = $("#id_user").val();
	if (id_user != null) {
		$.ajax({
			url: baseURL + "/User/getAkun",
			type: "post",
			data: {
				id_user: id_user,
			},
			success: function (data) {
				data = JSON.parse(data);
				$("#nama").val(data.nama);
				$("#no_telp").val(data.no_telp);
				$("#email").val(data.email);
			},
		});
	}

	$.ajax({
		url: baseURL + "/User/getJmlKeranjang",
		success: function (data) {
			data = JSON.parse(data);
			$("#jmlKeranjang").html(data.jumlah);
		},
	});

	$("#qty").on("keyup", function () {
		var qty = this.value;
		var id_ukuran = $("#ukuran_foto").val();
		$.ajax({
			url: baseURL + "/User/getTotal",
			type: "post",
			data: {
				qty: qty,
				id_ukuran: id_ukuran,
			},
			success: function (data) {
				data = JSON.parse(data);
				$("#total").val(data.total);
				$("#totall").val(data.totall);
			},
		});
	});

	$("#cetakFoto").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: baseURL + "/User/inputCetakFoto",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function (data) {
				data = JSON.parse(data);
				if (data.status == true) {
					Swal.fire({
						icon: "success",
						title: "Berhasil!",
						showConfirmButton: false,
						timer: 1500,
					}).then((result) => {
						location.reload();
					});
				} else {
					Swal.fire({
						icon: "error",
						title: data.message,
						showConfirmButton: false,
						timer: 2000,
					}).then((result) => {
						// location.reload();
					});
				}
			},
		});
	});
});
