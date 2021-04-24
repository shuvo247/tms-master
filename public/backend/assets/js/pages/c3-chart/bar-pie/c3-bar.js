/*************************************************************************************/
// -->Template Name: Ideia Admin
// -->Author: Belostemas
// -->Email: belostemas@gmail.com
// -->File: c3_chart_JS
/*************************************************************************************/
$(function() {
    var t = c3.generate({
        bindto: "#bar-chart",
        size: { height: 400 },
        color: { pattern: ["#4fc3f7"] },
        data: {
            columns: [
                ["option1", 350, 80, 250, 400, 190, 250]
            ],
            type: "bar"
        },
        axis: { rotated: !0 },
        grid: { y: { show: !0 } }
    });
});