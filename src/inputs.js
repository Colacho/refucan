
const btn_agregar = document.getElementById('agregar');
btn_agregar.addEventListener('click', function(e){
    e.preventDefault();
    
    const nuevo = document.getElementById('nuevo').value;

    if(nuevo == "") {
        return;
    } else {

        const container = document.getElementById('containerInputs');
    
        const div = document.createElement('div');
        div.setAttribute('class', 'form-group');
    
        const label = document.createElement('label');
        label.setAttribute('for', nuevo);
        label.innerHTML = nuevo;
    
        const input = document.createElement('input');
        input.setAttribute('name', nuevo);
        input.setAttribute('class', 'form-control');
        input.setAttribute('type', 'date');
    
        const btn = document.createElement('button');
        btn.setAttribute('id', 'quitar');
        btn.setAttribute('class', 'formboton');
        btn.setAttribute('style', 'margin: 5px')
        btn.addEventListener('click', eliminar)
        btn.innerHTML = 'Quitar';
    
    
        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(btn);
        
        container.appendChild(div);
    }

    
    //console.log("anda");

});

function eliminar (e) {
    e.preventDefault();
    this.e.target.parentElement.remove();
}

