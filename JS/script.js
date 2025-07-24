    const unifiedColors = ['#4CAF50', '#2196F3', '#FF9800'];

    function drawChart(id, dataValues) {

    
    
    const ctx = document.getElementById(id).getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['1回目', '2回目', '3回目'],
        datasets: [{
          data: dataValues,
          backgroundColor: unifiedColors,
          borderRadius: 6
        }]
      },
      options: {
        indexAxis: 'y',
        scales: {
          x: {
            min: 0,
            max: 100,
            display: false
          },
          y: {
            ticks: { font: { size: 17 } }
          }
        },
        plugins: {
          legend: { display: false },
          tooltip: { enabled: true }
        },
        responsive: true,
        maintainAspectRatio: false
      }
    });
    }

    // グラフ描画
    drawChart('chart1', [80,90,70]);
    drawChart('chart2', [80,90,70]);
    drawChart('chart3', [80,90,70]);



