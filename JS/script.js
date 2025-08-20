let chartInstances = {};

function drawChart(id, dataValues) {
    if (chartInstances[id]) {
        chartInstances[id].destroy();
    }
    const ctx = document.getElementById(id).getContext('2d');
    chartInstances[id] = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['最新', '2回目', '3回目'],
            datasets: [{
                label: '正答率',
                data: dataValues,
                backgroundColor: ['#4CAF50', '#2196F3', '#FF9800'],
                borderRadius: 8
            }]
        },
        options: {
            indexAxis: 'y', // 横棒グラフにする
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    min: 0,
                    max: 100,
                    ticks: { stepSize: 20, callback: v => v + '%' }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// グラフ描画
drawChart('chart1', itRates);
drawChart('chart2', enRates);
drawChart('chart3', csRates);



