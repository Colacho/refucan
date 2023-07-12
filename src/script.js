const d = document;
const selectProvincia = d.getElementById("provincia");
const selectMunicipio = d.getElementById("municipio");

function provincia() {
    fetch("https://apis.datos.gob.ar/georef/api/provincias")
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(json => {
        let option = `<option value = "provincia">Seleccione Provincia</option>`;
        json.provincias.forEach(element => option += `<option value="${element.nombre}">${element.nombre}</option>`);
        selectProvincia.innerHTML = option;
    })
    .catch(error => {
        let message = error.statusText || "Ocurrio un error";

        selectProvincia.nextElementSibling.innerHTML = `Error: ${error.status}: ${message}`;
    })
}

d.addEventListener("DOMContentLoaded", provincia)

function municipio(provSelec) {
    fetch(`https://apis.datos.gob.ar/georef/api/municipios?provincia=${provSelec}&max=100`)
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(json => {
        let option = `<option value = "municipio">Seleccione una localidad</option>`;
        json.municipios.forEach(element => option += `<option value="${element.nombre}">${element.nombre}</option>`);
        selectMunicipio.innerHTML = option;
    })
    .catch(error => {
        let message = error.statusText || "Ocurrio un error";

        selectMunicipio.nextElementSibling.innerHTML = `Error: ${error.status}: ${message}`;
    })

}

selectProvincia.addEventListener("change", e => {
    municipio(e.target.value);
}) 