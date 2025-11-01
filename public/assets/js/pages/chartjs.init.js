!(function (d) {
    "use strict";
    function r() {}
    (r.prototype.respChart = function (r, o, e, a) {
        (Chart.defaults.global.defaultFontColor = "#adb5bd"),
            (Chart.defaults.scale.gridLines.color = "rgba(108, 120, 151, 0.1)");
        var t = r.get(0).getContext("2d"),
            n = d(r).parent();
        function i() {
            r.attr("width", d(n).width());
            switch (o) {
                case "Line":
                    new Chart(t, { type: "line", data: e, options: a });
                    break;
                case "Doughnut":
                    new Chart(t, { type: "doughnut", data: e, options: a });
                    break;
                case "Pie":
                    new Chart(t, { type: "pie", data: e, options: a });
                    break;
                case "Bar":
                    new Chart(t, { type: "bar", data: e, options: a });
                    break;
                case "Radar":
                    new Chart(t, { type: "radar", data: e, options: a });
                    break;
                case "PolarArea":
                    new Chart(t, { data: e, type: "polarArea", options: a });
            }
        }
        d(window).resize(i), i();
    }),
        (r.prototype.init = function () {
            // جلب البيانات من عناصر HTML (Blade)
            var months = JSON.parse(
                document.getElementById("months-data")?.textContent || "[]"
            );
            var activeData = JSON.parse(
                document.getElementById("active-data")?.textContent || "[]"
            );
            var inactiveData = JSON.parse(
                document.getElementById("inactive-data")?.textContent || "[]"
            );

            // رسم الخط البياني الأساسي (العملاء النشطين / غير النشطين)
            this.respChart(
                d("#lineChart"),
                "Line",
                {
                    labels: months.length
                        ? months
                        : [
                              "يناير",
                              "فبراير",
                              "مارس",
                              "ابريل",
                              "مايو",
                              "يونيو",
                              "يوليو",
                              "اغسطس",
                              "سبتمبر",
                              "اكتوبر",
                              "نوفمبر",
                              "ديسمبر",
                          ],
                    datasets: [
                        {
                            label: "عملاء نشطين",
                            fill: !0,
                            lineTension: 0.5,
                            backgroundColor: "rgba(60, 76, 207, 0.2)",
                            borderColor: "#3c4ccf",
                            pointBorderColor: "#3c4ccf",
                            pointBackgroundColor: "#fff",
                            pointHoverBackgroundColor: "#3c4ccf",
                            pointHoverBorderColor: "#fff",
                            data: activeData.length
                                ? activeData
                                : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        },
                        {
                            label: "عملاء غير نشطين",
                            fill: !0,
                            lineTension: 0.5,
                            backgroundColor: "rgba(235, 239, 242, 0.2)",
                            borderColor: "#ebeff2",
                            pointBorderColor: "#ebeff2",
                            pointBackgroundColor: "#fff",
                            pointHoverBackgroundColor: "#ebeff2",
                            pointHoverBorderColor: "#fff",
                            data: inactiveData.length
                                ? inactiveData
                                : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        },
                    ],
                },
                {
                    scales: {
                        yAxes: [
                            {
                                ticks: { beginAtZero: true, stepSize: 5 },
                            },
                        ],
                    },
                }
            );

            // باقي الرسومات زي ما هي (لو محتاجها)
            this.respChart(d("#doughnut"), "Doughnut", {
                labels: ["Desktops", "Tablets"],
                datasets: [
                    {
                        data: [300, 210],
                        backgroundColor: ["#3c4ccf", "#ebeff2"],
                        hoverBackgroundColor: ["#3c4ccf", "#ebeff2"],
                        hoverBorderColor: "#fff",
                    },
                ],
            }),
                this.respChart(d("#pie"), "Pie", {
                    labels: ["Desktops", "Tablets"],
                    datasets: [
                        {
                            data: [300, 180],
                            backgroundColor: ["#02a499", "#ebeff2"],
                            hoverBackgroundColor: ["#02a499", "#ebeff2"],
                            hoverBorderColor: "#fff",
                        },
                    ],
                });
        }),
        (d.ChartJs = new r()),
        (d.ChartJs.Constructor = r);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.ChartJs.init();
    })();
