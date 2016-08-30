(function ($) {
    $.fn.contextMenu = function (parameter) {

        var $contextMenu = $(parameter.menu);


        $("body").on("contextmenu", this.selector, function (e) {
            if (parameter.before != undefined) {
                parameter.before($contextMenu, $(this));
            }
            $contextMenu.css({
                left: e.pageX,
                top: e.pageY
            });
            $contextMenu.show("blind", 200);
            return false;
        });

        if (parameter.callbackLink != undefined) {
            $contextMenu.on("click", "a", parameter.callbackLink);
        }
        $(document).click(function () {
            $contextMenu.hide("blind", 200);
        });
        return $(this);
    };
})(jQuery);

$(function () {
    var DataSource = function (options) {
        this._formatter = options.formatter;
        this._columns = options.columns;
        this._data = options.data;
        this._delay = options.delay || 0;
    };

    DataSource.prototype = {

        columns: function () {
            return this._columns;
        },

        data: function (options, callback) {

            var self = this;


            var data = $.extend(true, [], self._data);


            // SEARCHING
            if (options.search) {
                data = _.filter(data, function (item) {
                    for (var prop in item) {
                        if (!item.hasOwnProperty(prop)) continue;
                        if (~item[prop].toString().toLowerCase().indexOf(options.search.toLowerCase())) return true;
                    }
                    return false;
                });
            }
            var count = data.length;

            // SORTING
            if (options.sortProperty) {
                data = _.sortBy(data, options.sortProperty);
                if (options.sortDirection === 'desc') data.reverse();
            }


            if (self._formatter) self._formatter(data);

            callback({ data: data, start: 0, end: data.length, count: count});

        }
    };

// INITIALIZING THE DATAGRID
    var dataSourceApplication = new DataSource({
            columns: [

                {
                    property: 'name',
                    label: 'Name',
                    sortable: true

                },
                {
                    property: 'code',
                    label: 'Code',
                    sortable: true
                }
            ],
            data: applicationData
        })
        ;
    var dataSourceRelease = new DataSource({
            columns: [

                {
                    property: 'name',
                    label: 'Release name',
                    sortable: true

                },
                {
                    property: 'archstate',
                    label: 'Architecture state',
                    sortable: false
                }
            ],
            data: releaseData
        })
        ;
    var dataSourceEnvironment = new DataSource({
            columns: [

                {
                    property: 'name',
                    label: 'Release name',
                    sortable: true

                },
                {
                    property: 'envname',
                    label: 'Env name',
                    sortable: true
                },
                {
                    property: 'status',
                    label: 'Status',
                    sortable: false
                }
            ],
            data: environmentData
        })
        ;
    var datagrid = $('#ApplicationGrid').datagrid({
        dataSource: dataSourceApplication
    });
    $('#ApplicationGrid').each(function (index, el) {
        $('tbody tr', el).addClass('applicationContext');
    });
    $('.applicationContext').contextMenu({
        menu: "#contextMenuApplication"
    });

    $('#ReleaseGrid').datagrid({
        dataSource: dataSourceRelease
    });
    $('#ReleaseGrid').each(function (index, el) {
        $('tbody tr', el).addClass('releaseContext');

    });
    $('.releaseContext').contextMenu({
        menu: "#contextMenuRelease"
    });

    $('#EnvironmentGrid').datagrid({
        dataSource: dataSourceEnvironment
    });
    $('#EnvironmentGrid').each(function (index, el) {
        $tr = $('tbody tr', el);

        $tr.addClass('environmentContext');
        $('td', $tr).each(function (inde, elem) {

            if ($(elem).text() == 'RUNNING') {
                $(elem).hide();
                $($(elem).parent()).css('background-color', '#5c985c');
                return;
            } else if ($(elem).text() == 'STOPPED') {
                $(elem).hide();
                $($(elem).parent()).css('background-color', '#e58787');

                return;
            }
        });
    });
    $('#EnvironmentGrid th[data-property="status"]').hide();

    $('.environmentContext').contextMenu({
        menu: "#contextMenuEnvironment",
        before: function ($context, $called) {

            $('td', $called).each(function (index, el) {
                console.log($(el).html());
                if ($(el).text() == 'RUNNING') {

                    $('.start', $context).hide();
                    $('.stop', $context).show();
                    return;
                } else if ($(el).text() == 'STOPPED') {

                    $('.stop', $context).hide();
                    $('.start', $context).show();
                    return;
                }
            });
        }
    });
})
;