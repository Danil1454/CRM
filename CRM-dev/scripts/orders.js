const clientInput = document.querySelector('#client');
// форма для почты
const emailField = document.querySelector('#email-field');
// Функция для переключения видимости поля с почтой 
const toggleVisibleEmailField = () => {
    const value = clientInput.value;
    if (value === 'new') {
        emailField.style.display = 'block';
    }else {
        emailField.style.display = 'none';
    }
}
toggleVisibleEmailField();
clientInput.addEventListener('input', toggleVisibleEmailField);