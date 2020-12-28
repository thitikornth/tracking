

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
        labels: 
         ["วิทยาศาสตร์", "วิศวกรรมศาสตร์และเทคโนโลยี", "เทคโนโลยีการเกษตร", "สารสนเทศศาสตร์", "การจัดการ", "ศิลปศาสตร์", "สถาปัตยกรรมศาสตร์และการออกแบบ", "รัฐศาสตร์และนิติศาสตร์", "วิทยาลัยนานาชาติ", "พหุภาษาและการศึกษาทั่วไป", "สหเวชศาสตร์", "แพทยศาสตร์", "	เภสัชศาสตร์", "สาธารณสุขศาสตร์", "พยาบาลศาสตร์", "วิทยาลัยทันตแพทยศาสตร์นานาชาติ", "วิทยาลัยสัตวแพทยศาสตร์อัครราชกุมารี"],
    datasets: [{
      data: [55, 30, 15, 20],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc' , '#858796', '#e74a3b', '#f6c23e'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
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
      displayColors: true,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 50,
  },
});
