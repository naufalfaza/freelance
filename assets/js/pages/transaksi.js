import { baseURL } from "./url.js";

$(document).ready(function () {
	$("#tableTransaksiCetak").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 4, 5, 6] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		// ajax: baseURL + "/Admin/getDataPengguna",
	});
});
