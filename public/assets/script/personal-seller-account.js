const personalBtns = document.querySelector('.personal-account-btns').querySelectorAll('span')
const contents = document.querySelector('.personal-account-content-items').querySelectorAll('.personal-account-content-item')
const genderBtns = document.querySelector('.gender-items').querySelectorAll('span')
const inStockBtns = document.querySelectorAll('.in-stock-controls')

personalBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = `personal-content${btn.id.split('personal')[1]}`
        const addProductBtn = document.getElementById('add-product')
        if (['personal-stores', 'personal-waiting-list'].includes(btn.id)) {
            addProductBtn.style.display = 'none'
        } else {
            addProductBtn.style.display = 'flex'            
        }
        hideShowPersonalContent(id)
        btn.classList.toggle('active-personal-btn')                
    })
});

document.getElementById('add-product').addEventListener('click', () => {
    hideShowPersonalContent('personal-content-add-product')
})

document.getElementById('personal-content-products').querySelectorAll('.table-action').forEach(action => {
    action.addEventListener('click', () => {
        action.classList.toggle('opened')
        if (action.classList.contains('opened')) {
            action.parentElement.nextElementSibling.style.display = 'block'
        } else {
            action.parentElement.nextElementSibling.style.display = 'none'            
        }
    })    
});

document.getElementById('personal-content-waiting-list').querySelectorAll('.table-action').forEach(action => {
    action.addEventListener('click', () => {
        action.classList.toggle('opened')
        if (action.classList.contains('opened')) {
            action.parentElement.nextElementSibling.style.display = 'block'
        } else {
            action.parentElement.nextElementSibling.style.display = 'none'            
        }
    })    
});

genderBtns.forEach(action => {
    action.addEventListener('click', () => {
        genderBtns.forEach(btn => {btn.classList.remove('active-personal-btn')});
        action.classList.toggle('active-personal-btn')
    })    
});

inStockBtns.forEach(actions => {
    actions.querySelectorAll('span').forEach(action => {
        action.addEventListener('click', () => {
            actions.querySelectorAll('span').forEach(btn => {btn.classList.remove('active-personal-btn')});
            action.classList.toggle('active-personal-btn')
        })            
    })
});

document.querySelectorAll('.phone-input').forEach(input => {
    input.addEventListener('change', (e) => {
        const regEx = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/
        const color = regEx.test(e.target.value) ? '#E6E6E6' : 'red'
        e.target.style.setProperty('border', `1px solid ${color}`, 'important');
        setTimeout(() => {
            e.target.style.setProperty('border', '1px solid #E6E6E6', 'important');
        }, 3000);
    })    
});


function hideShowPersonalContent(contentId) {
    contents.forEach(content => content.style.display = 'none');
    if (contentId !== 'personal-content-add-product') {
        personalBtns.forEach(btn => btn.classList.remove('active-personal-btn'));        
    }
    console.log(contentId);
    document.getElementById(contentId).style.display = 'block'
}