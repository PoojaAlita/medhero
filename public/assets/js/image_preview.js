/*
    *Author : kishan 
    *Date : 3/05/22
    *Added image preview js
*/
$("#profile").change(function (event) {
    $("#preview_profile").attr(
        "src",
        URL.createObjectURL(event.target.files[0])
    );
});

$("#cover").change(function (event) {
    $("#preview_cover").attr("src", URL.createObjectURL(event.target.files[0]));
});

$("#h_logo").change(function (event) {
    $("#preview_h_logo").attr(
        "src",
        URL.createObjectURL(event.target.files[0])
    );
});

$("#e_logo").change(function (event) {
    $("#preview_e_logo").attr(
        "src",
        URL.createObjectURL(event.target.files[0])
    );
});
/*
    *Author : kishan 
    *Date : 3/05/22
    * End
*/