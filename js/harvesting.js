window.addEventListener('load', (e) => {
    const type = 'agurkas';
    axios.get('/plant/agurkas').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => document.querySelector('.cucumber-place').insertAdjacentHTML('afterbegin', 
        `<div class="planting cucumber">
            <img src="./../images/cucumber.jpg" alt="" class="cucumber">
            Krūmo nr. ${element.id}
            Kiekis: ${element.kiekis}
            <button class="button skinti" type="submit" name="skintiAgurka" value="${element.id}">Skinti</button>
            <button class="button skintiKruma" type="submit" name="skintiKrumaAgurk" value="${element.id}">Skinti visa kruma</button>
        </div>`));
    }).then(function(){
        addDeleteListener();
    })
    // TODO: catch

    axios.get('/plant/pomidoras').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => document.querySelector('.tomatoes-place').insertAdjacentHTML('afterbegin', 
        `<div class="planting tomato">
            <img src="./../images/tomato.jpg" alt="" class="tomato">
            Krūmo nr. ${element.id}
            Kiekis: ${element.kiekis}
            <button class="button skinti" type="submit" name="skintiPomidora" value="${element.id}">Skinti</button>
            <button class="button skintiKruma" type="submit" name="skintiKrumaPomid" value="${element.id}">Skinti visa kruma</button>
        </div>`));
    }).then(function(){
        addDeleteListener();
    })
    // TODO: catch
});
document.addEventListener("DOMContentLoaded", function(){
    plantListener('#harvestCucumber', 'agurkas');
    plantListener('#harvestTomato', 'pomidoras');
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