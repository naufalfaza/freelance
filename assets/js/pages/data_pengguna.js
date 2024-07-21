import { baseURL } from "./url.js";

$(document).ready(function () {
	// $.ajax({
	// 	url: baseURL + "/User/getJmlKeranjang",
	// 	success: function (data) {
	// 		data = JSON.parse(data);
	// 		$("#jmlKeranjang").html(data.jumlah);
	// 	},
	// });

	$("#tablePengguna").DataTable({
		processing: true,
		autoWidth: false,
		columnDefs: [{ className: "dt-center", targets: [0, 1, 3, 4, 5] }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/Admin/getDataPengguna",
	});
});
