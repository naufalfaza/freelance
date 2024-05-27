import { baseURL } from "./url.js";

$(document).ready(function () {
	$.ajax({
		url: baseURL + "/User/getJmlKeranjang",
		success: function (data) {
			data = JSON.parse(data);
			$("#jmlKeranjang").html(data.jumlah);
			$("#jmlKeranjang2").html("Jumlah : " + data.jumlah);
			$("#jmlKeranjang3").html("Jumlah Pesanan : " + data.jumlah);
		},
	});

	$.ajax({
		url: baseURL + "/User/getTotalKeranjang",
		success: function (data) {
			data = JSON.parse(data);
			$("#totalKeranjang").html("Total : <b>Rp. " + data.total + "</b>");
			$("#totalKeranjang2").html(
				"Total Pembayaran : <b>Rp. " + data.total + "</b>"
			);
			$("#totalll").val(data.total);
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

	$("#metodeTransfer").hide();
	$("#metodeQris").hide();
	$("#metode").on("change", function () {
		if ($("#metode").val() == "transfer") {
			$("#metodeTransfer").show();
			$("#metodeQris").hide();
		} else {
			$("#metodeQris").show();
			$("#metodeTransfer").hide();
		}
	});

	$("#bank").on("change", function () {
		$.ajax({
			url: baseURL + "/User/getRekening",
			type: "post",
			data: {
				bank: $("#bank").val(),
			},
			success: function (data) {
				data = JSON.parse(data);
				$("#no_rekening").val(data.rekening);
			},
		});
	});

	$("#inputTransaksi").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: baseURL + "/User/inputTransaksi",
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
