$(document).ready(function () {
  $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
    var target = $(e.target).attr("href");
    $(".tab-pane").removeClass("active");
    $(target).addClass("active");
  });

  var ctxTotalKunjungan = document
    .getElementById("totalKunjunganChart")
    .getContext("2d");
  var totalKunjunganChart = new Chart(ctxTotalKunjungan, {
    type: "pie",
    data: {
      labels: ["Keluar", "Masuk", "Aktif"],
      datasets: [
        {
          data: [905, 340, 61],
          backgroundColor: ["#28a745", "#ffc107", "#dc3545"],
        },
      ],
    },
  });

  var ctxKunjunganLimaBulan = document
    .getElementById("kunjunganLimaBulanChart")
    .getContext("2d");
  var kunjunganLimaBulanChart = new Chart(ctxKunjunganLimaBulan, {
    type: "line",
    data: {
      labels: ["January", "February", "March", "April", "May"],
      datasets: [
        {
          label: "Keluar",
          data: [300, 400, 300, 500, 600],
          borderColor: "#28a745",
          fill: false,
        },
        {
          label: "Masuk",
          data: [200, 300, 400, 300, 200],
          borderColor: "#ffc107",
          fill: false,
        },
        {
          label: "Aktif",
          data: [50, 100, 150, 100, 50],
          borderColor: "#dc3545",
          fill: false,
        },
      ],
    },
  });

  var ctxKunjunganGender = document
    .getElementById("kunjunganGenderChart")
    .getContext("2d");
  var kunjunganGenderChart = new Chart(ctxKunjunganGender, {
    type: "bar",
    data: {
      labels: ["Laki-laki", "Perempuan"],
      datasets: [
        {
          data: [100, 75],
          backgroundColor: ["#ffc107", "#28a745"],
        },
      ],
    },
  });

  var ctxKunjunganUsia = document
    .getElementById("kunjunganUsiaChart")
    .getContext("2d");
  var kunjunganUsiaChart = new Chart(ctxKunjunganUsia, {
    type: "bar",
    data: {
      labels: ["Anak-anak", "Dewasa", "Lansia"],
      datasets: [
        {
          data: [30, 50, 20],
          backgroundColor: ["#dc3545", "#ffc107", "#28a745"],
        },
      ],
    },
  });
});
