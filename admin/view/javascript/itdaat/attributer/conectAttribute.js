function addSelect(element_id) {
    element = document.getElementById(element_id);
    if (element.checked) {
        document.getElementById(element_id).parentElement.className = "list-group col-sm-9";
        document.getElementById(element_id + "_select").className = "col-sm-3  text-center list-group";
        document.getElementById(element_id + "_select").children["0"].value = "new";
    } else {
        document.getElementById(element_id).parentElement.className = "list-group col-sm-12";
        document.getElementById(element_id + "_select").className = "hidden";
        document.getElementById(element_id + "_select").children["0"].value = "no";
    }
}
function setAttributeWritable(button, textplace) {
    document.getElementById(button).classList.toggle("btn-primary");
    document.getElementById(button).classList.toggle("btn-success");
    document.getElementById('itdaat_label_' + textplace).toggleAttribute("contenteditable");
    document.getElementById('itdaat_label_' + textplace).addEventListener('input', function () {
        document.getElementById('hidden_' + textplace).value = this.textContent;
    });
}
$(document).ready(function () {
    $('input[type="checkbox"]').each(function () {
        $(this).prop('checked', false);
    });
    document.getElementById('attribute_search').addEventListener('input', function () {
        $.ajax({
            url: window.location.href,
            type: 'post',
            content: $("#attributes_list"),
            dataType: 'json',
            data: {
                action: 'search_attribute_by_name',
                attribute_name: $("#attribute_search").val(),
            },
            success: function (response) {
                $(this.content).empty();
                if (response) {

                    attribute_list = this.content;
                    response.forEach(element => {
                        $(attribute_list).append(
                            `<div class="col-sm-12" >

                            <div class="col-sm-11 container">
                                <button type="submit" name="action" value="connect_itdaat_attribute|`+ element['id'] + `" style="all: unset; width: 100%; height: 100%;" class="btn btn-primary btn-lg btn-block">
                                    <div class="list-group">
                                        <a class="list-group-item ">
                                            <h4 class="list-group-item-heading">`+ element['name'] + `</h4>
                                            <p class="list-group-item-text">`+ element['value'] + `</p>
                                        </a>
                                    </div>
                                </button>
                            </div>
                            <div class="col-sm-1 container" style=" display: table-cell;vertical-align: middle">
                                <button class="btn btn-danger" type="submit" name="action" value="delete_itdaat_attribute|`+ element['id'] + `">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>`
                        );
                    });
                }

            },
        });
    })
});
