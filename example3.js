var labelType, useGradients, nativeTextSupport, animate;

(function () {
    var ua = navigator.userAgent,
        iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
        typeOfCanvas = typeof HTMLCanvasElement,
        nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
        textSupport = nativeCanvasSupport && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
    //I'm setting this based on the fact that ExCanvas provides text support for IE
    //and that as of today iPhone/iPad current text support is lame
    labelType = (!nativeCanvasSupport || (textSupport && !iStuff)) ? 'Native' : 'HTML';
    nativeTextSupport = labelType == 'Native';
    useGradients = nativeCanvasSupport;
    animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
    elem: false,
    write: function (text) {
        if (!this.elem) this.elem = document.getElementById('log');
        this.elem.innerHTML = text;
        this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
    }
};

var json;
var json2;
var mydata;

function init() {
    //init data

    $.ajax({
        url: 'ajax/_categ.php',
        type: 'GET',
        dataType: 'jsonp',
        dataCharset: 'jsonp',
        success: function (data) {
            var json = eval(data[0]);
            /*
            //init BarChart
            var barChart = new $jit.AreaChart({  
  //id of the visualization container  
  injectInto: 'infovis',  
  //add animations  
  animate: true,  
  //separation offsets  
  Margin: {  
    top: 5,  
    left: 5,  
    right: 5,  
    bottom: 5  
  },  
  labelOffset: 10,  
  //whether to display sums  
  showAggregates: true,  
  //whether to display labels at all  
  showLabels: true,  
  //could also be 'stacked'  
 type:'stacked', 
  //label styling  
  Label: {  
    type: labelType, //can be 'Native' or 'HTML'  
    size: 13,  
    family: 'Arial',  
    color: 'white'  
  },  
  //enable tips  
  Tips: {  
    enable: true,  
    onShow: function(tip, elem) {  
      tip.innerHTML = "<b>" + elem.name + "</b>: " + elem.value;  
    }  
  },  
  //add left and right click handlers  
  filterOnClick: true,  
  restoreOnRightClick:true  
});  
            barChart.loadJSON(json);
            */
            
            var barChart = new $jit.BarChart({
                //id of the visualization container
                injectInto: 'infovis',
                //whether to add animations
                animate: true,
                //horizontal or vertical barcharts
                orientation: 'vertical',
                //bars separation
                barsOffset: 20,
                //visualization offset
                Margin: {
                    top: 5,
                    left: 5,
                    right: 5,
                    bottom: 5
                },
                //labels offset position
                labelOffset: 5,
                //bars style
               type:'stacked', 
                //whether to show the aggregation of the values
                showAggregates: true,
                //whether to show the labels for the bars
                showLabels: true,
                //labels style
                Label: {
                    type: labelType, //Native or HTML
                    size: 13,
                    family: 'Arial',
                    color: 'white'
                },
                //add tooltips
                Tips: {
                    enable: true,
                    onShow: function (tip, elem) {
                        tip.innerHTML = "<b>" + elem.name + "</b>: " + elem.value;
                    }
                }
            });
            //load JSON data.
            barChart.loadJSON(json);
            
            //end
            var list = $jit.id('id-list'),
                button = $jit.id('update'),
                button2 = $jit.id('update2'),
                orn = $jit.id('switch-orientation');
            //update json on click 'Update Data'
            $jit.util.addEvent(button, 'click', function () {
                var util = $jit.util;
                if (util.hasClass(button, 'gray')) return;
                util.removeClass(button, 'white');
                util.addClass(button, 'gray');
                util.removeClass(button2, 'gray');
                util.addClass(button2, 'white');
                barChart.updateJSON(json2);
            });

            $jit.util.addEvent(button2, 'click', function () {
                var util = $jit.util;
                if (util.hasClass(button2, 'gray')) return;
                util.removeClass(button2, 'white');
                util.addClass(button2, 'gray');
                util.removeClass(button, 'gray');
                util.addClass(button, 'white');
                barChart.updateJSON(json);
            });

            //dynamically add legend to list
            var legend = barChart.getLegend(),
                listItems = [];
            for (var name in legend) {
                listItems.push('<div class=\'query-color\' style=\'background-color:' + legend[name] + '\'>&nbsp;</div>' + name);
            }
            list.innerHTML = '<li>' + listItems.join('</li><li>') + '</li>';
        }
    });

    $.ajax({
        url: 'ajax/_revenue.php',
        type: 'GET',
        dataType: 'jsonp',
        dataCharset: 'jsonp',
        success: function (data) {
            //console.log(data[0]);
            json2 = data[0];
        }
    });

}