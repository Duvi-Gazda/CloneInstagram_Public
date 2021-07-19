function addSelect(element_id){
    element = document.getElementById(element_id);
    if(element.checked){
        document.getElementById(element_id).parentElement.className = "list-group col-sm-9";
        document.getElementById(element_id + "_select").className = "col-sm-3  text-center list-group";
    } else {
        document.getElementById(element_id).parentElement.className = "list-group col-sm-12";
        document.getElementById(element_id + "_select").className = "hidden";
        document.getElementById(element_id + "_select").selectedIndex = 0;
    }
}
$(document).ready(function(){
    $('input[type="checkbox"]').each(function(){
        $(this).prop('checked', false);
    });
});