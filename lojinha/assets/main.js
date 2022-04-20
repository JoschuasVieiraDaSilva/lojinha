window.addEventListener("load", function () {
    // Para os inputs numéricos
    var numberInputs = window.document.getElementsByClassName("number");
    for (var i = 0; i < numberInputs.length; i++) {
        numberInputs[i].addEventListener("input", function () {this.value = numberFormatter(this.value);});
        numberInputs[i].addEventListener("focus", function () {this.value = numberFormatter(this.value);});
        numberInputs[i].addEventListener("blur", function () {this.value = numberFormatter(this.value);});
    }

    // Para os inputs de preço
    var priceInputs = window.document.getElementsByClassName("price");
    for (var i = 0; i < priceInputs.length; i++) {
        priceInputs[i].addEventListener("input", function () {this.value = priceFormatter(this.value);});
        priceInputs[i].addEventListener("focus", function () {this.value = priceFormatter(this.value);});
        priceInputs[i].addEventListener("blur", function () {this.value = priceFormatter(this.value);});
    }

    // Para os inputs de cpf
    var cpfInputs = window.document.getElementsByClassName("cpf");
    for (var i = 0; i < cpfInputs.length; i++) {
        cpfInputs[i].addEventListener("input", function () {this.value = cpfFormatter(this.value);});
        cpfInputs[i].addEventListener("focus", function () {this.value = cpfFormatter(this.value);});
        cpfInputs[i].addEventListener("blur", function () {this.value = cpfFormatter(this.value);});
    }

    // Para os inputs de cep
    var cepInputs = window.document.getElementsByClassName("cep");
    for (var i = 0; i < cepInputs.length; i++) {
        cepInputs[i].addEventListener("input", function () {this.value = cepFormatter(this.value);});
        cepInputs[i].addEventListener("focus", function () {this.value = cepFormatter(this.value);});
        cepInputs[i].addEventListener("blur", function () {this.value = cepFormatter(this.value);});
    }

    // Para os inputs de telefone
    var phoneInputs = window.document.getElementsByClassName("phone");
    for (var i = 0; i < phoneInputs.length; i++) {
        phoneInputs[i].addEventListener("input", function () {this.value = phoneFormatter(this.value);});
        phoneInputs[i].addEventListener("focus", function () {this.value = phoneFormatter(this.value);});
        phoneInputs[i].addEventListener("blur", function () {this.value = phoneFormatter(this.value);});
    }

    // Para os inputs de medida
    var measureInputs = window.document.getElementsByClassName("measure");
    for (var i = 0; i < measureInputs.length; i++) {
        measureInputs[i].addEventListener("input", function () {this.value = measureFormatter(this.value);});
        measureInputs[i].addEventListener("focus", function () {this.value = measureFormatter(this.value);});
        measureInputs[i].addEventListener("blur", function () {this.value = measureFormatter(this.value);});
    }
});

function numberFormatter(string) {
    return string.replace(/[^0-9]+/g, "");
}

function measureFormatter(string) {
    var measure = string.replace(/[^0-9.,]+/g, "");
    if (measure.match(/[.,]/g) != null) {
        var dot = measure.indexOf('.');
        var comma = measure.indexOf(',');
        if (measure.match(/[.,]/g).length > 1) {
            measure = numberFormatter(measure);
            var commaSeparated = measure.substring(0, comma) + ',' + measure.substring(comma, measure.length);
            var dotSeparated = measure.substring(0, dot) + '.' + measure.substring(dot, measure.length);
            if (dot == -1) {
                measure = commaSeparated;
            } else if (comma == -1) {
                measure = dotSeparated;
            } else if (dot > comma) {
                measure = commaSeparated;
            } else {
                measure = dotSeparated;
            }
        }
        var floatIndex = dot > comma ? dot : comma;
        if (measure.length - floatIndex > 3) {
            measure = measure.substring(0, floatIndex + 4);
        }
    }
    return measure;
}

function priceFormatter(string) {
    var numericPrice = numberFormatter(string);
    while (numericPrice.startsWith('0')) {
        numericPrice = numericPrice.substring(1, numericPrice.length);
    }
    var intPrice = numericPrice.substring(0, numericPrice.length - 2);
    for (var i = intPrice.length - 3; i > 0; i -= 3) {
        intPrice = intPrice.substring(0, i) + '.' + intPrice.substring(i, intPrice.length);
    }
    var decimalPrice = numericPrice.substring(numericPrice.length - 2, numericPrice.length);
    if (intPrice.length == 0) {
        intPrice = '0';
    }
    while (decimalPrice.length < 2) {
        decimalPrice = '0' + decimalPrice;
    }
    return 'R$ ' + intPrice + ',' + decimalPrice;
}

function cpfFormatter(string) {
    var numericCpf = numberFormatter(string);
    if (numericCpf.length > 11) {
        numericCpf = numericCpf.substring(0, 11);
    }
    var cpf = numericCpf.substring(0, 3);
    if (numericCpf.length > 3) {
        cpf += '.' + numericCpf.substring(3, 6);
    }
    if (numericCpf.length > 6) {
        cpf += '.' + numericCpf.substring(6, 9);
    }
    if (numericCpf.length > 9) {
        cpf += '-' + numericCpf.substring(9, 11);
    }
    return cpf;
}

function cepFormatter(string) {
    var numericCep = numberFormatter(string);
    if (numericCep.length > 8) {
        numericCep = numericCep.substring(0, 8);
    }
    var cep = numericCep.substring(0, 5);
    if (numericCep.length > 5) {
        cep += '-' + numericCep.substring(5, 8);
    }
    return cep;
}

function phoneFormatter(string) {
    var numericPhone = numberFormatter(string);
    if (numericPhone.length > 11) {
        numericPhone = numericPhone.substring(0, 11);
    }
    if (numericPhone.length > 0) {
        var phone = '(' + numericPhone.substring(0, 2) + ') ' + numericPhone.substring(2, (numericPhone.length < 11 ? 6 : 7));
    } else {
        var phone = '';
    }
    if (numericPhone.length > 6) {
        phone += '-' + numericPhone.substring((numericPhone.length < 11 ? 6 : 7), 11);
    }
    return phone;
}

function save(formId, path) {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        alert(xhttp.responseText);
    }
    xhttp.open("POST", path, true);
    xhttp.send(new FormData(window.document.getElementById(formId)));
}