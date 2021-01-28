window.addEventListener('load', (e) => {
    const type = 'agurkas';
    axios.get('/plant/agurkas').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => document.querySelector('.cucumber-place').insertAdjacentHTML('afterbegin', 
        `<div class="grow-line">
            <img src="./../images/cucumber.jpg" alt="" class="cucumber">
            Krūmo nr. ${element.id}
            Kiekis: ${element.kiekis}
            <input type="text" id="kiekisSkinti${element.id}">
            <button class="button skinti" type="submit" name="${element.kiekis}" value="${element.id}">Skinti</button>
            <button class="button skintiKruma" type="submit" name="skintiKrumaAgurku" value="${element.id}">Skinti visa kruma</button>
        </div>`));
    }).then(function(){
        addHarvestSingleListener();
        addHarvestBushListener();
    })
    // TODO: catch

    axios.get('/plant/pomidoras').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => document.querySelector('.tomatoes-place').insertAdjacentHTML('afterbegin', 
        `<div class="grow-line">
            <img src="./../images/tomato.jpg" alt="" class="tomato">
            Krūmo nr. ${element.id}
            Kiekis: ${element.kiekis}
            <input type="text" id="kiekisSkinti${element.id}">
            <button class="button skinti" type="submit" name="${element.kiekis}" value="${element.id}">Skinti</button>
            <button class="button skintiKruma" type="submit" name="skintiKrumaPomidoro" value="${element.id}">Skinti visa kruma</button>
        </div>`));
    }).then(function(){
        addHarvestSingleListener();
        addHarvestBushListener();
    })
    // TODO: catch
});
document.addEventListener("DOMContentLoaded", function(){
    addHarvestAllListener();
});

function addHarvestSingleListener() {
    document.querySelectorAll('.skinti').forEach(element => element.addEventListener('click', (e) => {
        const id = e.target.value;
        const amount = e.target.name;
        const toHarvest = document.querySelector('#kiekisSkinti'+id).value;
        const sum = amount - toHarvest > 0 ? amount - toHarvest : 0;
        axios({
            method: 'post',
            data: {
                id: id,
                toHarvest: sum
            },
            url: '/harvest'
        }).then(function(response) {
            window.location.reload();
        });
    }));
}

function addHarvestBushListener() {
    document.querySelectorAll('.skintiKruma').forEach(element => element.addEventListener('click', (e) => {
        const id = e.target.value;
        axios({
            method: 'post',
            url: '/harvest/' + id
        }).then(function(response) {
            window.location.reload();
        });
    }));
}

function addHarvestAllListener() {
    document.querySelector('.harvestAll').addEventListener('click', (e) => {
        const id = e.target.value;
        axios({
            method: 'post',
            url: '/harvest/all'
        }).then(function(response) {
            window.location.reload();
        });
    });
}