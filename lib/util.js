const NOME_SESSAO = 'automac_estacionamento';

function maxLengthNumber(object) {
    if (object.value.length > object.maxLength) {
      object.value = object.value.slice(0, object.maxLength);
    }
}