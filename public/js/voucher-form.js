document.addEventListener('DOMContentLoaded', function() {
    const typeSelf = document.querySelector('input[type="radio"][value="self"]');
    const typeGift = document.querySelector('input[type="radio"][value="gift"]');
    
    const dateField = document.querySelector('#public_voucher_form_validFrom').closest('div');
    
    function toggleDateField() {
        if (typeGift && typeGift.checked) {
            dateField.style.display = 'block';
        } else {
            dateField.style.display = 'none';
        }
    }
    
    if (typeSelf && typeGift && dateField) {
        typeSelf.addEventListener('change', toggleDateField);
        typeGift.addEventListener('change', toggleDateField);
        
        toggleDateField();
    } else {
        console.error('Не найдены элементы формы!');
    }
});