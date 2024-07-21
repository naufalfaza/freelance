import { baseURL } from "./url.js";

$(document).ready(function () {
	// $.ajax({
	// 	url: baseURL + "/User/getJmlKeranjang",
	// 	success: function (data) {
	// 		data = JSON.parse(data);
	// 		$("#jmlKeranjang").html(data.jumlah);
	// 	},
	// });

	$("#tableBarang").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 3, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/Admin/getDataBarang",
	});

	$("#tambahBarang").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: baseURL + "/Admin/inputDataBarang",
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
					});
				}
			},
		});
	});
});
