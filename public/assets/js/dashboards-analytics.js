/**
 * Dashboard Analytics
 */

'use strict';

(async function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Document Report - Bar Chart

  async function getDocumentReports(department = null){
    let reports = {
      categories: [],
      series: [],
      total: 0,
    }
    // Send form data via AJAX
    const url = department ? `/api/document/report?department=${department}` : '/api/document/report'
    await fetch(url, {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        if(data.code === 200){
          reports['categories'] = data.data['incomplete'].map(item => item.code);
          reports['series'] = [
            {
              name: "Complete",
              data:  data.data['complete'] && data.data['complete'].length>0 ? data.data['complete'].map(item => item.total) : [0]
              // data:  data.data['complete'] && data.data['complete'].length>0 ? data.data['complete'].map(item => item.completed_count) : [0]
            },
            {
              name: "incomplete",
              data:   data.data['complete'] && data.data['incomplete'].length>0 ? data.data['incomplete'].map(item => -item.total) : [0]
              // data:   data.data['complete'] && data.data['incomplete'].length>0 ? data.data['incomplete'].map(item => -item.incomplete_count) : [0]
            },
          ]
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        // Handle error, e.g., show error message
    });

    return reports
  }
  // --------------------------------------------------------------------
  const {categories: docLabels,  series: docSeries,} = await getDocumentReports()
  let btnDeptDropdown = document.getElementById('growthReportId')
  const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
    totalRevenueChartOptions = {
      series: docSeries,
      chart: {
        height: 300,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth:'20%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.danger],
      dataLabels: {
        enabled: true
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 10,
          bottom: -2,
          left: 10,
          right: 20
        }
      },
      xaxis: {
        categories: docLabels,
        title: {
          text: 'Department Course'
          },
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        title: {
          text: 'Number of Students'},
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  // if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
  //   const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
  //   totalRevenueChart.render();

    
  //   var elements = document.getElementsByClassName('department-input');

  //   // Loop through the elements and attach the event listener to each one
  //   for (var i = 0; i < elements.length; i++) {
  //       elements[i].addEventListener('click', async function(event) {
  //           // Your event handling code here
  //           const dept = event.target.dataset.id
  //           const {categories: docLabels,  series: docSeries,} = await getDocumentReports(dept)
  //           console.log('data',docLabels , docSeries)
  //           totalRevenueChart.updateSeries(docSeries);
  //           let value = event.target.dataset.value
  //           let btnDeptDropdown = document.getElementById('deptDropdownId')
  //           btnDeptDropdown.textContent  = value;
  //       });
  //   }
  // }

  // UPDATED DOCUMENT REPORTS CHART
  if (typeof totalRevenueChartEl !== 'undefined' && totalRevenueChartEl !== null) {
    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
    totalRevenueChart.render();

    var elements = document.getElementsByClassName('department-input');

    // Loop through the elements and attach the event listener to each one
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', async function(event) {
            const dept = event.target.dataset.id;
            const { categories: docLabels, series: docSeries } = await getDocumentReports(dept);
            console.log('data', docLabels, docSeries);

            // Ensure that docSeries is structured correctly
            if (Array.isArray(docSeries) && docSeries.length > 0) {
                totalRevenueChart.updateSeries(docSeries);
            } else {
                console.error('Invalid series data:', docSeries);
            }

            // Update the dropdown button text
            let value = event.target.dataset.value;
            let btnDeptDropdown = document.getElementById('deptDropdownId');
            btnDeptDropdown.textContent = value;

            // Update tooltip to reflect the correct course names
            totalRevenueChart.updateOptions({
                tooltip: {
                    shared: true,
                    intersect: false,
                    formatter: function(seriesName, value, { seriesIndex, dataPointIndex }) {
                        // Ensure that dataPointIndex is within bounds
                        if (dataPointIndex < docLabels.length) {
                            const courseName = docLabels[dataPointIndex]; // Get the course name based on the index
                            return `${courseName}: ${value}`; // Display course name with value
                        }
                        return `${seriesName}: ${value}`; // Fallback if index is out of bounds
                    }
                },
                xaxis: {
                    categories: docLabels // Ensure x-axis categories are updated
                }
            });
        });
    }
  }

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector('#growthChart'),
    growthChartOptions = {
      series: [78],
      labels: ['Growth'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '15px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // Profit Report Line Chart
  // --------------------------------------------------------------------
  const profileReportChartEl = document.querySelector('#profileReportChart'),
    profileReportChartConfig = {
      chart: {
        height: 80,
        // width: 175,
        type: 'line',
        toolbar: {
          show: false
        },
        dropShadow: {
          enabled: true,
          top: 10,
          left: 5,
          blur: 3,
          color: config.colors.warning,
          opacity: 0.15
        },
        sparkline: {
          enabled: true
        }
      },
      grid: {
        show: false,
        padding: {
          right: 8
        }
      },
      colors: [config.colors.warning],
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 5,
        curve: 'smooth'
      },
      series: [
        {
          data: [110, 270, 145, 245, 205, 285]
        }
      ],
      xaxis: {
        show: false,
        lines: {
          show: false
        },
        labels: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        show: false
      }
    };
  if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
    const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
    profileReportChart.render();
  }

  // student report chart
  async function getStudentDeptReports(){
    let reports = {
      labels: [],
      series: [],
      total: 0,
      colors:[],
    }
    // Send form data via AJAX
    await fetch('/api/student/department-report', {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        if(data.code === 200){
          console.log('hey', data)
          reports['labels'] = data.data['departments'].map(item => item.code);
          reports['series'] = data.data['departments'].map(item => item.student_percentage);
          reports['total'] = data.data['total'];
          reports['colors'] = data.data['departments'].map(item => item.color); // Extract colors
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        // Handle error, e.g., show error message
    });

    return reports;
  }
  // STUDENTS REPORT CHART
  // --------------------------------------------------------------------
  
  const {labels, series, total} = await getStudentDeptReports()
  const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
    orderChartConfig = {
      chart: {
        height: 200,
        width: 200,
        type: 'donut'
      },
      labels: labels,
      series: series,
      stroke: {
        width: 5,
        colors: [cardColor]
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      states: {
        hover: {
          filter: { type: 'none' }
        },
        active: {
          filter: { type: 'none' }
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '0.8125rem',
                color: axisColor,
                label: 'Total Students',
                formatter: function (w) {
                  return total;
                }
              }
            }
          }
        }
      }
    };
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
    statisticsChart.render();
  }

  //updtd STUDENT REPORT DONUT CHART
  // async function getStudentDeptReports() {
  //   let reports = {
  //       labels: [],
  //       series: [],
  //       total: 0,
  //       colors: [],
  //   };

  //   // Predefined set of default colors
  //   const defaultColors = ['#00E396', '#008FFB', '#FF4560', '#775DD0', '#FEB019', '#CCCCCC']; // Add more colors as needed

  //   // Send form data via AJAX
  //   await fetch('/api/student/department-report', {
  //       method: 'GET',
  //   })
  //   .then(response => {
  //       if (!response.ok) {
  //           throw new Error('Network response was not ok');
  //       }
  //       return response.json(); // Convert response to JSON
  //   })
  //   .then(data => {
  //       console.log('Fetched data:', data); // Log the fetched data for debugging
  //       if (data.code === 200) {
  //           const departments = data.data.departments;

  //           // Check if departments is an array
  //           if (Array.isArray(departments)) {
  //               reports.labels = departments.map(item => item.code);
  //               reports.series = departments.map(item => item.student_percentage);
  //               reports.total = data.data.total;

  //               // Extract colors and handle undefined values
  //               reports.colors = departments.map((item, index) => {
  //                   if (item.color) {
  //                       return item.color; // Return color if defined
  //                   } else {
  //                       console.warn('Color is undefined for department:', item);
  //                       return defaultColors[index % defaultColors.length]; // Use a default color from the array
  //                   }
  //               });
  //           } else {
  //               console.error('Departments is not an array:', departments);
  //           }
  //       } else {
  //           console.error('Unexpected response code:', data.code);
  //       }
  //   })
  //   .catch(error => {
  //       console.error('There was a problem with the fetch operation:', error);
  //       // Handle error, e.g., show error message
  //   });

  //   return reports;
  // }

  // async function renderDonutChart() {
  //   const { labels, series, total, colors } = await getStudentDeptReports();
  //   console.log({ labels, series, total, colors }); // Debugging output

  //   // Check for empty arrays
  //   if (labels.length === 0 || series.length === 0) {
  //       console.error('One or more required arrays are empty:', { labels, series });
  //       return; // Exit the function if any array is empty
  //   }

  //   // Check for undefined values in series and labels
  //   series.forEach((value, index) => {
  //       if (value === undefined) {
  //           console.error(`Series value at index ${index} is undefined`);
  //       }
  //   });

  //   labels.forEach((label, index) => {
  //       if (label === undefined) {
  //           console.error(`Label at index ${index} is undefined`);
  //       }
  //   });

  //   // No need to check for undefined colors since we handle it in getStudentDeptReports
  //   colors.forEach((color, index) => {
  //       if (color === undefined) {
  //           console.error(`Color at index ${index} is undefined`);
  //       }
  //   });

  //   const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
  //       orderChartConfig = {
  //           chart: {
  //               height: 250,
  //               width: 300,
  //               type: 'donut'
  //           },
  //           labels: labels,
  //           series: series,
  //           stroke: {
  //               width: 2,
  //               colors: ['#fff'] // Color for the stroke around the donut
  //           },
  //           colors: colors, // Use the extracted colors for the donut segments
  //           dataLabels: {
  //               enabled: false,
  //               formatter: function (val, opt) {
  //                   return parseInt(val) + '%';
  //               }
  //           },
  //           legend: {
  //               show: true,
  //               position: 'bottom',
  //               horizontalAlign: '',
  //               floating: false,
  //               labels: {
  //                   colors: undefined,
  //                   useSeriesColors: true
  //               }
  //           },
  //           grid: {
  //               padding: {
  //                   top: 0,
  //                   bottom: 0,
  //                   right: 15
  //               }
  //           },
  //           states: {
  //               hover: {
  //                   filter: { type: 'none' }
  //               },
  //               active: {
  //                   filter: { type: 'none' }
  //               }
  //           },
  //           plotOptions: {
  //               pie: {
  //                   donut: {
  //                       size: '75%',
  //                       labels: {
  //                           show: true,
  //                           value: {
  //                               fontSize: '1.5rem',
  //                               // fontFamily: 'Public Sans',
  //                               color: '#697a8d',
  //                               offsetY: -15,
  //                               formatter: function (val) {
  //                                   return parseInt(val) + '%';
  //                               }
  //                           },
  //                           name: {
  //                               offsetY: 20,
  //                               // fontFamily: 'Public Sans'
  //                           },
  //                           total: {
  //                               show: true,
  //                               fontSize: '0.9375rem',
  //                               color: '#697a8d',
  //                               label: 'Total Students',
  //                               formatter: function (w) {
  //                                   return total; // Display total number of students
  //                               }
  //                           }
  //                       }
  //                   }
  //               }
  //           }
  //       };

  //   if (chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
  //       const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
  //       statisticsChart.render();
  //   }
  // }

