import { baseURL } from "./url.js";

$(document).ready(function () {
	$("#tableKeranjang").DataTable({
		columnDefs: [{ className: "dt-center", targets: "_all" }],
		ajax: baseURL + "/User/getKeranjang",
	});
});
