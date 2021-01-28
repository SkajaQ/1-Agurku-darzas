window.addEventListener('load', (e) => {
    const type = 'agurkas';
    axios.get('/plant/agurkas').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => {
            const amount = element.kiekis + element.toGrow;
            document.querySelector('.cucumber-place').insertAdjacentHTML('afterbegin', 
            `<div class="grow-line">
                <img src="./../images/cucumber.jpg" alt="" class="cucumber">
                Krūmo nr. ${element.id}
                <span class="grow-line">Yra: ${element.kiekis}</span>
                <span class="grow-line">Užaugs ${element.toGrow}</span>
                <input type="hidden" name="${element.id}" class="grow-cucumber" value="${amount}">
            </div>`)
        });
    });
    // TODO: catch

    axios.get('/plant/pomidoras').then(function(response) {
        const data = JSON.parse(response.data);
        data.forEach(element => {
            const amount = element.kiekis + element.toGrow;
            document.querySelector('.tomatoes-place').insertAdjacentHTML('afterbegin', 
        `<div class="planting tomato">
            <img src="./../images/tomato.jpg" alt="" class="tomato">
            Krūmo nr. ${element.id}
            <span class="grow-line">Yra: ${element.kiekis}</span>
            <span class="grow-line">Užaugs ${element.toGrow}</span>
            <input type="hidden" name="${element.id}" class="grow-tomato" value="${amount}">
        </div>`)
        });
    });
    // TODO: catch
});
document.addEventListener("DOMContentLoaded", function(){
    growListener('#growCucumber', '.grow-cucumber');
    growListener('#growTomato', '.grow-tomato');
});

function growListener(idSelector, classSelector) {
    document.querySelector(idSelector).addEventListener('click', (e) => {
        let array = [];
        document.querySelectorAll(classSelector).forEach(element => {
            let object = {id: element.name, amount: element.value};
            array.push(object);
        });
        axios({
            method: 'post',
            data: {
                array: array
            },
            url: '/grow'
        }).then(function(response) {
            window.location.reload();
        });
    });
}
