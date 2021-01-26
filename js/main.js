window.addEventListener('load', (e) => {
    const type = 'agurkas';
    axios.get('/plant/agurkas').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => document.querySelector('.cucumber-place').insertAdjacentHTML('afterbegin', 
        `<div class="planting cucumber">
            <img src="./images/cucumber.jpg" alt="" class="cucumber">
            Krūmo nr. ${element.id}
            Kiekis: ${element.kiekis}
            <button class="button sodinti uproot" type="submit" name="rautiAgurka" value="${element.id}">Rauti</button>
        </div>`));
    }).then(function(){
        addDeleteListener();
    })
    // TODO: catch

    axios.get('/plant/pomidoras').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => document.querySelector('.tomatoes-place').insertAdjacentHTML('afterbegin', 
        `<div class="planting tomato">
            <img src="./images/tomato.jpg" alt="" class="tomato">
            Krūmo nr. ${element.id}
            Kiekis: ${element.kiekis}
            <button class="button sodinti uproot" type="submit" name="rautiPomidora" value="${element.id}">Rauti</button>
        </div>`));
    }).then(function(){
        addDeleteListener();
    })
    // TODO: catch
});
document.addEventListener("DOMContentLoaded", function(){
    plantListener('#plantCucumber', 'agurkas');
    plantListener('#plantTomato', 'pomidoras');
});

function plantListener(idSelector, veggieType) {
    document.querySelector(idSelector).addEventListener('click', (e) => {
        const type = veggieType;
        axios({
            method: 'post',
            data: {
                type: type
            },
            url: '/plant'
        }).then(function(response) {
            window.location.reload();
        });
    });
}

function addDeleteListener() {
    document.querySelectorAll('.uproot').forEach(element => element.addEventListener('click', (e) => {
        const id = e.target.value;
        axios.delete('/plant/' + id).then(function(response) {
            window.location.reload(); 
        });
    }));
}




// document.querySelectorAll('.garden')[0].addEventListener('click', (e) => {
//     // e.preventDefault();
//     const type = document.querySelector('.plantNew select').value;
//     const quantity = document.querySelector('.plantNew input').value;
//     document.querySelector('.plantNew input').value = '';
//     axios({
//             method: 'post',
//             data: {
//                 type: type,
//                 quantity: quantity,
//             },
//             url: './garden/plantNew',
//         })
//         .then(function(response) {
//             for (let i = 0; i < response.data.message.length; i++) {
//                 const data = response.data.message[i];
//                 document.querySelector('.plants').insertAdjacentHTML('afterbegin', <div class='plant' id='p${data.id}'>
//                 <img src='./img/${data.type}/${data.img}.jpg' alt='plant'>
//                 <div class='about'>
//                     Nr: ${data.id}<br>
//                     Kiekis: 0<br>
//                     Kaina/vnt.: ${data.currentPrice}<br>
//                     <div class='uproot' id='${data.id}'><p>Išrauti</p></div> 
//                 </div>
//                 </div>);
//             }
//             setUproot(response.data.message.length);
//         })
//         .catch(function(error) {
//             if (error.request === undefined) {
//                 new Err('Sistemos klaida.');
//             } else {
//                 new Err(error.response.data.message);
//             }
//         });
// })