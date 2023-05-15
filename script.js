function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function Change()
    {
        var form = document.getElementById("X");
        var e = document.getElementById("type");
        var value = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;
        if(text == "Rectangle")
        {
            let input = document.createElement("input")
            input.name = "Y";
            input.type= "text";
            input.value = "Y";
            insertAfter(form, input);
        }
    }