$(document).ready(function () {

    $(".agenda").each(
            function (index, value) {
                var $this = $(this);
                var dataTime = $this.data("time");


                var dataEvents = $this.data("events").split(",");
                var jsonEvents = "{";
                dataEvents.forEach(function (event, index, array) {
                    jsonEvents = jsonEvents + '"' + event + '":{}';
                    if (index != array.length - 1) {
                        jsonEvents = jsonEvents + ",";
                    }
                });
                jsonEvents = jsonEvents + "}";
                jsonEvents = JSON.parse(jsonEvents);


                var m1 = $this.data("m1");
                var m2 = $this.data("m2");
                var m3 = $this.data("m3");
                var m4 = $this.data("m4");
                var m5 = $this.data("m5");
                var m6 = $this.data("m6");
                var m7 = $this.data("m7");
                var m8 = $this.data("m8");
                var m9 = $this.data("m9");
                var m10 = $this.data("m10");
                var m11 = $this.data("m11");
                var m12 = $this.data("m12");

                $(".responsive-calendar", $this).responsiveCalendar({
                    time: dataTime,
                    translateMonths: [m1, m2, m3, m4, m5, m6, m7, m8, m9, m10, m11, m12],
                    events: jsonEvents
                });

                if ($(window).width() < 768) {
                    $(".day.header", $this).each(
                            function (index, value) {
                                var $this = $(this);
                                var day = $this.text();
                                $this.text(day.charAt(0).toUpperCase());
                            }
                    );
                }
            }
    );

});
