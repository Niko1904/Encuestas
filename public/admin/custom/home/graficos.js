$(function () {
    myUrl = $("#myurl").val();
    //console.log("url de ajax " + myUrl );
    //myUrl = "http://localhost:8000/admin/home/estadsticas";
    $.get(myUrl, function (data) {
        //console.log("metodo estadisticas en IndexController" + JSON.stringify(data ));
        //console.log("metodo estadisticas en IndexController" + data );  

        for (i = 0; i < data.length; i++) {
            processed_json.push([data[i].key, data[i].value]);
        }

        var ele_array = [];
        var ele_json = {};
        data.total_encuestas_por_categoria.forEach((element, index) => {
            ele_array[index] = {
                "name": element.name,
                "y": element.tot_enc,
                "drilldown": null
            };
        });
        
        
        console.log("datos en json" + JSON.stringify(ele_array) );
        ele_array.push({
            "name": "total de encuestas",
            "y": data.total,
            "drilldown": null
        });
        var myDataAjax = ele_array;       

        // Create the chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: "Cantidad de encuestas poor categoria"
            },
            subtitle: {
                text: '*-*'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total encuestas'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                        /* format: '{point.y:.1f}%' */
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
                {
                    "name": "Browsers",
                    "colorByPoint": true,
                    
                    "data": myDataAjax
                }
            ]
        });
       
        
        $("body")
            .append("Name: " + data.name) // John
            .append("Time: " + data.time); //  2pm
    }, "json");
    
});
    