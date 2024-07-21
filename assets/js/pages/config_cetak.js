import { baseURL } from "./url.js";

$(document).ready(function () {
	$("#tableUkuran").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 2, 3] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		// ajax: baseURL + "/Admin/getDataPengguna",
	});
});
