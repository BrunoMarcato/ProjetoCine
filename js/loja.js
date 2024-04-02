//TODO 1: generalizar função para todos os snacks
function incrementar_pq (){
    let quant = parseInt(document.getElementById('quantidade-pq').value);
    // console.log(quant);
    incremento = quant+1;
    document.getElementById('quantidade-pq').value = incremento;
    // console.log(incremento)
    // console.log(quant);
    // console.log("\n")
}

function incrementar_md (){
    let quant = parseInt(document.getElementById('quantidade-md').value);
    // console.log(quant);
    incremento = quant+1;
    document.getElementById('quantidade-md').value = incremento;
    // console.log(incremento)
    // console.log(quant);
    // console.log("\n")
}

function incrementar_gd (){
    let quant = parseInt(document.getElementById('quantidade-gd').value);
    // console.log(quant);
    incremento = quant+1;
    document.getElementById('quantidade-gd').value = incremento;
    // console.log(incremento)
    // console.log(quant);
    // console.log("\n")
}

function decrementar_pq (){
    let quant = parseInt(document.getElementById('quantidade-pq').value);
    // console.log(quant);
    incremento = quant-1;
    if(incremento>=0){
        document.getElementById('quantidade-pq').value = incremento;
    }else{
        alert('A quantidade não pode ser negativa!');
    }
    // console.log(incremento)
    // console.log(quant);
    // console.log("\n")
}

function decrementar_md (){
    let quant = parseInt(document.getElementById('quantidade-md').value);
    // console.log(quant);
    incremento = quant-1;
    if(incremento>=0){
        document.getElementById('quantidade-md').value = incremento;
    }else{
        alert('A quantidade não pode ser negativa!');
    }
    // console.log(incremento)
    // console.log(quant);
    // console.log("\n")
}

function decrementar_gd (){
    let quant = parseInt(document.getElementById('quantidade-gd').value);
    // console.log(quant);
    incremento = quant-1;
    if(incremento>=0){
        document.getElementById('quantidade-gd').value = incremento;
    }else{
        alert('A quantidade não pode ser negativa!');
    }
    // console.log(incremento)
    // console.log(quant);
    // console.log("\n")
}

function comprar_pipoca_pq (){
    let quant = parseInt(document.getElementById('quantidade-pq').value);
    let pipoca = '';
    let total = quant*5;
    if(quant>0){
        if(quant==1){
            pipoca = quant + ' pipoca pequena\n';
        }else{
            pipoca = quant + ' pipocas pequenas\n';
        }
        alert('Você adicionou:\n '+pipoca+'('+total+' Reais)'+' ao carrinho!');
        document.getElementById('quantidade-pq').value = 0;
    }else{
        alert('Selecione ao menos 1 unidade de pipoca!');
    }
}

function comprar_pipoca_md (){
    let quant = parseInt(document.getElementById('quantidade-md').value);
    let pipoca = '';
    let total = quant*10;
    if(quant>0){
        if(quant==1){
            pipoca = quant + ' pipoca média\n';
        }else{
            pipoca = quant + ' pipocas médias\n';
        }
        alert('Você adicionou:\n '+pipoca+'('+total+' Reais)'+' ao carrinho!');
        document.getElementById('quantidade-md').value = 0;
    }else{
        alert('Selecione ao menos 1 unidade de pipoca!');
    }
}

function comprar_pipoca_gd (){
    let quant = parseInt(document.getElementById('quantidade-gd').value);
    let pipoca = '';
    let total = quant*15;
    if(quant>0){
        if(quant==1){
            pipoca = quant + ' pipoca grande\n';
        }else{
            pipoca = quant + ' pipocas grandes\n';
        }
        alert('Você adicionou:\n '+pipoca+'('+total+' Reais)'+' ao carrinho!');
        document.getElementById('quantidade-gd').value = 0;
    }else{
        alert('Selecione ao menos 1 unidade de pipoca!');
    }
}

document.getElementById('aumentar-quantidade-pq').addEventListener("click",incrementar_pq)
document.getElementById('aumentar-quantidade-md').addEventListener("click",incrementar_md)
document.getElementById('aumentar-quantidade-gd').addEventListener("click",incrementar_gd)
document.getElementById('reduzir-quantidade-pq').addEventListener("click",decrementar_pq)
document.getElementById('reduzir-quantidade-md').addEventListener("click",decrementar_md)
document.getElementById('reduzir-quantidade-gd').addEventListener("click",decrementar_gd)
document.getElementById('btn-pip-pq').addEventListener("click",comprar_pipoca_pq)
document.getElementById('btn-pip-md').addEventListener("click",comprar_pipoca_md)
document.getElementById('btn-pip-gd').addEventListener("click",comprar_pipoca_gd)