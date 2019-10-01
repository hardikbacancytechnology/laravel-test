function loadContent($href,$this=''){
    toastr.remove();
    $("#content").load($href+' .ajax_contents',function(responseTxt,statusTxt,xhr){
        if(statusTxt == "success"){
            loadScripts();
            $('title').text($('.content-header h1').text());
            $('.sidebar-menu li').each(function(){
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                }
                if($(this).hasClass('menu-open')){
                    $(this).removeClass('menu-open');
                }
                if($(this).find('ul.treeview-menu').length){
                    $(this).find('ul.treeview-menu li').each(function(){
                        if($(this).hasClass('active')){
                            $(this).removeClass('active');
                        }
                    });
                    $(this).find('ul.treeview-menu').hide();
                }
            });
            if(!$this){
                $this = $('.sidebar-menu li').find('a[href="'+$href+'"]');
            }else if($this.parents('.sidebar-menu').length==0){
                $this = $('.sidebar-menu li').find('a[href="'+$href+'"]');
            }
            if(!$this.parent('li').parents('.treeview').hasClass('menu-open')){
                $this.parent('li').parents('.treeview').addClass('menu-open active');
                $this.parent('li').parents('.treeview-menu').show();
            }
            if(!$this.parent('li').hasClass('active')){
                $this.parent('li').addClass('active');
            }
            window.history.pushState(null,null,$href);
        }else if(statusTxt == "error"){
            showAjaxErrors(xhr,statusTxt);
            // toastr.error("Error: " + xhr.status + ": " + xhr.statusText);
        }
    });
}
function loadScripts(){
    "use strict";
    toastr.options = {
        "showMethod":"slideDown",
        "hideMethod":"slideUp",
    };
    /* ChartJS
    * -------
    * Here we will create a few charts using ChartJS
    */
    // -----------------------
    // - MONTHLY SALES CHART -
    // -----------------------
    if($('#salesChart').length){
        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart       = new Chart(salesChartCanvas);
        var salesChartData = {
            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
            {
                label               : 'Electronics',
                fillColor           : 'rgb(210, 214, 222)',
                strokeColor         : 'rgb(210, 214, 222)',
                pointColor          : 'rgb(210, 214, 222)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgb(220,220,220)',
                data                : [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label               : 'Digital Goods',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [28, 48, 40, 19, 86, 27, 90]
            }
            ]
        };
        var salesChartOptions = {
        // Boolean - If we should show the scale at all
        showScale               : true,
        // Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        // String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        // Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        // Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        // Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        // Boolean - Whether the line is curved between points
        bezierCurve             : true,
        // Number - Tension of the bezier curve between points
        bezierCurveTension      : 0.3,
        // Boolean - Whether to show a dot for each point
        pointDot                : false,
        // Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        // Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        // Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        // Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        // Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        // String - A legend template
        legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        // Boolean - whether to make the chart responsive to window resizing
        responsive              : true
        };
        // Create the line chart
        salesChart.Line(salesChartData, salesChartOptions);
        // ---------------------------
        // - END MONTHLY SALES CHART -
        // ---------------------------
    }
    // -------------
    // - PIE CHART -
    // -------------
    // Get context with jQuery - using jQuery's .get() method.
    if($('#pieChart').length){
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart       = new Chart(pieChartCanvas);
        var PieData        = [
        {
            value    : 700,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Chrome'
        },
        {
            value    : 500,
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'IE'
        },
        {
            value    : 400,
            color    : '#f39c12',
            highlight: '#f39c12',
            label    : 'FireFox'
        },
        {
            value    : 600,
            color    : '#00c0ef',
            highlight: '#00c0ef',
            label    : 'Safari'
        },
        {
            value    : 300,
            color    : '#3c8dbc',
            highlight: '#3c8dbc',
            label    : 'Opera'
        },
        {
            value    : 100,
            color    : '#d2d6de',
            highlight: '#d2d6de',
            label    : 'Navigator'
        }
        ];
        var pieOptions     = {
            // Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            // String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            // Number - The width of each segment stroke
            segmentStrokeWidth   : 1,
            // Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            // Number - Amount of animation steps
            animationSteps       : 100,
            // String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            // Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            // Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            // Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : false,
            // String - A legend template
            legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
            // String - A tooltip template
            tooltipTemplate      : '<%=value %> <%=label%> users'
            };
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);
        }
    // -----------------
    // - END PIE CHART -
    // -----------------
    /* jVector Maps
    * ------------
    * Create a world map with markers
    */
    if($('#world-map-markers').length){
        $('#world-map-markers').vectorMap({
            map              : 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity     : 0.7,
            hoverColor       : false,
            backgroundColor  : 'transparent',
            regionStyle      : {
                initial      : {
                    fill            : 'rgba(210, 214, 222, 1)',
                    'fill-opacity'  : 1,
                    stroke          : 'none',
                    'stroke-width'  : 0,
                    'stroke-opacity': 1
                },
                hover        : {
                    'fill-opacity': 0.7,
                    cursor        : 'pointer'
                },
                selected     : {
                    fill: 'yellow'
                },
                selectedHover: {}
            },
            markerStyle      : {
                initial: {
                    fill  : '#00a65a',
                    stroke: '#111'
                }
            },
            markers          : [
            { latLng: [41.90, 12.45], name: 'Vatican City' },
            { latLng: [43.73, 7.41], name: 'Monaco' },
            { latLng: [-0.52, 166.93], name: 'Nauru' },
            { latLng: [-8.51, 179.21], name: 'Tuvalu' },
            { latLng: [43.93, 12.46], name: 'San Marino' },
            { latLng: [47.14, 9.52], name: 'Liechtenstein' },
            { latLng: [7.11, 171.06], name: 'Marshall Islands' },
            { latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis' },
            { latLng: [3.2, 73.22], name: 'Maldives' },
            { latLng: [35.88, 14.5], name: 'Malta' },
            { latLng: [12.05, -61.75], name: 'Grenada' },
            { latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines' },
            { latLng: [13.16, -59.55], name: 'Barbados' },
            { latLng: [17.11, -61.85], name: 'Antigua and Barbuda' },
            { latLng: [-4.61, 55.45], name: 'Seychelles' },
            { latLng: [7.35, 134.46], name: 'Palau' },
            { latLng: [42.5, 1.51], name: 'Andorra' },
            { latLng: [14.01, -60.98], name: 'Saint Lucia' },
            { latLng: [6.91, 158.18], name: 'Federated States of Micronesia' },
            { latLng: [1.3, 103.8], name: 'Singapore' },
            { latLng: [1.46, 173.03], name: 'Kiribati' },
            { latLng: [-21.13, -175.2], name: 'Tonga' },
            { latLng: [15.3, -61.38], name: 'Dominica' },
            { latLng: [-20.2, 57.5], name: 'Mauritius' },
            { latLng: [26.02, 50.55], name: 'Bahrain' },
            { latLng: [0.33, 6.73], name: 'São Tomé and Príncipe' }
            ]
        });
    }
    /* SPARKLINE CHARTS
    * ----------------
    * Create a inline charts with spark line
    */
    // -----------------
    // - SPARKLINE BAR -
    // -----------------
    if($('.sparkbar').length && $('.sparkpie').length && $('.sparkline').length){
        $('.sparkbar').each(function () {
            var $this = $(this);
            $this.sparkline('html', {
                type    : 'bar',
                height  : $this.data('height') ? $this.data('height') : '30',
                barColor: $this.data('color')
            });
        });
        // -----------------
        // - SPARKLINE PIE -
        // -----------------
        $('.sparkpie').each(function () {
            var $this = $(this);
            $this.sparkline('html', {
                type       : 'pie',
                height     : $this.data('height') ? $this.data('height') : '90',
                sliceColors: $this.data('color')
            });
        });
        // ------------------
        // - SPARKLINE LINE -
        // ------------------
        $('.sparkline').each(function () {
            var $this = $(this);
            $this.sparkline('html', {
                type     : 'line',
                height   : $this.data('height') ? $this.data('height') : '90',
                width    : '100%',
                lineColor: $this.data('linecolor'),
                fillColor: $this.data('fillcolor'),
                spotColor: $this.data('spotcolor')
            });
        });
    }
    if($('.connectedSortable').length){
        // Make the dashboard widgets sortable Using jquery UI
        $('.connectedSortable').sortable({
            containment         : $('section.content'),
            placeholder         : 'sort-highlight',
            connectWith         : '.connectedSortable',
            handle              : '.box-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
        $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');
    }
    if($('.todo-list').length){
        // jQuery UI sortable for the todo list
        $('.todo-list').sortable({
            placeholder         : 'sort-highlight',
            handle              : '.handle',
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
    }
    if($('.textarea').length){
        // bootstrap WYSIHTML5 - text editor
        // $('.textarea').wysihtml5();
    }
    if($('.daterange').length){
        $('.daterange').daterangepicker({
            ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        }, function (start, end) {
            toastr.success('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
    }
    if($('.knob').length){
        /* jQueryKnob */
        $('.knob').knob();
    }
    if($('#world-map').length){
        // jvectormap data
        var visitorsData = {
            US: 398, // USA
            SA: 400, // Saudi Arabia
            CA: 1000, // Canada
            DE: 500, // Germany
            FR: 760, // France
            CN: 300, // China
            AU: 700, // Australia
            BR: 600, // Brazil
            IN: 800, // India
            GB: 320, // Great Britain
            RU: 3000 // Russia
        };
        // World map by jvectormap
        $('#world-map').vectorMap({
            map              : 'world_mill_en',
            backgroundColor  : 'transparent',
            regionStyle      : {
                initial: {
                    fill            : '#e4e4e4',
                    'fill-opacity'  : 1,
                    stroke          : 'none',
                    'stroke-width'  : 0,
                    'stroke-opacity': 1
                }
            },
            series           : {
                regions: [
                {
                    values           : visitorsData,
                    scale            : ['#92c1dc', '#ebf4f9'],
                    normalizeFunction: 'polynomial'
                }
                ]
            },
            onRegionLabelShow: function (e, el, code) {
                if (typeof visitorsData[code] != 'undefined')
                    el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
            }
        });
    }
    if($('#sparkline-1').length && $('#sparkline-2').length && $('#sparkline-3').length){
        // Sparkline charts
        var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
        $('#sparkline-1').sparkline(myvalues, {
            type     : 'line',
            lineColor: '#92c1dc',
            fillColor: '#ebf4f9',
            height   : '50',
            width    : '80'
        });
        myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
        $('#sparkline-2').sparkline(myvalues, {
            type     : 'line',
            lineColor: '#92c1dc',
            fillColor: '#ebf4f9',
            height   : '50',
            width    : '80'
        });
        myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
        $('#sparkline-3').sparkline(myvalues, {
            type     : 'line',
            lineColor: '#92c1dc',
            fillColor: '#ebf4f9',
            height   : '50',
            width    : '80'
        });
    }
    if($('#calendar').length){
        // The Calender
        $('#calendar').datepicker();
    }
    if($('#chat-box').length){
        // SLIMSCROLL FOR CHAT WIDGET
        $('#chat-box').slimScroll({
            height: '250px'
        });
    }
    if($('#revenue-chart').length && $('#line-chart').length && $('#sales-chart').length){
        /* Morris.js Charts */
        // Sales chart
        var area = new Morris.Area({
            element   : 'revenue-chart',
            resize    : true,
            data      : [
            { y: '2011 Q1', item1: 2666, item2: 2666 },
            { y: '2011 Q2', item1: 2778, item2: 2294 },
            { y: '2011 Q3', item1: 4912, item2: 1969 },
            { y: '2011 Q4', item1: 3767, item2: 3597 },
            { y: '2012 Q1', item1: 6810, item2: 1914 },
            { y: '2012 Q2', item1: 5670, item2: 4293 },
            { y: '2012 Q3', item1: 4820, item2: 3795 },
            { y: '2012 Q4', item1: 15073, item2: 5967 },
            { y: '2013 Q1', item1: 10687, item2: 4460 },
            { y: '2013 Q2', item1: 8432, item2: 5713 }
            ],
            xkey      : 'y',
            ykeys     : ['item1', 'item2'],
            labels    : ['Item 1', 'Item 2'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover : 'auto'
        });
        var line = new Morris.Line({
            element          : 'line-chart',
            resize           : true,
            data             : [
            { y: '2011 Q1', item1: 2666 },
            { y: '2011 Q2', item1: 2778 },
            { y: '2011 Q3', item1: 4912 },
            { y: '2011 Q4', item1: 3767 },
            { y: '2012 Q1', item1: 6810 },
            { y: '2012 Q2', item1: 5670 },
            { y: '2012 Q3', item1: 4820 },
            { y: '2012 Q4', item1: 15073 },
            { y: '2013 Q1', item1: 10687 },
            { y: '2013 Q2', item1: 8432 }
            ],
            xkey             : 'y',
            ykeys            : ['item1'],
            labels           : ['Item 1'],
            lineColors       : ['#efefef'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#fff',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10
        });
        // Donut Chart
        var donut = new Morris.Donut({
            element  : 'sales-chart',
            resize   : true,
            colors   : ['#3c8dbc', '#f56954', '#00a65a'],
            data     : [
            { label: 'Download Sales', value: 12 },
            { label: 'In-Store Sales', value: 30 },
            { label: 'Mail-Order Sales', value: 20 }
            ],
            hideHover: 'auto'
        });
    }
    // Fix for charts under tabs
    $('.box ul.nav a').on('shown.bs.tab', function () {
        area.redraw();
        donut.redraw();
        line.redraw();
    });
    if($('.todo-list').length){
        /* The todo list plugin */
        $('.todo-list').todoList({
            onCheck  : function () {
                window.console.log($(this), 'The element has been checked');
            },
            onUnCheck: function () {
                window.console.log($(this), 'The element has been unchecked');
            }
        });
    }
    if($('.data-table').length){
        var $datatableId = $('.data-table').attr('id');
        var $order = [[0, 'desc']];
        var $processing = false;
        var $serverSide = false;
        var $lengthMenu = [10,25,50,100];
        var $pageLength = 10;
        var $columnDefs = [];
        var $ajax = '';
        if($datatableId=='users-tbl'){
            $processing = true;
            $serverSide = true;
            $order = [[1, 'desc']];
            $columnDefs = [{
                "targets": [0,-1],
                "searchable": false,
                "orderable": false,
            }];
            $ajax = {
                "url":site_url+'admin/users/listings',
                "type":"POST",
                "data":{_token:csrf_token}
            };
        }
        $('#'+$datatableId).DataTable({
            "processing": $processing,
            "serverSide": $serverSide,
            "ajax":$ajax,
            "lengthMenu": $lengthMenu,
            "pageLength": $pageLength,
            "order": $order,
            "columnDefs": $columnDefs,
            "pagingType": "full_numbers",
            "oLanguage": {
                "oPaginate": {
                    "sFirst": '<i class="fa fa-step-backward"></i>',
                    "sPrevious": '<i class="fa fa-backward"></i>',
                    "sNext": '<i class="fa fa-forward"></i>',
                    "sLast": '<i class="fa fa-step-forward"></i>'
                }
            },
            fnDrawCallback:function(oSettings){
                if($('*[data-toggle="tooltip"]').length){
                    $('*[data-toggle="tooltip"]').tooltip();
                }
            }
        });
    }
    if($('select').length){
        $('select').select2();
    }
    if($('*[data-toggle="tooltip"]').length){
        $('*[data-toggle="tooltip"]').tooltip();
    }
}
function fetchValidateRulesAndMessages($form){
    var rules = [];
    var messages = [];
    if($form=='change-password-form'){
        rules = {
            'old_pwd':{
                required:true
            },
            'new_pwd':{
                required:true,
                equalTo:'#confirm_pwd'
            },
            'confirm_pwd':{
                required:true
            }
        };
        messages = {
            'old_pwd':{
                required:"Please enter old password"
            },
            'new_pwd':{
                required:"Please enter new password",
                equalTo:"Password do not match",
            },
            'confirm_pwd':{
                required:"Please confirm password"
            }
        };
    }else if($form=='create-user-form'){
        rules = {
            'name':{
                required:true
            },
            'email':{
                required:true,
                email:true
            },
            'password':{
                required:true
            }
        };
        messages = {
            'name':{
                required:"Please enter name"
            },
            'email':{
                required:"Please enter email",
                email:"Please enter valid email",
            },
            'password':{
                required:"Please enter password"
            }
        };
    }
    return {'rules':rules,'messages':messages};
}
function validateForm($form){
    var response = fetchValidateRulesAndMessages($form);
    $('#'+$form).validate({
        rules:response.rules,
        messages:response.messages,
        submitHandler:function(form){
            ajaxSubmitForm($form);
            return false;
        }
    });
}
function ajaxSubmitForm(form){
    toastr.remove();
    $.ajax({
        url:$('#'+form).attr('action'),
        method:'POST',
        dataType:'json',
        data:$('#'+form).serialize(),
        success:function(response){
            if(response.status==100){
                toastr.success(response.message);
                if(typeof response.counter !== 'undefined'){
                    $('.sidebar-menu a[href="'+response.url+'"] .pull-right-container span').text(response.counter);
                }
                if(typeof response.url !== 'undefined'){
                    loadContent(response.url);
                }else{$('#'+form).trigger("reset");}
            }else{
                if(typeof response.errors !== 'undefined'){
                    $.each(response.errors, function(key,value){
                        $('<label class="error">'+value+'</label>').insertAfter('#'+key);
                    });
                }else{toastr.error(response.message);}
            }
        },
        error:function(jqXHR,exception){
            showAjaxErrors(jqXHR,exception);
        }
    });
}
function showAjaxErrors(jqXHR,exception){
    console.log(jqXHR);
    toastr.remove();
    var msg = '';
    if(jqXHR.status === 0){
        msg = 'Not connect.\n Verify Network.';
    }else if(jqXHR.status == 401){
        msg = 'You don\'t have enough permission.';
        loadContent(site_url+'401');
    }else if(jqXHR.status == 404){
        msg = 'Requested page not found. [404]';
    }else if(jqXHR.status == 500){
        msg = 'Internal Server Error [500].';
    }else if(exception === 'parsererror'){
        msg = 'Requested JSON parse failed.';
    }else if(exception === 'timeout'){
        msg = 'Time out error.';
    }else if(exception === 'abort'){
        msg = 'Ajax request aborted.';
    }else{
        var response = JSON.parse(jqXHR.responseText);
        msg = 'Uncaught Error.\n' + response.message;
        $.each(response.errors, function(key,value){
            if($('#'+key).next('.error').length==0){
                $('<label class="error">'+value+'</label>').insertAfter('#'+key);
            }else{
                $('#'+key).next('.error').css({'display':'block'}).html(value);
            }
        });
    }
    toastr.error(msg);
}
loadScripts();
$(document).on('click','.ajax_anchor',function(e){
    e.preventDefault();
    var $this = $(this);
    var $href = $this.attr('href');
    if($href!='#'){
        loadContent($href,$this);
    }
});
$(document).on('click','.confirm-delete',function(){
    var $module = $(this).data('module');
    var $id = $(this).data('id');
    swal({
        title: "Are you sure you want to delete this record?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if(willDelete){
            $.ajax({
                url:site_url+'admin/'+$module+'/'+$id,
                method:'DELETE',
                dataType:'json',
                data:{_token:csrf_token},
                success:function(response){
                    if(response.status==100){
                        swal("Poof! "+response.message+"!",{icon: "success"});
                        if(typeof response.counter !== 'undefined'){
                            $('.sidebar-menu a[href="'+site_url+'admin/'+$module+'"] .pull-right-container span').text(response.counter);
                        }
                        if($('#'+$module+'-tbl').length){$('#'+$module+'-tbl').DataTable().ajax.reload();}
                        if($('*[data-toggle="tooltip"]').length){$('*[data-toggle="tooltip"]').tooltip();}
                    }else{
                        swal(response.message,{icon: "error"});
                    }
                },
                error:function(jqXHR,exception){
                    showAjaxErrors(jqXHR,exception);
                }
            });
        }else{
            swal("Your record is safe!",{icon: "info"});
        }
    });
});
$(document).on('click','.submit-form',function(e){
    var $form = $(this).data('module')+'-form';
    validateForm($form);
});