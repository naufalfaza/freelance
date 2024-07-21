import { baseURL } from "./url.js";

$(document).ready(function () {
	$("#tableProses").DataTable({
		processing: true,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/Admin/getTransaksiProsesAll",
	});

	$("#tableSelesai").DataTable({
		processing: true,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/Admin/getTransaksiSelesaiAll",
	});

	$("#tableBatal").DataTable({
		processing: true,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/Admin/getTransaksiBatalAll",
	});
});
