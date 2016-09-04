$(document).ready(function () {

    $(".responsive-calendar").each(
            function (index, value) {
                var $this = $(this);
                var dataTime = $this.data("time");
                $this.responsiveCalendar({
                    time: dataTime,
                    translateMonths: algadBootstrapAgendaTranslateMonths,
                    events: algadBootstrapAgendaEvents});

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
