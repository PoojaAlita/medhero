/*DataTable*/
$("#inquiry_tbl").DataTable({
    aLengthMenu: [
        [10, 30, 50, -1],
        [10, 30, 50, "All"],
    ],
    iDisplayLength: 10,
    language: {
        search: "",
    },
    ajax: {
        type: "POST",
        url: aurl + "/admin/inquiry/listing",
    },
    columns: [
        { data: "0" },
        { data: "1" },
        { data: "2" },
        { data: "3" },
        { data: "4" },
        { data: "5" },
    ],
});