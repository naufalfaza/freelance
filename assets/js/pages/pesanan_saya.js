import { baseURL } from "./url.js";

$(document).ready(function () {
	$.ajax({
		url: baseURL + "/User/getJmlKeranjang",
		success: function (data) {
			data = JSON.parse(data);
			$("#jmlKeranjang").html(data.jumlah);
		},
	});

	$("#tableProses").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getTransaksiProses",
	});

	$("#tableSelesai").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getTransaksiSelesai",
	});

	$("#tableBatal").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getTransaksiBatal",
	});
});
