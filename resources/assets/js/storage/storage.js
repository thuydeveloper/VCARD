document.addEventListener("turbo:load", function () {
    loadDashboardData();
});

function loadDashboardData() {
var chartDataElement = document.getElementById("storagePieChart");
if (!chartDataElement) return;
var storageChartData = JSON.parse(chartDataElement.getAttribute("data-chart-data"));
var storageChartLabels = JSON.parse(chartDataElement.getAttribute("data-chart-labels"));
storageChart(storageChartData, storageChartLabels);
}

window.statisticsColors = ["#6571FF", "#C1C6FF"];

function storageChart(data, labels) {
// Check if the element exists before accessing it
let pieChartElement = document.getElementById("storagePieChart");
if (!pieChartElement) return; // Exit if the element doesn't exist
let ctx = pieChartElement.getContext("2d");
new Chart(ctx, {
  type: "pie",
  options: {
      responsive: true,
      maintainAspectRatio: false,
      responsiveAnimationDuration: 500,
      plugins: {
          tooltip: {
              callbacks: {
                  label: function (context) {
                     let label = labels[context.dataIndex] || '';
                     let value = Math.round(context.parsed) + "%";
                     return label + " " + value;
                  },
              },
          },
      },
  },
  data: {
      datasets: [
          {
              data: data,
              backgroundColor: window.statisticsColors, // corrected variable name
          },
      ],
  },
});
}
