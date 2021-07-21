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
function setAttributeWritable(button, textplace){
    document.getElementById(button).classList.toggle("btn-primary");
    document.getElementById(button).classList.toggle("btn-success");
    document.getElementById('itdaat_label_'+textplace).toggleAttribute("contenteditable");
    document.getElementById('itdaat_label_'+textplace).addEventListener('input', function(){
        document.getElementById('hidden_'+textplace).value = this.textContent;
    });
}
$(document).ready(function(){
    $('input[type="checkbox"]').each(function(){
        $(this).prop('checked', false);
    });
});