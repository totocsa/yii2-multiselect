$(document).ready(function () {
    $("body").on("click", ".dropdown.multiselect .dropdown-header", function () {
        return false;
    });

    $("body").on("click", ".multiselect .multiselect-all", function () {
        $(this).parents(".dropdown-header").children(".items").find("input.multiselect-filter").prop("checked", true);
    });

    $("body").on("click", ".multiselect .multiselect-none", function () {
        $(this).parents(".dropdown-header").children(".items").find("input.multiselect-filter").prop("checked", false);
    });

    $("body").on("click", ".multiselect .multiselect-apply", function () {
        var parents = $(this).parents(".grid-view");
        $(parents[0]).yiiGridView("applyFilter");
    });

    $("body").on("click", ".multiselect .multiselect-close", function () {
        $(this).parents(".multiselect").dropdown("hide");
    });

    $("body").on("click", ".multiselect .multiselect-filter + label", function () {
        var forid = $(this).attr("for");
        var checked = $("#" + forid).prop("checked");
        $("#" + forid).prop("checked", !checked);
        return false;
    });
});
