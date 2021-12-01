const charity = document.querySelector('#charity')
const currency = document.querySelector('#currency')
const donation = document.querySelector('#donation')
const donateBtn = document.querySelector('button')

donateBtn.addEventListener('click', ()=>{
    const stripe = Stripe('INSERT_YOUR_STRIPE_PUBLIC_KET HERE')
    fetch('http://localhost:8080/backend/server.php', {
        method:'POST',
        body: new FormData ( document.querySelector('.form-donations') )
    })
    .then(res => res.text())
    .then(sesId =>{
        stripe.redirectToCheckout({sessionId:sesId})
    })
})