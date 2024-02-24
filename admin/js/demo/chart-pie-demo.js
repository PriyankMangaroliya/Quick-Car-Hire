    $(document).ready(function() {
    // Fetch revenue data using Ajax and populate the chart
    $.ajax({
        url: './ajax/fetchRevenueData.php', // Correct path to PHP script
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Verify if data is received
            console.log(data);

            var ctx = document.getElementById("myPieChart").getContext("2d");

            // Create the chart
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.revenue,
                        backgroundColor: data.backgroundColor,
                        hoverBackgroundColor: data.hoverBackgroundColor,
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        },
    });
});