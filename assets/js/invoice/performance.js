const vue = new Vue({
  el: "#app",
  data() {
    return {
      tabPerformance: [],
    };
  },
  mounted() {
    this.getPerformance();
    this.desplaysDiagram();
  },
  computed: {
    getFullname() {
      return this.tabPerformance.map((element) => element.Fullname);
    },
    getPourcentage() {
      return this.tabPerformance.map((element) => element.Pourcentage);
    },
  },
  methods: {
    getPerformance() {
      $.ajax({
        type: "GET",
        url: "/performance/get",
        success: this.getPerformanceResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    getPerformanceResult(response) {
      if (response.error)
        Swal.fire("Erreur de recuperation de donnees", error, "error");
      else if (response.login) document.location.assign("/login");
      else if (response.auth)
        Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else {
        this.tabPerformance = response;
        console.log(response);
        this.desplaysDiagram();
      }
    },
    desplaysDiagram() {
      var barChartData = {
        labels: this.getFullname,
        datasets: [
          {
            label: "Pourcentage",
            backgroundColor: "rgba(0, 158, 251, 0.5)",
            borderColor: "rgba(0, 158, 251, 1)",
            borderWidth: 1,
            data: this.getPourcentage,
          },
        ],
      };

      var ctx = document.getElementById("performance").getContext("2d");
      window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData,
        options: {
          responsive: true,
          legend: {
            display: true,
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  suggestedMin: 0,
                  suggestedMax: 100,
                  stepSize: 20
                },
              },
            ],
          },
        },
      });
    },
  },
});
