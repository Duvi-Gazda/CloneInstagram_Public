function addSelect(element_id){
    element = document.getElementById(element_id);
    if(element.checked){
        document.getElementById(element_id).parentElement.className = "list-group col-sm-9";
        document.getElementById(element_id + "_select").className = "col-sm-3  text-center list-group";
        document.getElementById(element_id + "_select").children["0"].value = "new";
    } else {
        document.getElementById(element_id).parentElement.className = "list-group col-sm-12";
        document.getElementById(element_id + "_select").className = "hidden";
        document.getElementById(element_id + "_select").children["0"].value = "no";
    }
}
$(document).ready(function(){
    $('input[type="checkbox"]').each(function(){
        document.getElementById(element_id + "_select").children["0"].value = "no";
        $(this).prop('checked', false);
    });
});