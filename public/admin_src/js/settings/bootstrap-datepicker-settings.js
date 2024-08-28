$(document).ready(function () {
    $('#document_date').datepicker({
        autoclose: true,
        format: 'd.m.yyyy',
        language: 'ua',
        todayHighlight: true
    });

    $('#publish_date').datepicker({
        autoclose: true,
        format: 'd.m.yyyy',
        language: 'ua',
        todayHighlight: true
    });
});

$.fn.datepicker.dates['ua'] = {
    days: ["Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота"],
    daysShort: ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    daysMin: ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    months: ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
    monthsShort: [
        "Січ", "Лют", "Бер", "Кві", "Тра", "Чер",
        "Лип", "Сер", "Вер", "Жов", "Лис", "Гру"
    ],
    today: "Сьогодні",
    clear: "Очистити",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy",
    weekStart: 1
};
