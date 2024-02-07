



    function updateCheckboxValue(checkbox) {
        if (checkbox.checked) {
            checkbox.value = "1"; // Si está marcado, cambia el valor a 1 (verdadero)
        } else {
            checkbox.value = "0"; // Si no está marcado, cambia el valor a 0 (falso)
        }
    }

    function submitForm() {
        var form = document.getElementById("manualPreferenceForm");
        var formData = new FormData(form);
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", form.action);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Acciones adicionales después de que el formulario se envíe con éxito
                console.log("Formulario enviado correctamente");
            }
        };
        xhr.send(formData);
    }

