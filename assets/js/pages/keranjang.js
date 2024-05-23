import { baseURL } from "./url.js";

$(document).ready(function () {
	$.ajax({
		url: baseURL + "/User/getJmlKeranjang",
		success: function (data) {
			data = JSON.parse(data);
			$("#jmlKeranjang").html(data.jumlah);
			$("#jmlKeranjang2").html("Jumlah : " + data.jumlah);
		},
	});

	$.ajax({
		url: baseURL + "/User/getTotalKeranjang",
		success: function (data) {
			data = JSON.parse(data);
			$("#totalKeranjang").html("Total : Rp. " + data.total);
		},
	});

	$("#tableKeranjang").DataTable({
		processing: true,
		columnDefs: [{ className: "dt-center", targets: "_all" }],
		fixedHeader: {
			header: true,
			footer: true,
		},
		ajax: baseURL + "/User/getKeranjang",
	});
});
