$(document).ready(function(){
    // Tratamento do evento de teclado para contar letras e limitar a 500
    $('#texto').on('keyup', function(){
        var texto = $(this).val();
        if (texto.length > 500) {
            $(this).val(texto.substring(0, 500));
            texto = $(this).val();
        }
        var qtdLetras = texto.length;
        $('#contador').text(qtdLetras + "/500");
    });
});

// Função para submeter o formulário
function submitForm() {
    var experiencia = $('#texto').val();
    // Aqui você pode fazer algo com a experiência digitada, como enviar para o servidor
    console.log("Experiência do usuário:", experiencia);
    // Por exemplo, se quiser enviar para um servidor, pode fazer uma requisição AJAX aqui
    // $.post("url_do_seu_servidor", { experiencia: experiencia });
}

$(document).ready(function(){
    var lista = $('#lista ul');
    var itens = lista.children('li').get();
    itens.sort(function(a, b) {
        var notaA = parseInt($(a).text().split(' - ')[1]);
        var notaB = parseInt($(b).text().split(' - ')[1]);
        return notaB - notaA;
    });
    $.each(itens, function(index, item) {
        lista.append(item);
    });
});
