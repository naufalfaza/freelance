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
		columnDefs: [{ className: "dt-center", targets: [0, 1, 3, 4, 5] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getTransaksiProses",
	});

	$("#tableSelesai").DataTable({
		processing: true,
		columnDefs: [{ className: "dt-center", targets: "_all" }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getTransaksiSelesai",
	});

	$("#tableBatal").DataTable({
		processing: true,
		columnDefs: [{ className: "dt-center", targets: "_all" }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getTransaksiBatal",
	});
});