// Call the renderDonutChart function to execute 
renderDonutChart();

  //  ENROLLMENT REPORT   AREA CHART
  // --------------------------------------------------------------------

  async function getEnrollmentReports(schoolYear = null){
    var semester_inputs = document.getElementsByClassName('semester-input');
    for (var i = 0; i < semester_inputs.length; i++) {
      semester_inputs[i].innerHTML = '0'
    }
    let reports = {
      series: [],
      categories: [],
      total: 0,
      totalSemesterEnrollees: []
    }
    // Send form data via AJAX
    const url = schoolYear ? `/api/enrollment/report?schoolYear=${schoolYear}` : '/api/enrollment/report'
    await fetch(url, {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        if(data.code === 200){
          console.log('hey', data)
          reports['series'] = {
            name: "Enrollee",
            data: [0, ...data.data['departmentEnrolles'].map(item => item.enrollments_count), 0]
           };

          reports['categories'] = data.data['departmentEnrolles'].map(item => item.code);
          reports['total'] = data.data['totalEnrollees'];
          reports['totalSemesterEnrollees'] = data.data['totalSemesterEnrollees']
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        // Handle error, e.g., show error message
    });

    return reports
  }


  const {series : erolleeSeries, categories, total: totalEnrollee, totalSemesterEnrollees} = await getEnrollmentReports()

    let total_enrollee = document.getElementById('total_enrollee');
    total_enrollee.innerHTML = totalEnrollee;
    totalSemesterEnrollees.forEach(semEnrollee => {
      const semElement =   document.getElementById(`sem_input_${semEnrollee.semester}`)
      semElement.innerHTML = semEnrollee.total
    });
    // ENROLLMENT REPORTS
    const incomeChartEl = document.querySelector('#incomeChart'),
    incomeChartConfig = {
      series: [erolleeSeries],
      chart: {
        height: 215,
        parentHeightOffset: 0,
        parentWidthOffset: 0,
        toolbar: {
          show: false
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      legend: {
        show: false
      },
      markers: {
        size: 6,
        colors: 'transparent',
        strokeColors: 'transparent',
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 7,
            strokeColor: config.colors.primary,
            strokeWidth: 2,
            size: 6,
            radius: 8
          }
        ],
        hover: {
          size: 7
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100]
        }
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -5,
          left: -10,
          right: 8
        }
      },
      xaxis: {
        title: {
          text: 'College Departments',
          style: {
              fontSize: '14px',
              fontWeight: 'regular',
              color: '#000'
          },
        },
        categories: ['', ...categories, ''],
        
        axisBorder: {
          show: true
        },
        axisTicks: {
          show: true
        },
        labels: {
          show: true,
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      yaxis: {
        title: {
          text: 'Number of Enrollees',
          style: {
              fontSize: '14px',
              fontWeight: 'regular',
              color: '#000'
          },
        },
        labels: {
          show: true
        },
      }
    };
    if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
      console.log('heyyy')
      const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
      incomeChart.render();

      
      var elements = document.getElementsByClassName('sy_options');

      // Loop through the elements and attach the event listener to each one
      for (var i = 0; i < elements.length; i++) {
          elements[i].addEventListener('click', async function(event) {
              // Your event handling code here
              const schoolYear = event.target.dataset.id
              const {series : erolleeSeries, categories, total: totalEnrollee, totalSemesterEnrollees} = await getEnrollmentReports(schoolYear)

              let total_enrollee = document.getElementById('total_enrollee');
              total_enrollee.innerHTML = totalEnrollee;
              totalSemesterEnrollees.forEach(semEnrollee => {
                const semElement =   document.getElementById(`sem_input_${semEnrollee.semester}`)
                semElement.innerHTML = semEnrollee.total
              });

              const value = event.target.dataset.value
              let btnSYDropdown = document.getElementById('syDropdownId')
              btnSYDropdown.textContent  = value;

              incomeChart.updateOptions({
                series: [erolleeSeries],
                xaxis: {
                  categories: ['', ...categories, ''],
                }
              });
          });
      }
    }
  
  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: '8',
          hollow: {
            margin: 2,
            size: '45%'
          },
          track: {
            strokeWidth: '50%',
            background: borderColor
          },
          dataLabels: {
            show: true,
            name: {
              show: false
            },
            value: {
              formatter: function (val) {
                return '$' + parseInt(val);
              },
              offsetY: 5,
              color: '#697a8d',
              fontSize: '13px',
              show: true
            }
          }
        }
      },
      fill: {
        type: 'solid',
        colors: config.colors.primary
      },
      stroke: {
        lineCap: 'round'
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
    weeklyExpenses.render();
  }
})();
